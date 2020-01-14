<?php

namespace App\Traits;


trait UploadImage
{

    public function fileUpload($request,$path,$unLinkImagePath = null,$field = 'image')
    {

        $this->validate($request, [
            "$field" => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file("$field");
     

        $imageName = $this->_upload($path,$image);

     
        if(!empty($unLinkImagePath)){
            $destinationPath = public_path($unLinkImagePath);
           if(file_exists($destinationPath)){
               unlink($destinationPath);
           }
        }
        
        return $imageName;
    }

    public function _upload($path,$image)
    {
            $file = $image->getPathName(); 
            $sourceProperties = getimagesize($file);
            $fileNewName = time();
         //   $folderPath = "upload/";
            $folderPath = public_path('/'.$path.'/');

            $ext = $image->getClientOriginalExtension();
            $imageType = $sourceProperties[2];
                  $imageNAME = $fileNewName. "_thump.". $ext;
            switch ($imageType) {
    
    
                case IMAGETYPE_PNG:
                    $imageResourceId = imagecreatefrompng($file); 
                    $targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                    imagepng($targetLayer,$folderPath. $imageNAME);
                    break;
    
    
                case IMAGETYPE_GIF:
                    $imageResourceId = imagecreatefromgif($file); 
                    $targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                    imagegif($targetLayer,$folderPath.$imageNAME);
                    break;
    
    
                case IMAGETYPE_JPEG:
                    $imageResourceId = imagecreatefromjpeg($file); 
                    $targetLayer = $this->imageResize($imageResourceId,$sourceProperties[0],$sourceProperties[1]);
                    imagejpeg($targetLayer,$folderPath.$imageNAME);
                    break;
    
    
                default:
                    echo "Invalid Image type.";
                    break;
            }

        return $imageNAME;
    }

    function imageResize($imageResourceId,$width,$height) {


        $targetWidth =300;
        $targetHeight =300;
    
    
        $targetLayer=imagecreatetruecolor($targetWidth,$targetHeight);
        imagecopyresampled($targetLayer,$imageResourceId,0,0,0,0,$targetWidth,$targetHeight, $width,$height);
    
        return $targetLayer;
    }

    public function fileUploadFile($image,$path,$unLinkImagePath = null)
    {


        // $imageName = time() . '.' . $image->getClientOriginalExtension();
        // $destinationPath = public_path('/'.$path.'/'.$imageName);
        $imageName = $this->_upload($path,$image);

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
