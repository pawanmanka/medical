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
        {!! selectBox('id_proof_type',config('application.idProofTypes'),old('id_proof_type',isset($record)?$record->id_proof_type:null),array('class'=>'form-control required'),'Select Id Proof Type') !!}  	 
    </div> 
    <div  class="col-md-12">
        <input type="text" value="{{old('name',isset($record)?$record->id_proof:'')}}" name="id_proof" class="form-control required " placeholder="Id Number*"  > 
    </div>         
    @if(!isset($record))

    <div  class="col-md-12">
        <input type="password" name="password" class="form-control required " placeholder="Password*"  > 
    </div>                     
    <div  class="col-md-12">
        <input type="password" name="password_confirmation" class="form-control required " placeholder="Password Confirm*"  > 
    </div>           
    @endif     
