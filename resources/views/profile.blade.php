@extends('layouts.app')
@section('title',$title)
@section('breadcrumb')
		@include('layouts.breadcrumb')
@endsection

@section('content')
<div class="container">
    
            
        <div class="row">
            <!-- CONTACT FORM -->	
             <div class="col-md-6 col-lg-6 offset-lg-3 col-md-offset-5 mt-50">
                 <div class="form-holder mb-40">
                        @include('flash::message')
                     <form  method="POST" enctype="multipart/form-data" id="profile_form" class="row contact-form">
                        @csrf                        
                        @role(config('application.patient_role'))
                        @include('_patient_register_fields') 
                        @endrole
                        @role(config('application.doctor_role'))
                            @include('_doctor_register_fields') 
                        @endrole
                        @role(config('application.hospital_role'))
                            @include('_hospital_register_fields') 
                        @endrole
                        @role(config('application.lab_role'))
                            @include('_lab_register_fields') 
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
<script src="{{ baseUrl('js/jquery.validate.min.js') }}"></script>
<script src="{{ baseUrl('scripts/profile.js') }}"></script>
<script>
  var profileObj = new ProfileFn();
  var categoryArr = {!! json_encode($categoryArr) !!}
  jQuery(document).ready(function(){
     if(Object.keys(categoryArr).length > 0){
         profileObj.categorySubCategory(categoryArr);

     } 
    profileObj.init();
  })
</script>
@endsection