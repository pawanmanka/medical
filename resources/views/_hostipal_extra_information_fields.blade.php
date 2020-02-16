<!-- Contact Form Input -->


<div  class="col-md-12">
    <div class="form-group">
        <label class="control-label col-sm-2" for="Availability">Availability</label>
        <div class="col-sm-10 mt-50">
            <label class="control-label " for="Availability">Monday to Saturday</label>
            <table>
                <tr>
                    <td>Morning</td>
                    <td>

                            <div class="input-group input-daterange">
                                    <input id="m_s_datetimepicker_m_1" type="text" class="form-control required m_s_datetimepicker_m" placeholder="Start" name="m_to_s_morning_start" value="{{ old('m_to_s_morning_start',isset($record->m_to_s_morning_start)?$record->m_to_s_morning_start:'') }}">
                                    <div class="input-group-addon">to</div>
                                    <input id="m_s_datetimepicker_m_2" type="text" class="form-control required m_s_datetimepicker_m" placeholder="End" name="m_to_s_morning_end" value="{{ old('m_to_s_morning_end',isset($record->m_to_s_morning_end)?$record->m_to_s_morning_end:'') }}">
                            </div>
                    </td>
                </tr>
                <tr>
                    <td>Evening</td>
                    <td>

                            <div class="input-group input-daterange">
                                    <input id="m_s_datetimepicker_e_1" type="text" class="form-control required m_s_datetimepicker_e" placeholder="Start" name="m_to_s_evening_start" value="{{ old('m_to_s_evening_start',isset($record->m_to_s_evening_start)?$record->m_to_s_evening_start:'') }}">
                                    <div class="input-group-addon">to</div>
                                    <input id="m_s_datetimepicker_e_2" type="text" class="form-control required m_s_datetimepicker_e" placeholder="End" name="m_to_s_evening_end" value="{{ old('m_to_s_evening_end',isset($record->m_to_s_evening_end)?$record->m_to_s_evening_end:'') }}">
                            </div>
                    </td>
                </tr>
            </table>  
        </div>
        <div class="col-sm-10 mt-50">
                <label class="control-label " for="Availability">Sunday</label>
                <table>
                    <tr>
                        <td>Morning</td>
                        <td>
    
                                <div class="input-group input-daterange">
                                        <input id="s_datetimepicker_m_1" type="text" class="form-control required s_datetimepicker_m" placeholder="Start"  name="s_evening_start" value="{{ old('s_evening_start',isset($record->s_evening_start)?$record->s_evening_start:'') }}">
                                        <div class="input-group-addon">to</div>
                                        <input id="s_datetimepicker_m_2" type="text" class="form-control required s_datetimepicker_m" placeholder="End"  name="s_evening_end" value="{{ old('s_evening_end',isset($record->s_evening_end)?$record->s_evening_end:'') }}">
                                </div>
                        </td>
                    </tr>
                </table>  
            </div>
    </div>   

    <div class="form-group mt-50">
        <label class="control-label col-sm-2" for="ActualFee">Actual Fee</label>
        <div class="col-sm-10 ">
                <input  type="text" class="form-control required" name="actual_fee" value="{{ old('actual_fee',isset($record->actual_fee)?$record->actual_fee:'') }}" >
        </div>
</div>

<div class="form-group mt-10">
        <label class="control-label col-sm-2" for="DiscountedFee">Discounted Fee</label>
        <div class="col-sm-10 ">
                <input  type="text" class="form-control required" name="discounted_fee" value="{{ old('discounted_fee',isset($record->discounted_fee)?$record->discounted_fee:'') }}">
        </div>
</div>

    <div class="form-group mt-10">
            <label class="control-label col-sm-2" for="facility">Facility</label>
            <div class="col-sm-10 ">
                    <input  type="text" class="form-control required" name="facility" value="{{ old('facility',isset($record->facility)?$record->facility:'') }}">
            </div>
    </div>
    <div class="form-group mt-10">
            <label class="control-label col-sm-2" for="facility">Amenities</label>
            <div class="col-sm-10 ">
                    {!! selectBox('amenities',$amenities,$record->getAmenities()->pluck('amenities.id','amenities.id')->toArray(),array('class'=>'form-control chosen-select required','multiple'=>'multiple'),'Select Gender') !!}  	 

                </div>
    </div>
    <div class="form-group mt-10">
            <label class="control-label col-sm-2" for="title">Title</label>
            <div class="col-sm-10 ">
                    <input  type="text" class="form-control required" name="meta_title" value="{{ old('meta_title',isset($record->meta_title)?$record->meta_title:'') }}">
            </div>
    </div>
    <div class="form-group mt-10">
            <label class="control-label col-sm-2" for="Description">About the hospital</label>
            <div class="col-sm-10 ">
                    <input  type="text" class="form-control required" name="meta_description" value="{{ old('meta_description',isset($record->meta_description)?$record->meta_description:'') }}">
            </div>
    </div>
    <div class="form-group mt-10">
            <label class="control-label col-sm-2" for="Keyword">Keyword</label>
            <div class="col-sm-10 ">
                    <input  type="text" class="form-control required"  name="meta_keyword" value="{{ old('meta_keyword',isset($record->meta_keyword)?$record->meta_keyword:'') }}">
            </div>
    </div>
   
    <div class="form-group mt-10">
        <div class="col-sm-10 ">  
        <label class="control-label col-sm-2" for="Doctors">Doctors</label>
        <button class="btn btn-primary" id="add_doctor" type="button"><i class="fa fa-plus"></i> Add Doctor</button> 
    </div>

            <div class="col-sm-10 ">
                 <table id="doctors_list" class="table">
                         @if(!$record->getHospitalDoctor->isEmpty())
                         @foreach ($record->getHospitalDoctor as $item)
                         <tr>
                                 <td>
                                 <img  style="width: 50px; height: 50px;"  class="imagePreview" id="categoryImage" src="{{ $item->image_url }}">

                                      <input type="hidden" name="doctor[id][]" value="{{$item->id}}">   
                                      <input type="file" class="valueInput" name="doctor[image][]" value="{{$item->name}}">   
                                 </td>
                                 <td>
                                      <input type="text"  class="valueInput" name="doctor[name][]" placeholder="Name" value="{{$item->name}}">
                                </td>
                                <td>
                                        <input type="text"  class="valueInput" name="doctor[experience][]" placeholder="Experience" value="{{$item->experience}}">
                                 </td>
                                <td>
                                        <input type="text"  class="valueInput" name="doctor[timing][]" placeholder="Timing" value="{{$item->timing}}">
                                 </td>
                                 <td>
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
                                        <button class="btn btn-danger delete_doctor" type="button"><i class="fa fa-plus"></i> Delete Doctor</button> 
  
                                </td>
                        </tr>
                         @endif
                 </table>
            </div>
    </div>


</div>
    
