<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\OtpHandle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ForgotPasswordController extends Controller{
    use OtpHandle;
    public function __construct()
    {
        $this->middleware('guest');
        $this->data = array(
            'menu'=>request()->segment(1)
        );
    }


    public function index(Request $request)
    {
        return view('forgot-password',$this->data);
    }
    public function sendVerificationSms(Request $request)
    {
        $validatorObj =   \Validator::make($request->all(), [
            'username' => [
                'required',
                Rule::exists('users')->where(function ($query) {
                    $query->whereNotNull('mobile_verified_at');
                    $query->where('status',0);
                }),
            ],
        ]);
        if($validatorObj->fails()){
            flash(makeErrorMessage($validatorObj->errors()->messages()))->error()->important();
            return back()->withInput(); 
        }
        else{
            $userObj = User::where('username',$request->username)->first();
            $this->sendOtp($userObj->contact_number,$userObj->id,config('application.register_sms_content'));
            flash('We send you sms on your register mobile number')->success()->important();
            return redirect('/reset-password?mobile='.$request->username);
        }
    }

    public function resetPage(Request $request)
    {

        $checkMobile = $this->checkMobile($request->mobile);
        if(!isset($checkMobile->id)){
            abort(404);
        }
        $this->data['mobile'] = $request->mobile;   
        return view('reset-password',$this->data);
    }

    public function resetPassword(Request $request)
    {
       
        $validatorObj =   \Validator::make($request->all(), [
            'username' => [
                'required',
                Rule::exists('users')->where(function ($query) {
                    $query->whereNotNull('mobile_verified_at');
                    $query->where('status',0);
                }),
            ],
            'otp' => 'required',
            'password' => 'required|confirmed',
        ]);
        if($validatorObj->fails()){
            flash(makeErrorMessage($validatorObj->errors()->messages()))->error()->important();
            return back()->withInput(); 
        }
        else{
            $checkMobile = $this->checkMobile($request->username);
            if(!isset($checkMobile->id)){
                flash(('Request is not found'))->error()->important();
                return back()->withInput(); 
            }
            else if($checkMobile->token != $request->otp){
                flash(('Opt is not valid'))->error()->important();
                return back()->withInput(); 
            }
            else{
                $userObj = User::where('username',$request->username)->first();
                $userObj->password = Hash::make($request->password);
                $userObj->save();
                flash('Your Password Reset Successfully')->success()->important();
                return redirect('/login');
            }

        }
    }
}