@extends('layouts.app')

@section('content')

    <a href="{{url('/pista/' . $pista->id)}}" class="enlace">Volver</a>

    <h1>{{$pista->complejo->lugar}} - {{$pista->complejo->direccion}} - Pista Nª {{$pista->nPista}}</h1>

    <table class="table table-bordered">
        <thead>
        <tr>
            <th></th>
            <th>5 pm</th>
            <th>7 pm</th>
            <th>9 pm</th>
        </tr>
        </thead>
        <tr>
            <td>Hoy</td>
            @for($j=0; $j < 3; $j++)
                <td>
                    @if(in_array($fecha, $fechas))
                        <div class="alert alert-danger">Ocupada</div>
                    @else
                        <form action="{{url('/reservas/' . $pista->id )}}" method="POST"
                              style="display:inline"> @csrf
                            <input type="text" name="fecha" id="fecha" value="{{$fecha}}" hidden>
                            <button type="submit" class="btn btn-success" style="display:inline">Reservar</button>
                        </form>
                    @endif
                </td>
                <div hidden>{{$fecha+=60*60*2}}</div>
            @endfor
        </tr>
        <div hidden>{{$fecha+=60*60*18}}</div>
        <tr>
            <td>Mañana</td>
            @for($j=0; $j < 3; $j++)
                <td>
                    @if(in_array($fecha, $fechas))
                        <div class="alert alert-danger">Ocupada</div>
                    @else
                        <form action="{{url('/reservas/' . $pista->id )}}" method="POST"
                              style="display:inline"> @csrf
                            <input type="text" name="fecha" id="fecha" value="{{$fecha}}" hidden>
                            <button type="submit" class="btn btn-success" style="display:inline">Reservar</button>
                        </form>
                    @endif
                </td>
                <div hidden>{{$fecha+=60*60*2}}</div>
            @endfor
        </tr>
        <div hidden>{{$fecha+=60*60*18}}</div>
        <tr>
            <td>Pasado</td>
            @for($j=0; $j < 3; $j++)
                <td>
                    {{--date('H:i d/m/Y', $fecha)--}}
                    @if(in_array($fecha, $fechas))
                        <div class="alert alert-danger">Ocupada</div>
                    @else
                        <form action="{{url('/reservas/' . $pista->id )}}" method="POST"
                              style="display:inline"> @csrf
                            <input type="text" name="fecha" id="fecha" value="{{$fecha}}" hidden>
                            <button type="submit" class="btn btn-success" style="display:inline">Reservar</button>
                        </form>
                    @endif
                </td>
                <div hidden>{{$fecha+=60*60*2}}</div>
            @endfor
        </tr>
    </table>

@endsection
