@extends('layouts.app')

@section('content')

    <a href="{{url('/complejo/' . $pista->complejo->id)}}" class="enlace">Volver</a>

    <h1>{{$pista->complejo->lugar}} - {{$pista->complejo->direccion}} - Pista Nª {{$pista->nPista}}
        <a href="{{ url('/reservas/' . $pista->id ) }}" class="btn btn-warning">Reservas
            <i class="fas fa-save"></i></a></h1>

    <div class="row" style="margin-top: 15px">
        <div class="col-md">
            <img src="{{asset($pista->foto)}}" style="width:100%; margin-bottom: 20px;"/>
        </div>
        <div class="col-md">
            <p>{{$pista->descripcion}}</p>
        </div>
    </div>

@endsection
