<?php

class resetpassword extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->css = array(
            /*'public/plugins/toastr/toastr.min.css',
            'public/css/animate.min.css', */
            'views/resetpassword/css/resetpassword.css',
            'public/bootstrap/css/bootstrap.min.css',
            'public/fontawesome/css/font-awesome.min.css',
            'public/css/animate.min.css',
            'public/css/fluidbox.min.css',
            'views/resetpassword/css/resetpassword.css'
        );
        $this->view->js = array(
            /*'public/plugins/toastr/toastr.min.js',
            'views/index/js/nicescroll.js',
            'views/index/js/wow.js',
            'views/index/js/index.js',
        	'views/index/js/bs-hover-dropdown.js'*/
            'public/js/jquery-2.1.4.min.js',
            'public/js/bootstrap.min.js',
            /*'public/js/index.js',*/
            'public/js/jquery.fluidbox.min.js',
			'views/resetpassword/js/resetpassword.js'
        );
        
    }

    function index() {
        $this->view->render("resetpassword/index");
    }

    
    function cerrarSesion() { 
        Session::init();
        Session::destroy();
        header('location: ../index');
    }
    

	function IsEmail($email) {
	  $emailValido=false;	
		$regex="/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD";
	  if(preg_match($regex,$email))
		$emailValido=true;
	  return $emailValido;
	}
	


    function resetpass() {
        $correo = $_POST['correo'];
        if (!empty($correo)) {
            $correoValido = $this->IsEmail($correo);
            if ($correoValido) {
                $responseDb = $this->model->existe_correo($correo);
                if (!$responseDb) {
                    echo 'error-correo';
                } else {
					$dt_usuario=$this->model->getIdUsuarioPorCorreo($correo);
                    $idUsuario = $dt_usuario['usuId'];
                    $password = $this->gerarPassword();
                    $responseDb = $this->model->restaurarPassword($idUsuario, md5($password));
                    if (!$responseDb) {
                        echo 'error-operacion';
                    } else {
                        //Apartado para enviar correo
                        $this->mail->setFrom('administracion@higo-software.com', 'CICA');
					    $this->mail->FronName="Cica2018";
                        $this->mail->addAddress($correo);
                        $this->mail->isHTML(TRUE);
                        $this->mail->Subject = utf8_decode('Restauración de contraseña');
                        $this->mail->Body = "Tu nueva contrase&ntilde;a para entrar al portal es <br/><b>$password</b>";
						$this->mail->CharSet="UTF-8";
                        if (!$this->mail->send()) {
                            error_log("Error al enviar el correo para nueva contraseña a $correo:" . $this->mail->ErrorInfo);
                        }
                        echo 'true';
                    }
                }
            } else {
                echo 'error-formato';
            }
        } else {
            echo 'error-null';
        }
    }

    function gerarPassword() {
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890@-_!#$%&()?¡¿";
        $longitudCadena = strlen($cadena);
        $pass = "";
        $longitudPass = 10;

        for ($i = 1; $i <= $longitudPass; $i++) {
            $pos = rand(0, $longitudCadena - 1);
            $pass .= substr($cadena, $pos, 1);
        }
        return $pass;
    }


}
