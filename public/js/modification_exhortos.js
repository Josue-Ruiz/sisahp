$(document).ready(function(){

    $("#municipio").on("change", function(e) {

        if($('#municipio').val() != 0){

          $('#search').attr("disabled", false);
        }else{
            $('#search').attr("disabled", true);
        }
      });

});
