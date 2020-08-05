<ul class="nav side-menu">

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
          <li><a href="{{ route('exhortos-eficiencia-cloracion.index') }}">Reportes</a></li>
        </ul>
  </li>

</ul>
