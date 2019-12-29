 <!-- Contact Form Input -->
 <div  class="col-md-12">
        <input type="text" name="name" class="form-control required " placeholder="Full Name*"  > 
    </div>
    <div  class="col-md-12">
        <input type="text" name="contact_number" class="form-control required " placeholder="Contact no*"  > 
    </div>
    <div  class="col-md-12">
        <input type="email" name="email" class="form-control required " placeholder="Email*"  > 
    </div>
      <div  class="col-md-12" >
        {!! selectBox('gender',config('application.genderArr'),null,array('class'=>'form-control required'),'Select Gender') !!}  	 
    </div>                      
      <div  class="col-md-12" >
        {!! selectBox('id_proof_type',config('application.idProofTypes'),null,array('class'=>'form-control required'),'Select Id Proof Type') !!}  	 
    </div> 
    <div  class="col-md-12">
        <input type="text" name="id_proof" class="form-control required " placeholder="Id Number*"  > 
    </div>         
    
    <div  class="col-md-12">
        <input type="password" name="password" class="form-control required " placeholder="Password*"  > 
    </div>                     
    <div  class="col-md-12">
        <input type="password" name="password_confirmation" class="form-control required " placeholder="Password Confirm*"  > 
    </div>                     