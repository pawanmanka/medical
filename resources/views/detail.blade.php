@extends('layouts.app')
@section('title',$title)
@section('breadcrumb')
		@include('layouts.breadcrumb')
@endsection

@section('content')
		<!-- DOCTOR-2 DETAILS -->
        <section id="doctor-2-details" class="wide-70 doctor-details-section division">	
				<div class="container">
					@include('flash::message')
					<div class="row">


						<!-- DOCTOR PHOTO -->
						<div class="col-xs-12 col-md-2 col-xl-2">
			 				<div class="doctor-photo mb-30 text-center">

			 					<!-- Photo -->	
			 					<img class="img-fluid" src="{{ $userInformation->profile_pic }}" alt="doctor-foto">

			 					

			 				</div>
			 			</div>	<!-- END DOCTOR PHOTO -->


			 			<!-- DOCTOR'S BIO -->
						<div class="col-xs-12 col-md-10 col-xl-10 ">
							<div class="doctor-bio">

								<!-- Name -->	
								<div class="profile-btn">
										<!-- Button -->
								@if ($record->role_name  == config('application.doctor_role'))
								@hasanyrole(config('application.wallet_add_roles'))		
								<a href="{{ url('/booking/'.$record->slug) }}" class="btn btn-md btn-blue blue-hover" >Book an Appointment</a>
								@endhasanyrole	
								@endif
							</div>
								 <h4 class="h2-sm blue-color">{{ $record->name }} 
									@if(!empty($record->gender_title))
								       ({{$record->gender_title}})	 
								   @endif
								</h4>

			 					<h5 class="h5-lg blue-color">
								    @if ($record->role_name  == config('application.doctor_role'))
									   Specialist in {{$userInformation->category_name}} 	@if(!empty($userInformation->experience)) {{ $userInformation->experience }}  experience @endif
									@elseif($record->role_name  == config('application.hospital_role'))
									Multi-Specialty Hospital
									@elseif($record->role_name  == config('application.lab_role'))
									Services
									@endif
									
								</h5>	
								
								 
								 {!!ratingView($record->avg_rating)!!}
						
			 					<!-- Text -->	
						   		<p>{{$record->meta_description}}</p>
							</div>
						</div>	<!-- END DOCTOR BIO -->


					</div> 
						<hr>  <!-- End row -->	
					<div class="row">
								

			<!-- TABS-1
			============================================= -->
			<section id="tabs-1" class=" tabs-section division">
				<div class="container">	
				 	<div class="row">
				 		<div class="col-md-12">
				 			

				 			<!-- TABS NAVIGATION -->
							<div id="tabs-nav" class="list-group text-center">
							    <ul class="nav nav-pills" id="pills-tab" role="tablist">

							    	<!-- TAB-1 LINK -->
								  	<li class="nav-item icon-xs">
								    	<a class="nav-link active" id="tab1-list" data-toggle="pill" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">
								    		<span class="flaticon-083-stethoscope"></span> Info
								    	</a>
								  	</li>
									  @if($record->role_name  == config('application.lab_role'))
									  <!-- TAB-service LINK -->
									  <li class="nav-item icon-xs">
										  <a class="nav-link" id="service-list" data-toggle="pill" href="#tab-service" role="tab" aria-controls="tab-2" aria-selected="false">
											 <span class="flaticon-112-mortar"></span> Services
										  </a>
									  </li>
									
									  <li class="nav-item icon-xs">
										  <a class="nav-link" id="package-list" data-toggle="pill" href="#tab-package" role="tab" aria-controls="tab-package" aria-selected="false">
											 <span class="flaticon-035-clinic-history-6"></span> Packages
										  </a>
									  </li>
									  @endif
								  	<!-- TAB-2 LINK -->
									<li class="nav-item icon-xs">
									    <a class="nav-link" id="tab2-list" data-toggle="pill" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">
									       <span class="flaticon-005-blood-donation-3"></span> Patient Feedback
									    </a>
									</li>
									@if($record->role_name  == config('application.hospital_role'))
									<!-- TAB-doctor LINK -->
									<li class="nav-item icon-xs">
									    <a class="nav-link" id="tab2-list" data-toggle="pill" href="#tab-doctor" role="tab" aria-controls="tab-2" aria-selected="false">
									       <span class="flaticon-016-doctor-1"></span> Doctors
									    </a>
									</li>
                                    @endif 
									<!-- TAB-3 LINK -->
									<li class="nav-item icon-xs">
									    <a class="nav-link" id="tab3-list" data-toggle="pill" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false">
									       <span class="flaticon-031-scanner"></span> Consult Q & A
									    </a>
									</li>

									

								</ul>

							</div>	<!-- END TABS NAVIGATION -->

							
							<!-- TABS CONTENT -->
							<div class="tab-content" id="pills-tabContent">


								<!-- TAB-1 CONTENT -->
								<div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab1-list">
									
										<div class="row mar-0">
												<div class="col-xs-12 col-md-6 col-xl-6 mar-0">
													@if($record->role_name  == config('application.hospital_role') || $record->role_name  == config('application.lab_role'))
													<strong>About {{$record->name}} </strong> 
													<p>{{$userInformation->meta_description}}</p>
													<br>
													@endif 
													<strong>AddreAddress </strong> 
														<p>{{$userInformation->address}}</p>
												</div>
											
												<div class="col-xs-12 col-md-6 col-xl-6 mar-0">
														@if ($record->role_name  == config('application.doctor_role'))
														 Fee 
														 <p>
														 @if(auth()->id() == null)
															 {{$userInformation->actual_fee}}
														@else
														<del> {{$userInformation->actual_fee}}</del> {{$userInformation->actual_fee-$userInformation->discounted_fee}}
														@endif	
															</p>
													 @elseif($record->role_name  == config('application.hospital_role'))
													 Establish in {{$userInformation->practice_since}}
													 @elseif($record->role_name  == config('application.lab_role'))
													 Establish in {{$userInformation->practice_since}}
													 @endif
														
												</div>
										</div>
									   @if(!empty($userInformation->hospital))
									   <br>
										<div class="row mar-0">
												<div class="col-xs-12 col-md-12 col-xl-12 mar-0">
												<strong>	Work in Hospital</strong> - {{$userInformation->hospital}}
												</div>
											
										</div>
										<br>
										@endif
									   @if(!empty($userInformation->doctor_education))
									   <br>
										<div class="row mar-0">
												<div class="col-xs-12 col-md-12 col-xl-12 mar-0">
												<strong>Education : </strong> 
														<ul class="dot">
															@foreach (explode("|",$userInformation->doctor_education) as $item)
															  <li>{{$item}}</li>	
															@endforeach
															</ul>
												</div>
											
										</div>
										<br>
										@endif
									   @if(!empty($userInformation->specializations))
									   <br>
										<div class="row mar-0">
												<div class="col-xs-12 col-md-12 col-xl-12 mar-0">
												<strong>Specializations :</strong><br>
													<ul class="dot">
													@foreach (explode("|",$userInformation->specializations) as $item)
													  <li>{{$item}}</li>	
													@endforeach
												    </ul>
												</div>
											
										</div>
										<br>
										@endif
									   @if(!empty($userInformation->services))
									   <br>
										<div class="row mar-0">
												<div class="col-xs-12 col-md-12 col-xl-12 mar-0">
												<strong>Services :</strong><br>
													<ul class="dot">
													@foreach (explode("|",$userInformation->services) as $item)
													  <li>{{$item}}</li>	
													@endforeach
												    </ul>
												</div>
											
										</div>
										<br>
										@endif
										<div class="row mar-0 mt-10">
											
												<div class="col-xs-12 col-md-6 col-xl-6 mar-0">
														<strong>General Timing </strong><br>
														<strong>Mon – Sat </strong>
														<p>Morning : {{ $userInformation->mon_sat_morning_time  }} </p>
														<p>Evening : {{ $userInformation->mon_sat_evening_time  }} </p>
														<strong>Sun</strong>
														<p>Morning : {{ $userInformation->sun_morning_time  }} </p>
												</div>
												@if($record->role_name  == config('application.doctor_role'))
												<div class="col-xs-12 col-md-6 col-xl-6 mar-0">
													<strong>Home Visit Timing</strong><br>
													@if($userInformation->home_visit == 1)
														<strong>Mon – Sat </strong>
														<p>Morning : {{ $userInformation->home_mon_sat_morning_time  }} </p>
														<p>Evening : {{ $userInformation->home_mon_sat_evening_time  }} </p>
														<strong>Sun</strong>
														<p>Morning : {{ $userInformation->home_sun_time  }} </p>
														@else
														<p>Not Available</p>
														@endif
												</div>
												@endif
										</div>
										@if(!empty($userInformation->facility))
										<br>
										<div class="row mar-0">
												<div class="col-xs-12 col-md-12 col-xl-12 mar-0">
													<strong>Facility</strong><br>
														{!! str_replace(',','<br>',$userInformation->facility) !!}
												</div>
										</div>
										@endif
									<div class="row d-flex align-items-center mar-0">
									<!-- Title -->	
							
							
                                @if(!$userCertificate->isEmpty())
								<!-- CERTIFICATES -->	
								<div class="certificates">

									<!-- Title -->	
									<h5 class="h5-md blue-color">Certificates</h5>

									<!-- Certificate Preview -->
									<div class="row">
										@foreach ($userCertificate as $certificate)
										<!-- Certificate Image -->
										<div class="col-xs-12 col-sm-6 col-lg-3">
											<div class="certificate-image">
												<a class="image-link" href="{{$certificate->image_url}}" title="{{$record->name}} certificate">
													<img class="img-fluid" src="{{$certificate->image_url}}" alt="{{$record->name}}-certificate" />
												</a>
											</div>
										</div>
										@endforeach
									</div>
								</div>	<!-- END CERTIFI-->
                                @endif   
									</div>	<!-- END TAB-1 CONTENT -->
								</div>
								@if($record->role_name  == config('application.lab_role'))
								<div class="tab-pane fade" id="tab-service" role="tabpanel" aria-labelledby="service-list">
										@if(!empty($services))
										<table class="table">
                                            <tr>
												<th>SR No</th>
												<th>Test Name</th>
												<th>Actual Fee</th>
												<th>Discount Fee</th>
												<th>Action</th>
											</tr>
											@foreach($services as $item)
											<tr>
												<td>1</td>
												<td>{{$item->name}}</td>
												<td>{{$item->actual_price}}</td>
												<td>{{$item->discount_price}}</td>
												<td>
													@hasanyrole(config('application.wallet_add_roles'))
													<a href="{{url('booking/'.$record->slug.'/'.$item->code)}}">Book Appointment</a>
													@endhasanyrole
												</td>
											</tr>
											@endforeach
										</table>
										@else
											No Service
										@endif	 
								</div>
								<div class="tab-pane fade" id="tab-package" role="tabpanel" aria-labelledby="package-list">
									@if(!empty($packages))
									<table class="table">
										<tr>
											<th>SR No</th>
											<th>Test Name</th>
											<th>Actual Fee</th>
											<th>Discount Fee</th>
											<th>Action</th>
										</tr>
										@foreach($packages as $item)
										<tr>
											<td>1</td>
											<td>{{$item->name}}</td>
											<td>{{$item->actual_price}}</td>
											<td>{{$item->discount_price}}</td>
											@hasanyrole(config('application.wallet_add_roles'))
											<td><a href="{{url('booking/'.$record->slug.'/'.$item->code)}}">Book Appointment</a></td>
										    @endhasanyrole
										</tr>
										@endforeach
									</table>
									@else
										No Package
									@endif	
								</div>
								@endif
								<!-- TAB-2 CONTENT -->
								<div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab2-list">
									<div class="row d-flex align-items-center mar-0">
										@foreach ($record->getUserRating as $item)
										<div class="col-xs-12">
												<h5 class="h5-md blue-color">
													<i class="fas fa-angle-double-right"></i>{{$item->getPatient->name}}</h5>
												{!!ratingView($item->rating)!!}
												<p><b>{{$item->title}}</b></p>
												<p>{{$item->description}}</p>
												<p><a href=""><i class="fas {{ ($item->recommend > 0)?'fa-thumbs-up':'fa-thumbs-down' }}"></i> </a>I recommend the doctor</p>
												<hr>
											</div>
	
										@endforeach
									</div>
									@hasanyrole(config('application.wallet_add_roles'))
									<div class="row mar-0">
										<a href="#"  class="btn btn-sm btn-blue blue-hover" id="reviewForm">Submit Review</a>
									</div>
									@endhasanyrole
								</div>	<!-- END TAB-2 CONTENT -->
							<!-- Button trigger modal -->
							@if($record->role_name  == config('application.hospital_role'))
							<!-- TAB-2 CONTENT -->
								<div class="tab-pane fade" id="tab-doctor" role="tabpanel" aria-labelledby="tab2-list">
									<div class="row d-flex align-items-center mar-0">
										@foreach ($userInformation->getHospitalDoctor as $item)
										<div class="col-lg-12">
											<div class="txt-widget-unit mb-15 clearfix d-flex align-items-center">
								
												<!-- Avatar -->
												<div class="txt-widget-avatar">
													<img src="{{$item->image_url}}" alt="testimonial-avatar">
												</div>
			
												<!-- Data -->
												<div class="txt-widget-data">
													<h5 class="h5-md steelblue-color">{{$item->name}}</h5>	
													<span>{{$item->experience}}</span>	
													<p class="blue-color">{{$item->timing}}</p>	
													@hasanyrole(config('application.wallet_add_roles'))
													<a href="{{url('booking/'.$record->slug.'/'.$item->getProductItem->code)}}">Book Appointment</a>
													@endhasanyrole

												</div>
			
											</div>
												
											</div>
	
										@endforeach
									</div>
								</div>	<!-- END TAB-2 CONTENT -->
							<!-- Button trigger modal -->
                            @endif

                              

								<!-- TAB-3 CONTENT -->
								<div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tab3-list">
									@foreach ($record->getQuestions as $item)
									<div class="row d-flex align-items-center mar-0">
										<div class="col-xs-12">
											
											<p><b>Question:- {{$item->title}}</b></p>
											<p>Answer :- {{$item->answer}}</p>
											<p>Helpful &nbsp;<a href=""><i class="fas fa-thumbs-up"></i> </a>&nbsp;<a href=""><i class="fas fa-thumbs-down"></i> </a></p>
											<hr>
										</div>
									</div>
									@endforeach
									@hasanyrole(config('application.wallet_add_roles'))
									<div class="row mar-0">
										<a href="#" class="btn btn-sm btn-blue blue-hover" data-toggle="modal" data-target="#questionFormModal">Ask Free Question</a>
									</div>
									@endhasanyrole
								</div>	<!-- END TAB-2 CONTENT -->
							<!-- Button trigger modal -->


<!-- Modal -->
@include('_question_form_modal')
								</div>	<!-- END TAB-3 CONTENT -->


							</div>	<!-- END TABS CONTENT -->


			 			</div>	
				 	</div>     <!-- End row -->	
				</div>     <!-- End container -->	
			</section>	<!-- END TABS-1 -->
						   		<!-- CATES -->	
						
					</div>
				</div>	  <!-- End container -->
			</section> <!-- END  DOCTOR-2 DETAILS -->

@include('_review_modal')
@endsection


@section('customScript')
<script src="{{ baseUrl('js/jquery.validate.min.js') }}"></script>
<script src="{{ baseUrl('scripts/detail.js') }}"></script>
<script src="{{ baseUrl('js/rating.js') }}"></script>
<script>
  var detailObj = new DetailFn();
  jQuery(document).ready(function(){
    detailObj.init();
  })
</script>
@endsection