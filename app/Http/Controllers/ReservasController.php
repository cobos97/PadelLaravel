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

        $reservas = Reserva::where('fecha', '>', strtotime('9 am'))->paginate(8);
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

        if (strcmp($request->input('pista'), 'null')) {

            if ($request->input('nombre') == null) {
                return redirect(url('/admin/reservas/_/' . $request->input('pista')));
            } else {
                return redirect(url('/admin/reservas/' . $request->input('nombre') . '/' . $request->input('pista')));
            }

        } else {

            return redirect(url('/admin/reservas/' . $request->input('nombre') . '/null'));

        }

    }

    public function filtroGet($nombre, $pista = null)
    {

        date_default_timezone_set('Europe/Madrid');

        $arrayPistas = Pista::all();

        if ($nombre == '_') {
            $users = User::all();
        } else {
            $users = User::where('name', $nombre)
                ->orWhere('name', 'like', '%' . $nombre . '%')->orderBy('created_at', 'desc')->get();
        }

        foreach ($users as $user) {
            $ids[] = $user->id;
        }

        if (!isset($ids)) {

            $reservas = Reserva::where('user_id', '=', 0)->orderBy('created_at', 'desc')->where('fecha', '>', strtotime('9 am'))->paginate(8);

            return view('admin.reservas')
                ->with('reservas', $reservas)
                ->with('pistas', $arrayPistas);
        }

        if ($pista != null) {

            $reservas = Reserva::whereIn('user_id', $ids)->where('pista_id', $pista * 1)->where('fecha', '>', strtotime('9 am'))->paginate(8);


        } else {

            $reservas = Reserva::whereIn('user_id', $ids)->where('fecha', '>', strtotime('9 am'))->paginate(8);

        }

        return view('admin.reservas')
            ->with('reservas', $reservas)
            ->with('pistas', $arrayPistas);

    }

    public function historialReservas()
    {

        date_default_timezone_set('Europe/Madrid');

        $reservas = Reserva::paginate(10);

        $arrayPistas = Pista::all();

        return view('admin.historial')
            ->with('reservas', $reservas)
            ->with('pistas', $arrayPistas);

    }

    public function postHistorial(Request $request)
    {

        date_default_timezone_set('Europe/Madrid');

        if ($request->input('nombre') != null) {
            $nombre = $request->input('nombre');
        } else {
            $nombre = '_';
        }

        if ($request->input('pista') != null) {
            $pista = $request->input('pista');
        } else {
            $pista = '_';
        }

        if ($request->input('de') != null) {
            $de = strtotime($request->input('de'));
        } else {
            $de = '_';
        }

        if ($request->input('hasta') != null) {
            $hasta = strtotime($request->input('hasta'));
        } else {
            $hasta = '_';
        }

        return redirect(url('/historial/' . $nombre . '/' . $pista . '/' . $de . '/' . $hasta));

    }

    public function filtroHistorialReservas($nombre, $pista, $de, $hasta)
    {

        date_default_timezone_set('Europe/Madrid');

        $arrayPistas = Pista::all();

        if ($nombre == '_') {
            $users = User::all();
        } else {
            $users = User::where('name', $nombre)
                ->orWhere('name', 'like', '%' . $nombre . '%')->orderBy('created_at', 'desc')->get();
        }

        foreach ($users as $user) {
            $ids[] = $user->id;
        }

        if ($pista != '_') {
            $pistas[] = $pista;
        } else {
            $pistasBruto = Pista::all();
            foreach ($pistasBruto as $p) {
                $pistas[] = $p->id;
            }
        }

        if ($de == '_') {
            $de = 1;
        }

        if ($hasta == '_') {
            $hasta = 1906279922;
        }

        $reservas = Reserva::whereIn('user_id', $ids)->whereIn('pista_id', $pistas)->where('fecha', '>', $de)->where('fecha', '<', ($hasta + 86400))->paginate(10);

        return view('admin.historial')
            ->with('reservas', $reservas)
            ->with('pistas', $arrayPistas)
            ->with('nombre', $nombre)
            ->with('pistaId', $pista)
            ->with('de', $de)
            ->with('hasta', $hasta);


    }

    public function generarPdfHistorial($nombre, $pista, $de, $hasta)
    {

        date_default_timezone_set('Europe/Madrid');

        if ($nombre == '_') {
            $users = User::all();
        } else {
            $users = User::where('name', $nombre)
                ->orWhere('name', 'like', '%' . $nombre . '%')->orderBy('created_at', 'desc')->get();
        }

        foreach ($users as $user) {
            $ids[] = $user->id;
        }

        if ($pista != '_') {
            $pistas[] = $pista;
        } else {
            $pistasBruto = Pista::all();
            foreach ($pistasBruto as $p) {
                $pistas[] = $p->id;
            }
        }

        if ($de == '_') {
            $de = 1;
        }

        if ($hasta == '_') {
            $hasta = 1906279922;
        }

        $reservas = Reserva::whereIn('user_id', $ids)->whereIn('pista_id', $pistas)->where('fecha', '>', $de)->where('fecha', '<', ($hasta + 86400))->get();

        if (count($reservas) == 0) {
            flash('No hay reservas con esos filtros')->error();
            return redirect(route('historial'));
        } else {
            $pdf = \PDF::loadView('pdf.historial', compact('reservas'));
            return $pdf->download('historialdereservas.pdf');
        }

    }


}
