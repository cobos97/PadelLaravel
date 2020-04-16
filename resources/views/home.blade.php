@extends('layouts.app')

@section('carrusel')

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <a href="{{route('complejos')}}"><img class="imgcar1" style="width: 100%"
                                                   src="{{asset('imagenes/carrusel1.jpg')}}" alt="...">
                    <div class="carousel-caption">
                        <h5>Pistas</h5>
                        <p class="d-none d-md-block">Visita nuestro listado de pistas y reserva ya para jugar.</p>
                    </div>
                </a>
            </div>
            <div class="carousel-item">
                @guest
                    <a href="{{url('/login')}}"><img class="imgcar2" style="width: 100%"
                                                     src="{{asset('imagenes/carrusel2.jpg')}}"
                                                     alt="...">
                        <div class="carousel-caption">
                            <h5>Mi cuenta</h5>
                            <p class=" d-none d-md-block">Aquí puedes modificar tus datos y cancelar reservas. Pero
                                primero debes iniciar sesion.</p>
                        </div>
                    </a>
                @else
                    <a href="{{url('user/' . Auth::user()->id)}}"><img class="imgcar2" style="width: 100%"
                                                                       src="{{asset('imagenes/carrusel2.jpg')}}"
                                                                       alt="...">
                        <div class="carousel-caption">
                            <h5>Mi cuenta</h5>
                            <p class=" d-none d-md-block">Aquí puedes modificar tus datos y cancelar reservas.</p>
                        </div>
                    </a>
                @endguest
            </div>
            <div class="carousel-item">
                <a href="{{route('contacta')}}"><img class="imgcar3" style="width: 100%"
                                                     src="{{asset('imagenes/carrusel3.jpeg')}}" alt="...">
                    <div class="carousel-caption">
                        <h5>Contacto</h5>
                        <p class=" d-none d-md-block">Si tienes alguna duda puedes enviarnos un mensaje.</p>
                    </div>
                </a>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">Contacta con nosotros</div>

                    <div class="card-body">
                        Si tienes alguna duda que te podamos resolver pulsa <a href="{{route('contacta')}}"
                                                                               class="enlace">aqui</a>.
                    </div>
                </div>

                {{--
                <div style="height: 500px; background-color: salmon"></div>
                <div style="height: 500px; background-color: greenyellow"></div>
                <div style="height: 500px; background-color: deeppink"></div>
                --}}

                {{--
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>
                --}}
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            $('#menu').addClass('nav-no-scroll');
            $('#menu').attr('style', 'transition: all .65s ease !important;');
        });
    </script>

    <script>

        if (isMobile()) {
            $('.imgcar1').attr('src', "{{asset('imagenes/chica.jpg')}}");
            $('.imgcar2').attr('src', "{{asset('imagenes/bg_pelota.jpg')}}");
            $('.imgcar3').attr('src', "{{asset('imagenes/c_chico_3.jpg')}}");

        }

        function isMobile() {
            return (
                (navigator.userAgent.match(/Android/i)) ||
                (navigator.userAgent.match(/webOS/i)) ||
                (navigator.userAgent.match(/iPhone/i)) ||
                (navigator.userAgent.match(/iPod/i)) ||
                (navigator.userAgent.match(/iPad/i)) ||
                (navigator.userAgent.match(/BlackBerry/i))
            );
        }


        $(window).scroll(function () {
            if ($('#menu').offset().top > 120) {
                $('#menu').addClass('nav-scroll');
            } else {
                $('#menu').removeClass('nav-scroll');
            }
        })
    </script>

@endsection
