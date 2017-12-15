//toastr.info("Modificación de fecha:<br>El CICA 2017 se realizará los días 27 y 28 de septiembre de 2017");
//SMOOTH PAGE SCROLL
$(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});

$(document).ready(function () {
    $("html").niceScroll({
        cursorcolor: "#43AC6A",
        scrollspeed: "100",
        cursorborder: "1px solid #43AC6A",
        horizrailenabled: "false",
        cursorborderradius: "0px"
    });
    $('#menu-login a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
//     toastr.options.closeButton = true;
//     toastr.warning("Registrate para poder enviar tu artículo.");
});

new WOW().init();




$('#btn-nuevo-registro').click(function () {
    $('#modal-nuevo-registro').on('shown.bs.modal', function () {
        $('#input-correo-nuevo-registro').focus();
    });
    $('#modal-nuevo-registro').modal('show');
});

$('#form-login').submit(function(){
    var url = $(this).attr('action');
    var data = $(this).serialize();
    $.post(url, data, function(response){
        if (response === 'error-correo') {
            toastr.options.closeButton = true;
            toastr.error("El correo no es valido.");
        }
        if (response === 'error-login') {
               $('#login-password').val('');
            toastr.options.closeButton = true;
            toastr.error("Correo o contrase&ntilde;a incorrectos.");
        }
        if (response === 'primer-ingreso') {
            window.location.href = 'perfil';
        }
        if (response === 'true') {
            location.reload();
        }
    });
    return false;
});

$('#btn-racuperar-password').click(function () {
    $('#form-recuperar-password input').val('');
    $('#modal-recuperar-password').on('shown.bs.modal', function () {
        $('#input-corrreo-recuperar-pass').focus();
    });
    $('#modal-recuperar-password').modal('show');
});

$('#form-recuperar-password').submit(function () {
    var url = $(this).attr('action');
    var data = $(this).serialize();
    $.post(url, data, function (response) {
        if (response === 'error-null') {
            toastr.options.closeButton = true;
            toastr.error("Ning&uacute;n campo puede ir vacio.");
        }
        if (response === 'error-formato') {
            toastr.options.closeButton = true;
            toastr.error("El correo no es valido.");
        }
        if (response === 'error-correo') {
            toastr.options.closeButton = true;
            toastr.error("El correo no esta registrado.");
        }
        if (response === 'true') {
            $('#modal-recuperar-password').modal('hide');
            toastr.options.closeButton = true;
            toastr.success("Se ha enviado un correo con la nueva contrase&ntilde;a.");
        }
    });
    return false;
});

$('#form-nuevo-registro').submit(function(){
    var url = $(this).attr('action');
    var data = $(this).serialize();
    $.post(url, data, function(response){
        if (response == 'error-null') {
            toastr.options.closeButton = true;
            toastr.error("Todos los campos son requeridos.");
        }
        
        if (response == 'error-correo') {
            toastr.options.closeButton = true;
            toastr.error("El correo no es valido.");
        }
        
        if (response == 'error-pass') {
            toastr.options.closeButton = true;
            toastr.error("Las contrase&ntilde;as no son iguales.");
        }
        
        if (response == 'error-correo-registrado') {
            toastr.options.closeButton = true;
            toastr.error("El correo ya esta registrado.");
        }
        
        if (response === 'error-registro') {
            toastr.options.closeButton = true;
            toastr.error("El registro no se pudo realizar.");
        }
        
        if (response === 'true') {
            toastr.options.closeButton = true;
            toastr.success("El registro se realiz&oacute; con &eacute;xito.");
            $('#modal-nuevo-registro').modal('hide');
            $('.form-control').val('');
        }
    });
    return false;
});