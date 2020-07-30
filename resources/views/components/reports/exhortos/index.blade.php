@extends('layouts.master')

@push('extra_css')
    <link href="{{ asset('vendor/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }} " rel="stylesheet">

@endpush

@push('extra_js')
<script src="{{ asset('vendor/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

<script> $('#reservation').datetimepicker({
     viewMode: 'years',
                format: 'MM/YYYY'
    });</script>
@endpush

@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">
    @include('components.alerts.all')
            <div class="x_panel">
                  <div class="x_title">
                    <h2>Reportes | Exhortos <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                                <a href="{{ route('exhortos-eficiencia-cloracion.show','asunto') }}"><button class="btn btn-sm btn-success" type="button"><i class="fa fa-edit"></i> Modificar Asunto</button></a>
                        </li>
                        <li>
                                <a href="{{ route('exhortos-eficiencia-cloracion.show','logotipos') }}"><button class="btn btn-sm btn-success" type="button"><i class="fa fa-edit"></i> Modificar Logotipos</button></a>
                        </li>
                     </ul>
                    <div class="clearfix"></div>
                 </div>
                 <br>

                  <div class="x_content">

                  <div class="well" style="">
                  <form class="form-horizontal" method="GET" action="{{ route('exhortos-eficiencia-cloracion.create') }}" target="_blank">
                          <div class="col-md-4">
                            SELECCIONAR INTERVALOS DE FECHAS
                            <br> <br>
                            <fieldset>
                                <div class="control-group">
                                  <div class="controls">
                                    <div class="input-prepend input-group">
                                      <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                      <input type="text" style="width: 200px" name="intevals-dates" id="reservation" class="form-control"  />
                                    </div>
                                  </div>
                                </div>
                                </fieldset>
                           </div>

                        <div class="col-md-5">
                            SELECCIONAR JURISDICCIÓN
                            <br> <br>
                                <select  class="multiselect-dropdown form-control" name="jurisdicciones">
                                    @foreach($jurisdictions as $item)
                                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                                    @endforeach
                                </select>
                          </div>


                          <div class="col-md-3">
                          <div class="form-horizontal">
                              <br><br>
                                    <button class="btn btn-sm btn-success saved"  type="submit"><i class="fa fa-save"></i> Generar </button>
                                </div>
                            </div>

                          </form>
                          </div>

                  </div>
            </div>
</div>

@endsection
