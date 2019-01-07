<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Book;
use App\Member;
use App\Reservation;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $newarrivale = Book::orderBy('created_at', 'desc')->take(4)->get();
         $ourproducts = Book::all()->random(8);
         $books = Book::all();
         return view('Home.index',["books"=> $books,"newarrivale"=>$newarrivale,"ourproducts"=>$ourproducts]);
    }
    public function show($id)
    {
      $book = Book::findorfail($id);
      // $newarrivale = Book::orderBy('created_at', 'desc')->take(4)->get();
      $books = Book::where("theme_id","=",$book->theme_id)->get()->random(4);
      return view("Home.bookDetail",["book"=>$book,"books"=>$books]);

    }
    public function books()
    {
       $books = Book::paginate(12);
       return view("Home.books",["books"=>$books]);
    }
    public  function membershow()
    {
      $date_now = Carbon::now();
      $memebrid  = \Auth::user()->username;
      $member = Member::where("user_username","=",$memebrid)->get();
      $member =  $member[0];
      $memberborrows = $member->borrows;
      // $memberborrows = $member->borrows->where("return","=",0);
      // $memberreservations = $member->reservations->all();
      $memberreservations = $member->reservations->where("reservation_end",">",$date_now);
      return view("Home.memberProfil",["member"=>$member,"memberborrows"=>$memberborrows,"memberreservations"=>$memberreservations]);
    }
    public function reservationdelete(Request $request)
    {
     $reservation =Reservation::findorfail($request->id_delete);
     $reservation->delete();
     $date_now = Carbon::now();;
     $memebrid  = \Auth::user()->username;
     $member = Member::where("user_username","=",$memebrid)->get();
     $member =  $member[0];
     $memberborrows = $member->borrows;
     $memberreservations = $member->reservations->where("reservation_end",">",$date_now);
     return view("Home.memberProfil",["member"=>$member,"memberborrows"=>$memberborrows,"memberreservations"=>$memberreservations]);
    }
}
