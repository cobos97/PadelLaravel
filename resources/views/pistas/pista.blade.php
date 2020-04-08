@extends('layouts.leaflet')

@section('content')

    <a href="{{route('pistas')}}" class="enlace">Volver</a>

    {{--Coordenadas--}}
    <div id="x" hidden>{{$pista->coorX}}</div>
    <div id="y" hidden>{{$pista->coorY}}</div>

    <h1>{{$pista->lugar}}, {{$pista->direccion}} - {{$pista->nPista}}</h1>
    <div class="row">
        <div class="col">
            <img src="{{asset($pista->foto)}}" style="height:350px"/>
        </div>
        <div class="col">
            <p>{{$pista->descripcion}}</p>
        </div>
    </div>
{{--
    <div style="height: 500px; background-color: salmon"></div>
    <div style="height: 500px; background-color: greenyellow"></div>
    <div style="height: 500px; background-color: deeppink"></div>
--}}

@endsection

@section('coor')

    <script>

        var x = document.getElementById('x').innerHTML;
        var y = document.getElementById('y').innerHTML;


        var mymap = L.map('mapid').setView([x, y], 16);

        var marker = L.marker([x, y]).addTo(mymap);

        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiY29ib3M5NyIsImEiOiJjazd4YmZ4MnkwYTd0M2ZvMmthNzl2djQ1In0.bTLRfWX9NAxtdxAlgkeZRg'
        }).addTo(mymap);

    </script>

@endsection