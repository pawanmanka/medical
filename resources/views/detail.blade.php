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
         <div class="col-xs-7 col-sm-7 col-md-7 col-lg-8 left-panel testing-lab-panel">
        
            <div class="doctor_profile_sec">
               <div class="image-holder">
			   <img class="image-round" src="{{ $userInformation->profile_pic }}" alt="doctor-foto">
               </div>
               <div class="doc_detail">
                  <div class="doctor-details">
                     <ul class="pl-0 mb-0">
                        <li>{{ $record->name }} 
									@if(!empty($record->gender_title))
								       ({{$record->gender_title}})	 
								   @endif</li>
                        <li> @if ($record->role_name  == config('application.doctor_role'))
									   Specialist in {{$userInformation->category_name}} 	@if(!empty($userInformation->experience)) {{ $userInformation->experience }}  experience @endif
									@elseif($record->role_name  == config('application.hospital_role'))
									Multi-Specialty Hospital
									@elseif($record->role_name  == config('application.lab_role'))
									Services
									@endif</li>
                        <li>	 
								 {!!ratingView($record->avg_rating)!!}</li>
                     </ul>
                  </div>
               </div>
               <div class="clearfix"></div>
            </div> 
         </div>
         <div class="col-xs-5 col-sm-5 col-md-5 col-lg-4">
            <div class="book_appoin">
				@if ($record->role_name  == config('application.doctor_role'))
				@hasanyrole(config('application.wallet_add_roles'))		
				<a href="{{ url('/booking/'.$record->slug) }}" class="btn  btn-blue blue-hover" >Book an Appointment</a>
				@endhasanyrole	
				@endif
               <!-- <button>Book an appointment</button> -->
            </div>
         </div> 
             
	  </div>
	  
	  @if(!empty($record->getUserInformation->meta_description))
	  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="doc_desc">
               <b>Description : </b>{{$record->getUserInformation->meta_description}} 
            </div>
		 </div>
		 @endif  
		 

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
								    	<span class="flaticon-083-stethoscope"></span> 	 Info
								    	</a>
									  </li>
									  @if($record->role_name  == config('application.hospital_role'))
									  <!-- TAB-doctor LINK -->
									  <li class="nav-item icon-xs">
										  <a class="nav-link" id="specification-list" data-toggle="pill" href="#tab-specification" role="tab" aria-controls="tab-specification" aria-selected="false">
											 <span class="flaticon-137-doctor"></span> Specification
										  </a>
									  </li>
									  @endif 
									  @if($record->role_name  == config('application.lab_role'))
									  <!-- TAB-service LINK -->
									  <li class="nav-item icon-xs">
										  <a class="nav-link" id="service-list" data-toggle="pill" href="#tab-service" role="tab" aria-controls="tab-2" aria-selected="false">
										  <span class="flaticon-076-microscope"></span> Services
										  
										  </a>
									  </li>
									 
									  <li class="nav-item icon-xs">
										  <a class="nav-link" id="package-list" data-toggle="pill" href="#tab-package" role="tab" aria-controls="tab-package" aria-selected="false">
										  <span class="flaticon-056-first-aid-kit-5"></span> Packages
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
									       <span class="flaticon-137-doctor"></span> Doctors
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
									<div class="bk-white">
										<div class="row mar-0">
												<div class="col-xs-12 col-md-6 col-xl-6 mar-0">
													@if($record->role_name  == config('application.hospital_role') || $record->role_name  == config('application.lab_role'))
													<h5 class="h5-md ">About {{$record->name}} </h5> 
													<p>{{$userInformation->meta_description}}</p>
													<br>
													@endif 

													<h5 class="h5-md ">Address :</h5> 
														<p>{{$userInformation->address}} <i class="fa fa-map-marker"></i></p>

												</div>
											
												<div class="col-xs-12 col-md-6 col-xl-6 mar-0">
														@if ($record->role_name  == config('application.doctor_role'))
														@if(auth()->id() == null)
														<h5 class="h5-md "> Fee :</h5>
														@else
														<h5 class="h5-md ">Discounted Fee :</h5>
														@endif
														 <p>
														 @if(auth()->id() == null)
															 {{$userInformation->actual_fee}}
														@else
														 {{$userInformation->discounted_fee}}
														@endif	
															</p>
													 @elseif($record->role_name  == config('application.hospital_role'))
													 <h5 class="h5-md "> Establish in</h5> {{$userInformation->practice_since}}
													 @elseif($record->role_name  == config('application.lab_role'))
													 <h5 class="h5-md "> Establish in</h5> {{$userInformation->practice_since}}
													 @endif
														
												</div>
										</div>
									   @if(!empty($userInformation->hospital))
									   <br>
										<div class="row mar-0">
												<div class="col-xs-12 col-md-12 col-xl-12 mar-0">
												<h5 class="h5-md ">	Work in Hospital</h5> - {{$userInformation->hospital}}
												</div>
											
										</div>
										<br>
										@endif

										<div class="row mar-0 mt-10">
											
												<div class="col-xs-12 col-md-6 col-xl-6 mar-0">
												<h5 class="h5-md ">General Timing </h5><br>
														<h6>Mon – Sat </h6>
														<p>Morning : {{ $userInformation->mon_sat_morning_time  }} </p>
														<p>Evening : {{ $userInformation->mon_sat_evening_time  }} </p>
														<h6>Sun</h6>
														<p>Morning : {{ $userInformation->sun_morning_time  }} </p>
												</div>
												@if($record->role_name  == config('application.doctor_role'))
												<div class="col-xs-12 col-md-6 col-xl-6 mar-0">
												<h5 class="h5-md ">Home Visit Timing</h5><br>
													@if($userInformation->home_visit == 1)
														<h6>Mon – Sat </h6>
														<p>Morning : {{ $userInformation->home_mon_sat_morning_time  }} </p>
														<p>Evening : {{ $userInformation->home_mon_sat_evening_time  }} </p>
														<h6>Sun</h6>
														<p>Morning : {{ $userInformation->home_sun_time  }} </p>
														@else
														<p>Not Available</p>
														@endif
												</div>
												@endif
										</div>
										<br>
									   @if(!empty($userInformation->doctor_education))
									   <br>
										<div class="row mar-0">
												<div class="col-xs-12 col-md-12 col-xl-12 mar-0">
												<h5 class="h5-md ">Education : </h5> 
														<ul class="dot">
															@foreach (explode("|",$userInformation->doctor_education) as $item)
															  <li>{{$item}}</li>	
															@endforeach
															</ul>
												</div>
											
										</div>
										
										@endif
									   @if(!empty($userInformation->specializations))
									   <br>
										<div class="row mar-0">
												<div class="col-xs-12 col-md-12 col-xl-12 mar-0">
												<h5 class="h5-md ">Specializations :</h5><br>
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
												<h5 class="h5-md ">Services :</h5><br>
													<ul class="dot">
													@foreach (explode("|",$userInformation->services) as $item)
													  <li>{{$item}}</li>	
													@endforeach
												    </ul>
												</div>
											
										</div>
										<br>
										@endif
										
										@if(!$userPhotos->isEmpty())
										<!-- CERTIFICATES -->	
										<div class="certificates">
		
											<!-- Title -->	
											<h5 class="h5-md ">Photos</h5>
		
											<!-- Certificate Preview -->
											<div class="row">
												@foreach ($userPhotos as $certificate)
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
										@if(!empty($userInformation->facility))
										<br>
										<div class="row mar-0">
												<div class="col-xs-12 col-md-12 col-xl-12 mar-0">
												<h5 class="h5-md ">Facility</h5>
														{!! str_replace(',','<br>',$userInformation->facility) !!}
												</div>
										</div>
										@endif
										@if(!empty($userInformation->mode_of_payment))
										<br>
										<div class="row mar-0">
												<div class="col-xs-12 col-md-12 col-xl-12 mar-0">
												<h5 class="h5-md ">Mode of Payment</h5>
														{{$userInformation->mode_of_payment}}
												</div>
										</div>
										@endif
									<div class="row d-flex align-items-center mar-0">
									<!-- Title -->	
							
							
                                @if(!$userCertificate->isEmpty())
								<!-- CERTIFICATES -->	
								<div class="certificates">

									<!-- Title -->	
									<h5 class="h5-md ">Certificate & award receives</h5>

									<!-- Certificate Preview -->
									<div class="row">
										@foreach ($userCertificate as $certificate)
										<!-- Certificate Image -->
										<div class="col-xs-12 col-sm-6 col-lg-3">
											<div class="certificate-image">
												<a class="image-link" href="{{$certificate->image_url}}" title="{{$certificate->title}}">
													<img class="img-fluid" src="{{$certificate->image_url}}" alt="{{$certificate->title}}" />
												</a>
											</div>
										</div>
										@endforeach
									</div>
								</div>	<!-- END CERTIFI-->
								@endif   
								</div>
									</div>	<!-- END TAB-1 CONTENT -->
								</div>
								@if($record->role_name  == config('application.lab_role'))
								<div class="tab-pane fade" id="tab-service" role="tabpanel" aria-labelledby="service-list">
										@if(!empty($services))
										<div class=" bk-white">
										<table class="table table-striped">
                                            <tr>
												<th>SR No</th>
												<th>Test Name</th>
												<th>Actual Fee</th>
												<th>Discount Fee(Only for member)</th>
												<th>Action</th>
											</tr>
											<?php $i=1; ?>
											@foreach($services as $item)
											<tr>
												<td><?php echo $i; ?></td>
												<td>{{$item->name}}</td>
												<td>{{$item->actual_price}}</td>
												<td>{{$item->discount_price}}</td>
												<td>
													@hasanyrole(config('application.wallet_add_roles'))
													<a href="{{url('booking/'.$record->slug.'/'.$item->code)}}">Book Appointment</a>
													@endhasanyrole
												</td>
											</tr>
											<?php $i++; ?>
											@endforeach
										</table>
										</div>
										@else
											No Service
										@endif	 
								</div>
								<div class="tab-pane fade" id="tab-package" role="tabpanel" aria-labelledby="package-list">
									@if(!empty($packages))
									<div class=" bk-white">
									<table class="table table-striped">
										<tr>
											<th>SR No</th>
											<th>Package Name /Code Description</th>
											<th>Package  Fee</th>
											<th>Discounted Fee(Only for member)</th>
											<th>Action</th>
											
										</tr>
										<?php $i=1; ?>
										@foreach($packages as $item)
										<tr>
										<td><?php echo $i; ?></td>
											<td>{{$item->name}}</td>
											<td>{{$item->actual_price}}</td>
											<td>{{$item->discount_price}}</td>
											@hasanyrole(config('application.wallet_add_roles'))
											<td><a href="{{url('booking/'.$record->slug.'/'.$item->code)}}">Book Appointment</a></td>
										    @endhasanyrole
										</tr>
										<?php $i++; ?>
										@endforeach
									</table>
									</div>
									@else
										No Package
									@endif	
								</div>
								@endif
								<!-- TAB-2 CONTENT -->
								
								<div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab2-list">
								
									<div id="review_list_div"></div>
								
									@hasanyrole(config('application.wallet_add_roles'))
									<div class="text-align-end mar-0">
										<a href="#"  class="btn btn-sm btn-blue blue-hover" id="reviewForm">Submit Review</a>
									</div>
									@endhasanyrole
									@if(!empty($record->get_user_rating_count))	
									<div class="bk-white mt-10" id="get_reviews">
									   <div class="show_all"><a href=""> Show all reviews ({{config('application.question_feedback_item_limit')}}) </a></div>
								   </div>
								   @endif
								</div>	<!-- END TAB-2 CONTENT -->
							<!-- Button trigger modal -->
							@if($record->role_name  == config('application.hospital_role'))
							<!-- TAB-2 CONTENT -->
								<div class="tab-pane fade" id="tab-specification" role="tabpanel" aria-labelledby="tab2-list">
									<div class="row d-flex align-items-center mar-0">
										 <select class="form-control"  id="specification_doctor">
											   <option>Select</option>
											   @foreach ($userInformation->getHospitalDoctor->pluck('specification','specification') as $item)
											   @if(!empty(trim($item)))
												   <option value="class-{{str_slug($item)}}">{{$item}}</option>
											   @endif	   
											   @endforeach
										 </select>
										@foreach ($userInformation->getHospitalDoctor as $item)
										<div class="col-lg-12 bk-white mb-10 class-all-specification class-{{str_slug($item->specification)}}">
											<div class="txt-widget-unit mb-15 clearfix d-flex align-items-center">
								
												<!-- Avatar -->
												<div class="txt-widget-avatar">
													<img src="{{$item->image_url}}" alt="testimonial-avatar">
												</div>
			
												<!-- Data -->
												<div class="txt-widget-data ">
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
							<!-- Button trigger modal -->
							@if($record->role_name  == config('application.hospital_role'))
							<!-- TAB-2 CONTENT -->
								<div class="tab-pane fade" id="tab-doctor" role="tabpanel" aria-labelledby="tab2-list">
									<div class="row d-flex align-items-center mar-0">
										
										@foreach ($userInformation->getHospitalDoctor as $item)
										<div class="col-lg-12 bk-white mb-10">
											<div class="txt-widget-unit mb-15 clearfix d-flex align-items-center">
								
												<!-- Avatar -->
												<div class="txt-widget-avatar">
													<img src="{{$item->image_url}}" alt="testimonial-avatar">
												</div>
			
												<!-- Data -->
												<div class="txt-widget-data ">
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
									<div id="question_list_div"></div>
									@hasanyrole(config('application.wallet_add_roles'))
											<div class="sub_rew_btn"><a href="#" class="btn btn-sm btn-blue blue-hover" data-toggle="modal" data-target="#questionFormModal">Ask Free Question</a></div>
											
									@endhasanyrole
									@if(!empty($record->get_questions_count))	
									 <div class="bk-white mt-10" id="get_questions">
										<div class="show_all"><a href=""> Show all patient questions ({{config('application.question_feedback_item_limit')}}) </a></div>
									</div>
									@endif
									
								
									
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
  var currentUser = "{{$currentUser}}";
  var questionsCount = "{{$record->get_questions_count}}";
  var reviewCount = "{{$record->get_user_rating_count}}";
  jQuery(document).ready(function(){
    detailObj.init();
  })
</script>
@endsection