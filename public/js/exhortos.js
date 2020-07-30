$(document).ready(function(){

    $('.myDatepicker').datetimepicker({
        ignoreReadonly: true,
        allowInputToggle: true
    });

    var formValid = true;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".saved").each(function(){

        $(this).click(function(){

            formValid = true;
            fila = $(this);

            var n_oficio    = $(this).parents("tr").find("input:text[name=n_oficio]").val();
            var municipio   = $(this).parents("tr").find("input:hidden[name=municipio]").val();
            var edas        = $(this).parents("tr").find("input:text[name=edas]").val();
            var costo_edas  = $(this).parents("tr").find("input:text[name=costo_edas]").val();
            var fecha       = $(this).parents("tr").find("input:text[name=fecha]").val();

            valuesrequired(n_oficio);
            valuesrequired(municipio);
            valuesrequired(edas);
            valuesrequired(costo_edas);
            valuesrequired(fecha);

            if(formValid){

                values = {'n_oficio':n_oficio,'municipio':municipio,'edas':edas,'costo_edas':costo_edas,'fecha':fecha};

                $.ajax(
                {
                    url: "/exhortos",
                    type: "POST",
                    data: values
                })
                .done(function(data)
                {
                  if(data[0]['Result'] != 0){
                    $.notify("El Registro se ha guardado correctamente",'success');
                    fila.closest('tr').remove();
                  }else{
                    $.notify("Ocurrio un error al guardar el registro",'error');
                  }
                })
                .fail(function(jqXHR, ajaxOptions, thrownError)
                {
                    $.notify("Ocurrio un error al guardar el registro",'error');
                    console.log(jqXHR);
                    console.log(ajaxOptions);
                    console.log(thrownError);

                });



            }else{
                $.notify("Favor de completar todos los campos",'warning');
            }

        });

    });
    function valuesrequired(Valor)
    {
        if (Valor == null || Valor.length == 0 || /^\s+$/.test(Valor) || Valor === undefined)
        {
            formValid = false;
        }
    }
});
