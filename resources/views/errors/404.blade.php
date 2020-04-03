@extends('layouts.app')

@section('content')
    <div class="error404 text-center">
        <p class="codigo">404</p>
        <p class="mensaje">Out! La url que has introducido no existe</p>
        <a class="btn volver" href="{{route('home')}}">Volver a inicio</a>
    </div>
@endsection