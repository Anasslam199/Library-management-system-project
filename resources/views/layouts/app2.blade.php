
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>HTML Education Template</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="{{ url('templete_resources/css/bootstrap.min.css') }}"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="{{ url('templete_resources/css/font-awesome.min.css') }}">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="{{ url('templete_resources/css/style.css') }}"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

    </head>
	<body>

		<!-- Header -->
		<header id="header" class="transparent-nav">
			<div class="container">

				<div class="navbar-header">
					<!-- Logo -->
					<div class="navbar-brand">
						<a class="logo" href="index.html">

							<img src="{{ URL::asset('templete_resources/img/logo.png') }}" alt="logo">
						</a>
					</div>
					<!-- /Logo -->

					<!-- Mobile toggle -->
					<button class="navbar-toggle">
						<span></span>
					</button>
					<!-- /Mobile toggle -->
				</div>

				<!-- Navigation -->
				<nav id="nav">
					<ul class="main-menu nav navbar-nav navbar-right">
						<li><a href="index.html"> {{__('messages.Books')}}</a></li>
						<li><a href="#">{{__('messages.Members')}}</a></li>
						<li><a href="#">{{__('messages.Borrows')}}</a></li>
						<li><a href="blog.html">Contact</a></li>
            @if(Session::get('locale')=='fr')
            <li class="list-inline-item dropdown notif">

              <a class="nav-link" id="navbarDropdown" role="button"
           href="{{url('locale/en')}}">
            <img src="{{asset('images/jack_flag.png')}}" alt="france flag" style="width:30px;">
           </a>
          </li>
            @else
          <li class="list-inline-item dropdown notif">

            <a class="nav-link" id="navbarDropdown" role="button"
         href="{{url('locale/fr')}}">
          <img src="{{asset('images/france_flag.jpeg')}}" alt="france flag" style="width:30px;">
         </a>
        </li>
        @endif
					</ul>
				</nav>
				<!-- /Navigation -->

			</div>
		</header>
		<!-- /Header -->


		<!-- /Home -->
@yield('content')

    <!-- Footer -->
    		<footer id="footer" class="section">

    			<!-- container -->
    			<div class="container">

    				<!-- row -->
    				<div class="row">

    					<!-- footer logo -->
    					<div class="col-md-6">
    						<div class="footer-logo">
    							<a class="logo" href="index.html">
    								<img src="{{ URL::asset('templete_resources/img/logo.png') }}" alt="logo">
    							</a>
    						</div>
    					</div>
    					<!-- footer logo -->

    					<!-- footer nav -->
    					<div class="col-md-6">
    						<ul class="footer-nav">
    							<li><a href="index.html">{{__('messages.Books')}}</a></li>
    							<li><a href="#">{{__('messages.Members')}}</a></li>
    							<li><a href="#">{{__('messages.Borrows')}}</a></li>
    							<li><a href="blog.html">{{__('messages.NewBook')}}</a></li>
    							<li><a href="contact.html">{{__('messages.NewBook')}}</a></li>
    						</ul>
    					</div>
    					<!-- /footer nav -->

    				</div>
    				<!-- /row -->

    				<!-- row -->
    				<div id="bottom-footer" class="row">

    					<!-- social -->
    					<div class="col-md-4 col-md-push-8">
    						<ul class="footer-social">
    							<li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
    							<li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
    							<li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
    							<li><a href="#" class="instagram"><i class="fa fa-instagram"></i></a></li>
    							<li><a href="#" class="youtube"><i class="fa fa-youtube"></i></a></li>
    							<li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
    						</ul>
    					</div>
    					<!-- /social -->

    					<!-- copyright -->
    					<div class="col-md-8 col-md-pull-4">
    						<div class="footer-copyright">
    							<span>&copy; Copyright 2018. All Rights Reserved. | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com">Colorlib</a></span>
    						</div>
    					</div>
    					<!-- /copyright -->

    				</div>
    				<!-- row -->

    			</div>
    			<!-- /container -->

    		</footer>
    		<!-- /Footer -->

    		<!-- preloader -->
    		<div id='preloader'><div class='preloader'></div></div>
    		<!-- /preloader -->


    		<!-- jQuery Plugins -->
    		<script type="text/javascript" src="{{ url('templete_resources/js/jquery.min.js') }}"></script>
    		<script type="text/javascript" src="{{ url('templete_resources/js/bootstrap.min.js') }}"></script>
    		<script type="text/javascript" src="{{ url('templete_resources/js/main.js') }}"></script>

    	</body>
    </html>
