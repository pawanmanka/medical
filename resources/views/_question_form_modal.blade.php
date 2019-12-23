<div class="modal fade " id="questionFormModal" tabindex="-1" role="dialog" aria-labelledby="questionFormModalLabel" aria-hidden="true">
    <div class="modal-dialog w-50" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ask Free Question</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <div class="row d-block mar-0">
                 <form id="question_form" action="">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $record->slug }}">
                 <div class="col-xs-12">
                     <div class="form-group">
                         <label for="">Question</label>
                         
                     </div>
                     <textarea name="question" class="form-control required" placeholder="Ask Question" id="" cols="20" rows="5"></textarea>	
                 </div>
                 
                 <div class="col-xs-12 p-10">
                     <input type="submit" value="Submit"  class="btn btn-sm btn-blue blue-hover" />
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