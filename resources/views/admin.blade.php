@extends('layouts.app')

@section('content')
    <h1>Zona de administración</h1>

    <a href="{{route('getContactas')}}" class="enlace">Listado de contactas</a><br>
    <a href="{{route('usuarios')}}" class="enlace">Control de usuarios</a><br>
    <a href="{{route('pistasAdmin')}}" class="enlace">Control de pistas</a><br>
    <a href="{{route('mensajesAdmin')}}" class="enlace">Control de mensajes de usuario</a><br>

@endsection