

@extends('layouts.master')

@section('content')


<div class="col-md-12 col-sm-12 col-xs-12">
    @include('components.alerts.all')
            <div class="x_panel">
                  <div class="x_title">
                    <h2>Modificar Logotipos  | Reporte Exhortos<small></small></h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">


<div class="row">

  <div class="col-md-55">
    <div class="thumbnail">
      <div class="image view view-first">
        <img style="width: 100%; display: block;" src="{{ asset('images/report/secretariasalud.png') }}" alt="image" />
          <div class="mask">
            <p>Logotipo</p>
            <div class="tools tools-bottom">
              <a href="{{ route('exhortos-eficiencia-cloracion.edit',1) }}"><i class="fa fa-pencil"></i></a>

            </div>
          </div>
      </div>

    </div>
  </div>


  <div class="col-md-55">
    <div class="thumbnail">
      <div class="image view view-first">
        <img style="width: 100%; display: block;" src="{{ asset('images/report/secretariasaludchiapas.png') }}" alt="image" />
          <div class="mask">
            <p>Logotipo</p>
            <div class="tools tools-bottom">
              <a href="{{ route('exhortos-eficiencia-cloracion.edit',2) }}"><i class="fa fa-pencil"></i></a>

            </div>
          </div>
      </div>

    </div>
  </div>

</div>


                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                        <a  href="{{route('exhortos-eficiencia-cloracion.index') }}" class="btn btn-dark"> <i class="fa fa-arrow-left"></i> Cancelar</a>

                        </div>
                    </div>

        </div>
    </div>
</div>
@endsection
