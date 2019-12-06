@extends('layouts.app')
@section('title','Login')
@section('content')

	<!-- CONTACTS-1
			============================================= -->
			<section id="contacts-1" class="wide-60 contacts-section division login-section">				
				<div class="container">
							
						
					<div class="row">						
				 		<div class="col-md-6 col-lg-6 offset-lg-3 col-md-offset-5">
							<a href="{{ url('/patient/login') }}">
								<div class="card">
									<div class="card-body">Patient Login</div>
								</div>
							</a>
				 		</div> 
				 		<div class="col-md-6 col-lg-6 offset-lg-3 col-md-offset-5">
							<a href="{{ url('/doctor/login') }}">
								<div class="card">
									<div class="card-body">Doctor Login</div>
								</div>
							</a>
				 		</div> 
				 		<div class="col-md-6 col-lg-6 offset-lg-3 col-md-offset-5">
							<a href="{{ url('/hospital/login') }}">
								<div class="card">
									<div class="card-body">Hospital Login</div>
								</div>
							</a>
				 		</div> 	
				 		<div class="col-md-6 col-lg-6 offset-lg-3 col-md-offset-5">
							<a href="{{ url('/lab/login') }}">
								<div class="card">
									<div class="card-body">Testing Lab</div>
								</div>
							</a>
				 		</div>
				 		<div class="col-md-6 col-lg-6 offset-lg-3 col-md-offset-5">
				 			<p>Don't have a account <a href="{{ url('register') }}">Register Account ?</a></p>
				 		</div>
				 		


				 	</div>	<!-- End row -->			  
 

				</div>	   <!-- End container -->		
			</section>	<!-- END CONTACTS-1 -->



@endsection