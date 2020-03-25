@extends('layouts.app')
@section('title',$title)
@section('breadcrumb')
		@include('layouts.breadcrumb')
@endsection

@section('content')
	<!-- DOCTOR-1 DETAILS -->
    <section id="doctor-1-details" class="doctor-details-section division pd-0">	
        <div class="container pl-0">
                    <div class="row mar-0">
                      
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row pt-50">
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                       
                                            <div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                                <div class="txt-widget-data dis-flex">
                                                    <h5 class="h5-md steelblue-color">My Profile</h5>
                                                    <a href="{{ url('profile') }}" class="dash-icon">	
                                                        <i class="fas fa-pencil-alt fa-x"></i>
                                                        <span>Edit</span>
                                                    </a>
                                                </div>
                                                <div class="row mar-0" style="text-align:center">
                                                    <i class="fas fa-info-circle fa-3x"></i>
                                                </div>
                                            </div>
                                    </div>
                                    @hasanyrole(config('application.extra_info_roles'))
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                      
                                            <div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                            <div class="txt-widget-data dis-flex">
                                                     <h5 class="h5-md steelblue-color">My Schedule</h5>	
                                                     <a href="{{ url('extra-info') }}" class="dash-icon">	
                                                        <i class="fas fa-pencil-alt fa-x"></i>
                                                        <span>Edit</span>
                                                    </a>
                                            </div>
                                                <div class="row mar-0" style="text-align:center">
                                                <i class="fas fa-info-circle fa-3x"></i>
                                                </div>
                                            </div>
                                        
                                    </div>
                                    @endhasanyrole
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                       
                                            <div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                            <div class="txt-widget-data dis-flex">
                                                <h5 class="h5-md steelblue-color">My Wallet</h5>
                                                <a href="{{ url('my-wallet') }}" class="dash-icon">	
                                                        <i class="fas fa-pencil-alt fa-x"></i>
                                                        <span>Edit</span>
                                                    </a>	
                                            </div>
                                                <div class="row mar-0" style="text-align:center">
                                                <i class="fas fa-wallet fa-3x"></i>
                                                </div>
                                            </div>
                                       
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                        
                                            <div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                            <div class="txt-widget-data dis-flex">
                                                 <h5 class="h5-md steelblue-color">My Appointment</h5>	
                                                 <a href="{{ url('my-appointment') }}" class="dash-icon">	
                                                        <i class="fas fa-pencil-alt fa-x"></i>
                                                        <span>Edit</span>
                                                    </a>
                                            </div>
                                                <div class="row mar-0" style="text-align:center">
                                                <i class="fas fa-calendar-check fa-3x"></i>
                                                </div>
                                            </div>
                                       
                                    </div>
                                    @hasanyrole(config('application.extra_info_roles'))

                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                       
                                            <div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                            <div class="txt-widget-data dis-flex">
                                                <h5 class="h5-md steelblue-color">Feedback / Q &A</h5>	
                                                <a href="{{ url('my-feedbacks') }}" class="dash-icon">	
                                                        <i class="fas fa-pencil-alt fa-x"></i>
                                                        <span>Edit</span>
                                                    </a>
                                            </div>
                                                <div class="row mar-0" style="text-align:center">
                                                <i class="fas fa-calendar-check fa-3x"></i>
                                                </div>
                                            </div>
                                       
                                    </div>
                                    @endhasanyrole
                                    
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                       
                                            <div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                            <div class="txt-widget-data dis-flex">
                                                <h5 class="h5-md steelblue-color">Change Password</h5>	
                                                <a href="{{ url('change-password') }}" class="dash-icon">	
                                                        <i class="fas fa-pencil-alt fa-x"></i>
                                                        <span>Edit</span>
                                                    </a>
                                            </div>
                                                <div class="row mar-0" style="text-align:center">
                                                <i class="fas fa-key fa-3x"></i>
                                                </div>
                                            </div>
                                       
                                    </div>
                                    @hasanyrole(config('application.extra_info_roles'))

                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                       
                                            <div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                            <div class="txt-widget-data dis-flex">
                                                <h5 class="h5-md steelblue-color">Bank Detail</h5>	
                                                <a href="{{ url('my-bank-detail') }}" class="dash-icon">	
                                                        <i class="fas fa-pencil-alt fa-x"></i>
                                                        <span>Edit</span>
                                                    </a>
                                            </div>
                                                <div class="row mar-0" style="text-align:center">
                                                <i class="fas fa-bank fa-3x"></i>
                                                </div>
                                            </div>
                                       
                                    </div>
                                    @endhasanyrole
                                    
                                    @hasanyrole(config('application.lab_role'))
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                       
                                        <div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                        <div class="txt-widget-data dis-flex">
                                            <h5 class="h5-md steelblue-color">My Service</h5>	
                                            <a href="{{ url('/my-services') }}" class="dash-icon">	
                                                    <i class="fas fa-pencil-alt fa-x"></i>
                                                    <span>Edit</span>
                                                </a>
                                        </div>
                                            <div class="row mar-0" style="text-align:center">
                                            <i class="fas fa-bank fa-3x"></i>
                                            </div>
                                        </div>
                                   
                                </div>
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                       
                                        <div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                        <div class="txt-widget-data dis-flex">
                                            <h5 class="h5-md steelblue-color">My Packages</h5>	
                                            <a href="{{ url('/my-packages') }}" class="dash-icon">	
                                                    <i class="fas fa-pencil-alt fa-x"></i>
                                                    <span>Edit</span>
                                                </a>
                                        </div>
                                            <div class="row mar-0" style="text-align:center">
                                            <i class="fas fa-bank fa-3x"></i>
                                            </div>
                                        </div>
                                   
                                </div>
                                    @endhasanyrole
                                   
                                </div>
                               
                            </div>
                    </div>
                    
        </div>	   <!-- End container -->
    </section>  <!-- END DOCTOR-1 DETAILS -->

@endsection