<div class="modal fade" id="edit_slot_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="edit_slot_form">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Slot</h4>
        <button type="button" class="close" data-dismiss="modal">×</button>
      </div>
      
      <!-- Modal body -->
      <div class="modal-body">
              <div  class="col-md-12">
                      <input type="text" name="edit_slot_actual_fee"  id="edit_slot_actual_fee" class="form-control required " placeholder="Actual Fee"  > 
              </div>
              <div  class="col-md-12 mt-10">
                      <input type="text"  name="edit_slot_discount_fee"  id="edit_slot_discount_fee" class="form-control required " placeholder="Discount Fee"  > 
              </div>
              <div  class="col-md-12 mt-10" >
                      {!! selectBox('slot',config('application.slotArr'),null,array('class'=>'form-control required','id'=>'edit_slot_availability'),'Select Slot') !!}  	 
              </div>
      </div>
      
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" >Save</button>
      </div>
  </form>
    </div>
  </div>
</div>
