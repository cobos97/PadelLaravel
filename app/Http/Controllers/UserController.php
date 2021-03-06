<?php

namespace App\Http\Controllers;

use App\Reserva;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index($id)
    {

        if ($id == Auth::user()->id) {
            date_default_timezone_set('Europe/Madrid');

            $user = User::findOrFail($id);
            $reservas = Reserva::where('fecha', '>', strtotime('9 am'))
                ->where('user_id', '=', $id)
                ->get();

            return view('user')
                ->with('user', $user)
                ->with('reservas', $reservas);
        } else {
            return response(view('errors.404'), 404);
        }


    }

    public function putEditar($id, Request $request)
    {

        $usuario = User::findOrFail($id);

        $usuarios = User::all();
        foreach ($usuarios as $u) {
            $correos[] = $u->email;
        }

        if ($request->input('pass') != '') {
            $usuario->password = Hash::make($request->input('pass'));

            flash('Contraseña cambiada con exito')->success();
        } else {
            $usuario->name = $request->input('nombre');
            $usuario->apellidos = $request->input('apellidos');

            flash('Información editada con exito')->success();

            if (strcmp($usuario->email, $request->input('mail'))) {

                if (!in_array($request->input('mail'), $correos)) {
                    $usuario->email = $request->input('mail');
                    $usuario->email_verified_at = null;
                } else {
                    flash('Ese correo ya pertenece a otro usuario.')->error();
                }

            }

        }

        $usuario->save();

        if (Auth::user()->rol == 'admin') {
            return redirect('/usuarios');
        } else {
            return redirect('/user/' . $id);
        }


    }

}
