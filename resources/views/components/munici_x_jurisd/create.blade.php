@extends('layouts.master')

@section('head') @endsection

@section('content')
<div class="x_panel">
    <div class="x_title">
      <h2>Municipio para {{ $item->nombre }} <small></small></h2>
     
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br>
      <form action="{{ route('municipios-por-jurisdiccion.store') }}" method="POST" id="demo-form2"  class="form-horizontal form-label-left">
      @csrf
      <input type="hidden" name="juridiccion" value="{{ $item->id }}">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SELECCIONE LOS MUNICIPIOS <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
                <select multiple="multiple" class="multiselect-dropdown form-control" name="municipios[]">
                    @foreach($municipalities as $item)
                        <option value="{{$item->id}}">{{$item->nombre}}</option>
                    @endforeach
                </select>
              
              @error('municipios[]') 
              <ul class="parsley-errors-list filled" id="parsley-id-5">
                  <li class="parsley-required">{{$message}}</li>
              </ul>
              @enderror
            
          </div>
        </div>
           <div class="ln_solid"></div>
           <div class="form-group">
             <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">                    
               <a href="{{ route('jurisdicciones.index') }}" class="btn btn-dark"> <i class="fa fa-arrow-left"></i> Cancelar</a>
               <button type="submit"  class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
             </div>
           </div>

         </form>
    </div>
</div>
@endsection


