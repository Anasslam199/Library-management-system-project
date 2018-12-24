<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\Book;
use App\Theme;
use App\Member;
use App\Borrow;
use Carbon\Carbon;
use Session;
use DB;
use Auth;

class borrowController extends Controller
{

  function __construct(Request $request)
  {
      $this->middleware('auth')->is_admin();
  }


  public function index(){
    $borrows =  Borrow::all();
     return View("Borrows.index",["borrows"=>$borrows]);


  }
public function dashboard()
{
 $totalbooks   = (int)count(Book::all());
 $totalmembers = (int)count(Member::all());
 $totaborrows =count(Borrow::where('return', '=', 0)->get());
 $totabooksborrowed = count(Book::where('status', '=', 1)->get());
 $totaborrows = (int)$totaborrows;
 $porcent =($totabooksborrowed * 100)/$totalbooks;
 //show a number to 0 decimal placc
 $porcent = number_format($porcent, 0, '.', '');
 return view("home",["Books"=>$totalbooks,"Members"=>$totalmembers,"Borrows"=>$totaborrows,"Porcent"=>$porcent]);


}

  public function memberdetail($id){
    $member = Member::findorfail($id);
    $borrows = $member->borrows;
    return view('Borrows.memberdetail',["member"=>$member,"borrows"=>$borrows]);
    }
    public function bookdetail($id){
      $book = Book::findorfail($id);
        $borrows = $book->borrows;
      return view('Borrows.bookdetail',["book"=>$book,"borrows"=>$borrows]);
    }


  public function create($id){
      $member = Member::findorfail($id);
      if (!$member->deposit) {
         return Redirect::back()->with('message', 'This don\'t have the deposit !');
         //return Redirect('members')->with('message', 'This don\'t have the deposit !');
      }
      $borrows = $member->borrows;
      return view('Borrows.memberdetail',["member"=>$member,"borrows"=>$borrows]);
    }

    public function store(Request $request){
      $urlParts = parse_url( $_SERVER['HTTP_REFERER']);
      $parts = explode('/', $urlParts['path']);
      $member = Member::find($request->member);

      if (empty($member)) {
        $borrows = Borrow::all();
        Session::flash('message', 'doesn\'t any member have this id');
        return view('Borrows.index',["borrows"=>$borrows]);
      }

     $borrows = $member->borrows;
     $book = Book::find($request->book);
     if (empty($book)) {

       Session::flash('message', 'doesn\'t any book have this id');
       return view('Borrows.memberdetail',["member"=>$member,"borrows"=>$borrows]);
     }
     if ($book->status == 0) {
        Session::flash('message', 'doesn\'t exist this book now ! !');
       return view('Borrows.memberdetail',["member"=>$member,"borrows"=>$borrows]);


     }
     $countBook=0;
     foreach($borrows as $borrow){
       if ($borrow->return == 0 ) {
         ++$countBook;
       }
     }
     if ($countBook<2) {
       $borrow = new Borrow();
       $borrowdate = new DateTime();
       $borrow->borrowdate = $borrowdate->format('Y-m-d H:i:s');
       $borrowdate->modify('+15 day');
       $borrow->borrowend = $borrowdate->format('Y-m-d H:i:s');
       $borrow->return = 0;
       $borrow->member_id = $request->member;
       $borrow->book_id = $request->book;
       $borrow->book->status = 0;
       $borrow->save();
       $book = Book::findorfail($request->book);
       $book->status = 0;
       $book->save();
       if ($countBook>=2) {
         Session::flash('message', 'This have a 2 book ! !');
         return view('Borrows.index',["borrows"=>$borrows]);
         // return Redirect('borrows');
       }
       else {
         $member = Member::findorfail($request->member);
         $borrows = $member->borrows;
         Session::flash('message', 'Borrowing with succes ! !');
         return view('Borrows.memberdetail',["member"=>$member,"borrows"=>$borrows]);

       }
     }
     else if ($countBook>=1) {
       $member = Member::findorfail($request->member);
       $borrows = $member->borrows;
       Session::flash('message',  'This have a 2 book ! ! !');
       return View('/borrows/memberdetail',["member"=>$member,"borrows"=>$borrows]);
     }
     else {
       $member = Member::findorfail($request->member);
       $borrows = $member->borrows;
       Session::flash('message', 'Browwin with succes ! !');
       return View('/borrows/memberdetail',["member"=>$member,"borrows"=>$borrows]);
     }
   }

    public function reborrow($id){

      $borrow = Borrow::find($id);
      $date1 =  new DateTime($borrow->borrowdate);
      $date2 = new DateTime($borrow->borrowend);
      $interval = $date1->diff($date2);
      // echo "difference " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days ";
      $member = $borrow->member;
      $borrows =$member->borrows;
      $days = ($interval->y*365) + ($interval->m*30) + ($interval->d);
      if ($days<30) {
        $borrow->borrowend = date('Y-m-d', strtotime($borrow->borrowend .'+ 15 days'));
        $borrow->save();
        Session::flash('message',  're-Borrow with succes !');
        return view('Borrows.index',["borrows"=>$borrows]);
      }
      else {
        Session::flash('message',  'Impossible borrow a book 2 once  !');
        return view('Borrows.index',["borrows"=>$borrows]);
      }
  }

