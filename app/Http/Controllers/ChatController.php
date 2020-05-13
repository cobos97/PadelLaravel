<?php

namespace App\Http\Controllers;

use App\Chat;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function indexCliente()
    {

        $chats = Chat::where('user_id', '=', Auth()->user()->id)->orderBy('created_at', 'desc')->get();

        return view('chat.cliente')->with('chats', $chats);

    }

    public function enviarCliente(Request $request)
    {

        $chat = new Chat();
        $chat->contenido = $request->input('contenido');
        $chat->user_id = Auth()->user()->id;
        $chat->admin = 0;
        $chat->save();

        return redirect('chatadmin');

    }

    public function indexListaCliente()
    {

        $chats = Chat::all();

        foreach ($chats as $chat) {
            $ids[] = $chat->user_id;
        }
        if (isset($ids)){
            $ids = array_unique($ids);
        }else{
            $ids = [];
        }

        $users = User::whereIn('id', $ids)->get();
        $usuarios = User::orderBy('name')->get();

        return view('chat.lista')->with('users', $users)->with('usuarios', $usuarios);

    }

    public function getChat($id)
    {

        $chats = Chat::where('user_id', '=', $id)->orderBy('created_at', 'desc')->get();

        return view('chat.admin')->with('chats', $chats)->with('id', $id);

    }

    public function enviarAdmin($id, Request $request)
    {

        $chat = new Chat();
        $chat->contenido = $request->input('contenido');
        $chat->user_id = $id;
        $chat->admin = 1;
        $chat->save();

        return redirect(route('getChat', $id));

    }

    public function nuevoChat(Request $request)
    {

        $chats = Chat::where('user_id', '=', $request->input('usuario'))->orderBy('created_at', 'desc')->get();

        return view('chat.admin')->with('chats', $chats)->with('id', $request->input('usuario'));

    }

    public function deleteChat($id)
    {

        $chats = Chat::where('user_id', '=', $id)->get();

        foreach ($chats as $chat) {
            $chat->delete();
        }

        return redirect(route('listaChats'));

    }

}
