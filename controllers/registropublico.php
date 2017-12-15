<?php
class registropublico extends Controller {


    function __construct() {
        parent::__construct();
        Session::init();
        /*$logged = 
        Session::get("sesion");
        if (!$logged) {
            Session::destroy();
            header("location: index");
            exit;
        }*/
       
        $this->view->css = array(
            'public/plugins/toastr/toastr.min.css',
            'public/plugins/datatable/jquery.datatables.min.css',
            'public/plugins/datapicker/bootstrap-datepicker.min.css',
        );
        $this->view->js = array(
            'public/plugins/toastr/toastr.min.js',
            'public/plugins/datapicker/bootstrap-datepicker.min.js',
            'public/plugins/datapicker/bootstrap-datepicker.es.min.js',
            'public/plugins/datatable/jquery.datatables.min.js',
            'views/registropublico/js/registropublico.js'
        );
    }

    function index() {
    	$this->view->tablaAsistentes = $this->getAsistentesPublico(true);
    	$this->view->monto = $this->getMonto(true);
        $this->view->render("registropublico/index");
    }

    function getDatosArticulo($id) {
//        $responseDB = $this->model->get_datos_articulo(Session::get('idAutor'));
        $responseDB = $this->model->get_datos_articulo($id);
        $articulo = array(
            'id' => $responseDB['artId'],
            'nombre' => $responseDB['artNombre'],
            'tipo' => $responseDB['artTipo'],
        );
        Session::set('idArticulo', $articulo['id']);
        $response = '<div class="row">';
        $response .= '<div class="col-sm-4">';
        $response .= '<label for="">Id del art&iacute;culo:</label>';
        $response .= '<p class="form-static-control">' . $articulo['id'] . '</p>';
        $response .= '</div>';
        $response .= '<div class="col-sm-4">';
        $response .= '<label for="">Nombre del art&iacute;culo:</label>';
        $response .= '<p class="form-static-control">' . $articulo['nombre'] . '</p>';
        $response .= '</div>';
        $response .= '<div class="col-sm-4">';
        $response .= '<label for="">Modalidad de presentaci&oacute;n:</label>';
        $response .= '<p class="form-static-control">' . strtoupper($articulo['tipo']) . '</p>';
        $response .= '</div>';
        $response .= '</div>';

        return $response;
    }

    function nuevoAsistente() {
        $nombre = $_POST['nombre-asistente'];
        $institucion = $_POST['institucion'];
        $tipoAsistente = $_POST['tipo-asistente'];
        //VALIDA QUE NO PUEDEN CAPTURAR MAS DE 10 ASISTENTES
        if(Session::get('idRegistroPublico')){
        	$arNombre= explode(" ", $nombre);
        	$nombre_sin_esp="";
            foreach($arNombre as $datos => $valor){ 
                 $nombre_sin_esp.=$valor; 
            } 
        	$asist_encontrado=$this->model->get_buscar_asistente(strtoupper($nombre_sin_esp));
        	if($asist_encontrado){
        		echo 'error-replicado';
        		return;
        	}
        	$cantRegistro=$this->model->get_total_asistentes_pub(Session::get('idRegistroPublico'));
        	if($cantRegistro >10){
        		echo 'error-cantidad';
        		return;
        	}
        }

        if (!empty($nombre)  && !empty($tipoAsistente)) {
            if(!Session::get('idRegistroPublico')){
            	$responseDB = $this->model->nuevo_registro();
            }
            $asistente = array(
            		'nombre' => $nombre,
            		'institucion' => $institucion,
            		'tipoAsistente' => $tipoAsistente,
            		'reg_id' => Session::get('idRegistroPublico')
            );
            $responseDB = $this->model->regitro_asistente($asistente);
            if ($responseDB) {
                echo 'true';
            } else {
//                         Error al ejecutar la consulta
                echo 'error-query';
            }
        } else {
//                    Falta algun valor
//             echo 'error-null';
        }
    }
    
