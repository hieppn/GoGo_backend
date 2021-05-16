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
            "customerNumber"=> "0918002200",
            "partnerRefId"=> "15",
            "appData"=> "v2/E9GGlHD7+0V1cOg3w6N5Wm9M9sE22/3ffVzCw9fZ7PLKbumk5Jdts7KE/cqT7KQR5wJJN9OaSZoyIz/XCAnYhC6XLpMduITRMSZzVeHHjeRyxlljNz7BfTWqCTKDBVho5bp/yHjyZjH9yL9fApRjoRX3//sqJamfh8HjBuub0i2G1tZ4WVsBzgnMhGJthyrt+qXV5iJNse1D9znnRKxFXOz6iUtjjM+mJd39VXDFqMHB/aL8W7M8N4buIa1sdCTDSkHeIPV6d7nrwJh266uJourB4TgiKy3mjg3hsu0zGoz2PnORwTyZA7Dir9eibZap04DjsdBylVPXjJ360N2LP5BVhtb/tQH0RqAt59kOGKQktkbrgPcCNbT8M9CKKohSmQypmk2bngr2zVcPTwBdqGrCT+tQh15IvT9a+nFFOKnQ26CWQatqMrYb3zt1HJ0pUq0yWdkwvO2s8qsImnI/wEzzcnpynlLlRVT5iP0Fd192V5OINc1EotNk004WepRIKqLjZQMezAIfX+etdAiSEpr68l4JkmXmhq8/x7uAMfcTK9Da8z6qtduhsVFwrFrE9+dl90yW7eb9wVfBSw7VXWiVdyAC4ISAGndZAuwUZdgtxaqZL86pqIODkokbH1osk+yTzJqUYB0aK/UPokyMua9cJcU8O2+HPpqUnVSI1BfomOz0R8H53swWzQSfXLdq/AjP6tJX9QftE+pP7o1A661Hpo7zovpr6TI0oUBxSB92dNKRREWLawIyprWD6I3UYjhdG0cBIcgBVGt7Nqq8nFjCrZkJmpGC7JhIQTfklXeyUY6JjmqpqMhq1z4qqRKE4YI/8gXsmXvinAlDQKdWP1XzKVWo3riwAN3DHLUDsSMbHOMHH16dueybXeYVpRdVrFHuKnoduEGsMGMUVTBClP66Xwgf2ZBhjK4iffFhbO274lTb77DpqgDX9ucP1xHTWS0n8IIf+ONY36yXDUSIEy6fM1o0xwre6dwYyFBoJK2MEUjp3gHViQ7AQ7ldBnCW8D6bxF//z4IJ0+ozpXmTYlD1PCEoCoiI4NI9WuSN9Xvb/7dmbyLrz/7spINy15i2kCwOtvIwM2iJVwJtYXc203AJ5RZQhIcW72ecqw7YCyH/wHVWiXQdq5bsAS3jt4hMQJIUkNhbayK9xZdaTOohWv79VU2psmy0cfM41fQOwCsu/AMSw8AmmlhV3b0s9mMWAZyiVZD6H1PENPaQr2H1QAqSlO2u/ZP2H83260MrED4L/sTynIGELufPAi6QUt6q4dcZsNkT3kXkYCIUoGnkXTYYxP/ufzCfU5XjV0/SLJzldlGcmX5rAFt5CHXbCVudXZSbI3SLZ2hFR2hC7EQpwgP/hKGCAflitN/E1fwTBrxUUhtNsnPHmazbB3Dr3mzVU6z6l9sA+s5+oxImDQX9JSdOg8XzJIi/MdQ++RkHyo4VIA+77F1Y3lSprLuu4t5z",
            "hash"=>$hash,
            "description"=> "Thanh toan cho don hang Merchant123556666 qua MoMo",
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
        'requestType='.$request->requestType
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
