<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\ProductItem;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTrans;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    
    public function __construct()
    {
       $this->data = array();
       $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $view = $this->_getProductDetail($request);
        return view($view,$this->data);
    }

    private function _getProductDetail($request){
        $userObj = User::with('getWallet')->where('slug',$request->slug)->where('status',0)->first();
        if(!isset($userObj->id)){
            abort(404);
        }
        $this->data['userObj'] = $userObj;   
        $this->data['title'] = 'booking'; 
        $this->data['wallet'] =  auth()->user()->getWallet; 
        $this->data['wallet_amount'] =$wallet_amount =  !empty(auth()->user()->getWallet)?auth()->user()->getWallet->amount:0; 
        
        $view = 'booking'; 
        if($userObj->role_name  == config('application.lab_role')){
            $item = $request->item;
            $productDetail = ProductItem::where('code',$item)->where('status',2)->first();
            if(!isset($productDetail->id)){
                abort(404);
            }
           
            $this->data['productDetail'] = $productDetail;
        }
        else if($userObj->role_name  == config('application.hospital_role')){

        }
        else if($userObj->role_name  == config('application.doctor_role')){
            $view  = '_doctor_booking';
        }
        else{
            abort(404);
        }

        return $view;
    }

    public function save(Request $request)
    {
        $this->_getProductDetail($request);
        
        $walletAmount = $this->data['wallet_amount'];
        $walletObj = $this->data['wallet'];
        $productDetail = $this->data['productDetail'];
        $userObj = $this->data['userObj'];
        if($walletAmount < $productDetail->actual_price){
            flash('Please Add Money In Wallet')->error()->important();
            return back()->withInput();
        }
        $rules =  [
            'date' => ['required','date']
        ];

        $validatorObj =   \Validator::make($request->all(),$rules);
        if($validatorObj->fails()){
            flash(makeErrorMessage($validatorObj->errors()->messages()))->error()->important();
            return back()->withInput(); 
        }
        else{
           $date = date('Y-m-d H:i:s',strtotime($request->date));
           $currentUser = auth()->user();

           
           //detect for wallet
           $walletObj->amount = $walletObj->amount - $productDetail->price;
           $walletObj->save();

           
           // save appointment
           $appointmentObj = new  Appointment();
           $appointmentObj->product_item_id = $productDetail->id; 
           $appointmentObj->price = $productDetail->price; 
           $appointmentObj->user_id = $userObj->id; 
           $appointmentObj->patient_name = $currentUser->name; 
           $appointmentObj->patient_gender = $currentUser->gender_title; 
           $appointmentObj->patient_contact_number = $currentUser->contact_number; 
           $appointmentObj->date =$date; 
           $appointmentObj->code = $appointmentObj->generateUniqueCode(); 
           $appointmentObj->save();
           
           
            //create for wallet trans
            $walletTransObj = new WalletTrans();
            $walletTransObj->user_id = auth()->id();
            $walletTransObj->action_user_id = auth()->id();
            $walletTransObj->wallet_id = $walletObj->id; 
            $walletTransObj->before_total = $walletObj->amount + $productDetail->price; 
            $walletTransObj->amount = $productDetail->price;
            $walletTransObj->after_total = $walletObj->amount ;
            $walletTransObj->description = " Appointment id $appointmentObj->id";
            $walletTransObj->save();

            flash('Appointment is successfully created')->error()->important();
            return redirect('/detail/'.$request->slug);
        } 
        
    }

    public function saveItem(Request $request)
    {
        $userObj = User::where('slug',$request->slug)->where('status',0)->first();

        if(!isset($userObj->id)){
            abort(404);
        }

        $this->data['userObj'] = $userObj;   
        $this->data['title'] = 'booking';   
        return view('booking_detail',$this->data);
    }
}