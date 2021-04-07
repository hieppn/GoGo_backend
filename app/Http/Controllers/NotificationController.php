<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;
class NotificationController extends Controller
{
    public function create(Request $request){
        $notification = new Notification;
        $notification->title = $request->title;
        $notification->message = $request->message;
        $notification->isRead = false;
        $notification->id_user = $request->id_user;
        $notification->save();
        return response()->json('Success', 200);
        
    }
    public function getNotification(){
        return response()->json(Db::select('select u.full_name, n.* from notifications as n, users as u where n.id_user = u.id  order by created_at desc') ,200);
        
    }
    public function deleteNotification(Request $request,  $id){
        $notification = Notification::find($id);
        if(is_null($notification)){
            return response()->json(["message"=>"Record Notification not found!"],404);
        }
        $notification->delete();
        return response()->json(null,204);
    }
    public function getNotificationById(Request $request,  $id){
        $notification = Notification::where('id_user', $id)->get();
        if(is_null($notification)){
            return response()->json(["message"=>"Record Notification not found!"],404);
        }
        return response()->json($notification,200);
    }
    public function countNotificationById(Request $request,  $id){
        $notification = Notification::where('id_user', $id)->where('isRead', false)->count();
        if(is_null($notification)){
            return response()->json(["message"=>"Record Notification not found!"],404);
        }
        return response()->json($notification,200);
    }
    public function updateNotificationRead(Request $request,$id){
        $notification = Notification::find($id);
        if(!$notification){
            return response()->json(["message"=>"Record not found!"],404);
        }else{
                $notification->isRead = true;
                $notification->save();
        }
        return response()->json($notification,200);
    }
    public function updateAllNotificationReadByIdUser(Request $request,$id){
            Db::select('UPDATE notifications SET notifications.isRead = true WHERE notifications.id_user = '.$id);
            return response()->json(["Update successfully"],200);
    }
    
}
