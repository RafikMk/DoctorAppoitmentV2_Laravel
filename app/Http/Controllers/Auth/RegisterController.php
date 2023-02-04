<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Role;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'gender' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create2(Request $data)
    {
        $role = Role::whereName('Patient')->first();

        $user  =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => 'online',
            'password' => Hash::make($data['password']),
            'role_id' => $role->id,
            'gender' => $data['gender'],
        ]);
        $role=  Role::where('id',$user->role_id)->firstOrFail();

$token = $user->createToken('auth_token')->plainTextToken;
  /*  return response()->json([
    'access_token' => $token,
         'token_type' => 'Bearer',
  ]);*/
  return response()->json([
    'id' =>$user->id,
    'username'=>$user->name,
    'email'=>$user->email,
    'roles'=>array($role->name),
    'accessToken' => $token,
    'tokenType' => 'Bearer',
]);
    }
    protected function create(array $data)
    {
        $role = Role::whereName('Doctor')->first();

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => 'online',
            'password' => Hash::make($data['password']),
            'role_id' => $role->id,
            'gender' => $data['gender'],
        ]);
     
$token = $user->createToken('auth_token')->plainTextToken;
    return response()->json([
    'access_token' => $token,
         'token_type' => 'Bearer',
  ]);
    }
}
