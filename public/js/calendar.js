$(document).ready(function(){

var id      = null;
var asunto  = null;
var inicio  = null;
var final   = null;  
  
$('#calendario').fullCalendar({
    header:{
      left:'today,prev,next',
      center:'title',
      right:'month,agendaWeek,agendaDay'
    },
    selectable: true,
    resizable: true,
    editable: true,
    events: {  
      url: '/calendario',
      type: "GET"
    },
    eventSources:[{
      color:'red',
      textColor:"White"  
    }],
    eventClick:function(event,jsEvent,view){
      $('#parsley-id-5').empty();
      inicio = event.start.format('YYYY-MM-DD'); 
      final = moment(event.end.format()).subtract(1,'days').format('YYYY-MM-DD');
      id = event.id;
      $('#asunto').val(event.title);
      $('#save-event-calendar').hide();
      $('#edit-event-calendar').show();
      $('#delete-event-calendar').show();
      $("#modal-add-event").modal();
    },
    select:function( start, end, jsEvent, view){
      $('#parsley-id-5').empty();
      inicio = start.format('YYYY-MM-DD'); 
      final = moment(end.format()).subtract(1,'days').format('YYYY-MM-DD');
      $('#asunto').val('');
      $('#save-event-calendar').show();
      $('#edit-event-calendar').hide();
      $('#delete-event-calendar').hide();
      $("#modal-add-event").modal();
    },
    eventResize: function(event,delta,revert) {    
      asunto= event.title;
      id = event.id;
      inicio = event.start.format('YYYY-MM-DD'); 
      final = moment(event.end.format()).subtract(1,'days').format('YYYY-MM-DD');
      var data =  {'_method':'PATCH','asunto':asunto,'fec_inicio':inicio,'fec_final':final,'x-csrf-s':$('#x-csrf-s').val()};
      abc('/calendario/'+id,data,'Registro modificado exitosamente','Error al modificar registro');
    },
    eventDrop:function( event, delta, revertFunc ) { 
      asunto= event.title;
      id = event.id;
      inicio = event.start.format('YYYY-MM-DD'); 
      final = moment(event.end.format()).subtract(1,'days').format('YYYY-MM-DD');
      var data = {'_method':'PATCH','asunto':asunto,'fec_inicio':inicio,'fec_final':final,'x-csrf-s':$('#x-csrf-s').val()};
      abc('/calendario/'+id,data,'Registro modificado  exitosamente','Error al modificar registro');
    }
});
    
$('#save-event-calendar').click(function(e){ 
    $('#parsley-id-5').empty();
    if(ValidarCamposVacios($('#asunto').val())){
      asunto = $('#asunto').val();
      $("#modal-add-event").modal('toggle');
      var data = {'asunto':asunto,'fec_inicio':inicio,'fec_final':final,'x-csrf-s':$('#x-csrf-s').val()}; 
      abc('/calendario',data,'Registro guardado exitosamente','Error al guardar registro');
    }else{
      $('#parsley-id-5').append('<li class="parsley-required">El asunto es requerido.</li>');  
    }
  });
  
$('#edit-event-calendar').click(function(e){ 
  $('#parsley-id-5').empty();
  if(ValidarCamposVacios($('#asunto').val())){
      asunto = $('#asunto').val();
      $("#modal-add-event").modal('toggle');
      var data = {'_method':'PATCH','asunto':asunto,'fec_inicio':inicio,'fec_final':final,'x-csrf-s':$('#x-csrf-s').val()};
      abc('/calendario/'+id,data,'Registro modificado exitosamente','Error al modificar registro');
  }else{
    $('#parsley-id-5').append('<li class="parsley-required">El asunto es requerido.</li>'); 
  }
});

$('#delete-event-calendar').click(function(e){ 
  $('#parsley-id-5').empty();
  if(ValidarCamposVacios(id)){
    
    asunto = $('#asunto').val();
    $("#modal-add-event").modal('toggle');
    var data = {'_method':'DELETE','x-csrf-s':$('#x-csrf-s').val()};
    abc('/calendario/'+id,data,'Registro eliminado exitosamente','Error al eliminar registro');
  }else{
      $('#parsley-id-5').append('<li class="parsley-required">Error al eliminar evento.</li>'); 
  }
});

function ValidarCamposVacios(Valor){
  var result = true;
  if (Valor == null || Valor.length == 0 || /^\s+$/.test(Valor) || Valor === undefined) {
      result = false;
  }
  return result;  
}

function abc(url,values,msjsuccess,msjerror){
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
    }
  });

  $.ajax(
    {
        url: url,
        type: "POST",
        data: values
    })
    .done(function(data)
    {        
      if(data[0]['Result'] == 1){
        $.notify(msjsuccess,'success');
        $('#calendario').fullCalendar('refetchEvents');
      }else{
        $.notify(msjerror,'error');
      }
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
    {
       $.notify(msjerror,'error');
    });
   // FechaHora = calEvent.start._i.split(" ");
}

});


