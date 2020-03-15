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

    public function sendOtp($mobile,$userId = 0,$message)
    {
        Otp::where('mobile',$mobile)->delete();
        $token = $this->generateOtp($mobile);
        $OtpObj = new Otp();
        $OtpObj->mobile = $mobile;
        $OtpObj->token = $token;
        $OtpObj->user_id = $userId;
        $OtpObj->save();
                
       $this->_sendSms($OtpObj->mobile,$message.$token);

       
    }

    public function sendSms($mobile,$message)
    {
       $this->_sendSms($mobile,$message);
    }

  
     public function _sendSms($mobileNumber,$message)
     {
       
        $message = urlencode($message);
        $AuthKey = '3e69535a3dca26527da3baeed21999';
        $roundId = 1;
        $senderId = 'DEMOOS';
        $url = "http://msg.icloudsms.com/rest/services/sendSMS/sendGroupSms?AUTH_KEY=$AuthKey&message=$message&senderId=$senderId&routeId=$roundId&mobileNos=$mobileNumber&smsContentType=Unicode";
  
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL =>$url,
          CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
          ),
        ));
        $response = curl_exec($curl);
        
        $err = curl_error($curl);
        
        curl_close($curl);
        $result = json_decode($response);
        if ($err) {
            $status = 'error';
            $message = "cURL Error #:" . $err;
        } else if($result->responseCode == 3001) {
            $status = 'success';
            $message = 'done';
        }
        else{
            $status = 'error';
            $message = $result->response;
        }

        return array('status'=>$status,'message'=>$message);
     }

    public function checkMobile($mobile)
    {
        return Otp::where('mobile',$mobile)->first();
    }

}