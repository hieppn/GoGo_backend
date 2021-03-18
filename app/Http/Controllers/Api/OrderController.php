<?php   

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

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
    public function getAllOrders(){
        return Order::all();
    }
    public function getOrderByIdUser($id){
        $orders = Order::where('is_user',$id)->get();
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
}
