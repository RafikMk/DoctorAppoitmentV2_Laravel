<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        $user = Auth::guard('sanctum')->user();
  //dd(  $user);    
     //   $user =Auth::user() ;
       // dd($request);
     //  dd($next($request)) ;
     /*   if (Auth::user()->role_id == 1) {
            return $next($request);
        }*/
        if ($user === null ) {
            abort(403);

        }
        if ($user->role_id == 1) {
            return $next($request);
        }
    }
}
