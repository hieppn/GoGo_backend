<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function getAllOrder(){
        return Order::all();
    }
    public function addNewOrder( Request $request){
        $newOrder = Order::create($request->all());
        if($newOrder){
            return response()->json($newOrder,200);
        }else{
            return response()->json(400);
        }  
    }
    public function getAllOrders(){
        return Order::all();
    }
}
