<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use JWTAuth;
use Exception;
use Illuminate\Support\Facades\Crypt;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $token = Crypt::decrypt($request->token);
            $user = User::find($token);
            \Auth::login($user);
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status'=>'error','message' => 'Token is Invalid'],403);
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status'=>'error','message' => 'Token is Expired'],403);
            }else{
                return response()->json(['status'=>'error','message' => 'Authorization Token not found'],403);
            }
        }
        return $next($request);
    }
}
