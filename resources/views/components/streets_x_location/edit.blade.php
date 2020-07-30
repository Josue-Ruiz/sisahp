@extends('layouts.master')


@push('extra_js')
  <script type="text/javascript" src="{{ asset('js/locationsmap.js') }}"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMq0QkkYNBIKLzPVp0PDASJkbe-cBaJjM&callback=initMapEdit"></script>
@endpush

@section('content')

<div class="x_panel">
    <div class="x_title">
      <h2>Editar Dirección <small></small></h2>

      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br>

      <form action="{{ route('calles-localidad.update',$item->id) }}" method="POST" id="demo-form2"  class="form-horizontal form-label-left">
      {{ method_field('PATCH') }}
      @csrf
        <div class="form-group">
        <input type="hidden" name="localidad" value="{{ $item->id_localidad }}" autocomplete="off">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" class="form-control col-md-7 col-xs-12 @error('nombre') parsley-error @enderror " name="nombre" value="{{ old('nombre') ? old('nombre') : $item->nombre }}" autocomplete="off">
              @error('nombre')
              <ul class="parsley-errors-list filled" id="parsley-id-5">
                  <li class="parsley-required">{{$message}}</li>
              </ul>
              @enderror

          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Latitud <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" class="form-control col-md-7 col-xs-12 @error('latitud') parsley-error @enderror " class="form-control " name="latitud" id="latitud" value="{{ old('latitud') ? old('latitud') : $item->latitud }}" autocomplete="off" >
              @error('latitud')
              <ul class="parsley-errors-list filled" id="parsley-id-5">
                  <li class="parsley-required">{{$message}}</li>
              </ul>
              @enderror

          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Longitud <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" class="form-control col-md-7 col-xs-12 @error('longitud') parsley-error @enderror " class="form-control " name="longitud" id="longitud" value="{{ old('longitud') ? old('longitud') : $item->longitud }}" autocomplete="off" >
              @error('longitud')
              <ul class="parsley-errors-list filled" id="parsley-id-5">
                  <li class="parsley-required">{{$message}}</li>
              </ul>
              @enderror

          </div>
        </div>
        <div class="panel-body panel-body-map">
          <div id="map" style="width:100%;height:300px" >
          </div>
        </div>
           <div class="ln_solid"></div>
           <div class="form-group">
             <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
               <a href="{{  route('calles-localidad.index',['municipio'=>$municipalitie ,'localidad' => $item->id_localidad] )}}" class="btn btn-dark"> <i class="fa fa-arrow-left"></i> Cancelar</a>
               <button type="submit"  class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
             </div>
           </div>

         </form>
    </div>
</div>

@endsection
