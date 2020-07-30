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

            var domicilio = $(this).parents("tr").find("input:text[name=domicilio]").val();
            var localidad = $(this).parents("tr").find("input:hidden[name=localidad]").val();
            var fecha = $(this).parents("tr").find("input:text[name=fecha]").val();

            valuesrequired(domicilio);
            valuesrequired(localidad);
            valuesrequired(fecha);

            if(formValid)
            {

                values = {'localidad':localidad,'domicilio':domicilio,'fecha':fecha };

                $.ajax(
                {
                    url: "/vibrio",
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
                    console.log(jqXHR);
                    $.notify("Ocurrio un error al guardar el registro",'error');
                });

            }else
            {
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
