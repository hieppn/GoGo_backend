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
        return response()->json(Bill::where("id_sender", $id)->get(),200);
    }
}
