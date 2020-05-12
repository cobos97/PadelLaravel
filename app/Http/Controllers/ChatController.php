<?php

namespace App\Http\Controllers;

use App\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function indexCliente(){

        $chats = Chat::where('user_id', '=', Auth()->user()->id)->get();

        return view('chat.cliente')->with('chats', $chats);

    }
}
