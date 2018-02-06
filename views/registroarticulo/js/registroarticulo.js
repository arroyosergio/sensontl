var  numAutores = 0;
var ulrUpfile="";

$(document).ready(function () {
    activarOpcionMenu();
    $("#pais").change(function () {
        dependencia_estado();
//        dependencia_ciudad();
    });
//    $("#estado").change(function () {
//        dependencia_ciudad();
//    });
    $("#estado").attr("disabled", true);
//    $("#ciudad").attr("disabled", true);
    var opcion = $('#tipo-institucion').val();
    $('#input-tipo-institucion').val(opcion);
	
	var filesUpload=document.getElementById("archivo");
	fileList=document.getElementById("file-list");
	$("#cancelar").hide();
	$("#cargar").hide();
	
});

function activarOpcionMenu() {
    var id = $('#navbar li.active').attr('id');
    $('#' + id).removeClass('active');
    $('#li-mis-articulos').addClass('active');
}

function dependencia_estado() {
    var code = $("#pais").val();
    $.post('registroarticulo/getEstados', {codigo: code}, function (response) {
        $('#estado option').remove();
        $('#estado').attr('disabled', false);
        $('#estado').append(response);
    });
}

//function dependencia_ciudad() {
//    var code = $("#estado").val();
//    $.post('registroarticulo/getCiudades', {codigo: code}, function (response) {
//        $('#ciudad option').remove();
//        $('#ciudad').attr('disabled', false);
//        $('#ciudad').append(response);
//    });
//}

$('#btn-agregar-autor').click(function () {
    $('#modal-registro-autor').on('shown.bs.modal', function () {
        $('#nombre').focus();
    });
    var opcion = $('#tipo-institucion').val();
    $('#input-tipo-institucion').val(opcion);
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-full-width",
        "preventDuplicates": false,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    toastr.info('Los datos capturados serviran para generar las constancias');
    $('#modal-registro-autor').modal('show');
});

$('.borrar-autor').click(function (){
    return false;
});

$('#btn-aceptar-registro').click(function () {
    var autorContacto = $('input[name="auto-contacto"]:checked').val();
    var idArticulo = $("#id-articulo-autor").val();
    $.post('registroarticulo/asignarAutorContacto', {idAutor: autorContacto, idArticulo:idArticulo}, function (response) {
        $(location).attr('href', 'misarticulos');
    });
});

$('#form-registro-autor').submit(function(){
    var url = $(this).attr('action');
    var data = $(this).serialize();
    $.post(url, data, function (response) {
        if (response === 'error-null') {
            toastr.options.closeButton = true;
            toastr.error("Ning&uacute;n campo puede ir vacio.");
        }
        if (response === 'error-registro') {
            toastr.options.closeButton = true;
            toastr.error("No se pudo realizar el registro.");
        }
        if (response === 'error-correo') {
            toastr.options.closeButton = true;
            toastr.error("Ingresa una direcci&oacute;n de correo valida.");
        }
        if (response === 'error-autor-registrado') {
            toastr.options.closeButton = true;
            toastr.error("El autor ya se encuentra registrado.");
        }
        if (response === 'error-numero-autores') {
            toastr.options.closeButton = true;
            toastr.error("Ya no se pueden registar m&aacute;s autores para este articulo.");
        }
        if (response === 'true') {
            $('#modal-registro-autor').modal('hide');
            var id = $('#id-articulo-autor').val();
            $.ajax({
                url: "registroarticulo/getAutoresArticulo",
                type: 'POST',
                data: 'id='+id,
                cache: false,
                success: function (data) {
                    $('#detalles-articulo-autores').empty();
                    $('#detalles-articulo-autores').html(data);
                }
            });
            numAutores += 1;
            if (numAutores === 3) {
                $('#btn-agregar-autor').addClass('hidden');
            }
            $('#form-registro-autor input').val('');
            $('#id-articulo-autor').val(id);
        }
    });
    return false;
});


$("#cancelar").click(function(){
	$("#file-list").empty();
	$("#cancelar").hide("slow");
	fileList.innerHTML="<li class='no-items'> Ningun archivo cargado! </li>";
});


