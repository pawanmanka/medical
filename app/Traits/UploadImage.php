<?php

namespace App\Traits;

use Image;

trait UploadImage
{

    public function fileUpload($request,$path,$unLinkImagePath = null,$field = 'image')
    {

        $this->validate($request, [
            "$field" => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file("$field");
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/'.$path.'/'.$imageName);
        // $image->move($destinationPath,$imageName);

        $image_resize = Image::make($image->getRealPath());              
        $image_resize->resize(300, 300);
        $image_resize->save($destinationPath);

        if(!empty($unLinkImagePath)){
            $destinationPath = public_path($unLinkImagePath);
           if(file_exists($destinationPath)){
               unlink($destinationPath);
           }
        }
        
        return $imageName;
    }

    public function fileUploadFile($image,$path,$unLinkImagePath = null)
    {


        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/'.$path.'/'.$imageName);

        $image_resize = Image::make($image->getRealPath());              
        $image_resize->resize(300, 300);
        $image_resize->save($destinationPath);

        if(!empty($unLinkImagePath)){
            $destinationPath = public_path($unLinkImagePath);
           if(file_exists($destinationPath)){
               unlink($destinationPath);
           }
        }
        
        return $imageName;
    }

    public function removeImage($unLinkImagePath)
    {
        $destinationPath = public_path($unLinkImagePath);
        if(file_exists($destinationPath)){
            unlink($destinationPath);
        }
        return true;
    }


}
