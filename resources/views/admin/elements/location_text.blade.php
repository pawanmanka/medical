
<input type="text" autocomplete="off" value="{{old('location',isset($record)?$record->getUserInformation->address:'')}}" name="location" id="autocomplete_location" class="form-control required " placeholder="Location*" > 
<input type="hidden" id="autocomplete_location_lat" value="{{old('location_lat',isset($record)?$record->lat:'')}}"  name="location_lat" > 
<input type="hidden" id="autocomplete_location_lng" value="{{old('location_lng',isset($record)?$record->lat:'')}}" name="location_lng" > 
 

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