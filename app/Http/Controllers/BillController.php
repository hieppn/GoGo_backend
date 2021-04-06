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
        return response()->json(DB::select('select o.*,u.full_name as trucker_name,u.phone, (SELECT t.license_plate FROM trucker_information as t WHERE t.id_trucker = b.id_trucker ) as plate from bills as b, orders as o, users as u where b.id_order = o.id and b.id_trucker = u.id;'),200);
    }
    public function getBillByIdTruck(Request $request,$id){
        return response()->json(DB::select('select b.id_trucker, o.* from bills as b, orders as o where  o.id = b.id_order and b.id_trucker = '.$id),200);
    }
}
