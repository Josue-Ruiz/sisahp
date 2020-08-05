<!DOCTYPE html>
<html lang="es-MX">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SISA | Sistema de saneamiento de agua.</title>
    <link rel="shortcut icon" href="{{ asset('images/gotita.png') }}" type="image/x-icon">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/nprogress.css') }}" rel="stylesheet">

    @stack('extra_css')

    <link href="{{ asset('css/custom.min.css') }}" rel="stylesheet">

  </head>

  <body class="nav-md ">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col ">
          <div class="left_col scroll-view">
            <div class="navbar nav_title " style="border: 0;">
              <a href="{{ route('home') }}" class="site_title"><i class="fa fa-tint"></i> <span> SISA</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
              @if(Session::get('identity')->imagen != null)
                  <img width="42" class="img-circle profile_img" src="{{route('image_profile', Session::get('identity')->imagen) }}" alt="">
              @else
                  <img width="42" class="img-circle profile_img" src="{{ asset('images/master/avatars/0.png') }}" alt="">
              @endif

              </div>
              <div class="profile_info">
                <span>{{ Session::get('identity')->rol }}</span>
                <h2>@if(empty(Session::get('identity')->nombre_jurisdiccion)) {{ strtoupper(Session::get('identity')->municipio) }} @else {{ strtoupper(Session::get('identity')->nombre_jurisdiccion) }}  @endif </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side  hidden-print main_menu">
              <div class="menu_section">
                <h3>{{ Session::get('identity')->rol }}</h3>

                @switch(Session::get('identity')->rol)
                    @case('Administrador')
                            @include('menus.administrator')
                        @break
                    @case('Jurisdiccional')
                            @include('menus.jurisdictions')
                        @break
                    @case('Municipal')
                            @include('menus.municipalitie')
                        @break
                    @case('Visor')
                            @include('menus.viewfinder')
                        @break
                    @case('DIPRIS')
                            @include('menus.dipris')
                        @break
                    @default
                @endswitch

              </div>


            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Mi información" href="{{ route('profile') }}">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Cambiar contraseña" href="{{ route('reset_password') }}">
                <span class="fa fa-key" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Cambiar foto de perfil" href="{{ route('photo_profile') }}">
                <span class="fa fa-camera" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Cerrar sesión" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                 @csrf
             </form>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    @if(Session::get('identity')->imagen != null)
                      <img  src="{{ route('image_profile', Session::get('identity')->imagen) }}" alt="">
                    @else
                      <img  src="{{ asset('images/master/avatars/0.png') }}" alt="">
                    @endif
                    {{ Session::get('identity')->nombre .' '. Session::get('identity')->apellido_paterno .' '. Session::get('identity')->apellido_materno}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="{{ route('profile') }}"> Mis información</a></li>
                    <li><a href="{{ route('reset_password') }}">Cambiar contraseña</a></li>
                    <li><a href="{{ route('photo_profile') }}">Cambiar foto de perfil</a></li>
                    <li><a onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Cerrar sesión</a></li>
                  </ul>
                </li>


              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">

            @yield('content')

        </div>
 <!-- footer content -->
 <footer>
          <div class="pull-right">
            SISA - Secretaria de Salud.
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>


    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/fastclick.js') }}"></script>
    <script src="{{ asset('js/nprogress.js') }}"></script>

    <script src="{{ asset('js/custom.min.js') }}"></script>
    @stack('extra_js')

  </body>
</html>
