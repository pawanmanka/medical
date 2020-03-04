<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    protected $append = ['profile_pic','category_name',
    'mon_sat_morning_time','mon_sat_evening_time','sun_morning_time',
    'home_mon_sat_morning_time','home_mon_sat_evening_time','home_sun_time',
    'experience'
  ];

    public function getProfilePicAttribute(){
        $image = url(config('application.default_image_path'));
        $destinationPath = public_path(config('application.users_image_path').'/'.$this->profile_image);
        if(!empty($this->profile_image)  && file_exists($destinationPath)){
          $image = url(config('application.users_image_path').'/'.$this->profile_image);
        }
        return $image;
    }

    public function category()
    {
      return $this->hasOne(Category::class,'id','category');
    }
    public function getHospitalDoctor()
    {
      return $this->hasMany(HospitalDoctor::class,'user_id','user_id');
    }
    public function getAmenities()
    {
      return $this->belongsToMany(Amenities::class,'user_amenities','user_id','amenitie_id');
    }
    public function getLabCategory(){
      return $this->belongsToMany(Category::class,'lab_categories','user_id','category_id');

  }
    public function getCategoryNameAttribute()
    {
      $category = $this->category()->first();
      return isset($category->name)?$category->name:'';
    }
    public function getExperienceAttribute()
    {
      $practice_since = $this->practice_since;
 
       $date1 = $this->practice_since;  
       $date2 = date("Y");  
  
// Formulate the Difference between two dates 
      $diff = ($date2 - $date1);  
      $years = floor($diff);   

      return $years .' Year';
    }
    public function getMonSatMorningTimeAttribute()
    {
      $m_to_s_morning_start = date("h:i A", strtotime($this->m_to_s_morning_start));
      $m_to_s_morning_end = date("h:i A", strtotime($this->m_to_s_morning_end));
      return "$m_to_s_morning_start - $m_to_s_morning_end";
    }
    public function getMonSatEveningTimeAttribute()
    {
      $m_to_s_morning_start = date("h:i A", strtotime($this->m_to_s_evening_start));
      $m_to_s_morning_end = date("h:i A", strtotime($this->m_to_s_evening_end));
      return "$m_to_s_morning_start - $m_to_s_morning_end";
    }

    public function getSunMorningTimeAttribute()
    {
      $e_evening_start = date("h:i A", strtotime($this->e_evening_start));
      $e_evening_end = date("h:i A", strtotime($this->e_evening_end));
      return "$e_evening_start - $e_evening_end";
    }
  

    public function getHomeMonSatMorningTimeAttribute()
    {
      $start = date("h:i A", strtotime($this->h_m_s_morning_start));
      $end = date("h:i A", strtotime($this->h_m_s_morning_end));
      return "$start - $end";
    }
    public function getHomeMonSatEveningTimeAttribute()
    {
      $start = date("h:i A", strtotime($this->h_m_s_evening_start));
      $end = date("h:i A", strtotime($this->h_m_s_evening_end));
      return "$start - $end";
    }

    public function getHomeSunTimeAttribute()
    {
      $start = date("h:i A", strtotime($this->h_s_morning_start));
      $end = date("h:i A", strtotime($this->h_s_morning_end));
      return "$start - $end";
    }
}
