<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Order;
use App\Models\Bill;
use App\Models\Location;
use App\Models\Rate;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use ParagonIE\EasyRSA\PublicKey;
use ParagonIE\EasyRSA\EasyRSA;
use phpseclib\Crypt\RSA;
use Illuminate\Support\Facades\Http;
use App\Models\TokenDevice;


class BillController extends Controller
{

    public function getAllBill(){
        return response()->json(Bill::all(),200);
    }
    public function getBillById(Request $request,$id){
        return response()->json(DB::select('SELECT o.*,b.id as id_bill,u.full_name AS trucker_name,u.phone , u.id as id_trucker,  u.avatar as trucker_avt,
        (SELECT t.name FROM trucks as t WHERE t.id = b.id_truck ) AS truck ,
        (SELECT t.license_plate FROM trucker_information AS t WHERE t.id_trucker = b.id_trucker ) AS plate 
        FROM bills AS b, orders AS o, users AS u 
        WHERE b.id_order = o.id AND b.id_trucker = u.id AND b.id_sender = '.$id.'
        ORDER BY b.id DESC'),200);
    }
    public function getBillProcess(){
        return response()->json(DB::select('SELECT o.*,u.full_name AS trucker_name,u.phone, u.id as id_trucker,
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
       $location =  Location::where('id_user',$id)->first();
       return response()->json( $location,200);
    }
    public function getLocationList(){
        return response()->json(Location::all(),200);
    }
    public function comment(Request $request){
        $id_bill = $request->id_bill;
        $bill = Bill::find($id_bill);
        $order = Rate::where('id_order',$bill->id_order)->first();
        if($order){
            return response()->json(["message"=>"You rated"],400);
        }
        $rate = new Rate;
        $rate->id_order= $bill->id_order;
        $rate->id_sender= $bill->id_sender;
        $rate->id_trucker= $bill->id_trucker;
        $rate->point  = $request->point;
        $rate->comment = $request-> comment;
        $rate->save();
            return response()->json($rate, 200);
    }
    public function handleMomoPayment(Request $request) {
        $token = $request->bearerToken();
        $amount = $request->amount;
        $orderId =$request->orderId; 
        $customerNumber =$request->customerNumber; 

        $publicKey ="-----BEGIN PUBLIC KEY-----MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAlMwuxob0ikOunHuE641vBb49GvZ7JzM1skx+wA6sZeZ59XIEFub6C+zBQs4nO8ERIn7LtbE9adcpCAPBobIQ7Jd46irVg+tUaPlICHJsI0unRLMX22vgDvDn7V+CidmxvKG3Yzw4A2hqBPhI9fklRsWtu083YqFnJ0v20eXCQhXU2Txzwo+5CybSs0gOW46d5h+uQBIiIJGVtvA09I2y88ErS9ZLp8ocuDkI6DvLyjlfmoBqcB8u8yPp6gZPyK5ILRep5IGHksipGPiU35ZyzSq9YA/U/cl207Rq/LP5CqHTJATfxn4DlwCBftSlwcuE09Q5mNopP3AWySA3xGwiM6H598Hg/I7e8DSyyQpDIDA09Hhw+JSsJU6JFbdxTM6OEsPU88RHBOgxHPOXFQ4vFgwNVkoX0NajXHVztvPnpqs5yVW7xXsNsmfRuU7Sc27xAfOvnQUfv+CgIGoWU2JS9FURRHpYCReHmwfzHnF9U3o3Xad33PnEaWqyjqIXeRWy4X/Qx9H3OLLUtgrOxlXj5577Bi1Tjvc/bSVJfufK6abemBAKzBoPxtwRwOvFxZtjzRQzfNsl4WvYarfgaBVgs2EiLDPMmcBLvnGD+HPNCuKGJbz2PY0VMh9NgeN6scUP3VEDcrz7fZlyfbNx8SgU26whB17LQBtfpzxNIA+Y6ocCAwEAAQ==-----END PUBLIC KEY-----";
        $message = [
            "partnerCode"=> "MOMOWF3W20210504",
            "partnerRefId"=> $orderId,
            "amount"=> $amount,
        ];
        $hash = $this->encryptRSA($message,$publicKey);
        $response = Http::post('https://test-payment.momo.vn/pay/app',
        [  
            "partnerCode"=>"MOMOWF3W20210504",
            "customerNumber"=> $customerNumber,
            "partnerRefId"=> $orderId,
            "appData"=> $token,
            "hash"=>$hash,
            "description"=> "Thanh toan cho don hang GoGo qua MoMo",
            "version"=> 2,
            "payType"=>3,
        ]
    );
       return $response;
    }

    public function momoCallBack(Request $request) {
        $data = 
        'partnerCode='.$request->partnerCode
        .'&'.
        'partnerRefId='.$request->partnerRefId
        .'&'.
        'requestType=capture'
        .'&'.
        'requestId='.$request->requestId
        .'&'.
        'momoTransId='.$request->momoTransId;

        $secret=$request->accessKey;
        $signature = hash_hmac('sha256',$data,$secret);
        $user = new TokenDevice();
        $user->id_user = 1;
        $user->token=$data;
        $user->save();
        return $signature;

       
    }
    public function encryptRSA(array $rawData, $publicKey)
    {

        $rawJson = json_encode($rawData, JSON_UNESCAPED_UNICODE);

        $rsa = new RSA();
        $rsa->loadKey($publicKey);
        $rsa->setEncryptionMode(RSA::ENCRYPTION_PKCS1);

        $cipher = $rsa->encrypt($rawJson);
        return base64_encode($cipher);
    }
}
