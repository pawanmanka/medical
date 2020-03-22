@extends('layouts.app')
@section('title',$title)
@section('breadcrumb')
		@include('layouts.breadcrumb')
@endsection

@section('content')

			<!-- SERVICE DETAILS
			============================================= -->
			<div id="service-page" class="wide-60 service-page-section division">

                   @include('_search_form')
                    <div class="container">
                        <div class="row pt-30 mar-0">
                        <form id="filter_form_ele">
                            <ul class="filter-ul-li">
                                @foreach ($filterParams as $key => $item)
                                    <input type="hidden" name="{{$key}}" value="{{$item}}">
                                @endforeach
                                <li><h4>Filter By :</h4></li>
                                @if(isset($roles[config('application.doctor_role')]))
                                <li>{!! selectBox('gender',config('application.genderArr'),isset($search['gender'])?$search['gender']:'',array('class'=>'form-control filterElement'),'Select Gender') !!}</li>
                                <li>{!! selectBox('experience',config('application.experienceArr'),isset($search['experience'])?$search['experience']:'',array('class'=>'form-control filterElement'),'Select Experience') !!}</li>
                                <li>{!! selectBox('rating',config('application.starArr'),isset($search['rating'])?$search['rating']:'',array('class'=>'form-control filterElement'),'Select Rating') !!}</li>
                                <li>{!! selectBox('price',config('application.priceArr'),isset($search['price'])?$search['price']:'',array('class'=>'form-control filterElement'),'Select Price') !!}</li>
                                <li>{!! selectBox('availability',config('application.availabilityArr'),isset($search['availability'])?$search['availability']:'',array('class'=>'form-control filterElement'),'Select Availability') !!}</li>
                                @endif
                                @if(isset($roles[config('application.hospital_role')]))
                                <li>{!! selectBox('amenities',$amenities,isset($search['amenities'])?$search['amenities']:'',array('class'=>'form-control filterElement'),'Select Amenities') !!}</li>
                                <li>{!! selectBox('rating',config('application.starArr'),isset($search['rating'])?$search['rating']:'',array('class'=>'form-control filterElement'),'Select Rating') !!}</li>
                                @endif
                                @if(isset($roles[config('application.lab_role')]))
                                <li>{!! selectBox('experience',config('application.experienceArr'),isset($search['experience'])?$search['experience']:'',array('class'=>'form-control filterElement'),'Select Experience') !!}</li>
                                @endif

                            </ul>
                            </form>
                        </div>
                       
                    </div>	<!-- End container -->	
                </div>	<!-- END SERVICE DETAILS -->
<section class="thred-panel">
<div class="container">
        <div class="row pt-20">
            
            
            <!-- SERVICE CONTENT -->
            <div class=" col-xs-7 col-sm-7 col-md-7 col-lg-8 left-panel">
                <div class="s2-page pr-30 mb-20">          
                    <h2 >{{ $title }} Near You</h2>
                </div>
                <div class="row">
                @if($paging->total() > 0)
                    @foreach ($result as $item)
                        @include('list_item')
                    @endforeach
                    @else
                    No Result Found
                    @endif
                </div>
            <div class="row">
                <div class="blog-page-pagination b-top">
                    <nav aria-label="Page navigation">
                            {!! $paging->appends($_GET)->links() !!}
                    </nav>					
                </div>
            </div>
                    
            </div>	<!-- END SERVICE CONTENT --> 	


            <!-- SIDEBAR -->
            <aside id="sidebar" class="col-lg-4">
            <div class="right-panel">
               <h3>Categories</h3>
               <ul class="pl-0 mb-0 right-panel-cat">
               @foreach (topCategory(request()->segment(1)) as $item)
                        <li><a href="{{url($item->super_categories_slug.'?type='.$item->super_category_id.'&category='.$item->slug)}}"><i class="fa fa-angle-double-right"></i>{{$item->name}}</a> <span>({{$item->get_user_count}})</span></li>
                 @endforeach
               </ul>
               
            </div>
            <div class="pt-20">
                <div class="right-panel">
                <h3>Top Rated {{ucfirst(request()->segment(1))}}</h3>
                <!-- Head of Clinic -->
                @foreach (topRateDoctor(request()->segment(1)) as $item)
                    <div class="txt-widget-unit mb-15 clearfix d-flex align-items-center">
                    
                        <!-- Avatar -->
                        <div class="txt-widget-avatar">
                            <a href="{{$item->detail_url}}">
                            <img src="{{isset($item->getUserInformation->profile_pic)?$item->getUserInformation->profile_pic:''}}" alt="{{$item->name}}">	
                            </a>   
                        </div>
                      
                        <div class="doctor_text_holder">
                                <h5 class="mb-0"><a href="{{$item->detail_url}}">{{$item->name}}</a></h5>
                                <p>{{isset($item->getUserInformation->category_name)?$item->getUserInformation->category_name:''}}</p>
                                {{-- <p>{{ $item->getUserInformation->experience }} Experience</p> --}}
                                {!!ratingView($item->avg_rating)!!}
                            </div>
                      

                    </div>	<!-- End Head of Clinic -->	
                    @endforeach
                    <!-- Button -->
                   
                </div>
            </div>
                

                


            </aside>   <!-- END SIDEBAR -->	


        </div>  <!-- End row -->	
</div>
</section>
@endsection

@section('customScript')
<script src="{{ baseUrl('js/jquery.validate.min.js') }}"></script>
<script src="{{ baseUrl('scripts/listing.js') }}"></script>
<script>
  var listingObj = new ListingFn();
  var typeArr = {!! json_encode(config('application.super_categories_slug')) !!}
  jQuery(document).ready(function(){
    listingObj.init();
  })
</script>
@endsection