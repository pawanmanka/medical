@extends('layouts.app')
@section('title',$title)
@section('breadcrumb')
		@include('layouts.breadcrumb')
@endsection

@section('content')
<div class="container">
    
            
        <div class="row">
            <!-- CONTACT FORM -->	
             <div class="col-md-10 col-lg-10  mt-50">
                 <div class="form-holder mb-40">
                        @include('flash::message')
                     <form  method="POST" id="profile_form" enctype="multipart/form-data" class="form-horizontal">
                        @csrf                    
                        @role(config('application.doctor_role'))
                            @include('_doctor_extra_infromation_fields') 
                        @endrole
                        @role(config('application.hospital_role'))
                            @include('_hospital_extra_information_fields') 
                        @endrole
                        @role(config('application.lab_role'))
                            @include('_lab_extra_information_fields') 
                        @endrole     
                        <!-- Contact Form Button -->
                        <div class="col-lg-12 mt-15 form-btn">  
                            <button type="submit" class="btn btn-blue blue-hover">Save</button> 
                        </div>
                                                  
                    </form> 

                 </div>	
             </div> 	<!-- END CONTACT FORM -->	


         </div>	<!-- End row -->			  


    </div>	   <!-- End container -->		
</section>	<!-- END CONTACTS-1 -->


@endsection

@section('customScript')
<link rel="stylesheet" href="{{baseUrl('plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker-standalone.css')}}">
<link rel="stylesheet" href="{{baseUrl('plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css')}}">
<link rel="stylesheet" href="{{baseUrl('plugins/chosen/chosen.css')}}">
<script src="{{ baseUrl('js/jquery.validate.min.js') }}"></script>
<script src="{{ baseUrl('plugins/bootstrap-datetimepicker/js/moment.js') }}"></script>
<script src="{{ baseUrl('plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

<script src="{{ baseUrl('plugins/chosen/chosen.jquery.js') }}"></script>


<script src="{{ baseUrl('scripts/profile.js') }}"></script>
<script>
  var profileObj = new ProfileFn();

  jQuery(document).ready(function(){


    profileObj.initExtraInfo();
  })
</script>
@endsection