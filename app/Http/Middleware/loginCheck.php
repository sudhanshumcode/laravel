<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class loginCheck
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
		if($request->sid ==12){
            return redirect('information');
        }
        return $next($request);
    }
}
