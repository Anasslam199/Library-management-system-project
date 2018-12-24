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

<h3 style="text-align:center;"> {{__('messages.Borrowslist')}} </h3>
<div class="container-fuild  col-lg-9 col-md-12 col-sm-12"style="margin: 2% auto;">
  @if(Session::has('message'))
<div class="alert alert-success" role="alert" style="margin:0 auto;width:35%;">
<p style="text-align:center;">{{ Session::get('message') }}  </p>
</div>
  @endif
  <div class="form-row">
   <div class="form-group col-md-3">
     <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        <i class="fas fa-plus-circle"></i>  {{__('messages.Newborrow')}}
     </button>
   </div>
   <div class="form-group col-md-3">
     <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong"
     target="_blank" ><i class="fas fa-print"></i>   {{__('messages.MembersPrint')}}
     </button>
   </div>
 </div>
  <!-- Button trigger modal -->


<!-- Modal  -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="get" action="{{url('borrows/generate-pdf')}}">
        <div class="modal-body">
            <div class="form-group row">
            <label for="inputPassword" class="col-sm-3 col-form-label">{{__('messages.borrowStart')}} :</label>
            <div class="col-sm-9">
              <div class="col-sm-10">
                <input type="date" class="form-control @if($errors->has('borrowStart')) is-invalid @endif"
                id="borrowStart" name="borrowStart"  value="{{old('borrowStart')}}">
                @if ($errors->has('borrowStart'))
                <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                   {{ $errors->first('borrowStart') }}</p>
               @endif
              </div>
            </div>
          </div>
          <div class="form-group row">
          <label for="inputPassword" class="col-sm-3 col-form-label">{{__('messages.borrowEnd')}} : </label>
          <div class="col-sm-9">
            <div class="col-sm-10">
              <input type="date" class="form-control @if($errors->has('borrowEnd')) is-invalid @endif"
              id="borrowEnd" name="borrowEnd" value="{{old('borrowEnd')}}">
              @if ($errors->has('borrowEnd'))
              <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                 {{ $errors->first('borrowEnd') }}</p>
             @endif
            </div>
          </div>

        </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" target="_blank" >{{__('messages.Save')}}</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.Close')}} </button>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
  <!-- Button trigger modal -->


  <!-- Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">{{__('messages.Borrownew')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" action="{{url('borrows')}}">
        <div class="modal-body">

            {{ csrf_field() }}
            <div class="form-group row">
            <label for="inputPassword" class="col-sm-3 col-form-label">{{__('messages.Memberid')}} :</label>
            <div class="col-sm-9">
              <input type="text" class="form-control @if($errors->has('member'))
              is-invalid @endif" id="member" name="member"
              placeholder="Entrer the member"
              value="{{old('description')}}" >
              @if ($errors->has('member'))
              <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign"
                aria-hidden="true"></span>
                 {{ $errors->first('member') }}</p>
             @endif
            </div>
          </div>
          <div class="form-group row">
          <label for="inputPassword" class="col-sm-3 col-form-label">{{__('messages.Bookid')}} : </label>
          <div class="col-sm-9">
            <input type="text" class="form-control @if($errors->has('book'))
            is-invalid @endif" id="book" name="book"
            placeholder="Entrer the book"
            value="{{old('description')}}" >
            @if ($errors->has('book'))
            <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign"
              aria-hidden="true"></span>
               {{ $errors->first('book') }}</p>
           @endif
          </div>

        </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" >{{__('messages.Save')}}</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.Close')}} </button>
        </div>
        </form>

      </div>
    </div>
  </div>


<!-- Edit Moda -->
<table id="booksTable" class="table table-striped" >
   <thead>
      <th id="">{{__('messages.Borrowsmembername')}}</th>
      <th id="">{{__('messages.Borrowsbooktitle')}}</th>
      <th id="">{{__('messages.Borrowsborrowsdate')}}</th>
      <th id="">{{__('messages.Borrowsborrowsend')}}</th>
      <th id="">{{__('messages.Borrowsreturn')}}</th>
      <th>Action</th>
   </thead>
   @foreach($borrows as $borrow)
    <tr>
      <td>{{$borrow->member->firstname}} {{$borrow->member->lastname}}</td>
      <td>{{$borrow->book->title}}</td>
      <td>{{$borrow->borrowdate}}</td>
      <td>{{$borrow->borrowend}}</td>

      <td>
        @if($borrow->return)
        <span class="badge badge-success">{{__('messages.BorrowsreturnYES')}}</span>

        @else
        <span class="badge badge-danger">{{__('messages.BorrowsreturnNO')}}</span>
        @endif
      </td>
      <td>
        @if($borrow->return)
          <a style="pointer-events: none; cursor: default;"  class="btn btn-primary disabled" value="Modifier" href="{{url('/borrows/'.$borrow->id.'/reborrow')}}"
          role="button" ><i class="fas fa-sync-alt"></i> </a>
          <a style="pointer-events: none; cursor: default;" class="btn btn-danger disabled" value="Modifier" href="{{url('/borrows/'.$borrow->id.'/return')}}"
            role="button" disabled><i class="fas fa-times-circle"></i> </a>

        @else
          <a class="btn btn-primary" value="Modifier" href="{{url('/borrows/'.$borrow->id.'/reborrow')}}"
          role="button" ><i class="fas fa-sync-alt"></i> </a>
          <a  class="btn btn-danger" value="Modifier" href="{{url('/borrows/'.$borrow->id.'/return')}}"
            role="button" disabled><i class="fas fa-times-circle"></i> </a>
        @endif
      </td>
    </tr>

   @endforeach
</table>
</div>
@stop

@section('_js_scaffold')
@stop
