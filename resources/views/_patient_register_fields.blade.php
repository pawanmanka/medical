 <!-- Contact Form Input -->
 <div  class="col-md-12">
        <input type="text" name="name" value="{{old('name',isset($record)?$record->name:'')}}" class="form-control required " placeholder="Full Name*"  > 
    </div>
    @if(!isset($record))
    <div  class="col-md-12">
        <input type="text" name="contact_number" class="form-control required " placeholder="Contact no*"  > 
    </div>
    @endif
    <div  class="col-md-12">
        <input type="email" name="email" value="{{old('name',isset($record)?$record->email:'')}}" class="form-control required " placeholder="Email*"  > 
    </div>
      <div  class="col-md-12" >
        {!! selectBox('gender',config('application.genderArr'),old('gender',isset($record)?$record->gender:null),array('class'=>'form-control required'),'Select Gender') !!}  	 
    </div>                      
      <div  class="col-md-12" >
        {!! selectBox('id_proof_type',config('application.idProofTypes'),old('id_proof_type',isset($record)?$record->id_proof_type:null),array('class'=>'form-control required id_proof_type'),'Select Id Proof Type') !!}  	 
    </div> 
    <div  class="col-md-12">
        <input type="text" value="{{old('name',isset($record)?$record->id_proof:'')}}" name="id_proof" class="form-control checkIdProof required id_proof" placeholder="Id Number*"  > 
    </div>         
    @if(!isset($record))
    <div  class="col-md-12" >
        {!! selectBox('plan_id',getSubscriptionPlans(),null,array('class'=>'form-control required','id'=>'plan_id'),'Select Plan') !!}  	 
    </div>  
    <div  class="col-md-12">
        <input type="password" name="password" class="form-control required " placeholder="Password*"  > 
    </div>                     
    <div  class="col-md-12">
        <input type="password" name="password_confirmation" class="form-control required " placeholder="Password Confirm*"  > 
    </div>           
    @endif  
    @if(!isset($record))
<div class="form-group mt-10">
    <div class="col-md-12 ">
            <div class="form-check">
                    <input class="form-check-input required"  name="term_and_condition" type="checkbox" value="1" id="term_and_condition">
                    <label class="form-check-label" for="term_and_condition">I accept the<a target="_blank" class="text-underline" href="{{config('application.doctor_term_and_condition_url')}}">Terms and condition</a></label>
                    <span class="handleError"></span>
            </div>
    </div> 
</div>
@endif    
