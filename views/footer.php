<!--     </div> -->
    <footer class="footer">
        <div class="row">
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 text-center footer_responsive">
                    <br>
                    <h4><b>INFORMES:</b></h4>
                    <p>Carretera Valle-Huan&iacute;maro Km. 1.2 <br>Valle de Santiago, Gto. <br>Tel. (456) 64 371 80 ext. 101, 106, 121 y 105</p>
                </div>
                <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <img src="<?php echo URL.'public/img/gto.jpg'; ?>" alt="" class="img img-responsive center-block">
                </div>
                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 ">
                    <div class="row footer_responsive" >
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <img src="<?php echo URL.'public/img/sep1.png'; ?>" alt="" class="img img-responsive center-block" style="padding-top: 66px;">
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <img src="<?php echo URL.'public/img/aniversario.png'; ?>" alt="" class="img img-responsive center-block" style="padding-top: 10px;">
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <img src="<?php echo URL.'public/img/anut.png'; ?>" alt="" class="img img-responsive center-block" style="padding-top: 66px;">
                        </div>
                    </div>
                </div>
        </div>
        <div class="text-center footer_responsive" style="background-color: #0168B3; padding: 2px;">
            <h4>Gobierno del Estado de Guanajuato &#8226; Secretaría de educación</h4>
        </div>
    </footer>
    <!--  MODAL LOGIN -->
    <div id="modal-login" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                   <!--  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                    <ul id="menu-login" class="nav nav-pills nav-justified" role="tablist">
                        <li role="presentation" class="active"><a href="#login" aria-controls="login" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-lock"></span> Acceso</a></li>
                        <li role="presentation"><a href="#registro" aria-controls="registro" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-plus"></span> Registro</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div id="login" class="tab-pane active" role="tabpanel">
                        <form id="form-login" action="index/login" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="text" name="correo" placeholder="Correo" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="password" id="login-password" name="password" placeholder="Contraseña" class="form-control">
                                </div>
                                <a href="#" data-toggle="modal" data-target="#modal-recuperar-password">¿Olvidaste tu contraseña?</a>
                            </div>
                            <div class="modal-footer" >
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Cancelar</button>
                                <button class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Aceptar</button>
                            </div>
                        </form>
                    </div>
                    <div id="registro" class="tab-pane" role="tabpanel">
                        <form  id="form-nuevo-registro" action="index/nuevoRegistro" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input id="input-correo-nuevo-registro" type="text" class="form-control" name="correo" placeholder="Correo">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="Contraseña">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="rpassword" placeholder="Repetir Contraseña">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Cancelar</button>
                                <button class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Aceptar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form id="form-recuperar-password" action="index/recuperarPassword" method="post">
        <div id="modal-recuperar-password" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Recuperar contrase&ntilde;a</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for=""><b>Correo:</b></label>
                            <input id="input-corrreo-recuperar-pass" type="text" class="form-control" name="correo" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Cancelar</button>
                        <button class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i> Aceptar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </form>
    <!-- MODAL CONFERENCIA MAGISTRAL -->
     <div id="modal-conferencia-magistral" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Dr. Luis Arturo Godinez Mora-Tovar</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-justify">
                                Nació en la Ciudad de México el 10 de noviembre de 1967. Curso estudios de licenciatura en Ingeniería Química en la Facultad de Química de la UNAM, en donde también obtuvo el grado de maestría en Ciencias Químicas (Fisicoquímica).
                                </p>
                                <br>
                                <p class="text-justify">
                                Durante sus estudios, Luis Godínez obtuvo varios reconocimientos académicos entre los que se cuentan, la medalla Gabino Barreda por la UNAM en los estudios de maestría cursados (mejor promedio de la generación) en esa institución, el Award for Academic Merit y el Best First Year Academic Record, otorgados por la Universidad de Miami y el Departamento de Química de esa universidad en los EUA y el premio Juan Sánchez Scholar Award por el CIMAV-UT.
                                </p> 
                            </div>
                            <div class="col-md-6">
                               <img src="<?php echo URL.'public/img/mora_tovar.png'; ?>" alt="" class="img img-responsive center-block" style="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Cerrar</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    <script src="<?php echo URL; ?>public/plugins/jquery-2.1.4.min.js"></script>
	<script src="<?php echo URL; ?>public/bootstrap/js/bootstrap.min.js"></script>
	<?php 
        if (isset($this->js)) {
            foreach ($this->js as $js) {
                echo '<script src="'.URL.$js.'"></script>';
            }
        }
     ?>
</body>
</html>