<?php

class cartas extends Controller {

     function __construct() {
          parent::__construct();
          Session::init();
          $logged = Session::get('sesion');
          $this->view->css = array(
              'public/plugins/toastr/toastr.min.css',
              'views/dashboard/css/custom.css',
              'public/plugins/datatable/jquery.datatables.min.css',
          	  'views/cartas/css/cartas.css'         		
          );
          $this->view->js = array(
              'public/plugins/datatable/jquery.datatables.min.js',
              "public/plugins/toastr/toastr.min.js",
              "views/cartas/js/cartas.js"
          );

          $role = Session::get('perfil');
          if ($logged == false) {
               Session::destroy();
               header('location:index');
               exit;
          } elseif ($role != 'administrador') {
               header('location:index');
          }
     }

     function index() {
          $this->view->tblCartas = $this->getCartas();
          $this->view->render('cartas/index');
     }
     
     function getCartas() {
          $responseDB = $this->model->get_cartas();
          if (!$responseDB) {
               $response .= '<h1 class="text-center">No existen cartas registrados.</h1>';
          } else {
               $response = '<table id="tbl-cartas" class="table table-hover dataTable">';
               $response .= '<thead>';
               $response .= '<tr>';
               $response .= '<th>Id</th>';
               $response .= '<th>Art&iacute;culo</th>';
               $response .= '<th>Tipo</th>';
               $response .= '<th>Carta Aceptacion</th>';
               $response .= '<th>Carta Validadas</th>';
               $response .= '<th></th>';
               $response .= '</tr>';
               $response .= '</thead>';
               $response .= '<tbody>';
               foreach ($responseDB as $carta) {
                    $response .= '<td>'.$carta['articulo'].'</td>';
                    $response .= '<td>'.$carta['nombre'].'</td>';
                    $response .= '<td>'.$carta['tipo'].'</td>';
                    $response .= '<td>'.$carta['c_aceptacion'].'</td>';
                    $response .= '<td>'.$carta['cartas_validada'].'</td>';
                    $response .= '<td><p class="btn btn-link detalles" carta="'.$carta['articulo'].'"><span class="glyphicon glyphicon-eye-open"></span> Detalles<p></td>';
                    $response .= '</tr>';
               }
               $response .= '</tbody>';
               $response .= '</table>';
          }
          return $response;
     }
     
     function getCartaOriginalidad() {
     	$idArticulo = $_POST['id'];
     	$response = '<div class="form-group">';
     	$response .= '<label for="">';
     	$response .= '<label for="">Carta de originalidad:</label>';
     	$response .= '<p class="form-control-static">';
     	if (!empty($idArticulo)) {
     		$cartaOriginalidad = $this->model->get_carta_originalidad($idArticulo);
     		if (!$cartaOriginalidad) {
     			$response .= 'No hay carta de originalidad';
     		}else{
     			$response .= '<a href="docs/'.$cartaOriginalidad.'"><span class="glyphicon glyphicon-download-alt"></span> Descargar</a>';
     		}
     	}else{
     		error_log('Error no se esta mandando el id del art&iacute;culo : geCartaOriginalidad');
     	}
     	$response .= '</p>';
     	$response .= '</div>';
     	echo $response;
     }
     
     function getCartaDerechos() {
     	$idArticulo = $_POST['id'];
     	$response = '<div class="form-group">';
     	$response .= '<label for="">';
     	$response .= '<label for="">Carta de seci&oacute;n de derechos:</label>';
     	$response .= '<p class="form-control-static">';
     	//                                <a href="">test</a></p>
     	if (!empty($idArticulo)) {
     		$cartaDerechos = $this->model->get_carta_derechos($idArticulo);
     		if (!$cartaDerechos) {
     			$response .= 'No hay carta de seci&oacute;n de derechos';
     		}else{
     			$response .= '<a href="docs/'.$cartaDerechos.'"><span class="glyphicon glyphicon-download-alt"></span> Descargar</a>';
     		}
     	}else{
     		error_log('Error no se esta mandando el id del art&iacute;culo : getCartaDerechos');
     	}
     	$response .= '</p>';
     	$response .= '</div>';
     	echo $response;
     }
     
     function getEstatusCartas() {
     	$idArticulo = $_POST['id'];
     	$responseDB = $this->model->get_estatus_cartas($idArticulo);
     	if (!empty($responseDB)) {
     		$validado=$responseDB['validado'];
     	}else{
     		$validado="no";
     	}
     		
     	echo $validado;
     }

