@extends('layouts.app')
@section('title','Home')
@section('content')
		<!-- HERO-1
			============================================= -->	
			
			<!-- HERO-9
			============================================= -->
			<section id="hero-9" class="hero-section">	
				<div id="heroCarousel" class="carousel slide" data-ride="carousel">


					<!-- SLIDER CONTENT -->
					<div class="carousel-inner">


						<!-- SLIDE 1 -->
						<div id="carousel-slide-1" class="bg-fixed carousel-item active">
							<div class="mask d-flex align-items-center">
						        <div class="container">
						          	<div class="row">

						          		<!-- SLIDE-1 TEXT -->
						           		<div class="col-md-8 col-lg-7">
						           			<div class="hero-txt">

						           				<!-- Title -->
						       					<h5 class="blue-color">Welcome to Arogyarth</h5>
						       					<h2 class="steelblue-color">We will help you to become healthy</h2>
									          	
									          	<!-- Text -->
												<p class="p-md">Arogyarth is aspiring to help you to become healthy by providing services of the
best doctors and team on a single platform.
												</p>

												<!-- Button -->
												<a href="{{url('about-us')}}" class="btn btn-blue blue-hover">About Us</a>

								            </div> 
								        </div>

						        	</div>
					       		</div>
					      	</div>
					    </div>	<!-- END SLIDE 1 -->


					    <!-- SLIDE 2 -->
						<div id="carousel-slide-2" class="bg-fixed carousel-item">
							<div class="mask d-flex align-items-center">
						        <div class="container">
						          	<div class="row">

						          		<!-- SLIDE-2 TEXT -->
						           		<div class="col-md-8 col-lg-7 offset-md-4 offset-lg-5">
						           			<div class="hero-txt">

						           				<!-- Title -->
					        					<h5 class="blue-color">Best quality medical treatment for you</h5>
								         	 	<h2 class="steelblue-color"><span>Best Quality</span> Medical Treatment for You</h2>
									          	
									          	<!-- Text -->
												<p class="p-md">With Arogyarth you can access to best quality medical team and treatment of
your preference on a single click.
												</p>

												<!-- Button -->
												<!-- <a href="who-we-are.html" class="btn btn-black tra-black-hover mr-10">Get More Info</a>
												<a href="all-services.html" class="btn btn-blue blue-hover">Our Core Services</a> -->

								            </div> 
								        </div>

						        	</div>
					       		</div>
					      	</div>
					    </div>	<!-- END SLIDE 2 -->


					    <!-- SLIDE 3 -->
						<div id="carousel-slide-3" class="bg-fixed carousel-item">
							<div class="mask d-flex align-items-center">
						        <div class="container">
						          	<div class="row">

						          		<!-- SLIDE-3 TEXT -->
						           		<div class="col-md-8 col-lg-7">
						           			<div class="hero-txt">

						           				<!-- Title -->
						       			 		<h5 class="blue-color">Why Choose Our clinic</h5>
									        	<h2 class="steelblue-color">We will care about your health</h2>
												<p class="p-md">Arogyarth provides you to choose the best medical specialist of your choice
