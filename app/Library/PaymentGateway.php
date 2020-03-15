<?php 

namespace App\Library;


use Razorpay\Api\Api;

class PaymentGateway {
  public $ApiKey;
  public $ApiSecret;


 public function __construct(){
    $this->ApiKey = env('RAZORPAY_KEY');
    $this->ApiSecret = env('RAZORPAY_SECRET');
 }

   public function generateOrder(){
    $api = new Api($this->ApiKey,$this->ApiSecret);
    $order  = $api->order->create(array('receipt' => '123', 'amount' => 100, 'currency' => 'INR')); // Creates order
    $orderId = $order['id']; // Get the created Order ID
    // $order  = $api->order->fetch($orderId);
    // $orders = $api->order->all($options); // Returns array of order objects
    $payments = $api->order->fetch($orderId)->payments(); // Returns array of payment objects against an order
    dd($payments);
   } 

   public function createAccount($email,$name,$bankAccount)
   {
      //https://api.razorpay.com/v1/beta/accounts
          
        $data = array(
            "name"=>$name,
            "email"=>$email,
            "tnc_accepted"=>true,
            "account_details"=>array(
               "business_name"=>'Arogyarth',
               "business_type"=>"individual"
            ),
            "bank_account"=>$bankAccount
        );
       return $this->callApi($data,'beta/accounts');

   }
   public function directTransfers($account,$amount)
   {
      //https://api.razorpay.com/v1/direct-transfers
          
        $data = array(
            'account'=>$account,
            'amount'=>$amount,
            'currency'=>'INR',
        );
       return $this->callApi($data,'transfers');

   }
       
   public function callApi($data,$url)
   {

       $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/'.$url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_USERPWD, "$this->ApiKey:$this->ApiSecret");
      $headers = array();
      $headers[] = 'Accept: application/json';
      $headers[] = 'Content-Type: application/json';
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      $data = curl_exec($ch);
      if (empty($data) OR (curl_getinfo($ch, CURLINFO_HTTP_CODE != 200))) {
         return array('status'=>'error','message'=>'Please try again');
      } else {
          $dataRes =  json_decode($data, TRUE);
          $status = isset($dataRes['error'])?'error':'success';
          $message = isset($dataRes['error'])?$dataRes['error']['description']:'';
          $data = isset($dataRes['id'])?$dataRes['id']:0;
                                       
          return array('status'=>$status,'message'=>$message,'data'=>$data);
      }
      curl_close($ch);


   }
       

}