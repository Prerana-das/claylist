<?php

namespace App\Http\Controllers;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function add_message(Request $request){
        $data = $request->all();
        return Message::create($data);
    }
}
