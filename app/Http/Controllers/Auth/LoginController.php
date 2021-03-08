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
    function login(){
        return view('auth.login');
    }
    function register(){
        return view('auth.register');
    }
    function create(Request $request){
        //return $request->input();
        $request->validate([
            'full_name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5|max:12',
            'phone'=>'required|unique:users',
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
        $user->id_role = "3";
        $query = $user->save();

        if($query){
            return back()->with('success',' You have been successfully registered');
        }else{
            return back()->with('fail',' Something went wrong!');   
        }
    }
    function check(Request $request){
        //return $request->input();
        $request->validate([  
            'password'=>'required|min:5|max:12',
            'phone'=>'required',
        ]);
        $user = User::where('phone','=',$request->phone)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                $request->session()->put('Logged', $user->id);
                return redirect('profile');
            }else{
                return back()->with('fail',' Wrong password!');   
            }
        }else{
            return back()->with('fail',' Not match with your phone!');   
        }
    }
    function profile(){
        if(session()->has('Logged')){
            $user=User::where('id','=',session('Logged'))->first();
            $data=[
                'UserInfo'=> $user
            ];
        }
         return view('admin.profile',$data);
    }
    function logout(){
        if(session()->has('Logged')){
            session()->pull('Logged');
            return redirect('login');
    }
}
}