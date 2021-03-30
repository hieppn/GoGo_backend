<?php

namespace App\Http\Controllers;
use App\Http\Controllers;
// use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
class MessageController extends Controller
{
    function getAllMessageById($id){
    $messages = Message::where('id_send',$id)->orWhere('id_receive',$id)->get();
    foreach($messages as $message){
        $message->user;
    }
  $array = array("message" => $messages);
    return response()->json($array,200);
    }
    public function index()
    {
        return response()->json(Message::with('user')->get());
    }
}
