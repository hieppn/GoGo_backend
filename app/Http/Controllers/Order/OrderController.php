<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
class OrderController extends Controller
{
    function getAllOrder(){
        return Order::all();
    }
    function getOrderByUser(){

    }
    public function addNewOrder(Request $request)
    {
       
    }

    public function getOrderDetail($id)
    {
        echo $id;
        $order = DB::select('select o.quantity as quantityCart, p.* from product as p , orders as o where p.id =o.id_product and o.id_user ='.$id);
        return $order;
    }

}
