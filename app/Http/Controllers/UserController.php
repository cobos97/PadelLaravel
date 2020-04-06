<?php

namespace App\Http\Controllers;

use App\Reserva;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index($id){

        date_default_timezone_set('Europe/Madrid');

        $user = User::findOrFail($id);
        $reservas = Reserva::where('fecha', '>', strtotime('9 am'))
            ->where('user_id', '=', $id)
            ->get();

        return view('user')
            ->with('user', $user)
            ->with('reservas', $reservas);
    }

    public function putEditar($id, Request $request){

        $usuario = User::findOrFail($id);

        $usuario->name = $request->input('nombre');
        $usuario->apellidos = $request->input('apellidos');
        $usuario->edad = $request->input('edad');

        $usuario->save();

        flash('Información editada con exito')->success();

        return redirect('/user/' . $id);
    }

}
