<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class ConfigChartController extends Controller
{
    public function configOrder($id, Request $request){
        $order = Order::find($id);
        $order->created_at = $request->time;
        $order->save();
        return response()->json($order, 200);
    }
    public function configUser($id, Request $request){
        $user = User::find($id);
        $user->created_at = $request->time;
        $user->save();
        return response()->json($user, 200);
    }
}
