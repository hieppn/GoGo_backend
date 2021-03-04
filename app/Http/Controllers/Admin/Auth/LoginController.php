<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use \Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    function login(Request $request){
		$email = $request->input('email');
    $password = $request->input('password');   
		if(($email==="admin@gmail.com" && $password==="admin")||($email==="admin1@gmail.com" && $password==="admin")){
      return view("welcome");
    } else{
			return view("Admin.Login");
			echo "Failed";
		}
	}
}
