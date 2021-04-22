<?php

namespace App\Http\Controllers;
use App\Http\Controllers;
// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
class MessageController extends Controller
{
    function getAllMessageByUserId($id){
    $messages = Message::where('id_send',$id)->orWhere('id_receive',$id)->get();
    foreach($messages as $message){
        $message->user;
    }
    $array = array("message" => $messages);
    return response()->json($array,200);
    }
    public function create(Request $request){
        $messages = new Message();
        $messages->id_send = $request->id_send;
        $messages->id_receive = $request->id_receive;
        $messages->message = $request->message;
        $messages->save();
        return response()->json($messages,200);
    }
    public function index()
    {
        return response()->json(Message::with('user')->get());
    }
    public function delete($id){
        $message = Message::find($id);
        if(is_null($message)){
            return response()->json(["message"=>"Record Promotion not found!"],404);
        }
        $message->delete();
        return response()->json(null,204);
    }
}
