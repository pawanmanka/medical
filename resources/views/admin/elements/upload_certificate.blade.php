<div class="form-group mt-10">
    <div class="col-sm-10 ">  
    <label class="control-label col-sm-6" for="Certificate">Certificate & award receives</label>
    <button class="btn btn-primary" id="add_certificates" type="button"><i class="fa fa-plus"></i> Add</button> 
   </div>

        <div class="col-sm-10 ">
             <table id="certificates_list" class="table">
                     @if(!$certificates->isEmpty())
                     @foreach ($certificates as $item)
                     <tr>
                             <td>
                             <img  style="width: 50px; height: 50px;"  class="imagePreview" id="categoryImage" src="{{ $item->image_url }}">

                                  <input type="hidden" name="certificate[id][]" value="{{$item->id}}">   
                                  <input type="file" class="valueInput" name="certificate[image][]" value="{{$item->name}}">   
                             </td>
                         
  
                             <td>
                              <input type="text" placeholder="Enter Name" value="{{ $item->title}}" name="certificate[name][]">

                             </td>
                             <td>
                             <button class="btn btn-danger delete_certificate"  type="button"><i class="fa fa-plus"></i> Delete </button> 

                             </td>
                     </tr>
                     @endforeach
                     @else
                     <tr>
                            <td>
                                 <input type="hidden" name="certificate[id][]" value="">   
                                 <input type="file" name="certificate[image][]" value="">   
                            </td>
                             <td>
                               <input type="text" placeholder="Enter Name" name="certificate[name][]">

                             </td>
                            <td>
                                    <button class="btn btn-danger delete_certificate" type="button"><i class="fa fa-plus"></i> Delete </button>
                            </td>
                    </tr>
                     @endif
             </table>
        </div>
</div>