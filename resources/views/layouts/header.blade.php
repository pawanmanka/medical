            <?php 
			$page=\App\Models\Page::where('navigation_type','=','1')->orWhere('navigation_type','=','3')->get();
			$currentUser = auth()->user();
			if(!empty($currentUser)){
				$userName = $currentUser->name;
				$profilePic="";
				if($currentUser->getUserInformation != NULL)
				{
				$profilePic = $currentUser->getUserInformation->profile_pic;
				}
			}
            ?>
			<!-- HEADER
			============================================= -->
			<header id="header-2" class="header ">


				<!-- MOBILE HEADER -->
			    <div class="wsmobileheader clearfix">
			    	<a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
			    	<span class="smllogo"><img src="{{ baseUrl('images/Arogyarth-logo.png') }}" width="120" height="auto" alt="mobile-logo"/></span>
					@if(auth()->id() == null)
                    <div class="headertopright">
                        <a title="Login" href="{{ url('/login') }}"> <span >Login</span>&nbsp;</a>
                        <a  title="Register" href="{{ url('register') }}"> <span > Register</span></a>
                    </div>
                    @else
                    <div class="wsmenu ">
						<ul class="wsmenu-list">

						<li aria-haspopup="true"><span class="wsmenu-click"><i class="wsmenu-arrow"></i></span>
						
							<a href="{{url('/dashboard') }}">{{$userName}}   
								<img src="{{$profilePic}}" alt="" class="img-circle" width="44">
								</a>
							<ul class="sub-menu">
							    
                                    <li aria-haspopup="true"><a title="My Profile" href="{{url('/profile') }}"> <span >My Profile</span>&nbsp;&nbsp;</a></li>
                                    @hasanyrole(config('application.extra_info_roles'))
                                    <li aria-haspopup="true"><a title="My Schedule" href="{{url('/extra-info') }}"> <span >My Schedule</span>&nbsp;&nbsp;</a></li>
                                    @endhasanyrole
                                   
                                    <li aria-haspopup="true"><a title="My Wallet" href="{{url('/my-wallet') }}"> <span >My Wallet</span>&nbsp;&nbsp;</a></li>
                                    <li aria-haspopup="true"><a title="My Appointment" href="{{url('/my-appointment') }}"> <span >My Appointment</span>&nbsp;&nbsp;</a></li>
                                    @hasanyrole(config('application.extra_info_roles'))

                                    <li aria-haspopup="true"><a title="Feedback / Q &A" href="{{url('/my-feedbacks') }}"> <span >Feedback / Q &A</span>&nbsp;&nbsp;</a></li>
                                    @endhasanyrole
                                    
                                 
                                    <li aria-haspopup="true"><a title="Change Password" href="{{url('/change-password') }}"> <span >Change Password</span>&nbsp;&nbsp;</a></li>
                                    @hasanyrole(config('application.extra_info_roles'))

                                    <li aria-haspopup="true"><a title="Bank Detail" href="{{url('/my-bank-detail') }}"> <span >Bank Detail</span>&nbsp;&nbsp;</a></li> 
                                    @endhasanyrole
                                    
                                @hasanyrole(config('application.lab_role'))
                                <li aria-haspopup="true"><a title="My Service" href="{{url('/my-services') }}"> <span >My Service</span>&nbsp;&nbsp;</a></li>       
                                <li aria-haspopup="true"><a title="My Packages" href="{{url('/my-packages') }}"> <span >My Packages</span>&nbsp;&nbsp;</a></li>                
                                       
                                @endhasanyrole
                                <li aria-haspopup="true"><hr></li>
								<li aria-haspopup="true"><a title="Dashboard" href="{{url('/dashboard') }}"> <span >Dashboard</span>&nbsp;&nbsp;</a></li>
								<li aria-haspopup="true"><a title="Logout" href="{{ url('/logout') }}"> <span >Logout</span>&nbsp;</a></li>
								
							</ul>
						</li>
						</ul>
					</div>

                    @endif
			 	</div>


			  	<!-- HEADER WIDGETS -->
			 	<div class="hero-widget clearfix">
			 		<div class="container">
			 			<div class="row d-flex align-items-center">


				        	<!-- LOGO IMAGE -->
		    				<!-- For Retina Ready displays take a image with double the amount of pixels that your image will be displayed (e.g 360 x 80 pixels) -->
		    				<div class="col-md-5 col-xl-6">
		    				<div class="desktoplogo"><a href="{{ url('/')}}"><img src="{{ baseUrl('images/Arogyarth-logo.png') }}"  width="auto" height="70" alt="header-logo"></a></div>
