<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Order;
use App\Models\Bill;
use App\Models\Location;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BillController extends Controller
{

    public function getAllBill(){
        return response()->json(Bill::all(),200);
    }
    public function getBillById(Request $request,$id){
        return response()->json(DB::select('SELECT o.*,u.full_name AS trucker_name,u.phone, 
        (SELECT t.name FROM trucks as t WHERE t.id = b.id_truck ) AS truck ,
        (SELECT t.license_plate FROM trucker_information AS t WHERE t.id_trucker = b.id_trucker ) AS plate 
        FROM bills AS b, orders AS o, users AS u 
        WHERE b.id_order = o.id AND b.id_trucker = u.id
        ORDER BY b.id DESC'),200);
    }
    public function getBillByIdTruck(Request $request,$id){
        return response()->json(DB::select('select b.id_trucker, o.* from bills as b, orders as o where  o.id = b.id_order  and o.type = 2 and b.id_trucker = '.$id),200);
    }
    public function getCompleteBillTruck(Request $request,$id){
        return response()->json(DB::select('select b.id_trucker, o.* from bills as b, orders as o where  o.id = b.id_order  and o.type = 3 and b.id_trucker = '.$id. ' ORDER BY b.id DESC'),200);
    }
    public function addLocation(Request $request){

        $check = Location::where('id_user', $request->id_user)->first();
        if(is_null($check)){
            echo "chưa có";
            $location = new Location;
            $location->id_user = $request->id_user;
            $location->location = $request->location;
            $location->save();
            return response()->json( $location,200);
        }else {
            echo "đã có id trucker";
            echo $check->location;
            if($check->location == $request->location){
                return response()->json( "Location exist",200);
                echo "location exist";
            }else{
                $check->location = $request->location;
                $check->save();
                return response()->json( $check,200);
                echo "update location";
            }
        }
       
    }
    public function getLocationById(Request $request,$id){
       $location =  Location::where('id_user',$id)->get();
       return response()->json( $location,200);
    }
    public function getLocationList(){
        return response()->json(Location::all(),200);
    }
}
