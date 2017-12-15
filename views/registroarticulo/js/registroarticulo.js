var  numAutores = 0;
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


$(':file').change(function () {
    var file = $("#archivo")[0].files[0];
    var fileName = file.name;
    fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
    var fileSize = file.size;
    var fileType = file.type;
});

function activarOpcionMenu(){
    var id = $('#navbar li.active').attr('id');
    $('#'+id).removeClass('active');
    $('#li-mis-articulos').addClass('active');
}

$('#form-registro-articulo').submit(function () {
    //información del formulario
    var formData = new FormData($(this)[0]);
    var message = "";
    var idArticulo = 0;
    //hacemos la petición ajax  
    $.ajax({
        url: 'registroarticulo/registroArticulo',
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
            $('#cargando').removeClass('hidden');
        },
        //una vez finalizado correctamente
        success: function (response) {
            $('#cargando').addClass('hidden');
            if (response === 'error-null') {
                toastr.options.closeButton = true;
                toastr.error("Ning&uacute;n campo puede ir vacio.");
            }
            
            if (response === 'error-articulo-repetido') {
                toastr.options.closeButton = true;
                toastr.error("El nombre del articulo ya esta registrado.");
            }
            
            if (response === 'error-archivo') {
                toastr.options.closeButton = true;
                toastr.error("No selecciono nig&uacute;n archivo.");
            }
            
            if (response === 'error-formato-archivo') {
                toastr.options.closeButton = true;
                toastr.error("El formato del archivo no es valido.");
            }
            
            if (response === 'error-registro') {
                toastr.options.closeButton = true;
                toastr.error("No se pudo realizar el registro.");
            }
            
            if (response === 'error-subir-archivo') {
                toastr.options.closeButton = true;
                toastr.error("No se pudo subir el archivo.");
            }
            
            if ($.isNumeric(response)) {
                $('#id-articulo-autor').val(response);
                $('#articulo-nombre').attr('disabled','disabled');
                $('#articulo-area-tematica').attr('disabled','disabled');
                $('#tipo-articulo').attr('disabled','disabled');
                $('#archivo').attr('disabled','disabled');
                $('#btn-aceptar-form-articulo').addClass('hidden');
                $('#a-regresar').addClass('hidden');
                $('#div-botones-arituculo').removeClass('hidden');
                $('#modal-autores').removeClass('hidden');
            }
        },
        //si ha ocurrido un error
        error: function () {
            message = $("<span class='error'>Ha ocurrido un error.</span>");
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