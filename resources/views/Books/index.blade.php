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

<h3 style="text-align:center;"> {{__('messages.BooksList')}} </h3>
<div class="container-fuild  col-lg-9 col-md-12 col-sm-12"style="margin: 2% auto;">
  @if(Session::has('message'))
<div class="alert alert-success" role="alert" style="margin:0 auto;width:35%;">
<p style="text-align:center;">{{ Session::get('message') }}  </p>
</div>
  @endif
  <a class="btn btn-primary" style="margin-left: 78%;" value="Modifier" href="{{url('/books/generate-pdf')}}"
    role="button" target="_blank" ><i class="fas fa-print"></i> {{__('messages.MembersPrint')}} </a>

  <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
     <i class="fas fa-plus-circle"></i> {{__('messages.Newtheme')}}
  </button>
<div class="form-gorup">
  <form method="get" action="{{url('books/filter')}}">
    <div class="input-group col-md-12" style="margin-top:1%;margin-left:-2%;margin-bottom:2%;">
      <label for="" class="col-md-2"> {{__('messages.Filterby')}}  : </label>
       <select id="inputState" name="theme" class="form-control col-md-2">
           <option  value="All">select a theme</option>
         @foreach($themes as $theme)
         @if($theme == Session::has('oldtheme'))

            <option selected>{{ $theme->description }}</option>
         @else
            <option>{{ $theme->description }}</option>
        @endif
         @endforeach
       </select>
       <div class="form-check col-md-1" style="margin-left:1%;">
        <input class="form-check-input" value="on"  name="exist[]"
        @if(is_array(old('exist')) && in_array("on", old('exist'))) checked @endif
       type="checkbox" id="gridCheck1">
        <label class="form-check-label" for="gridCheck1">
          {{__('messages.Exist')}}
        </label>
      </div>
      <button type="submit"  class="btn btn-primary col-md-1" >
         <i class="fas fa-search"></i> Filter
      </button>
     </div>
</form>
</div>
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">{{__('messages.Addanewtheme')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{url('books/theme')}}">
      <div class="modal-body">

          {{ csrf_field() }}
          <div class="form-group row">
          <label for="inputPassword" class="col-sm-2 col-form-label">{{__('messages.ThemeTitle')}} :</label>
          <div class="col-sm-10">
            <!-- @if($errors->has('title')) has-error @endif -->
            <input type="text" class="form-control @if($errors->has('description')) is-invalid @endif" id="description" name="description" placeholder="Entrer the description"
            value="{{old('description')}}" >
            <!-- @if ($errors->has('title'))
            <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
               {{ $errors->first('title') }}</p>
           @endif -->
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save </button>
      </div>
      </form>

    </div>
  </div>
</div>

<!-- Edit Moda -->
<table id="booksTable" class="table table-striped" >
   <thead>
      <th >ID</th>
      <th id="title"> {{__('messages.Title')}}</th>
      <th id="author">{{__('messages.Author')}}</th>
      <th id="theme">{{__('messages.Theme')}} </th>
      <th>{{__('messages.Status')}}</th>
      <th>{{__('messages.Action')}}</th>
   </thead>
   @foreach($books as $book)
    <tr>
      <td>{{$book->id}}</td>
      <td id="title">{{$book->title}}</td>
      <td id="author">{{$book->author}}</td>
      <td id="theme">{{$book->theme->description}}</td>
      <td>
        @if($book->status==1)
        <span class="badge badge-success">{{__('messages.Existed')}}</span>

        @else
        <span class="badge badge-danger">{{__('messages.Borrowed')}}</span>
        @endif
      </td>

      <td>
        <script type="text/javascript">
        $(document).ready(function (e) {
          $(document).on("click", "#btn_delete", function (e) {
              var delete_id = $(this).attr('data-value');
              $('#id_delete').val(delete_id);
          });
        });
        </script>

       <a class="btn btn-primary" value="Modifier" href="{{url('/books/'.$book->id.'/edit')}}"
          role="button" ><i class="fas fa-edit"></i> </a>
       <a class="btn btn-success" value="Détail" href="{{url('/books/'.$book->id.'/show')}}"> <i class="far fa-eye"></i>   </a>
       <a style="color:white;" class="btn btn-secondary" href="{{url('/borrows/bookdetail/'.$book->id)}}">
           <i class="fas fa-book-reader"></i>   </a>
       <a style="color:white;" class="btn btn-danger" data-toggle="modal" id="btn_delete" data-value="{{$book->id}}"
       data-target="#exampleModal"> <i class="fas fa-trash-alt"></i>   </a>
       <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="{{url('/books/'.$book->id)}}" method="post">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
      <input type="hidden" name="id_delete" id="id_delete" value="">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <p> Do you want  delete {{$book->title}} ?  </p>

      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit" value="supprimer"> Confirme </button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
      </form>
    </div>
  </div>
</div>



      </td>
   </tr>
   @endforeach
</table>
</div>
@stop

@section('_js_scaffold')
@stop
