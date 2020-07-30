@extends('layouts.master')

@section('head') @endsection

@section('content')

<div class="x_panel">
    <div class="x_title">
      <h2>Editar municipio <small></small></h2>
     
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br>
      
      <form action="{{ route('municipios.update',$item->id) }}" method="POST" id="demo-form2"  class="form-horizontal form-label-left">
      {{method_field('PATCH')}}
      @csrf
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Clave <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" class="form-control col-md-7 col-xs-12 @error('clave') parsley-error @enderror " class="form-control " name="clave" value="{{ old('clave') ? old('clave') : $item->clave }}" autocomplete="off">
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
                                  
            @foreach($entities as $items)
                    
                    @if(old('entidad'))
                            @if(old('entidad') == $items->id)
                                    <option value="{{$items->id}}" selected>{{$items->nombre}}</option>
                            @else
                                    <option value="{{$items->id}}" >{{$items->nombre}}</option>
                            @endif
                    @else
                            @if($item->id_entidad == $items->id)
                                <option value="{{$items->id}}" selected>{{$items->nombre}}</option>
                            @else
                                <option value="{{$items->id}}" >{{$items->nombre}}</option>
                            @endif
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
          
              <input type="text" class="form-control col-md-7 col-xs-12 @error('nombre') parsley-error @enderror " class="form-control " name="nombre" value="{{ old('nombre') ? old('nombre') : $item->nombre }}" autocomplete="off">
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
          
              <input type="text" class="form-control col-md-7 col-xs-12 @error('pob_total') parsley-error @enderror " class="form-control " name="pob_total" value="{{ old('pob_total') ? old('pob_total') : $item->pob_total }}" autocomplete="off">
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
          
              <input type="text" class="form-control col-md-7 col-xs-12 @error('pob_agua') parsley-error @enderror " class="form-control " name="pob_agua" value="{{ old('pob_agua') ? old('pob_agua') : $item->pob_agua }}" autocomplete="off">
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
          
              <input type="text" class="form-control col-md-7 col-xs-12 @error('presidente') parsley-error @enderror " class="form-control " name="presidente" value="{{ old('presidente') ? old('presidente') : $item->presidente }}" autocomplete="off">
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
          
              <input type="text" class="form-control col-md-7 col-xs-12 @error('delegado') parsley-error @enderror " class="form-control " name="delegado" value="{{ old('delegado') ? old('delegado') : $item->delegado }}" autocomplete="off">
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