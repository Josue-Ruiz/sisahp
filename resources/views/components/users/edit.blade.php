@extends('layouts.master')

@section('head') @endsection

@section('content')

<div class="x_panel">
    <div class="x_title">
      <h2>Editar usuario <small></small></h2>

      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br>

      <form action="{{ route('usuarios.update',$item->id) }}" method="POST" id="demo-form2"  class="form-horizontal form-label-left">
      {{method_field('PATCH')}}
      @csrf

      <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Rol: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="select2_single form-control" tabindex="-1" name="rol" id="rol">
                    <option value="0" selected>--SELECCIONAR--</option>
                    @foreach($roles as $items)
                        @if(old('rol'))
                                @if(old('rol') == $items->id)
                                        <option value="{{$items->id}}" selected>{{$items->nombre}}</option>
                                @else
                                        <option value="{{$items->id}}" >{{$items->nombre}}</option>
                                @endif
                        @else
                                @if($item->id_rol == $items->id)
                                    <option value="{{$items->id}}" selected>{{$items->nombre}}</option>
                                @else
                                    <option value="{{$items->id}}" >{{$items->nombre}}</option>
                                @endif
                        @endif

                    @endforeach
                </select>
                @error('rol')
                <ul class="parsley-errors-list filled" id="parsley-id-5">
                    <li class="parsley-required">{{$message}}</li>
                </ul>
                @enderror

            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" id="lbldinamic">@if($item->id_municipio>0) Municipio: @else Jurisdicción: @endif <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12" id="divdinamic">
            <select class="select2_single form-control" tabindex="-1" name="{{ ($item->id_jurisdiccion > 0) ? 'jurisdiccion' : 'municipio' }}">

                    <option value="0" selected>--SELECCIONAR--</option>
                    @foreach($registers as $items)

                        @if($item->id_jurisdiccion > 0)
                            @if($item->id_jurisdiccion == $items->id)
                                <option value="{{$items->id}}" selected>{{$items->nombre}}</option>
                            @else
                                <option value="{{$items->id}}" >{{$items->nombre}}</option>
                            @endif
                        @else
                            @if($item->id_municipio == $items->id)
                                <option value="{{$items->id}}" selected>{{$items->nombre}}</option>
                            @else
                                <option value="{{$items->id}}" >{{$items->nombre}}</option>
                            @endif

                        @endif
                    @endforeach

            </select>
                @error('jurisdiccion')
                <ul class="parsley-errors-list filled" id="parsley-id-5">
                    <li class="parsley-required">{{$message}}</li>
                </ul>
                @enderror

            </div>
        </div>


        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre(s): <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control col-md-7 col-xs-12 @error('nombre') parsley-error @enderror " class="form-control " name="nombre" value="{{ old('nombre') ? old('nombre') : $item->nombre }}"  autocomplete="off">
                @error('nombre')
                <ul class="parsley-errors-list filled" id="parsley-id-5">
                    <li class="parsley-required">{{$message}}</li>
                </ul>
                @enderror

            </div>
        </div>



        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Apellido Paterno: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control col-md-7 col-xs-12 @error('apellido_p') parsley-error @enderror " class="form-control " name="apellido_p"  value="{{ old('apellido_p') ? old('apellido_p') : $item->apellido_paterno }}" autocomplete="off">
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
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control col-md-7 col-xs-12 @error('apellido_m') parsley-error @enderror " class="form-control " name="apellido_m" value="{{ old('apellido_m') ? old('apellido_m') : $item->apellido_materno }}" autocomplete="off">
                @error('apellido_m')
                <ul class="parsley-errors-list filled" id="parsley-id-5">
                    <li class="parsley-required">{{$message}}</li>
                </ul>
                @enderror

            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Correo Electronico: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control col-md-7 col-xs-12 @error('correo') parsley-error @enderror " class="form-control " name="correo" value="{{ old('correo') ? old('correo') : $item->correo }}" autocomplete="off">
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
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control col-md-7 col-xs-12 @error('usuario') parsley-error @enderror " class="form-control " name="usuario" value="{{ old('usuario') ? old('usuario') : $item->usuario }}" autocomplete="off">
                @error('usuario')
                <ul class="parsley-errors-list filled" id="parsley-id-5">
                    <li class="parsley-required">{{$message}}</li>
                </ul>
                @enderror

            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Contraseña: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="password" class="form-control col-md-7 col-xs-12 @error('contrasenia') parsley-error @enderror " class="form-control " name="contrasenia" value="{{ old('contrasenia') ? old('contrasenia') : $item->contrasenia }}" autocomplete="off">
                @error('contrasenia')
                <ul class="parsley-errors-list filled" id="parsley-id-5">
                    <li class="parsley-required">{{$message}}</li>
                </ul>
                @enderror

            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Confirmar Contraseña: <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="password" class="form-control col-md-7 col-xs-12 @error('confirmar_contrasenia') parsley-error @enderror " class="form-control " name="confirmar_contrasenia" value="{{ old('confirmar_contrasenia') ? old('confirmar_contrasenia') : $item->contrasenia  }}" autocomplete="off">
                @error('confirmar_contrasenia')
                <ul class="parsley-errors-list filled" id="parsley-id-5">
                    <li class="parsley-required">{{$message}}</li>
                </ul>
                @enderror

            </div>
        </div>
           <div class="ln_solid"></div>
           <div class="form-group">
             <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
               <a href="{{route('usuarios.index') }}" class="btn btn-dark"> <i class="fa fa-arrow-left"></i> Cancelar</a>
               <button type="submit"  class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
             </div>
           </div>
         </form>
    </div>
</div>

@endsection


@push('extra_js')
    <script type="text/javascript" src="{{ asset('js/users.js') }}"></script>
@endpush
