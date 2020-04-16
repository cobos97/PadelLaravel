@extends('layouts.app')

@section('content')
    {{--<h1>Zona de pistas</h1>--}}

    <input type="text" name="search" id="search" class="form-control" placeholder="Busca una pista por ciudad o dirección">

    {{--<h3>Listado de pistas</h3>--}}
    <div class="row" id="pistas">

    </div>


@endsection

@section('scripts')

    <script>

        $(document).ready(function () {

            fetch_pista_data();

            function fetch_pista_data(query = '') {

                $.get("{{route('complejos.action')}}", {query: query}, function (data) {
                    console.log(JSON.parse(data));
                    $('#pistas').html(JSON.parse(data));
                })
            }

            $(document).on('keyup', '#search', function () {
                var query = $(this).val();
                fetch_pista_data(query);
            });

        })

    </script>


@endsection