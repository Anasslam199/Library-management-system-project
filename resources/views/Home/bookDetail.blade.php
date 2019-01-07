@extends('layouts.app3')
@section('content')

<div id="user">
<div class="colorlib-loader"></div>

<div id="page">
  <aside id="colorlib-hero" class="breadcrumbs">
    <div class="flexslider">
      <ul class="slides">
        <li style="background-image: url({{url('home/images/img_bg_1.jpg')}});">
          <div class="overlay"></div>
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 col-md-offset-3 col-sm-12 col-xs-12 slider-text">
                <div class="slider-text-inner text-center">
                  <h1>Product Detail</h1>
                  <h2 class="bread"><span><a href="index.html">Home</a></span> <span><a href="shop.html">Product</a></span> <span>Product Detail</span></h2>
                </div>
              </div>
            </div>
          </div>
        </li>
        </ul>
      </div>
  </aside>

  <div class="colorlib-shop">
    <div class="container">
      <div class="row row-pb-lg">
        <div class="col-md-10 col-md-offset-1">
          <div class="product-detail-wrap">
            <div class="row">
              <div class="col-md-5">
                <div class="product-entry">
                  <div class="product-img" style="background-image: url({{url($book->cover)}});">
                    <p class="tag"><span class="sale">Sale</span></p>
                  </div>
                  <div class="thumb-nail">
                    <a href="#" class="thumb-img" style="background-image: url(images/item-11.jpg);"></a>
                  </div>
                </div>
              </div>
              <div class="col-md-7">
                <div class="desc">
                  <h3>{{$book->title}}</h3>
                  <p class="price">
                    <span>$68.00</span>
                    <span class="rate text-right">
                      <i class="icon-star-full"></i>
                      <i class="icon-star-full"></i>
                      <i class="icon-star-full"></i>
                      <i class="icon-star-full"></i>
                      <i class="icon-star-half"></i>
                      (74 Rating)
                    </span>
                  </p>
                  <p>{{$book->description}}</p>
                                    <!-- html -->
                  <div class="" >




                  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
								  <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body row">
                <!-- //bro excuse me this is my modal html  -->

                   <div class="form-group">
                        <label for="#dateftf" class="col-md-4">Reservation Date :</label>
                        <input type="date" name="reservation_datetime" id="reservation_datetime" class="col-md-4 reservation_datetime" style="margin-left:-10%;">
                        <p id="date1_validation" style="color:red;display:none" > Choice the reservation date !</p>
                   </div>
                   <div class="form-group">
                        <label for="#dateftf" class="col-md-4">Reservation End :</label>
                        <input type="date" name="reservation_end" id="reservation_end"  class="col-md-4 reservation_end" style="margin-left:-10%;">
                        <p id="date2_validation" style="color:red;display:none" > Choice the reservation end !</p>
                        <input type="hidden" name="book" id="book" value="{{$book->id}}">
                   </div>
              </div>
              <div class="modal-footer">
                <button type="button" id="reserving" class="btn btn-primary reserving">Reserving</button>
              </div>
            </div>

                  </div>
								</div>

                <div class="modal fade" id="exampleModalLong2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body row">

                 <input type="hidden" name="book" id="book" value="{{$book->id}}">
                 <div class="container">
                 <div class="form-group" style="align:center;">
                <label for="exampleFormControlSelect1">Select year : </label>
                <select style="width:15%;" id="years">
                  <option>2019</option>
                  <option>2020</option>
                </select>
              </div>
            </div>
                 <table class="table table-striped">
                   <thead>
                     <tr>
                       <th scope="col">From</th>
                       <th scope="col">To</th>
                       <th scope="col">Action</th>
                     </tr>
                   </thead>
                   <tbody id="tbody">

                   </tbody>

                 </table>
                 </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </div>
                </div>
              </div>

                </div>

                  <p><a  class="btn btn-primary btn-addtocart" data-toggle="modal" data-target="#"><i class="icon-shopping-cart"></i> Add to Cart</a></p>
									<!-- Modal -->
			               <!-- <form class="" action="{{url('borrows/reserving')}}" method="post">  -->
                  <div class="container-fluid">
                  <form class="" action="{{url('home/empty_dates')}}" method="post">
										{{ csrf_field() }}


								</form>
                </div>
                <!-- If the memeber have 3 reservation already ! -->
                <div class="container-fluid">
                  <div class="modal fade" id="Modal-message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body row">
                      <div class="alert alert-danger" role="alert">
                         <strong> You can't spend more than 3 booking </strong>
                      </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
                    </div>
                  </div>
                </div>
              </div>
              </div>
              <!-- Confirmation Message  -->
              <div class="container-fluid">
               <div class="modal fade" id="Modal-Confirmation-Message" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body row">
                    <div class="alert alert-success" role="alert">
                     <strong> You have passed the booking successfully</strong>
                    </div>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
                  </div>
                </div>
              </div>
            </div>
            </div>


                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

  <div class="colorlib-shop">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center colorlib-heading">
          <h2><span>Similar Products</span></h2>
          <p>We love to tell our successful far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
        </div>
      </div>
      <div class="row">
        @foreach($books as $book)
        <div class="col-md-3 text-center">
          <div class="product-entry">
            <div class="product-img" style="background-image: url({{url($book->cover)}});">
              <p class="tag"><span class="new">New</span></p>
              <div class="cart">
                <p>
                  <span class="addtocart"><a href="#"><i class="icon-shopping-cart"></i></a></span>
                  <span><a href="product-detail.html"><i class="icon-eye"></i></a></span>
                  <span><a href="#"><i class="icon-heart3"></i></a></span>
                  <span><a href="add-to-wishlist.html"><i class="icon-bar-chart"></i></a></span>
                </p>
              </div>
            </div>
            <div class="desc">
              <h3><a href="{{url('/home/'.$book->id.'/show')}}">{{$book->title}}</a></h3>
              <p class="price"><span>$300.00</span></p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script>
  $(document).ready(function(){

  $(".btn-addtocart").click(function(){
    $.ajax({
      url:"{{ route('test_Res') }}",
      method:"GET",
      success:function(message)
      {
        if (message=="false") {
            $('#Modal-message').modal('toggle');
        }
        if (message=="true") {
          console.log("wsal true");
          $('#exampleModalLong2').modal('toggle');
        }

       }
     })
  })

   var year = "2019";
   var book = $("#book").val();
   var _token = $('input[name="_token"]').val();
   // alert(year+" "+book+" "+_token);
   $.ajax({
      url:"{{ route('empty_dates') }}",
      method:"POST",
      data:{year:year, book:book, _token:_token},
      success:function(result)
      {
        $('#tbody').html(result);
        $(".btn-sm").click(function(){
        var year = "2019";
        var book = $(this).data('book');
        var reservation_datetime = $(this).data('date1');
        var reservation_end = $(this).data('date2');
        var _token = $('input[name="_token"]').val();
        $.ajax({
          url:"{{ route('reserving') }}",
          method:"POST",
          data:{book:book, reservation_datetime:reservation_datetime,reservation_end:reservation_end, _token:_token},
          success:function(dt)
          {
             $('#exampleModalLong').modal('toggle');
             $('#exampleModalLong2').modal('toggle');
             $(".reserving").click(function(){
               var reservation_datetime = $('#reservation_datetime').val();
               var reservation_end = $('#reservation_end').val();
               var _token = $('input[name="_token"]').val();
               var book = $("#book").val();
               console.log(reservation_datetime+"<= is date1 and date 2 is =>"+reservation_end);
               if (reservation_datetime==="") {
                  $("#date1_validation").css("display", "block");
               }
               else {
                 $("#date1_validation").css("display", "none");
               }
               if (reservation_end==="") {
                 $("#date2_validation").css("display", "block");
               }
               else {
                  $("#date2_validation").css("display", "none");
               }
               if (reservation_datetime !== "" && reservation_end !== "") {
                 $.ajax({
                   url:"{{ route('reserving') }}",
                   method:"POST",
                   data:{book:book, reservation_datetime:reservation_datetime,reservation_end:reservation_end, _token:_token},
                   success:function(message)
                   {
                    $('#exampleModalLong').modal('toggle');
                    $('#Modal-Confirmation-Message').modal('toggle');
                   }
                  })
                }
               })
           }
         })

      });
      }
    })
  });
  //bro can yu test the code once ok wait
  </script>
@stop
