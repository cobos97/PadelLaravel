<?php

namespace App\Http\Controllers;

use App\Complejo;
use App\Pista;
use DB;
use Illuminate\Http\Request;

class PistasController extends Controller
{
    public function index()
    {
        $pistas = Complejo::all();

        return view('pistas.complejos')
            ->with('pistas', $pistas);
    }

    public function getPista($id)
    {
        $pista = Complejo::findOrFail($id);
        $listaPistas = Pista::where('complejo_id', '=', $id)->get();

        return view('pistas.complejo')
            ->with('complejo', $pista)
            ->with('listaPistas', $listaPistas);

    }

    public function getPistaConcreta($id)
    {

        $pista = Pista::findOrFail($id);

        return view('pistas.pista')
            ->with('pista', $pista);

    }

    function action(Request $request)
    {
        //para mas solo hay que ir juntando orWhere por detras
        if ($request->ajax()) {
            $query = $request->get('query');
            if ($query != '') {
                $data = Complejo::where('lugar', 'like', '%' . $query . '%')
                    ->orWhere('direccion', 'like', '%' . $query . '%')
                    ->get();
            } else {
                $data = Complejo::get();
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                $output = '';
                foreach ($data as $row) {
                    $output .= "<div class=\"col-md-5 col-xl-3 text-center m-3\">
                                <a href=\"/complejo/" . $row->id . "\"><img src=\"" . $row->foto . "\" style=\"width: 100%; height:200px\"/></a>
                                <h4 style=\"min-height:45px;margin:5px 0 10px 0\">" . $row->lugar . "<br>" . $row->direccion . "</h4>
                                </div>
                                ";
                    /*
                    $output .= "<div class=\"col-md-5 col-xl-3 text-center m-3\">
                                <img src=\"" . $row->foto . "\" style=\"height:200px\"/>
                                <h4 style=\"min-height:45px;margin:5px 0 10px 0\">" . $row->lugar . "<br>" . $row->direccion . " - " . $row->nPista . "</h4>
                                <a href=\"/pista/" . $row->id . "\" class=\"btn btn-primary\">Ver</a>
                                <a href=\"/mensajes/" . $row->id . "\" class=\"btn btn-success\">Chat</a>
                                <a href=\"/reservas/" . $row->id . "\" class=\"btn btn-warning\">Reservas</a>
                                </div>
                                ";
                    */
                }
            } else {
                $output = '<div class="alert alert-danger">No se encontraron pistas</div>';
            }
            //$data = array('table_data' => $output, 'total_data' => $total_row);
            echo json_encode($output);
        }


    }

}
