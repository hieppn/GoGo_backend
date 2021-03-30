<?php   

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Bill;
use App\Models\Order;
use App\Models\Notification;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function addNewOrder( Request $request){
        $request->validate([
            "send_from"=> "required",
            "send_to"=> "required",
            "time_send"=> "required",
            "name"=> "required",
            "mass"=> "required",
            "car_type"=> "required",
            "image"=> "required",
        ]);
        $order = new Order;
        $order->send_from = $request->send_from;
        $order->send_to = $request->send_to;
        $order->time_send = $request->time_send;
        $order->name = $request->name;
        $order->mass = $request->mass;
        $order->car_type = $request->car_type;
        $order->export_data = $request->export_data;
        $order->sender_info = $request->sender_info;
        $order->receiver_info = $request->receiver_info;
        $order->image = $request->image;
        $order->id_user = $request->id_user;
        $order->price = $request->price;
        $query = $order->save();

        if($query){
            $notification = new Notification;
            $notification->message = "Thêm mới order thành công";
            $notification->id_user = 3;
            $notification->save();
            $data = array(
                "order"=>$order->id,
            );
            return response()->json($data, 200);
        }else{
            $data = array(
                "error"=>'Something went wrong!',
            );
            return response()->json($data, 400);  
        }
    }

    public function getOrder(){     
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
    public function updateStatus(Request $request,$id){
        $order = Order::find($id);
        if(!$order){
            return response()->json(["message"=>"Record not found!"],404);
        }
            else{
                // $id_user = $order->id_user;
                $order->type = $request->type;
            $order->save();
            // $orders = $this->getOrderByIdUser($id_user);
        return response()->json($order,200);
    }
}
    
    public function getOrderNew(){
        return response()->json(Db::select('select u.full_name, o.* from orders as o, users as u where o.id_user = u.id and o.type=1' ) ,200);
        
    }

    public function getOrderByIdUser($id){
        $orders = Order::where('id_user',$id)->get();
        if($orders){
            $data = array(
                "ordersByUser"=>$orders,
            );
            return response()->json($data, 200);
        }else{
            $data = array(
                "error"=>'Something went wrong!',
            );
            return response()->json($data, 400);  
        }
    }
    public function acceptOrder($id){
        $order = Order::find($id);
        $order->type = 2;
        $order->save();
        return response()->json($order,200);
    }
    public function canceledOrder($id){
        $order = Order::find($id);
        $order->type = 4;
        $order->save();
        return response()->json($order,200);
    }
}
