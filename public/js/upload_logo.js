$(document).ready(function(){
    $('#save-image').click(function(e){
        var image = $('#download').attr('href');
        $( "#img-preview-saved" ).empty().append( '<img src="'+image+'" name="logo" width="263px" height="148px"  alt="logotipo" />  <input type="hidden" name="logo" id="logo" value="'+image+'" > <br> <br> <button type="submit" class="btn btn-success" ><span class="docs-tooltip" data-toggle="tooltip" >Guardar Logotipo</span></button>' );
        $("#getCroppedCanvasModal").modal('toggle');
    });
});
