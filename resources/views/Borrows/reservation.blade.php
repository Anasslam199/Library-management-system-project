@extends('layouts.app')

@section('content')
<!--datatables css --->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.18/r-2.2.2/datatables.min.css"/> -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<style media="screen">
  tr{
    text-align: center;
  }

@media screen and (max-width:768px){
  #author{ display: none;}
  #theme{display: none;}
}
#title{
  width: 20%;
}
</style>

<h3 style="text-align:center;"> {{__('messages.ReservationsList')}} </h3>


<div class="container-fuild  col-lg-9 col-md-12 col-sm-12"style="margin: 2% auto;">
  @if(Session::has('message'))
<div class="alert alert-success" role="alert" style="margin:0 auto;width:35%;">
<p style="text-align:center;">{{ Session::get('message') }}  </p>
</div>
  @endif
<table id="booksTable" class="table table-striped" >
   <thead>
      <th>{{__('messages.Member_id')}}       </th>
      <th>{{__('messages.Member_name')}}     </th>
      <th>{{__('messages.Book_title')}}      </th>
      <th>{{__('messages.Reservation_for')}} </th>
      <th>Action </th>
   </thead>
   @foreach($reservations as $reservation)
    <tr>
      <td>{{$reservation->member->id}}</td>
      <td>{{$reservation->member->firstname}} {{$reservation->member->lastname}}</td>
      <td>{{$reservation->book->title}}</td>
      <td> {{ date('d-m-Y h:i', strtotime($reservation->reservation_datetime)) }} </td>
      <td>
        <form method="post" action="{{url('borrows/borrowing_Reservation')}}">
          {{ csrf_field() }}
          <input type="hidden" name="reservation" value="{{$reservation->id}}">
          <input type="hidden" name="member" value="{{$reservation->member->id}}">
          <input type="hidden" name="book" value="{{$reservation->Book->id}}">
          <button class="btn btn-outline-primary" type="submit" name="button">Borrowing <i class="fas fa-caret-square-right"></i></button>
        </form>
        </td>
      </tr>
   @endforeach
</table>
</div>
</div>
@stop

@section('_js_scaffold')
@stop
