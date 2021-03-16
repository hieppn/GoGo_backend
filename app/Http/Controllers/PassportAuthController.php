<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PassportAuthController extends Controller
{
    /**
     * Registration
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'fullname' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
 
        $trucker = User::create([
            'fullname' => $request->fullname,
            'id_card'=>$request->id_card,
            'birthday'=>$request->birthday,
            'address'=>$request->address,
            'driving_license'=>$request->driving_license,
            'license_plate'=>$request->license_plate,
            'email' => $request->email,
            'phone'=>$request->phone,
            'password' => bcrypt($request->password),
            ''
        ]);
       
        $token = $trucker->createToken('LaravelAuthApp')->accessToken;
 
        return response()->json(['token' => $token], 200);
    }
 
    /**
     * Login
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
 
        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }  
    public function userInfo() 
    {
 
     $user = auth()->user();
      
     return response()->json(['user' => $user], 200);
 
    } 
}
