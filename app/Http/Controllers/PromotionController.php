<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Promotion;

class PromotionController extends Controller
{
    // Promotion
    public function getPromotion(){      
        return response()->json(Promotion::get(),200);
    }

    public function deletePromotion(Request $request,  $id){
        $promotion = Promotion::find($id);
        if(is_null($promotion)){
            return response()->json(["message"=>"Record Promotion not found!"],404);
        }
        $promotion->delete();
        return response()->json(null,204);
    }

    public function PromotionByID($id){
        $promotion = Promotion::find($id);
        if(is_null($promotion)){
            return response()->json(["message"=>"Record not found!"],404);
        }
        return response()->json($promotion,200);
    }

    public function PromotionSave( Request $request){
        $promotion = Promotion::create($request->all());

        return response()->json($promotion,200);
        
        }
            
    public function PromotionUpdate(Request $request,$id){
        
        $promotion = Promotion::find($id);
        
        if(is_null($promotion)){
            return response()->json(["message"=>"Record not found!"],404);
        }
            $promotion->update($request->all());
        return response()->json($promotion,200);
    }
    public function PromotionByCode(Request $request, $code){
        $promotion = Promotion::where('code', $code)->first();
        
        if(is_null($promotion)){
            return response()->json(["message"=>"Record not found!"],404);
        }else {
            return response()->json($promotion,200);
        }
        
    }
}
