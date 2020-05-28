@extends('layouts.app')

@section('content')
    <h1>Zona de administración</h1>

    <div class="row">
        <div class="col-md-6">
            <h2><a href="{{route('getContactas')}}" class="enlace">Listado de contactas</a></h2>
        </div>
        <div class="col-md-6">
            <h2><a href="{{route('usuarios')}}" class="enlace">Control de usuarios</a></h2>
        </div>
        <div class="col-md-6">
            <h2><a href="{{route('complejosAdmin')}}" class="enlace">Control de complejos</a></h2>
        </div>
        <div class="col-md-6">
            <h2><a href="{{route('mensajesAdmin')}}" class="enlace">Control de mensajes de usuario</a></h2>
        </div>
        <div class="col-md-6">
            <h2><a href="{{route('reservasAdmin')}}" class="enlace">Control de reservas futuras</a></h2>
        </div>
        <div class="col-md-6">
            <h2><a href="{{route('listaChats')}}" class="enlace">Chats</a></h2>
        </div>
    </div>

@endsection