    function getAsistentesPublico($get = FALSE) {
    	if(!Session::get('idRegistroPublico') ){
    		$response = '';
    	}else{
    		$responseDB = $this->model->get_asistentes_publico();
    		if (!$responseDB) {
    			//               No hay asistentes
    			$response = '';
    		} else {
    			$response = '';
    			foreach ($responseDB as $asistente) {
    				$response .= '<tr>';
    				$response .= '<td class="text-center">' . $asistente['reg_nombre'] . '</td>';
    				$response .= '<td class="text-center">' . $asistente['reg_institucion'] . '</td>';
    				$response .= '<td class="text-center">' . $asistente['reg_tipo'] . '</td>';
    				$response .= '<td class="text-center"><label id="editar|' . $asistente['id'] . '" class="btn btn-link"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar</label></td>';
    				$response .= '<td class="text-center"><label id="borrar|' . $asistente['id'] . '" class="btn btn-link"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Borrar</label></td>';
    				$response .= '</tr>';
    			}
    		}
    	}
        if ($get) {
            return $response;
        } else {
            echo $response;
        }
    }

    function getDatosAsistente() {
        $id = $_POST['id'];
        $response = '';
        if (!empty($id)) {
            $responseDB = $this->model->get_datos_asistente($id);
            if (!$responseDB) {
//                    No se encontro el registro
                echo 'error-registro';
            } else {
                $asistente = array(
                    'id' => $responseDB['id'],
                    'nombre' => $responseDB['reg_nombre'],
                    'institucion' => $responseDB['reg_institucion'],
                    'tipo' => $responseDB['reg_tipo']
                );
                echo json_encode($asistente);
            }
        }
    }

    function borrarAsistente() {
        $id = $_POST['id'];
        $response = '';
        if (!empty($id)) {
            $responseDB = $this->model->borrar_asistente($id);
            if ($responseDB) {
                $response = 'true';
            } else {
                $response = 'false';
            }
        } else {
            error_log('ERROR: borrar asistente id vacio');
            $response = 'error-query';
        }
        echo $response;
    }

    function updateAsistente() {
        $id = $_POST['id-asistente'];
        $nombre = $_POST['nombre-edit'];
        $institucion = $_POST['institucion'];
        $tipo = $_POST['tipo-asistente'];
        if (!empty($id) && !empty($nombre) && !empty($institucion) && !empty($tipo)) {
            $asistente = array(
                'id' => $id,
                'nombre' => $nombre,
                'institucion' => $institucion,
                'tipo' => $tipo
            );
            $responseDB = $this->model->update_asistente($asistente);
            if (!$responseDB) {
//                         Error query
                echo 'error';
            } else {
                echo 'true';
            }
        } else {
//               Error datos incompletos
            echo 'error-null';
        }
    }

