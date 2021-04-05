<?php   

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Bill;
use App\Models\Order;
use App\Models\Notification;
use App\Models\Truck;
use Illuminate\Http\Request;

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

        if($query){
            $notification = new Notification;
            $notification->message = "Chúc mừng bạn đã thêm đơn hàng thành công";
            $notification->id_user = $request->id_user;
            $notification->save();
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
        return response()->json(Db::select('select u.full_name, o.*, t.name as truck from orders as o, users as u, trucks as t where o.id_user = u.id and o.id_truck = t.id;') ,200);
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
        if(!$order){
            return response()->json(["message"=>"Record not found!"],404);
        }
            else{
                // $id_user = $order->id_user;
                $order->type = $request->type;
            $order->save();
            // $orders = $this->getOrderByIdUser($id_user);
        return response()->json($order,200);
    }
}
    
    public function getOrderNew(){
        return response()->json(Db::select('select u.full_name, o.* from orders as o, users as u where o.id_user = u.id and o.type=1' ) ,200);
        
    }

    public function getOrderByIdUser($id){
        
        return response()->json(Db::select('select o.*, t.name as truck from orders as o, trucks as t where o.id_truck = t.id and o.id_user = '.$id) ,200);
        // $orders = Order::where('id_user',$id)->get();
        // foreach ($orders as $order) {
        //     $order->truck;
        // }
        // if($orders){
        //     $data = array(
        //         "ordersByUser"=>$orders,
        //     );
        //     return response()->json($data, 200);
        // }else{
        //     $data = array(
        //         "error"=>'Something went wrong!',
        //     );
        //     return response()->json($data, 400);  
        // }
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
        return response()->json($order,200);
    }
}
