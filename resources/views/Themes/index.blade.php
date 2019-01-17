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
<style type="text/css">



	.modal-confirm {
		color: #636363;
		width: 325px;
	}
	.modal-confirm .modal-content {
		padding: 20px;
		border-radius: 5px;
		border: none;
	}
	.modal-confirm .modal-header {
		border-bottom: none;
        position: relative;
	}
	.modal-confirm h4 {
		text-align: center;
		font-size: 26px;
		margin: 30px 0 -15px;
	}
	.modal-confirm .form-control, .modal-confirm .btn {
		min-height: 40px;
		border-radius: 3px;
	}
	.modal-confirm .close {
        position: absolute;
		top: -5px;
		right: -5px;
	}
	.modal-confirm .modal-footer {
		border: none;
		text-align: center;
		border-radius: 5px;
		font-size: 13px;
	}
	.modal-confirm .icon-box {
		color: #fff;
		position: absolute;
		margin: 0 auto;
		left: 0;
		right: 0;
		top: -70px;
		width: 95px;
		height: 95px;
		border-radius: 50%;
		z-index: 9;
		background: #82ce34;
		padding: 15px;
		text-align: center;
		box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
	}
	.modal-confirm .icon-box i {
		font-size: 58px;
		position: relative;
		top: 3px;
	}
	.modal-confirm.modal-dialog {
		margin-top: 80px;
	}
    .modal-confirm .btn {
        color: #fff;
        border-radius: 4px;
		background: #82ce34;
		text-decoration: none;
		transition: all 0.4s;
        line-height: normal;
        border: none;
    }
	.modal-confirm .btn:hover, .modal-confirm .btn:focus {
		background: #6fb32b;
		outline: none;
	}
	.trigger-btn {
		display: inline-block;
		margin: 100px auto;
	}
</style>
<h3 style="text-align:center;">  {{__('messages.Themes_management')}}  </h3>
<div class="container-fuild  col-lg-9 col-md-12 col-sm-12"style="margin: 2% auto;">
  @if(Session::has('message'))
<div class="alert alert-success" role="alert" style="margin:0 auto;width:35%;">
<p style="text-align:center;">{{ Session::get('message') }}  </p>
</div>
  @endif
  <div class="container">
    <div class="table-wrapper">
  <div class="table-title">
      <div class="row">
      <div class="col-sm-6">

       </div>
       <div class="col-sm-6">
         <a style="color:white;" id="btn_new_theme" class="btn btn-primary" data-toggle="modal"
         data-target="#exampleModalAdd"><i class="fas fa-plus-circle"></i>  {{__('messages.Newtheme')}}</a>

         <a style="color:white;" id="btn_delete_check_" class="btn btn-danger"> <i class="fas fa-trash-alt"></i> Delete  </a>

        </div>
      </div>
     </div>

  <div class="form-row">
   <div class="form-group col-md-3">
        <div style="margin-top:10%;" class="modal fade" id="exampleModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLongTitle"> {{__('messages.Addanewtheme')}}</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <!-- <form method="post" id="form_new_theme" action="{{url('themes/store')}}"> -->
           <div class="modal-body">

               {{ csrf_field() }}
               <div class="form-group row">
               <label for="inputPassword" class="col-sm-2 col-form-label">{{__('messages.ThemeTitle')}} :</label>
               <div class="col-sm-10">
                 <!-- @if($errors->has('title')) has-error @endif -->
                 <input type="text" class="form-control @if($errors->has('description')) is-invalid @endif" id="new_theme" name="description" placeholder="Entrer the description"
                 value="{{old('description')}}" >
                  <label id="empty">Enter a theme description !</label>
                  <label id="exist">This theme exists already !</label>
                 <!-- @if ($errors->has('title'))
                 <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    {{ $errors->first('title') }}</p>
                @endif -->
               </div>
             </div>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             <button type="button" id="btn_submit" class="btn btn-primary">Save </button>
           </div>
           <!-- </form> -->

         </div>
       </div>
     </div>

   </div>

 </div>

<!-- Edit Moda -->
<table id="booksTable" class="table table-striped">
   <thead>
      <td>#</td>
      <th> {{__('messages.MemberID')}} </th>
      <th> {{__('messages.Theme')}} </th>
      <th> {{__('messages.MemberAction')}} </th>

   </thead>
   <tbody>
      @foreach($themes as $theme)
    <tr>
      <td><input type="checkbox" name="theme_check[]" value="{{$theme->id}}"> </td>
      <td>{{$theme->id}}</td>
      <td>{{$theme->description}}</td>
      <td>
            <a style="color:white;" id="btnupdate" class="btn btn-primary" data-toggle="modal" data-value="{{$theme->description}}"
            data-target="#exampleModalUpdate"> <i class="fas fa-edit"></i></a>
            <a style="color:white;" id="theme_id" data-value="{{$theme->id}}"> </a>
            <a style="color:white;" id="btndelete" class="btn btn-danger" data-toggle="modal" data-value="{{$theme->id}}"
            data-target="#exampleModalDelete"> <i class="fas fa-trash-alt"></i>   </a>
     </td>
    </tr>
   @endforeach
   </tbody>
