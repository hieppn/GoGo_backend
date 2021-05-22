<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TruckerTempt;
use App\Models\TokenDevice;
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
            'email'=>'required|email|unique:users|unique:trucker_tempts',
            'password'=>'required|min:5|max:12',
            'phone'=>'required|regex:/[0-9]{10}/|digits:10|unique:users|unique:trucker_tempts',
            'birthday'=>'required',
            'address'=>'required',
            'id_card'=>'required|unique:users|unique:trucker_tempts',
        ]);
        if($request->id_role == 2){
            $tempt = new TruckerTempt;
            $tempt->full_name = $request->full_name;
            $tempt->email = $request->email;
            $tempt->password = Hash::make($request->password);
            $tempt->phone = $request->phone;
            $tempt->birthday = $request->birthday;
            $tempt->address = $request->address;
            $tempt->id_card = $request->id_card;
            $tempt->id_role = $request->id_role;
            $tempt->id_card_front = $request->id_card_front;
            $tempt->id_card_back = $request->id_card_back;
            $tempt->license_front = $request->license_front;
            $tempt->license_back = $request->license_back;
            $tempt->license_plate = $request->license_plate;
            $tempt->registration_paper = $request->registration_paper;
            $tempt->car_type = $request->car_type;
            $tempt->payload = $request->payload;
            if(!$request->avatar){
                $data = array(
                    "error"=>'You must update your avatar!',
                );
                return response()->json($data, 400); 
            }else{
                $tempt->avatar = $request->avatar;
            }
            $query = $tempt->save();
            if($query){
                $data = array(
                    "user_id"=>$tempt->id,
                );
                return response()->json($data, 200);
            }else{
                $data = array(
                    "error"=>'Something went wrong!',
                );
                return response()->json($data, 400);  
            }
        }else{
            $user = new User;
            $user->full_name = $request->full_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->birthday = $request->birthday;
            $user->address = $request->address;
            $user->id_card = $request->id_card;
            $user->id_role = $request->id_role;
            $user->amount = 0;
            $user->avatar = "https://pngimage.net/wp-content/uploads/2018/06/no-avatar-png-4.png";
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
    }
    public function login(Request $request){
        $request->validate([  
            'password'=>'required|min:5|max:12',
            'phone'=>'required|regex:/[0-9]{10}/|digits:10',
        ]);
        $token = $request->token;
        $user = User::where('phone','=',$request->phone)->first();
        if(!$user){
            $trucker= TruckerTempt::where('phone','=',$request->phone)->first();
            if($trucker && Hash::check($request->password,$trucker->password)){
                $data = array(
                    "role"=>4,
                );
                return response()->json($data,200);
            }
            $data = array(
                "error"=> ' Not match with your phone!',
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
                $tokenDevice = new TokenDevice ;
                $tokenDevice->id_user = $user->id;
                $tokenDevice->token = $token;
                $tokenDevice->save();
                return response()->json($data, 200);
            }else{
                $data = array(
                    "error"=>' Wrong password!',
                );
                
                return response()->json($data, 400);  
            }
        }
    }
    public function logout(Request $request){
        $token = $request->bearerToken();
        TokenDevice::where('token', $token)->delete();
        return response()->json("Delete success token", 200);
    }
    public function profile($id){
        $user=User::find($id);
        if($user->id_role == 2){
            $profile = DB::select('SELECT u.*, i.id_card_front, i.id_card_back,i.license_front,i.license_back,i.license_plate, i.registration_paper, i.car_type, i.payload FROM trucker_information as i, users as u
            WHERE u.id = '.$id.' AND i.id_trucker = '.$id);
            $point = DB::select('SELECT AVG(point)::numeric(10,1) as point from rates where id_trucker ='.$id.' GROUP BY id_trucker');
            $data = array(
                "user"=>$profile,
                "rate"=>$point
            );
            return response()->json($data ,200);
        }
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
    public function lockUser($id){  
        $user = User::find($id);
    }
    public function existPhone(Request $request){
        $phoneUser =User::where('phone','=',$request->phone)->first();
        $phoneTrucker = TruckerTempt::where('phone','=',$request->phone)->first();
        if($phoneTrucker||$phoneUser){
            $data = array(
                "error"=>"Phone number exist",
            );
            return response()->json($data, 400); 
        }
        $data = array(
            "phone"=>$request->phone,
        );
        return response()->json($data,200);
    }
}
