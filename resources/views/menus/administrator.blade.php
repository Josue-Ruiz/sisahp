<ul class="nav side-menu">


  <li><a>Accesos<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('roles.index') }}">Roles</a></li>
          <li><a href="{{ route('usuarios.index') }}">Usuarios</a></li>
        </ul>
  </li>
  <li><a>Población<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('municipios.index') }}">Municipios</a></li>
          <li><a href="{{ route('jurisdicciones.index') }}">Jurisdicciones</a></li>
          <li><a href="{{ route('localidades.index') }}">Localidades</a></li>
        </ul>
  </li>
  <li><a>Calendario Epid.<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('calendario.index') }}">Semanas</a></li>
        </ul>
  </li>
  <li><a>Reportes<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('determinacion-de-cloro.index') }}">Determinación de Cloro</a></li>
          <li><a href="{{ route('muestra-bactereologica.index') }}">Muestra Bactereologica</a></li>
          <li><a href="{{ route('mensual-municipal.index') }}">Mensual Municipal</a></li>
          <li><a href="{{ route('semanal-jurisdiccional.index') }}">Concentrado semanal</a></li>
          <li><a href="{{ route('semana-epidemiologica.index')}}">Semana Epidemiológica</a></li>
        </ul>
  </li>


  <li><a>Sem. Epid.<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('cloro-residual.index') }}">Capturar</a></li>
          <li><a href="{{ route('determinacion-de-cloro.create') }}">R. de Laboratorio</a></li>
        </ul>
  </li>
  <li><a>Vibrio Cholerae<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('vibrio.index') }}">Capturar</a></li>
          <li><a href="{{ route('vibrio.create') }}">R. de Laboratorio</a></li>
          <li><a href="{{ route('vibrio-cholerae.index') }}">Reportes</a></li>

        </ul>
  </li>

  <li><a>Exhortos<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          <li><a href="{{ route('exhortos.index') }}">Capturar</a></li>
          <li><a href="{{ route('exhortos-eficiencia-cloracion.index') }}">Reportes</a></li>
        </ul>
  </li>
  <li><a>Modificaciones<span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
            <li><a href="{{ route('modificacion-cloro-residual.index') }}">Sem. Epidemiologica</a></li>
            <li><a href="{{ route('modificacion-vibrio-cholerae.index') }}">Vibrio Cholerae</a></li>
            <li><a href="{{ route('modificacion-exhortos.index') }}">Exhortos</a></li>
        </ul>
  </li>

  </ul>

