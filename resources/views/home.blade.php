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
	
							
									<!-- SERVICE BOX #1 -->
									<div class="sbox-3 icon-sm">
	
										<!-- Icon -->
										<div class="sbox-3-icon">
											<span class="flaticon-083-stethoscope"></span>
										</div>
											
										<!-- Title -->
										<h5 class="h5-xs steelblue-color">Pediatrics</h5>
	
										<!-- Text -->
										<p>Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor
										   tempus feugiat dolor lacinia cubilia curae integer congue leo metus
										</p>
																																							
									</div>
	
	
									<!-- SERVICE BOX #2 -->
									<div class="sbox-3 icon-sm">
	
										<!-- Icon -->
										<div class="sbox-3-icon">
											<span class="flaticon-047-head"></span>
										</div>
											
										<!-- Title -->
										<h5 class="h5-xs steelblue-color">Neurology</h5>
	
										<!-- Text -->
										<p>Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor
										   tempus feugiat dolor lacinia cubilia curae integer congue leo metus
										</p>
																																							
									</div>
	
	
									<!-- SERVICE BOX #3 -->
									<div class="sbox-3 icon-sm">
	
										<!-- Icon -->
										<div class="sbox-3-icon">
											<span class="flaticon-015-blood-donation-1"></span>
										</div>
											
										<!-- Title -->
										<h5 class="h5-xs steelblue-color">Haematology</h5>
	
										<!-- Text -->
										<p>Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor
										   tempus feugiat dolor lacinia cubilia curae integer congue leo metus
										</p>
																																							
									</div>
	
	
									<!-- SERVICE BOX #4 -->
									<div class="sbox-3 icon-sm">
	
										<!-- Icon -->
										<div class="sbox-3-icon">
											<span class="flaticon-048-lungs"></span>
										</div>
											
										<!-- Title -->
										<h5 class="h5-xs steelblue-color">X-Ray Diagnostic</h5>
	
										<!-- Text -->
										<p>Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor
										   tempus feugiat dolor lacinia cubilia curae integer congue leo metus
										</p>
																																							
									</div>
	
	
									<!-- SERVICE BOX #5 -->
									<div class="sbox-3 icon-sm">
	
										<!-- Icon -->
										<div class="sbox-3-icon">
											<span class="flaticon-060-cardiogram-4"></span>
										</div>
											
										<!-- Title -->
										<h5 class="h5-xs steelblue-color">Cardiology</h5>
	
										<!-- Text -->
										<p>Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor
										   tempus feugiat dolor lacinia cubilia curae integer congue leo metus
										</p>
																																							
									</div>
	
	
									<!-- SERVICE BOX #6 -->
									<div class="sbox-3 icon-sm">
	
										<!-- Icon -->
										<div class="sbox-3-icon">
											<span class="flaticon-031-scanner"></span>
										</div>
											
										<!-- Title -->
										<h5 class="h5-xs steelblue-color">MRI</h5>
	
										<!-- Text -->
										<p>Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor
										   tempus feugiat dolor lacinia cubilia curae integer congue leo metus
										</p>
																																							
									</div>
	
	
									<!-- SERVICE BOX #7 -->
									<div class="sbox-3 icon-sm">
	
										<!-- Icon -->
										<div class="sbox-3-icon">
											<span class="flaticon-076-microscope"></span>
										</div>
											
										<!-- Title -->
										<h5 class="h5-xs steelblue-color">Laboratory Services</h5>
	
										<!-- Text -->
										<p>Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor
										   tempus feugiat dolor lacinia cubilia curae integer congue leo metus
										</p>
																																							
									</div>
	
	
									<!-- SERVICE BOX #8 -->
									<div class="sbox-3 icon-sm">
	
										<!-- Icon -->
										<div class="sbox-3-icon">
											<span class="flaticon-068-ambulance-3"></span>
										</div>
											
										<!-- Title -->
										<h5 class="h5-xs steelblue-color">Emergency Help</h5>
	
										<!-- Text -->
										<p>Porta semper lacus cursus, feugiat primis ultrice in ligula risus auctor
										   tempus feugiat dolor lacinia cubilia curae integer congue leo metus
										</p>
																																							
									</div>
	
								
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


						<!-- DOCTOR #1 -->
						<div class="col-md-6 col-lg-3">
							<div class="doctor-1">								
														
								<!-- Doctor Photo -->
								<div class="hover-overlay text-center"> 

									<!-- Photo -->
									<img class="img-fluid" src="images/doctor-1.jpg" alt="doctor-foto">	
									<div class="item-overlay"></div>

									<!-- Profile Link -->		
									<div class="profile-link">
										<a class="btn btn-sm btn-tra-white black-hover" href="profile.html" title="">View More Info</a>
									</div> 

								</div>	

								<!-- Doctor Meta -->		
								<div class="doctor-meta">

									<h5 class="h5-sm steelblue-color">Jonathan Barnes D.M.</h5>
									<span class="blue-color">Chief Medical Officer</span>

									<p class="p-sm grey-color">Donec vel sapien augue integer turpis cursus porta, mauris sed
									   augue luctus magna dolor luctus ipsum neque
									</p>

								</div>	

							</div>								
						</div>	<!-- END DOCTOR #1 -->
						
						
						<!-- DOCTOR #2 -->
						<div class="col-md-6 col-lg-3">
							<div class="doctor-1">	
																						
								<!-- Doctor Photo -->
								<div class="hover-overlay text-center"> 

									<!-- Photo -->
									<img class="img-fluid" src="images/doctor-2.jpg" alt="doctor-foto">	
									<div class="item-overlay"></div>

									<!-- Profile Link -->		
									<div class="profile-link">
										<a class="btn btn-sm btn-tra-white black-hover" href="profile.html" title="">View More Info</a>
									</div>

								</div>	

								<!-- Doctor Meta -->		
								<div class="doctor-meta">

									<h5 class="h5-sm steelblue-color">Hannah Harper D.M.</h5>
									<span class="blue-color">Anesthesiologist</span>

									<p class="p-sm grey-color">Donec vel sapien augue integer turpis cursus porta, mauris sed
									   augue luctus magna dolor luctus ipsum neque
									</p>

								</div>	

							</div>					
						</div>	<!-- END DOCTOR #2 -->
						
						
						<!-- DOCTOR #3 -->
						<div class="col-md-6 col-lg-3">
							<div class="doctor-1">	
																						
								<!-- Doctor Photo -->
								<div class="hover-overlay text-center"> 

									<!-- Photo -->
									<img class="img-fluid" src="images/doctor-3.jpg" alt="doctor-foto">	
									<div class="item-overlay"></div>

									<!-- Profile Link -->		
									<div class="profile-link">
										<a class="btn btn-sm btn-tra-white black-hover" href="profile.html" title="">View More Info</a>
									</div>

								</div>		
								
								<!-- Doctor Meta -->		
								<div class="doctor-meta">

									<h5 class="h5-sm steelblue-color">Matthew Anderson D.M.</h5>
									<span class="blue-color">Cardiology</span>

									<p class="p-sm grey-color">Donec vel sapien augue integer turpis cursus porta, mauris sed
									   augue luctus magna dolor luctus ipsum neque
									</p>

								</div>	

							</div>			
						</div>	<!-- END DOCTOR #3 -->
											
						
						<!-- DOCTOR #4 -->
						<div class="col-md-6 col-lg-3">
							<div class="doctor-1">	
																					
								<!-- Doctor Photo -->
								<div class="hover-overlay text-center"> 

									<!-- Photo -->
									<img class="img-fluid" src="images/doctor-4.jpg" alt="doctor-foto">	
									<div class="item-overlay"></div>

									<!-- Profile Link -->		
									<div class="profile-link">
										<a class="btn btn-sm btn-tra-white black-hover" href="profile.html" title="">View More Info</a>
									</div>

								</div>		
								
								<!-- Doctor Meta -->		
								<div class="doctor-meta">

									<h5 class="h5-sm steelblue-color">Megan Coleman D.M.</h5>
									<span class="blue-color">Neurosurgeon</span>

									<p class="p-sm grey-color">Donec vel sapien augue integer turpis cursus porta, mauris sed
									   augue luctus magna dolor luctus ipsum neque
									</p>

								</div>	

							</div>			
						</div>	<!-- END DOCTOR #4 -->

						
						<!-- DOCTOR #1 -->
						<div class="col-md-6 col-lg-3">
								<div class="doctor-1">								
															
									<!-- Doctor Photo -->
									<div class="hover-overlay text-center"> 
	
										<!-- Photo -->
										<img class="img-fluid" src="images/doctor-1.jpg" alt="doctor-foto">	
										<div class="item-overlay"></div>
	
										<!-- Profile Link -->		
										<div class="profile-link">
											<a class="btn btn-sm btn-tra-white black-hover" href="profile.html" title="">View More Info</a>
										</div> 
	
									</div>	
	
									<!-- Doctor Meta -->		
									<div class="doctor-meta">
	
										<h5 class="h5-sm steelblue-color">Jonathan Barnes D.M.</h5>
										<span class="blue-color">Chief Medical Officer</span>
	
										<p class="p-sm grey-color">Donec vel sapien augue integer turpis cursus porta, mauris sed
										   augue luctus magna dolor luctus ipsum neque
										</p>
	
									</div>	
	
								</div>								
							</div>	<!-- END DOCTOR #1 -->
							
							
							<!-- DOCTOR #2 -->
							<div class="col-md-6 col-lg-3">
								<div class="doctor-1">	
																							
									<!-- Doctor Photo -->
									<div class="hover-overlay text-center"> 
	
										<!-- Photo -->
										<img class="img-fluid" src="images/doctor-2.jpg" alt="doctor-foto">	
										<div class="item-overlay"></div>
	
										<!-- Profile Link -->		
										<div class="profile-link">
											<a class="btn btn-sm btn-tra-white black-hover" href="profile.html" title="">View More Info</a>
										</div>
	
									</div>	
	
									<!-- Doctor Meta -->		
									<div class="doctor-meta">
	
										<h5 class="h5-sm steelblue-color">Hannah Harper D.M.</h5>
										<span class="blue-color">Anesthesiologist</span>
	
										<p class="p-sm grey-color">Donec vel sapien augue integer turpis cursus porta, mauris sed
										   augue luctus magna dolor luctus ipsum neque
										</p>
	
									</div>	
	
								</div>					
							</div>	<!-- END DOCTOR #2 -->
							
							
							<!-- DOCTOR #3 -->
							<div class="col-md-6 col-lg-3">
								<div class="doctor-1">	
																							
									<!-- Doctor Photo -->
									<div class="hover-overlay text-center"> 
	
										<!-- Photo -->
										<img class="img-fluid" src="images/doctor-3.jpg" alt="doctor-foto">	
										<div class="item-overlay"></div>
	
										<!-- Profile Link -->		
										<div class="profile-link">
											<a class="btn btn-sm btn-tra-white black-hover" href="profile.html" title="">View More Info</a>
										</div>
	
									</div>		
									
									<!-- Doctor Meta -->		
									<div class="doctor-meta">
	
										<h5 class="h5-sm steelblue-color">Matthew Anderson D.M.</h5>
										<span class="blue-color">Cardiology</span>
	
										<p class="p-sm grey-color">Donec vel sapien augue integer turpis cursus porta, mauris sed
										   augue luctus magna dolor luctus ipsum neque
										</p>
	
									</div>	
	
								</div>			
							</div>	<!-- END DOCTOR #3 -->
												
							
							<!-- DOCTOR #4 -->
							<div class="col-md-6 col-lg-3">
								<div class="doctor-1">	
																						
									<!-- Doctor Photo -->
									<div class="hover-overlay text-center"> 
	
										<!-- Photo -->
										<img class="img-fluid" src="images/doctor-4.jpg" alt="doctor-foto">	
										<div class="item-overlay"></div>
	
										<!-- Profile Link -->		
										<div class="profile-link">
											<a class="btn btn-sm btn-tra-white black-hover" href="profile.html" title="">View More Info</a>
										</div>
	
									</div>		
									
									<!-- Doctor Meta -->		
									<div class="doctor-meta">
	
										<h5 class="h5-sm steelblue-color">Megan Coleman D.M.</h5>
										<span class="blue-color">Neurosurgeon</span>
	
										<p class="p-sm grey-color">Donec vel sapien augue integer turpis cursus porta, mauris sed
										   augue luctus magna dolor luctus ipsum neque
										</p>
	
									</div>	
	
								</div>			
							</div>	<!-- END DOCTOR #4 -->
	


					</div>	    <!-- End row -->


					<!-- ALL DOCTORS BUTTON -->		
					<div class="row">
						<div class="col-md-12 text-center">
							<div class="all-doctors mb-40">
								<a href="all-doctors.html" class="btn btn-blue blue-hover">Meet All Doctors</a>
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
