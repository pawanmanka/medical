            <?php 
            $page=\App\Models\Page::where('navigation_type','=','1')->orWhere('navigation_type','=','3')->get();
            ?>
			<!-- HEADER
			============================================= -->
			<header id="header-2" class="header ">


				<!-- MOBILE HEADER -->
			    <div class="wsmobileheader clearfix">
			    	<a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
			    	<span class="smllogo"><img src="images/arogyarth-logo.png" width="120" height="auto" alt="mobile-logo"/></span>
			    	<a href="tel:123456789" class="callusbtn"><i class="fas fa-phone"></i></a>
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
						    <div class="col-md-7 col-xl-6">
                            @if(auth()->id() == null)
                    <div class="headertopright">
                        <a title="Login" href="{{ url('/login') }}"> <span >Login</span>&nbsp;</a>
                        <a  title="Register" href="{{ url('register') }}"> <span > Register</span></a>
                    </div>
                    @else
                    <div class="headertopright">
                        <a title="Dashboard" href="{{url('/dashboard') }}"> <span >Dashboard</span>&nbsp;&nbsp;</a>
                        <a title="Logout" href="{{ url('/logout') }}"> <span >Logout</span>&nbsp;</a>
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
                              </li> <!-- END DROPDOWN MENU -->
                              @foreach($page as $data)
                   
                    <li class="nl-simple" aria-haspopup="true"><a href="{{ url($data->slug) }}">{{$data->name}}</a></li>
                    @endforeach
                                            
                              <!-- PAGES -->
                              <li aria-haspopup="true"><a href="#">Services <span class="wsarrow"></span></a>
                                <ul class="sub-menu">
                                        <li aria-haspopup="true"><a href="{{ url('doctors') }}">Doctor </a></li>
                                        <li aria-haspopup="true"><a href="{{ url('hospitals') }}">Hospital  </a></li>
                                        <li aria-haspopup="true"><a href="{{ url('labs') }}">Testing Lab </a></li>
                                        
                                     </ul>
                            </li>
                           

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
