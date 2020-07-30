@extends('layouts.master')

@push('extra_css')
    <link href="{{ asset('vendor/switchery/dist/switchery.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/pnotify/dist/pnotify.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet">
@endpush
@push('extra_js')

    <script src="{{ asset('vendor/switchery/dist/switchery.min.js') }}"></script>
    <script src="{{ asset('js/notify.js') }}"></script>
    @if(count($registers)>0)
        <script src="{{ asset('js/vibrio_results.js') }}"></script>
    @endif

@endpush



@section('content')



<div class="col-md-12 col-sm-12 col-xs-12">

    <input type="hidden" id="user" value="{{Session::get('identity')->id}}">
    @include('components.alerts.all')
            <div class="x_panel">
                <div class="x_title">
                        <h2>Captura de Análisis de Laboratorio | Vibrio Cholerae<small></small></h2>
                        <div class="clearfix"></div>

                </div>

                  <div class="x_content">

                @if(count($registers)>0)

                <table   id="datatable-responsive" cellspacing="0" width="100%" class="table table-striped table-bordered  nowrap">
		<thead class="header-table">
			<tr>

				<th>Localidad</th>
				<th>Domicilio</th>
				<th>Resultado</th>
                <th>Acciones</th>
			</tr>
		</thead>
		<tbody class="data-table">

        @foreach($registers as $key=>$item)
			<tr>

				<td>{{$item->localidad}}</td>
				<td>{{ substr($item->lugar,0,30) }} <input type="hidden" name="id" value="{{$item->id}}"></td>
				<td><input type="checkbox" class="js-switch"   name="resultado" /></td>

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
                  </div>
                </div>
              </div>



@endsection
