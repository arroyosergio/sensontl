<div class="container">
	<ol class="breadcrumb">
		<li><a href="index">Inicio</a></li>
		<li class="active">Perfil</li>
	</ol>
	<form id="form-info-perfil" action="perfil/guardarCambiosPerfil" method="post">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Información del perfil</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for=""><b>Nombre:</b></label>
							<input id="nombre" name="nombre" type="text" class="form-control">
						</div>	
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for=""><b>Apellido paterno:</b></label>
									<input id="apellido-paterno" name="apellido-paterno" type="text" class="form-control">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for=""><b>Apellido materno:</b></label>
									<input id="apellido-materno" name="apellido-materno" type="text" class="form-control">
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for=""><b>Pa&iacute;s:</b></label>
							<select name="pais" id="pais" class="form-control">
								<?php echo $this->selectPaises; ?>
							</select>
						<!-- 	<input id="pais" name="pais" type="text" class="form-control"> -->
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for=""><b>Estado:</b></label>
									<select name="estado" id="estado" class="form-control"></select>
									<!-- <input id="estado" name="estado" type="text" class="form-control"> -->
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<label for=""><b>Ciudad:</b></label>
									<input id="ciudad" name="ciudad" type="text" class="form-control">
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for=""><b>Grado acad&eacute;mico:</b></label>
							<select name="grado-academico" class="form-control" id="grado-academico">
								<option value="licenciatura">Licenciatura</option>
								<option value="maestria">Maestr&iacute;a</option>
								<option value="doctorado">Doctorado</option>
							</select>
						</div>
						<div class="form-group">
							<label for=""><b>Instituci&oacute;n de procedencia:</b></label>
							<input id="institucion-procedencia" name="institucion-procedencia" type="text" class="form-control">
						</div>
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
							<label id="lbl-input-tipo-institucion" for="" class="hidden"><b>Otra:</b></label>
							<input id="input-tipo-institucion" name="tipo-institucion" class="form-control hidden"></input>
						</div>
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
			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-12 text-right">
						<button id="btn-cambiar-password" class="btn btn-info"><i class="glyphicon glyphicon-cog"></i> Cambiar contrase&ntilde;a</button>
						<button class="btn btn-success"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	<form id="form-cambiar-password" action="perfil/cambiarPassword" method="post">
	    <div id="modal-cambiar-password" class="modal fade" tabindex="-1" role="dialog">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                    <h4 class="modal-title">Cambiar contrase&ntilde;a</h4>
	                </div>
	                <div class="modal-body">
	                    <div class="form-group">
	                        <label for=""><b>Contrase&ntilde;a actual:</b></label>
	                        <input type="password" class="form-control" name="password-actual">
	                    </div>
	                    <div class="form-group">
	                        <label for=""><b>Nueva Contrase&ntilde;a:</b></label>
	                        <input type="password" class="form-control" name="nuevo-password">
	                    </div>
	                    <div class="form-group">
	                        <label for=""><b>Repetir contrase&ntilde;a:</b></label>
	                        <input type="password" class="form-control" name="rpassword">
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
</div>