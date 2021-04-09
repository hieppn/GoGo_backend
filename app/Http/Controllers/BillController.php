<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Order;
use App\Models\Bill;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BillController extends Controller
{

    public function getAllBill(){
        return response()->json(Bill::all(),200);
    }
    public function getBillById(Request $request,$id){
        return response()->json(DB::select('SELECT o.*,u.full_name AS trucker_name,u.phone, 
        (SELECT t.name FROM trucks as t WHERE t.id = b.id_truck ) AS truck_name ,
        (SELECT t.license_plate FROM trucker_information AS t WHERE t.id_trucker = b.id_trucker ) AS plate 
        FROM bills AS b, orders AS o, users AS u 
        WHERE b.id_order = o.id AND b.id_trucker = u.id
        ORDER BY b.id DESC'),200);
    }
    public function getBillByIdTruck(Request $request,$id){
        return response()->json(DB::select('select b.id_trucker, o.* from bills as b, orders as o where  o.id = b.id_order  and o.type = 2 and b.id_trucker = '.$id),200);
    }
}
