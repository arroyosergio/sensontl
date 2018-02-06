 <div class="info-container">
       <div class="row">
        <!-- uncomment code for absolute positioning tweek see top comment in css -->
        <!-- <div class="absolute-wrapper"> </div> -->
        <!-- Menu -->
        <div class="side-menu">

            <nav class="navbar navbar-default" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <div class="brand-wrapper">
                    <!-- Hamburger -->
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </div>
            <!-- Main Menu -->
            <div class="side-menu-container ">
                <ul class="nav navbar-nav">

                    <li class="active"><a href="#"><span><i class="fa fa-address-card fa-2x" aria-hidden="true"></i></span> Perfil del autor</a></li>
                    <li><a href="misarticulos"><span> <i class="fa fa-language fa-2x" aria-hidden="true"></i></span> Registro de articulos</a></li>
                    <li><a href="#"><span><i class="fa fa-users fa-2x" aria-hidden="true"></i></span> Registro de co-autores</a></li>
                    <li><a href="#"><span><i class="fa fa-creative-commons fa-2x" aria-hidden="true"></i></span> Cartas</a></li>
                    <li><a href="#"><span><i class="fa fa-copyright fa-2x" aria-hidden="true"></i></span> Carta de Aceptacion</a></li>
                    <li><a href="#"><span><i class="fa fa-user-plus fa-2x" aria-hidden="true"></i></span> Registro de pago</a></li>
                    <li><a href="#"><span><i class="fa fa-money fa-2x" aria-hidden="true"></i></span> Facturacion</a></li>
                    <li><a href="#"><span><i class="fa fa-id-badge fa-2x" aria-hidden="true"></i></span> Imprmir Gafete</a></li>
                    <li><a href="#"><span><i class="fa fa-certificate fa-2x" aria-hidden="true"></i></span> Constancia</a></li>
                    <!--<li class="active"><a href="#"><span class="glyphicon glyphicon-plane"></span> Active Link</a></li>-->
                    <li><a href="#"><span><i class="fa fa-plug fa-2x" aria-hidden="true"></i></span> Cambiar contraseña</a></li>
                    <li><a href="../index.html"><i class="fa fa-sign-out fa-2x" aria-hidden="true"></i> logout</a></li>

                </ul>
            </div><!-- /.navbar-collapse -->
            </nav>
        </div>
           
            <!-- Main Content -->
			<div class="container container-registroart">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Registro de artículo</h3>
					</div>
						<div class="panel-body">
						  <form id="form-registro-articulo" action="registroarticulo/registroArticulo" method="post">
							<div class="col-md-12 col-sm-12 col-lg-12">
								<div class="form-group">
									<label for=""><b>Nombre del art&iacute;culo:</b></label>
									<input id="articulo-nombre" type="text" class="form-control" autofocus="" name="nombre">
								</div>
							
								<div class="col-sm-6 area-tematica">
									<div class="form-group">
										<label for=""><b>&Aacute;rea tematica:</b></label>
										<select name="area-tematica" id="articulo-area-tematica" class="form-control">
											<option value="CAYS">Ciencias administrativas y sociales</option>
											<option value="EFC">Experiencia en formaci&oacute;n CA</option>
											<option value="CA">Ciencias agropecuarias</option>
											<option value="CNYE">Ciencias naturales y exactas</option>
											<option value="CIYT">Ciencias de ingenier&iacute;a y tecnolog&iacute;a</option>
											<option value="E">Educaci&oacute;n</option>
										</select>
									</div>
								</div>
								<div class="col-sm-6 tipo-articulo">
									<div class="form-group">
										<label for=""><b>Tipo de art&iacute;culo:</b></label>
										<select name="tipo-articulo" id="tipo-articulo" class="form-control">
											<option value="extenso">Extenso</option>
											<option value="poster">Poster</option>
										</select>
									</div>
								</div><br>
                                    <div class="frame-bottons frame-buttons">
                                        <div class=" text-right col-lg-12 col-sm-12">
                                             <button id="btn-guardar" type="submit" data-toggle="tooltip" title="Guardar"  class="btn btn-default" ><i class="fa fa-save fa-2x" aria-hidden="true"></i></button> 
                                        </div>
                                    </div>
                                 </div>
						    </form>
						 
                            <div class="contened-files">
                                 <form id="uploadfile" enctype="multipart/form-data" action="registroarticulo/updloadFile" method="POST">
									 <div class="row row-files">
										  <div class="lista-archivos">
											  <ul id="file-list">
													<li class="no-items"> Ningun archivo cargado! </li>
											  </ul>
										  </div>
									 </div>  
									 <br>
									<div class="form-group">
										<span class="btn btn-success fileinput-button">
											<i class="glyphicon glyphicon-plus"></i>
											<span>Seleccionar archivo</span>
											<input type="file" id="archivo" name="archivo">
										</span>							
										 <button id="cancelar" type="reset" class="btn btn-warning">
											<i class="glyphicon glyphicon-ban-circle"></i>
											<span>Cancelar carga</span>
										</button>
										<button id="cargar" type="submit" class="btn btn-primary">
											<i class="glyphicon glyphicon-upload"></i>
											<span>Iniciar carga</span>
										</button>									
										 <input id="id-articulo" name="id-articulo" type="text" class="hidden">
										<p class="help-block">Solo se permiten archivos con extencion .doc o .docx.</p>
										<p class="help-block">Para un mejor rendimiento considere las siguientes indicaciones:</p>
										<p class="help-block"><i class="glyphicon glyphicon-ok"></i>&nbsp;Tama&ntilde;o maximo: 1000 kb. (10MB.)<br>
										<i class="glyphicon glyphicon-ok"></i>&nbsp;Documentos de word 2003 (.doc). <br>
										<i class="glyphicon glyphicon-ok"></i>&nbsp;Use nombres de archivos cortos.
										</p>
									</div>	
								</form>							
							</div>
							<div class="form-group hidden" id="modal-autores">
								<label for=""><b>Autores:</b></label>
								<a id="btn-agregar-autor" href="#" class="btn btn-success pull-right"><i class="glyphicon glyphicon-plus"></i> Agregar autor</a>
								<br>
								<br>
								<ul class="list-group" id="detalles-articulo-autores">
									<?php echo '<li class="list-group-item">'.Session::get('usuario').'<label class="pull-right"><input type="radio" name="auto-contacto" id="" value="'.Session::get('idAutor').'" checked>Autor de contacto</label></li>'; ?>
								</ul>
							</div>								

						

						</div>
						<div class="panel-footer">
							<a id="a-regresar" href="misarticulos" class="btn btn-warning"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
							<button id="btn-aceptar-form-articulo" class="btn btn-success pull-right"><i class="glyphicon glyphicon-arrow-right"></i> Siguiente</button>
							<div id="div-botones-arituculo" class="text-right hidden">
								<a id="cancelar-registro" class="btn btn-default"><i class="glyphicon glyphicon-remove"></i> Cancelar</a>
								<a id="btn-aceptar-registro" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Aceptar</a>
							</div>
						</div>

				</div>
				<form id="form-registro-autor" action="misarticulos/registroAutor" method="post">
					<div id="modal-registro-autor" class="modal fade" tabindex="-1" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title">Registro de autor</h4>
								</div>
								<div class="modal-body">
									<input id="id-articulo-autor" name="id" type="text" class="hidden">
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group">
												<label for=""><b>Nombre:</b></label>
												<input id="nombre" name="nombre" type="text" class="form-control">
											</div>	
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label for=""><b>Apellido paterno:</b></label>
												<input id="apellido-paterno" name="apellido-paterno" type="text" class="form-control">
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label for=""><b>Apellido materno:</b></label>
												<input id="apellido-materno" name="apellido-materno" type="text" class="form-control">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group">
												<label for=""><b>Pa&iacute;s:</b></label>
												<select name="pais" id="pais" class="form-control">
													<?php echo $this->selectPaises; ?>
												</select>
											<!-- 	<input id="pais" name="pais" type="text" class="form-control"> -->
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label for=""><b>Estado:</b></label>
												<select name="estado" id="estado" class="form-control"></select>
												<!-- <input id="estado" name="estado" type="text" class="form-control"> -->
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label for=""><b>Ciudad:</b></label>
												<input id="ciudad" name="ciudad" type="text" class="form-control">
											<!-- <select id="ciudad" name="ciudad" class="form-control"></select> -->
											</div>
										</div>
									</div>
									<div class="form-group">
									<div class="row">

									</div>
										<label for=""><b>Correo:</b></label>
										<input name="correo" type="text" class="form-control">
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for=""><b>Grado acad&eacute;mico:</b></label>
												<select name="grado-academico" class="form-control" id="grado-academico">
													<option value="licenciatura">Licenciatura</option>
													<option value="maestria">Maestr&iacute;a</option>
													<option value="doctorado">Doctorado</option>
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label for=""><b>Instituci&oacute;n de procedencia:</b></label>
												<input id="institucion-procedencia" name="institucion-procedencia" type="text" class="form-control">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for=""><b>Tipo de instituci&oacute;n:</b></label>
												<select name="" id="tipo-institucion" class="form-control">
													<option value="tecnologica">Tecnol&oacute;gica</option>
													<option value="politecnica">Polit&eacute;cnica</option>
													<option value="autonoma">Aut&oacute;noma</option>
													<option value="instTecnologico">Instituto tecnol&oacute;gico</option>
													<option value="centroInvestifacion">Centro de investigaci&oacute;n</option>
													<option value="otro">Otro</option>
												</select>
												<br>
												<label id="lbl-input-tipo-institucion" for="" class="hidden"><b>Otra:</b></label>
												<input id="input-tipo-institucion" name="tipo-institucion" class="form-control hidden"></input>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label for=""><b>Asistenc&iacute;a a congresos CICA:</b></label>
												<select name="asistencia-cica" id="asistencia-cica" class="form-control">
													<option value="primera">Primera vez</option>
													<option value="segunda">Segunda Vez</option>
													<option value="tercera">Tercera vez</option>
													<option value="todas">Ha asistido a todos los congresos</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Cancelar</button>
									<button class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Aceptar</button>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
				</form>
				<div id="cargando" class="hidden centrado"><img src="./public/img/cargando.gif" alt=""></div>
			</div>			
                    
            <!-- termine Main-container -->   
        </div>
        
    </div>

</div>



















