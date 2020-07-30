@extends('layouts.master')

@section('content')
    <div class="row">
              <div class="col-md-12">
              @include('components.alerts.all')
                <div class="x_panel">
                <div class="x_title">
                    <h2>Usuarios<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                   <li>
                        <a href="{{ route('usuarios.create') }}"><button class="btn btn-sm btn-success" type="button"><i class="fa fa-user"></i> Agregar</button></a>
                   </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12 text-center">

                      </div>

                      <div class="clearfix"></div>


                      @forelse($users as $item)

                      <div class="col-md-4 col-sm-4 col-xs-12 profile_details">
                        <div class="well profile_view">
                          <div class="col-sm-12">
                            <h4 class="brief"><i></i> @if(empty($item->municipio)) {{strtoupper($item->jurisdiccion) }} @else {{ strtoupper($item->municipio) }}  @endif </h4>
                            <div class="left col-xs-7">
                              <h2>{{ $item->nombre}}</h2>
                              <p><strong>Rol: </strong> {{$item->rol}} </p>

                            </div>
                            <div class="right col-xs-5 text-center">
                              <img src="{{  $item->imagen != null ? route('image_profile',$item->imagen) : asset('images/master/avatars/0.png') }}" alt="" class="img-circle img-responsive">
                            </div>
                          </div>
                          <div class="col-xs-12 bottom text-center">

                            <div class="col-xs-12 col-sm-12 emphasis">
                            <a href="{{ route('usuarios.edit',$item->id)}}"><button type="button" class="btn btn-warning btn-xs">  <i class="fa fa-edit"></i> Editar </button></a>
                              <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-confirm-delete-{{$item->id}}">
                                <i class="fa fa-trash-o"> </i> Eliminar
                              </button>

                            </div>
                          </div>
                        </div>
                      </div>
                      @include('components.alerts.confirm',['ruta'=>route('usuarios.destroy',$item->id),'id'=>$item->id])
                    @empty

                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class=" profile-responsive ">
                            <div class="dropdown-menu-header">
                                <div class="dropdown-menu-header-inner ">
                                    <div class="menu-header-content">
                                        <div class="avatar-icon-wrapper mr-2 avatar-icon-xl">
                                            <img  src="{{ asset('images/empty/users_empty.png') }}" alt="" >
                                        </div>
                                        <div>
                                            <h1 class="text-search-results">No se encontraron resultados.</h1>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforelse
                    </div>
                  </div>
                </div>
              </div>
            </div>
@endsection
