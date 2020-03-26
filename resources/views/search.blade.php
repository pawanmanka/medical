@extends('layouts.app')
@section('title',$title)
@section('breadcrumb')
		@include('layouts.breadcrumb')
@endsection

@section('content')

			<!-- SERVICE DETAILS
			============================================= -->
			<div id="service-page" class="wide-60 service-page-section division">

                    <section id="about-1" class="about-section division">
                    <div class="container">
                        <div class="row d-flex align-items-center">
    
                            <!-- ABOUT BOX #3 -->
                            <div id="abox-3">
                                <div class="abox-1 white-color">
                                    <form>
                                        <div class="row d-flex">
                                            <div class="col-md-6 col-lg-3">
                                                <div class="form-group">
                                                    <label for="" class="active">Location</label>
                                                    <input type="text" name="location" placeholder="Enter Location" class="form-control" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3">
                                                <div class="form-group">
                                                    <label for="">Category/sub-category</label>
                                                    <select name="cate" class="form-control" placeholder="Select Category">
                                                        <option value="time">Cate Name</option>
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3 ">
                                                <div class="form-group">
                                                    <label for="">Doctor/Hospital/ Lab and Diagnostics</label>
                                                    <select name="cate" class="form-control" placeholder="Select Doctor/Hospital/ Lab and Diagnostics">
                                                        <option value="time">Doctor/Hospital/ Lab and Diagnostics</option>
                                                    </select>												
                                                </div>											
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 mar-btn">
                                                    <div class="form-group">
                                                    <button type="submit" class="btn btn-blue blue-hover">Search</button>
                                                    </div>
                                            </div>
    
                                        </div>	
                                        
                                </form>
                                </div>
                            </div>
                        </div>    <!-- End row -->
                    </div>	   <!-- End container -->	
                </section>
                    <div class="container">
                        <div class="row pt-20 mar-0">
                            <ul class="filter-ul-li">
                                <li>
                                    <select name="gender" class="form-control" placeholder="Select Gender">
                                                        <option value="M">Select By Gender</option>
                                                        <option value="M">Male</option>
                                                        <option value="F">Female</option>
                                                    </select>
                                </li>
                                <li>
                                    <select name="experience" class="form-control" placeholder="By Experience">
                                                        <option value="M">Select Experience</option>
                                                        <option value="M">5 Year</option>
                                                        <option value="F">10 Year</option>
                                                    </select>
                                </li>
                                <li>
                                    <select name="rating" class="form-control" placeholder="Rating">
                                                        <option value="5">Select Rating</option>
                                                        <option value="5">5 star</option>
                                                        <option value="4">4 Star</option>
                                                    </select>
                                </li>
                                <li>
                                    <select name="price" class="form-control" placeholder="Price">
                                                        <option value="5">Select Price</option>
                                                        <option value="5">5 star</option>
                                                        <option value="4">4 Star</option>
                                                    </select>
                                </li>
                                <li>
                                    <select name="Availability" class="form-control" placeholder="Availability">
                                                        <option value="5">Select Availability</option>
                                                        <option value="5">Busy</option>
                                                        <option value="4">Availability</option>
                                                    </select>
                                </li>
                            </ul>
                        </div>
                        <div class="row pt-20">
    
    
                            <!-- SERVICE CONTENT -->
                             <div class="col-lg-8">
                                 <div class="s2-page pr-30 mb-40">
                                     <!-- Title -->
                                    <h3 class="h3-md blue-color">Doctor Near Me</h3>
                                </div>
                                <div class="row">

                                    @foreach ($result as $item)
                                        @include('list_item')
                                    @endforeach
                        
                            </div>
                            <div class="row">
                                <div class="blog-page-pagination b-top">
                                        <nav aria-label="Page navigation">
                                                {!! $paging->links() !!}
                                        
                                         </nav>					
                                    </div>
                            </div>
                                    
                             </div>	<!-- END SERVICE CONTENT --> 	
        
    
                             <!-- SIDEBAR -->
                            <aside id="sidebar" class="col-lg-4">
                                
                                <div class="blog-categories sidebar-div mb-50">
                                        
                                    <!-- Title -->
                                    <h5 class="h5-sm steelblue-color">Categories</h5>
    
                                    <ul class="blog-category-list clearfix">
                                        <li><a href="#"><i class="fas fa-angle-double-right blue-color"></i> Elderly Care</a> <span>(5)</span></li>
                                        <li><a href="#"><i class="fas fa-angle-double-right blue-color"></i> Lifestyle</a> <span>(13)</span></li>
                                        <li><a href="#"><i class="fas fa-angle-double-right blue-color"></i> Medical</a> <span>(6)</span></li>
                                        <li><a href="#"><i class="fas fa-angle-double-right blue-color"></i> Treatment </a> <span>(8)</span></li>
                                        <li><a href="#"><i class="fas fa-angle-double-right blue-color"></i> Pharma</a> <span>(12)</span></li>
                                    </ul>
    
                                </div>
    
    
    
                                <!-- TEXT WIDGET -->						
                                <div id="txt-widget" class="sidebar-div mb-50">
                                            
                                    <!-- Title -->
                                    <h5 class="h5-sm steelblue-color">Top Rated Doctor</h5>
    
                                    <!-- Head of Clinic -->
                                    <div class="txt-widget-unit mb-15 clearfix d-flex align-items-center">
                                    
                                        <!-- Avatar -->
                                        <div class="txt-widget-avatar">
                                            <img src="images/head-of-clinic.jpg" alt="testimonial-avatar">
                                        </div>
    
                                        <!-- Data -->
                                        <div class="txt-widget-data">
                                            <h5 class="h5-md steelblue-color">Dr. Jonathan Barnes</h5>	
                                            <span>Chief Medical Officer, Founder</span>	
                                            <div class="rate-div">
                                         <i class="fas fa-star"></i>
                                         <i class="fas fa-star"></i>
                                         <i class="fas fa-star"></i>
                                         <i class="fas fa-star"></i>
                                     </div>	
                                        </div>
    
                                    </div>	<!-- End Head of Clinic -->	
                                    <div class="txt-widget-unit mb-15 clearfix d-flex align-items-center">
                                    
                                        <!-- Avatar -->
                                        <div class="txt-widget-avatar">
                                            <img src="images/head-of-clinic.jpg" alt="testimonial-avatar">
                                        </div>
    
                                        <!-- Data -->
                                        <div class="txt-widget-data">
                                            <h5 class="h5-md steelblue-color">Dr. Jonathan Barnes</h5>	
                                            <span>Chief Medical Officer, Founder</span>	
                                            <div class="rate-div">
                                         <i class="fas fa-star"></i>
                                         <i class="fas fa-star"></i>
                                         <i class="fas fa-star"></i>
                                         <i class="fas fa-star"></i>
                                     </div>	
                                        </div>
    
                                    </div>	<!-- End Head of Clinic -->	
                                    
                                    
    
                                    <!-- Button -->
                                    <a href="about.html" class="btn btn-blue blue-hover">Learn More</a>
                                                                            
                                </div>	<!-- END TEXT WIDGET -->
    
                                
    
    
                            </aside>   <!-- END SIDEBAR -->	
    
    
                         </div>  <!-- End row -->	
                    </div>	<!-- End container -->	
                </div>	<!-- END SERVICE DETAILS -->
     

@endsection