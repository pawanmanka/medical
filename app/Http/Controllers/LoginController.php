<?php 

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\OtpHandle;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller{
    
//    use AuthenticatesUsers;
use OtpHandle;

    public function __construct()
    {  $this->middleware('guest');
       $this->data = array(
           'menu'=>request()->segment(1)
       );
    }
    
    public function loginUser(Request $request)
    {
        return view('login_user');
    }
    public function login(Request $request)
    {
      // validate the info, create rules for the inputs
        $rules =  [
            'username' => [
                'required',
                Rule::exists('users')->where(function ($query) {
                    $query->where('status',0);
                }),
            ],
            'password' => 'required',
        ];

        // run the validation rules on the inputs from the form
        $validator = \Validator::make($request->all(), $rules);
       
        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return back()
                ->withErrors($validator);        
            
            } else {
            // create our user data for the authentication
                $userdata = array(
                    'username'  => $request->username,
                    'password'  => $request->password
                );
                $userObj =User::where('username',$request->username)->first();
                if(empty($userObj->mobile_verified_at)){
                    $this->sendOtp($userObj->contact_number,$userObj->id,config('application.register_sms_content'));
                    flash('Registration Successfully')->success()->important();
                    return redirect("/verifyOtp/$userObj->contact_number");    
                }
                if($userObj->role_name != $request->segment(1)){
                    flash('User not found')->error()->important();
                    return back(); 
                }

                // attempt to do the login
                if (\Auth::attempt($userdata)) {
                    return redirect('/dashboard');
                } else {        

                    return back(); 

                }

            }
    }
    public function username()
    {
        return 'username';
    }
    public function showLoginForm(Request $request)
    {
        return view('login',$this->data);
    }
    protected function sendFailedLoginResponse(Request $request)
    {
        flash('User not found')->error()->important();
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
       // return back()->withInput(); 
    }
    protected function validateLogin(Request $request)
    { 
        $request->validate(
        [
            'username' => [
                'required',
                Rule::exists('users')->where(function ($query) {
                    $query->whereNotNull('mobile_verified_at');
                    $query->where('status',0);
                }),
            ],
            'password' => 'required',
        ]
        );
    }

    public function doctor(Request $request)
    {
        $this->login($request);
    }


}