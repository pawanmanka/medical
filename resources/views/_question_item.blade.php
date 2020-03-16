<div class="bk-white mb-10">
    <div class="question_panel">
        <div class="que_ask"><b>Question - </b> {{$item->title}}</div>
        <div class="que_ask_right">Ask {{$item->create_age}}</div>
        <div class="clearfix"></div>
        <div class="ans_div"><b>Answer -</b> {{$item->answer}} </div>
        <div class="help_last_panel">
        <div class="helpful">Helpful &nbsp</div>
       <span class="question_helpfull">{{$item->get_total_help_full_count}}</span><a href="#" class="question_helpfull_status" data-status="1" data-id="{{$item->id}}"><i class="fas fa-thumbs-up"></i> </a>&nbsp;<a href="#" class="question_helpfull_status" data-status="0" data-id="{{$item->id}}"><i class="fas fa-thumbs-down"></i> </a>  <span class="question_nothelpfull">{{$item->get_total_not_help_full_count}}</span>
        <div class="clearfix"></div>
        </div>											
    </div>
</div>