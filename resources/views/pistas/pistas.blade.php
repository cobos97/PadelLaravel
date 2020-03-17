@extends('layouts.app')

@section('content')
    <h1>Zona de pistas</h1>

            <h3>Listado de pistas</h3>
            <div class="row">
                @if(count($pistas)==0)
                    <div class="alert alert-danger">No hay pistas guardadas en el sistema</div>
                @endif
                @foreach( $pistas as $pista)
                    <div class="col-md-5 col-xl-3 text-center m-3">
                        <img src="{{asset($pista->foto)}}" style="height:200px"/>
                        <h4 style="min-height:45px;margin:5px 0 10px 0"> {{$pista->lugar}} </h4>
                        <a href="{{ url('/pista/' . $pista->id ) }}" class="btn btn-primary">Ver</a>
                        {{--
                        <a href="{{ url('/editarPista/' . $pista->id ) }}" class="btn btn-success">Editar</a>
                        <form action="{{url('/deletePista/' . $pista->id )}}" method="POST"
                              style="display:inline"> {{ method_field('DELETE') }} @csrf
                            <button type="submit" class="btn btn-danger" style="display:inline">Eliminar</button>
                        </form>
                        --}}
                    </div> @endforeach</div>

@endsection