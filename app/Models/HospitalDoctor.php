<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HospitalDoctor extends Model
{
    protected $guarded = ['id'];
    protected $append = ['image_url'];
    
    public function getImageUrlAttribute(){
        $image = url(config('application.default_image_path'));
        $destinationPath = public_path(config('application.hospital_doctor_image_path').'/'.$this->image);
        if(!empty($this->image)  && file_exists($destinationPath)){
          $image = url(config('application.hospital_doctor_image_path').'/'.$this->image);
        }
        return $image;
    }
}