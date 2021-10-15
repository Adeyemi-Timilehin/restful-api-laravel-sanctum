<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    //Method 1
    function reg(Request $request){
        $user=new User;
        $user->name=$request->input('name');
        $user->email=$request->input('email');
        $user->password=Hash::make($request->input('password'));
        $user->save();
        $token=$user->createToken('myapptoken')->plainTextToken;
$response=[
    'user'=>$user,
    'token'=>$token
];
return response($response, 201);
    }
    //Method 2
public function register(Request $request){
    $fields=$request->validate([
        'name'=>'required',
        'email'=>'required|string|unique:users,email',
        'password'=>'required|string|confirmed'
    ]);
    $user=User::create([
'name'=>$fields['name'],
'email'=>$fields['email'],
'password'=>bcrypt($fields['password'])
    ]);
$token=$user->createToken('myapptoken')->plainTextToken;
$response=[
    'user'=>$user,
    'token'=>$token
];
return response($response, 201);

}
public function login(Request $request){
    $fields=$request->validate([
       
        'email'=>'required|string',
        'password'=>'required|string'
    ]);
    //check Email
    $user=User::where('email',$fields['email'])->first();
    //Check Password
    if(!$user||Hash::check($fields['password'], $user->password))
return response([
    'message'=>'Bad password'
],401);
$token=$user->createToken('myapptoken')->plainTextToken;

$response=[ 'user'=>$user, 'token'=>$token ];
return response($response, 201);

}
public function logout(Request $request){
    auth()->user()->token()->delete();
    return[
        'message'=>'Logged out'
    ];
}
    //
}
