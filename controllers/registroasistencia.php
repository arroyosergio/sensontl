<?php

class Registroasistencia extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
        $logged = Session::get("sesion");
        if (!$logged) {
            Session::destroy();
            header("location: index");
            exit;
        }
        $this->view->css = array(
            'public/plugins/toastr/toastr.min.css',
            'public/plugins/datatable/jquery.datatables.min.css',
            'public/plugins/datapicker/bootstrap-datepicker.min.css',
        );
        $this->view->js = array(
            'public/plugins/toastr/toastr.min.js',
            'public/plugins/datapicker/bootstrap-datepicker.min.js',
            'public/plugins/datapicker/bootstrap-datepicker.es.min.js',
            'public/plugins/timepicker/wickedpicker.js',
            'public/plugins/datatable/jquery.datatables.min.js',
            'views/registroasistencia/js/registroasistencia.js'
        );
    }

    function index() {
        $this->view->datosArticulo = $this->getDatosArticulo($_GET['id']);
        $this->view->tablaAsistentes = $this->getAsistentesArticulo(TRUE);
        $this->view->monto = $this->getMonto(true);
        $this->view->render("registroasistencia/index");
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
        if (!empty($nombre) && !empty($institucion) && !empty($tipoAsistente)) {
            $asistente = array(
                'nombre' => $nombre,
//                   'correo' => $correo,
                'institucion' => $institucion,
                'tipoAsistente' => $tipoAsistente
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
            echo 'error-null';
        }
    }

    function getAsistentesArticulo($get = FALSE) {
        $responseDB = $this->model->get_asistentes_articulo();
        if (!$responseDB) {
//               No hay asistentes
            $response = '';
        } else {
            $response = '';
            foreach ($responseDB as $asistente) {
                $response .= '<tr>';
                $response .= '<td class="text-center">' . $asistente['asi_nombre'] . '</td>';
                $response .= '<td class="text-center">' . $asistente['asi_institucion'] . '</td>';
                $response .= '<td class="text-center">' . $asistente['asi_tipo'] . '</td>';
                if ($this->getEstatusCambios(TRUE) == 'si') {
                    $response .= '<td class="text-center"><label id="editar|' . $asistente['asi_id'] . '" class="btn btn-link"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Editar</label></td>';
                    $response .= '<td class="text-center"><label id="borrar|' . $asistente['asi_id'] . '" class="btn btn-link"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Borrar</label></td>';
                } else {
                    $response .= '<td class="text-center"></td>';
                    $response .= '<td class="text-center"></td>';
                }
                $response .= '</tr>';
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
                    'id' => $responseDB['asi_id'],
                    'nombre' => $responseDB['asi_nombre'],
                    'institucion' => $responseDB['asi_institucion'],
                    'tipo' => $responseDB['asi_tipo']
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
        $id = $_POST['id'];
        $nombre = $_POST['nombre-asistente'];
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
                'tipoPago' => $_POST['tipo-pago'],
                'info' => $_POST['info-deposito'],
                'monto' => $this->getMonto(true),
                'fecha' => $_POST['fecha'],
                'hora' => "$_POST[hora]:$_POST[minuto]",
                'numSucursal' => $_POST['num-sucursal'],
                'numTransaccion' => $_POST['num-transaccion'],
                'comprobante' => $_FILES['comprobante']['name'],
                'idArticulo' => Session::get('idArticulo')
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
                        if (strtolower($extencion) != 'pdf') {
//                    Error tipo de archivo
                            echo 'error-formato';
                        } else {
                            $deposito['comprobante'] = Session::get('idArticulo') . '/' . $deposito['comprobante'];
                            $responseDB = $this->model->registro_datos_deposito($deposito);
                            if ($responseDB) {
                                $responseDB = $this->model->registro_datos_facturacion($facturacion);
                                if ($responseDB) {
                                    $this->updateEstatusAsistencia('si');
                                    if (!move_uploaded_file($_FILES['comprobante']['tmp_name'], DOCS . Session::get('idArticulo') . '/' . $deposito['comprobante'])) {
//                    Error al subir el archivo
                                        echo 'error-subir-archivo';
                                    } else {
                                        echo 'true';
                                    }
                                } else {
//                                   Error consulta datos facturacion
                                    echo 'false';
                                }
                            } else {
//                              Error consulta datos deposito
                                echo 'false';
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

    function updateDatosPago() {
        $comprobante = $this->model->get_comprobante(Session::get('idArticulo'));
//        Valida si se subio un nuevo archivo
        $archivoNuevo = (empty($_FILES['comprobante']) ? 'no' : 'si');
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
                'comprobante' => (empty($_FILES['comprobante']['name']) ? $comprobante : $_FILES['comprobante']['name']),
                'idArticulo' => Session::get('idArticulo')
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
                        if ($archivoNuevo == 'si') {
                            if (strtolower($extencion) != 'pdf') {
                                echo 'error-formato';
                            } else {
                                if (!move_uploaded_file($_FILES['comprobante']['tmp_name'], DOCS . Session::get('idArticulo') . '/' . $deposito['comprobante'])) {
                                    echo 'error-subir-archivo';
                                } else {
                                    if ($comprobante != Session::get('idArticulo') . '/' . $_FILES['comprobante']['name']) {
                                        unlink(DOCS . $comprobante);
                                    }
                                    $deposito['comprobante'] = Session::get('idArticulo') . '/' . $deposito['comprobante'];
                                }
                            }
                        }

//                        $deposito['comprobante'] = Session::get('idArticulo') . '/' . $deposito['comprobante'];
                        $responseDB = $this->model->update_datos_deposito($deposito);
                        if ($responseDB) {
                            $responseDB = $this->model->update_datos_facturacion($facturacion);
                            if ($responseDB) {
                                $this->updateEstatusAsistencia('si');
                                $this->model->update_estatus_cambios(Session::get('idArticulo'), 'no');
//                                unlink(DOCS . $comprobante);
                                echo 'true';
                            } else {
//                                   Error consulta datos facturacion
                                echo 'false';
                            }
                        } else {
//                              Error consulta datos deposito
                            echo 'false';
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
        $responseDB = $this->model->get_estatus_registro(Session::get('idArticulo'));
        if ($get) {
            return $responseDB;
        } else {
            echo $responseDB;
        }
    }

    function getMonto($get = FALSE) {
        $asistentesPonente = $this->model->get_total_asistentes(Session::get('idArticulo'), 'ponente');
        $asistentesGeneral = $this->model->get_total_asistentes(Session::get('idArticulo'), 'general');
        $asistentesCoautor = $this->model->get_total_asistentes(Session::get('idArticulo'), 'coautor');
        $fecha_actual = new DateTime('now', new DateTimeZone('America/Mexico_City'));
        $fecha_actual->format('Y-m-d');
        $fechaAgosto = new DateTime('2017-08-19');
        //$fecha = date('d/m/Y', strtotime('-1 days'));
        $monto = 0;
        //$fechaAgosto = date('d/m/Y');
        if ($fecha_actual <= $fechaAgosto) {
            //$fechaAgosto = date('d/m/Y');
            //if ($fecha <= $fechaAgosto) {
            $monto = 2500 * $asistentesPonente;
            $monto += 2200 * $asistentesGeneral;
            $monto += 2200 * $asistentesCoautor;
        } else {
            $monto = 2900 * $asistentesPonente;
            $monto += 2600 * $asistentesGeneral;
            $monto += 2600 * $asistentesCoautor;
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
