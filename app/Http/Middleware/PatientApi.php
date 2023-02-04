<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PatientApi
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
        
      // dd($user->role_id);

  //dd(  $user);    
     //   $user =Auth::user() ;
       // dd($request);
     //  dd($next($request)) ;
     /*   if (Auth::user()->role_id == 1) {
            return $next($request);
        }*/
        if ($user === null ) {
            return response()->json([
                'message' => 'Invalid login details1'
                           ], 401);
        }
        if ($user->role_id == 3) {
            return $next($request);
        }
        else {
            return response()->json([
                'message' => 'Invalid login details2'
                           ], 401);
        }
    }
}
