<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\User;
class AuthController extends Controller
{ 
    public function __construct(){
        $this->middleware('auth:api', ['except'=>['login','register']]);
    }

    //register method
    public function register(Request $request){
        // return $ip = $_SERVER['REMOTE_ADDR'];
        $validator = Validator::make($request->all(),[
            'firstname'=> 'required',
            'lastname'=> 'required',
            'username'=> 'required|string:unique:users',
            'email'=> 'required|string|email|unique:users',
            'password'=> 'required|string|min:6',
            'country'=> 'required|string',
            'country_code'=> 'required|string',
        ]);

            // 'wallet_balance'=> 'required',
            // 'btc_address'=> 'required',
            // 'withdraw_status'=> 'required',

        // Check if the username already exists
        if (User::where('username', $request->username)->exists()) {
            return response()->json(['message' => 'Username already exists'], 400);
        }
        if ($validator->fails()) {
            return response()->json(['message' => 'Email already taken'], 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            [
                'firstname'=>$request->firstname,
                'lastname'=>$request->lastname,
                'username'=>$request->username,
                'email'=>$request->email,
                'password' =>bcrypt($request->password),
                'country'=>$request->country,
                'country_code'=>$request->country_code,
                'country'=>$request->country,
                'withdraw_status'=> '0', //at status zero, user can withdraw
            ]
        ));

        return response()->json([
            'message'=>'User created Successfully',
            'user'=>$user
        ], 201);
    }


    //login method
    public function login(Request $request){

        $validator = Validator::make($request->all(),[
            'email'=> 'required|email',
            'password'=> 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }
        if (!$token=auth()->attempt($validator->validated())) {
            return response()->json(['msg'=>'Invalid details'], 401);
        }
        return $this->createNewToken($token);
    }

    // createNewToken
    private function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL()*60,
            'user' => auth()->user(),
        ]);
    }

    // profile
    public function authUser(){
        return response()->json(["msg" =>"success","data"=>
            auth()->user()
        ]);
    }
    // logout
    public function logout(){
        auth()->logout();
        return response()->json([
            "msg"=>"Logged out succefully"
        ]);
    }
}
