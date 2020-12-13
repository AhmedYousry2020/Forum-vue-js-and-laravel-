<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\profile;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{
    // register function
    public function register(Request $request){
    $validator = Validator::make($request->all(),[
       "name"=>'required|string',
       "email"=>'required|email|unique:users',
       "password"=>'required|confirmed|min:6'

    ]);
    if($validator->fails()){

        return response()->json([
            'status'=>"error",
            "errors"=>$validator->errors()

        ],422);
    }

    $user = new  User([
      "name"=>$request->name,
      "email"=>$request->email,
      "password"=>bcrypt($request->password)

    ]);
       $user->save();
       profile::create([
        "user_id"=>$user->id
    ]);

    return response()->json([
    "message"=>"Successfully created user"
    ],201);
    }

    //login function & create token
    public function login(Request $request){
    $request->validate([
        "email"=>'required|email',
        "password" =>'required',
        "remember_me"=>'boolean'

       ]);

       $data = $request->only("email","password");

       if ($token = $this->guard()->attempt($data)){
        return $this->respondWithToken($token);
    }
    return response()->json([
    "error"=>"Your Email/Password is Wrong"
    ],401);

    }

    //logout from app
    public function logout()
    {
        //auth()->logout();
        $this->guard()->logout();
        return response()->json(['message' => 'Successfully logged out'],200);
    }

     //get authenticated user data
    public function user()
    {
        if(!auth()->user()){
            return response()->json(["error"=>"error"]);
        }
        return response()->json(["data"=>auth()->user()]);
    }

    //refresh a token
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    private function guard(){

        return Auth::guard();
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',

        ]);
    }
}
