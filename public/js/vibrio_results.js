$(document).ready(function(){

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

            var id = $(this).parents("tr").find("input:hidden[name=id]").val();

            var resultado = $(this).parents("tr").find("input:checkbox[name=resultado]:checked").val();

            valuesrequired(id);

            if(formValid)
            {

                resultado      = (resultado===undefined) ? 0 : 1;

                values = {'_method':'PATCH','resultado':resultado };

                $.ajax(
                {
                    url: "/vibrio/"+id,
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
