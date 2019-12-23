<!-- Contact Form Input -->
<div  class="col-md-12" >
    {!! selectBox('category',isset($categories)?$categories:array(),old('category',isset($record)?$record->getUserInformation->category:null),array('class'=>'form-control required','id'=>'category_id'),'Select Category') !!}  	 
</div>  
<div  class="col-md-12">
    <input type="text" name="name" value="{{old('name',isset($record)?$record->name:'')}}" class="form-control required " placeholder="Full Name*"  > 
</div>

@if(!isset($record))
<div  class="col-md-12">
    <input type="text" name="contact_number" value="{{old('contact_number',isset($record)?$record->contact_number:'')}}" class="form-control required " placeholder="Contact no*"  > 
</div>
@endif
<div  class="col-md-12">
    <input type="email" name="email" value="{{old('email',isset($record)?$record->email:'')}}"  class="form-control required " placeholder="Email*"  > 
</div>
<div  class="col-md-12">
    <input type="text" name="practice_since" value="{{old('practice_since',isset($record)?$record->getUserInformation->practice_since:'')}}" class="form-control required " placeholder="Practice Since*"  > 
</div>

<div  class="col-md-12">
    <input type="text" name="address" value="{{old('address',isset($record)?$record->getUserInformation->address:'')}}" class="form-control required " placeholder="Address*"  > 
</div>            

@if(!isset($record))
<div  class="col-md-12">
    <input type="password" name="password" class="form-control required " placeholder="Password*"  > 
</div>                     
<div  class="col-md-12">
    <input type="password" name="password_confirmation" class="form-control required " placeholder="Password Confirm*"  > 
</div>    
@endif     

@include('_upload_fields')