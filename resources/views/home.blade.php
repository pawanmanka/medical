@extends('layouts.app')
@section('title','Home')
@section('content')
		<!-- HERO-1
			============================================= -->	
			<section id="hero-1" class="bg-fixed hero-section division">
				<div class="container">						
					<div class="row d-flex align-items-center">


						<!-- HERO TEXT -->
						<div class="col-md-8 col-lg-7 col-xl-6">
							<div class="hero-txt mb-40">
								
								<!-- Title -->
								<h5 class="steelblue-color">Welcome To Our Clinic</h5>
								<h2 class="steelblue-color">Take Care of Your Health</h2>

								<!-- Text -->
								<p class="p-md">Feugiat primis ligula risus auctor egestas augue mauri viverra tortor in
								   iaculis placerat eugiat mauris ipsum in viverra tortor and gravida purus pretium lorem 
								   primis in orci integer mollis
								</p>

								<!-- Button -->
								<a href="{{url('about-us')}}" class="btn btn-blue blue-hover">More About Clinic</a>										

							</div>
						</div>	<!-- END HERO TEXT -->


						<!-- HERO IMAGE -->
						<div class="col-md-4 col-lg-5 col-xl-6">	
							<div class="hero-1-img text-center">				
								<img class="img-fluid" src="images/hero-1-img.png" alt="hero-image">
							</div>
						</div>


					</div>    <!-- End row -->
				</div>     <!-- End container -->
			</section>	<!-- END HERO-1 -->

			<!-- ABOUT-1
			============================================= -->
		   @include('_search_form')


			<!-- SERVICES-3
			============================================= -->
			<section id="services-3" class="bg-lightgrey wide-100 services-section division">
					<div class="container">
	
	
						<!-- SECTION TITLE -->	
						<div class="row">	
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
			<section id="doctors-1" class="wide-40 doctors-section division">
				<div class="container">


			 		<!-- SECTION TITLE -->	
					<div class="row">	
						<div class="col-lg-10 offset-lg-1 section-title">		

							<!-- Title 	-->	
							<h3 class="h3-md steelblue-color">Our Medical Specialists</h3>	

							<!-- Text -->
							<p>Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero at tempus, 
							   blandit posuere ligula varius congue cursus porta feugiat
							</p>
										
						</div> 
					</div>	 <!-- END SECTION TITLE -->	


					<div class="row">
                         @foreach (topRateDoctor() as $item)
							
						<!-- DOCTOR #1 -->
						<div class="col-md-6 col-lg-3">
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
							<div class="all-doctors mb-40">
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
