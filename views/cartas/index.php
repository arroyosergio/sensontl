<div class="container">
	<ol class="breadcrumb">
		<li><a href="index">Inicio</a></li>
		<li class="active">Cartas</li>
	</ol>
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Cartas</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<?php echo $this->tblCartas; ?>
					</div>
				</div>
				<div class="panel-footer"></div>
			</div>
		</div>
	</div>
	 <div id="modal-detalles-cartas" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Detalles de cartas</h4>
                </div>
                <div class="modal-body">
                   <div id="cartas" class="tab-pane" role="tabpanel">
                          <div id="div-carta-originalidad" class="form-group col-sm-4"" ></div>
                          <div id="div-carta-derechos" class="form-group col-sm-8""></div>
                          <div id="div-validacion-derechos">
                             <label><b>Validar cartas de Originalidad y Ceci&oacute;n de derechos:</b></label>
                             <label class="radio-inline">
                                 <input type="checkbox" name="validacion-cartas" id="chkvalidacion-cartas" />
                             </label>
                          </div>
                          <div id="div-enviar-correo">
                             <div >
                              <label><b>Correo de validacion para las cartas :</b></label>
                              <textarea class="form-control" rows="4"  id="comentario_val_cartas" name="comentario_val_cartas" autofocus></textarea>
                             </div>
                             <br/>
                             <div class="text-right">
                             <button class="btn btn-primary " id="btn_enviar"><i class="glyphicon glyphicon-ok"></i>Enviar</button>
                          	 </div>
                          </div>
                          <hr>
                          <div class="form-group">
			              	<label for=""><b>Carta de aceptaci&oacute;n:</b></label>
			              	<input id="input-carta-aceptacion" type="file" name="aceptacion" >
			              	<p class="help-block" >Solo se permiten archivos con extensi&oacute;n .pdf</p>
			              </div>
			              <div class="row">
		            		<div class="col-sm-12" >
		            		   <div id="documentos-actuales" class="row"></div>
		            		   <span id="id_Articulo_carta_aceptacion" class="hidden"></span>
		            		</div>
		            	  </div>
                   </div>
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Cerrar</button>
                </div>
            </div><!-- /.modal-content --> 
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal --> 
</div>