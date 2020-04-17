@extends('layouts.leaflet')

@section('content')

    <a href="{{route('complejosAdmin')}}" class="enlace">Volver</a>

    <div id="x" hidden>{{$complejo->coorX}}</div>
    <div id="y" hidden>{{$complejo->coorY}}</div>

    <h1>{{$complejo->lugar}}, {{$complejo->direccion}}<a href="{{url('/admin/editarcomplejo/' . $complejo->id)}}"
                                                         class="btn btn-success"
                                                         style="color: white">Modificar datos</a></h1>

    <p>{{$complejo->descripcion}}</p>

@endsection

@section('content2')

    <h2>Listado de pistas</h2>

    <a href="{{url('/admin/complejo/' . $complejo->id . '/nuevapista')}}" class="enlace">Añadir nueva pista</a>

    @if(count($pistas)==0)
        <div class="alert alert-danger">No hay pistas asociadas a este complejo</div>
    @endif

    <div class="row">
        @foreach($pistas as $pista)

            <div class="col-md-5 col-xl-3 text-center m-3">
                <img src="{{asset($pista->foto)}}" style="width: 100%; height:200px"/>
                <h4>Pista Nª {{$pista->nPista}}</h4>

                <a href="{{url('/admin/editarpista/' . $pista->id)}}" class="btn btn-success"
                   style="color: white">Modificar datos</a>

                <button id="cancelar" type="button" class="btn btn-danger" data-toggle="modal"
                        data-target="#delexampleModal" onclick="event.preventDefault();
                        document.getElementById('formDel').setAttribute('action', '{{url('/deletePista/' . $pista->id )}}');">
                    Eliminar
                </button>
            </div> @endforeach</div>

    <!-- Modal -->
    <div class="modal fade" id="delexampleModal" tabindex="-1" role="dialog" aria-labelledby="delexampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Estás seguro que quieres eliminar esta
                        pista?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Al borrar la pista se borrarán todas sus reservas también.<br>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <form id="formDel" action="{{url('/deletePista/' . $complejo->id )}}" method="POST"
                          style="display:inline"> {{ method_field('DELETE') }} @csrf
                        <button type="submit" class="btn btn-danger" style="display:inline">Borrar pista</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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