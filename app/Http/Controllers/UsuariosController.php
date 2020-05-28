<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserValidationFormRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UsuariosController extends Controller
{
    public function index()
    {

        date_default_timezone_set('Europe/Madrid');

        $usuarios = User::paginate(8);

        return view('usuarios')
            ->with('usuarios', $usuarios);
    }

    public function getFiltro(Request $request)
    {

        date_default_timezone_set('Europe/Madrid');

        /*
        $usuarios = User::where('email', $request->input('nombre'))
            ->orWhere('email', 'like', '%' . $request->input('nombre') . '%')->paginate(2);

        return view('usuarios')
            ->with('usuarios', $usuarios);
        */

        if ($request->input('nombre') == null){
            return redirect(url('/usuarios'));
        }else{
            return redirect(url('/usuarios/' . $request->input('nombre')));
        }

    }

    public function filtroGet($nombre=null){

        date_default_timezone_set('Europe/Madrid');

        $usuarios = User::where('email', $nombre)
            ->orWhere('email', 'like', '%' . $nombre . '%')->paginate(8);

        return view('usuarios')
            ->with('usuarios', $usuarios);

    }

    public function getEditar($id)
    {
        $usuario = User::findOrFail($id);

        return view('editar.usuario')
            ->with('usuario', $usuario);
    }

    public function putEditar(UserValidationFormRequest $request, $id)
    {

        $request->validated();

        $usuario = User::findOrFail($id);

        $usuarios = User::all();
        foreach ($usuarios as $u) {
            $correos[] = $u->email;
        }

        $usuario->name = $request->input('nombre');
        $usuario->apellidos = $request->input('apellidos');
        $usuario->rol = $request->input('rol');

        flash('Usuario editado con exito')->success();

        if (strcmp($usuario->email, $request->input('mail'))) {

            if (!in_array($request->input('mail'), $correos)) {
                $usuario->email = $request->input('mail');
                $usuario->email_verified_at = null;

            } else {
                flash('Ese correo ya pertenece a otro usuario.')->error();

                $usuario->save();
                return redirect('/editarUsuario/' . $usuario->id);
            }

        }

        $usuario->save();

        return redirect('/usuarios');

    }

    public function putPenalizar(Request $request, $id)
    {
        date_default_timezone_set('Europe/Madrid');

        $usuario = User::findOrFail($id);
        $usuario->penalizacion = time() + $request->input('dias') * 3600 * 24;

        $usuario->save();

        $mail = $usuario->email;

        Mail::send('mail.penalizado', ['user' => $usuario, 'mail' => $mail], function ($message) use ($mail) {
            $message->from('cobosmdc@gmail.com', 'PadelSubbetica');
            $message->to($mail)->subject('Aviso de penalización');
        });

        flash('El usuario a sido penalizado con exito')->success();

        return redirect('/usuarios');
    }

    public function putDespenalizar(Request $request, $id)
    {
        date_default_timezone_set('Europe/Madrid');

        $usuario = User::findOrFail($id);
        $usuario->penalizacion = '1';

        $usuario->save();

        flash('El usuario vuelve a estar activo')->success();

        return redirect('/usuarios');
    }

    public function deleteUsuario($id)
    {

        $usuario = User::findOrFail($id);
        $usuario->delete();

        flash('Usuario borrado con exito')->error();

        return redirect('/usuarios');

    }
}
