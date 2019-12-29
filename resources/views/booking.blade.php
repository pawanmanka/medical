@extends('layouts.app')
@section('title',$title)
@section('breadcrumb')
		@include('layouts.breadcrumb')
@endsection

@section('content')
	<!-- DOCTOR-1 DETAILS -->
    <section id="doctor-1-details" class="doctor-details-section division pd-0">	
        <div class="container-fluid pl-0">
                   <!-- APPOINTMENT PAGE
			============================================= -->
<div id="appointment-page" class="wide-60 appointment-page-section division">
    <div class="container">
       
        <div class="row">
            
            <div class="col-lg-12">
            <form id="booking_form_date" method="POST" class="row contact-form">
                @csrf
                <div class="col-lg-6">
                    <div>
                        <section id="services-7" class="">
                            <div class="container">
                                <div class="row" >
                                    <!-- Contact Form Input -->
                                    <div class="col-lg-12">
                                        @include('flash::message')
                                        <table class="table">
                                            <tr><td>Booking for {{ $userObj->name }}</td></tr>    
                                            <tr><td>{{ $productDetail->name }}</td></tr>    
                                            <tr><td>{{ $productDetail->price }}</td></tr> 
                                            @if($doctorFlag)
                                            <tr><td>{{ $productDetail->date }}</td></tr> 
                                            @endif  
                                            @if($productDetail->lab_product_type == 2)   
                                            <tr><td>{{ $productDetail->description }}</td></tr>
                                            @endif    
                                          </table>  
                                          @if(!$doctorFlag)
                                          <div  class="col-md-12">
                                                  <input type="text" name="date" value="{{old('date',isset($record)?$record->dateFormated:'')}}" id="date" class="form-control required " placeholder="Date"  > 
                                          </div>
                                          @endif
                                    </div>
                                </div> <!-- End row -->
                            </div> <!-- End container -->
                        </section>
                    </div>
                </div>
                <div  class="col-md-12 mt-10 slot_body_div"  >
                    <button class="btn btn-primary"  type="submit">Submit</button>
                </div>
            </form>
            </div>
        </div>
   
    </div> <!-- End container -->
</div> <!-- END APPOINTMENT PAGE -->
        </div>	   <!-- End container -->
    </section>  <!-- END DOCTOR-1 DETAILS -->

@endsection

@section('customScript')

<link rel="stylesheet" href="{{baseUrl('plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker-standalone.css')}}">
<link rel="stylesheet" href="{{baseUrl('plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css')}}">
<script src="{{ baseUrl('js/jquery.validate.min.js') }}"></script>
<script src="{{ baseUrl('plugins/bootstrap-datetimepicker/js/moment.js') }}"></script>
<script src="{{ baseUrl('plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ baseUrl('scripts/booking.js') }}"></script>
<script>
    var bookingObj = new BookingFn();
    jQuery(document).ready(function () {
        bookingObj.init();
    })
</script>
@endsection