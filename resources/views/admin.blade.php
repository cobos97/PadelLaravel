@extends('layouts.app')

@section('content')
    <h1>Zona de administración</h1>

    <a href="{{route('getContactas')}}" class="enlace">Listado de contactas</a><br>
    <a href="{{route('usuarios')}}" class="enlace">Control de usuarios</a><br>
    <a href="{{route('complejosAdmin')}}" class="enlace">Control de complejos</a><br>
    <a href="{{route('mensajesAdmin')}}" class="enlace">Control de mensajes de usuario</a><br>
    <a href="{{route('reservasAdmin')}}" class="enlace">Control de reservas</a><br>

@endsection