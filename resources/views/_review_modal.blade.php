<div class="modal fade " id="reviewFormModal" tabindex="-1" role="dialog" aria-labelledby="reviewFormModalLabel" aria-hidden="true">
    <div class="modal-dialog w-50" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="reviewFormModalLabel">Submit Review</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <div class="row d-block mar-0">
             <form id="review_form" action="">
                 @csrf
                 <input type="hidden" name="user_id" value="{{ $record->slug }}">
                 <div class="col-xs-12">
                     <div class="form-group">
                         <label for="">Subject</label>
                         <input type="text" name="title" class="form-control required" placeholder="Visited For">
                     </div>
                 </div>
                 <div class="col-xs-12">
                     <div class="form-group">
                         <label for="">Recommended</label>
                    
                         {!! selectBox('recommend',config('application.yesNoArr'),null,array('class'=>'form-control required','id'=>'category_id'),'Select Recommeded') !!}
                     </div>
                 </div>
                 <div class="col-xs-12">
                     <div class="form-group">
                         <label for="">Message</label>
                         
                     </div>
                     <textarea name="description" class="form-control required" id="" cols="20" rows="5"></textarea>	
                 </div>
                 <div class="col-xs-12">
                     <div class="form-group">
                         <label for="">Rating</label>
                         <div id="stars" class="starrr"></div>  
                     </div>
                 </div>
                 <div class="col-xs-12">
                        <input class="btn btn-sm btn-blue blue-hover" type="submit" value="Submit">
                 </div>
             </form>
         </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </div>