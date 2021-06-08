<?php   

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Bill;
use App\Models\Order;
use App\Models\Notification;
use App\Models\Truck;
use App\Models\User;
use App\Models\TokenDevice;
use Illuminate\Http\Request;
use App\Jobs\PushNotificationJob;
use App\Models\Message;
use App\Jobs\SendEmail;
class OrderController extends Controller
{
    public function addNewOrder( Request $request){
        $request->validate([
            "send_from"=> "required",
            "send_to"=> "required",
            "time_send"=> "required",
            "name"=> "required",
            "mass"=> "required",
        ]);
        $order = new Order;
        $order->send_from = $request->send_from;
        $order->send_to = $request->send_to;
        $order->time_send = $request->time_send;
        $order->name = $request->name;
        $order->mass = $request->mass;
        $order->insurance_fee = $request->insurance_fee;
        $order->id_truck = $request->id_truck;
        $order->export_data = $request->export_data;
        $order->sender_info = $request->sender_info;
        $order->receiver_info = $request->receiver_info;
        $order->image = $request->image;
        $order->id_user = $request->id_user;
        $order->price = $request->price;
        $query = $order->save();
        $devices = TokenDevice::where('id_user', $request->id_user)->get();
        foreach ($devices as $device) {
            $devicesId[] = $device->token;
            }
        $title = "Chúc mừng bạn đã thêm đơn hàng thành công";
        $body = "GoGo đang tìm tài xế cho đơn hàng #".$order->id ." của bạn. Đợi một tí nha!";
        if($query){
            $notification = new Notification;
            $notification->title = $title;
            $notification->message = $body;
            $notification->type = 1;
            $notification->isRead = false;
            $notification->id_user = $request->id_user;
            $notification->save();
            $value = Notification::where('id_user', $request->id_user)->where('isRead', false)->count();
            app('App\Http\Controllers\NotificationController')->pushNotification('order',$value,$title, $body, $devicesId); 
            app('App\Http\Controllers\NotificationController')->pushNotificationByTopic('new-order','Đơn hàng mới', 'Khách hàng vừa đăng đơn mới. Vào nhận liền thôi'); 
            $data = array(
                "order"=>$order->id,
            );
            
            return response()->json($data, 200);
        }else{
            $data = array(
                "error"=>'Something went wrong!',
            );
            return response()->json($data, 400);  
        }
    }
    public function getPrice(Request $request){
        $id_truck = $request->id_truck;
        $distance = $request->distance;
        $time = $request->time;
        $from = $request->from;
        $to = $request->to;
        $truck = Truck::find($id_truck);
        $unit_price = $truck->unit_price;
        $bonus_price = 0;
        if($distance > 4 && $from!=$to){
            $bonus_price = ($distance-4)*$truck->bonus_price;
        }
        (int)$hour = (int)substr($time,13,2);
        $on_day = substr($time,19);
        if((($hour >= 9) && ($on_day == "tối")) || (($hour <= 2) && ($on_day == "sáng"))){
            $price = $unit_price + $bonus_price + ($unit_price + $bonus_price)*0.3;
        }
        else{
            $price = $unit_price + $bonus_price;
        }
        return $price;
    }
    public function getOrder(){     
        return response()->json(Db::select('SELECT u.full_name, o.*, t.name AS truck FROM orders as o, users as u, trucks as t 
        WHERE o.id_user = u.id AND o.id_truck = t.id 
        ORDER BY o.id DESC') ,200);
   }

    public function deleteOrder(Request $request,  $id){
        $order = Order::find($id);
        $bill= Bill::where('id_order', $id)->delete();
        if(is_null($order)){
            return response()->json(["message"=>"Record Order not found!"],404);
        }
        $order->delete();
        return response()->json(null,204);
    }
    public function updateStatus(Request $request,$id){
        $order = Order::find($id);
        if($request->type == 2){
            $billTrucker = DB::select('SELECT COUNT(*) as count FROM bills,orders WHERE bills.is_order = orders.id,orders.type = 2 and bills.id_trucker = '.$request->id_trucker);
            if($billTrucker[0]->count !== 0){
                return response()->json('Trucker exist', 400);
          }else {
            $bill = new Bill;
            $bill->id_order = $order->id;
            $bill->id_sender = $order->id_user;
            $bill->id_truck = $order->id_truck;
            $bill->id_trucker = $request->id_trucker;
            $bill->save();
            $order->type = $request->type;
            $order->save();
            $users = User::find($request->id_trucker);
            $devices = TokenDevice::where('id_user', $order->id_user)->get();
                foreach ($devices as $device) {
                    $devicesId[] = $device->token;
            }
            $title = "Tài xế ".$users->full_name." đã nhận đơn hàng #".$order->id." của bạn!";
            $body = "Bạn hãy chuẩn bị đơn hàng, Tài xế sẽ đến sau vài phút nữa thôi";
            app('App\Http\Controllers\NotificationController')->pushNotification('order','',$title, $body, $devicesId); 
            $notification = new Notification;
            $notification->title = $title;
            $notification->message =  $body;
            $notification->isRead = false;
            $notification->type = 1;
            $notification->id_user = $order->id_user;
            $notification->save();
         
             //notify for trucker
             $devices_2 = TokenDevice::where('id_user', $request->id_trucker)->get();
                foreach ($devices_2 as $device) {
                    $devicesId_2[] = $device->token;
            }
             $title_2 = "Chúc mừng bạn đã nhận đơn hàng thành công!";
             $body_2 = "Hãy chuẩn bị xe và đến địa điểm lấy hàng";
             app('App\Http\Controllers\NotificationController')->pushNotification('order','',$title_2, $body_2, $devicesId_2); 
            $notification = new Notification;
            $notification->title = $title_2;
            $notification->message = $body_2;
            $notification->isRead = false;
            $notification->type = 1;
            $notification->id_user = $request->id_trucker;
            $notification->save();
            return response()->json('Success', 200);
            }
        }else if($request->type == 3){
            $order->type = $request->type;
            $order->save();
            //send mail to sender
            $user = User::find($order->id_user);
            $send_from = json_decode($order->send_from, TRUE);
            $receiver_info = json_decode($order->receiver_info, TRUE);
            $sender_info = json_decode($order->sender_info, TRUE);
            $send_to = json_decode($order->send_to, TRUE);
            if($order->insurance_fee==true){
                $insurance_fee = ($order->price/1.35)*0.25;
                $message = [
                    'id' => $order->id,
                    'name' => $order->name,
                    'insurance_fee' => $insurance_fee,
                    'vat'=> ($order->price/1.35)*0.1 ,
                    'total'=>$order->price,
                    'price'=>$order->price/1.35,
                    'sender_name'=>$sender_info['name'],
                    'sender_phone'=>$sender_info['phone'],
                    'sender_address'=>$send_from['address'].', '.$send_from['city'],
                    'receiver_name'=>$receiver_info['name'],
                    'receiver_phone'=>$receiver_info['phone'],
                    'receiver_address'=>$send_to['address'].', '.$send_to['city'],
                ];
            }else{
                $insurance_fee = 0;
                $message = [
                    'id' => $order->id,
                    'name' => $order->name,
                    'insurance_fee' => $insurance_fee,
                    'vat'=> ($order->price/1.1)*0.1 ,
                    'total'=>$order->price,
                    'price'=>$order->price/1.1,
                    'sender_name'=>$sender_info['name'],
                    'sender_phone'=>$sender_info['phone'],
                    'sender_address'=>$send_from['address'].', '.$send_from['city'],
                    'receiver_name'=>$receiver_info['name'],
                    'receiver_phone'=>$receiver_info['phone'],
                    'receiver_address'=>$send_to['address'].', '.$send_to['city'],
                ];
            }
            SendEmail::dispatch($message, $user)->delay(now()->addMinute(1));
            //notify for user
            $devices = TokenDevice::where('id_user', $order->id_user)->get();
                foreach ($devices as $device) {
                    $devicesId[] = $device->token;
            }
            $title = "Đơn hàng của bạn đã được giao thành công!";
            $body = "GoGo rất hân hạnh phục vụ quý khách! Bạn cảm thấy tài xế như thế nào? Đánh gia tài xế ngay";
            $users = User::find($request->id_trucker);
            $notification = new Notification;
            $notification->title =  $title;
            $notification->message = $body;
            $notification->isRead = false;
            $notification->type = 3;
            $notification->id_user = $order->id_user;
            $notification->save();
            app('App\Http\Controllers\NotificationController')->pushNotification('order','',$title, $body, $devicesId); 
            //notify for trucker
            $devices_2 = TokenDevice::where('id_user', $request->id_trucker)->get();
            foreach ($devices_2 as $device) {
                $devicesId_2[] = $device->token;
            }
            $title_2 = "Chúc mừng bạn đã giao đơn hàng thành công!";
            $body_2 = "Tiền đã vào tài khoản của bạn. GoGo xin phép nhận 5% phí đơn hàng";
            $notification = new Notification;
            $notification->title = $title_2;
            $notification->message = $body_2;
            $notification->isRead = false;
            $notification->type = 2;
            $notification->id_user = $request->id_trucker;
            $notification->save();
            app('App\Http\Controllers\NotificationController')->pushNotification('order','',$title_2, $body_2, $devicesId_2); 
            if($order->insurance_fee==true){
                $amount = ($order->price/1.35)*0.95;
            }
            else{
                $amount = ($order->price/1.1)*0.95;
            }
            app('App\Http\Controllers\TruckerController')->updateAmount($request->id_trucker,$amount); 
            Message::where('id_send', $order->id_user)->delete();
            Message::where('id_send', $request->id_trucker)->delete();
            return response()->json('Success', 200);
        }
        return response()->json($order,200);
    }

    
    public function getOrderNew(){
        return response()->json(Db::select('select u.full_name, o.* from orders as o, users as u where o.id_user = u.id and o.type=1' ) ,200);
        
    }

    public function getOrderByIdUser($id){
        return response()->json(Db::select('select o.*, t.name as truck from orders as o, trucks as t where o.id_truck = t.id and o.id_user = '.$id.'orderBy desc') ,200);
    }
    public function acceptOrder($id){
        $order = Order::find($id);
        $order->type = 2;
        $order->save();
        return response()->json($order,200);
    }
    public function canceledOrder($id){
        $order = Order::find($id);
        $order->type = 4;
        $order->save();
        $devices = TokenDevice::where('id_user', $order->id_user)->get();
        foreach ($devices as $device) {
            $devicesId[] = $device->token;
            }
        $title = "Huỷ đơn hàng thành công";
        $body = "Đơn hàng #".$order->id." được hủy thành công";
        app('App\Http\Controllers\NotificationController')->pushNotification('order','',$title, $body, $devicesId); 
        return response()->json($order,200);
    }
    public function reOrder($id){
        $order = Order::find($id);
        $order->type = 1;
        $order->save();
        $devices = TokenDevice::where('id_user', $order->id_user)->get();
        foreach ($devices as $device) {
            $devicesId[] = $device->token;
            }
        $title = "Đặt lại đơn hàng thành công";
        $body = "GoGo đang tìm tài xế cho đơn hàng #".$order->id ." của bạn. Đợi một tí nha!";
        app('App\Http\Controllers\NotificationController')->pushNotification('order','',$title, $body, $devicesId); 
        return response()->json($order,200);
    }
    
}
