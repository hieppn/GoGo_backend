<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
class RevenueController extends Controller
{
    public function getRevenue(){
        $orders = Order::where('type',3)->get();
        $revenue = 0;
        foreach($orders as $order){
            if($order->insurance_fee==true){
                $revenue +=  ($order->price-$order->price*0.25)*0.05+$order->price*0.25;
            }
            else{
                $revenue +=  ($order->price)*0.05;
            }
        }
        return response()->json($revenue, 200);
    }
}
