@extends('layouts.app')

@section('content')
    <h1>Zona de pistas</h1>

    <input type="text" name="search" id="search" class="form-control" placeholder="Busca una pista">

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Coorx</th>
            <th>Coory</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    {{--
    QUITADO PARA EL TUTORIAL DE SEARCHBAR
    <h3>Listado de pistas</h3>
    <div class="row">
        @if(count($pistas)==0)
            <div class="alert alert-danger">No hay pistas guardadas en el sistema</div>
        @endif
        @foreach( $pistas as $pista)
            <div class="col-md-5 col-xl-3 text-center m-3">
                <img src="{{asset($pista->foto)}}" style="height:200px"/>
                <h4 style="min-height:45px;margin:5px 0 10px 0"> {{$pista->lugar}} </h4>
                <a href="{{ url('/pista/' . $pista->id ) }}" class="btn btn-primary">Ver</a>
                <a href="{{ url('/mensajes/' . $pista->id )}}" class="btn btn-success">Chat</a>
            </div> @endforeach</div>
            --}}

@endsection

@section('scripts')


    <script>

        $(document).ready(function () {

            fetch_pista_data();

            function fetch_pista_data(query = '') {

                {{--
                $.ajax({
                    uri:"{{ route('pistas.action') }}",
                    method:'GET',
                    data:{query:query},
                    dataType:'json',
                    success:function (data) {
                        //$('tbody').html(data.table_data);
                        //$('#total_records').text(data.total_data);
                        console.log(data);
                    }
                })--}}

                $.get("{{route('pistas.action')}}", {query: query}, function (data) {
                    console.log(data);
                     //data.forEach(object => console.log(object));
                    $('tbody').html(data);
                })

            }
            
            $(document).on('keyup', '#search', function () {
               var query = $(this).val();
               fetch_pista_data(query);
            });

        })

    </script>


@endsection