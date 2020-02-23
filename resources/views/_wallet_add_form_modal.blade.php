<div class="modal fade " id="addWalletMoneyShowModal" tabindex="-1" role="dialog" aria-labelledby="questionFormModalLabel" aria-hidden="true">
    <div class="modal-dialog w-50" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Money</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <div class="row d-block mar-0">
                 <form id="add_wallet_money_form" method="POST" action="{{url('wallet/add-money')}}">
                    @csrf
                 <div class="col-xs-12">
                     <div class="form-group">
                         <label for="">Money</label>
                     </div>
                     <input name="money" max="500000" min="0" class="form-control number required" placeholder="Add Money" id="money" />	
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