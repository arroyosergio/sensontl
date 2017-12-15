<div class="container">
	<ol class="breadcrumb">
		<li><a href="index">Inicio</a></li>
		<li><a href="misarticulos">Mis art&iacute;culos</a></li>
		<li class="active">Registro de art&iacute;culo</li>
	</ol>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title">Registro de artículo</h3>
		</div>
		<form id="form-registro-articulo" action="registroarticulo/registroArticulo" method="post">
			<div class="panel-body">
				<div class="form-group">
					<label for=""><b>Nombre del art&iacute;culo:</b></label>
					<input id="articulo-nombre" type="text" class="form-control" autofocus="" name="nombre">
				</div>
				<div class="row">
					<div class="col-sm-6">
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
					<div class="col-sm-6">
						<div class="form-group">
							<label for=""><b>Tipo de art&iacute;culo:</b></label>
							<select name="tipo-articulo" id="tipo-articulo" class="form-control">
								<option value="extenso">Extenso</option>
								<option value="poster">Poster</option>
							</select>
						</div>
					</div>
				</div>
				<br> 
				<div class="form-group">
					<input type="file" id="archivo" name="archivo">
					<p class="help-block">Solo se permiten archivos con extencion .doc o .docx.</p>
					<p class="help-block">Para un mejor rendimiento considere las siguientes indicaciones:</p>
					<p class="help-block"><i class="glyphicon glyphicon-ok"></i>&nbsp;Tama&ntilde;o maximo: 1000 kb. (10MB.)<br>
					<i class="glyphicon glyphicon-ok"></i>&nbsp;Documentos de word 2003 (.doc). <br>
					<i class="glyphicon glyphicon-ok"></i>&nbsp;Use nombres de archivos cortos.
					</p>
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
		</form>
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