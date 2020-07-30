@extends('layouts.master')

@section('content')

<div class="col-md-12 col-sm-12 col-xs-12">
    @include('components.alerts.all')
            <div class="x_panel">
                  <div class="x_title">
                    <h2>Actualizar Contraseña<small></small></h2>

                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">


        <form method="POST" action="{{ route('update_password_setting') }}" class="form-horizontal form-label-left">
            @csrf

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Actual <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="password" class="form-control col-md-7 col-xs-12 @error('actual') is-invalid @enderror" name="actual" value="{{ old('actual')  }}" autocomplete="off">
                    @error('actual')
                    <ul class="parsley-errors-list filled" id="parsley-id-5">
                        <li class="parsley-required">{{$message}}</li>
                    </ul>
                    @enderror

                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nueva <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="password" class="form-control col-md-7 col-xs-12 @error('contrasenia') is-invalid @enderror" name="contrasenia" value="{{ old('contrasenia')  }}" autocomplete="off">
                    @error('contrasenia')
                    <ul class="parsley-errors-list filled" id="parsley-id-5">
                        <li class="parsley-required">{{$message}}</li>
                    </ul>
                    @enderror

                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Confrimar Contraseña <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="password" class="form-control col-md-7 col-xs-12 @error('confirmar_contrasenia') is-invalid @enderror" name="confirmar_contrasenia" value="{{ old('confirmar_contrasenia')  }}" autocomplete="off">
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
               <a href="{{route('home') }}" class="btn btn-dark"> <i class="fa fa-arrow-left"></i> Cancelar</a>
               <button class="btn btn-success">Actualizar Contraseña</button>
             </div>
           </div>


        </form>
</div>
</div>
</div>
@endsection
