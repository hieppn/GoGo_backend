<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bill;
use App\Models\Order;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class SenderController extends Controller
{
    public function deleteSender(Request $request,  $id){
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


    
    function getSender(){
        return response()->json(Db::select('select r.name_role, u.* from users as u, roles as r where u.id_role = r.id and r.id = 1') ,200);  
     }

}
