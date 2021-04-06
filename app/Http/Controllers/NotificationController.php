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
    public function sendCloudMessageToAndroid(Request $request){ 
        $message = $request->message; 
        $push_data = $request->push_data;   
        $url = 'https://fcm.googleapis.com/fcm/send ';
        $serverKey = "AAAAdehMlwQ:APA91bGWNCSzcttIw8O9sFpLuMt8gntB8DH__Dgy3kGGi9c6654BOf3e5ib-Unasm_fDEpTUjF0nwf0t6f514izgWWqJwNhJ_nXibCsJcXzAgtLlFkZ9S3lZJeA5GsSZ5wbUhAaDuGFD";
        $msg = array(
            'message' => $message,
            'data' => $push_data
        );      
        $deviceToken = "eP5fQh9rTVWz_uDnLhPzzn:APA91bHKvgoCbHvJrHWoMH5w3hcnlAQc708QaMdm6rY3k6h2pq455D9jtYvHbCwDby5LWBpyvovoeZMmzPf9Q3Wm5Yudg1AzF8__sY213BYhZY6ykjTZXXoYy-PoWsjS8WbIzuMfs2gd";      
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
    public function testSend(){
        $token = "eP5fQh9rTVWz_uDnLhPzzn:APA91bHKvgoCbHvJrHWoMH5w3hcnlAQc708QaMdm6rY3k6h2pq455D9jtYvHbCwDby5LWBpyvovoeZMmzPf9Q3Wm5Yudg1AzF8__sY213BYhZY6ykjTZXXoYy-PoWsjS8WbIzuMfs2gd";  
        $from = "AAAAdehMlwQ:APA91bGWNCSzcttIw8O9sFpLuMt8gntB8DH__Dgy3kGGi9c6654BOf3e5ib-Unasm_fDEpTUjF0nwf0t6f514izgWWqJwNhJ_nXibCsJcXzAgtLlFkZ9S3lZJeA5GsSZ5wbUhAaDuGFD";
        $msg = array
              (
                'body'  => "Testing Testing",
                'title' => "Hi, From Raj",
                'receiver' => 'erw',
                'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
                'sound' => 'mySound'/*Default sound*/
              );

        $fields = array
                (
                    'to'        => $token,
                    'notification'  => $msg
                );

        $headers = array
                (
                    'Authorization: key=' . $from,
                    'Content-Type: application/json'
                );
        //#Send Reponse To FireBase Server 
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        dd($result);
        curl_close( $ch );
    } 
    
    
}
