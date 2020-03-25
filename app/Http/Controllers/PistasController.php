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
                    //$object = ['lugar' => $row->lugar, 'descripcion' => $row->descripcion, 'coorx' => $row->coorX, 'coory' => $row->coorY];
                    //$output[$row->id] = $object;
                    //$output .= '<tr><td>' . $row->lugar . '</td><td>' . $row->descripcion . '</td><td>' . $row->coorX . '</td><td>' . $row->coorY . '</td></tr>';
                    $output .= '<tr><td>' . $row->lugar . '<td>' . $row->descripcion . '<td>' . $row->coorX . '<td>' . $row->coorY;
                }
            } else {
                $output = '<><td align="center" colspan="4">No se encontraron pistas';
            }
            $data = array('table_data' => $output, 'total_data' => $total_row);
            //echo json_encode($output, JSON_HEX_QUOT | JSON_HEX_TAG);
            echo json_encode($output);

        }


    }

}
