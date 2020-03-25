<div id="input-email" class="col-md-12">
    <input type="text" name="ifsc_code" value="{{old('ifsc_code',isset($record)?$record->ifsc_code:null)}}" class="form-control required" placeholder="Ifsc Code*" required> 
   </div>	
    <div id="input-email" class="col-md-12">
       <input type="text" name="beneficiary_name" value="{{old('ifsc_code',isset($record)?$record->beneficiary_name:null)}}" class="form-control required" placeholder="Beneficiary Name*" required> 
   </div>	
   <div id="input-name" class="col-md-12">
{!! selectBox('account_type',config('application.bankType'),old('account_type',isset($record)?$record->account_type:null),array('class'=>'form-control required'),'Select Account Type') !!}  	 

   </div>
   <div id="input-name" class="col-md-12">
       <input type="text" name="account_number" value="{{old('ifsc_code',isset($record)?$record->account_number:null)}}" class="form-control required " placeholder="Account Number*"  > 

   </div>  