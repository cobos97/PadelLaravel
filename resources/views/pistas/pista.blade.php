@extends('layouts.app')

@section('content')
    <h1>{{$pista->lugar}}</h1>
    <img src="{{asset($pista->foto)}}" style="height:200px"/>
    <h2>{{$pista->coorX}}</h2>
    <h2>{{$pista->coorY}}</h2>

    <h3>{{$pista->descripcion}}</h3>


@endsection