</table>
</div>
</div>
</div>



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
                      <input type="text" class="form-control @if($errors->has('description')) is-invalid @endif"  id="old_theme" name="new_theme" placeholder="Entrer the description"
                      value="{{old('description')}}" >
                      <label id="empty_">Enter a theme description !</label>
                      <label id="exist_">This theme exists already !</label>
                      <label id="Changing_new_">Enter a new theme different from the old !</label>
                      <!-- @if ($errors->has('title'))
                      <p style="color:red;"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                         {{ $errors->first('title') }}</p>
                     @endif -->
                    </div>
                  </div>
                </div>
                  <div class="modal-footer">
                    <button class="btn btn-primary" type="button" id="btn_theme_edit" value="supprimer"> Confirme </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Delete Modal  -->
            <div style="margin-top:10%;" class="modal fade" id="exampleModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalDelete" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- <form action="{{url('/themes/destroy')}}" method="post"> -->
                      {{ csrf_field() }}
                      <!-- {{ method_field('DELETE') }} -->
                      <input type="hidden" name="iddelete" id="iddelete" value="">
                      <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    @if(Session::get('locale')=='fr')
                      <strong style="align:center;"> Veux-tu supprimer cette thème ? </strong>

                    @else
                    <strong style="align:center;"> Do you want delete this theme ?  </strong>
                    @endif


                    </div>
                  <div class="modal-footer">
                    <button class="btn btn-primary" type="button" id="confirm_delete" value="supprimer"> Confirme </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                  <!-- </form> -->
                </div>
              </div>
            </div>

            <!-- Delete multiple -->
            <div style="margin-top:10%;" class="modal fade" id="exampleModalMultipleDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalDelete" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- <form action="{{url('/themes/destroy')}}" method="post"> -->
                      {{ csrf_field() }}
                      <!-- {{ method_field('DELETE') }} -->
                      <input type="hidden" name="iddelete" id="iddelete" value="">
                      <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    @if(Session::get('locale')=='fr')
                      <strong style="align:center;"> Veux-tu supprimer cette thème ? </strong>

                    @else
                    <strong style="align:center;"> Do you want delete this theme ?  </strong>
                    @endif


                    </div>
                  <div class="modal-footer">
                    <button class="btn btn-primary" type="button" id="confirm_multiple_delete" value="supprimer"> Confirme </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                  <!-- </form> -->
                </div>
              </div>
            </div>

            <!-- Confirmation Message  -->
            <div id="Modal-Confirmation-Message" class="modal fade">
              	<div class="modal-dialog modal-confirm">
              		<div class="modal-content">
              			<div class="modal-header">
              				<div class="icon-box">
              					<i class="fas fa-check-circle"></i>
              				</div>
              				<h4 class="modal-title" style="text-align: center;">Awesome!</h4>
              			</div>
              			<div class="modal-body">
                      @if(Session::get('locale')=='fr')
                      <p class="text-center"  <strong> Opération accomplie avec succès. </strong>/p>

                      @else
                    <p class="text-center"  <strong> Operation accomplished successfully. </strong></p>
                      @endif
              			</div>
              			<div class="modal-footer">
              				<button class="btn btn-success btn-block" data-dismiss="modal">OK</button>
              			</div>
              		</div>
              	</div>
              </div>
            <div class="container">
             <div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body row">
                  <div class="alert alert-success container" role="alert" style="text-align:center;">
                  @if(Session::get('locale')=='fr')
                    <strong> Opération accomplie avec succès </strong>

                  @else
                  <strong> Operation accomplished successfully </strong>
                  @endif

                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
                </div>
              </div>
            </div>
          </div>
          </div>

            <script type="text/javascript">

                $("#empty").css("color","red");
                $("#exist").css("color","red");
                $("#empty").css("display","none");
                $("#exist").css("display","none");

                $("#empty_").css("color","red");
                $("#exist_").css("color","red");
                $("#Changing_new_").css("color","red");
                $("#empty_").css("display","none");
                $("#exist_").css("display","none");
                $("#Changing_new_").css("display","none");

                $('#btn_new_theme').on('click', function(e) {
                e.preventDefault();
                $("#new_theme").val("")
                $("#empty").css("display","none");
                $("#exist").css("display","none");
                $("#new_theme").css("border-color","#ced4da");
              });

             $('#btn_submit').on('click', function(e) {

              e.preventDefault();
              var _token = $('input[name="_token"]').val();
              var new_theme_description = $("#new_theme").val();
              var re = new RegExp("^([a-zA-Z]{2,})$");
               if(!re.test(new_theme_description) || new_theme_description == ""){
                 $("#empty").css("display","block");
                 $("#new_theme").css("border-color","red");
               }
               else {
                  $("#empty").css("display","none");
                  $("#exist").css("display","none");
                 $.ajax({
                   url:"{{ route('find_theme') }}",
                   method:"POST",
                   data:{theme_description:new_theme_description, _token:_token},
                   success:function(message)
                   {
                     if (message != "0") {
                       $("#exist").css("display","block");
                       $("#empty").css("display","none");
                       $("#new_theme").css("border-color","red");
                     }
                     else {
                       $.ajax({
                         url:"{{ route('themeStore') }}",
                         method:"POST",
                         data:{description:new_theme_description, _token:_token},
                         success:function(message)
                         {
                           $("table tbody").html(message);
                           $("#exampleModalAdd").modal("toggle");
                           $("#Modal-Confirmation-Message").modal("toggle");
                             setTimeout(function(){$('#Modal-Confirmation-Message').modal('toggle')},3000);
                         }
                        })
                     }
                   }
                  })
               }


          });
          // button Edit
          $(document).on("click", "#btnupdate", function (e) {

            e.preventDefault();
            $("#empty_").css("display","none");
            $("#exist_").css("display","none");
            $("#Changing_new_").css("display","none");
            $("#old_theme").css("border-color","#ced4da");
            var update_id = $(this).attr('data-value');
            $('#old_theme').val(update_id);
            $('#idupdate').val(update_id);


              var update_id = $(this).attr('data-value');
              $('#old_theme').val(update_id);
            });
          //Edit Theme
         $('#btn_theme_edit').on('click', function(e) {

          e.preventDefault();

          var _token = $('input[name="_token"]').val();
          var new_theme_description = $("#old_theme").val();

          var new_theme  = $('#old_theme').val();
          var old_theme = $('#idupdate').val();
          var re = new RegExp("^([a-zA-Z]{2,})$");
           if(!re.test(new_theme_description) || new_theme_description == ""){
             $("#empty_").css("display","block");
             $("#old_theme").css("border-color","red");
             $("#Changing_new_").css("display","none");
           }
           else if (new_theme == old_theme) {
            $("#Changing_new_").css("display","block");
            $("#old_theme").css("border-color","red");
           }
           else{
              $("#empty_").css("display","none");
             $.ajax({
               url:"{{ route('find_theme') }}",
               method:"POST",
               data:{theme_description:new_theme_description, _token:_token},
               success:function(message)
               {
                 if (message != "0") {
                   $("#exist_").css("display","block");
                   $("#old_theme").css("border-color","red");
                 }
                 else {

                   $.ajax({
                     url:"{{ route('themeUpdate') }}",
                     method:"POST",
                     data:{old_theme:old_theme,new_theme:new_theme, _token:_token},
                     success:function(message)
                     {
                       $("table tbody").html(message);
                       $("#exampleModalUpdate").modal("toggle");
                       $("#Modal-Confirmation-Message").modal("toggle");
                         setTimeout(function(){$('#Modal-Confirmation-Message').modal('toggle')},3000);
                     }
                    })
                 }
               }
              })
           }


      });

      $(document).ready(function (e) {
        // e.preventDefault();
        $(document).on("click", "#btndelete", function (e) {
          // e.preventDefault();
            var delete_id = $(this).attr('data-value');
            var _token = $('input[name="_token"]').val();
               // $('#iddelete').val(delete_id);
              $(document).on("click","#confirm_delete",function (){
                console.log(delete_id+" "+_token);
                $.ajax({
                  url:"{{ route('themeDestroy') }}",
                  method:"POST",
                  data:{delete_id:delete_id, _token:_token},
                  success:function(message)
                  {
                    $("table tbody").html(message);
                    $("#exampleModalDelete").modal("toggle");
                    $("#Modal-Confirmation-Message").modal("toggle");
                      setTimeout(function(){$('#Modal-Confirmation-Message').modal('toggle')},3000);
                  }
                 })
              });
            });
      });

    $(document).ready(function (e) {


      $(document).on("click", "#btn_delete_check_", function (e) {
        var id = [];


        $("#exampleModalMultipleDelete").modal("toggle");
        $(document).on("click", "#confirm_multiple_delete", function (e) {
          $(':checkbox:checked').each(function(){

              id.push($(this).val());
          });
          if(id.length > 0)
          {
           var _token = $('input[name="_token"]').val();
           $.ajax({
             url:"{{ route('themeDestroy') }}",
             method:"POST",
             data:{delete_id:id, _token:_token},
             success:function(message)
             {
               console.log(message);
               $("table tbody").html(message);
               $("#exampleModalMultipleDelete").modal("toggle");
               $("#Modal-Confirmation-Message").modal("toggle");
                 setTimeout(function(){$('#Modal-Confirmation-Message').modal('toggle')},3000);
             }
            })
          }
          else
          {
              alert("Please select atleast one checkbox");
          }
        });
      });
    });

    </script>

@stop

@section('_js_scaffold')
@stop
