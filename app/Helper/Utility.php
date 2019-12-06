<?php 


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

