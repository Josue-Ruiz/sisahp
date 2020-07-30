@push('extra_css')
  <link href="{{ asset('vendor/iCheck/skins/flat/green.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }} " rel="stylesheet">
@endpush

@push('extra_js')
  <script src="{{ asset('vendor/iCheck/icheck.min.js') }}"></script>
  <script src="{{ asset('vendor/moment/min/moment.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
  <script src="{{ asset('js/datetime.js') }}"></script>

@endpush


@extends('layouts.master')


@section('content')

<div class="x_panel">
    <div class="x_title">
      <h2>Nueva notificación de cloro residual. <small></small></h2>
     
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br>
      
      <form action="{{ route('cloro-residual.store') }}" method="POST" id="demo-form2"  class="form-horizontal form-label-left">
      @csrf
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Municipio <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="select2_single form-control" tabindex="-1" name="municipio" id="municipio">
                <option value="0" selected>--SELECCIONAR--</option>
                  @foreach($municipalities as $item)
                    <option value="{{$item->id}}" {{ old('municipio') == $item->id ? 'selected' : ''}}>{{$item->nombre}}</option>
                  @endforeach   
            </select>
            @error('municipio') 
            <ul class="parsley-errors-list filled" id="parsley-id-5">
                <li class="parsley-required">{{$message}}</li>
            </ul>
            @enderror
            
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Localidad <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="select2_single form-control" tabindex="-1" name="localidad" id="localidad" disabled="true">
                <option value="0" selected>--SELECCIONAR--</option>
                 
            </select>
            @error('localidad') 
            <ul class="parsley-errors-list filled" id="parsley-id-5">
                <li class="parsley-required">{{$message}}</li>
            </ul>
            @enderror
            
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Dirección <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="select2_single form-control" tabindex="-1" name="calle" id="calle" disabled="true">
                <option value="0" selected>--SELECCIONAR--</option>
                 
            </select>
            @error('calle') 
            <ul class="parsley-errors-list filled" id="parsley-id-5">
                <li class="parsley-required">{{$message}}</li>
            </ul>
            @enderror
            
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Fecha y hora <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
         
                   
              <div class='input-group date myDatepicker'>
                  <input type='text' class="form-control" name="fecha" id="fecha" readonly="read_only" value="{{ old('fecha') }}"/>
                  <span class="input-group-addon">
                     <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
              
              @error('fecha') 
              <ul class="parsley-errors-list filled" id="parsley-id-5">
                  <li class="parsley-required">{{$message}}</li>
              </ul>
              @enderror
            
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Valor <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" class="form-control col-md-7 col-xs-12 @error('valor') parsley-error @enderror " class="form-control " name="valor" value="{{ old('valor') }}" autocomplete="off">
              @error('valor') 
              <ul class="parsley-errors-list filled" id="parsley-id-5">
                  <li class="parsley-required">{{$message}}</li>
              </ul>
              @enderror
            
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Sin servicio <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            
            
            SI <input type="radio" class="flat" name="ss" id="genderM" value="1"  {{ old('ss') == 1 ? 'checked' : '' }} />
            NO  <input type="radio" class="flat" name="ss" id="genderF" value="0" {{ old('ss') == 0 ?  'checked' : '' }} />
            
              @error('ss') 
              <ul class="parsley-errors-list filled" id="parsley-id-5">
                  <li class="parsley-required">{{$message}}</li>
              </ul>
              @enderror
            
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Causas <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" class="form-control col-md-7 col-xs-12 @error('causas') parsley-error @enderror " class="form-control " name="causas" value="{{ old('causas') }}" autocomplete="off">
              @error('causas') 
              <ul class="parsley-errors-list filled" id="parsley-id-5">
                  <li class="parsley-required">{{$message}}</li>
              </ul>
              @enderror
            
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Acciones ejecutadas <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" class="form-control col-md-7 col-xs-12 @error('acciones') parsley-error @enderror " class="form-control " name="acciones" value="{{ old('acciones') }}" autocomplete="off">
              @error('acciones') 
              <ul class="parsley-errors-list filled" id="parsley-id-5">
                  <li class="parsley-required">{{$message}}</li>
              </ul>
              @enderror
            
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tomo muestras para análisis bactereológico <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            SI <input type="radio" class="flat" name="analisis" id="genderM" value="1" {{ old('analisis') == 1 ? 'checked' : '' }}  />
            NO  <input type="radio" class="flat" name="analisis" id="genderF" value="0" {{ old('analisis') == 0 ? 'checked' : '' }} />
            
              @error('analisis') 
              <ul class="parsley-errors-list filled" id="parsley-id-5">
                  <li class="parsley-required">{{$message}}</li>
              </ul>
              @enderror
            
          </div>
        </div>
           <div class="ln_solid"></div>
           <div class="form-group">
             <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">                    
               <a href="{{route('cloro-residual.index') }}" class="btn btn-dark"> <i class="fa fa-arrow-left"></i> Cancelar</a>
               <button type="submit"  class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
             </div>
           </div>

         </form>
    </div>
</div>

@endsection