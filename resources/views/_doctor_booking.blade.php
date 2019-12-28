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
            <div class="col-xs-12 col-sm-3">
                    <form id="slot_form" action="">
                <div class="nav flex-column nav-pills slot_create_form" id="v-pills-tab" data-id="{{isset($record)?$record->id:''}}"  role="tablist" aria-orientation="vertical">
                        <div  class="col-md-12">
                                <input type="text" name="date" value="{{old('date',isset($record)?$record->dateFormated:'')}}" id="date" class="form-control required " placeholder="Date"  > 
                        </div>
                </div>
            </form>
            </div>
            <div class="col-xs-12 col-sm-9">
            <form id="slot_form_date" method="POST">
                @csrf
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab">
                        <input type="hidden" name="date" value="{{old('date',isset($record)?$record->date:'')}}" id="date" >
                        <input type="hidden" name="time_start"  value="{{old('time_start',isset($record)?$record->time_start:'')}}" > 
                        <input type="hidden" name="time_end" value="{{old('time_end',isset($record)?$record->time_end:'')}}"  > 

                        <section id="services-7" class="bg-lightgrey  servicess-section division">
                            <div class="container">
                                <div class="row" id="slot_body">
                                          
                                </div> <!-- End row -->
                            </div> <!-- End container -->
                        </section>
                    </div>
                </div>
                <div  class="col-md-12 mt-10 slot_body_div" style="display:none;" >
                    <button class="btn btn-primary" id="slot_body_button" type="submit">Submit</button>
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