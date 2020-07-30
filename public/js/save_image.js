$(document).ready(function(){
    $('#save-image').click(function(e){ 
        var image = $('#download').attr('href');
        $( "#img-preview-saved" ).empty().append( '<img src="'+image+'" name="evidencia" width="263px" height="148px"  alt="envidencia" />  <input type="hidden" name="evidencia" id="evidencia" value="'+image+'" > <br> <br> <button type="submit" class="btn btn-success" ><span class="docs-tooltip" data-toggle="tooltip" >Guardar Evidencia</span></button>' );
        $("#getCroppedCanvasModal").modal('toggle');
    });
});