@extends('layouts.app')
@section('title',$title)
@section('breadcrumb')
		@include('layouts.breadcrumb')
@endsection

@section('content')
	<!-- DOCTOR-1 DETAILS -->
    <section id="doctor-1-details" class="doctor-details-section division pd-0">	
        <div class="container-fluid pl-0">
                    <div class="row mar-0">
                      
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row pt-50">
                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                        <a href="{{ url('profile') }}">
                                            <div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                            <div class="txt-widget-data">
                                            <h5 class="h5-md steelblue-color">My info</h5>	
                                            </div>
                                                <div class="row mar-0" style="text-align:center">
                                                <i class="fas fa-info-circle fa-3x"></i>
                                                </div>
                                            </div>
                                        </a>

                                    </div>
                                    @hasanyrole(config('application.extra_info_roles'))
                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                        <a href="{{ url('extra-info') }}">
                                            <div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                            <div class="txt-widget-data">
                                            <h5 class="h5-md steelblue-color">My Extra info</h5>	
                                            </div>
                                                <div class="row mar-0" style="text-align:center">
                                                <i class="fas fa-info-circle fa-3x"></i>
                                                </div>
                                            </div>
                                        </a>

                                    </div>
                                    @endhasanyrole
                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                        <a href="{{ url('my-wallet') }}">
                                            <div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                            <div class="txt-widget-data">
                                            <h5 class="h5-md steelblue-color">My Wallet</h5>	
                                            </div>
                                                <div class="row mar-0" style="text-align:center">
                                                <i class="fas fa-wallet fa-3x"></i>
                                                </div>
                                            </div>
                                        </a>

                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                        <a href="{{ url('my-appointment') }}">
                                            <div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                            <div class="txt-widget-data">
                                            <h5 class="h5-md steelblue-color">My Appointment</h5>	
                                            </div>
                                                <div class="row mar-0" style="text-align:center">
                                                <i class="fas fa-calendar-check fa-3x"></i>
                                                </div>
                                            </div>
                                        </a>

                                    </div>
                                    @hasanyrole(config('application.extra_info_roles'))

                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                        <a href="{{ url('my-feedbacks') }}">
                                            <div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                            <div class="txt-widget-data">
                                            <h5 class="h5-md steelblue-color">My Feedback / Q &A</h5>	
                                            </div>
                                                <div class="row mar-0" style="text-align:center">
                                                <i class="fas fa-calendar-check fa-3x"></i>
                                                </div>
                                            </div>
                                        </a>

                                    </div>
                                    @endhasanyrole
                                    <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
                                        <a href="{{ url('change-password') }}">
                                            <div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
                                            <div class="txt-widget-data">
                                            <h5 class="h5-md steelblue-color">Change Password</h5>	
                                            </div>
                                                <div class="row mar-0" style="text-align:center">
                                                <i class="fas fa-key fa-3x"></i>
                                                </div>
                                            </div>
                                        </a>

                                    </div>
                                </div>
                               
                            </div>
                    </div>
                    
        </div>	   <!-- End container -->
    </section>  <!-- END DOCTOR-1 DETAILS -->

@endsection