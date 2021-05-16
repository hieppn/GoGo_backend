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
        $publicKey ="-----BEGIN PUBLIC KEY-----MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAlMwuxob0ikOunHuE641vBb49GvZ7JzM1skx+wA6sZeZ59XIEFub6C+zBQs4nO8ERIn7LtbE9adcpCAPBobIQ7Jd46irVg+tUaPlICHJsI0unRLMX22vgDvDn7V+CidmxvKG3Yzw4A2hqBPhI9fklRsWtu083YqFnJ0v20eXCQhXU2Txzwo+5CybSs0gOW46d5h+uQBIiIJGVtvA09I2y88ErS9ZLp8ocuDkI6DvLyjlfmoBqcB8u8yPp6gZPyK5ILRep5IGHksipGPiU35ZyzSq9YA/U/cl207Rq/LP5CqHTJATfxn4DlwCBftSlwcuE09Q5mNopP3AWySA3xGwiM6H598Hg/I7e8DSyyQpDIDA09Hhw+JSsJU6JFbdxTM6OEsPU88RHBOgxHPOXFQ4vFgwNVkoX0NajXHVztvPnpqs5yVW7xXsNsmfRuU7Sc27xAfOvnQUfv+CgIGoWU2JS9FURRHpYCReHmwfzHnF9U3o3Xad33PnEaWqyjqIXeRWy4X/Qx9H3OLLUtgrOxlXj5577Bi1Tjvc/bSVJfufK6abemBAKzBoPxtwRwOvFxZtjzRQzfNsl4WvYarfgaBVgs2EiLDPMmcBLvnGD+HPNCuKGJbz2PY0VMh9NgeN6scUP3VEDcrz7fZlyfbNx8SgU26whB17LQBtfpzxNIA+Y6ocCAwEAAQ==-----END PUBLIC KEY-----";
        $message = [
            "partnerCode"=> "MOMOWF3W20210504",
            "partnerRefId"=> "15",
            "amount"=> 440000,
        ];
        $hash = $this->encryptRSA($message,$publicKey);
        $response = Http::post('https://test-payment.momo.vn/pay/app',
        [  
            "partnerCode"=>"MOMOWF3W20210504",
            "customerNumber"=> "0919100100",
            "partnerRefId"=> "15",
            "appData"=> "v2/6VBqPxqjsQxPQbnzg/9gb6WocVbYf4Xh+43niSyMz0VNqdxAoNwhbEqAsoJPHOxs5MfytEzS4YrPMIMEu9t1/GWg+nsMRMmIDtqO5Qu4AlmpQxRXvGu6vRVTxG1yTtSx8+rvqlcxfIotfKW6VZ5BhAX4GbHaeg6d6V4gSo8ZfTF/cyUvn/Dd/scl9HnFtp6QgfLW8g2Uf2sz0qhXzQWwB/WH88JTpabwR4E1lO+APWIgDE7SklnD6ChUnCUlyT0KJGIN7Piq/0tOkexjgZPKGwZAozs04Rd1U65StxxETmy8sARAntZ+56Ony2y5Vgfri/3HV1phUuUGrYZ3rgciUiN3P/szsRGzSK8Zrgz+XvvEfvqsIl5MEL7+Pllg0c/pEl11wiN6oG+LFJxxthcb5/On6sqNVzl6MSM0XGAZ0BZdtH5/fDmzHFjVJbVOo1trnDRBbkcml4cExk67Z4tkhpR1q5hBAbYXnE/KW6FnPNIJfd9rnYDca7L3cgnfH4XZLXDhw5/Z/RJZrdxTsp5TtPecDY1NFsCjfn0lsUdMrb7L+pm+hwSV1T1EjaYPyF7RDJ1in5CJtrsBfjNjNUAkL53KSLaXXGOnxjRX/SAGSyXcvwij/KqP2rv2ULHNyUbjRjo67hDx9bEwrQC2W3ZjI+VhkT12m9Ke6O5AmxiP+ksnJ00sPwnRply1hTCrI+A7T6/Q1mm7ZH6urXR5E2T5q5GWawH0kakq66XAxUodRQ9ILkFTtBdj2a9hi1qV2AiMae00H86svye58OHNee6D7T4EBB01BEaZoteA/pS22fBiGjHl4B/T+2T98wmYKoopJePBSq6xsRpb+bHFLZEk3lSLRAP0QDLIoWridQA7+Kv3tEeQHdYaGHZ1iPDMatKSmEgaXR6CTXdIlVTCLVynZtUX42Cfqmw5oWForCavYHh6heyKXnsUVcSW1TEsG2CsGkRRKrMHuhUUfH3dc3YcwfS6Y57CVWJxMY2Ldl8Nvl/oj51Guw6HeA+EBKdlu0Z517zeY5LsO7lcr+9RQmAy2NCpzxP6/w4TOWfNI7VRuLawp0pNAorV2RjXnOF5AfF4Jvf3YWIFR4d3j+VSp6OufOgpN+xptmAbYSXlmsIDglcm2oWwX+xDIVT+JwI0+mFhWaiSEbVnYIlM4nbayIBhgzKBuz/W4zBfUuZ4tBJm6OEAJgN8AjZQ6eZkTt9Od+gBE9ssmIzfYso0KDeczSlmb3Hm4hxZvUSvWaIF57+wbcgntzfKf5LC5qMTaBZ9grwbpOUjW6mQ6+Fi8QbuQkGOGw7gchYSJpTztG75bnwCGKxPz+uIBTsXfsVFhzmUaG0QV7zUW09dzaolhdJbkE8YK9fliZW36kZhf0uixEPKfnY/IzWp0kUEsYdwlBBVyZGokWlEVQR3IS5zwKeJYxFbJ2q3rIFMikF5NDYHhBId+a/Rn8nrPrHTAUhkEU7sz/xM",
            "hash"=>$hash,
            "description"=> "Thanh toan cho don hang Merchant123556666 qua MoMo",
            "version"=> 2,
            "payType"=>3,
        ]
    );
       return $response;
    }

    public function momoCallBack(Request $request) {
        $user = new TokenDevice();
        $user->id_user = 16;
        $user->token='12333333333333333';

        // $publicKey ="-----BEGIN PUBLIC KEY-----MIICIjANBgkqhkiG9w0BAQEFAAOCAg8AMIICCgKCAgEAlMwuxob0ikOunHuE641vBb49GvZ7JzM1skx+wA6sZeZ59XIEFub6C+zBQs4nO8ERIn7LtbE9adcpCAPBobIQ7Jd46irVg+tUaPlICHJsI0unRLMX22vgDvDn7V+CidmxvKG3Yzw4A2hqBPhI9fklRsWtu083YqFnJ0v20eXCQhXU2Txzwo+5CybSs0gOW46d5h+uQBIiIJGVtvA09I2y88ErS9ZLp8ocuDkI6DvLyjlfmoBqcB8u8yPp6gZPyK5ILRep5IGHksipGPiU35ZyzSq9YA/U/cl207Rq/LP5CqHTJATfxn4DlwCBftSlwcuE09Q5mNopP3AWySA3xGwiM6H598Hg/I7e8DSyyQpDIDA09Hhw+JSsJU6JFbdxTM6OEsPU88RHBOgxHPOXFQ4vFgwNVkoX0NajXHVztvPnpqs5yVW7xXsNsmfRuU7Sc27xAfOvnQUfv+CgIGoWU2JS9FURRHpYCReHmwfzHnF9U3o3Xad33PnEaWqyjqIXeRWy4X/Qx9H3OLLUtgrOxlXj5577Bi1Tjvc/bSVJfufK6abemBAKzBoPxtwRwOvFxZtjzRQzfNsl4WvYarfgaBVgs2EiLDPMmcBLvnGD+HPNCuKGJbz2PY0VMh9NgeN6scUP3VEDcrz7fZlyfbNx8SgU26whB17LQBtfpzxNIA+Y6ocCAwEAAQ==-----END PUBLIC KEY-----";

        // $data = 'accessKey='.$request->accessKey
        // .'&'.
        // 'amount='.$request->amount
        // .'&'.
        // 'message='.$request->message
        // .'&'.
        // 'momoTransId='.$request->momoTransId
        // .'&'.
        // 'partnerCode='.$request->partnerCode
        // .'&'.
        // 'partnerRefId='.$request->partnerRefId
        // .'&'.
        // 'partnerTransId='.$request->partnerTransId
        // .'&'.
        // 'responseTime='.$request->responseTime
        // .'&'.
        // 'status='.$request->status
        // .'&'.
        // "storeId=".$request->storeId
        // .'&'.
        // "transType=momo_wallet";
        // $myPublicKey = new PublicKey($publicKey);
        // $signature =  EasyRSA::encrypt($data, $myPublicKey);
        // // echo $signature;
        // if($signature==$request->signature){
        //     echo 'true';
        // }else {
        //     echo 'false';
        // }
        return $request->all();
       
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
