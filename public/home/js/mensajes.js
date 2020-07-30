$('#mensaje-form').on('submit',function(e){
    
    console.log("Ingresarndo solicitud");
    
})
$('#mensaje-form').click(function(e) {
    e.preventDefault();
    exprEMAIL= new RegExp (/^[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}$/);
    nombre = $("#name").val();
    email = $("#email").val();
    msj = $("#msj").val();
    idobra = $("#idtbl_obras").val();
    if(nombre=="" && !email.match(exprEMAIL) && msj=="")
    {
        document.getElementById("name").style.backgroundColor="#feeeee";
        document.getElementById("email").style.backgroundColor="#feeeee";
        document.getElementById("msj").style.backgroundColor="#feeeee";
		document.getElementById("name").focus();
    }
    else
    {

    
    if(nombre==""){
        document.getElementById("name").style.backgroundColor="#feeeee";
        document.getElementById("name").focus();
    }
    else
    {
        document.getElementById("name").style.backgroundColor="#FFFFFF";

        if(!(email.match(exprEMAIL))){

            document.getElementById("email").style.backgroundColor="#feeeee";
            document.getElementById("email").focus();
        }
        else
        {
            document.getElementById("email").style.backgroundColor="#FFFFFF";
            if(msj==""){

                document.getElementById("msj").style.backgroundColor="#feeeee";
                document.getElementById("msj").focus();
            }
            else{
                document.getElementById("msj").style.backgroundColor="#FFFFFF";

                $.post('http://1mas.com.mx/api/mensajes',{name:nombre,email:email,msj:msj,id:idobra},function(match){
                    
                    if(match)
                    {
                        if(match == 1)
                        {
                            mensaje = document.getElementById("result");
       
                            mensaje.innerHTML = "<b>Datos Registrados con exito</b>";
                         
                            document.getElementById("name").value = "";
                            document.getElementById("email").value = "";
                            document.getElementById("msj").value = "";
                        }
                        else
                        {
                            mensaje = document.getElementById("result");
                            mensaje.innerHTML = "<b>Ocurrio un Error, favor de intentarlo mas tarde</b>";
                         
                        
                        }
                            
                    }
                    else
                    {

                    }
                 });
            }
        }
    }
}
   

});