    function registroDatosPago() {
        if (!empty($_POST['correo']) && 
                !empty($_POST['tipo-pago']) && 
                !empty($_POST['razon-social']) && 
                !empty($_POST['rfc']) && 
                !empty($_POST['calle']) && 
                !empty($_POST['numero']) && 
                !empty($_POST['colonia']) && 
                !empty($_POST['municipio']) && 
                !empty($_POST['estado']) && 
                !empty($_POST['codigo-postal']) && 
                !empty($_POST['banco']) && 
                !empty($_POST['info-deposito']) && 
                !empty($_POST['fecha']) && 
                !empty($_POST['hora']) &&
                !empty($_POST['minuto']) &&
                !empty($_POST['num-sucursal']) &&
                !empty($_POST['num-transaccion'])) {
            
            $deposito = array(
                'banco' => $_POST['banco'],
                'sucursal' => $_POST['num-sucursal'],
                'transaccion' => $_POST['num-transaccion'],
                'tipoPago' => $_POST['tipo-pago'],
                'info' => $_POST['info-deposito'],
                'monto' => $this->getMonto(true),
                'fecha' => $_POST['fecha'],
                'hora' => "$_POST[hora]:$_POST[minuto]",
                'comprobante' => $_FILES['comprobante']['name'],
                'idArticulo' => Session::get('idArticulo')
            );
            error_log(print_r($deposito,true));

            $facturacion = array(
                'correo' => $_POST['correo'],
                'razonSocial' => $_POST['razon-social'],
                'rfc' => $_POST['rfc'],
                'calle' => $_POST['calle'],
                'numero' => $_POST['numero'],
                'colonia' => $_POST['colonia'],
                'municipio' => $_POST['municipio'],
                'estado' => $_POST['estado'],
                'cp' => $_POST['codigo-postal'],
                'idArticulo' => Session::get('idArticulo')
            );
            $extencion = explode('.', $deposito['comprobante']);
            $extencion = end($extencion);
            $correoValido = $this->comprobarCorreo($facturacion['correo']);
            $asistentesGeneral = $this->model->get_total_asistentes(Session::get('idArticulo'), 'general');
            $asistentesPonente = $this->model->get_total_asistentes(Session::get('idArticulo'), 'ponente');
            $asistentesCoautor = $this->model->get_total_asistentes(Session::get('idArticulo'), 'coautor');

            $totalAsistentes = $asistentesCoautor + $asistentesGeneral + $asistentesPonente;
            if ($totalAsistentes > 0) {
                $validacionPonente = $this->model->get_total_asistentes(Session::get('idArticulo'), 'ponente');
                if ($validacionPonente > 0) {
                    if ($correoValido) {
                        if (strtolower($extencion)  != 'pdf') {
//                    Error tipo de archivo
                            echo 'error-formato';
                        } else {
                            if (!move_uploaded_file($_FILES['comprobante']['tmp_name'], DOCS . Session::get('idArticulo') . '/' . $deposito['comprobante'])) {
//                    Error al subir el archivo
                                echo 'error-subir-archivo';
                            } else {
                                $deposito['comprobante'] = Session::get('idArticulo') . '/' . $deposito['comprobante'];
                                $responseDB = $this->model->registro_datos_deposito($deposito);
                                if ($responseDB) {
                                    $responseDB = $this->model->registro_datos_facturacion($facturacion);
                                    if ($responseDB) {
                                        $this->updateEstatusAsistencia('si');
                                        echo 'true';
                                    } else {
//                                   Error consulta datos facturacion
                                        echo 'false';
                                    }
                                } else {
//                              Error consulta datos deposito
                                    echo 'false';
                                }
                            }
                        }
                    } else {
//                    Correo invalido
                        echo 'error-correo';
                    }
                } else {
//                    No hay ningún ponente registradp
                    echo 'error-ponente';
                }
            } else {
//                    Error ningun asistente registrado
                echo 'error-num-asistentes';
            }
        } else {
//               Error de datos incompletos
            echo 'error-null';
        }
    }
    
    function validarFechas($fecha)
    {
    	$formatoValido=false;
        $dmy= explode("/", $fecha);
        if(count($dmy)>2)
        {
        	If (checkdate ($dmy[1],$dmy[0],$dmy[2]))
        	$formatoValido= true;
        	else
        		$formatoValido= false;
        }else{
        	$formatoValido= false;
        }
        return $formatoValido;
    }
    
