<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use HasApiTokens;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function signin(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        //    'expires_in' => $user->tokens->first()->expires_at->getTimestamp(),
        ]);
    }
public function signin2(Request $request)
{
if (!Auth::attempt($request->only('email', 'password'))) {
return response()->json([
'message' => 'Invalid login details'
           ], 401);
       }


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
}


}
