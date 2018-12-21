@extends('layouts.app')
@section('content')
<div class="container">
<h2 style="text-align:center;">   {{__('messages.Addanewmember')}}   </h2>


<form method="post" action="{{url('members')}}" enctype="multipart/form-data">
  {{ csrf_field() }}
 <!-- firstname -->
  <div class="form-group row">
  <label for="inputPassword" class="col-sm-2 col-form-label">{{__('messages.Memberfirstname')}} : </label>
  <div class="col-sm-10">
    <!-- @if($errors->has('title')) has-error @endif -->
    <input type="text" class="form-control @if($errors->has('firstname')) is-invalid @endif" id="firstname"
    name="firstname" placeholder="Entrer the firstname"
    value="{{old('firstname')}}" >
    @if ($errors->has('firstname'))
    <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
       {{ $errors->first('firstname') }}</p>
   @endif
  </div>
</div>
 <!-- lastname -->
<div class="form-group row">
  <label for="inputPassword" class="col-sm-2 col-form-label ">{{__('messages.Memberlastname')}} : </label>
  <div class="col-sm-10">
    <input type="text" class="form-control @if($errors->has('lastname')) is-invalid @endif"
    id="lastname" name="lastname" placeholder="Entrer the lastname"
    value="{{old('lastname')}}">
    @if ($errors->has('lastname'))
    <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
       {{ $errors->first('lastname') }}</p>
   @endif
  </div>
</div>

<!-- lastname -->
<div class="form-group row">
 <label for="inputPassword" class="col-sm-2 col-form-label ">{{__('messages.Memberphonenumber')}} : </label>
 <div class="col-sm-10">
   <input type="text" class="form-control @if($errors->has('phonenumber')) is-invalid @endif"
   id="phonenumber" name="phonenumber" placeholder="Entrer the lastname"
   value="{{old('phonenumber')}}">
   @if ($errors->has('phonenumber'))
   <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
      {{ $errors->first('phonenumber') }}</p>
  @endif
 </div>
</div>

<!-- birthdate -->
<div class="form-group row">
  <label for="inputPassword" class="col-sm-2 col-form-label "> {{__('messages.Memberbirthday')}} : </label>
  <div class="col-sm-10">
    <input type="date" class="form-control @if($errors->has('birthdate')) is-invalid @endif"
    id="birthdate" name="birthdate" placeholder="Entrer the lastname"
    value="{{old('birthdate')}}">
    @if ($errors->has('birthdate'))
    <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
       {{ $errors->first('birthdate') }}</p>
   @endif
  </div>
</div>


<!-- cin -->
<div class="form-group row">
  <label for="inputPassword" class="col-sm-2 col-form-label "> {{__('messages.MemberCIN')}} : </label>
  <div class="col-sm-10">
    <input type="text" class="form-control @if($errors->has('cin')) is-invalid @endif"
    id="cin" name="cin" placeholder="Entrer the cin"
    value="{{old('cin')}}">
    @if ($errors->has('cin'))
    <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
       {{ $errors->first('cin') }}</p>
   @endif
  </div>
</div>
<!-- email -->
<div class="form-group row">
  <label for="inputPassword" class="col-sm-2 col-form-label "> {{__('messages.MemberEmail')}} : </label>
  <div class="col-sm-10">
    <input type="text" class="form-control @if($errors->has('email')) is-invalid @endif"
    id="email" name="email" placeholder="Entrer the email"
    value="{{old('email')}}">
    @if ($errors->has('email'))
    <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
       {{ $errors->first('email') }}</p>
   @endif
  </div>
</div>

<!-- email -->
<div class="form-group row">
  <label for="inputPassword" class="col-sm-2 col-form-label "> {{__('messages.MemberAdress')}} : </label>
  <div class="col-sm-10">
    <input type="text" class="form-control @if($errors->has('adress')) is-invalid @endif"
    id="adress" name="adress" placeholder="Entrer the adress"
    value="{{old('adress')}}">
    @if ($errors->has('adress'))
    <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
       {{ $errors->first('adress') }}</p>
   @endif
  </div>
</div>
<!-- Picture -->
<div class="form-group row">
  <label for="inputPassword" class="col-sm-2 col-form-label "> {{__('messages.MemberImage')}} : </label>
  <div class="col-sm-10">
   <input type="file"  class="form-control @if($errors->has('picture')) is-invalid @endif" id="picture" name="picture"
   placeholder="picture"
   value="{{old('picture')}}">
   @if ($errors->has('picture'))
   <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
      {{ $errors->first('picture') }}</p>
  @endif
  </div>

</div>
<div class="form-group row">
  <label for="inputPassword" class="col-sm-2 col-form-label">{{__('messages.MemberDeposit')}} :</label>
  <div class="col-sm-10">

    <select class="form-control  @if($errors->has('deposit')) is-invalid @endif" id="deposit" name="deposit">

      <option value="0" @if (old('deposit') == "0") {{ 'selected' }} @endif>{{__('messages.MemberDepositNO')}}</option>
      <option value="1" @if (old('deposit') == "1") {{ 'selected' }} @endif>{{__('messages.MemberDepositYES')}}</option>
    </select>

    @if ($errors->has('deposit'))
    <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
       {{ $errors->first('deposit') }}</p>
   @endif
  </div>

</div>



<div class="form-group row">
  <label for="inputPassword" class="col-sm-6 col-md-6 col-lg-9 col-form-label"> </label>
  <div class="col-sm-6 col-md-6 col-lg-3">
    <button type="submit" class="btn btn-outline-primary btn-lg ">{{__('messages.MemberSave')}}</button>
    <button type="button" class="btn btn-secondary btn-lg active">{{__('messages.MemberClose')}}</button>
  </div>
</div>

</form>
</div>
@stop
