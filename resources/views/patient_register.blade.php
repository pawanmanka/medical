@extends('layouts.app')
@section('title','Patient Register')
@section('content')
<section id="contacts-1" class="wide-60 contacts-section division">				
    <div class="container">
        <div class="row">	
            <div class="col-lg-10 offset-lg-1 section-title">	

                <!-- Title 	-->	
                <h3 class="h3-md steelblue-color">Patient Register</h3>	

                
                    
            </div>
        </div>

        
            
        <div class="row">	


            <!-- CONTACT FORM -->	
             <div class="col-md-6 col-lg-6 offset-lg-3 col-md-offset-5">
                 <div class="form-holder mb-40">
                        @include('flash::message')
                     <form  method="POST" id="register_form" class="row contact-form">
                        @csrf                        
                        @include('_patient_register_fields')         
                        <!-- Contact Form Button -->
                        <div class="col-lg-12 mt-15 form-btn">  
                            <button type="submit" class="btn btn-blue blue-hover">Register</button> 
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
<script src="{{ baseUrl('scripts/register.js') }}"></script>
<script>
  var registerObj = new RegisterFn();
  jQuery(document).ready(function(){
    registerObj.init();
  })
</script>
@endsection