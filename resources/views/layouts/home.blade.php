<!DOCTYPE HTML>
<html lang="es-MX">
    <head>
        <!--=============== basic  ===============-->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>SISA | Sistema de saneamiento de agua.</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!--=============== css  ===============-->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">


        <link type="text/css" rel="stylesheet" href="{{ asset('home/css/reset.css')}}">
        <link type="text/css" rel="stylesheet" href="{{ asset('home/css/plugins.css')}}">
        <link type="text/css" rel="stylesheet" href="{{ asset('home/css/style.css')}}">
        <link type="text/css" rel="stylesheet" href="{{ asset('home/css/color.css')}}">
        <link type="text/css" rel="stylesheet" href="{{ asset('home/css/myStyle.css')}}">

        <link href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

        @stack('extra_css')
        <!--=============== favicons ===============-->
        <link rel="shortcut icon" href="{{ asset('images/gotita.png')}}">

    </head>

    <body>

        <!--loader-->
        <div class="loader-wrap">
            <div class="pin"></div>
            <div class="pulse"></div>
        </div>
        <!--loader end-->

        <!-- Main  -->
        <div id="main">
            <!-- header-->
            <header class="main-header dark-header fs-header sticky">
                <div class="header-inner">
                    <div class="logo-holder">
                        <a href="{{  url('/')  }}"><img src="{{ asset('images/report/secretariasalud.png')}}" alt=""></a>
                    </div>
                    <div class="header-search vis-header-search">

                    <a class="button fs-map-btn" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> Cerrar sesión</a>

                    </div>

                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </header>

            @yield('contenido')

            <!--footer -->
            <footer class="main-footer dark-footer ">

                <div class="sub-footer fl-wrap">
                    <div class="container">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="copyright">&copy SISA - Secretaria de Salud.</div>
                            </div>
                            <br><br>

                        </div>
                    </div>
                </div>
            </footer>

            <!--footer end  -->

        </div>
        <!-- Main end -->
        <!--=============== scripts  ===============-->

        <script type="text/javascript" src="{{ asset('home/js/jquery.min.js')}}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('home/js/plugins.js')}}"></script>
        <script type="text/javascript" src="{{ asset('home/js/scripts.js')}}"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDgE24G2EcG7AfjoxMHV4NCXHf28t7uBCM"></script>
        <script type="text/javascript" src="{{ asset('home/js/map_infobox.js')}}"></script>
        <script type="text/javascript" src="{{ asset('home/js/markerclusterer.js')}}"></script>

        @stack('extra_js')
        <script type="text/javascript" src="{{ asset('home/js/mySlide.js')}}"></script>


    </body>
</html>
