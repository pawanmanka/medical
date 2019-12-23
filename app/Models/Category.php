<?php

namespace App\Models;

use App\Traits\CreateSlug;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   use CreateSlug; 

   protected $table = 'catagories';
   protected $appends = ['image_url'];

   public static $DOCTOR = 1;
   public static $HOSPITAL = 2;
   public static $LAB = 3;

   public function getImageUrlAttribute()
   {
       $image = url(config('application.default_image_path'));
       $destinationPath = public_path(config('application.category_image_path').'/'.$this->image);
       if(!empty($this->image)  && file_exists($destinationPath)){
         $image = url(config('application.category_image_path').'/'.$this->image);
       }

       return $image;
   }

   public function getSubCategory()
   {
     return $this->hasMany(Category::class,'parent_id','id');
   }
 
}
