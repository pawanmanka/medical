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

   public function createAccount()
   {
      //https://api.razorpay.com/v1/beta/accounts

        $data = array(
            "name"=>"Gaurav Kumar",
            "email"=>"test2909@example.com",
            "tnc_accepted"=>true,
            "account_details"=>array(
               "business_name"=>"Acme Corporation",
               "business_type"=>"individual"
            ),
            "bank_account"=>array(
               "ifsc_code"=>"HDFC0CAGSBK",
               "beneficiary_name"=>"Gaurav Kumar",
               "account_type"=>"current",
               "account_number"=>878787
            )
        );
        $this->callApi($data,'beta/accounts');       



   }
       
   public function callApi($data,$url)
   {

       $ch = curl_init();
      // $fields = array();
      // $fields["name"] = $name;
      // $fields["email"] = $email;
      // $fields["contact"] = $phone;
      // $fields["reference_id"] = "customer".$phone;
      // $fields["type"] = "customer";
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
  dd($data);
      if (empty($data) OR (curl_getinfo($ch, CURLINFO_HTTP_CODE != 200))) {
         $data = FALSE;
      } else {
          return json_decode($data, TRUE);
      }
      curl_close($ch);


   }
       

}