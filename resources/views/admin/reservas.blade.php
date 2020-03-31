@extends('layouts.app')

@section('content')

    <a href="{{route('admin')}}" class="enlace">Volver</a>

    <h1>Control de reservas</h1>

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
                    <option value="{{$pista->id}}">{{$pista->lugar}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" name="filtrar" value="usuario" class="btn btn-success mb-2">Filtrar</button>
    </form>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Usuario</th>
            <th scope="col">Pista</th>
            <th scope="col">Fecha</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @if(count($reservas)==0)
            <div class="alert alert-danger">No hay reservas futuras guardados en el sistema</div>
        @endif
        @foreach($reservas as $reserva)
            <tr>
                <th scope="row">{{$reserva->user->name}}</th>
                <td>{{$reserva->pista->lugar}}</td>
                <td>{{date('H:i d/m/Y', $reserva->fecha)}}</td>
                <td>
                    <form action="{{url('/deleteReserva/' . $reserva->id )}}" method="POST"
                          style="display:inline"> {{ method_field('DELETE') }} @csrf
                        <button type="submit" class="btn btn-danger" style="display:inline">Cancelar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection