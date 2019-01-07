@extends('layouts.app')
@section('content')
<div class="container">
<h2 style="text-align:center;">  {{__('messages.Addanewbook')}}  </h2>

<form method="post" action="{{url('books')}}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="form-group row">
  <label for="inputPassword" class="col-sm-2 col-form-label">{{__('messages.BookTitle')}} : </label>
  <div class="col-sm-10">
    <!-- @if($errors->has('title')) has-error @endif -->
    <input type="text" class="form-control @if($errors->has('title')) is-invalid @endif" id="title" name="title" placeholder="Entrer the title"
    value="{{old('title')}}" >
    @if ($errors->has('title'))
    <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
       {{ $errors->first('title') }}</p>
   @endif
  </div>
</div>
<div class="form-group row">
  <label for="inputPassword" class="col-sm-2 col-form-label ">{{__('messages.BookAuthor')}} </label>
  <div class="col-sm-10">
    <input type="text" class="form-control @if($errors->has('author')) is-invalid @endif" id="author" name="author" placeholder="Entrer the author"
    value="{{old('author')}}">
    @if ($errors->has('author'))
    <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
       {{ $errors->first('author') }}</p>
   @endif
  </div>
</div>
<div class="form-group row">
<label for="inputPassword" class="col-sm-2 col-form-label">{{__('messages.Publishing_house')}} : </label>
<div class="col-sm-10">
  <!-- @if($errors->has('title')) has-error @endif -->
  <input type="text" class="form-control @if($errors->has('title')) is-invalid @endif" id="publishing_house" name="publishing_house" placeholder="Entrer the publishing_house"
  value="{{old('publishing_house')}}" >
  @if ($errors->has('publishing_house'))
  <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
     {{ $errors->first('publishing_house') }}</p>
 @endif
</div>
</div>
<div class="form-group row">
  <label for="inputPassword" class="col-sm-2 col-form-label">{{__('messages.BookTheme')}}</label>
  <div class="col-sm-10">

    <select class="form-control  @if($errors->has('theme')) is-invalid @endif" id="theme" name="theme">
      @foreach($themes as $theme)
      <option value="{{$theme->id}}">
        {{$theme->description}}</option>
      @endforeach
    </select>

    @if ($errors->has('theme'))
    <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
       {{ $errors->first('theme') }}</p>
   @endif
  </div>

</div>
<div class="form-group row">
  <label for="inputPassword" class="col-sm-2 col-form-label "> {{__('messages.Cover')}} : </label>
  <div class="col-sm-10">
   <input type="file"  class="form-control @if($errors->has('cover')) is-invalid @endif" id="" name="cover"
   placeholder="cover"
   value="{{old('cover')}}">
   @if ($errors->has('cover'))
   <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
      {{ $errors->first('cover') }}</p>
  @endif
  </div>

</div>
<div class="form-group row">
  <label for="inputPassword" class="col-sm-2 col-form-label "> {{__('messages.Number')}} : </label>
  <div class="col-sm-10">
   <input type="number"  class="form-control @if($errors->has('number')) is-invalid @endif" id="" name="number"
   placeholder="number"
   value="{{old('number')}}">
   @if ($errors->has('number'))
   <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
      {{ $errors->first('number') }}</p>
  @endif
  </div>

</div>
<!-- Thme -->
<div class="form-group row">
  <label for="inputPassword" class="col-sm-2 col-form-label">{{__('messages.BookDescription')}}</label>
  <div class="col-sm-10">
    <textarea type="text" class="form-control @if($errors->has('description')) is-invalid @endif" id="description" name="description"
    placeholder="Description book">{{old('description')}}</textarea>
    @if ($errors->has('description'))
    <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
       {{ $errors->first('description') }}</p>
   @endif
  </div>
</div>
<div class="form-group row">
  <label for="inputPassword" class="col-sm-6 col-md-6 col-lg-9 col-form-label"> </label>
  <div class="col-sm-6 col-md-6 col-lg-3">
    <button type="submit" class="btn btn-outline-primary btn-lg ">{{__('messages.Save')}}</button>
    <button type="button" class="btn btn-secondary btn-lg active">{{__('messages.Close')}}</button>
  </div>
</div>

</form>
</div>
@stop
