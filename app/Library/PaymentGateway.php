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

}