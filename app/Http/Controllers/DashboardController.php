<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    // Count in DASHBOARD

    public function countOrder(){
        return Order::count();
    }

    public function countUser(){
        $users = DB::table('users')
                    ->where('id_role', 1)
                    ->orWhere('id_role', 2)
                    ->count();
        
        return  $users;
        
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

    // Chart
    public function Chart(){
        $order = Order::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');

        return view('Admin/trangchu', compact('order'));
    }
    
}
