@push('extra_css')
  <link href="{{ asset('vendor/iCheck/skins/flat/green.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css') }} " rel="stylesheet">
@endpush

@push('extra_js')
  <script src="{{ asset('vendor/iCheck/icheck.min.js') }}"></script>
  <script src="{{ asset('vendor/moment/min/moment.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
  
  <script>
    
  
    $('#myDatepicker4').datetimepicker({
        ignoreReadonly: true,
        allowInputToggle: true
    });

    $("#municipio").on("change", function(e) {
        
      if($('#municipio').val() != 0){
       
        $('#localidad').attr("disabled", true);
        $('#calle').attr("disabled", true);

        $.ajax(
        {
            url: '/localidades',
            type: "GET",
            data: { municipio:$('#municipio').val() }
        })
        .done(function(data)
        {        
          var values = JSON.parse(data);
          $('#localidad').empty().append('<option value="0">--SELECCIONAR--</option>');
          $('#calle').empty().append('<option value="0">--SELECCIONAR--</option>');
          $.each(values,function(i,val){
              $('#localidad').append('<option value="'+val.id+'"> '+val.nombre+'  </option>');
          });
          $('#localidad').attr("disabled", false);
        })
        .fail(function(jqXHR, ajaxOptions, thrownError){
            console.log(jqXHR);
        });
      }else{
          $('#localidad').attr("disabled", true);
          $('#localidad').empty().append('<option value="0" selected>--SELECCIONAR--</option>');
          $('#calle').empty().append('<option value="0" selected>--SELECCIONAR--</option>');
      }
    });

    $("#localidad").on("change", function(e) {
        
      $('#calle').attr('disabled',true);
        if($('#localidad').val() != 0){
      
          $.ajax(
          {
              url: '/calles-localidad',
              type: "GET",
              data: { localidad:$('#localidad').val() }
          })
          .done(function(data)
          {        
            var values = JSON.parse(data);
            $('#calle').empty().append('<option value="0">--SELECCIONAR--</option>');
             $.each(values,function(i,val){
                 $('#calle').append('<option value="'+val.id+'"> '+val.nombre+'  </option>');
             });
             $('#calle').attr("disabled", false);
          })
          .fail(function(jqXHR, ajaxOptions, thrownError){
            console.log(jqXHR);
          });
        }else{
          $('#calle').attr("disabled", true);
          $('#calle').empty().append('<option value="0" selected>--SELECCIONAR--</option>');
        }
      });


    
    
    </script>
@endpush


@extends('layouts.master')


@section('content')

<div class="x_panel">
    <div class="x_title">
      <h2>Editar notificación de cloro residual. <small></small></h2>
     
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br>
      
      <form action="{{ route('cloro-residual.update',$item->id) }}" method="POST" id="demo-form2"  class="form-horizontal form-label-left">
      {{method_field('PATCH')}}
      @csrf
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Municipio <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="select2_single form-control" tabindex="-1" name="municipio" id="municipio">
                <option value="0" selected>--SELECCIONAR--</option>
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
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Localidad <span class="required">*</span>
          </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <select class="select2_single form-control" tabindex="-1" name="localidad" id="localidad"  >
                <option value="0">--SELECCIONAR--</option>
                @foreach($locations as $items)

                  @if(old('localidad'))
                          @if(old('localidad') == $items->id)
                                  <option value="{{$items->id}}" selected>{{$items->nombre}}</option>
                          @else
                                  <option value="{{$items->id}}" >{{$items->nombre}}</option>
                          @endif
                  @else
                          @if($item->id_localidad == $items->id)
                              <option value="{{$items->id}}" selected>{{$items->nombre}}</option>
                          @else
                              <option value="{{$items->id}}" >{{$items->nombre}}</option>
                          @endif
                  @endif
                  
                @endforeach
                
                 
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
            <select class="select2_single form-control" tabindex="-1" name="calle" id="calle" >
                <option value="0" selected>--SELECCIONAR--</option>
                 @foreach($streets as $items)
                
                  @if(old('calle'))
                          @if(old('calle') == $items->id)
                                  <option value="{{$items->id}}" selected>{{$items->nombre}}</option>
                          @else
                                  <option value="{{$items->id}}" >{{$items->nombre}}</option>
                          @endif
                  @else
                          @if($item->id_calle == $items->id)
                              <option value="{{$items->id}}" selected>{{$items->nombre}}</option>
                          @else
                              <option value="{{$items->id}}" >{{$items->nombre}}</option>
                          @endif
                  @endif
                  
                @endforeach
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
         
                   
              <div class='input-group date' id='myDatepicker4'>
                  <input type='text' class="form-control" name="fecha" id="fecha" readonly="read_only" value="{{ old('fecha') ? old('fecha') : $item->fecha }}"/>
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
              <input type="text" class="form-control col-md-7 col-xs-12 @error('valor') parsley-error @enderror " class="form-control " name="valor" value="{{ old('valor') ? old('valor') : $item->valor }}" autocomplete="off">
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
            
            
            SI <input type="radio" class="flat" name="ss" id="genderM" value="1" {{ old('ss') ?  old('ss') == 1 ? 'checked' : '' : $item->sin_servicio == 1 ? 'checked' : '' }} />
            NO  <input type="radio" class="flat" name="ss" id="genderF" value="0" {{ old('ss') ?  old('ss') == 0 ? 'checked' : '' : $item->sin_servicio == 0 ? 'checked' : '' }}/>
            
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
              <input type="text" class="form-control col-md-7 col-xs-12 @error('causas') parsley-error @enderror " class="form-control " name="causas" value="{{ old('causas') ? old('causas') : $item->causas }}" autocomplete="off">
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
              <input type="text" class="form-control col-md-7 col-xs-12 @error('acciones') parsley-error @enderror " class="form-control " name="acciones" value="{{ old('acciones') ? old('acciones') : $item->acciones }}" autocomplete="off">
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
            SI <input type="radio" class="flat" name="analisis" id="genderM" value="1"  {{ old('analisis') ?  old('analisis') == 1 ? 'checked' : '' : $item->muestras == 1 ? 'checked' : '' }} />
            NO  <input type="radio" class="flat" name="analisis" id="genderF" value="0" {{ old('analisis') ?  old('analisis') == 0 ? 'checked' : '' : $item->muestras == 0 ? 'checked' : '' }}/>
            
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