because we care for your health.
													</p>
				                               
								            </div> 
								        </div>								    

						        	</div>
					       		</div>
					      	</div>
					    </div>	<!-- END SLIDE 3 -->


					</div>	<!-- END SLIDER CONTENT -->


					<!-- SLIDER NAVIGATION -->
					<div class="carousel-nav white-nav">

						<a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev"> 
							<span class="carousel-control-prev-icon" aria-hidden="true"></span> 
						</a> 

						<a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next"> 
							<span class="carousel-control-next-icon" aria-hidden="true"></span> 
						</a> 

					</div>


				</div>
			</section>	<!-- END HERO-9 -->

			<!-- ABOUT-1
			============================================= -->
		   @include('_search_form')


			<!-- SERVICES-3
			============================================= -->
			<section id="services-3" class="bg-lightgrey wide-60 services-section division" style="padding-top:20px">
					<div class="container">
							
	
						<!-- SECTION TITLE -->	
						<div class="row" style="padding-top:20px">	
							<div class="col-lg-10 offset-lg-1 section-title">		
	
								<!-- Title 	-->	
								<h3 class="h3-md steelblue-color">All Category</h3>	
	
								<!-- Text -->
								<!-- <p>Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero at tempus, 
								   blandit posuere ligula varius congue cursus porta feugiat
								</p> -->
											
							</div> 
						</div>
					
						
						<!-- SERVICES CONTENT -->
						<div class="row">
							<div class="col-md-12">					
								<div class="owl-carousel owl-theme services-holder">
									 
									
							        @foreach (topCategory() as $item)
											<!-- SERVICE BOX #1 -->
									<div class="sbox-3 icon-sm">
	
										<!-- Icon -->
										<div class="sbox-3-icon">
											<span ><img src="{{$item->image_url}}" alt="{{$item->name}}"></span>
										</div>
											
										<!-- Title -->
										<a href="{{url($item->super_categories_slug.'?type='.$item->super_category_id.'&category='.$item->slug)}}"><h5 class="h5-xs steelblue-color">{{$item->name}}</h5></a>
																																							
									</div>
	
									@endforeach 
								
	
	
								</div>
							</div>									
						</div>	<!-- END SERVICES CONTENT --> 
								
							
					</div>	   <!-- End container -->
				</section>	 <!-- END SERVICES-3 -->	
	
	
	

			<!-- DOCTORS-1
			============================================= -->
			<section id="doctors-1" class="wide-40 doctors-section division" style="padding-top: 40px;">
				<div class="container">


			 		<!-- SECTION TITLE -->	
					<div class="row">	
						<div class="col-lg-10 offset-lg-1 section-title">		

							<!-- Title 	-->	
							<h3 class="h3-md steelblue-color">Our Medical Specialists</h3>	

							<!-- Text -->
							<p>We have the best doctors of Jodhpur associated with us.
							</p>
										
						</div> 
					</div>	 <!-- END SECTION TITLE -->	


					<div class="row">
                         @foreach (topRateDoctor() as $item)
							
						<!-- DOCTOR #1 -->
						<div class=" col-sm-12 col-md-3 col-lg-2">
							<div class="doctor-1">								
														
								<!-- Doctor Photo -->
								<div class="hover-overlay text-center"> 
									<!-- Photo -->
									<img class="img-fluid" src="{{isset($item->getUserInformation->profile_pic)?$item->getUserInformation->profile_pic:''}}" alt="{{$item->name}}">	
									<div class="item-overlay"></div>

									<!-- Profile Link -->		
									<div class="profile-link">
									<a class="btn btn-sm btn-tra-white black-hover" href="{{$item->detail_url}}" title="{{$item->name}}">View More Info</a>
									</div> 

								</div>	

								<!-- Doctor Meta -->		
								<div class="doctor-meta">

									<h5 class="h5-sm steelblue-color">{{$item->name}}</h5>
								     <span class="blue-color">{{isset($item->getUserInformation->category_name)?$item->getUserInformation->category_name:''}}</span>

								
								</div>	

							</div>								
						</div>	<!-- END DOCTOR #1 -->
						
						
 
						 @endforeach


					</div>	    <!-- End row -->


					<!-- ALL DOCTORS BUTTON -->		
					<div class="row">
						<div class="col-md-12 text-center">
							<div class="all-doctors mb-40" style="margin-bottom:20px;">
								<a href="{{url('/doctors')}}" class="btn btn-blue blue-hover">Meet All Doctors</a>
							</div>
						</div>
					</div>


				</div>	   <!-- End container -->
			</section>	<!-- END DOCTORS-1 -->

			

@endsection
@section('customScript')
<script src="{{ baseUrl('js/materialize.js') }}"></script>	
<script src="{{ baseUrl('scripts/listing.js') }}"></script>
<script>
  var listingObj = new ListingFn();
  var typeArr = {!! json_encode(config('application.super_categories_slug')) !!}
  jQuery(document).ready(function(){
    listingObj.init();
  })
</script>
@endsection
