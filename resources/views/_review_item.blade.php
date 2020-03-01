<div class="patient_reviews ">
    <div class="patient_name"><i class="fa fa-chevron-right"></i>{{$item->getPatient->name}}</div>
    <div class="monthago">{{$item->create_age}}</div>
    <div class="clearfix"></div>
    <h2>{{$item->title}}</h2>
    <div class="recom">
<a href=""><i class="fas {{ ($item->recommend > 0)?'fa-thumbs-up':'fa-thumbs-down' }}"></i> </a>I recommend the doctor
    </div>
    <div class="satis">
        <div class="fmasg">{{$item->description}}</div>
        <div class="last_rew_line">
        <div class="thnks_div">Thanks</div>
        <div class="rew_star">
        {!!ratingView($item->rating)!!}
        </div>
        <div class="rew_amonthago">{{$item->create_age}}</div>
        <div class="clearfix"></div>
    </div>
    </div>
</div>