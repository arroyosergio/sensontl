$(document).ready(function () {
    getEstatusRegistro();
    $('.datapicker').datepicker({
        language: "es",
        autoclose: true,
        todayHighlight: true
    });
});

$('#btn-nuevo-asistente').click(function () {
    $('#modal-nueva-persona input').val('');
    $('#modal-nueva-persona').modal('show');
});

//Registro de los datos de facturación y del deposito
$('#form-datos-pago').submit(function () {
    var url = $(this).attr('action');
    var formData = new FormData($(this)[0]);
    $.post('registroasistencia/getEstatusRegistro', {}, function (response) {
        if (response == 'si') {
//            Update datos
            $.ajax({
                url: 'registroasistencia/updateDatosPago',
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
//                    $('#cargando').removeClass('hidden');
                    jsShowWindowLoad();
                },
                success: function (response) {
//                    $('#cargando').addClass('hidden');
                    jsRemoveWindowLoad();
                    switch (response) {
                        case 'true':
                            mostrarAlerta('success', 'Se actualizaron los datos con éxito.');
                            location.reload();
                            break;
                        case 'false':
                            mostrarAlerta('error', 'Ocurrio un problema al actualizar los datos.');
                            break;
                        case 'error-formato':
                            mostrarAlerta('error', 'Solo se permite archivos en formato PDF.');
                            break;
                        case 'error-correo':
                            mostrarAlerta('error', 'Ingrese una dirección de correo valida.');
                            break;
                        case 'error-num-asistentes':
                            mostrarAlerta('error', 'Agregue al menos un asistente.');
                            break;
                        case 'error-subir-archivo':
                            mostrarAlerta('error', 'Ocurrio un error al subir su archivo.');
                            break;
                        case 'error-ponente':
                            mostrarAlerta('error', 'Registre al menos un asistente del tipo ponente.');
                            break;
                        case 'error-null':
                            mostrarAlerta('error', 'Todos los campos son obligatorios.');
                            break;
                    }
                },
                error: function () {
                    message = $("<span class='error'>Ha ocurrido un error.</span>");
                }
            });
        } else {
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
//                    $('#cargando').removeClass('hidden');
                    jsShowWindowLoad();
                },
                success: function (response) {
//                    $('#cargando').addClass('hidden');
                    jsRemoveWindowLoad();
                    switch (response) {
                        case 'true':
                            mostrarAlerta('success', 'Su registro se realizo con éxito.');
                            break;
                        case 'false':
                            mostrarAlerta('error', 'Ocurrio un problema con su registro.');
                            break;
                        case 'error-formato':
                            mostrarAlerta('error', 'Solo se permite archivos en formato PDF.');
                            break;
                        case 'error-correo':
                            mostrarAlerta('error', 'Ingrese una dirección de correo valida.');
                            break;
                        case 'error-num-asistentes':
                            mostrarAlerta('error', 'Agregue al menos un asistente.');
                            break;
                        case 'error-subir-archivo':
                            mostrarAlerta('error', 'Ocurrio un error al subir su archivo.');
                            break;
                        case 'error-ponente':
                            mostrarAlerta('error', 'Registre al menos un asistente del tipo ponente.');
                            break;
                        case 'error-null':
                            mostrarAlerta('error', 'Todos los campos son obligatorios.');
                            break;
                    }
                },
                error: function () {
                    message = $("<span class='error'>Ha ocurrido un error.</span>");
                }
            });
        }
    });
    return false;
});

//Agregar un nuevo asistente
$('#form-nuevo-asistente').submit(function () {
    var url = $(this).attr('action');
    var data = $(this).serialize();
    $.post('registroasistencia/nuevoAsistente', data, function (response) {
        switch (response) {
            case 'true':
                getAsistentesArticulo();
                getMonto();
                mostrarAlerta('success', 'Se agrego un nuevo asistente.');
                break;
            case 'error-query':
                mostrarAlerta('error', 'No se pudo agregar el nuevo asistente.');
                break;
            case 'error-null':
                mostrarAlerta('error', 'Todos los campos son obligatorios.');
                break;
        }
    });
    return false;
});

//Editar asistente
$('#form-editar-asistente').submit(function () {
    var url = $(this).attr('action');
    var data = $(this).serialize();
    $.post(url, data, function (response) {
        switch (response) {
            case 'true':
                getAsistentesArticulo();
                $('#modal-editar-persona').modal('hide');
                mostrarAlerta('success', 'Se modifico el asistente.');
                break;
            case 'false':
                mostrarAlerta('error', 'No se puede modificar al asistente.');
                break;
            case 'error-null':
                mostrarAlerta('error', 'Todos los campos son obligatorios.');
                break;
        }
    });
    return false;
});

//Evento del clic en la tabla de asistentes
$('#tabla-asistentes').click(function (event) {
    var id = event.target.id;
    var opcion = '';
    id = id.split('|');
    opcion = id[0];
    id = id[1];
    if (opcion === 'editar') {
        getDatosAsistente(id);
    }
    if (opcion === 'borrar') {
        borrarAsistente(id);
        getMonto();
    }
});

function getAsistentesArticulo() {
    $.post('registroasistencia/getAsistentesArticulo', {}, function (response) {
        $('#tabla-asistentes').empty();
        $('#tabla-asistentes').html(response);
        $('#modal-nueva-persona').modal('hide');
    });
}

