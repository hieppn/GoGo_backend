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
            "note"=> "required",
            "image"=> "required",
        ]);
        $order = new Order;
        $order->send_from = $request->send_from;
        $order->send_to = $request->send_to;
        $order->time_send = $request->time_send;
        $order->name = $request->name;
        $order->mass = $request->mass;
        $order->car_type = $request->car_type;
        $order->note = $request->note;
        $order->image = $request->image;
        $order->id_user = $request->id_user;
        $query = $order->save();

        if($query){
            echo $order;
            // $data = array(
            //     "order"=>$order->id,
            // );
            // return response()->json($data, 200);
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
}
