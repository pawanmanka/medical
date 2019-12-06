<?php 

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller{
    
    use AuthenticatesUsers;

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
        flash('User not')->error()->important();
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