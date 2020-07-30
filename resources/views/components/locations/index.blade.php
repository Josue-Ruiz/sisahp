@push('extra_css')  
    <link href="{{ asset('vendor/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
@endpush


@push('extra_js')  
    <script src="{{ asset('js/confirm.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>

@endpush

@extends('layouts.master')

@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">
    @include('components.alerts.all')
            <div class="x_panel">
                  <div class="x_title">
                    <h2>Localidades<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li>
                                <a href="{{ route('localidades.create') }}"><button class="btn btn-sm btn-success" type="button"><i class="fa fa-plus"></i> Agregar</button></a>
                        </li>
                     </ul>
                    <div class="clearfix"></div>
                  </div>
                  <br>
                  <div class="title_right">
                  
                 
                        <div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">
                      
                        <div class="input-group">
                        <form id="locati-form" method="GET" action="{{ route('localidades.index') }}" role="search" autocomplete="off">
                        <select class="multiselect-dropdown form-control" name="municipio" onchange="event.preventDefault(); document.getElementById('locati-form').submit();">        
                                <option value="0" selected>--SELECCIONAR--</option>  
                            @foreach($municipalities as $item)
                                <option value="{{$item->id}}" {{ $municipio == $item->id ? 'selected' : '' }}>{{$item->nombre}}</option>
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
                          <th>Folio</th>
                          <th>Nombre</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>

                        @foreach($locations as $key=>$item)
                            <tr>
                            
                                <td>{{$item->folio}}</td>
                                <td>{{$item->nombre}}</td>
                                <td>
                                <a href="{{ route('localidades.edit',$item->id) }}"><button class="btn btn-sm btn-warning" type="button"><i class="fa fa-edit"></i> Editar</button></a>
                                <button id="show-modal" class="btn btn-sm btn-danger"  data-id="{{$item->id}}"><i class="fa fa-trash-o"></i> Eliminar</button>
                                <a href="{{ route('map-loc', $item->id) }}"><button class="btn btn-sm btn-info" type="button"><i class="fa fa-map-marker"></i> Mapa</button></a>
                                <a href="{{ route('calles-localidad.index',['municipio'=>$item->id_municipio,'localidad' => $item->id] ) }}"><button class="btn btn-sm btn-dark" type="button"><i class="fa fa-bars"></i> Direcciones</button></a>
                                
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
    

<div class="modal fade bs-example-modal-sm" id="modal-confirm-delete-location" tabindex="-1" role="dialog" aria-hidden="true">
<form action="" method="POST" id="form-modal-delete">
    {{method_field('DELETE')}}
    @csrf
  <div class="modal-dialog ">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel2">Eliminar registro</h4>
        </div>
        <div class="modal-body">
            <p>¿Esta seguro que desea eliminar este registro?.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" id="delete">Eliminar</button>
        </div>
    </div>
  </div>
</form>
</div>
@endsection