$(':file').change(function () {
	var li = document.createElement("li"),
		progressBarContainer = document.createElement("div"),
		progressBar = document.createElement("div"),		
    	div = document.createElement("div");
	var fileInfo;	
	progressBarContainer.className = "progress-bar-container";
	progressBar.className = "progress-bar";
	progressBar.id="progressBar";
	
	li.appendChild(div);
	
	var file = $("#archivo")[0].files[0];
    var fileName = file.name;
    fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
   if(fileExtension=="docx" || fileExtension=="doc"){
	   $("#file-list").empty();
	   $("#cancelar").show("slow");
	   $("#cargar").show("slow");
		// Present file info and append it to the list of files
		fileInfo = "<div><strong>Nombre:</strong> " + file.name + "</div>";
		fileInfo += "<div><strong>Tamano:</strong> " + parseInt(file.size / 1024, 10) + " kb</div>";
		fileInfo += "<div><strong>Tipo:</strong> " + file.type + "</div>";
		div.innerHTML = fileInfo;
	    fileList.appendChild(li);
	   

		progressBarContainer.appendChild(progressBar);
		li.appendChild(progressBarContainer);
	   
   } else{
	  toastr.options.closeButton = true;
      toastr.error("Tipo de archivo incorrecto ");
   }
});


/*function traverseFiles (files) {
	if (typeof files !== "undefined") {
		for (var i=0, l=files.length; i<l; i++) {
			uploadFile(files[i]);
		}
		uploadFile(files[0]);
		$("#cancelar").show("slow");
		$("#cargar").show("slow");
	}
	else {
		fileList.innerHTML = "El navegador no puede mostrar la imagen previa";
	}  
}*/

/*$("#cargar").click(function(){
	var file = $("#archivo")[0].files[0];
    var fileName = file.name;
	uploadFile(fileName);
});*/

function uploadFile (file) {
var li = document.createElement("li"),
    div = document.createElement("div"),
	img,
	progressBarContainer = document.createElement("div"),
	progressBar = document.createElement("div"),
    reader,
	xhr,
	fileInfo;

	li.appendChild(div);

	progressBarContainer.className = "progress-bar-container";
	progressBar.className = "progress-bar";
	progressBarContainer.appendChild(progressBar);
	li.appendChild(progressBarContainer);
	

	// Uploading - for Firefox, Google Chrome and Safari

	xhr = new XMLHttpRequest();
 
	// Update progress bar
	xhr.upload.addEventListener("progress", function (evt) {
		if (evt.lengthComputable) {
			progressBar.style.width = (evt.loaded / evt.total) * 100 + "%";
		}
		else {
		// No data to calculate on
		}
	}, false);
 
	// File uploaded
	xhr.addEventListener("load", function () {
		progressBarContainer.className += " uploaded";
		progressBar.innerHTML = "cargado!";
	}, false);
 
	xhr.open("post", "registroarticulo/updloadFile", true);

	// Set appropriate headers
	xhr.setRequestHeader("Content-Type", "multipart/form-data");
	xhr.setRequestHeader("X-File-Name", file.name);
	xhr.setRequestHeader("X-File-Size", file.size);
	xhr.setRequestHeader("X-File-Type", file.type);
	// Send the file (doh)
	xhr.send(file);
	// Present file info and append it to the list of files
	fileInfo = "<div><strong>Nombre:</strong> " + file.name + "</div>";
	fileInfo += "<div><strong>Tamano:</strong> " + parseInt(file.size / 1024, 10) + " kb</div>";
	fileInfo += "<div><strong>Tipo:</strong> " + file.type + "</div>";
	div.innerHTML = fileInfo;
	fileList.appendChild(li);
}



function activarOpcionMenu(){
    var id = $('#navbar li.active').attr('id');
    $('#'+id).removeClass('active');
    $('#li-mis-articulos').addClass('active');
}

