@extends('layouts.master')

@section('head') @endsection

@section('content')

<div class="x_panel">
    <div class="x_title">
      <h2>Nuevo municipio <small></small></h2>
     
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br>
      
      <form action="{{ route('municipios.store') }}" method="POST" id="demo-form2"  class="form-horizontal form-label-left">
      @csrf
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Clave <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" class="form-control col-md-7 col-xs-12 @error('clave') parsley-error @enderror " class="form-control " name="clave" value="{{ old('clave') }}" autocomplete="off">
              @error('clave') 
              <ul class="parsley-errors-list filled" id="parsley-id-5">
                  <li class="parsley-required">{{$message}}</li>
              </ul>
              @enderror
            
          </div>
        </div>
        <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Entidad <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
          
            <select class="multiselect-dropdown form-control" name="entidad">
                                  
            @foreach($entities as $item)
                    @if(old('entidad')) 
                        <option value="{{$item->id}}" {{ old('entidad') == $item->id ? 'selected' : '' }}>{{$item->nombre}}</option>
                    @else 
                        <option value="{{$item->id}}" {{  $item->id == 7 ? 'selected' : '' }}>{{$item->nombre}}</option>
                    @endif
            @endforeach
                            
            </select>
            @error('entidad') 
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
          
              <input type="text" class="form-control col-md-7 col-xs-12 @error('nombre') parsley-error @enderror " class="form-control " name="nombre" value="{{ old('nombre') }}" autocomplete="off">
              @error('nombre') 
              <ul class="parsley-errors-list filled" id="parsley-id-5">
                  <li class="parsley-required">{{$message}}</li>
              </ul>
              @enderror
            
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Población Total <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
          
              <input type="text" class="form-control col-md-7 col-xs-12 @error('pob_total') parsley-error @enderror " class="form-control " name="pob_total" value="{{ old('pob_total') }}" autocomplete="off">
              @error('pob_total') 
              <ul class="parsley-errors-list filled" id="parsley-id-5">
                  <li class="parsley-required">{{$message}}</li>
              </ul>
              @enderror
            
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Población con Agua Entubada <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
          
              <input type="text" class="form-control col-md-7 col-xs-12 @error('pob_agua') parsley-error @enderror " class="form-control " name="pob_agua" value="{{ old('pob_agua') }}" autocomplete="off">
              @error('pob_agua') 
              <ul class="parsley-errors-list filled" id="parsley-id-5">
                  <li class="parsley-required">{{$message}}</li>
              </ul>
              @enderror
            
          </div>
        </div>

        <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Presidente <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
          
              <input type="text" class="form-control col-md-7 col-xs-12 @error('presidente') parsley-error @enderror " class="form-control " name="presidente" value="{{ old('presidente') }}" autocomplete="off">
              @error('presidente') 
              <ul class="parsley-errors-list filled" id="parsley-id-5">
                  <li class="parsley-required">{{$message}}</li>
              </ul>
              @enderror
            
          </div>
        </div>
        <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Delegado <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
          
              <input type="text" class="form-control col-md-7 col-xs-12 @error('delegado') parsley-error @enderror " class="form-control " name="delegado" value="{{ old('delegado') }}" autocomplete="off">
              @error('delegado') 
              <ul class="parsley-errors-list filled" id="parsley-id-5">
                  <li class="parsley-required">{{$message}}</li>
              </ul>
              @enderror
            
          </div>
        </div>
           <div class="ln_solid"></div>
           <div class="form-group">
             <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">                    
               <a href="{{route('municipios.index') }}" class="btn btn-dark"> <i class="fa fa-arrow-left"></i> Cancelar</a>
               <button type="submit"  class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
             </div>
           </div>

         </form>
    </div>
</div>

@endsection