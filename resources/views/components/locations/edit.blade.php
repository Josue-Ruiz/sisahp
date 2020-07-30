@extends('layouts.master')

@section('content')

<div class="x_panel">
    <div class="x_title">
      <h2>Editar localidad <small></small></h2>
     
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br>
      
      <form action="{{ route('localidades.update',$item->id) }}" method="POST" id="demo-form2"  class="form-horizontal form-label-left">
      {{method_field('PATCH')}}
      @csrf
      <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Municipio <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">

                <select class="multiselect-dropdown form-control" name="municipio">          
                      <option value="0">--SELECCIONAR--</option>
                   @foreach($municipalities as $items)
                        

                        @if(old('municipio'))
                                @if(old('municipio') == $items->id)
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
              @error('municipio') 
              <ul class="parsley-errors-list filled" id="parsley-id-5">
                  <li class="parsley-required">{{$message}}</li>
              </ul>
              @enderror
            
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Clave <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" class="form-control col-md-7 col-xs-12 @error('clave') parsley-error @enderror " class="form-control " name="clave" value="{{ old('clave') ? old('clave') : $item->folio }}" autocomplete="off">
              @error('clave') 
              <ul class="parsley-errors-list filled" id="parsley-id-5">
                  <li class="parsley-required">{{$message}}</li>
              </ul>
              @enderror
            
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nombre <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" class="form-control col-md-7 col-xs-12 @error('nombre') parsley-error @enderror " class="form-control " name="nombre" value="{{ old('nombre') ? old('nombre') : $item->nombre }}" autocomplete="off">
              @error('nombre') 
              <ul class="parsley-errors-list filled" id="parsley-id-5">
                  <li class="parsley-required">{{$message}}</li>
              </ul>
              @enderror
            
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pob. Total <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" class="form-control col-md-7 col-xs-12 @error('pob_total') parsley-error @enderror " class="form-control " name="pob_total" value="{{ old('pob_total') ? old('pob_total') : $item->pob_total }}" autocomplete="off">
              @error('pob_total') 
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
              <input type="text" class="form-control col-md-7 col-xs-12 @error('latitud') parsley-error @enderror " class="form-control " name="latitud" id="latitud" value="{{ old('latitud') ? old('latitud') : $item->latitud }}" autocomplete="off">
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
              <input type="text" class="form-control col-md-7 col-xs-12 @error('longitud') parsley-error @enderror " class="form-control " name="longitud" id="longitud" value="{{ old('longitud') ? old('longitud') : $item->longitud }}" autocomplete="off">
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
               <a  href="{{route('localidades.index',['municipio'=>$item->id_municipio]) }}" class="btn btn-dark"> <i class="fa fa-arrow-left"></i> Cancelar</a>
               <button type="submit"  class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
             </div>
           </div>

         </form>
    </div>
</div>


@endsection


@push('extra_js')  
         
      
  <script type="text/javascript" src="{{ asset('js/locationsmap.js') }}"></script>

  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMq0QkkYNBIKLzPVp0PDASJkbe-cBaJjM&callback=initMapEdit"></script> 
  
@endpush