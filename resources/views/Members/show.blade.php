

@extends('layouts.app')
@section('content')
<div class="container">
  <div class="form-group row">
    <h2 style="margin-left:40%;">{{$member->firstname}} {{$member->lastname}}</h2>
    @if($member->picture == "")
    <label class="col-md-12" >  <img src="{{asset('images/person.jpg')}}"  style= "margin-left:9%;height: 120px; width: 100px;"> </label>
    @else
    <label class="col-md-12">  <img src="{{asset($member->picture)}}" style= "margin-left:9%;height: 120px; width: 100px;"> </label>
    @endif
   <div class="form-group" style="margin-left:70%;margin-top:-60px;position:relative;">
     <a class="btn btn-outline-primary" value="Modifier" href="{{url('/members/'.$member->id.'/edit')}}"
       role="button" ><i class="fas fa-edit"></i> {{__('messages.Edit')}} </a>
       <a style="" class="btn btn-outline-secondary" href="{{url('/borrows/memberdetail/'.$member->id)}}">
           <i class="fas fa-book-reader"></i>  {{__('messages.Details')}} </a>

       <a class="btn btn-outline-success" value="Modifier" href="{{url('/members/generate-pdf/'.$member->id)}}"
         role="button" target="_blank" ><i class="fas fa-print"></i> {{__('messages.Print')}} </a>
   </div>

    </div>
  <div class="form-group row">
    <label class="col-md-12" style="margin-left:9%;">{{__('messages.MemberID')}}</label>
    <label class="col-md-12" style="font-size: 120%;font-weight: bold;margin-left:9%;"> {{$member->id}}</label>
  </div>
  <div class="form-group row">
    <label class="col-md-12" style="margin-left:9%;" style="margin-left:9%;">{{__('messages.Memberfirstname')}}</label>
    <label class="col-md-12" style="font-size: 120%;font-weight: bold;margin-left:9%;">{{$member->firstname}}</label>
  </div>
  <div class="form-group row">
    <label class="col-md-12" style="margin-left:9%;" style="margin-left:9%;">{{__('messages.Memberlastname')}}</label>
    <label class="col-md-12" style="font-size: 120%;font-weight: bold;margin-left:9%;margin-left:9%;">{{$member->lastname}}</label>
  </div>
  <div class="form-group row">
    <label class="col-md-12" style="margin-left:9%;" style="margin-left:9%;">{{__('messages.Memberbirthday')}}</label>
    <label class="col-md-12" style="font-size: 120%;font-weight: bold;margin-left:9%;margin-left:9%;">{{(
    Carbon\Carbon::parse($member->birthdate))->format('d/m/Y')}}</label>
  </div>
  <div class="form-group row">
    <label class="col-md-12" style="margin-left:9%;">{{__('messages.MemberCIN')}}</label>
    <label class="col-md-12" style="font-size: 120%;font-weight: bold;margin-left:9%;">{{$member->cin}}</label>
  </div>
  <div class="form-group row">
    <label class="col-md-12" style="margin-left:9%;">{{__('messages.MemberAdress')}}</label>
    <label class="col-md-12" style="font-size: 120%;font-weight: bold;margin-left:9%;">{{$member->adress}}</label>
  </div>
  <div class="form-group row">
    <label class="col-md-12" style="margin-left:9%;">{{__('messages.MemberEmail')}}</label>
    <label class="col-md-12" style="font-size: 120%;font-weight: bold;margin-left:9%;">{{$member->email}}</label>
  </div>
  <div class="form-group row">
    <label class="col-md-12" style="margin-left:9%;">{{__('messages.Memberphonenumber')}} </label>
    <label class="col-md-12" style="font-size: 120%;font-weight: bold;margin-left:9%;">{{$member->phonenumber}}</label>
  </div>
  <div class="form-group row">
    <label class="col-md-12" style="margin-left:9%;">{{__('messages.RegistrationDate')}} </label>
    <label class="col-md-12" style="font-size: 120%;font-weight: bold;margin-left:9%;">{{$member->created_at->format('d/m/Y')}}</label>
  </div>

</div>
@stop
