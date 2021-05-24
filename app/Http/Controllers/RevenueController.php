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
                $revenue +=  ($order->price/1.35)*0.4;
            }
            else{
                $revenue +=  ($order->price/1.1)*0.15;
            }
        }
        return response()->json($revenue, 200);
    }
}
