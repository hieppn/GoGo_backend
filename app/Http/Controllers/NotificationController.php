<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;
class NotificationController extends Controller
{
    public function getNotification(){
        return response()->json(Db::select('select u.full_name, n.* from notifications as n, users as u where n.id_user = u.id  order by created_at desc') ,200);
        
    }
    public function deleteNotification(Request $request,  $id){
        $notification = Notification::find($id);
        if(is_null($notification)){
            return response()->json(["message"=>"Record Promotion not found!"],404);
        }
        $notification->delete();
        return response()->json(null,204);
    }
}
