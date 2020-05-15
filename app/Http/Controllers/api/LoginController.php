<?php

namespace App\Http\Controllers\api\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
     public function login(Request $request){
  //   	$user = new User();
		// $user->password = Hash::make('12345');
		// $user->email = 'shinas@gmail.com';
		// $user->name = 'Shinas';
		// $user->save();
		// dd($user);
    	$login = $request->validate([
    		'email' => 'required|string',
    		'password' => 'required|string'
    	]);
    	if(!Auth::attempt($login)){
    		return response(['message'=>'Invalid user broo...!!']);
    	}
    	$accessToken=Auth::user()->createToken('authToken')->accessToken;
    	return response(['user'=>Auth::user(),'access_token'=>$accessToken,'status'=>'success']);
    }
}
