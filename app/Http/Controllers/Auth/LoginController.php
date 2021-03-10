<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    function register(Request $request){
        //return $request->input();
        $request->validate([
            'full_name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:12',
            'phone'=>'required|regex:/[0-9]{10}/|digits:10|unique:users',
            'birthday'=>'required',
            'address'=>'required',
            'id_card'=>'required|unique:users',
        ]);
        $user = new User;
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->birthday = $request->birthday;
        $user->address = $request->address;
        $user->id_card = $request->id_card;
        $user->id_role = $request->id_role;
        $query = $user->save();

        if($query){
            $data = array(
                "user_id"=>$user->id,
            );
            return response()->json($data, 200);
        }else{
            $data = array(
                "error"=>'Something went wrong!',
            );
            return response()->json($data, 400);  
        }
    }
    function login(Request $request){
        $request->validate([  
            'password'=>'required|min:5|max:12',
            'phone'=>'required|regex:/[0-9]{10}/|digits:10',
        ]);
        $user = User::where('phone','=',$request->phone)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $data = array(
                    "user_id"=>$user->id,
                );
                return response()->json($data, 200);
            }else{
                $data = array(
                    "error"=>' Wrong password!',
                );
                
                return response()->json($data, 400);  
            }
        }else{
            $data = array(
                "error"=> ' Not match with your phone!'  ,
            );
            
            return response()->json($data, 400);  
           
        }
    }
    function profile($id){
        $user=User::find($id);
        $data = array(
            "user"=> $user,
        );
        return response()->json($data, 200);  
    }
    function logout($id){
        return User::destroy($id);
}
}