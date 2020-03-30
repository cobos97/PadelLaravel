<?php

namespace App\Http\Controllers;

use App\Pista;
use App\Reserva;
use Illuminate\Http\Request;

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


        return view('reservas')
            ->with('pista', $pista)
            ->with('fecha', $fecha)
            ->with('fechas', $fechas);

    }

    public function reservar($id, Request $request)
    {

        $reserva = new Reserva();
        $reserva->user_id = Auth()->user()->id;
        $reserva->pista_id = $id;
        $reserva->fecha = $request->input('fecha');
        $reserva->save();

        flash('Pista reservada con exito')->success();

        $pista = Pista::findOrFail($id);
        date_default_timezone_set('Europe/Madrid');
        $fecha = strtotime('5 pm');
        $fechas = Reserva::where('fecha', '>', strtotime('9 am'))
            ->where('pista_id', '=', $id)
            ->pluck('fecha')->toArray();
        return view('reservas')
            ->with('pista', $pista)
            ->with('fecha', $fecha)
            ->with('fechas', $fechas);
    }

}
