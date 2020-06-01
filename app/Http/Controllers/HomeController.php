<?php

namespace App\Http\Controllers;

use App\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $nChat = false;

        if (Auth::user()) {
            $mensajes = Chat::where('user_id', '=', Auth()->user()->id)->orderBy('created_at', 'desc')->get();

            if (count($mensajes) != 0) {
                if ($mensajes[0]->admin == 1) {
                    $nChat = true;
                }
            }
        }

        return view('home')
            ->with('nChat', $nChat);
    }
}
