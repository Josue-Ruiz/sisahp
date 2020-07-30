@extends('layouts.master')

@push('extra_css')
    <link href="{{ asset('vendor/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/pnotify/dist/pnotify.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/pnotify/dist/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/pnotify/dist/pnotify.nonblock.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Calendario Epidemiológico </h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">

              <div id='calendario'></div>

            </div>
          </div>
        </div>
    </div>


    
<div class="modal fade " id="modal-add-event" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="title-asunto">Agregar asunto</h4>
        </div>
        <div class="modal-body">
        <input type="hidden" id="x-csrf-s" value="{{Session::get('identity')->id}}"> 
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Asunto *</label>
            <input type="text" class="form-control" id="asunto">
            <ul class="parsley-errors-list filled" id="parsley-id-5">
                  
            </ul>
          </div>
                
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" id="delete-event-calendar">Eliminar</button>
            <button type="button" class="btn btn-success" id="edit-event-calendar">Guardar</button>
            <button type="submit" class="btn btn-success" id="save-event-calendar">Guardar</button>
        </div>
    </div>
  </div>

</div>




    <div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
  
    

@endsection

@push('extra_js') 

<script type="text/javascript" src="{{asset ('js/moment.min.js')}}"></script>
<script type="text/javascript" src="{{asset ('js/fullcalendar.min.js')}}"></script>
<script src="{{ asset('js/notify.js') }}"></script>
<script  type="text/javascript" src="{{ asset ('js/calendar.js')}}"></script>
@endpush


