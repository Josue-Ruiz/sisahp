$(document).ready(function(){

    var formValid = true;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".saved").each(function(){

        $($(this).parents("tr").find("input[name=valor]")).keyup(function(e){

            if($(this).parents("tr").find("input[name=valor]").val() > 1.5){
                $(this).parents("tr").find("input[name=analisis]").prop("disabled", false);
                $(this).parents("tr").find("input[name=analisis]").prop("readonly", false);
            }else{
                $(this).parents("tr").find("input[name=analisis]").prop("disabled", true);
                $(this).parents("tr").find("input[name=analisis]").prop("readonly", false);
            }

        });

        $($(this).parents("tr").find("input:checkbox[name=ss]")).change(function(e){

           if($(this).parents("tr").find("input:checkbox[name=ss]:checked").val() !== undefined )
           {
                $(this).parents("tr").find("input[name=valor]").val(0);
           }

        });



        $(this).click(function(){


            formValid = true;
            fila = $(this);
            var ss = $(this).parents("tr").find("input:checkbox[name=ss]:checked").val();
            var municipio = $(this).parents("tr").find("input:hidden[name=municipio]").val();
            var localidad = $(this).parents("tr").find("input:hidden[name=localidad]").val();
            var calle = $(this).parents("tr").find("input:hidden[name=calle]").val();
            var fecha = $(this).parents("tr").find("input:text[name=fecha]").val();
            var valor = $(this).parents("tr").find("input[name=valor]").val();
            var causas = $(this).parents("tr").find("input:text[name=causas]").val();
            var acciones = $(this).parents("tr").find("input:text[name=acciones]").val();
            var analisis = $(this).parents("tr").find("input:checkbox[name=analisis]:checked").val();


            valuesrequired(municipio);
            valuesrequired(localidad);
            valuesrequired(calle);
            valuesrequired(fecha);
            valuesrequired(valor);
            valuesrequired(causas);
            valuesrequired(acciones);

            if(formValid){

                ss      = (ss===undefined) ? 0 : 1;
                analisis = (analisis===undefined) ? 0 : 1;
                valor = (ss == 1) ? 0 : valor;

                values = {'localidad':localidad,'municipio':municipio,'calle':calle,'fecha':fecha,'valor':valor,'causas':causas,'acciones':acciones,'analisis':analisis,'ss':ss };
                   $.ajax(
                    {
                        url: "/cloro-residual",
                        type: "POST",
                        data: values
                    })
                    .done(function(data)
                    {
                      if(data[0]['Result'] != 0){
                        $.notify("El Registro se ha guardado correctamente",'success');
                        fila.closest('tr').remove();
                        window.open('http://127.0.0.1:8000/evidencias?notificacion='+data[0]['Result'],'_blank');
                      }else{
                        $.notify("Ocurrio un error al guardar el registro",'error');
                      }
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError)
                    {
                        $.notify("Ocurrio un error al guardar el registro",'error');
                    });

            }else{
                $.notify("Favor de completar todos los campos",'warning');
            }

        });

    });


    function valuesrequired(Valor){
        if (Valor == null || Valor.length == 0 || /^\s+$/.test(Valor) || Valor === undefined) {
            formValid = false;
        }
    }


});


