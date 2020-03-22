<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\HospitalDoctor;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletTrans;
use App\Traits\OtpHandle;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    
    use OtpHandle;
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
        $this->data['slug'] = $request->slug;   
        $this->data['doctorFlag'] = false;   
        $this->data['userObj'] = $userObj;   
        $this->data['title'] = 'booking'; 
        $this->data['wallet'] =  auth()->user()->getWallet; 
        $this->data['wallet_amount'] =$wallet_amount =  !empty(auth()->user()->getWallet->id)?auth()->user()->getWallet->amount:0; 
        
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
            $item = $request->item;
            $productDetail = ProductItem::where('code',$item)->where('status',2)->first();
            if(!isset($productDetail->id)){
                abort(404);
            }
           
            $this->data['productDetail'] = $productDetail;
           
        }
        else if($userObj->role_name  == config('application.doctor_role')){
            $view  = '_doctor_booking';
            $item = $request->item;
            if(!empty($item)){
                $productDetail = ProductItem::where('code',$item)->where('status',2)->first();
                if(!isset($productDetail->id)){
                    abort(404);
                }
                $this->data['doctorFlag'] = true;
                $view = 'booking'; 
                try {
                    $productDetail->dateStr = $productDetail->name;
                    //code...
                } catch (\Throwable $th) {
                    //throw $th;
                }
                $productDetail->date = date("d-m-Y", $productDetail->name);
                $productDetail->name = date("h:i A", $productDetail->name);
                $this->data['productDetail'] = $productDetail;
            }
           
        }
        else{
            abort(404);
        }
       
        return $view;
    }

   
    public function getSlots(Request $request)
    {
        $status = self::$ERROR;
        $slots ='';
        $post = $request->all();
        $userObj = User::with('getWallet')->where('slug',$request->slug)->where('status',0)->first();
        if(isset($userObj->id)){
        
        $rules = array(
            'date'=>'required'
        );
       
        $validation = \Validator::make($request->all(),$rules);
        if($validation->fails()){
            $message =   makeErrorMessage($validation->errors()->messages());
        }
        else{
            $user = $userObj->getUserInformation;

              $date = date('Y-m-d',strtotime($request->date));
              $productObj = Product::where('date',$date)->whereType(Product::$DOCTOR)->whereUserId($userObj->id)->first();
              if(isset($productObj->id)){
                  $productItems = $productObj->productItems()->where('status',2)->get();
                  foreach ($productItems as $key => $value) {
                    $time_start_value =  $value->name;;
                    $dataArr = array(
                       'time'=>date("h:i A", $time_start_value),
                       'price'=>$value->price,
                       'status_class'=>$value->status_class,
                       'index'=>$value->code
                     );
                    $slots.= \View::make('_booking_slot',$dataArr)->render();
                  }
           
                  
                  $message =  "Slots";
                  $status = self::$SUCCESS;

              }
              else{
                  $message ="doctor is not available";
              }
             
           
        }
     
         }
         else{
            $message ="doctor is not available";
         }
        $result = array(
            'status'=>$status,
            'message'=>$message,
            'slots'=>$slots,  
            'post'=>$post,  
        );

        return response()->json($result);
    }


    public function save(Request $request)
    {
        $this->_getProductDetail($request);
        
        $walletAmount = $this->data['wallet_amount'];
        $walletObj = $this->data['wallet'];
        $productDetail = $this->data['productDetail'];
        $userObj = $this->data['userObj'];
        $walletLinkUrl = url('my-wallet');
        $walletLink = "<a href='$walletLinkUrl'>Click Here</a>";
        if($walletAmount < $productDetail->price){
            flash('Please Add Money In Wallet '.$walletLink)->error()->important();
            return back()->withInput();
        }
        if(!isset($walletObj->amount)){
            flash('Please Add Money In Wallet '.$walletLink)->error()->important();
            return back()->withInput();
        }
        
        $rules =[];
        if(!$this->data['doctorFlag']){
            $rules =  [
                'date' => ['required','date']
            ];
        }

        $validatorObj =   \Validator::make($request->all(),$rules);
        if($validatorObj->fails()){
            flash(makeErrorMessage($validatorObj->errors()->messages()))->error()->important();
            return back()->withInput(); 
        }
        else{
           
            if($this->data['doctorFlag']){
                $date = date('Y-m-d H:i:s',($productDetail->dateStr));
            }
            else{
                $date = date('Y-m-d H:i:s',strtotime($request->date));
            }
           $currentUser = auth()->user();

           $merchant_user =  $productDetail->getUser;
        
           $adminMargin = marginCalculation($productDetail->price,$merchant_user->default_percentage);
           
           //detect for wallet
           $walletObj->amount = $walletObj->amount - $productDetail->price;
           $walletObj->save();

          
           
           // save appointment
           $appointmentObj = new  Appointment();
           $appointmentObj->product_item_id = $productDetail->id; 
           $appointmentObj->patient_id =  auth()->id(); 
           $appointmentObj->price = $productDetail->price; 
           $appointmentObj->admin_margin_amount = $adminMargin; 
           $appointmentObj->merchant_amount = $productDetail->price - $adminMargin; 
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
            $productDetail = ProductItem::find($productDetail->id);
            if($userObj->role_name  == config('application.doctor_role')){
              $productDetail->status = 1;
            }
            $productDetail->save();

            $this->sendSms($appointmentObj->patient_contact_number,config('application.booking_patient_sms_content').$appointmentObj->code);
            flash('Appointment is successfully created')->success()->important();
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