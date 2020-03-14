<div class="form-group mt-10">
    <div class="col-sm-10 ">  
    <label class="control-label col-sm-6" for="Services">Services</label>
    <button class="btn btn-primary" id="add_hospital_servics" type="button"><i class="fa fa-plus"></i> Add</button> 
   </div>

        <div class="col-sm-10 ">
             <table id="hospital_servics_list" class="table">
                     @if(!empty($record->hospital_service))
                     @foreach ($record->hospital_service as $item)
                     <tr>
                             <td>
                                  <input type="text" class="valueInput" name="hospital_servic[]" value="{{$item}}">   
                             </td>
                        
                             <td>
                             <button class="btn btn-danger delete_hospital_servic"  type="button"><i class="fa fa-plus"></i> Delete </button> 

                             </td>
                     </tr>
                     @endforeach
                     @else
                     <tr>
                            <td>
                                 <input type="text" name="hospital_servic[]" value="">   
                            </td>
                        
                            <td>
                                    <button class="btn btn-danger delete_hospital_servic" type="button"><i class="fa fa-plus"></i> Delete </button>
                            </td>
                    </tr>
                     @endif
             </table>
        </div>
</div>
