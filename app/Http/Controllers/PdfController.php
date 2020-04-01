<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function imprimir(){
        $pdf = \PDF::ladView('pdf.prueba');
        return $pdf->download('prueba.pdf');
    }
}
