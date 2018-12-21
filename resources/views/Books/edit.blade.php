@extends('layouts.app')
@section('content')
<div class="container">
<h2 style="text-align:center;">  {{__('messages.Editabook')}}  </h2>


<form method="post" action="{{url('books/'.$book->id)}}">
  {{ csrf_field() }}
  <input name="_method" type="hidden" value="PUT">
  <div class="form-group row">
  <label for="inputPassword" class="col-sm-2 col-form-label"> {{__('messages.BookTitle')}} </label>
  <div class="col-sm-10">
    <!-- @if($errors->has('title')) has-error @endif -->
    <input type="text" class="form-control @if($errors->has('title')) is-invalid @endif" id="title" name="title" placeholder="Entrer the title"
    value="{{$book->title}}" >
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
    value="{{$book->author}}">
    @if ($errors->has('author'))
    <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
       {{ $errors->first('author') }}</p>
   @endif
  </div>
</div>
<div class="form-group row">
  <label for="inputPassword" class="col-sm-2 col-form-label">{{__('messages.BookTheme')}}</label>
  <div class="col-sm-10">

    <select class="form-control  @if($errors->has('theme')) is-invalid @endif" id="theme" name="theme">
      @foreach($themes as $them)
      @if ($them->id == $book->theme_id)
      <option value="{{ $them->id }}" selected>{{ $them->description }}</option>
    @else
          <option value="{{ $them->id }}">{{ $them->description }}</option>
    @endif
      @endforeach
    </select>

    @if ($errors->has('theme'))
    <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
       {{ $errors->first('theme') }}</p>
   @endif
  </div>

</div>
<div class="form-group row">
  <label for="inputPassword" class="col-sm-2 col-form-label">{{__('messages.BookDescription')}}</label>
  <div class="col-sm-10">
    <textarea type="text" class="form-control @if($errors->has('description')) is-invalid @endif" id="description" name="description"
    placeholder="Description book">{{$book->description}}</textarea>
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
