@extends('layouts.master')

@push('extra_css')
    <link href="{{ asset('vendor/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
@endpush

@push('extra_js')
    <script src="{{ asset('vendor/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/modification_chlorine.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
@endpush

@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">
    @include('components.alerts.all')
            <div class="x_panel">
                  <div class="x_title">
                    <h2>Modificaciones | Vibrio Cholerae<small></small></h2>
                    <div class="clearfix"></div>
                 </div>
                 <br>
                  <div class="x_content">
                <div class="well" style="overflow: auto">
                    <form class="form-horizontal" method="GET" action="{{ route('modificacion-vibrio-cholerae.index') }}">
                          <div class="col-md-4">
                            SELECCIONAR INTERVALOS DE FECHAS
                            <br> <br>


                              <fieldset>
                                <div class="control-group">
                                  <div class="controls">
                                    <div class="input-prepend input-group">
                                      <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                      <input type="text" style="width: 200px" name="intevals-dates" id="reservation" class="form-control"  readonly="readonly"/>
                                    </div>

                                  </div>
                                </div>

                              </fieldset>
                              @error('intevals-dates')
                                    <ul class="parsley-errors-list filled" id="parsley-id-5">
                                        <li class="parsley-required">{{$message}}</li>
                                    </ul>
                              @enderror

                           </div>

                        <div class="col-md-3">
                            SELECCIONAR MUNICIPIO
                            <br> <br>
                                <select class="multiselect-dropdown form-control" name="municipio" id="municipio">
                                    <option value="0">--SELECCIONAR--</option>
                                    @foreach($municipalities as $item)
                                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                                    @endforeach
                                </select>
                                @error('municipio')
                                <ul class="parsley-errors-list filled" id="parsley-id-5">
                                    <li class="parsley-required">{{$message}}</li>
                                </ul>
                                @enderror
                        </div>
                        <div class="col-md-3">
                            SELECCIONAR LOCALIDAD
                            <br> <br>
                                <select class="multiselect-dropdown form-control" name="localidad" id="localidad" disabled>

                                </select>
                                @error('localidad')
                                <ul class="parsley-errors-list filled" id="parsley-id-5">
                                    <li class="parsley-required">{{$message}}</li>
                                </ul>
                                @enderror
                        </div>

                          <div class="col-md-2">
                          <div class="form-horizontal">
                              <br><br>
                                    <button class="btn btn-sm btn-success saved"  type="submit" disabled id="search"><i class="fa fa-search"></i> Consultar </button>
                                </div>
                            </div>

                          </form>
                    </div>

                    @isset($registers)
                    @if(count($registers)>0)

                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>

                          <th>Fecha</th>
                          <th>Tipo</th>
                          <th>Lugar</th>
                          <th>Resultado</th>
                          <th>Acciones</th>

                        </tr>
                      </thead>
                      <tbody>

                        @foreach($registers as $key=>$item)
                            <tr>


                                <td>{{$item->fecha}}</td>
                                <td>{{$item->tipo}}</td>
                                <td>{{$item->lugar}}</td>
                                <td>@switch($item->resultado) @case(1) PRESENCIA @break @case(0) AUSENCIA @break @default SIN RESULTADO @endswitch</td>
                                <td>
                                <button class="btn btn-sm btn-danger"  data-toggle="modal" data-target="#modal-confirm-delete-{{$item->id}}"><i class="fa fa-trash-o"></i> Eliminar</button>
                                </td>
                            </tr>
                            @include('components.alerts.confirm',['ruta'=>route('modificacion-vibrio-cholerae.destroy',$item->id),'id'=>$item->id])
                        @endforeach


                        </tbody>
                    </table>

                @else
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class=" profile-responsive ">
                            <div class="dropdown-menu-header">
                                <div class="dropdown-menu-header-inner ">
                                    <div class="menu-header-content">
                                        <div class="avatar-icon-wrapper mr-2 avatar-icon-xl">
                                            <img  src="{{ asset('images/empty/search_empty.png') }}" alt="" >
                                        </div>
                                        <div>
                                            <h1 class="text-search-results">No se encontraron resultados.</h1>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endif
                @endif

                </div>
        </div>
</div>

@endsection
