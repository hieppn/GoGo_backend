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
    public function sendCloudMessageToAndroid(Request $request){ 
        $message = $request->message; 
        $push_data = $request->push_data;      
        $url = 'https://fcm.googleapis.com/fcm/send ';
        $serverKey = "AAAAdehMlwQ:APA91bGWNCSzcttIw8O9sFpLuMt8gntB8DH__Dgy3kGGi9c6654BOf3e5ib-Unasm_fDEpTUjF0nwf0t6f514izgWWqJwNhJ_nXibCsJcXzAgtLlFkZ9S3lZJeA5GsSZ5wbUhAaDuGFD";
        $msg = array(
            'message' => $message,
            'data' => $push_data
        );      
        $deviceToken = "e4meA0HXTHqzScOGZb8MvE:APA91bEVZm_MDmcm-T01kLqCNJlK7MEQPod_0DiRC08ZLLg-idhmzezCqQQu7ru5lD2txNV9Xl5XBpo9YMEwlWxpLTcAozJkQ-VpvnSBC8Eh33z079SiIAU2RGGny2Vfc8onX1FR5FKy";      
        $fields = array();
        $fields['data'] = $msg;
        if (is_array($deviceToken)) {
            $fields['registration_ids'] = $deviceToken;
        } else {
            $fields['to'] = $deviceToken;
        }
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $serverKey
        );   
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('FCM Send Error: '  .  curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }   
    
    
}
