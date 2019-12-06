<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    protected $append = ['profile_pic'];

    public function getProfilePicAttribute(){
        $image = url(config('application.default_image_path'));
        $destinationPath = public_path(config('application.users_image_path').'/'.$this->profile_image);
        if(!empty($this->profile_image)  && file_exists($destinationPath)){
          $image = url(config('application.users_image_path').'/'.$this->profile_image);
        }
        return $image;
    }
}
