@extends('layouts.app')
@section('title','Register')
@section('content')

<section id="contacts-1" class="wide-60 contacts-section division login-section">				
    <div class="container">
                
            @include('flash::message')	
        <div class="row">	
                				
             <div class="col-md-6 col-lg-6 offset-lg-3 col-md-offset-5">
                <a href="{{ url('patient/register') }}">
                    <div class="card">
                        <div class="card-body">Patient Register</div>
                    </div>
                </a>
             </div> 
             <div class="col-md-6 col-lg-6 offset-lg-3 col-md-offset-5">
                <a href="{{ url('doctor/register') }}">
                    <div class="card">
                        <div class="card-body">Doctor Register</div>
                    </div>
                </a>
             </div> 
             <div class="col-md-6 col-lg-6 offset-lg-3 col-md-offset-5">
                <a href="{{ url('hospital/register') }}">
                    <div class="card">
                        <div class="card-body">Hospital Register</div>
                    </div>
                </a>
             </div> 	
             <div class="col-md-6 col-lg-6 offset-lg-3 col-md-offset-5">
                <a href="{{ url('lab/register') }}">
                    <div class="card">
                        <div class="card-body">Testing Lab</div>
                    </div>
                </a>
             </div>
           
             <div class="col-md-6 col-lg-6 offset-lg-3 col-md-offset-5">
                <p>you have account  <a href="{{ url('login') }}">Login</a></p>
            </div>


         </div>	<!-- End row -->			  


    </div>	   <!-- End container -->		
</section>	<!-- END CONTACTS-1 -->

@endsection