  public function return($id){
      $borrow = Borrow::find($id);
      $urlParts = parse_url( $_SERVER['HTTP_REFERER']);
      $parts = explode('/', $urlParts['path']);
      $count = count($parts);
      // if ($count==4) {
      //    $slug3 = $parts[2];
      //    return $slug3;
      //    if ($slug3 == "memberdetail") {
      //      return "memberdetail";
      //    }
      //    else {
      //      return "bookdetail";
      //    }
      // }
      // else {
      //   return "two ";
      // }
    if ($borrow->return == 0) {
      $borrow->return = 1;
      $borrow->book->status = 1;
      $dateNow = new DateTime();
      $borrow->borrowend = $dateNow->format('Y-m-d');
      $book = Book::findorfail($borrow->book->id);
      $book->status = 1;
      $book->save();
      $borrow->save();

      if (count($parts) > 2) {
        $member = $borrow->member;
        $borrows = $member->borrows;
        Session::flash('message', 'Return with succes ! !');
        return View('/borrows/memberdetail',["member"=>$member,"borrows"=>$borrows]);
      }
      else {
        Session::flash('message',  'Return with succes ! !');
        return Redirect('borrows');
      }
    }
    else {
      if (count($parts) > 2) {
        $member = $borrow->member;
        $borrows = $member->borrows;
        Session::flash('message', 'this book exist alread ! !');
        return View('/borrows/memberdetail',["member"=>$member,"borrows"=>$borrows]);
      }
      else {
        Session::flash('message',  'this book exist alread ! !');
        return Redirect('borrows');
      }
    }
}
public function generatePDF(Request $request)
{

  $date1 = Carbon::parse($request->borrowStart);
  $date2 = Carbon::parse($request->borrowEnd);
  $borrows = Borrow::where("borrowdate",">=",$date1->toDateString())
                    ->where("borrowdate","<=" ,$date2->toDateString())->get();

    if(Session::get('locale')=='en'){
      $output = '<h2 align="center"> Borrows List </h2>';
      $datenow = new \DateTime();
      $output .= '<p>  <p align=""> Between : from '.$date1->format('d/m/Y').' ';
      $output .= 'to '.$date2->format('d/m/Y').'</p>';
      $output .= '<p align="right">Total : ('.count($borrows).') Borrows</p></p>';
      $output .= '<table  width="100%" style="border-collapse: collapse; border: 0px;"id="customers">
     <tr>
     <th style="border: 1px solid; padding:5px;"align="center" width="">ID</th>
     <th style="border: 1px solid; padding:5px;"align="center" width="">Book title</th>
     <th style="border: 1px solid; padding:2px;"align="center" width="">Member name</th>
     <th style="border: 1px solid; padding:5px;"align="center" width="">Borrow date</th>
     <th style="border: 1px solid; padding:2px;"align="center" width="">Borrow end</th
     <th style="border: 1px solid; padding:2px;"align="center" width="">Return</th>
     </tr>
      ';
      foreach($borrows as $borrow)
      {
       $output .= '
       <tr>
        <td style="border: 1px solid; padding:5px;"align="center">'.$borrow->id.'</td>
        <td style="border: 1px solid; padding:5px;"align="center">'.ucfirst($borrow->member->lastname).' '.$borrow->member->firstname .' </td>
        <td style="border: 1px solid; padding:5px;"align="center">'.$borrow->book->title.'</td>
        <td style="border: 1px solid; padding:5px;"align="center">'.$borrow->borrowdate .'</td>
        <td style="border: 1px solid; padding:5px;"align="center">'.$borrow->borrowend.'</td>';
        if($borrow->return == 1)  $output .='<td style="border: 1px solid; padding:12px;"align="center"><p style="background-color:green;">YES</p></td>';
        else $output .='<td style="border: 1px solid; padding:12px;"align="center"><p style="background-color:red;">NO</p></td>
       </tr>
       ';
     }
    }else {
      $output = '<h2 align="center"> Liste d\'emprunts </h2>';
      $datenow = new \DateTime();
      $output .= '<p>  <p align=""> Période : de '.$date1->format('d/m/Y').' ';
      $output .= 'à '.$date2->format('d/m/Y').'</p>';
      $output .= '<p align="right">Totale : ('.count($borrows).') Emprunts</p></p>';

      $output .= '<table  width="100%" style="border-collapse: collapse; border: 0px;"id="customers">
     <tr>
     <th style="border: 1px solid; padding:5px;"align="center" width="">ID</th>
     <th style="border: 1px solid; padding:5px;"align="center" width="">titre de livre</th>
     <th style="border: 1px solid; padding:2px;"align="center" width="">Nom de membre</th>
     <th style="border: 1px solid; padding:5px;"align="center" width="">date d\'emprunt</th>
     <th style="border: 1px solid; padding:2px;"align="center" width="">fin d\'emprunt</th
     <th style="border: 1px solid; padding:2px;"align="center" width="">Returné</th>
     </tr>
      ';
      foreach($borrows as $borrow)
      {
       $output .= '
       <tr>
        <td style="border: 1px solid; padding:5px;"align="center">'.$borrow->id.'</td>
        <td style="border: 1px solid; padding:5px;"align="center">'.ucfirst($borrow->member->lastname).' '.$borrow->member->firstname.' </td>
        <td style="border: 1px solid; padding:5px;"align="center">'.$borrow->book->title.'</td>
        <td style="border: 1px solid; padding:5px;"align="center">'.$borrow->borrowdate .'</td>
        <td style="border: 1px solid; padding:5px;"align="center">'.$borrow->borrowend.'</td>';
        if($borrow->return == 1)  $output .='<td style="border: 1px solid; padding:12px;"align="center"><p style="background-color:green;">OUI</p></td>';
        else $output .='<td style="border: 1px solid; padding:12px;"align="center"><p style="background-color:red;">NON</p></td>
       </tr>
       ';
    }
  }

   $output .= '</table>';
       $pdf = \App::make('dompdf.wrapper');
       $pdf->loadHTML($output);
       return $pdf->stream();
}
}
