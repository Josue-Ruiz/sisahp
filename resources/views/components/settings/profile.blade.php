@extends('layouts.master')

@section('content')



    <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
              @include('components.alerts.all')
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tu información.</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                        @if(Session::get('identity')->imagen != null)
                            <img class="img-circle profile_img" src="{{route('image_profile', Session::get('identity')->imagen) }}" alt="">
                        @else
                            <img  class="img-circle profile_img" src="{{ asset('images/master/avatars/0.png') }}" alt="">
                        @endif

                        </div>
                      </div>
                      <h3>{{ Session::get('identity')->nombre }}</h3>

                      <ul class="list-unstyled user_data">

                        <li>
                          <i class="fa fa-briefcase user-profile-icon"></i> {{Session::get('identity')->rol}}
                        </li>

                        <li class="m-top-xs">
                          <i class="fa fa-enveloper user-profile-icon"></i> {{Session::get('identity')->correo}}
                        </li>
                      </ul>


                      <br />


                    </div>

                    <div class="col-md-9 col-sm-9 col-xs-12">



                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="@if(!$errors->has('actual') && !$errors->has('contrasenia') && !$errors->has('confirmar_contrasenia')) ) active  @endif"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Mis datos.</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Cambiar foto de perfil.</a>
                          </li>
                          <li role="presentation" class="@if($errors->has('actual') || $errors->has('contrasenia') || $errors->has('confirmar_contrasenia')) ) active  @endif"><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Cambiar Contraseña.</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade @if(!$errors->has('actual') && !$errors->has('contrasenia') && !$errors->has('confirmar_contrasenia')) ) active in @endif " id="tab_content1" aria-labelledby="home-tab">

                          <form class="form-horizontal form-label-left" method="POST" action="{{ route('update_datas') }}">
                            @csrf

                                <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Apellido Paterno: <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12 @error('apellido_p') parsley-error @enderror " class="form-control " name="apellido_p" value="{{ old('apellido_p') ? old('apellido_p') : Session::get('identity')->apellido_paterno }}" autocomplete="off">
                                            @error('apellido_p')
                                            <ul class="parsley-errors-list filled" id="parsley-id-5">
                                                <li class="parsley-required">{{$message}}</li>
                                            </ul>
                                            @enderror
                                        </div>
                                </div>
                                <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Apellido Materno: <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12 @error('apellido_m') parsley-error @enderror " class="form-control " name="apellido_m" value="{{ old('apellido_m') ? old('apellido_m') : Session::get('identity')->apellido_materno }}" autocomplete="off">
                                            @error('apellido_m')
                                            <ul class="parsley-errors-list filled" id="parsley-id-5">
                                                <li class="parsley-required">{{$message}}</li>
                                            </ul>
                                            @enderror

                                        </div>
                                </div>
                                <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre(s): <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12 @error('nombre') parsley-error @enderror " class="form-control " name="nombre" value="{{ old('nombre') ? old('nombre') : Session::get('identity')->nombre }}" autocomplete="off">
                                            @error('nombre')
                                            <ul class="parsley-errors-list filled" id="parsley-id-5">
                                                <li class="parsley-required">{{$message}}</li>
                                            </ul>
                                            @enderror

                                        </div>
                                </div>
                                <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Correo Electronico: <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12 @error('correo') parsley-error @enderror " class="form-control " name="correo" value="{{ old('correo') ? old('correo') : Session::get('identity')->correo }}" autocomplete="off">
                                            @error('correo')
                                            <ul class="parsley-errors-list filled" id="parsley-id-5">
                                                <li class="parsley-required">{{$message}}</li>
                                            </ul>
                                            @enderror

                                        </div>
                                </div>
                                <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Usuario: <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <input type="text" class="form-control col-md-7 col-xs-12 @error('usuario') parsley-error @enderror " class="form-control " name="usuario" value="{{ old('usuario') ? old('usuario') : Session::get('identity')->usuario }}" autocomplete="off">
                                            @error('usuario')
                                            <ul class="parsley-errors-list filled" id="parsley-id-5">
                                                <li class="parsley-required">{{$message}}</li>
                                            </ul>
                                            @enderror

                                        </div>
                                </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success">Actualizar información</button>
                            </div>
                            </div>

                        </form>

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">



                          <form action="{{ route('update_photo_settings') }}" method="POST" enctype="multipart/form-data" class="form-horizontal ">
                    @csrf

                    <div class="text-center">
                        <input type="file"  name="foto" id="foto" onchange="previewFile()">
                    </div>


                    <div id ="perfil" class="text-center"></div>
                    <div id="error-image">@error('foto')  {{$message}} @enderror</div>
                    <div class="ln_solid"></div>
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        <a href="{{route('home') }}" class="btn btn-dark"> <i class="fa fa-arrow-left"></i> Cancelar</a>
                        <button type="submit" class="btn btn-success" id="save" disabled>Guardar</button>
                    </div>

                    </form>
                          </div>
                          <div role="tabpanel" class="tab-pane fade @error('actual') active in @enderror @error('contrasenia') active in @enderror @error('confirmar_contrasenia') active in @enderror" id="tab_content3" aria-labelledby="profile-tab">

                          <form class="form-horizontal form-label-left" method="POST" action="{{ route('update_password_setting') }}">
                            @csrf

                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Actual: <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="password" class="form-control col-md-7 col-xs-12 @error('actual') parsley-error @enderror " class="form-control " name="actual" value="{{ old('actual') }}" autocomplete="off">
                                    @error('actual')
                                    <ul class="parsley-errors-list filled" id="parsley-id-5">
                                        <li class="parsley-required">{{$message}}</li>
                                    </ul>
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nueva: <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="password" class="form-control col-md-7 col-xs-12 @error('contrasenia') parsley-error @enderror " class="form-control " name="contrasenia" value="{{ old('contrasenia') }}" autocomplete="off">
                                    @error('contrasenia')
                                    <ul class="parsley-errors-list filled" id="parsley-id-5">
                                        <li class="parsley-required">{{$message}}</li>
                                    </ul>
                                    @enderror

                                </div>
                        </div>
                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Repetir contraseña: <span class="required">*</span>
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="password" class="form-control col-md-7 col-xs-12 @error('confirmar_contrasenia') parsley-error @enderror " class="form-control " name="confirmar_contrasenia" value="{{ old('confirmar_contrasenia') }}" autocomplete="off">
                                    @error('confirmar_contrasenia')
                                    <ul class="parsley-errors-list filled" id="parsley-id-5">
                                        <li class="parsley-required">{{$message}}</li>
                                    </ul>
                                    @enderror

                                </div>
                        </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-success">Actualizar Contraseña</button>
                            </div>
                            </div>

                    </form>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>


@endsection

@push('extra_js')
    <script type="text/javascript" src="{{ asset('js/upload_profile.js') }}"></script>
@endpush