     function updateEstatusCartas() {
     	$idArticulo = $_POST['idArticulo'];
     	$estatus= $_POST['status'];
     	$responseDB = $this->model->update_estatus_cartas($idArticulo, $estatus);
     	$response = 'false';
     	if ($responseDB) {
     		$response = 'true';
     	}
     	echo $response;
     }
 
     function subir_carta_aceptacion() {
     	$response = '';
     	$idArticulo = $_POST['idArticulo'];
     	if (!empty($idArticulo)) {
     		$existeCarta = $this->model->existe_carta_aceptacion($idArticulo);
     		if ($existeCarta != FALSE) {
     			try {
     				if(!empty($existeCarta['doc_carta_aceptacion']))
     					unlink(DOCS . $existeCarta['doc_carta_aceptacion']);
     			} catch (Exception $exc) {
     				error_log($exc->getTraceAsString());
     			}
     		}
     		$file = $_FILES[0]['name'];
     		$formatoArchivo = explode('.', $file);
     		$formatoArchivo = end($formatoArchivo);
     		if ($formatoArchivo != 'pdf') {
     			echo 'error-formato-archivo';
     		} else {
     			if (!move_uploaded_file($_FILES[0]['tmp_name'], DOCS . $idArticulo . '/' . $file)) {
     				echo 'error-subir-archivo';
     			} else {
     				$this->model->registro_carta_aceptacion($idArticulo, $idArticulo . '/' . $file);
     				echo 'true';
     			}
     		}
     	} else {
     		$response = 'error-null';
     	}
     	echo $response;
     }
      
     function getCartaAceptacion() {
     	$idArticulo = $_POST['id'];
     	$cartaAceptacion = $this->model->existe_carta_aceptacion($idArticulo);
     	$response = '<div class="col-sm-6">';
     	$response .= '<h5 class="text-primary">Carta de aceptaci&oacute;n:</h5>';
     	if(empty( $cartaAceptacion['doc_carta_aceptacion'])){
     		$response .= '<p>No hay ningun documento</p>';
     	}else{
     		if (!$cartaAceptacion) {
     			$response .= '<p>No hay ningun documento</p>';
     		} else {
     			$cartaAceptacion = explode('/', $cartaAceptacion['doc_carta_aceptacion']);
     			$response .= '<p>' . $cartaAceptacion[1] . '</p>';
     		}
     	}
     	$response .= '</div>';
     	echo $response;
     }
      
     function fncSendComentario(){
     	//VALIDA SI EL CAMPO DE RECIBIDO ESTA CHECADO y ENVIA CORREO AL USUARIO
     	$idArticulo=$_POST['idArticulo'];
     	$comentario=$_POST['comentario'];
     	$enviado="Correo-no";
     	$responseDB=$this->model->fncGetCorreoAutor($idArticulo);
     	if($responseDB[0]['CORREO']!=NULL){
     		$asunto="Validaci&oacute;n de cartas de aceptaci&oacute;n y originalidad";
     		$mensaje="<h1>Estimado autor:</h1><h2>".$comentario."</h2>".
     		  		  "<h3>atte.<br /> Comit&eacute; Organizador CICA 2016.<br />UTSOE</h3>";
     		$mensaje1="Estimado autor:".$comentario.
     		          "atte. Comit&eacute; Organizador CICA 2016.   UTSOE";
     		$enviado=$this->fncSendMail($responseDB[0]['CORREO'],$asunto,$mensaje,$mensaje1);
     	}
     	echo $enviado;
     }
     
     function fncSendMail($correo,$asunto,$mensaje,$mensajeSinF){
     	try {
     		$mail = new PHPMailer;
     		$mail->SetFrom("contacto@cica2016.org", "CICA2016");
     		$mail->FromName = "CICA2016";
     		$mail->addAddress($correo);
     		$mail->addCC('contacto@cica2016.org');
     		$mail->isHTML(true);
     		$mail->Subject =html_entity_decode($asunto);
     		$mail->Body = $mensaje;
     		$mail->AltBody =$mensajeSinF;
     		$mail->CharSet = 'UTF-8';
     		$exito = $mail->Send();
     		if($exito)
     			$enviado="Correo-ok";
     			else
     				$enviado="Correo-bad";
     	} catch (Exception $e) {
     		$enviado=$e->getMessage();
     	}
     	return $enviado;
     
     }     
     
}
