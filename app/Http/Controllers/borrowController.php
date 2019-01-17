<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use App\Book;
use App\Theme;
use App\Member;
use App\Borrow;
use App\Reservation;
use Carbon\Carbon;

use Session;
use DB;
use Auth;
// hwa hada ? nn bookcontroller
class borrowController extends Controller
{

  function __construct(Request $request)
  {
      $this->middleware('auth');
  }

  public function test_Reservation()
  {
    $currentAuth = auth::user()->username;
    $member = Member::where("user_username",$currentAuth)->get();
    $member;
    $firstmember = $member[0];
    $memberid = $firstmember["id"];
    $memberreservations = $member[0]->reservations()->get()->toArray();
    $resCount = count($memberreservations);
    if ($resCount>=20) {
     echo "false";
    }
    else {
      echo "true";
    }
  }
  public function reserving(Request $request)
  {
    $currentAuth = auth::user()->username;
    $member = Member::where("user_username",$currentAuth)->get();
    $member;
    $firstmember = $member[0];
    $memberid = $firstmember["id"];



              $reservation = new Reservation();
              $date1 = new carbon($request->reservation_datetime);
              $reservation->reservation_datetime = $date1->format("Y-m-d");

              $date2 = new carbon($request->reservation_end);
              $reservation->reservation_end = $date2->format("Y-m-d");

              $reservation->book_id = $request->book;
              $reservation->member_id = $memberid;

              $reservation->save();
              echo "you reserved the book with succes";
              // echo  "you created reservation with succes!";
              // echo $request->reservation_datetime." ".$request->reservation_end." ".$request->book;

              // $reservation->reservation_datetime = $request->reservation_datetime;
              // $reservation->reservation_end = $request->reservation_end;
              // $reservation->book_id = $request->book;
              // $reservation->member_id = $memberid;
              // $reservation->save();
              // echo  "you created reservation with succes!";


    // $date_now = Carbon::now();
    // $reservation_datetime = Carbon::parse($request->reservation_datetime);
    // if ($date_now>$reservation_datetime) {
    //    echo "This date was passed !";
    // }

//     // $reservations = Reservation::where("reservation_datetime",">=",$dateNow->toDateString())->get();
//     // $member = Member::findorfail($request->member);
//     $date_reservation = $request->reservation_datetime;
//     //For create a reservation new
//     //Test if the book is borrowed
//     $book = Book::findorfail($request->book);
//     if ($book->status == 0) {
//       $newarrivale = Borrow::orderBy('borrowend', 'desc')->where('book_id',$book->id)->take(1)->get();
//       $collection = $newarrivale->toArray();
//       $c = $collection[0];
//       $borrowdate =  $c['borrowdate'];
//       $borrowend =  $c['borrowend'];
//
//      $borrowend = Carbon::parse($borrowend);
//      $reservation_datetime = Carbon::parse($request->reservation_datetime);
//      if ($borrowend>$reservation_datetime && $borrowdate<$reservation_datetime) {
//         echo "this book Borrowed now !!";
//      }
//     }
//     // test of the book ,it's reserved for this perdiod
//     // $newarrivale = Reservation::orderBy('reservation_datetime', 'desc')->where('book_id',$book->id)->take(1)->get();
//     $reservations = Reservation::where('book_id',$book->id)->get();
//     //Convert Laravel object to Array
//      $reservations = $reservations->all();
//      $book_reservation_total = count($reservations);
//      if ($book_reservation_total>0) {
//         echo "baraka elih";
//        // foreach ($reservations as $reservation) {
//        //   //Return last reservation of this  book
//        //   $last_reservation =  $reservation['reservation_datetime'];
//        //   $last_reservation = Carbon::parse($last_reservation);
//        //   $last_reservation48 = Carbon::parse($last_reservation)->addHours(48);
//        //
//        //   //I added Reservation_end column to our table there i return the resevation end of last resevation
//        //   $end_borrow =  $reservation['reservation_end'];
//        //   $end_borrow = Carbon::parse($end_borrow);
//        //
//        //   // $end_borrow = Carbon::parse($last_reservation)->addDays(15);
//        //   $date_now = Carbon::now();
//        //   $reservation_datetime = Carbon::parse($request->reservation_datetime);
//        //
//        //    if ($date_now>$last_reservation48) {
//        //      if ($reservation->delete()) {
//        //        $reservation = new Reservation();
//        //        $reservation->reservation_datetime = $request->reservation_datetime;
//        //        $reservation->reservation_datetime = $request->reservation_end;
//        //        $reservation->book_id = $request->book;
//        //        $reservation->member_id = $memberid;
//        //        $reservation->save();
//        //       echo  "you created reservation with succes!majax";
//        //      }
//        //
//        //   }
//        //   else  if ($reservation_datetime < $end_borrow && $last_reservation < $reservation_datetime) {
//        //
//        //      echo $last_reservation."reserved".$end_borrow;
//        //   }
//        //   else  if ($reservation_datetime>$last_reservation && $reservation_datetime<$end_borrow) {
//        //
//        //      echo $last_reservation." kak".$end_borrow;
//        //   }
//        //   }
//      }
//      else {
//        // if ($reservation->delete()) {
//          $reservation = new Reservation();
//          $reservation->reservation_datetime = $request->reservation_datetime;
//          $reservation->reservation_end = $request->reservation_end;
//          $reservation->book_id = $request->book;
//          $reservation->member_id = $memberid;
//          $reservation->save();
//          echo  "you created reservation with succes!";
//        // }
//
//      }
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
       return View('Borrows.memberdetail',["member"=>$member,"borrows"=>$borrows]);
     }
     else {
       $member = Member::findorfail($request->member);
       $borrows = $member->borrows;
       Session::flash('message', 'Browwin with succes ! !');
       return View('Borrows.memberdetail',["member"=>$member,"borrows"=>$borrows]);
     }
   }
   //Return the reservations list
   public function reservation()
   {
     $dateNow = Carbon::now()->addHour()->addHours(1);
     // $borrowdate->modify('+15 day');
     $reservations = Reservation::where("reservation_datetime",">=",$dateNow->toDateString())->get();
     return  View('Borrows.reservation',['reservations'=>$reservations]);

   }
  public  function empty_dates(Request $request)
  {
    $id = $request->book;
    $year = $request->year;
    $date_now = Carbon::now();
    $bookReservations = Book::findorfail($id)->reservations()->where("reservation_end",">",$date_now)
                                                                    ->whereYear('reservation_end', '=', $year)
                                                                    ->orderBy('reservation_datetime', 'asc')->get();

    $j = 0;
    $output = "";
    $count = count($bookReservations);
    if ($count === 0) {
      if ($year != $date_now->year) {
      $date_now = new Carbon($year.'-01-01');
    }
      else {
        $date_now = new Carbon($year.'-'.$date_now->month.'-'.$date_now->day.'');
      }

      $reservation_end = new Carbon($year.'-12-31');
      // $date_now = $date_now->format('m-d-Y');
      $output = '<tr> <td>'.$date_now->format("d-m-Y").'</td> <td>'.$reservation_end->format('d-m-Y').'</td>

      <td>  <button type="button" data-book="'.$id.'" data-date1="'.$date_now->format("d-m-Y").'" data-date2="'.$reservation_end->format('d-m-Y').'" id="idd" class="btn btn-info btn-sm">Primary</button></td> </tr>';
      // echo $date_now." to ".$reservation_end;
    }
    else {
      for ($i=0; $i <count($bookReservations); $i++) {
        ++$j;
        $bookReservation = $bookReservations[$i];
         if ($i==0 && $date_now<$bookReservation->reservation_datetime ) {
           if ($count===$j) {
              $reservation_end = new Carbon($year.'-12-31');
              $reservation_end = $reservation_end;
              $output .= '<tr> <td>'. date('d-m-Y', strtotime($bookReservation->reservation_end)+86400).'</td> <td>'.$reservation_end->format('m/d/Y').'</td>
              <td>  <button type="button" data-book="'.$id.'" data-date1="'.date('d-m-Y', strtotime($bookReservation->reservation_end)+86400).'" data-date2="'.$reservation_end->format('d-m-Y').'" id="idd" class="btn btn-info btn-sm">Primary</button></td> </tr>';
              // echo $bookReservation->reservation_end."=>last".$reservation_end."<br>";
            }else {
              $output .= '<tr> <td>'. $date_now->format('d-m-Y').'</td> <td>'.date('d-m-Y', strtotime($bookReservation->reservation_datetime)-86400).'</td>
              <td>  <button type="button" data-book="'.$id.'" data-date1="'.$date_now->format('d-m-Y').'" data-date2="'.date('d-m-Y', strtotime($bookReservation->reservation_datetime)-86400).'" id="idd" class="btn btn-info btn-sm">Primary</button></td> </tr>';

              // echo $date_now."=>".$bookReservation->reservation_datetime."<br>";
            }
        }
        else {
            if ($count===$j) {
               $reservation_end = new Carbon($year.'-12-31');
               $output .= '<tr> <td>'.date('d-m-Y', strtotime($bookReservation->reservation_end)+86400) .'</td>
                <td>'.$reservation_end->format('d-m-Y').'</td>
                <td>  <button type="button" data-book="'.$id.'" data-date1="'.date('d-m-Y', strtotime($bookReservation->reservation_end)+86400).'" data-date2="'.$reservation_end->format('d-m-Y').'" id="idd" class="btn btn-info btn-sm">Primary</button></td> </tr>';

               // echo $bookReservation->reservation_end."=>last".$reservation_end."<br>";
               }
               else {
                 $bookReservation2 = $bookReservations[$j];
                 // echo $bookReservation->reservation_end."=>".$bookReservation2->reservation_datetime."<br>";
                 $output .= '<tr> <td>'.date('d-m-Y', strtotime($bookReservation->reservation_end)+86400).'</td>
                  <td>'.date('d-m-Y', strtotime($bookReservation2->reservation_datetime)-86400).'</td>
                  <td>  <button type="button" data-book="'.$id.'" data-date1="'.date('d-m-Y', strtotime($bookReservation->reservation_end)+86400).'" data-date2="'.date('d-m-Y', strtotime($bookReservation2->reservation_datetime)-86400).'" id="idd" class="btn btn-info btn-sm">Primary</button></td> </tr>';

               }
             }
      }
    }

    echo $output;
  }


   public function borrowing_Reservation(Request $request)
   {
     $reservations = Reservation::all();
     $dateNow = Carbon::now();

     $reservation = Reservation::findorfail($request->reservation);
     if ($reservation->reservation_datetime>$dateNow) {
       Session::flash('message', 'This reservation will be started at '.date('Y-m-d', strtotime($reservation->reservation_datetime)));
       return  View('Borrows.reservation',['reservations'=>$reservations]);
     }
     else if ($reservation->reservation_end<$dateNow) {
       Session::flash('message', 'This reservation ended at '.date('Y-m-d', strtotime($reservation->reservation_end)));
       return  View('Borrows.reservation',['reservations'=>$reservations]);
     }
     $member = Member::findorfail($request->member);
     $borrows = $member->borrows;
     $countBook=0;
     foreach($borrows as $borrow){
       if ($borrow->return == 0 ) {
         ++$countBook;
       }
     }
     if ($countBook<=2) {
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
       $member = Member::findorfail($request->member);
       $borrows = $member->borrows;
       $reservation->delete();
       $dateNow = Carbon::now();
       $reservations = Reservation::where("reservation_datetime",">=",$dateNow->toDateString())->get();
       Session::flash('message', 'Borrowing with succes ! !');
       return  View('Borrows.reservation',['reservations'=>$reservations]);
     }
       else {
         $dateNow = Carbon::now();
         $reservations = Reservation::where("reservation_datetime",">=",$dateNow->toDateString())->get();
         Session::flash('message', 'This have a 2 book ! !');
        return  View('Borrows.reservation',['reservations'=>$reservations]);

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
