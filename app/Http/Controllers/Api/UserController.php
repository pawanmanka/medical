<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $rules =  [
            'username' => [
                'required',
                 Rule::exists('users')->where(function ($query) {
                    $query->whereNotNull('mobile_verified_at');
                    $query->where('status',0);
                  
                }),
            ],
            'password' => 'required',
        ];

        $validatorObj =   \Validator::make($request->all(),$rules);
        if($validatorObj->fails()){
            $message = makeErrorMessage($validatorObj->errors()->messages());
            return response()->json(['status'=>'error','message' =>$message], 400);
        }
        else{

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['status'=>'error','message' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['status'=>'error','message' => 'could_not_create_token'], 500);
        }
         
        }
        $user = auth()->user();
        if(!$user->hasRole('doctor')){
            return response()->json(['status'=>'error','message' => 'invalid_credentials'], 400);
        }
        $user['token'] = Crypt::encrypt($user->id); 
        unset($user['roles']);
        $response = array(
            'status'=>'success',
            'message'=>'get token',
            'data'=>$user,
        );

        return response()->json($response,200);
    }

    public function getDoctorHistory(Request $request)
    {
        $user = auth()->user();
        if(!$user->hasRole('doctor')){
            return response()->json(['status'=>'error','message' => 'invalid_credentials'], 400);
        }

        $appointment = Appointment::select('patient_name','price','date')->where('user_id',auth()->id())->get();    

        $response = array(
            'status'=>'success',
            'message'=>'get appointment',
            'data'=>$appointment,
        );

        return response()->json($response); 
    }
  
    public function getAppointment(Request $request)
    {
        $user = auth()->user();
        if(!$user->hasRole('doctor')){
            return response()->json(['status'=>'error','message' => 'invalid_credentials'], 400);
        }

        $appointment = Appointment::select('patient_name','price','date')->where('code',$request->code)->where('user_id',auth()->id())->first();    

        $response = array(
            'status'=>'success',
            'message'=>'get appointment',
            'data'=>$appointment,
        );

        return response()->json($response); 
    }

    public function getAuthenticatedUser()
        {
                try {

                        if (! $user = JWTAuth::parseToken()->authenticate()) {
                                return response()->json(['user_not_found'], 404);
                        }

                } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

                        return response()->json(['token_expired'], $e->getStatusCode());

                } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

                        return response()->json(['token_invalid'], $e->getStatusCode());

                } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

                        return response()->json(['token_absent'], $e->getStatusCode());

                }

                return response()->json(compact('user'));
        }
}
