<?php Session::init(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=si">
    <title>CICA 2018</title>
    <link rel="icon" type="image/png" href="<?php echo URL; ?>public/images/favicon.png" />
    <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/prism/0.0.1/prism.min.css" media="all" rel="stylesheet" />
    <link type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.0/normalize.min.css" media="all" rel="stylesheet" />
<<<<<<< HEAD
    <link rel="stylesheet"	href="<?php echo URL; ?>public/plugins/toastr/toastr.min.css" />

	<!--<link rel="stylesheet" type="text/css" href="<?php //echo URL; 
     ?>public/bootstrap/css/bootstrap_yeti.min.css">
	<link rel="stylesheet" href="<?php //echo URL; ?>public/css/custom.css"> -->
	
=======
	<!--<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/bootstrap/css/bootstrap_yeti.min.css">
	<link rel="stylesheet" href="<?php echo URL; ?>public/css/custom.css"> -->
>>>>>>> 01b2ef7747411dbd891e5d1fc8fe3811c20e0c5b
	<?php 
    	if (isset($this->css)) {
    		foreach ($this->css as $css) {
    			echo '<link rel="stylesheet" href="'.URL.$css.'">';
    		}
    	}
     ?>
     <link rel="stylesheet"	href="<?php echo URL; ?>public/css/general.css" />
</head>
<body>
    <?php
        //Manejo de sesion del usuario, identifica bassicamente el inicio de sesion y recupera el nombre del usuario.
        $banderaSesion = false;
        if (Session::get('sesion')) {
            try {
                $nombreUsuario = Session::get('usuario');
                $banderaSesion = true;
            } catch (Exception $e) {
                $nombreUsuario = '';
            }
        }
        /*else{
            $banderaSesion = true;
            $nombreUsuario = 'test';
        }*/
    ?>
    <div class="container menu_superior">
      <header id="head-section" class="navbar navbar-default site-header" role="banner">
          <nav class="navbar navbar-default navbar-static-top container-fluid ">
             <div class="navbar-header">
                    <a href="http://placehold.it/250x250" title="" data-fluidbox>
                        <img class="img-fluid img-responsive logo_header" src="http://placehold.it/90x70" title="" alt="" />
                    </a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
             </div>
              <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav head-menu">
                    <li><a href="index">Inicio</a></li>
                    <li id="mConvocatoria" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Convocatoria<span class="caret"></span></a>
                        <ul class="dropdown-menu sub-menu" role="menu" aria-labelledby="dLabel">
                              <li><a href="fechasImportantes"> Fechas importantes </a></li>
                              <li><a href="noticias"> Noticias </a></li>
                        </ul>
                    </li>
                    <li id="mPrograma" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Programa<span class="caret"></span></a>
                        <ul class="dropdown-menu sub-menu" role="menu" aria-labelledby="dLabel">
                              <li><a href="programaGeneral"> General </a></li>
                              <li><a href="programaTalleres"> Talleres</a></li>
                              <li><a href="programaMesas"> Mesas de Trabajo</a></li>
                        </ul>
                    </li>
                    <li><a href="hospedaje">Hospedaje</a></li>	
                    <li id="mAutores" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Autores<span class="caret"></span></a>
                        <ul class="dropdown-menu sub-menu">
                            <li><a href="guia">Guía</a></li>
<<<<<<< HEAD
                            <li><a href="registroautores" >Registro</a></li>
=======
                            <li><a href="registro">Registro</a></li>
>>>>>>> 01b2ef7747411dbd891e5d1fc8fe3811c20e0c5b
                        </ul>
                    </li>
                    <li id="mAsistentes" class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Asistentes<span class="caret"></span></a>
                        <ul class="dropdown-menu sub-menu">
                            <li><a href="informacion">Información</a></li>
                            <li><a href="inscripcion">Registro de pago</a></li>
                        </ul>
                    </li>
                    <?php
                        //Si el usuario hay iniciado sesión mostramos el menu de usuario activo, 
                        //en caso contrario, mostramos el menu genérico de inicio de sesión.
                        if ($banderaSesion) {
                    ?> 
                        <li id="mSesion" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $nombreUsuario; ?><span class="caret"></span></a>
                            <ul class="dropdown-menu sub-menu">
<<<<<<< HEAD
                                <li><a href="perfil"><i class="fa fa-address-card" aria-hidden="true"></i> Perfil</a></li>
                                <li role="presentation" class="divider line-divider"></li>
                                <li><a href="index/cerrarSesion"><i class="fa fa-sign-out" aria-hidden="true"></i> logout</a></li>  
=======
                                <li><a href="#perfil"><i class="fa fa-address-card" aria-hidden="true"></i> Perfil</a></li>
                                <li role="presentation" class="divider"></li>
                                <li><a href="../index.html"><i class="fa fa-sign-out" aria-hidden="true"></i> logout</a></li>  
>>>>>>> 01b2ef7747411dbd891e5d1fc8fe3811c20e0c5b
                            </ul>
                        </li>
                    <?php  
                        }else{
                    ?>   
<<<<<<< HEAD
                         <li id="mSesion">
							 <a href="#" id="user-login" ><i class="fa fa-sign-in" aria-hidden="true"></i>&nbsp;Iniciar sesión</a>                          
							<!--  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Iniciar sesión<span class="caret"></span></a>
                           <ul class="dropdown-menu sub-menu">
=======
                         <li id="mSesion" class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Iniciar sesión<span class="caret"></span></a>
                            <ul class="dropdown-menu sub-menu">
>>>>>>> 01b2ef7747411dbd891e5d1fc8fe3811c20e0c5b
                                <li><a href="autores/index.html">Autor</a></li>
                                <li><a href="editor/index.html">Editor</a></li>
                                <li><a href="contador/index.html">Contador</a></li>
                                <li><a href="administrador/index.html">Administrador</a></li>
<<<<<<< HEAD
                            </ul>-->
=======
                            </ul>
>>>>>>> 01b2ef7747411dbd891e5d1fc8fe3811c20e0c5b
                        </li>
                    <?php
                        }
                    ?>                    
                </ul>
              </div><!--/.nav-collapse -->
          </nav>
        </header>
    </div> <!-- /container menu superior-->
    
<!--  Este pedaso de codigo sera util para algo, identificar el menu lateral a cargar   		      
              <?php 
                if (Session::get('perfil') == 'autor' || !Session::get('sesion') && Session::get('perfil') != 'administrador') {
                echo '<li id="li-hospedaje"><a href="hospedaje"><span class="glyphicon glyphicon-bed"></span> Hospedaje</a></li>';
                }
              ?>
              <?php 
                  if (Session::get('perfil') == 'autor') {
                    echo '<li><a href="#" data-toggle="modal" data-target="#modal-conferencia-magistral"><span class="glyphicon glyphicon-education"></span> Conferencia magistral</a></li>';
                    echo '<li id="li-mis-articulos"><a href="misarticulos"><i class="glyphicon glyphicon-book"></i> Mis art&iacute;culos</a></li>';
                  }
                  if (Session::get('perfil') == 'administrador') {
                    echo '<li id="li-panelcontrol"><a href="dashboard"><i class="glyphicon glyphicon-tasks"></i>Panel de Control</a></li>
                          <li id="li-usuarios"><a href="usuario"><i class="glyphicon glyphicon-user"></i>Usuarios</a></li>
                    	  <li class="dropdown">
                              <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-usd"></i>Depositos <span class="caret"></span></a> 
			                  <ul class="dropdown-menu" >
	    			             <li id="li-depositos"><a href="depositos"><i class="glyphicon glyphicon-usd"></i>Dep. autores</a></li>
				                 <li id="li-depositospublico"><a href="depositospublico"><i class="glyphicon glyphicon-usd"></i>Dep. p&uacute;blico</a></li>
				    		  </ul>
    			          </li>
  		                  <li id="li-editores"><a href="editores"><i class="glyphicon glyphicon glyphicon-pencil"> </i>Editores</a></li>
  		                  <li class="dropdown">
  		                       <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-usd"></i>Control <span class="caret"></span></a>
	  		                  <ul class="dropdown-menu">
		        	              <li id="li-cartas"><a href="cartas"><i class="glyphicon glyphicon-check"></i>Cartas</a></li>
				                  <li id="li-control"><a href="control_asistencia"><i class="glyphicon glyphicon glyphicon-list-alt"> </i>Control Asistencia</a></li>
  		                      </ul>
  		                  </li> ';
                  }

                  if (Session::get('perfil') == 'contabilidad') {
                    echo '<li id="li-depositos"><a href="depositos"><i class="glyphicon glyphicon-user"></i>Depositos</a></li>';
                  }

                  if (Session::get('perfil') == 'editor') {
                    echo '<li id="li-editores"><a href="editores"><i class="glyphicon glyphicon glyphicon-pencil"> </i>Editores</a></li>';
                  }
                  if (Session::get('perfil') == 'control') {
                  	echo '<li id="li-control"><a href="control_asistencia"><i class="glyphicon glyphicon glyphicon-list-alt"> </i>Control Asistencia</a></li>';
                  }
               ?>

<<<<<<< HEAD
-->


=======
-->
>>>>>>> 01b2ef7747411dbd891e5d1fc8fe3811c20e0c5b
