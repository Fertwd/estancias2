let tableProductos;


window.addEventListener('load', function() {

    tableProductos = $('#tableProductos').dataTable( {
        "aProcessing":true,
        "aServerSide":true,
        "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax":{
            "url": " "+base_url+"/Productos/getProductos",
            "dataSrc":""
        },
        "columns":[
            {"data":"idproducto"},
            {"data":"nombre"},
            {"data":"precio"},
            {"data":"descripcion"},
            {"data":"status"},
            {"data":"options"}
        ],
        'dom': 'lBfrtip',
 
        "resonsieve":"true",
        "bDestroy": true,
        "iDisplayLength": 10,
        "order":[[0,"desc"]]

    });

   // Manejo del cambio de foto
   if (document.querySelector("#foto")) {
    var foto = document.querySelector("#foto");
    foto.onchange = function(e) {
        var uploadFoto = document.querySelector("#foto").value;
        var fileimg = document.querySelector("#foto").files;
        var nav = window.URL || window.webkitURL;
        var contactAlert = document.querySelector('#form_alert');
        if (uploadFoto != '') {
            var type = fileimg[0].type;
            var name = fileimg[0].name;
            if (type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png') {
                contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';
                if (document.querySelector('#img')) {
                    document.querySelector('#img').remove();
                }
                document.querySelector('.delPhoto').classList.add("notBlock");
                foto.value = "";
                return false;
            } else {
                contactAlert.innerHTML = '';
                if (document.querySelector('#img')) {
                    document.querySelector('#img').remove();
                }
                document.querySelector('.delPhoto').classList.remove("notBlock");
                var objeto_url = nav.createObjectURL(this.files[0]);
                document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src=" + objeto_url + ">";
            }
        } else {
            alert("No seleccionó foto");
            if (document.querySelector('#img')) {
                document.querySelector('#img').remove();
            }
        }
    }
}

// Eliminar la foto cuando se hace clic en la "X"
if (document.querySelector(".delPhoto")) {
    var delPhoto = document.querySelector(".delPhoto");
    delPhoto.onclick = function(e) {
        // Restablecer el valor del input para que no tenga archivo cargado
        document.querySelector("#foto").value = "";

        // Eliminar la imagen de previsualización
        if (document.querySelector('#img')) {
            document.querySelector('#img').remove();
        }

        // Ocultar el botón de eliminar foto (la "X")
        document.querySelector('.delPhoto').classList.add("notBlock");

        // (Opcional) Resetear el valor oculto de eliminación, si es necesario
        document.querySelector("#foto_remove").value = 0;
    }
}
    
    


    if(document.querySelector("#formProductos")){
        let formProductos = document.querySelector("#formProductos");
        formProductos.onsubmit = function(e) {
            e.preventDefault();
            let strNombre = document.querySelector('#txtNombre').value;
            let strPrecio = document.querySelector('#txtPrecio').value;
            let intStatus = document.querySelector('#listStatus').value;
            if(strNombre == '' || strPrecio == '')
            {
                swal("Atención", "Todos los campos son obligatorios." , "error");
                return false;
            }
            let request = (window.XMLHttpRequest) ? 
                            new XMLHttpRequest() : 
                            new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Productos/setProducto'; 
            let formData = new FormData(formProductos);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("", objData.msg ,"success");
                        tableProductos.api().ajax.reload();
                        removePhoto();

                    }else{
                        swal("Error", objData.msg, "error");
                    }
            } 
            return false;           
        }
    }
}

    fntCategorias();
}, false);

// Para desglozar las categorias en el modal
function fntCategorias(){
    if(document.querySelector('#listCategoria')){
        let ajaxUrl = base_url+'/Categorias/getSelectCategorias';
        let request = (window.XMLHttpRequest) ? 
        new XMLHttpRequest() : 
        new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                document.querySelector('#listCategoria').innerHTML = request.responseText;
            }
        }
    }
}


function fntViewInfoP(idproducto){
    var idproducto = idproducto;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Productos/getProducto/'+idproducto;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                var estado = objData.data.status == 1 ? 
                '<span class="badge badge-success">Activo</span>' : 
                '<span class="badge badge-danger">Inactivo</span>';
            
                document.querySelector("#prodId").innerHTML = objData.data.idproducto;
                document.querySelector("#prodNombre").innerHTML = objData.data.nombre;
                document.querySelector("#prodDescripcion").innerHTML = objData.data.descripcion;
                document.querySelector("#prodPrecio").innerHTML = objData.data.precio;
                document.querySelector("#prodEstado").innerHTML = estado;
                document.querySelector("#imgProd").innerHTML = '<img src="' + objData.data.url_portada + '"></img>';
                
                $('#modalViewProducto').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}


function fntEditInfoP(idproducto){


    document.querySelector('#titleModal').innerHTML ="Actualizar Producto";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";

    var idproducto = idproducto;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/Productos/getProducto/'+idproducto;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            var objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                document.querySelector("#idProducto").value = objData.data.idproducto;
                document.querySelector("#txtNombre").value = objData.data.nombre;
                document.querySelector("#txtDescripcion").value = objData.data.descripcion;
                document.querySelector("#txtPrecio").value = objData.data.precio;
                document.querySelector("#foto_actualp").value = objData.data.portada;
            
                if (objData.data.status == 1) {
                    document.querySelector("#listStatus").value = 1;
                } else {
                    document.querySelector("#listStatus").value = 2;
                }     
                
                if (document.querySelector('#img')) {
                    document.querySelector('#img').src = objData.data.url_portada;
                } else {
                    document.querySelector('.prevPhoto div').innerHTML = "<img id='img' src='" + objData.data.url_portada + "'>";
                }
                if (objData.data.portada == 'portada_categoria.png') {
                    document.querySelector('.delPhoto').classList.add("notBlock");
                } else {
                    document.querySelector('.delPhoto').classList.remove("notBlock");
                }
                

               $('#modalFormProductos').modal('show');
            }else{
                swal("Error", objData.msg , "error");
            }
        }
    }
}


function fntDelInfoP(idproducto){
    var idProducto = idproducto;
    swal({
        title: "Eliminar Producto",
        text: "¿Realmente quiere eliminar el producto? :(",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar!",
        cancelButtonText: "No, cancelar!",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        
        if (isConfirm) 
        {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/Productos/delProducto';
            let strData = "idProducto="+idProducto;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        swal("Eliminar!", objData.msg , "success");
                        tableProductos.api().ajax.reload();
                    }else{
                        swal("Atención!", objData.msg , "error");
                    }
                }
            }
        }

    });
}


function removePhoto(){
    document.querySelector('#foto').value ="";
    document.querySelector('.delPhoto').classList.add("notBlock");
    if(document.querySelector('#img')){
        document.querySelector('#img').remove();
    }
}

function openModal2()
{
    rowTable = "";
    document.querySelector('#idProducto').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Producto";
    document.querySelector("#formProductos").reset();
    $('#modalFormProductos').modal('show');
    removePhoto();
}
