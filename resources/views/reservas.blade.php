@extends('layouts.app')

@section('content')

    <a href="{{route('pistas')}}" class="enlace">Volver</a>

    <table>
        @for($i=0; $i < 10; $i++)
            <tr>
                @for($j=0; $j < 10; $j++)
                    <td>
                        celda
                    </td>
                @endfor
            </tr>
        @endfor
    </table>

@endsection
