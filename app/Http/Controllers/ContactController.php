<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function getAllContacts()
    {
        return response()->json(User::where('id','!=',Auth::user()->id)->get(),200);
    }

    public function getConversation($id)
    {
        return response()->json(DB::select(DB::raw('SELECT * FROM `messages` WHERE `send_from` = '.Auth::user()->id.' AND `send_to` = '.$id.' OR `send_from` = '.$id.' AND `send_to` = '.Auth::user()->id)),200);
    }

    public function send(Request $request)
    {
        $message = new Message();
        $message->send_to = $request->contact_id;
        $message->send_from = Auth::user()->id;
        $message->content = $request->contentt;
        $message->save();
        broadcast(new MessageEvent($message));
        return response()->json($message,200);
    }
}
