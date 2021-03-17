<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Bill;
use App\Models\Order;
use App\Models\Promotion;
use App\Models\Role;
use App\Models\User;

use Illuminate\Http\Request;

class Admin extends Controller
{

    // Order
    

    public function get_Order(){
        
         return response()->json(Db::select('select u.full_name, o.* from orders as o, users as u where o.id_user = u.id') ,200);
    }

    public function deleteOrder(Request $request,  $id){
        $order = Order::find($id);
        $bill= Bill::where('id_order', $id)->delete();
        if(is_null($order)){
            return response()->json(["message"=>"Record Order not found!"],404);
        }
        $order->delete();
        return response()->json(null,204);
    }




    // Promotion
    public function getPromotion(){      
        return response()->json(Promotion::get(),200);
}

    public function deletePromotion(Request $request,  $id){
            $promotion = Promotion::find($id);
            if(is_null($promotion)){
                return response()->json(["message"=>"Record Promotion not found!"],404);
            }
            $promotion->delete();
            return response()->json(null,204);
        }

    public function PromotionByID($id){
        $promotion = Promotion::find($id);
        if(is_null($promotion)){
            return response()->json(["message"=>"Record not found!"],404);
        }
        return response()->json($promotion,200);
    }

        public function PromotionSave( Request $request){
            $promotion = Promotion::create($request->all());

            return response()->json($promotion,200);
           
            }
            



        public function PromotionUpdate(Request $request,$id){
            
           $promotion = Promotion::find($id);
            
            if(is_null($promotion)){
                return response()->json(["message"=>"Record not found!"],404);
            }
             $promotion->update($request->all());
            return response()->json($promotion,200);
        }



//User
    public function getTrucker(){  
        return response()->json(Db::select('select r.name_role, u.* from users as u, roles as r where u.id_role = r.id and r.id = 2') ,200);  
    }

    public function deleteUser(Request $request,  $id){
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



// Count in DASHBOARD

public function countOrder(){
    return Order::count();
}
public function getCountAccount($id_role){
    
    $count_account= User::where('id_role',$id_role)->count(); 
    return $count_account;
}

public function countSender(){
    
    $count_sender= User::where('id_role',1)->count(); 
    return $count_sender;
}

public function countTrucker(){
    
    $count_trucker= User::where('id_role',2)->count(); 
    return $count_trucker;
}
}
    