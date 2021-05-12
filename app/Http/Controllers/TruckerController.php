<?php

namespace App\Http\Controllers;

use App\Models\TruckerInformation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Bill;
use App\Models\Order;
use App\Models\TruckerTempt;
use Illuminate\Support\Facades\DB;

class TruckerController extends Controller
{
    //User
    public function getTrucker(){  
        return response()->json(Db::select('select r.name_role, ti.*,u.* from users as u, roles as r, trucker_information as ti where u.id_role = r.id and r.id = 2 and u.id=ti.id_trucker') ,200);  
    }

    public function deleteTrucker(Request $request,  $id){
        $user = User::find($id);
        // $user = User::where('account_id', $id)->delete();
        $order= Order::where('id_user', $id)->delete();
        $bill= Bill::where('id_order', $id)->delete();
        if(is_null($user)){
            return response()->json(["message"=>"Record Promotion not found!"],404);
        }
        $user->delete();
        return response()->json(null,204);
    }


    public function truckerTemptByID($id){
        $truckerTempt = truckerTempt::find($id);
        if(is_null($truckerTempt)){
            return response()->json(["message"=>"Record not found!"],404);
        }
        return response()->json($truckerTempt,200);
    }
    public function registerTruckerInfo(Request $request){
        $trucker_info = new TruckerInformation;
        $trucker_info->id_trucker = $request->id_trucker;
        $trucker_info->id_card_front = $request->id_card_front;
        $trucker_info->id_card_back = $request->id_card_back;
        $trucker_info->license_front = $request->license_front;
        $trucker_info->license_back = $request->license_back;
        $trucker_info->license_plate = $request->license_plate;
        $query = $trucker_info->save();

            if($query){
                $data = array(
                    "trucker_info"=>$trucker_info,
                );
                return response()->json($data, 200);
            }else{
                $data = array(
                    "error"=>'Something went wrong!',
                );
                return response()->json($data, 400);  
            }
    }
    public function acceptTrucker($id){
        $tempt = TruckerTempt::find($id);
        if(is_null($tempt)){
            return response()->json(["message"=>"Record not found!"],404);
        }
        $user = new User;
        $trucker_info = new TruckerInformation;
        $user = new User;
        $user->full_name = $tempt->full_name;
        $user->email = $tempt->email;
        $user->password = $tempt->password;
        $user->phone = $tempt->phone;
        $user->birthday = $tempt->birthday;
        $user->amount = 0;
        $user->address = $tempt->address;
        $user->id_card = $tempt->id_card;
        $user->id_role = $tempt->id_role;
        $user->avatar = $tempt->avatar;
        $user->save();
        $trucker_info->id_trucker = $user->id;
        $trucker_info->id_card_front = $tempt->id_card_front;
        $trucker_info->id_card_back = $tempt->id_card_back;
        $trucker_info->license_front = $tempt->license_front;
        $trucker_info->license_back = $tempt->license_back;
        $trucker_info->license_plate = $tempt->license_plate;
        $trucker_info->registration_paper = $tempt->registration_paper;
        $trucker_info->car_type = $tempt->car_type;
        $trucker_info->payload = $tempt->payload;
        $trucker_info->save();
        $tempt->delete();
        $data = array(
            "user"=>$user,
            "info"=>$trucker_info
        );
        return response()->json($data, 200); 
    }

    public function truckerTempt(){
        return response()->json(TruckerTempt::get(),200);
    }
    public function refuseTrucker($id){
        $trucker = TruckerTempt::find($id);
        if(is_null($trucker)){
            return response()->json(["message"=>"Record not found!"],404);
        }
        $trucker->delete();
        return response()->json(null,204);
    }
    public function updateAmount($id, $amount){
        $user = User::find($id);
        $user->amount = $user->amount + $amount;
        $user->save();
        return response()->json($user,200);
    }
    public function profile($id){
        $profile = DB::select('SELECT u.full_name, u.birthday,u.address,u.amount,u.email,u.phone,u.avatar, i.* FROM trucker_information as i, users as u
        WHERE u.id = '.$id.' AND u.id = i.id_trucker');
         $point = DB::select('SELECT AVG(point)::numeric(10,1) as point from rates where id_trucker ='.$id.' GROUP BY id_trucker');
        $data = array(
            "profile"=>$profile,
            "rate"=>$point
        );
        return response()->json($data ,200);
    }
    public function getRateByTruckerId($id){
        $rate = DB::table('rates')
                 ->select(DB::raw('round(AVG(point),1) as rate'))
                 ->where('id_trucker',$id)
                 ->groupBy('id_trucker')
                 ->get();
                 return $rate;
    }
}
