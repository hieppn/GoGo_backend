<?php

namespace App\Http\Controllers;
use App\Models\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
   public function getAllTruck(){
       return response()->json(Truck::all(),200);
   }
   
   public function deleteTruck(Request $request,  $id){
    $truck = Truck::find($id);
    if(is_null($truck)){
        return response()->json(["message"=>"Record Promotion not found!"],404);
    }
    $truck->delete();
    return response()->json(null,204);
}


public function getTruckById($id){
    $truck = Truck::find($id);
    if(is_null($truck)){
        return response()->json(["message"=>"Record not found!"],404);
    }
    return response()->json($truck,200);
}

public function createTruck( Request $request){
    $truck = Truck::create($request->all());

    return response()->json($truck,200);
    
    }
        
public function updateTruck(Request $request,$id){
    
    $truck = Truck::find($id);
    
    if(is_null($truck)){
        return response()->json(["message"=>"Record not found!"],404);
    }
        $truck->update($request->all());
    return response()->json($truck,200);
}
}
