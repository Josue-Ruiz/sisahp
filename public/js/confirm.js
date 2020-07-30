var id = null;
var row = null;
$(document).on('click','#show-modal',function(){
    id = $(this).data('id');
    row = $(this); 
    $('#modal-confirm-delete-location').modal();
    
});
$(document).on('click','#delete',function(){
    $('#form-modal-delete').attr("action","/localidades/"+id);
    $('#form-modal-delete').submit();
    
});

