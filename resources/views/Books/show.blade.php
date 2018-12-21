@extends('layouts.app')
@section('content')
<div class="container">
  <div class="form-group row">
    <h2 style="margin-left:40%;">{{$book->title}}</h2>

    <div class="form-group" style="margin-left:70%;margin-top:0px;position:relative;">
      <a class="btn btn-outline-primary" value="Modifier" href="{{url('/books/'.$book->id.'/edit')}}"
        role="button" ><i class="fas fa-edit"></i> {{__('messages.Edit')}}</a>
        <a style="" class="btn btn-outline-secondary" href="{{url('/borrows/bookdetail/'.$book->id)}}">
            <i class="fas fa-book-reader"></i>  {{__('messages.Details')}} </a>

    </div>

    </div>
    <div class="form-group row">
      <label class="col-md-12" style="margin-left:9%;">{{__('messages.MemberID')}}</label>
      <label class="col-md-12" style="font-size: 120%;font-weight: bold;margin-left:9%;"> {{$book->id}}</label>
    </div>

  <div class="form-group row">
    <label class="col-md-12" style="margin-left:9%;">{{__('messages.Author')}}</label>
    <label class="col-md-12" style="font-size: 120%;font-weight: bold;margin-left:9%;"> {{$book->author}}</label>
  </div>
  <div class="form-group row">
    <label class="col-md-12" style="margin-left:9%;" style="margin-left:9%;">{{__('messages.BookTitle')}}</label>
    <label class="col-md-12" style="font-size: 120%;font-weight: bold;margin-left:9%;">{{$book->price}}</label>
  </div>
  <div class="form-group row">
    <label class="col-md-12" style="margin-left:9%;" style="margin-left:9%;">{{__('messages.BookTheme')}}</label>
    <label class="col-md-12" style="font-size: 120%;font-weight: bold;margin-left:9%;margin-left:9%;">{{$book->theme->description}}</label>
  </div>
  <div class="form-group row">
    <label class="col-md-12" style="margin-left:9%;" style="margin-left:9%;">{{__('messages.BookDescription')}}</label>
    <label class="col-md-12" style="font-size: 120%;font-weight: bold;margin-left:9%;margin-left:9%;">{{$book->description}}</label>
  </div>

</div>
@stop