    function updateDatosPago() {
    	//VALIDA FORMATO DE FECHA
    	if(!$this->validarFechas($_POST['fecha'])){
    		echo 'error-formato-fecha';
    		return ;
    	}
    	$dmy= explode("/", $_POST['fecha']);
     	$fechaDeposito = new DateTime($dmy[1].'/'.$dmy[0].'/'.$dmy[2]);

        if (!empty($_POST['correo']) && !empty($_POST['banco']) && !empty($_POST['info-deposito'])  && !empty($_POST['fecha'])) {
            $deposito = array(
                'banco' => $_POST['banco'],
                'sucursal' => $_POST['num-sucursal'],
                'transaccion' => $_POST['num-transaccion'],
                'tipoPago' => $_POST['tipo-pago'],
                'info' => $_POST['info-deposito'],
                'monto' => $this->getMonto(true),
                'fecha' => $fechaDeposito->format('Y-m-d'),
                'hora' => "$_POST[hora]:$_POST[minuto]",
                'comprobante' => Session::get('idRegistroPublico')."_deposito.pdf",
                //$_FILES['comprobante']['name'],
                'reg_id' => Session::get('idRegistroPublico')
            );
            $facturacion = array(
                'correo' => $_POST['correo'],
                'razonSocial' => $_POST['razon-social'],
                'rfc' => $_POST['rfc'],
                'calle' => $_POST['calle'],
                'numero' => $_POST['numero'],
                'colonia' => $_POST['colonia'],
                'municipio' => $_POST['municipio'],
                'estado' => $_POST['estado'],
                'cp' => $_POST['codigo-postal'],
                'reg_id' => Session::get('idRegistroPublico')
            );
            $extencion = explode('.', $deposito['comprobante']);
            $extencion = end($extencion);
            $correoValido = $this->comprobarCorreo($facturacion['correo']);
            $asistentesGeneral = $this->model->get_total_asistentes(Session::get('idRegistroPublico'), 'general');
            $totalAsistentes =  $asistentesGeneral ;
            if ($totalAsistentes > 0) 
            {
                    if ($correoValido) 
                    {
                         if (strtolower($extencion) != 'pdf') 
                         {
                                echo 'error-formato';
                         } else {
                                if (!move_uploaded_file($_FILES['comprobante']['tmp_name'], DOCS . 'dep_publico/' . Session::get('idRegistroPublico')."_deposito.pdf")) 
                                {
                                    echo 'error-subir-archivo';
                                    
                                }else
                                {
                                	$responseDB = $this->model->registro_datos_deposito($deposito);
                                	if ($responseDB) {
                                		$responseDB = $this->model->registro_datos_facturacion($facturacion);
                                		if ($responseDB) 
                                		{
                                			Session::destroy();
                                			echo 'true';
                                		} else {
                                			//                                   Error al insertar los datos de facturacion
                                			echo 'false';
                                		}
                                	} else {
                                		//                              Error al consulta datos de deposito
                                		echo 'false';
                                	}                                	
                                    $deposito['comprobante'] =  Session::get('idRegistroPublico')."_deposito.pdf";
                                }
                        }
                  } else {
//                    Correo invalido
                        echo 'error-correo';
                  }
            } else {
//                    Error ningun asistente registrado
                echo 'error-num-asistentes';
            }
        } else {
//               Error de datos incompletos
            echo 'error-null';
        }
    }

    function updateEstatusAsistencia($estatus) {
        $this->model->update_estatus_asitencia(Session::get('idArticulo'), $estatus);
    }

    function getEstatusCambios($get = FALSE) {
        $responseDB = $this->model->get_estatus_cambios(Session::get('idArticulo'));
        if ($get) {
            return $responseDB;
        } else {
            echo $responseDB;
        }
    }
    
    function getEstatusRegistro($get = FALSE) {
        $responseDB = $this->model->get_estatus_registro(Session::get('idRegistroPublico'));
        if ($get) {
            return $responseDB;
        }else{
            echo $responseDB;
        }
    }

