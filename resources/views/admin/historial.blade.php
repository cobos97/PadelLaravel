@extends('layouts.app')

@section('content')

    <a href="{{route('admin')}}" class="enlace">Volver</a>

    <h1>Historial de reservas</h1>

    <h2>Filtra las reservas</h2>
    <form class="form" action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nombre" class="sr-only">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
        </div>
        <div class="form-group">
            <label for="pista" class="sr-only">Pista</label>
            <select class="form-control" id="pista" name="pista">
                <option value="">Seleccione una pista si lo desea</option>
                @foreach($pistas as $pista)
                    <option value="{{$pista->id}}">{{$pista->complejo->lugar . ', ' . $pista->complejo->direccion . '-' . $pista->nPista}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="de" class="sr-only">Desde</label>
            <input type="date" class="form-control" id="de" name="de">
        </div>
        <div class="form-group">
            <label for="hasta" class="sr-only">Hasta</label>
            <input type="date" class="form-control" id="hasta" name="hasta">
        </div>
        <button type="submit" name="filtrar" value="usuario" class="btn btn-success mb-2">Filtrar</button>
    </form>

    @if(isset($nombre))
        <a class="btn btn-danger" style="color: white"
           href="{{url('/historialPdf/' . $nombre . '/' . $pistaId . '/' . $de . '/' . $hasta)}}">Generar PDF con las
            reservas
            en pantalla</a>
    @else
        <a class="btn btn-danger" style="color: white"
           href="{{url('/historialPdf/_/_/_/_')}}">Generar PDF con las reservas
            en pantalla</a>
    @endif


    @if(count($reservas)==0)
        <div class="alert alert-danger">No hay reservas para esos filtros</div>
    @else
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Usuario</th>
                <th scope="col">Pista</th>
                <th scope="col">Fecha</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reservas as $reserva)
                <tr>
                    <th scope="row">{{$reserva->user->name}}</th>
                    <td>{{$reserva->pista->complejo->lugar . ', ' . $reserva->pista->complejo->direccion . '-' . $reserva->pista->nPista}}</td>
                    <td>{{date('H:i d/m/Y', $reserva->fecha)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    {{$reservas->links()}}

@endsection