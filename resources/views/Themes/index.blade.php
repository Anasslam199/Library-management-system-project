@extends('layouts.app')

@section('content')
<!--datatables css --->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css"> -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.18/r-2.2.2/datatables.min.css"/> -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<style media="screen">
  tr{
    text-align: center;
    padding: 0 auto,
  }

@media screen and (max-width:768px){
  #cin{ display: none;}
  #email{display: none;}
  #picture {
    width: 40px;
    height: 60px;
  }
}
#title{
  width: 20%;
}
</style>

<h3 style="text-align:center;">  {{__('messages.Themes_management')}}  </h3>
<div class="container-fuild  col-lg-9 col-md-12 col-sm-12"style="margin: 2% auto;">
  @if(Session::has('message'))
<div class="alert alert-success" role="alert" style="margin:0 auto;width:35%;">
<p style="text-align:center;">{{ Session::get('message') }}  </p>
</div>
  @endif
  <div class="form-row">
   <div class="form-group col-md-3">
     <a style="color:white;" id="btnupdate" class="btn btn-primary" data-toggle="modal"
     data-target="#exampleModalAdd"><i class="fas fa-plus-circle"></i>  {{__('messages.Newtheme')}}</a>

     <div style="margin-top:10%;" class="modal fade" id="exampleModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLongTitle"> {{__('messages.Addanewtheme')}}</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <form method="post" action="{{url('themes/store')}}">
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

   </div>

 </div>

<!-- Edit Moda -->
<table id="booksTable" class="table table-striped">
   <thead>
      <th> {{__('messages.MemberID')}} </th>
      <th> {{__('messages.Theme')}} </th>
      <th> {{__('messages.MemberAction')}} </th>
   </thead>
   @foreach($themes as $theme)
    <tr>
      <td>{{$theme->id}}</td>
      <td>{{$theme->description}}</td>
      <td>

            <a style="color:white;" id="btnupdate" class="btn btn-primary" data-toggle="modal" data-value="{{$theme->description}}"
            data-target="#exampleModalUpdate"> <i class="fas fa-edit"></i></a>
            <a style="color:white;" id="theme_id" data-value="{{$theme->id}}"> </a>

            <script type="text/javascript">
            $(document).ready(function (e) {
              $(document).on("click", "#btnupdate", function (e) {
                  var update_id = $(this).attr('data-value');
                  $('#idupdate').val(update_id);
                  $('#new_theme').val(update_id);

                  // var theme_id = $("#theme_id").attr('data-value');
                  // $('#theme_id').val(theme_id);
              });
            });
            </script>

            <div style="margin-top:10%;" class="modal fade" id="exampleModalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{url('/themes/update')}}" method="post">
                      {{ csrf_field() }}
                      <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">{{__('messages.ThemeTitle')}} :</label>
                    <div class="col-sm-10">
                      <!-- @if($errors->has('title')) has-error @endif -->
                      <input type="hidden" name="idupdate" id="idupdate" value="">
                      <input type="text" class="form-control @if($errors->has('description')) is-invalid @endif"  id="new_theme" name="new_theme" placeholder="Entrer the description"
                      value="{{old('description')}}" >
                      <!-- @if ($errors->has('title'))
                      <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                         {{ $errors->first('title') }}</p>
                     @endif -->
                    </div>
                  </div>
                </div>
                  <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" value="supprimer"> Confirme </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>


            <a style="color:white;" id="btndelete" class="btn btn-danger" data-toggle="modal" data-value="{{$theme->id}}"
            data-target="#exampleModal"> <i class="fas fa-trash-alt"></i>   </a>
            <script type="text/javascript">
            $(document).ready(function (e) {
              $(document).on("click", "#btndelete", function (e) {
                  var delete_id = $(this).attr('data-value');
                  $('#iddelete').val(delete_id);
              });
            });
            </script>
            <div style="margin-top:10%;" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="{{url('/themes/destroy')}}" method="post">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <input type="hidden" name="iddelete" id="iddelete" value="">
                      <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      <p> {{$theme->description}} ?  </p>
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
