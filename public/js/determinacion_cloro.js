$(document).ready(function(){
    var formValid = true;
    var usuario = $('#user').val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".saved").each(function(){	

        $(this).click(function(){
            
            formValid = true;
            fila = $(this);
            var id = $(this).parents("tr").find("input:hidden[name=id]").val();
            var fecales = $(this).parents("tr").find("input:checkbox[name=fecales]:checked").val();
            var municipio = $(this).parents("tr").find("input:hidden[name=municipio]").val();
            var localidad = $(this).parents("tr").find("input:hidden[name=localidad]").val();
            var calle = $(this).parents("tr").find("input:hidden[name=calle]").val();
            var totales = $(this).parents("tr").find("input:checkbox[name=totales]:checked").val();

            valuesrequired(municipio);
            valuesrequired(localidad);
            valuesrequired(calle);

            if(formValid){
                
                fecales      = (fecales===undefined) ? 0 : 1;
                totales      = (totales===undefined) ? 0 : 1;

                values = {'localidad':localidad,'municipio':municipio,'calle':calle,'fecales':fecales,'totales':totales,'id':id,'usuario':usuario }; 
                   $.ajax(
                    {
                        url: "/reporte/determinacion-de-cloro",
                        type: "POST",
                        data: values
                    })
                    .done(function(data)
                    {        
                      if(data[0]['Result'] == 1){
                        $.notify('El registro se ha gaurdado correctamente','success');
                        fila.closest('tr').remove();
                      }else{
                        $.notify('Ocurrio un error al guardar el registro','error');

                      }
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError)
                    {
                      console.log(jqXHR);
                    });
            }else{
                $.notify('Favor de completar todos los campos','warning');
            }
        });

    });

    function valuesrequired(Valor){
        if (Valor == null || Valor.length == 0 || /^\s+$/.test(Valor) || Valor === undefined) {
            formValid = false;
        }
    }
});

      