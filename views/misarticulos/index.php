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
			<div class="container container-misarticulos">
				<!--<ol class="breadcrumb">
					<li><a href="index">Inicio</a></li>
					<li class="active">Mis art&iacute;culos</li>
				</ol> -->
				<a href="registroarticulo" id="btn-registro-articulo" class="btn btn-success pull-right"><i class="glyphicon glyphicon-plus-sign"></i> Registrar articulo</a>
				<div class="row row-misarticulos">
					<div class="col-sm-12 mis-articulos">
						<!-- <h5>Para poder validar su participaci&oacute;n favor de completar el formato de registro. <a href="registroasistencia">IR AL FORMATO</a></h5> -->
						<br>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Art&iacute;culos registrados</h3>
							</div>
							<div class="panel-body">
								<?php echo $this->tblArticulos; ?>
							</div>
							<div class="panel-footer">
								<b><em>Nota: </em></b><br><i class="glyphicon glyphicon-ok"> </i>&nbsp;Para descargar las cartas de cesi&oacute;n de derechos y originalidad, as&iacute; como para editar &oacute; subir una nueva versi&oacute;n del art&iacute;culo dar clic en el id correspondiente.                     

							</div>
						</div>
					</div>
					<div class="col-sm-12 datos-deposito">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Datos para realizar el dep&oacute;sito</h3>
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-sm-3">
										<div class="form-group">
											<label for=""><b>Banco:</b></label>
											<p class="form-control-static">Banbaj&iacute;o</p>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label for=""><b>No. de cuenta:</b></label>
											<p class="form-control-static">0117760360101</p>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label for=""><b>Cuenta clabe:</b></label>
											<p class="form-control-static">030248900003188437</p>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="form-group">
											<label for=""><b>Sucursal:</b></label>
											<p class="form-control-static">Valle de Santiago</p>
										</div>
									</div>
								</div>
							</div>
							<div class="panel-footer"></div>
						</div>
					</div>					
				</div>

				<div id="modal-ver-articulo" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
					<!-- <form action="misarticulos/updateArticulo" method="post" id="form-update-articulo"> -->
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title">Cartas y registro</h4>
								</div>
								<div class="modal-body">
									<!-- Menú de las pestañas del artículo -->
									<ul class="nav nav-tabs" role="tablist">
										<li id="li-detalles" role="presentation" class="active"><a href="#detalles" aria-controls="detalles" role="tab" data-toggle="tab">Edici&oacute;n del trabajo</a></li>
										<li id="li-cartas" role="presentation" class="hidden"><a href="#cartas" aria-controls="cartas" role="tab" data-toggle="tab">Cartas de originalidad y cesión de derechos</a></li>
										<li id="li-constancia" role="presentation" class="hidden"><a href="#constancia" aria-controls="constancia" role="tab" data-toggle="tab">Descarga de Constancia</a></li>
									</ul>
									<div class="tab-content">
										<!-- Div para los detalles del artículo -->
										<div id="detalles" class="tab-pane active" role="tabpanel">
											<form action="misarticulos/updateArticulo" method="post" id="form-update-articulo">
												<br>
												<div class="form-group">
													<label for=""><b>Nombre del art&iacute;culo:</b></label>
													<input id="update-articulo-id" name="id" type="text" class="hidden">
													<input id="ver-articulo-nombre" name="nombre" type="text" class="form-control" disabled>
												</div>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label for=""><b>&Aacute;rea tem&aacute;tica:</b></label>
															<!-- <input type="text" name="area" class="form-control" id="ver-articulo-area" disabled> -->
															 <select name="area" id="ver-articulo-area" class="form-control" disabled>
																<option value="CAYS">Ciencias administrativas y sociales</option>
																<option value="EFC">Experiencia en formaci&oacute;n CA</option>
																<option value="CA">Ciencias agropecuarias</option>
																<option value="CNYE">Ciencias naturales y exactas</option>
																<option value="CIYT">Ciencias de ingenier&iacute;a y tecnolog&iacute;a</option>
																<option value="E">Educaci&oacute;n</option>
															</select>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label for=""><b>Tipo:</b></label>
															<select name="tipo" id="ver-articulo-tipo" class="form-control" disabled>
																<option value="extenso">Extenso</option>
																<option value="poster">Poster</option>
															</select>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label for=""><b>Ultima versión:</b></label>
													<div class="row">
														<div class="col-sm-6">
															<p id="ver-articulo-archivo" class="form-control-static"></p>
														</div>
														<div class="col-sm-6">
															<div class="fileUpload btn btn-primary hidden" id="btn-subir-version">
																<span> <i class="glyphicon glyphicon-upload"></i> Subir nueva versi&oacute;n</span>
																<input type="file" name="file" id="input-nueva-version" class="upload" />
															</div>
														</div>
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-sm-6">
															<label for=""><b>Autores:</b></label>
														</div>
														<div class="col-sm-6 text-right">
															<label id="btn-agregar-autor" class="btn btn-link hidden"><i class="glyphicon glyphicon-plus"></i> Agregar autor</label>
														</div>
													</div>

													<table id="tbl-ver-articulo-autores" class="table">
														<thead>
															<th class="hidden"></th>
															<th></th>
															<th></th>
															<th></th>
														</thead>
														<tbody></tbody>
													</table>
												</div>
												<hr>
												<div class="text-right">
													<button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Cerrar</button>
													<button id="btn-guardar-cambios" class="btn btn-success hidden"><i class="glyphicon glyphicon-ok"></i> Aceptar</button>
												</div>
											</form>
										</div>

										<!-- Inicia el panel de las cartas de originalidad y seción de derechos -->
										<div id="cartas" class="tab-pane" role="tabpanel">
											<br>
											<div class="row text-right">
											<!-- link de la carta de originalidad -->
												<h4 class="text-primary">1.-Descargue los documentos para su llenado.</h4>
												<div name ="cartaaceptacion" id="cartaaceptacion-archivo"  class="col-sm-6 text-right"></div>
												<a href="docs/CartaOriginalidad.docx" class="btn btn-link"><i class="glyphicon glyphicon-save-file"></i> Carta de originalidad</a>
												<a href="docs/CartaCesionDerechos.docx" class="btn btn-link"><i class="glyphicon glyphicon-save-file"></i> Carta de cesi&oacute;n de derechos</a>
											</div>
										<!-- 	<br> -->
											<!-- <h5 class=""><b>1.-Descargue los documentos para su llenado.<br>2.-Suba los documentos escaneados.  -->
											<!-- <br>3.-Suba el recibo de pago.</b></h5> -->
											<br>
											<form id="form-subir-cartas" action="" method="post">
												<h4 class="text-primary">2.-Suba los documentos escaneados.</h4>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label for=""><b>Carta de originalidad:</b></label>
															<input id="input-carta-originalidad" type="file" name="originalidad" value="" disabled>
															<p class="help-block">Solo se permiten archivos con extensi&oacute;n .pdf</p>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label for=""><b>Carta de cesi&oacute;n de derechos:</b></label>
															<input id="input-carta-cesion" type="file" name="cesion" value="" disabled>
															<p class="help-block">Solo se permiten archivos con extensi&oacute;n .pdf</p>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-sm-12">
														<h4 class="text-primary">Documentos actuales:</h4>
														<div id="documentos-actuales" class="row"></div>
													</div>
												</div>
												<div class="text-right">
													<button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Cerrar</button>
													<button id="btn-subir-cartas" class="btn btn-success"><i class="glyphicon glyphicon-ok"></i> Aceptar</button>
												</div>
											</form>
										</div>
										<!-- Panel de la CONSTANCIA DE CONGRESO -->
										<div id="constancia" class="tab-pane fade" role="tabpanel">
												<br>
												<div class="form-group">
													<h4 class="text-primary">Descarge la Constancia del Congreso Cica2017</h4>
												</div>
												<div class="col-sm-1"></div>	  
												<div id="constancia_pdf" class="col-sm-2" >
													<div id="link_constancia"></div>
												</div>	  

												<div class="text-right">
													<button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Cerrar</button>
												</div>
										</div> 
									</div>
								</div>
							 <!-- 	<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Cerrar</button>
									<button id="btn-guardar-cambios" class="btn btn-success hidden"><i class="glyphicon glyphicon-ok"></i> Aceptar</button>
								</div> -->
							</div>
						</div>
					<!-- </form> -->
				</div>
				<form id="form-editar-autor" action="misarticulos/updateAutor" method="post">
					<div id="modal-editar-autor" class="modal fade" tabindex="-1" role="dialog">
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
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label for=""><b>Estado:</b></label>
												<select name="estado" id="estado" class="form-control"></select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label for=""><b>Ciudad:</b></label>
												<input id="ciudad" name="ciudad" type="text" class="form-control">
											</div>
										</div>
									</div>
									<div class="form-group">
										<label for=""><b>Correo:</b></label>
										<input id="correo" name="correo" type="text" class="form-control">
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
				<form id="form-registro-autor" action="misarticulos/registroAutor" method="post">
					<div id="modal-registro-autor" class="modal fade" tabindex="-1" role="dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title">Registro de autor</h4>
								</div>
								<div class="modal-body">
									<input id="add-id-articulo-autor" name="id" type="text" class="hidden">
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group">
												<label for=""><b>Nombre:</b></label>
												<input name="nombre" type="text" class="form-control">
											</div>	
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label for=""><b>Apellido paterno:</b></label>
												<input name="apellido-paterno" type="text" class="form-control">
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label for=""><b>Apellido materno:</b></label>
												<input name="apellido-materno" type="text" class="form-control">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-4">
											<div class="form-group">
												<label for=""><b>Pa&iacute;s:</b></label>
												<select name="pais" id="add-autor-pais" class="form-control">
													<?php echo $this->selectPaises; ?>
												</select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label for=""><b>Estado:</b></label>
												<select name="estado" id="add-autor-estado" class="form-control"></select>
											</div>
										</div>
										<div class="col-sm-4">
											<div class="form-group">
												<label for=""><b>Ciudad:</b></label>
												<input id="add-autor-ciudad" name="ciudad" type="text" class="form-control">
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
												<select name="grado-academico" class="form-control">
													<option value="licenciatura">Licenciatura</option>
													<option value="maestria">Maestr&iacute;a</option>
													<option value="doctorado">Doctorado</option>
												</select>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label for=""><b>Instituci&oacute;n de procedencia:</b></label>
												<input name="institucion-procedencia" type="text" class="form-control">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for=""><b>Tipo de instituci&oacute;n:</b></label>
												<select name="" id="add-autor-tipo-institucion" class="form-control">
													<option value="tecnologica">Tecnol&oacute;gica</option>
													<option value="politecnica">Polit&eacute;cnica</option>
													<option value="autonoma">Aut&oacute;noma</option>
													<option value="instTecnologico">Instituto tecnol&oacute;gico</option>
													<option value="centroInvestifacion">Centro de investigaci&oacute;n</option>
													<option value="otro">Otro</option>
												</select>
												<br>
												<label id="add-autor-lbl-input-tipo-institucion" for="" class="hidden"><b>Otra:</b></label>
												<input id="add-autor-input-tipo-institucion" name="tipo-institucion" class="form-control hidden"></input>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label for=""><b>Asistenc&iacute;a a congresos CICA:</b></label>
												<select name="asistencia-cica" class="form-control">
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
				<!-- <div class="row">
					<div class="col-sm-12">
						<div class="alert alert-info">
							Para editar &oacute; subir una nueva versi&oacute;n del art&iacute;culo dar clic en el registro a editar.
						</div>
					</div>
				</div> -->
			</div>   
                    
            <!-- termine frame-container -->   
        </div>
        
    </div>

</div>










