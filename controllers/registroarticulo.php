<?php

class Registroarticulo extends Controller {

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
			'public/bootstrap/css/bootstrap.min.css',
            'public/fontawesome/css/font-awesome.min.css',
            'public/css/animate.min.css',
            'public/css/fluidbox.min.css',
            'public/plugins/datatable/jquery.datatables.min.css',
            'views/registroarticulo/css/registroarticulo.css',
		    'views/registroarticulo/css/menu.css'			
        );
        $this->view->js = array(
			'public/js/jquery-2.1.4.min.js',
			'public/bootstrap/js/bootstrap.min.js',
            'views/registroarticulo/js/registroarticulo.js'
        );
    }

    function index() {
        $this->view->selectPaises = $this->selectPaises();
        $this->view->render("registroarticulo/index");
    }

    function selectPaises() {
        $responseDB = $this->model->get_paises();
        $select = '';
        $select = '<option value="">Selecciona uno</option>';
        foreach ($responseDB as $pais) {
            $select .= '<option value="' . $pais['pais_id'] . '">' . utf8_encode($pais['pais_nombre']) . '</optioin>';
        }
        return $select;
    }

    function getEstados() {
        $codigoPais = $_POST['codigo'];
        $responseDb = $this->model->get_estados($codigoPais);
        $select = '<option value="">Selecciona uno</optioin>';
        foreach ($responseDb as $estado) {
            $select .= '<option value="' . $estado['est_nombre'] . '">' . utf8_encode($estado['est_nombre']) . '</optioin>';
        }
        echo $select;
    }

    function getCiudades() {
        $codigoEstado = $_POST['codigo'];
        $responseDB = $this->model->get_ciudades($codigoEstado);
        $select = '<option value="">Selecciona uno</optioin>';
        foreach ($responseDB as $ciudad) {
            $select .= '<option value="' . $ciudad['Name'] . '">' . $ciudad['Name'] . '</optioin>';
        }
        echo $select;
    }

	
	function updloadFile(){
	
		$idArticulo = $_POST['id-articulo'];
        $file = $_FILES['archivo']['name'];
		mkdir(DOCS.$idArticulo, 0777, TRUE);
		if (!move_uploaded_file($_FILES['archivo']['tmp_name'], DOCS .$idArticulo .'/v1_'. $file)) {
		    echo 'error-subir-archivo';
		} else {
		    $file = $idArticulo . '/'. 'v1_'.$file;
		    $this->model->registro_version_articulo($idArticulo, $file);
			echo $idArticulo;
		}
		 
		
		/*if(!empty($_FILES['uploaded_file']))
			  {
				$path = "uploads/";
				$path = $path . basename( $_FILES['uploaded_file']['name']);
				if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
				  echo "The file ".  basename( $_FILES['uploaded_file']['name']). 
				  " has been uploaded";
				} else{
					echo "There was an error uploading the file, please try again!";
				}
			  }*/
		
		
		
	/*
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
	*/	
		
		
	}
	
    function registroArticulo() {
        $nombreArticulo = strtoupper($_POST['nombre']);
        $area = $_POST['area-tematica'];
        $tipo = $_POST['tipo-articulo'];
        //$file = $_FILES['archivo']['name'];
        //if (empty($nombreArticulo) || empty($area) || empty($tipo)) {
        //    echo 'error-null';
        //} else {
            $existeArticulo = $this->model->existe_articulo($nombreArticulo);
            if ($existeArticulo) {
                echo 'error-articulo-repetido';
            } else {
                //if (empty($file)) {
                //    echo 'error-archivo';
                //} else {
                    //$formatoArchivo = explode('.', $file);
                    //$formatoArchivo = end($formatoArchivo);
                    //if ($formatoArchivo != 'docx' && $formatoArchivo != 'doc') {
                    //    echo 'error-formato-archivo';
                    //} else {
                        $articulo = array(
                            'nombre' => $nombreArticulo,
                            'area' => $area,
                            'idAutor' => Session::get('idAutor'),
                            'tipo' => $tipo
                        );
                        $responseDB = $this->model->registro_articulo($articulo);
                        if (!$responseDB) {
                            echo 'error-registro';
                        } else {
                            $idArticulo = $responseDB;
                            //mkdir(DOCS.$idArticulo, 0777, TRUE);
                            //if (!move_uploaded_file($_FILES['archivo']['tmp_name'], DOCS .$idArticulo .'/v1_'. $file)) {
                            //    echo 'error-subir-archivo';
                            //} else {
                            //    $file = $idArticulo . '/'. 'v1_'.$file;
                            //    $this->model->registro_version_articulo($idArticulo, $file);
                                $this->model->registro_tabla_documentos($idArticulo);
                                $idAutor = $this->model->get_id_autor(Session::get('id'));
                                $responseDB = $this->model->registro_autor_articulo($idArticulo, $idAutor);
//                            falta verificar el insert
                                echo $idArticulo;
//                                echo 'true';
                            //}
                        }
                   // }
                //}
            }
       // }
    }

    function registroAutor() {
//        $idArticulo = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellidoPaterno = $_POST['apellido-paterno'];
        $apellidoMaterno = $_POST['apellido-materno'];
        $ciudad = $_POST['ciudad'];
        $estado = $_POST['estado'];
        $pais = $_POST['pais'];
        $correo = $_POST['correo'];
        $gradoAcademico = $_POST['grado-academico'];
        $institucionProcedencia = $_POST['institucion-procedencia'];
        $tipoInstitucion = $_POST['tipo-institucion'];
        $asistenciaCica = $_POST['asistencia-cica'];
        if (!empty($nombre) && !empty($apellidoPaterno) && !empty($apellidoMaterno) && !empty($ciudad) && !empty($estado) && !empty($pais) && !empty($gradoAcademico) && !empty($institucionProcedencia) && !empty($tipoInstitucion) && !empty($asistenciaCica) && !empty($correo)) {
            if ($this->comprobarCorreo($correo)) {
                $autor = array(
                    'nombre' => $nombre,
                    'apellidoPaterno' => $apellidoPaterno,
                    'apellidoMaterno' => $apellidoMaterno,
                    'institucionProcedencia' => $institucionProcedencia,
                    'ciudad' => $ciudad,
                    'estado' => $estado,
                    'pais' => $pais,
                    'correo' => $correo,
                    'gradoAcademico' => $gradoAcademico,
                    'tipoInstitucion' => $tipoInstitucion,
                    'asistenciaCica' => $asistenciaCica
                );
                $totalAutores = $this->model->get_total_autores($idArticulo);
                if ($totalAutores < 4) {
//                  Verifica si el autor no esta registrado para ese articulo
                    $existeAutor = $this->model->existe_autor_articulo($idArticulo, $nombre, $apellidoPaterno, $apellidoMaterno);
                    if ($existeAutor) {
                        echo 'error-autor-registrado';
                    } else {
                        $responseDB = $this->model->registro_autor($autor);
                        if (!$responseDB) {
                            echo 'error-registro';
                        } else {
                            $responseDB = $this->model->registro_autor_articulo($idArticulo, $responseDB);
                            echo 'true';
                        }
                    }
                } else {
                    echo 'error-numero-autores';
                }
            } else {
                echo 'error-correo';
            }
        } else {
            echo 'error-null';
        }
    }
    
    function getAutoresArticulo() {
        $idArticulo = $_POST['id'];
        $response = '';
        if (!empty($idArticulo)) {
            $responseDB = $this->model->get_autores_articulo($idArticulo);
            foreach ($responseDB as $autor) {
                $response .= '<li class="list-group-item" value="'.$autor['autId'].'">';
                $response .= $autor['autNombre'] .' '.$autor['autApellidoPaterno'].' '.$autor['autApellidoMaterno'];
//                $response .= '<a href="#" id="borrar-autor" class="pull-right borrar-autor"><i class="glyphicon glyphicon-trash"></i> Borrar<a/>&nbsp;&nbsp;';
                $response .= '<label class="pull-right"><input type="radio" name="auto-contacto" value="'.$autor['autId'].'" checked>Autor de contacto</label>';
                $response .= '</li>';
            }
        }
        
        echo $response;
    }
    
    function getDetallesArticulo() {
        $idArticulo = $_POST['id'];
        $responseDB = $this->model->get_detalles_articulo($idArticulo);
        $response = array(
            'nombre' => $responseDB['artNombre'],
            'area' => $responseDB['artAreaTematica'],
            'archivo' => $responseDB['artArchivo'],
            'tipo' => $responseDB['artTipo']
        );
        
        echo json_encode($response);
    }
    
    function borrarRegistroArticulo() {
        $idArticulo = $_POST['id'];
        $autores = $this->model->get_autores_articulo($idArticulo);
        $archivo = $this->model->get_nombre_archivo($idArticulo);
        $idAutores = array();
        $idUsuarioAutor = $this->model->get_id_autor(Session::get('id'));
        try {
            $this->model->borrar_relacion_autor_articulo($idArticulo);
            if (count($autores) > 1) {
                foreach ($autores as $autor) {
                    if ($autor['autId'] != $idUsuarioAutor) {
                        $this->model->borrar_autor($autor['autId']);
                    }
                }
            }
            $this->model->borrar_articulo($idArticulo);
            try {
                unlink(DOCS.$archivo);
                rmdir(DOCS.$idArticulo);
            } catch (Exception $exc) {
                error_log('No se puede borrar el archivo');
                error_log($exc->getTraceAsString());
            }
            echo 'true';
        } catch (Exception $exc) {
            echo 'false';
        }
    }
    
    function asignarAutorContacto() {
        $idAutor = $_POST['idAutor'];
        $idArticulo = $_POST['idArticulo'];
        $responseDB = $this->model->autor_de_contacto($idArticulo, $idAutor);
    }
    
    
    function comprobarCorreo($correo) {
        $correoCorrecto = 0;
        if ((strlen($correo) >= 6) && (substr_count($correo, '@') == 1) && (substr($correo,0,1) != '@') && (substr($correo, strlen($correo)-1,1) != '@')) {
            if ((!strstr($correo, "'")) && (!strstr($correo, "\"")) && (!strstr($correo, "\\")) && (!strstr($correo, "\$")) && (!strstr($correo, " "))) {
                if (substr_count($correo, ".") >= 1) {
                    $term_dom = substr(strrchr($correo, '.'), 1);
                    if (strlen($term_dom) > 1 && strlen($term_dom) < 5 && (!strstr($term_dom, '@'))) {
                        $antes_dom = substr($correo,0, strlen($correo)-strlen($term_dom)-1);
                        $caracter_ult = substr($antes_dom, strlen($antes_dom)-1,1);
                        if ($caracter_ult != '@' && $caracter_ult != '.') {
                            $correoCorrecto = 1;
                        }
                    }
                }
            }
        }
        if ($correoCorrecto) {
            return TRUE;
        }else{
            return FALSE;
        }
    }


}
