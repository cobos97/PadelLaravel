@extends('layouts.app')

@section('content')
    <a href="{{route('admin')}}" class="enlace">Volver</a>
    <h1>Mensajes enviados a través de la página "Contacta"</h1>

    @if(count($contactas)==0)
        <div class="alert alert-danger">No hay contactas guardados en el sistema</div>
    @endif
    @foreach($contactas as $contacta)
        <div class="card">
            <div class="card-header">{{$contacta->correo}}</div>
            <div class="card-body">{{$contacta->contenido}}</div>
            <div class="card-footer">
                <form action="{{url('/deleteContacta/' . $contacta->id )}}" method="POST"
                      style="display:inline"> {{ method_field('DELETE') }} @csrf
                    <button type="submit" class="btn btn-success" style="display:inline">Leido</button>
                </form>
            </div>
        </div>
    @endforeach

@endsection
