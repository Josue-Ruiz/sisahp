function previewFile() {


    var content = document.getElementById('perfil');
    var fileName  = document.getElementById('foto');
    var fileValue =fileName.value;
    var save    = document.getElementById('save');
    var error    = document.getElementById('error-image');

    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

    if(!allowedExtensions.exec(fileValue)){

        error.innerHTML = 'Cargue el archivo que tenga extensiones  .jpeg .jpg  .png.';
        save.disabled=true;
        fileName.value = '';
        content.innerHTML = '';
    }else{
        error.innerHTML = '';
        var file    = document.getElementById('foto').files[0];
        var reader  = new FileReader();

        reader.onloadend = function () {
            content.innerHTML =  '<br> <img src="'+reader.result+'"  width="100px" height="100px" alt="perfil" >';
            save.disabled=false;
        }
        if(file){
            reader.readAsDataURL(file);
        }else{
            preview.src = "";
        }
    }



}
