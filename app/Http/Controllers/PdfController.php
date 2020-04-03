<?php

namespace App\Http\Controllers;

use App\Pista;
use App\Reserva;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function imprimir(Request $request){

        $pista = Pista::findOrFail($request->input('pista'));

        $reservas = Reserva::where('pista_id', '=', $request->input('pista'))
            ->where('fecha', '>', strtotime('9 am'))
            ->where('fecha', '<', strtotime('11 pm'))
            ->get();

        if (count($reservas)==0){
            flash('No hay reservas para hoy en esa pista')->error();
            return redirect(route('reservasAdmin'));
        }else{
            $pdf = \PDF::loadView('pdf.reservasdia', compact('reservas'));
            return $pdf->download($pista->lugar . '__' . date('d/m/Y', time()) . '.pdf');
        }


    }
}
