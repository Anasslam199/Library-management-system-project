@extends('layouts.app2')
@section('content')
<!-- About -->


<!-- Home -->
<div id="home" class="hero-area">

  <!-- Backgound Image -->
  <div class="bg-image bg-parallax overlay" style="background-image:url({{'/templete_resources/img/background.jpg'}})"></div>
  <!-- /Backgound Image -->

  <div class="home-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <h1 class="white-text">{{__('messages.WelcometotheLibrary')}}</h1>
          <p class="lead white-text">{{__('messages.Afriendly')}}</p>
          <a class="main-button icon-button" href="#">Get Started!</a>
        </div>
      </div>
    </div>
  </div>

</div>



		<!-- Why us -->
		<div id="why-us" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">
					<div class="section-header text-center">
						<h2>{{__('messages.Thelibraryservices')}}</h2>
						<p class="lead">Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.</p>
					</div>

					<!-- feature -->
					<div class="col-md-4">
						<div class="feature">
							<i class="feature-icon fa fa-book"></i>
							<div class="feature-content">
								<h4>{{__('messages.Books')}}</h4>
								<p>Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.</p>
							</div>
						</div>
					</div>
					<!-- /feature -->

					<!-- feature -->
					<div class="col-md-4">
						<div class="feature">
							<i class="feature-icon fa fa-wifi"></i>
							<div class="feature-content">
								<h4> Internet</h4>
								<p>Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.</p>
							</div>
						</div>
					</div>
					<!-- /feature -->

					<!-- feature -->
					<div class="col-md-4">
						<div class="feature">
							<i class="feature-icon fa fa-users"></i>
							<div class="feature-content">
								<h4>{{__('messages.Activity')}}</h4>
								<p>Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.</p>
							</div>
						</div>
					</div>
					<!-- /feature -->

				</div>
				<!-- /row -->

				<hr class="section-hr">

				<!-- row -->
				<div class="row">

					<div class="col-md-6">
						<h3>Persius imperdiet incorrupte et qui, munere nusquam et nec.</h3>
						<p class="lead">Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.</p>
						<p>No vel facete sententiae, quodsi dolores no quo, pri ex tamquam interesset necessitatibus. Te denique cotidieque delicatissimi sed. Eu doming epicurei duo. Sit ea perfecto deseruisse theophrastus. At sed malis hendrerit, elitr deseruisse in sit, sit ei facilisi mediocrem.</p>
					</div>

					<div class="col-md-5 col-md-offset-1">
						<a class="about-video" href="#">
							<img src="{{ URL::asset('templete_resources/img/about-video.png') }}" alt="">
							<i class="play-icon fa fa-play"></i>
						</a>
					</div>

				</div>
				<!-- /row -->

			</div>
			<!-- /container -->

		</div>
		<!-- /Why us -->

		<!-- Contact CTA -->
		<div id="contact-cta" class="section">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url({{'/templete_resources/img/cta2-background.jpg'}})"></div>
			<!-- Backgound Image -->

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<div class="col-md-8 col-md-offset-2 text-center">
						<h2 class="white-text">Contact Us</h2>
						<p class="lead white-text">Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.</p>
						<a class="main-button icon-button" href="#">Contact Us Now</a>
					</div>

				</div>
				<!-- /row -->

			</div>
			<!-- /container -->

		</div>
		<!-- /Contact CTA -->




@stop