$("#uploadfile").submit(function(event){
	event.preventDefault();
	var progressBar = document.getElementById("progressBar");
	var idArticulo  = $("#id-articulo").val();
    //información del formulario
    var formData = new FormData($(this)[0]);
    var message = "";
    //hacemos la petición ajax  
    $.ajax({
        url: 'registroarticulo/updloadFile',
        type: 'POST',
        // Form data
        //datos del formulario
        data: formData,
        //necesario para subir archivos via ajax
        cache: false,
        contentType: false,
        processData: false,
        //mientras enviamos el archivo
        beforeSend: function () {
			progressBar.style.width =  "0%";
			//$("#progress-bar").width('0%');
            //$('#cargando').removeClass('hidden');
        },
		// this part is progress bar
		xhr: function () {
			var xhr = new window.XMLHttpRequest();
			xhr.upload.addEventListener("progress", function (evt) {
				if (evt.lengthComputable) {
					var percentComplete = evt.loaded / evt.total;
					percentComplete = parseInt(percentComplete * 100);
     			    progressBar.style.width = percentComplete+'%';
					progressBar.innerHTML = percentComplete+ " %"; 
				}
			}, false);
			return xhr;
		},

        //una vez finalizado correctamente
        success: function (response) {
            //$('#cargando').addClass('hidden');
            if (response === 'error-archivo') {
                toastr.options.closeButton = true;
                toastr.error("No selecciono nig&uacute;n archivo.");
            }
            if (response === 'error-subir-archivo') {
                toastr.options.closeButton = true;
                toastr.error("No se pudo cargar el archivo.");
            }
            
            if ($.isNumeric(response)) {
                toastr.options.closeButton = true;
                toastr.success("El archivo se cargo...");
			}
        },
        //si ha ocurrido un error
        error: function () {
                toastr.options.closeButton = true;
                toastr.error("Un error a ocurrido!<br>Intentelo mas tarde...");
        }
    });
    return false;	
});


/*
OTRA ALTERNATIVA PARA MANEJO DE PROGRESSBAR
xhr: function() {
	var myXhr = $.ajaxSettings.xhr();
	if(myXhr.upload){
		myXhr.upload.addEventListener('progress',progress, false);
	}
	return myXhr;
},

function progress(e){
  if(e.lengthComputable){
        var max = e.total;
        var current = e.loaded;
        var Percentage = (current * 100)/max;
        console.log(Percentage);
        if(Percentage >= 100)
        {
           // process completed  
        }
    }  
 }*/

$('#form-registro-articulo').submit(function () {
    var url = $(this).attr('action');
    var data = $(this).serialize();
    $.post(url, data, function (response) {
		if (response === 'error-null') {
			toastr.options.closeButton = true;
			toastr.error("Ning&uacute;n campo puede ir vacio.");
		}

		if (response === 'error-articulo-repetido') {
			toastr.options.closeButton = true;
			toastr.error("El nombre del articulo ya esta registrado.");
		}
		
		if (response === 'error-registro') {
			toastr.options.closeButton = true;
			toastr.error("No se pudo realizar el registro.");
		}
		if($.isNumeric( response )){
			toastr.options.closeButton = true;
			toastr.success("El Articulo se registro correctamente");
			$("#id-articulo").val(response);
			
		}
       
    });	
    return false;
});

$('#tipo-institucion').change(function(){
    var opcion = $(this).val();
    $('#input-tipo-institucion').val(opcion);
    if (opcion ==='otro') {
        $('#lbl-input-tipo-institucion').removeClass('hidden');
        $('#input-tipo-institucion').removeClass('hidden');
        $('#input-tipo-institucion').val('');
    }else{
        $('#input-tipo-institucion').val(opcion);
        $('#lbl-input-tipo-institucion').addClass('hidden');
        $('#input-tipo-institucion').addClass('hidden');
    }
});

$('#cancelar-registro').click(function(){
    $('#cargando').removeClass('hidden');
    var idArticulo = $('#id-articulo-autor').val();
    $.post('registroarticulo/borrarRegistroArticulo',{id:idArticulo}, function(response){
        $('#cargando').hide();
        if (response === 'true') {
            $(location).attr('href', 'misarticulos');
        }
    });
});