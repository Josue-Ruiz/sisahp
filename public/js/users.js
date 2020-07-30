$(document).ready(function(){

    $("#rol").on("change", function(e)
    {

        if($('#rol').val() != 0){

            if($('select[name="rol"] option:selected').text().toLowerCase() == 'municipal')
            {
                $('#rol').attr("disabled", true);
                $('#lbldinamic').text('Municipio:');

                $.ajax({
                    url: '/municipios',
                    type: "GET"
                })
                .done(function(data)
                {
                    var values = JSON.parse(data);
                    $('#divdinamic').empty().append('<select class="select2_single form-control" tabindex="-1" name="municipio" id="municipio" >    <option value="0" selected>--SELECCIONAR--</option> </select>');
                    $('#municipio').attr("disabled", true);
                    $.each(values,function(i,val){
                        $('#municipio').append('<option value="'+val.id+'" > '+val.nombre+'  </option>');
                    });
                    $('#municipio').attr("disabled", false);
                    $('#rol').attr("disabled", false);

                })
                .fail(function(jqXHR, ajaxOptions, thrownError){
                    console.log(jqXHR);
                });

            }else{

                $('#lbldinamic').text('Jurisdicción:');
                $('#rol').attr("disabled", true);

                $.ajax({
                    url: '/jurisdicciones',
                    type: "GET"
                })
                .done(function(data)
                {
                    var values = JSON.parse(data);
                    $('#divdinamic').empty().append('<select class="select2_single form-control" tabindex="-1" name="jurisdiccion" id="jurisdiccion" >    <option value="0" selected>--SELECCIONAR--</option> </select>');
                    $('#jurisdiccion').attr("disabled", true);
                    $.each(values,function(i,val){
                        $('#jurisdiccion').append('<option value="'+val.id+'" > '+val.nombre+'  </option>');
                    });
                    $('#jurisdiccion').attr("disabled", false);
                    $('#rol').attr("disabled", false);

                })
                .fail(function(jqXHR, ajaxOptions, thrownError){
                    console.log(jqXHR);
                });

            }

        }
    });

});
