<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SearchHistory;
class SearchHistoryController extends Controller
{
    public function create(Request $request){
        $searchHistory = new SearchHistory;
        $searchHistory->title = $request->title;
        $searchHistory->id_user = $request->id_user;
        $searchHistory->save();
        return response()->json('Success', 200);    
    }
    public function getSearchByIdUser(Request $request, $id){
        $searchHistory = SearchHistory::where('id_user', $id)->orderBy('id', 'DESC')->get();
        return response()->json($searchHistory,200);
    }
    public function delete(Request $request, $id){
        
        $search = SearchHistory::find($id);
        $id_user = $search->id_user;
        $search->delete();
        $result = SearchHistory::where('id_user',$id_user)->orderBy('id', 'DESC')->get();
        return response()->json($result,200);
    }
}

