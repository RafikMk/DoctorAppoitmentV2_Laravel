<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Closure;
use App\User;
use App\Role;
class BasicAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request,  $next)
    {
    //    dd($request->input('email'));
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            $user = User::where('email', $request['email'])->firstOrFail();
            $role=  Role::where('id',$user->role_id)->firstOrFail();
            $token = $user->createToken('auth_token',['role'=>$role->name])->plainTextToken;
            return response()->json([
                       'id' =>$user->id,
                       'username'=>$user->name,
                       'email'=>$user->email,
                       'roles'=>array($role->name),
                       'accessToken' => $token,
                       'tokenType' => 'Bearer',
            ]);
     //   return response()->json(['error' => 'Invalid credentials'], 401);
        }
        else {
            return $next($request);

        }
    }
}
