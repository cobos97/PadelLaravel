@extends('layouts.leaflet')

@section('content')

    <a href="{{route('complejos')}}" class="enlace">Volver</a>

    {{--Coordenadas--}}
    <div id="x" hidden>{{$complejo->coorX}}</div>
    <div id="y" hidden>{{$complejo->coorY}}</div>

    <h1>{{$complejo->lugar}}, {{$complejo->direccion}}
        <a href="{{ url('/mensajes/' . $complejo->id ) }}" class="btn btn-success">Chat
            <i class="fas fa-comments"></i></a></h1>


    <p>{{$complejo->descripcion}}</p>




    {{--
    <a href="{{ url('/reservas/' . $pista->id ) }}" class="btn btn-warning">Reservas
        <i class="fas fa-save"></i></a>
--}}




    {{--
        <div style="height: 500px; background-color: salmon"></div>
        <div style="height: 500px; background-color: greenyellow"></div>
        <div style="height: 500px; background-color: deeppink"></div>
    --}}

@endsection

@section('content2')

    <h2>Listado de pistas</h2>

    @if(count($listaPistas)==0)
        <div class="alert alert-danger">No hay pistas asociadas a este complejo</div>
    @endif

    <div class="row">
        @foreach($listaPistas as $pista)

            <div class="col-md-5 col-xl-3 text-center m-3">
                <a href="{{ url('/pista/' . $pista->id)  }}"><img src="{{asset($pista->foto)}}"
                                                              style="width: 100%; height:200px"/></a>
                <h4>Pista Nª {{$pista->nPista}}</h4>
            </div> @endforeach</div>

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