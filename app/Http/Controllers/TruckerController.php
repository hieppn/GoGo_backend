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
        return response()->json(Db::select('select r.name_role, u.* from users as u, roles as r where u.id_role = r.id and r.id = 2') ,200);  
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
            return response()->json(["message"=>"Record Promotion not found!"],404);
        }
        $user = new User;
        $trucker_info = new TruckerInformation;
        $user = new User;
        $user->full_name = $tempt->full_name;
        $user->email = $tempt->email;
        $user->password = $tempt->password;
        $user->phone = $tempt->phone;
        $user->birthday = $tempt->birthday;
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
        $trucker_info->save();
        $data = array(
            "user"=>$user,
            "info"=>$trucker_info
        );
        return response()->json($data, 200); 
    }
}
