@extends('layouts.app')
@section('title',$title)
@section('breadcrumb')
@include('layouts.breadcrumb')
@endsection

@section('content')
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
                        <div  class="col-md-12 mt-10">
                                <input type="text" name="time_start" id="time_start" value="{{old('time_start',isset($record)?$record->time_start:'')}}"  class="form-control required " placeholder="Time Start"  > 
                        </div>
                        <div  class="col-md-12 mt-10">
                                <input type="text" name="time_end" id="time_end" value="{{old('time_end',isset($record)?$record->time_end:'')}}"  class="form-control required " placeholder="Time End"  > 
                        </div>
                        <div  class="col-md-12 mt-10" >
                                {!! selectBox('time',config('application.timeArr'),old('time',isset($record)?$record->time:null),array('class'=>'form-control required'),'Select Time') !!}  	 
                        </div>
                        <div  class="col-md-12 mt-10" >
                                {!! selectBox('slot',config('application.slotArr'),old('slot',isset($record)?$record->slot:null),array('class'=>'form-control required'),'Select Slot') !!}  	 
                        </div>
                        <div  class="col-md-12 mt-10" >
                          <button class="btn btn-primary col-md-12" id="apply" type="button">Apply</button>
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
@include('_edit_slot_modal')

@endsection


@section('customScript')
<link rel="stylesheet" href="{{baseUrl('plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker-standalone.css')}}">
<link rel="stylesheet" href="{{baseUrl('plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css')}}">
<script src="{{ baseUrl('js/jquery.validate.min.js') }}"></script>
<script src="{{ baseUrl('plugins/bootstrap-datetimepicker/js/moment.js') }}"></script>
<script src="{{ baseUrl('plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ baseUrl('scripts/products.js') }}"></script>
<script>
    var productObj = new ProductFn();
    jQuery(document).ready(function () {
        productObj.initCreateSlot();
    })
</script>
@endsection