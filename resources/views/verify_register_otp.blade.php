@extends('layouts.app')
@section('title','Verify Otp')
@section('content')

		<!-- CONTACTS-1
			============================================= -->
			<section id="contacts-1" class="wide-60 contacts-section division">				
				<div class="container">
					<div class="row">	
						<div class="col-lg-10 offset-lg-1 section-title">
							<!-- Title 	-->	
							<h3 class="h3-md steelblue-color">Verify Otp</h3>
						</div>
					</div>
						
					<div class="row">
						<!-- CONTACT FORM -->	
				 		<div class="col-md-6 col-lg-6 offset-lg-3 offset-md-3">
				 			<div class="form-holder mb-40">
									@include('flash::message')
				 				<form method="POST" id="login"  class="row contact-form">
				                     @csrf                       
					                <!-- Contact Form Input -->
					                <div id="input-name" class="col-md-12">
					                	<input type="text" name="otp" class="form-control required" placeholder="otp*"  required> 
					                </div>
					                        
					              			                                            
					                <!-- Contact Form Button -->
					                <div class="col-lg-12 mt-15 form-btn">  
					                	<button type="submit" class="btn btn-blue blue-hover submit">Submit</button> 
					                	<button type="button" style="display:none;" class="btn btn-blue blue-hover resend">Resend</button> 
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
    registerObj.verifyInit({{$mobile}});
  })
</script>
@endsection