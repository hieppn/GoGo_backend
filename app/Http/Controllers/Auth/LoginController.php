<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
    public function register(Request $request){
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
        if($request->id_role == 2){
            if(!$request->avatar){
                $data = array(
                    "error"=>'You must update your avatar!',
                );
                return response()->json($data, 400); 
            }else{
            $user->avatar = $request->avatar;
            }
        }else{
            $user->avatar = "https://pngimage.net/wp-content/uploads/2018/06/no-avatar-png-4.png";
        }
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
    public function login(Request $request){
        $request->validate([  
            'password'=>'required|min:5|max:12',
            'phone'=>'required|regex:/[0-9]{10}/|digits:10',
        ]);
        $user = User::where('phone','=',$request->phone)->first();
        if(!$user){
            $data = array(
                "error"=> ' Not match with your phone!'  ,
            );     
            return response()->json($data, 400);    
        }
        else
        {
            $password= $request->password;
            if(Hash::check($password,$user->password)){
                $data = array(
                    "user_id"=>$user->id,
                    "role"=>$user->id_role,
                    "error"=>null,
                );
                return response()->json($data, 200);
            }else{
                $data = array(
                    "error"=>' Wrong password!',
                );
                
                return response()->json($data, 400);  
            }
        }
    }
    public function profile($id){
        $user=User::find($id);
        $data = array(
            "user"=> $user,
        );
        return response()->json($data, 200);  
    }
    public function updateImage($id, Request $request){
        $user = User::find($id);
        
        if(!$user){
            return response()->json(["message" =>"Record not found!"],404);
        }
            $user->avatar = $request->avatar;
            $user->save();
        return response()->json($user,200);
    }
    public function updateUser($id, Request $request){
        $user = User::find($id);    
        if(is_null($user)){
            return response()->json(["message"=>"Record not found!"],404);
        }
            $user->update($request->all());
        return response()->json($user,200);
    }
    public function logout(){  
        //Auth::logout();
}
}
