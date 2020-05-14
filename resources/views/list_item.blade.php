@if(isset($roles[config('application.doctor_role')]))
    <div class="col-12">
               <div class="box-one">
               <div class="txt-widget-avatar col-17-per">
                 <img src="{{$item->getUserInformation->profile_pic}}" class="image-round" alt="{{ $item->name }}">
              </div>
                  <div class="text-holder col-83-per">
                     <div class="doctor-details">
                        <ul class="pl-0 mb-0">
                           <li><a href="{{ $item->detail_url }}" class="text-color">{{ $item->name }} {{ !empty($item->gender_title)?"($item->gender_title)":"" }}</a></li>
                          <li>{{$item->getUserInformation->doctor_education}}</li>
                           <li>{{ $item->getUserInformation->experience }} Experience</li>
                           <li>Patient Receive ({{$item->get_appointment_count_count}})</li>
                           <li>{!!ratingView($item->avg_rating)!!}</li>
                        </ul>
                     </div>
                
                     <div class="buttons">
                        <ul class="pl-0 mb-0">
                           <li><a href="{{ $item->detail_url }}" class="">View Profile</a></li>
                           <li><a href="{{ url('/booking/'.$item->slug) }}">Book an appointment</a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               
            </div>
@endif
@if(isset($roles[config('application.hospital_role')]))

<div class="col-12">
               <div class="box-one">
                  <div class="image-holder">
                     <img src="{{$item->getUserInformation->profile_pic }}" alt="{{ $item->name }}"></div>
                  <div class="text-holder">
                     <div class="doctor-details">
                        <ul class="pl-0 mb-0">
                           <li>{{ $item->name }} {{ !empty($item->gender_title)?"($item->gender_title)":"" }}</li>
                           <li>Multi-Specialty hospital</li>
                           <li><b>Timing : </b>Mon - Sun 
                              <br><b>Morning :</b> {{ $item->getUserInformation->mon_sat_morning_time  }}
                              <br><b>Evening :</b> {{ $item->getUserInformation->mon_sat_evening_time  }}</li>
                        </ul>
                     </div>
                  </div>
                  <div class="testing_lab_btns">
                     <ul class="mb-0">
                     <li><a href="tel:{{$item->username}}">Call Now</a></li>
                        <li><a href="{{ $item->detail_url }}">Profile</a></li>
                     </ul>
                     </div>
                  <div class="clearfix"></div>
               </div>
              
               
            </div>
@endif
@if(isset($roles[config('application.lab_role')]))
<div class="col-12">
               <div class="box-one">
                  <div class="image-holder"><img src="{{$item->getUserInformation->profile_pic }}" alt=""></div>
                  <div class="text-holder">
                     <div class="doctor-details">
                        <ul class="pl-0 mb-0">
                           <li>{{ $item->name }} {{ !empty($item->gender_title)?"($item->gender_title)":"" }}</li>
                           <li>{{$item->getUserInformation->doctor_education}}</li>
                           <li>{{ $item->getUserInformation->experience }} Experience</li>
                           <li><b>Timing - </b><br>Mon - Sun ( 
                              <br>Morning : {{ $item->getUserInformation->mon_sat_morning_time  }} And
                              <br>Evening : {{ $item->getUserInformation->mon_sat_evening_time  }} ) <i class="fa fa-map-marker"></i></li>
                        </ul>
                     </div>
                  </div>
                  <div class="testing_lab_btns">
                     <ul class="mb-0">
                        <li><a href="tel:{{$item->username}}">Call Now</a></li>
                        <li><a href="{{ $item->detail_url }}">View Detail</a></li>
                     </ul>
                     </div>
                  <div class="clearfix"></div>
               </div>
               
            </div>
@endif

           