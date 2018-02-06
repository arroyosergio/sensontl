$("document").ready(function(){

});

$("#reset-pass").submit(function(event){
	event.preventDefault();
	var url = $(this).attr('action');
	var data = $(this).serialize();
	
	$.post(url, data, function(response){

		if (response == 'error-formato') {
			toastr.options.closeButton = true;
			toastr.error("El formato del correo electronico es incorrecto");
			$("#input-correo").focus();
		}

		if (response == 'error-correo') {
			toastr.options.closeButton = true;
			toastr.error("La dirección de correo electronico no esta registrada");
			$("#input-correo").focus();
		}

		if (response === 'true') {
			toastr.options.closeButton = true;
			toastr.success("Se ah enviado la nueva contrase&ntilde;a");
			$("#reset-pass")[0].reset();
			$("#input-correo").focus();
		}
	});	
	return false;
});


