<?php

namespace App\Http\Controllers;

use App\Pista;
use App\Reserva;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReservasController extends Controller
{
    public function index($id)
    {
        $pista = Pista::findOrFail($id);

        date_default_timezone_set('Europe/Madrid');
        $fecha = strtotime('5 pm');

        $fechas = Reserva::where('fecha', '>', strtotime('9 am'))
            ->where('pista_id', '=', $id)
            ->pluck('fecha')->toArray();

        //echo date('H:i/d/m/Y', $tarde);

        /*
        echo time();

        echo "<br><br><br>";

        echo "Fecha actual: " . date('H:i/d/m/Y', time());

        echo "<br><br><br>";

        echo "Fecha futura: " . date('H:i/d/m/Y', time()+$dia*4);*/


        /*
                foreach ($fechas as $f){
                    echo date('H:i/d/m/Y', $f) . "<br>";
                }*/


        return view('reservas')
            ->with('pista', $pista)
            ->with('fecha', $fecha)
            ->with('fechas', $fechas);

    }

    public function reservar($id, Request $request)
    {
        date_default_timezone_set('Europe/Madrid');

        $reserva = Reserva::where('fecha', '>', $request->input('fecha') - 36000)
            ->where('fecha', '<', $request->input('fecha') + 36000)
            ->where('user_id', '=', Auth()->user()->id)
            ->get();

        if (count($reserva) > 0) {
            flash("No puedes reservar mas de una pista en un mismo día. Comprueba tus reservas en mi cuenta.")->error();
        } else {
            $reserva = new Reserva();
            $reserva->user_id = Auth()->user()->id;
            $reserva->pista_id = $id;
            $reserva->fecha = $request->input('fecha');
            $reserva->save();

            $mail = $reserva->user->email;

            Mail::send('mail.reservado', ['reserva' => $reserva, 'mail' => $mail], function ($message) use ($mail) {
                $message->from('cobosmdc@gmail.com', 'PadelSubbetica');
                $message->to($mail)->subject('Reserva de pista');
            });

            flash('Pista reservada con exito. Podrás anular tu reserva desde "mi cuenta" hasta una hora antes.')->success();
        }

        return redirect(route('reservas', $id));

    }

    public function getReservas()
    {

        date_default_timezone_set('Europe/Madrid');

        $reservas = Reserva::where('fecha', '>', strtotime('9 am'))->get();
        $pistas = Pista::all();

        return view('admin.reservas')
            ->with('reservas', $reservas)
            ->with('pistas', $pistas);

    }

    public function deleteReserva($id)
    {
        $reserva = Reserva::findOrFail($id);
        $mail = $reserva->user->email;
        $reserva->delete();

        Mail::send('mail.cancelado', ['reserva' => $reserva, 'mail' => $mail], function ($message) use ($mail) {
            $message->from('cobosmdc@gmail.com', 'PadelSubbetica');
            $message->to($mail)->subject('Cancelación de pista, por administrador');
        });

        flash('La reserva se ha cancelado correctamente')->success();

        return redirect(route('reservasAdmin'));
    }

    public function deleteReservaUser($id)
    {
        $reserva = Reserva::findOrFail($id);
        $user_id = $reserva->user_id;
        $mail = $reserva->user->email;
        $reserva->delete();

        Mail::send('mail.cancelado', ['reserva' => $reserva, 'mail' => $mail], function ($message) use ($mail) {
            $message->from('cobosmdc@gmail.com', 'PadelSubbetica');
            $message->to($mail)->subject('Cancelación de pista');
        });

        flash('La reserva se ha cancelado correctamente')->success();

        return redirect(url('/user/' . $user_id));
    }

    public function filtroReservas(Request $request)
    {
        $arrayPistas = Pista::all();

        $users = User::where('name', $request->input('nombre'))
            ->orWhere('name', 'like', '%' . $request->input('nombre') . '%')->get();

        $reservas = Reserva::where('user_id', 0)->get();

        if ($request->input('pista') != null) {
            foreach ($users as $user) {
                $aux = Reserva::where('user_id', $user->id)->where('pista_id', $request->input('pista') * 1)->where('fecha', '>', strtotime('9 am'))->get();
                $reservas = $reservas->merge($aux);
            }
        } else {
            foreach ($users as $user) {
                $aux = Reserva::where('user_id', $user->id)->where('fecha', '>', strtotime('9 am'))->get();
                $reservas = $reservas->merge($aux);
            }
        }


        return view('admin.reservas')
            ->with('reservas', $reservas)
            ->with('pistas', $arrayPistas);
    }

}
