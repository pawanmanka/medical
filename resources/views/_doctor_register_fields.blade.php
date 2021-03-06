<!-- Contact Form Input -->
<div  class="col-md-12">
    <input type="text" name="name" value="{{old('name',isset($record)?$record->name:'')}}" class="form-control required " placeholder="Full Name*"  > 
</div>
<div  class="col-md-12" >
        {!! selectBox('category',isset($categories)?$categories:array(),old('category',isset($record)?$record->getUserInformation->category:null),array('class'=>'form-control required','id'=>'category_id'),'Select Category') !!}  	 
</div>  
<div  class="col-md-12" >
        {!! selectBox('sub_category',array(),null,array('class'=>'form-control required','id'=>'subcategory_id','selected_option'=>old('sub_category',isset($record)?$record->getUserInformation->sub_category:'')),'Select Category') !!}  	 
</div>  
<div  class="col-md-12">
    <input type="text" name="hospital" value="{{old('hospital',isset($record)?$record->getUserInformation->hospital:'')}}" class="form-control required " placeholder="Hospital/Clinic*"  > 
</div>
<div  class="col-md-12">
    <input type="text" name="qualification" value="{{old('qualification',isset($record)?$record->getUserInformation->qualification:'')}}"  class="form-control required " placeholder="Qualification*"  > 
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
    <input type="text" name="practice_since" minlength="4" value="{{old('practice_since',isset($record)?$record->getUserInformation->practice_since:'')}}" class="form-control required " placeholder="Practice Since*"  > 
</div>
<div  class="col-md-12">
    <input type="text" name="registration_number" value="{{old('registration_number',isset($record)?$record->getUserInformation->registration_number:'')}}"  class="form-control required " placeholder="Registertion Number*"  > 
</div>
<div  class="col-md-12" >
    {!! selectBox('gender',config('application.genderArr'),old('gender',isset($record)?$record->gender:null),array('class'=>'form-control required'),'Select Gender') !!}  	 
</div>
<div  class="col-md-12">            
    @include('admin.elements.location_text')                    
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

@include('_upload_fields')
@if(!isset($record))
<div class="form-group mt-10">
    <div class="col-md-12 ">
            <div class="form-check">
                    <input class="form-check-input required"  name="term_and_condition" type="checkbox" value="1" id="term_and_condition">
                    <label class="form-check-label" for="term_and_condition">I accept the<a class="text-underline" target="_blank" href="{{config('application.doctor_term_and_condition_url')}}">Terms and condition</a></label>
                    <span class="handleError"></span>
            </div>
    </div> 
</div>
@else
<div  class="col-md-12">
<div class="form-group mt-10">
            <input  type="text" class="form-control required" placeholder="Title" name="meta_title" value="{{ old('meta_title',isset($record->getUserInformation)?$record->getUserInformation->meta_title:'') }}">
</div>
<div class="form-group mt-10">
   
            <input  type="text" class="form-control required" placeholder="Description" name="meta_description" value="{{ old('meta_description',isset($record->getUserInformation)?$record->getUserInformation->meta_description:'') }}">
</div>
<div class="form-group mt-10">
    
            <input  type="text" class="form-control required" placeholder="Key word"  name="meta_keyword" value="{{ old('meta_keyword',isset($record->getUserInformation)?$record->getUserInformation->meta_keyword:'') }}">
   
</div>
</div>

@include('admin.elements.upload_certificate')
@endif 