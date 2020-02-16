<section  >
    <div class="container">
        <div class="row d-flex align-items-center">

            <!-- ABOUT BOX #3 -->
            <div id="abox-3" >
                <div class="search-panel" >
                    <form id="search_form_ele" >
                        <div class="row d-flex">
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group location">
                                  
                                    <input type="text" name="location" id="autocomplete_location" value="{{ isset($search['location'])?$search['location']:'' }}" placeholder="Enter Location" class="form-control" autocomplete="off"><i class="fa fa-map-marker"></i> 
                                    <input type="hidden" id="autocomplete_location_lat" value="{{ isset($search['location_lat'])?$search['location_lat']:'' }}"  name="location_lat" > 
                                    <input type="hidden" id="autocomplete_location_lng" value="{{ isset($search['location_lng'])?$search['location_lng']:'' }}" name="location_lng" > 
                                     
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 ">
                                <div class="form-group">
                                   
                                    {!! selectBox('type',config('application.super_categories'),isset($search['type'])?$search['type']:'',array('class'=>'form-control categoryType required','id'=>'category_id'),'Select Doctor/Hospital/Lab') !!}
                                </div>											
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group">
                                    
                                    <select name="category"  class="form-control" selected_option="{{isset($search['category'])?$search['category']:''}}" id="categoryListData" placeholder="Select Category">
                                        <option value="">Select Category</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 mar-btn">
                                    <div class="form-group">
                                    <button  type="submit" class="btn btn-blue blue-hover" >Search<i class="fa fa-search"></i></button>
                                    </div>
                            </div>

                        </div>	
                        
                </form>
                
                </div>
            </div>
        </div>    <!-- End row -->
    </div>	   <!-- End container -->	
</section>	<!-- END ABOUT-1 -->
@section('customScript')
     @parent
     <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCREIdHZBD5RWhB63e58_CYXcat_-MFraQ&libraries=places"></script>
     <script>
             var input = document.getElementById('autocomplete_location');
             var autocomplete = new google.maps.places.Autocomplete(input);
             google.maps.event.addListener(autocomplete, 'place_changed', function(){
                var place = autocomplete.getPlace();
               var lat = place.geometry.location.lat();
               var lng=  place.geometry.location.lng();
               document.getElementById('autocomplete_location_lat').value = lat;
               document.getElementById('autocomplete_location_lng').value = lng;
             })
           </script>
@endsection