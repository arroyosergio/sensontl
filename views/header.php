<?php Session::init(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=si">
	<title>CICA 2017</title>
  <link rel="icon" type="image/png" href="<?php echo URL; ?>public/img/mini_logo_utsoe.png" />
	<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/bootstrap/css/bootstrap_yeti.min.css">
	<link rel="stylesheet" href="<?php echo URL; ?>public/css/custom.css">
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<?php 
    	if (isset($this->css)) {
    		foreach ($this->css as $css) {
    			echo '<link rel="stylesheet" href="'.URL.$css.'">';
    		}
    	}
     ?>
</head>
<header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button> 
            <a class="navbar-brand" href="#"><img src="<?php echo URL.'public/img/utsoe.png'; ?>" alt=""></a>
          </div>
          <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <li id="li-index" class="active"><a href="index"><i class="glyphicon glyphicon-home"></i> Inicio</a></li>
              <?php
                  $banderaSesion = false;
                  if (Session::get('sesion')) {
                    try {
                      $nombreUsuario = Session::get('usuario');
                      $banderaSesion = true;
                    } catch (Exception $e) {
                      $nombreUsuario = '';
                    }
                    /*echo '
                      <li><a href="perfil"><span class="glyphicon glyphicon-user"></span> '.$nombreUsuario.'</a></li>
                      <li><a id="btn-cerrar-sesion" href="index/cerrarSesion"><i class="glyphicon glyphicon-log-out"></i> Salir</a></li>
                    ';*/
                  }else{
                    echo '<li><a href="#" data-toggle="modal" data-target="#modal-login"><span class="glyphicon glyphicon-log-in"></span> Acceso para autores</a></li>';
                    echo '<li><a href="#" data-toggle="modal" data-target="#modal-conferencia-magistral"><span class="glyphicon glyphicon-education"></span> Conferencia magistral</a></li>';
                  }
               ?>
               <?php 
                if (!Session::get('sesion')) {
                  echo ' <li id="li-regPublico"><a tabindex="-1" href="registropublico"><i class="glyphicon glyphicon-copy"></i>&nbsp;Registro para publico</a></li>';
                }
               ?>
                <li class="dropdown">
  		            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-calendar"></i>&nbsp;Programas <span class="caret"></span></a>
	  		        <ul class="dropdown-menu">
		        	    <li id="li-programa"><a tabindex="-1" href="programa"><i class="glyphicon glyphicon-calendar"></i>&nbsp;Programa general</a></li>
				        <!--   <li id="li-traslados"><a href="<?php echo URL.'/docs/programa_traslados.pdf';  ?>"><i class="glyphicon glyphicon glyphicon-plane"> </i>&nbsp;&nbsp;Programa de traslados</a></li>   -->
  		            </ul>
               </li>
               
               <li class="dropdown">
  		            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-wrench"></i>&nbsp;Talleres <span class="caret"></span></a>
	  		        <ul class="dropdown-menu">
		        	    <li id="li-taller-info"><a tabindex="-1" href="talleres"><i class="glyphicon glyphicon-list-alt"></i>&nbsp;&nbsp;Informaci&oacute;n</a></li>
				       <!--   <li id="li-taller-reg"><a href="http://cica2016.org/RegistroTalleres/"><i class="glyphicon glyphicon glyphicon-pencil"> </i>&nbsp;&nbsp;Registro</a></li> -->
  		            </ul>
  		      </li>
 			                 		      
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
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <?php if ($banderaSesion): ?>
                <li><a href="perfil"><span class="glyphicon glyphicon-user"></span><?php echo $nombreUsuario; ?></a></li>
                <li><a id="btn-cerrar-sesion" href="index/cerrarSesion"><i class="glyphicon glyphicon-log-out"></i> Salir</a></li>
              <?php endif ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </nav>
    </header>
<body>
    <br>
    <br>
    <br>
    <!-- Begin page content -->
<!--     <div class="container"> -->
    
