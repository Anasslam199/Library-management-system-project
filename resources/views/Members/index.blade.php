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

<h3 style="text-align:center;">  {{__('messages.MembersList')}}  </h3>
<a class="btn btn-primary" style="margin-left: 78%;" value="Modifier" href="{{url('/members/generate-pdf')}}"
  role="button" target="_blank" ><i class="fas fa-print"></i> {{__('messages.MembersPrint')}} </a>
<div class="container-fuild  col-lg-9 col-md-12 col-sm-12"style="margin: 2% auto;">
  @if(Session::has('message'))
<div class="alert alert-success" role="alert" style="margin:0 auto;width:35%;">
<p style="text-align:center;">{{ Session::get('message') }}  </p>
</div>
  @endif
<!-- Edit Moda -->
<table id="booksTable" class="table table-striped" >
   <thead>
      <th> {{__('messages.MemberID')}} </th>
      <th id="picture"> {{__('messages.MemberImage')}} </th>
      <th> {{__('messages.MemberName')}}  </th>
      <!-- <th id="author">Birthdate</th> -->
      <th id="cin">{{__('messages.MemberCIN')}} </th>
      <th> {{__('messages.MemberPhonenumber')}} </th>
      <th id="email">{{__('messages.MemberDeposit')}} </th>
      <th>{{__('messages.MemberAction')}} </th>
   </thead>
   @foreach($members as $member)
    <tr>
      <td>{{$member->id}}</td>
      @if($member->picture == "")
      <td> <img src="{{asset('images/person.jpg')}}" style= "height: 80px; width: 60px;"></td>
      @else
      <td> <img src="{{asset($member->picture)}}" style= "height: 80px; width: 60px;"></td>
      @endif

      <td id="">{{$member->firstname}} {{$member->lastname}}</td>
      <!-- <td id="author">{{$member->birthdate}}</td> -->
      <td id="cin">{{$member->cin}}</td>
      <td id="">{{$member->phonenumber}}</td>
      <td id="email">
         @if($member->deposit)
         <span class="badge badge-success">Yes</span>

         @else
         <span class="badge badge-danger">No</span>
         @endif
       </td>
      <td>
            <a class="btn btn-primary" value="Modifier" href="{{url('/members/'.$member->id.'/edit')}}"
              role="button" ><i class="fas fa-edit"></i> </a>
            <a class="btn btn-success" value="Détail" href="{{url('/members/'.$member->id.'/show')}}"> <i class="far fa-eye"></i>   </a>
            @if($member->deposit)
            <a style="color:white;" class="btn btn-secondary " href="{{url('/borrows/memberdetail/'.$member->id)}}">
                <i class="fas fa-book-reader"></i>   </a>
            @else
            <a style="pointer-events: none; cursor: default;" class="btn btn-secondary disabled" href="{{url('/borrows/memberdetail/'.$member->id)}}">
                <i class="fas fa-book-reader"></i>   </a>
            @endif
            <a style="color:white;" id="btndelete" class="btn btn-danger" data-toggle="modal"
            data-value="{{$member->id}}"
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
                    <form action="{{url('/members/'.$member->id)}}" method="post">
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
                      <p> {{__('messages.Deleteconfirm')}} ?  </p>
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
