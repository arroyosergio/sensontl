var blnModif=false;
$(document).ready(function () {
     activarOpcionMenu();
     $('#tbl-cartas').DataTable({
          "language": {
               "search": "Buscar:",
               "zeroRecords": "No se encontraron registros",
               "infoFiltered": "(filtrado de _MAX_ registros)",
               "infoEmpty": "No hay registros disponibles",
               "loadingRecords": "Cargando...",
               "processing": "Procesando..."
          }
     });
     
     $('#chkvalidacion-cartas').click(function (event) {
    	 blnModif=true;
    	 var id = $('#id_Articulo_carta_aceptacion').html();
    	 var status='no';
    	 if($("#chkvalidacion-cartas").is(':checked'))
    		  status='si'; 
         $.ajax({
             url: 'cartas/updateEstatusCartas',
             type: 'POST',
             //datos del formulario
             data: {"idArticulo":id,
            	    "status":status
                   },
             //una vez finalizado correctamente
             success: function (response) {
                  if (response) {
                       toastr.options.closeButton = true;
                       toastr.success("Proceso realizado...");
                  } else  {
                       toastr.options.closeButton = true;
                       toastr.error("Proceso no realizado...");
                  }
             },
             //si ha ocurrido un error
             error: function (response) {
             }
        });
     });
     
     $('#btn_enviar').click(function (event) {
    	 var id = $('#id_Articulo_carta_aceptacion').html();
    	 var comentario = $('#comentario_val_cartas').val();
         $.ajax({
             url: 'cartas/fncSendComentario',
             type: 'POST',
             //datos del formulario
             data: {"idArticulo":id,
            	    "comentario":comentario
                   },
             //una vez finalizado correctamente
             success: function (response) {
                  if (response === "Correo-ok") {
                       toastr.options.closeButton = true;
                       toastr.success("Correo Enviado...");
                  } else if (response === "Correo-bad") {
                       toastr.options.closeButton = true;
                       toastr.error("Fallo al enviar Correo...");
                  } else if (response === "Correo-no") {
                       toastr.options.closeButton = true;
                       toastr.success("Proceso realizado...");
                  }
             },
             //si ha ocurrido un error
             error: function (response) {
             }
        });
     });
});

$('.detalles').click(function(){
	$('#modal-detalles-cartas').modal('show').one('hidden.bs.modal', function(e) {
		if(blnModif)
		     location.reload();
		// this handler is detached after it has run once
    });
    
     $.post('dashboard/getCartaOriginalidad', {id: $(this).attr('carta')}, function (response) {
         $('#div-carta-originalidad').html(response);
    });
    $.post('dashboard/getCartaDerechos', {id: $(this).attr('carta')}, function (response) {
         $('#div-carta-derechos').html(response);
    });
    $.post('dashboard/getCartaAceptacion',{id:$(this).attr('carta')},function(response){
  	    $('#documentos-actuales').empty();
  	    $('#documentos-actuales').html(response);
  	});
    $('#id_Articulo_carta_aceptacion').html($(this).attr('carta'));
    $.post('cartas/getEstatusCartas',{id:$(this).attr('carta')}, function(response){
         if (response == 'si') {
        	 $("#chkvalidacion-cartas").attr('checked', true);
         }else{
        	 $("#chkvalidacion-cartas").attr('checked', false);
         }
    });
    
}); 


function activarOpcionMenu() {
     var id = $('#navbar li.active').attr('id');
     $('#' + id).removeClass('active');
     $('#li-cartas').addClass('active');
}

//Validación de cartas
$("#btn-form-validacion-cartas").click(function () {
     var estatus = $("input[name=validacion-cartas]:checked").val();
     $.post('cartas/updateEstatusCartas', {id: idArticulo, estatus: estatus}, function (response) {
          if (response === 'false') {
               toastr.options.closeButton = true;
               $('#detalletrabajo').modal('hide');
               toastr.error("Ocurrio un error al actualizar el estatus de los documentos");
          }
          if (response === 'true') {
               toastr.options.closeButton = true;
               $('#detalletrabajo').modal('hide');
               toastr.success("Se actualizo el estus de los documentos");
          }
     });
});

//=================================================================
//Subir carta de aceptacion
//=================================================================
$('#input-carta-aceptacion').change(function (event) {
	var id = $('#id_Articulo_carta_aceptacion').html();
	var files = event.target.files;
	var data = new FormData();
	$.each(files, function (key, value)
	{
      data.append(key, value);
    });
    data.append('idArticulo', id);
    $.ajax({
	  url: 'cartas/subir_carta_aceptacion',
      type: 'POST',
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function () {
           $('#cargando').removeClass('hidden');
      },
      success: function (response) {
           if (response === 'error-formato-archivo') {
                toastr.options.closeButton = true;
                toastr.error("El formato del archivo no es valido.");
           }

           if (response === 'error-null') {
                toastr.options.closeButton = true;
                toastr.error("No se ha indicado a que art&iacute;culo pertence.");
           }

           if (response === 'error-subir-archivo') {
                toastr.options.closeButton = true;
                toastr.error("No se pudo subir el archivo.");
           }
           if (response === 'error-validacion') {
                toastr.options.closeButton = true;
                toastr.error("No se tienen los permisos para realizar el cambio.");
           }
           if (response === 'true') {
                $('#cargando').addClass('hidden');
                toastr.options.closeButton = true;
                toastr.success("Se subio la carta de aceptaci&oacute;n");
           }
           $('#cargando').addClass('hidden');

      },
      error: function (response) {
           message = $("<span class='error'>Ha ocurrido un error.</span>");
      }
 });
 return false;
});