function getMonto() {
    $.post('registroasistencia/getMonto', {}, function (response) {
        $('#monto').val(response);
    });
}

function getDatosAsistente(id) {
    $.post('registroasistencia/getDatosAsistente', {id: id}, function (response) {
        $('#id-asistente').val(response.id);
        $('#nombre-asistente').val(response.nombre);
        $('#institucion').val(response.institucion);
        $('#tipo-asistente').val(response.tipo);
    }, 'json');
    $('#modal-editar-persona').modal('show');
}

function borrarAsistente(id) {
    $.post('registroasistencia/borrarAsistente', {id: id}, function (response) {
        switch (response) {
            case 'true':
                getAsistentesArticulo();
                mostrarAlerta('success', 'Se borro el asistente.');
                break;
            case 'false':
                mostrarAlerta('error', 'Ocurrio un problema al borrar al asistente.');
                break;
        }
    });
}

function getEstatusCambios() {
    $.post('registroasistencia/getEstatusCambios', {}, function (response) {
        if (response === 'no') {
            $('input').attr('disabled', 'disabled');
            $('select').attr('disabled', 'disabled');
            $('#btn-nuevo-asistente').addClass('hidden');
            $('#btn-aceptar-form-pago').addClass('hidden');
            mostrarAlerta('info', 'Tu registro ya se realizo con éxito, comunicate con el administrador ante algún error de llenado.');
        }
    });
}

function getEstatusRegistro() {
    $.post('registroasistencia/getEstatusRegistro', {}, function (response) {
        if (response === 'si') {
            getDatosDeposito();
            getDatosFacturacion();
            getEstatusCambios();
        }
    });
}

function getDatosDeposito() {
    $.post('registroasistencia/getDatosDeposito', {}, function (response) {
        $('#banco').val(response.banco);
        $('#num-sucursal').val(response.sucursal);
        $('#num-transaccion').val(response.transaccion);
        $('#tipo-pago').val(response.tipoPago);
        $('#info-deposito').val(response.info);
        $('#fecha').val(response.fecha);
        $('#hora').val(response.hora);
        $('#minuto').val(response.minuto);
    }, 'json');
}

function getDatosFacturacion() {
    $.post('registroasistencia/getDatosFacturacion', {}, function (response) {
        $('#razon-social').val(response.razonSocial);
        $('#rfc').val(response.rfc);
        $('#calle').val(response.calle);
        $('#numero').val(response.numero);
        $('#colonia').val(response.colonia);
        $('#municipio').val(response.municipio);
        $('#estado').val(response.estado);
        $('#codigo-postal').val(response.cp);
        $('#correo').val(response.correo);
    }, 'json');
}

function mostrarAlerta(tipo, mensaje) {
    toastr.options.closeButton = true;
    switch (tipo) {
        case 'success':
            toastr.success(mensaje);
            break;
        case 'error':
            toastr.error(mensaje);
            break;
        case 'wanrning':
            toastr.warning(mensaje);
            break;
        case 'info':
            toastr.info(mensaje);
            break;
    }
}

function jsRemoveWindowLoad() {
    // eliminamos el div que bloquea pantalla
    $("#WindowLoad").remove();

}

function jsShowWindowLoad(mensaje) {
    //eliminamos si existe un div ya bloqueando
    jsRemoveWindowLoad();

    //si no enviamos mensaje se pondra este por defecto
    if (mensaje === undefined)
        mensaje = "Guardando información<br>Espere por favor";

    //centrar imagen gif
    height = 20;//El div del titulo, para que se vea mas arriba (H)
    var ancho = 0;
    var alto = 0;

    //obtenemos el ancho y alto de la ventana de nuestro navegador, compatible con todos los navegadores
    if (window.innerWidth == undefined)
        ancho = window.screen.width;
    else
        ancho = window.innerWidth;
    if (window.innerHeight == undefined)
        alto = window.screen.height;
    else
        alto = window.innerHeight;

    //operación necesaria para centrar el div que muestra el mensaje
    var heightdivsito = alto / 2 - parseInt(height) / 2;//Se utiliza en el margen superior, para centrar

    //imagen que aparece mientras nuestro div es mostrado y da apariencia de cargando
    imgCentro = "<div style='text-align:center;height:" + alto + "px;'><div  style='color:#000;margin-top:" + heightdivsito + "px; font-size:20px;font-weight:bold'>" + mensaje + "</div><img  src='./public/img/cargando.gif'></div>";

    //creamos el div que bloquea grande------------------------------------------
    div = document.createElement("div");
    div.id = "WindowLoad";
    div.style.width = ancho + "px";
    div.style.height = alto + "px";
    $("body").append(div);

    //creamos un input text para que el foco se plasme en este y el usuario no pueda escribir en nada de atras
    input = document.createElement("input");
    input.id = "focusInput";
    input.type = "text";

    //asignamos el div que bloquea
    $("#WindowLoad").append(input);

    //asignamos el foco y ocultamos el input text
    $("#focusInput").focus();
    $("#focusInput").hide();

    //centramos el div del texto
    $("#WindowLoad").html(imgCentro);

}