@if(isset($photos))
<div class="form-group mt-10">
    <div class="col-sm-10 ">  
    <label class="control-label col-sm-6" for="Photos">Photos</label>
    <button class="btn btn-primary" id="add_photos" type="button"><i class="fa fa-plus"></i> Add</button> 
   </div>

        <div class="col-sm-10 ">
             <table id="photos_list" class="table">
                     @if(!$photos->isEmpty())
                     @foreach ($photos as $item)
                     <tr>
                             <td>
                             <img  style="width: 50px; height: 50px;"  class="imagePreview" id="categoryImage" src="{{ $item->image_url }}">

                                  <input type="hidden" name="photo[id][]" value="{{$item->id}}">   
                                  <input type="file" class="valueInput" name="photo[image][]" value="{{$item->name}}">   
                             </td>
                        
                             <td>
                             <button class="btn btn-danger delete_photo"  type="button"><i class="fa fa-plus"></i> Delete </button> 

                             </td>
                     </tr>
                     @endforeach
                     @else
                     <tr>
                            <td>
                                 <input type="file" name="photo[image][]" value="">   
                            </td>
                        
                            <td>
                                    <button class="btn btn-danger delete_photo" type="button"><i class="fa fa-plus"></i> Delete </button>
                            </td>
                    </tr>
                     @endif
             </table>
        </div>
</div>

@ifend