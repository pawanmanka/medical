<?php

use App\Models\Category;
use App\Models\Plan;
use App\Models\User;

if(!function_exists('baseUrl')){
    function baseUrl($url){
           return url($url)."?version=".config('application.siteVersion');
    }
}

if(!function_exists('selectBox')){
    function selectBox($name,$options,$value,$parameters = [],$empty = null){
        $parameters['options']=$options;
        $parameters['value']=$value;
        $parameters['empty']=$empty;
        $data=array(
            'name'=>$name,
            'parameters'=>$parameters
        );
        return view('admin.elements.select',$data)->render();
    }
}

if(!function_exists('ratingView')){
    function ratingView($rating)
    {
              $html ="";
              for($i = 1;$i <= 5;$i++){
                  if($rating >= $i) 
                  {
                    $html .='<i class="fas fa-star"></i>';
                    }
                    else{
                        $html .='<i class="fas"></i>';
                  }
              }
              return "<div class='rate-div'>$html</div>";    
    }
}

if(!function_exists('makeErrorMessage')){
     function makeErrorMessage($arr){
             $html = "";
            foreach ($arr as $key => $message) {
                $html .=implode('<br>',$message);
                $html .="<br>";
            }
            return $html;
     }
}

if(!function_exists('marginCalculation')){
       function marginCalculation($price,$margin){
             return $price*$margin; 
       }
}
if(!function_exists('topRateDoctor')){
       function topRateDoctor($parentSlug = 'doctors'){
             $roleSlug = (config('application.role_slug'));
             $role = isset($roleSlug[$parentSlug])?$roleSlug[$parentSlug]:'doctor';
             return User::with('getUserInformation')
             ->whereHas('roles',function($query) use($role){
                $query->whereIn('name',array($role));
              })
             ->limit(6)
             ->get(); 
       }
}

if(!function_exists('topCategory')){
       function topCategory($parentSlug = ''){
             $superCategoriesSlug = array_flip(config('application.super_categories_slug'));
             return Category::withCount('getUser')
             ->when(isset($superCategoriesSlug[$parentSlug]),function($query) use($superCategoriesSlug,$parentSlug){
                   $query->where('super_category_id',$superCategoriesSlug[$parentSlug]);
             })
             ->where('parent_id',0)->get(); 
       }
}
if(!function_exists('getSubscriptionPlans')){
       function getSubscriptionPlans(){
             return Plan::pluck('name','id'); 
       }
}