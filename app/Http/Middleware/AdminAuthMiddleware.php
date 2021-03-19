<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;


class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
     
        
       // echo '<pre>';
       $user=new User();
       $token = $request->header("client-secret-id");
       
       if($user->getUserIDFromToken($token)){
        return $next($request);
       }else{
           return response()->json(["message"=>"Authorized Area"],403);
       }
    }
}
