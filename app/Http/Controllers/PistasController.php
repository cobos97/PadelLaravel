<?php

namespace App\Http\Controllers;

use App\Pista;
use DB;
use Illuminate\Http\Request;

class PistasController extends Controller
{
    public function index()
    {
        $pistas = Pista::all();

        return view('pistas.pistas')
            ->with('pistas', $pistas);
    }

    public function getPista($id)
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
                $data = DB::table('pistas')
                    ->where('lugar', 'like', '%' . $query . '%')->get();
            } else {
                $data = DB::table('pistas')->get();
            }
            $total_row = $data->count();
            if ($total_row > 0) {
                $output = '';
                foreach ($data as $row) {
                    $output .= "<div class=\"col-md-5 col-xl-3 text-center m-3\">
                                <img src=\"" . $row->foto . "\" style=\"height:200px\"/>
                                <h4 style=\"min-height:45px;margin:5px 0 10px 0\">" . $row->lugar . "</h4>
                                <a href=\"/pista/" . $row->id . "\" class=\"btn btn-primary\">Ver</a>
                                <a href=\"/mensajes/" . $row->id . "\" class=\"btn btn-success\">Chat</a>
                                <a href=\"/reservas/" . $row->id . "\" class=\"btn btn-warning\">Reservas</a>
                                </div>
                                ";
                }
            } else {
                $output = '<div class="alert alert-danger">No se encontraron pistas</div>';
            }
            //$data = array('table_data' => $output, 'total_data' => $total_row);
            echo json_encode($output);
        }


    }

}
