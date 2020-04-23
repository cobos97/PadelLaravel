@extends('layouts.app')

@section('content')

    @if(Auth()->user()->penalizacion > time())
        <div class="alert alert-danger">Tu usuario a sido penalizado por uno de los administradores, no tendrás acceso a
            los complejos hasta la siguiente fecha: {{date('H:i d/m/Y', Auth()->user()->penalizacion)}}.
            Si tienes alguna duda puedes contactar con los administradores <a href="{{route('contacta')}}">aquí</a>.
        </div>
    @else
        <input type="text" name="search" id="search" class="form-control"
               placeholder="Busca una pista por ciudad o dirección">

        <div class="row" id="pistas">

        </div>
    @endif

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