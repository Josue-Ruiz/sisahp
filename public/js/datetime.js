

    $('.myDatepicker').datetimepicker({
        ignoreReadonly: true,
        allowInputToggle: true
    });

    $("#municipio").on("change", function(e) {

      if($('#municipio').val() != 0){

        $('#localidad').attr("disabled", true);
        $.ajax(
        {
            url: '/localidades',
            type: "GET",
            data: { municipio:$('#municipio').val() }
        })
        .done(function(data)
        {
          var values = JSON.parse(data);
          $('#localidad').empty().append('<option value="0">--SELECCIONAR--</option>');
          $.each(values,function(i,val){
              $('#localidad').append('<option value="'+val.id+'"> '+val.nombre+'  </option>');
          });
          $('#localidad').attr("disabled", false);
        })
        .fail(function(jqXHR, ajaxOptions, thrownError){
            console.log(jqXHR);
        });
      }else{
          $('#localidad').attr("disabled", true);
          $('#localidad').empty().append('<option value="0" selected>--SELECCIONAR--</option>');
          $('#calle').attr("disabled", true);
          $('#calle').empty().append('<option value="0" selected>--SELECCIONAR--</option>');
      }
    });

  $("#localidad").on("change", function(e) {

      if($('#localidad').val() != 0){
        $('#calle').attr('disabled',true);

        $.ajax(
        {
            url: '/calles-localidad',
            type: "GET",
            data: { localidad:$('#localidad').val() }
      })
      .done(function(data)
      {
        var values = JSON.parse(data);
        $('#calle').empty().append('<option value="0">--SELECCIONAR--</option>');
         $.each(values,function(i,val){
             $('#calle').append('<option value="'+val.id+'"> '+val.nombre+'  </option>');
         });
         $('#calle').attr("disabled", false);
      })
      .fail(function(jqXHR, ajaxOptions, thrownError){
        console.log(jqXHR);
      });
    }else{
      $('#calle').attr("disabled", true);
      $('#calle').empty().append('<option value="0" selected>--SELECCIONAR--</option>');
    }
  });




