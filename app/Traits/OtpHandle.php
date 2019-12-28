<?php 

namespace App\Traits;

use App\Models\Otp;

trait OtpHandle{
    
    public function generateOtp($mobile)
    {
        $otp = rand(100000,999999);
        
        $allOtps = $this->getRelatedOtp($otp,$mobile);

        if (! $allOtps->contains('token', $otp)){
            return $otp;
        }
        
        for ($i = 1; $i <= 10; $i++) {
            $newOtp = $otp.$i;
            if (! $allOtps->contains('token', $newOtp)) {
                return $newOtp;
            }
        }
    }

    protected function getRelatedOtp($otp, $mobile = 0)
    {
        return Otp::select('token')->where('token', 'like', $otp.'%')
            ->where('mobile', '<>', $mobile)
            ->get();
    }

    public function sendOtp($mobile,$userId = 0)
    {
        $token = $this->generateOtp($mobile);
        $OtpObj = new Otp();
        $OtpObj->mobile = $mobile;
        $OtpObj->token = $token;
        $OtpObj->user_id = $userId;
        $OtpObj->save();
    }

  


    public function checkMobile($mobile)
    {
        return Otp::where('mobile',$mobile)->first();
    }

}