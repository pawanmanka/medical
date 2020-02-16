<!DOCTYPE html>

<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="author" content="{{ config('app.name') }}"/>
		<meta name="description" content="{{ config('app.name') }}"/>
		<meta name="keywords" content="{{ config('app.name') }}">	
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta name="csrf_token" content="{{ csrf_token() }}">

  		<!-- SITE TITLE -->
		<title>{{ config('app.name') }}@if (trim($__env->yieldContent('title')))- @yield('title')@endif</title>
							
		<!-- FAVICON AND TOUCH ICONS  -->
		<link rel="shortcut icon" href="{{ baseUrl('images/Arogyarth-logo-tab.png') }}" type="image/x-icon">
		<link rel="icon" href="{{ baseUrl('images/Arogyarth-logo-tab.png') }}" type="image/x-icon">
		<link rel="apple-touch-icon" sizes="152x152" href="images/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="120x120" href="images/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="76x76" href="images/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" href="images/apple-touch-icon.png">

		<!-- GOOGLE FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet"> 	
		{{-- <link href="https://fonts.googleapis.com/css?family=Roboto:400,700,900" rel="stylesheet">  --}}

		<!-- BOOTSTRAP CSS -->
		<link href="{{ baseUrl('css/bootstrap.min.css') }}" rel="stylesheet">
				
		<!-- FONT ICONS -->
		{{-- <link href="{{ baseUrl('css/font-awesome.css')}}" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" rel="stylesheet" crossorigin="anonymous">		 --}}
		<link href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" rel="stylesheet" crossorigin="anonymous">		
		<link href="{{ baseUrl('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

		<link href="{{ baseUrl('css/flaticon.css') }}" rel="stylesheet">

		<!-- PLUGINS STYLESHEET -->
		<link href="{{ baseUrl('css/menu.css') }}" rel="stylesheet">	
		<link id="effect" href="{{ baseUrl('css/dropdown-effects/fade-down.css') }}" media="all" rel="stylesheet">
		<link href="{{ baseUrl('css/magnific-popup.css') }}" rel="stylesheet">	
		<link href="{{ baseUrl('css/owl.carousel.min.css') }}" rel="stylesheet">
		<link href="{{ baseUrl('css/owl.theme.default.min.css') }}" rel="stylesheet">
		<link href="{{ baseUrl('css/animate.css') }}" rel="stylesheet">
		<link href="{{ baseUrl('css/jquery.datetimepicker.min.css') }}" rel="stylesheet">

		<link href="{{ baseUrl('plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">
		<link href="{{ baseUrl('plugins/toastr/toastr.min.css') }}" rel="stylesheet">
		<!-- TEMPLATE CSS -->
		<link href="{{ baseUrl('css/style.css')}}" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="{{ baseUrl('css/mystyle.css')}}">
		<!-- RESPONSIVE CSS -->
		<link href="{{ baseUrl('css/responsive.css')}}" rel="stylesheet"> 

		<script type="text/javascript">
			var SITE_URL="{{ url('/') }}";
		</script>
	
	</head>
	<body>
		<!-- PRELOADER SPINNER
		============================================= -->	
		<div id="loader-wrapper">
			<div id="loader"><div class="loader-inner"></div></div>
		</div>


		<!-- PAGE CONTENT
		============================================= -->	
		<div id="page" class="page">
		
		<!-- HEADER ============================================= -->
         @include('layouts.header')
        	<!-- BREADCRUMB
			============================================= -->
		 @yield('breadcrumb')
			
			
	
	     @yield('content')
			<!-- FOOTER-1
			============================================= -->
			<footer id="footer-1" class="bg-image wide-40 footer division">
				<div class="container">


					<!-- FOOTER CONTENT -->
					<div class="row">	


						<!-- FOOTER INFO -->
						<div class="col-md-6 col-lg-3">
							<div class="footer-info mb-40">

								<!-- Footer Logo -->
								<!-- For Retina Ready displays take a image with double the amount of pixels that your image will be displayed (e.g 360 x 80  pixels) -->
								<img src="{{ baseUrl('images/Arogyarth-logo.png') }}" width="auto" height="70" alt="footer-logo">

								<!-- Text -->	
								<p class="p-sm mt-20">Aliquam orci nullam tempor sapien gravida donec an enim ipsum porta
								   justo at velna auctor congue
								</p>  

							
							
							</div>		
						</div>


						<!-- FOOTER CONTACTS -->
						<div class="col-md-6 col-lg-3">
							<div class="footer-box mb-40">
							
								<!-- Title -->
								<h5 class="h5-xs">Information </h5>

								<ul class="footer-ul ">
									<li><a class="white-link" href="{{url('/terms-and-condition')}}">Terms and condition</a></li>
									<li><a class="white-link" href="{{url('/privacy-policy')}}">Privacy Policy</a></li>
									<li><a class="white-link" href="{{url('/return-policy')}}">Return Policy</a></li>
								</ul>

							</div>
						</div>


						<!-- FOOTER WORKING HOURS -->
						<div class="col-md-6 col-lg-3">
							<div class="footer-box mb-40">
							
								<!-- Title -->
								<h5 class="h5-xs">Social media icon 
									</h5>

								<!-- Social Icons -->
								<div class="footer-socials-links mt-20">
										<ul class="foo-socials text-center clearfix">
	
											<li><a href="#" class="ico-facebook"><i class="fab fa-facebook-f"></i></a></li>
											<li><a href="#" class="ico-twitter"><i class="fab fa-twitter"></i></a></li>	
											<li><a href="#" class="ico-google-plus"><i class="fab fa-google-plus-g"></i></a></li>
											<li><a href="#" class="ico-tumblr"><i class="fab fa-tumblr"></i></a></li>			
										
										</ul>									
									</div>									

							</div>
						</div>


						<!-- FOOTER PHONE NUMBER -->
						<div class="col-md-6 col-lg-3">
							<div class="footer-box mb-40">
												
								<!-- Title -->
								<h5 class="h5-xs">Contact information</h5>

								<!-- Footer List -->
								<h5 class="h5-xl blue-color">8561903387</h5>

								<!-- Text -->	
								<p class="p-sm mt-15">Aliquam orci nullam undo tempor sapien gravida donec enim ipsum porta
								   justo velna aucto magna
								</p> 																												

							</div>
						</div>	


					</div>	  <!-- END FOOTER CONTENT -->


					<!-- FOOTER COPYRIGHT -->
					<div class="bottom-footer">
						<div class="row">
							<div class="col-md-12">
								<p class="footer-copyright">&copy; {{ date('Y') }} <span>{{ config('app.name') }}</span>. All Rights Reserved</p>
							</div>
						</div>
					</div>


				</div>	   <!-- End container -->										
			</footer>	<!-- END FOOTER-1 -->

		</div>	<!-- END PAGE CONTENT -->



		<!-- EXTERNAL SCRIPTS
		============================================= -->	
		<script src="{{ baseUrl('js/jquery-3.3.1.min.js') }}"></script>
		<script src="{{ baseUrl('js/scripts/app.js') }}"></script>

		<script src="{{ baseUrl('js/bootstrap.min.js') }}"></script>	
		<script src="{{ baseUrl('js/modernizr.custom.js') }}"></script>
		<script src="{{ baseUrl('js/jquery.easing.js') }}"></script>
		<script src="{{ baseUrl('js/jquery.appear.js') }}"></script>
		<script src="{{ baseUrl('js/jquery.stellar.min.js') }}"></script>	
		<script src="{{ baseUrl('js/menu.js') }}"></script>
		<script src="{{ baseUrl('js/sticky.js') }}"></script>
		<script src="{{ baseUrl('js/jquery.scrollto.js') }}"></script>
		<script src="{{ baseUrl('js/owl.carousel.min.js') }}"></script>
		<script src="{{ baseUrl('js/jquery.magnific-popup.min.js') }}"></script>	
		<script src="{{ baseUrl('js/imagesloaded.pkgd.min.js') }}"></script>
		<script src="{{ baseUrl('js/isotope.pkgd.min.js') }}"></script>
		<script src="{{ baseUrl('js/jquery.datetimepicker.full.js') }}"></script>		
		{{-- <script src="{{ baseUrl('js/jquery.validate.min.js') }}"></script>	 --}}
		<script src="{{ baseUrl('js/jquery.ajaxchimp.min.js') }}"></script>
		<script src="{{ baseUrl('js/wow.js') }}"></script>	
	
		<script src="{{baseUrl('plugins/sweetalert/sweetalert.min.js')}}"></script>
		<script src="{{baseUrl('plugins/toastr/toastr.min.js')}}"></script>
		<!-- Custom Script -->		
		<script src="{{ baseUrl('js/custom.js') }}"></script>

		<script> 
			new WOW().init();
		</script>

		<script defer src="{{ baseUrl('js/styleswitch.js') }}"></script>	
		@yield('customScript')

           
	</body>



</html>	