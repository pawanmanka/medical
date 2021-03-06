@extends('layouts.app')
@section('title',$title)
@section('breadcrumb')
		@include('layouts.breadcrumb')
@endsection

@section('content')
	<!-- DOCTOR-1 DETAILS -->
    <section id="doctor-1-details" class="doctor-details-section division pd-0">	
        <div class="container pl-0">
                    <div class="row mt-20">
                        <div class="col-md-12">
                            <div class="mt-20">
                               <div class="table-responsive">
                                @include('flash::message')
                                   <table id="appointment_table" class="table" >
                                   <thead>
                                   <tr>
                                       <th>SR. NO</th>
                                       <th>Name</th>
                                       @hasanyrole(config('application.booking_info_roles'))
                                       <th>Booking For</th>
                                       @endhasanyrole
                                       @hasanyrole(config('application.extra_info_roles'))
                                       <th>Gender</th>
                                       @endhasanyrole
                                       <th>Date</th>
                                       <th>Time</th>
                                       <th>Code</th>
                                       <th>Amount</th>
                                       <th>Action</th>
                                   </tr>
                                   </thead>
                                   <tbody></tbody>
                                   </table>
                            </div>
                            </div>
                     </div>
                    </div>
                    
        </div>	   <!-- End container -->
    </section>  <!-- END DOCTOR-1 DETAILS -->

@endsection

@section('customStyle')
<link rel="stylesheet" href="{{ baseUrl('admin/css/plugins/dataTables/datatables.min.css') }}">

@endsection
@section('customScript')
<script src="{{ baseUrl('admin/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ baseUrl('admin/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
     <script src="{{ baseUrl('scripts/appointment.js') }}"></script>
     <script>
       var appointmentObj = new AppointmentFn();
       jQuery(document).ready(function(){
           appointmentObj.init();
       })
     </script>
@endsection