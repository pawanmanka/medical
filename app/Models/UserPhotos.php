<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPhotos extends Model
{
    protected $guarded = ['id'];
    protected $append = ['image_url'];
    
    public function getImageUrlAttribute(){
        $image = url(config('application.default_image_path'));
        $destinationPath = public_path(config('application.user_photos_path').'/'.$this->file_name);
        if(!empty($this->file_name)  && file_exists($destinationPath)){
          $image = url(config('application.user_photos_path').'/'.$this->file_name);
        }
        return $image;
    }

  
}