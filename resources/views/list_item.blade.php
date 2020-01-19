<div class="col-md-12">
        <div class="sbox-7 icon-xs wow fadeInUp" data-wow-delay="0.4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">
            <a href="{{ $item->detail_url }}">
               <div class="txt-widget-avatar">
                 <img src="{{ isset($item->getUserInformation->profile_pic)?$item->getUserInformation->profile_pic:(config('application.default_image_path')) }}" alt="{{ $item->name }}">
              </div>

       <!-- Data -->
       <div class="txt-widget-data">
           <h5 class="h5-md steelblue-color">{{ $item->name }} {{ !empty($item->gender_title)?"($item->gender_title)":"" }}</h5>	
           {!!ratingView($item->avg_rating)!!}
           <ul>
               <li><a href="{{ $item->detail_url }}" class="">View Profile</a></li>
               <li><a href="about.html" class=""></a></li>
           </ul>
       </div>

           </a>
        </div>
    </div>