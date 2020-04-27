@extends('layouts.app')

@section('content')

    <div hidden>{{date_default_timezone_set('Europe/Madrid')}}</div>

    <div class="alert alert-danger">Tu usuario a sido penalizado por uno de los administradores, no tendrás acceso a
        los complejos hasta la siguiente fecha: {{date('H:i d/m/Y', Auth()->user()->penalizacion)}}.
        Si tienes alguna duda puedes contactar con los administradores <a href="{{route('contacta')}}">aquí</a>.
    </div>
@endsection