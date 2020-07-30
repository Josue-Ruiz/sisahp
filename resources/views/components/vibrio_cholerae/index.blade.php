@extends('layouts.master')

@push('extra_css')
    <link href="{{ asset('vendor/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }} " rel="stylesheet">

    <link href="{{ asset('vendor/pnotify/dist/pnotify.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="col-md-12 col-sm-12 col-xs-12">
    @include('components.alerts.all')
            <div class="x_panel">
                  <div class="x_title">
                    <h2>Vibrio Cholerae<small></small></h2>

                    <div class="clearfix"></div>
                  </div>
                  <br>
                  <div class="title_right">


                        <div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">

                        <div class="input-group">
                        <form id="locati-form" method="GET" action="{{ route('vibrio.index') }}" role="search" autocomplete="off">
                        <select class="multiselect-dropdown form-control" name="municipio" onchange="event.preventDefault(); document.getElementById('locati-form').submit();">
                                <option value="0" selected>--SELECCIONAR--</option>
                            @foreach($municipalities as $item)
                                <option value="{{$item->id_municipio}}" {{ $municipio == $item->id_municipio ? 'selected' : '' }}>{{$item->nombre}}</option>
                            @endforeach
                        </select>
                    </form>
                        </div>
                        </div>
                </div>

                  <div class="x_content">


                  @if($municipio != 0)
                    @if(count($locations)>0)

                  <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Localidad</th>
                          <th>Fecha y Hora</th>
                          <th>Domicilio</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>

                        @foreach($locations as $key=>$item)
                            <tr>
                                <td>{{$item->nombre}} <input type="hidden" name="localidad" value="{{$item->id}}"></td>
                                <td>
                                    <div class='date myDatepicker'>
                                        <input type='text' class="form-control" name="fecha" id="fecha" readonly="read_only" />
                                    </div>
                                </td>
                                <td> <input type="text" name="domicilio" /></td>
                                <td>
                                <button class="btn btn-sm btn-success saved"  ><i class="fa fa-save"></i> Guardar</button>

                                </td>
                            </tr>

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

@if($municipio != 0)
    @if(count($locations)>0)

        @push('extra_js')
            <script src="{{ asset('vendor/moment/min/moment.min.js') }}"></script>
            <script src="{{ asset('vendor/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
            <script src="{{ asset('js/notify.js') }}"></script>
            <script type="text/javascript" src="{{ asset('js/vibrio.js') }}"></script>
        @endpush
    @endif
@endif