</div>

				     		<!-- WIDGETS -->
						    <div class="col-md-7 col-xl-6 user-icon">
							
                    @if(auth()->id() == null)
                        <div class="headertopright">
                            <a title="Login" href="{{ url('/login') }}"> <span >Login</span>&nbsp;</a>
                            <a  title="Register" href="{{ url('register') }}"> <span > Register</span></a>
                        </div>
                    @else
                    <div class="wsmenu ">
						<ul class="wsmenu-list">

						<li aria-haspopup="true">
							<a href="{{url('/dashboard') }}">{{$userName}} <i class="fa fa-angle-down" style="font-size: 20px;" aria-hidden="true"></i>  
							<img src="{{$profilePic}}" alt="" class="img-circle" width="44">
							</a>
							<ul class="sub-menu">
							    
                                    <li aria-haspopup="true"><a title="My Profile" href="{{url('/profile') }}"> <span >My Profile</span>&nbsp;&nbsp;</a></li>
                                    @hasanyrole(config('application.extra_info_roles'))
                                    <li aria-haspopup="true"><a title="My Schedule" href="{{url('/extra-info') }}"> <span >My Schedule</span>&nbsp;&nbsp;</a></li>
                                    @endhasanyrole
                                   
                                    <li aria-haspopup="true"><a title="My Wallet" href="{{url('/my-wallet') }}"> <span >My Wallet</span>&nbsp;&nbsp;</a></li>
                                    <li aria-haspopup="true"><a title="My Appointment" href="{{url('/my-appointment') }}"> <span >My Appointment</span>&nbsp;&nbsp;</a></li>
                                    @hasanyrole(config('application.extra_info_roles'))

                                    <li aria-haspopup="true"><a title="Feedback / Q &A" href="{{url('/my-feedbacks') }}"> <span >Feedback / Q &A</span>&nbsp;&nbsp;</a></li>
                                    @endhasanyrole
                                    
                                 
                                    <li aria-haspopup="true"><a title="Change Password" href="{{url('/change-password') }}"> <span >Change Password</span>&nbsp;&nbsp;</a></li>
                                    @hasanyrole(config('application.extra_info_roles'))

                                    <li aria-haspopup="true"><a title="Bank Detail" href="{{url('/my-bank-detail') }}"> <span >Bank Detail</span>&nbsp;&nbsp;</a></li> 
                                    @endhasanyrole
                                    
                                @hasanyrole(config('application.lab_role'))
                                <li aria-haspopup="true"><a title="My Service" href="{{url('/my-services') }}"> <span >My Service</span>&nbsp;&nbsp;</a></li>       
                                <li aria-haspopup="true"><a title="My Packages" href="{{url('/my-packages') }}"> <span >My Packages</span>&nbsp;&nbsp;</a></li>                
                                       
                                @endhasanyrole
                                <li aria-haspopup="true"><hr></li>
                                <li aria-haspopup="true"><a title="Dashboard" href="{{url('/dashboard') }}"> <span >Dashboard</span>&nbsp;&nbsp;</a></li>
								<li aria-haspopup="true"><a title="Logout" href="{{ url('/logout') }}"> <span >Logout</span>&nbsp;</a></li>
								
							</ul>
						</li>
						</ul>
					</div>

                    @endif
					      	</div>	<!-- END WIDGETS -->

				      	</div>
				    </div>
			  	</div>	<!-- END HEADER WIDGETS -->


			  	<!-- NAVIGATION MENU -->
			  	<div class="wsmainfull menu clearfix">
    				<div class="wsmainwp clearfix">

    					<!-- LOGO IMAGE -->
    					<!-- For Retina Ready displays take a image with double the amount of pixels that your image will be displayed (e.g 360 x 80 pixels) -->
    					<div class="desktoplogo"><a href="{{ url('/')}}"><img src="{{ baseUrl('images/Arogyarth-logo.png') }}"  width="auto" height="70" alt="header-logo"></a></div>

    					<!-- MAIN MENU -->
      					<nav class="wsmenu clearfix">
        					<ul class="wsmenu-list">
                            <li aria-haspopup="true"><a href="{{ url('/')}}">Home </a>                        
							  </li> 
							<li aria-haspopup="true"><a href="{{ url('doctors') }}">Doctors </a></li>
							<li aria-haspopup="true"><a href="{{ url('hospitals') }}">Hospital  </a></li>
							<li aria-haspopup="true"><a href="{{ url('labs') }}">Lab and Diagnostics</a></li>
								
                             

                            <li class="nl-simple" aria-haspopup="true"><a href="{{ url('contact-us') }}">Contact Us</a></li>
                            

							    <li class="nl-simple header-btn" aria-haspopup="true"><a class="blue-hover" href="tel:8561903387">Call - 8561903387</a></li> 


        					</ul>

        				</nav>	<!-- END MAIN MENU -->


        				<!-- NAVIGATION MENU BUTTON -->
        				<div class="header-button">
        					<span class="nl-simple header-btn blue-hover"><a class="blue-hover" href="tel:8561903387">Call - 8561903387</a></span>
        				</div>


    				</div>
    			</div>	<!-- END NAVIGATION MENU -->


			</header>	<!-- END HEADER -->
