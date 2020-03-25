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
                    <label class="form-check-label" for="term_and_condition">I accept the<a target="_blank" class="text-underline" href="{{config('application.doctor_term_and_condition_url')}}">Terms and condition</a></label>
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
@include('admin.elements.upload_photos')
@include('admin.elements.hospital_service',array('record'=>$record->getUserInformation))

<div class="form-group mt-10">
    <div class="col-sm-12 ">  
    <label class="control-label col-sm-2" for="Doctors">Doctors</label>
    <button class="btn btn-primary" id="add_doctor" type="button"><i class="fa fa-plus"></i> Add Doctor</button> 
   </div>

       <div class="col-sm-12" >
            <div class="">
                    <table id="doctors_list" class="table table-responsive">
                            @if(!$record->getHospitalDoctor->isEmpty())
                            @foreach ($record->getHospitalDoctor as $item)
                            <tr>
                                    <td >
                                    <img  style="width: 50px; height: 50px;"  class="imagePreview" id="categoryImage" src="{{ $item->image_url }}">
   
                                         <input type="hidden" name="doctor[id][]" value="{{$item->id}}">   
                                         <input type="file" class="valueInput" name="doctor[image][]" value="{{$item->name}}">   
                                    </td>
                                    <td >
                                         <input type="text"  class="valueInput" name="doctor[name][]" placeholder="Name" value="{{$item->name}}">
                                   </td>
                                   <td >
                                           <input type="text"  class="valueInput" name="doctor[experience][]" placeholder="Experience" value="{{$item->experience}}">
                                    </td>
                                   <td >
                                           <input type="text"  class="valueInput" name="doctor[timing][]" placeholder="Timing" value="{{$item->timing}}">
                                    </td>
                                   <td >
                                           <input type="text"  class="valueInput" name="doctor[specification][]" placeholder="Specification" value="{{$item->specification}}">
                                    </td>
                                    <td >
                                    <button class="btn btn-danger delete_doctor"  type="button"><i class="fa fa-plus"></i> Delete Doctor</button> 
      
                                    </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                   <td>
                                        <input type="file" name="doctor[image][]" value="">   
                                   </td>
                                   <td>
                                        <input type="text" name="doctor[name][]" placeholder="Name" value="">
                                  </td>
                                  <td>
                                          <input type="text" name="doctor[experience][]" placeholder="Experience" value="">
                                   </td>
                                  <td>
                                          <input type="text" name="doctor[timing][]" placeholder="Timing" value="">
                                   </td>
                                   <td>
                                           <input type="text"  class="valueInput" name="doctor[specification][]" placeholder="Timing" value="">
                                    </td>
                                   <td>
                                           <button class="btn btn-danger delete_doctor" type="button"><i class="fa fa-plus"></i> Delete Doctor</button> 
     
                                   </td>
                           </tr>
                            @endif
                    </table>
               </div>
       </div>
</div>
@endif 