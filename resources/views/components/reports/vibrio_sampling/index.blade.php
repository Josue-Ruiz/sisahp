@extends('layouts.master')

@push('extra_css')
    <link href="{{ asset('vendor/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
@endpush
@push('extra_js')
<script src="{{ asset('vendor/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
@endpush
@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
    @include('components.alerts.all')
            <div class="x_panel">
                  <div class="x_title">
                    <h2>Reportes | Vibrio Cholerae<small></small></h2>

                    <div class="clearfix"></div>

                 </div>
                 <br>


                  <div class="x_content">
                  <div class="well" style="overflow: auto">
                      <div class="col-md-4">
                        SELECCIONAR INTERVALOS DE FECHAS
                        <form class="form-horizontal" method="GET" action="{{ route('vibrio-cholerae.create') }}" target="_blank">
                          <fieldset>
                            <div class="control-group">
                              <div class="controls">
                                <div class="input-prepend input-group">
                                  <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                  <input type="text" style="width: 200px" name="intervals-dates" id="reservation" class="form-control"  readonly="readonly"/>
                                </div>
                              </div>
                            </div>
                            <div class="form-horizontal">
                                <button class="btn btn-sm btn-success saved"  type="submit"><i class="fa fa-save"></i> Generar </button>
                            </div>
                          </fieldset>

                        </form>

                      </div>

                      </div>
                  </div>
            </div>
</div>

@endsection

