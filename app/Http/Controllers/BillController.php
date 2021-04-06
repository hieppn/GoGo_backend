<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Order;
use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    // public function createBill($id_order, $id_trucker){
    //     $bill = new Bill;
    //     $bill->id_order = $id_order;
    //     $bill->id_user = $id_trucker;
    //     $bill->save();
    //     $data = array(
    //         "bill"=>$bill,
    //     );
    //     return response()->json($data, 200);
    // }
    public function getAllBill(){
        return response()->json(Bill::all(),200);
    }
    public function getBillById(Request $request,$id){
        return response()->json(Db::select('select o.*,u.full_name as trucker_name,u.phone, (SELECT t.license_plate FROM trucker_information as t WHERE t.id_trucker = b.id_trucker ) as plate from bills as b, orders as o, users as u where b.id_order = o.id and b.id_trucker = u.id;'),200);
    }
}