    function getMonto($get = FALSE) {
    	if(!Session::get('idRegistroPublico') ){
    		$monto = 0;
    	}else{
    		$asistentesPonente = $this->model->get_total_asistentes(Session::get('idRegistroPublico'), 'ponente');
    		$asistentesGeneral = $this->model->get_total_asistentes(Session::get('idRegistroPublico'), 'general');
    		$asistentesCoautor = $this->model->get_total_asistentes(Session::get('idRegistroPublico'), 'coautor');
    		$fecha_actual = new DateTime('now', new DateTimeZone('America/Mexico_City'));
    		$fecha_actual->format('Y-m-d');
    		$fechaSeptiembre = new DateTime('2017-09-11');
    		//$fecha = date('d/m/Y', strtotime('-1 days'));
    		$monto = 0;
    		//$fechaAgosto = date('d/m/Y');
    		if ($fecha_actual <= $fechaSeptiembre) {//if ($fecha <= $fechaAgosto) {
    			$monto = 2500 * $asistentesPonente;
    			$monto += 2200 * $asistentesGeneral;
    			$monto += 2200 * $asistentesCoautor;
    		} else {
    			$monto = 2900 * $asistentesPonente;
    			$monto += 2600 * $asistentesGeneral;
    			$monto += 2600 * $asistentesCoautor;
    		}
    	}
        if ($get) {
            return $monto;
        } else {
            echo $monto;
        }
    }

    function getDatosDeposito() {
        $responseDB = $this->model->get_datos_deposito(Session::get('idArticulo'));
        if (!$responseDB) {
//                Error no hay registro 
            error_log("No hay registro de datos del deposito: fnc getDatosDeposito");
            $response = 'false';
        } else {
            $horaMinuto = explode(':', $responseDB['dep_hora']);
            $deposito = array(
                'id' => $responseDB['dep_id'],
                'banco' => $responseDB['dep_banco'],
                'sucursal' => $responseDB['dep_sucursal'],
                'transaccion' => $responseDB['dep_transaccion'],
                'tipoPago' => $responseDB['dep_tipo'],
                'info' => $responseDB['dep_info'],
                'fecha' => $responseDB['dep_fecha'],
                'hora' => $horaMinuto[0],
                'minuto' => $horaMinuto[1],
                'monto' => $responseDB['dep_monto'],
                'comprobante' => $responseDB['dep_comprobante']
            );
            $response = $deposito;
        }

        echo json_encode($response);
    }

    function getDatosFacturacion() {
        $responseDB = $this->model->get_datos_facturacion(Session::get('idArticulo'));
        $response = '';
        if (!$responseDB) {
//            Error, consulta vacia 
            error_log("getDatosFacturacion: posible error con la consulta ó esta vacia");
            $response = 'false';
        } else {
            $facturacion = array(
                'id' => $responseDB['fac_id'],
                'razonSocial' => $responseDB['fac_razon_social'],
                'correo' => $responseDB['fac_correo'],
                'rfc' => $responseDB['fac_rfc'],
                'calle' => $responseDB['fac_calle'],
                'numero' => $responseDB['fac_numero'],
                'colonia' => $responseDB['fac_colonia'],
                'municipio' => $responseDB['fac_municipio'],
                'estado' => $responseDB['fac_estado'],
                'cp' => $responseDB['fac_cp'],
            );
            $response = $facturacion;
        }
        echo json_encode($response);
    }

    function comprobarCorreo($correo) {
        $correoCorrecto = 0;
        if ((strlen($correo) >= 6) && (substr_count($correo, '@') == 1) && (substr($correo, 0, 1) != '@') && (substr($correo, strlen($correo) - 1, 1) != '@')) {
            if ((!strstr($correo, "'")) && (!strstr($correo, "\"")) && (!strstr($correo, "\\")) && (!strstr($correo, "\$")) && (!strstr($correo, " "))) {
                if (substr_count($correo, ".") >= 1) {
                    $term_dom = substr(strrchr($correo, '.'), 1);
                    if (strlen($term_dom) > 1 && strlen($term_dom) < 5 && (!strstr($term_dom, '@'))) {
                        $antes_dom = substr($correo, 0, strlen($correo) - strlen($term_dom) - 1);
                        $caracter_ult = substr($antes_dom, strlen($antes_dom) - 1, 1);
                        if ($caracter_ult != '@' && $caracter_ult != '.') {
                            $correoCorrecto = 1;
                        }
                    }
                }
            }
        }
        if ($correoCorrecto) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
	