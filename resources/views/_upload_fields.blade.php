<div  class="col-md-12">
    @if(isset($record))
     <img    class="imagePreview" id="categoryImage" src="{{ isset($record->getUserInformation->profile_pic)?$record->getUserInformation->profile_pic:'' }}">
   @endif 

<div class="input-group">
<div class="input-group-prepend">
    <span class="input-group-text" id="inputGroupFileAddon01">Profile Image</span>
</div>
<div class="custom-file">
    <input type="file" class="custom-file-input" name="profile_image" accept="image/*" id="profile_image"
    aria-describedby="inputGroupFileAddon01">
    <label class="custom-file-label" for="profile_image">Choose file</label>
</div>
</div>
<br>
</div>
@if(!isset($record))
<div  class="col-md-12">
<div class="input-group">
<div class="input-group-prepend">
    <span class="input-group-text" id="inputGroupFileAddon2">Upload Certificate</span>
</div>
<div class="custom-file">
    <input type="file" class="custom-file-input" name="certificate[]" multiple accept="image/*" id="profile_image"
    aria-describedby="inputGroupFileAddon2">
    <label class="custom-file-label" for="certificate">Choose file</label>
</div>
</div>
</div>
@endif 