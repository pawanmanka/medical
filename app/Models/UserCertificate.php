<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCertificate extends Model
{
    public $appends = [
        'image_url'
    ];
    public function getImageUrlAttribute(){
        $image = url(config('application.default_image_path'));
        $destinationPath = public_path(config('application.certificate_image_path').'/'.$this->file_name);
        if(!empty($this->file_name)  && file_exists($destinationPath)){
          $image = url(config('application.certificate_image_path').'/'.$this->file_name);
        }
        return $image;
    }
}
