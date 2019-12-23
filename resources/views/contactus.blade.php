@extends('layouts.app')
@section('title','Home')
@section('content')
<div id="gmap" class="gmap" style="position: relative; overflow: hidden;">
    <div style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);">
        <div class="gm-err-container"><div class="gm-err-content">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7155.737870261372!2d73.00086421054938!3d26.26591682566859!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39418c236bd931b5%3A0xa0cd6adb082c0837!2sShastri%20Nagar%2C%20Jodhpur%2C%20Rajasthan!5e0!3m2!1sen!2sin!4v1575541910816!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
            </div>
            </div>
            </div>
  <section id="contacts-1" class="wide-60 contacts-section division">				
				<div class="container">


					<!-- SECTION TITLE -->	
					<div class="row">	
						<div class="col-lg-10 offset-lg-1 section-title">	

							<!-- Title 	-->	
							<h3 class="h3-md steelblue-color">Have a Question? Get In Touch</h3>	

							<!-- Text -->
							<p>Have a question? Want to book an appointment for yourself or your children? Give us a call
							   or send an email to contact the MedService.
							</p>
								
						</div>
					</div>

						
					<div class="row">	


		 				<!-- CONTACTS INFO -->
		 				<div class="col-md-5 col-lg-4">

		 					<!-- General Information -->
		 					<div class="contact-box mb-40">
								<h5 class="h5-sm steelblue-color">General Information</h5>
								<p>Shastri Nagar ,</p> 
								<!--<p>Victoria 3000 Australia</p>-->
								<p>Phone: +8561903387</p>
								<p>Email: <a href="mailto:info@arogyarth.com" class="blue-color">info@arogyarth.com</a></p>
		 					</div>

		 					<!-- Patient Experience -->
		 					<div class="contact-box mb-40">
								<h5 class="h5-sm steelblue-color">Patient Experience</h5>
							    <p>Shastri Nagar ,</p> 
								<!--<p>Victoria 3000 Australia</p>-->
								<p>Phone: +8561903387</p>
								<p>Email: <a href="mailto:info@arogyarth.com" class="blue-color">info@arogyarth.com</a></p>
		 					</div>

		 					<!-- Working Hours -->
		 					<div class="contact-box mb-40">
								<h5 class="h5-sm steelblue-color">Working Hours</h5>
								<p>Monday – Friday : 8:00 AM - 8:00 PM</p> 
								<p>Saturday : 10:00 AM - 6:00 PM</p>
								<p>Sunday : 10:00 AM - 4:00 PM</p>
		 					</div>

						</div>	<!-- END CONTACTS INFO -->


						<!-- CONTACT FORM -->	
				 		<div class="col-md-7 col-lg-8">
				 			<div class="form-holder mb-40">
				 				<form name="contactForm" class="row contact-form" novalidate="novalidate">
				                                            
					                <!-- Contact Form Input -->
					                <div id="input-name" class="col-md-12 col-lg-6">
					                	<input type="text" name="name" class="form-control name" placeholder="Enter Your Name*" required=""> 
					                </div>
					                        
					                <div id="input-email" class="col-md-12 col-lg-6">
					                	<input type="text" name="email" class="form-control email" placeholder="Enter Your Email*" required=""> 
					                </div>

					                <div id="input-phone" class="col-md-12 col-lg-6">
					                	<input type="tel" name="phone" class="form-control phone" placeholder="Enter Your Phone Number*" required=""> 
					                </div>	

					                <!-- Form Select -->
					                <div id="input-patient" class="col-md-12 col-lg-6 input-patient">
					                    <select id="inlineFormCustomSelect3" name="patient" class="custom-select patient" required="">
					                        <option value="">Have You Visited Us Before?*</option>
											<option>New Patient</option>
											<option>Returning Patient</option>
											<option>Other</option>
					                    </select>
					                </div>

					                <div id="input-subject" class="col-lg-12">
					                	<input type="text" name="subject" class="form-control subject" placeholder="Subject*" required=""> 
					                </div>					                          
					                        
					                <div id="input-message" class="col-lg-12 input-message">
					                	<textarea class="form-control message" name="message" rows="6" placeholder="Your Message ..." required=""></textarea>
					                </div> 
					                                            
					                <!-- Contact Form Button -->
					                <div class="col-lg-12 mt-15 form-btn">  
					                	<button type="submit" class="btn btn-blue blue-hover submit">Send Your Message</button> 
					                </div>
					                                                              
					                <!-- Contact Form Message -->
					                <div class="col-lg-12 contact-form-msg text-center">
					                	<div class="sending-msg"><span class="loading"></span></div>
					                </div>  
				                                              
				                </form> 

				 			</div>	
				 		</div> 	<!-- END CONTACT FORM -->	


				 	</div>	<!-- End row -->			  
 

				</div>	   <!-- End container -->		
			</section>
			

@endsection
