        <foother class="foother">
        	<div class="container foother-container">
        		<div class="row">
                    <div class="col-lg-3 col-sm-3   wow fadeInUp animated " data-wow-duration="2.5s" data-wow-delay="4s" data-wow-animation-name="fadeInUp" style="visibility: visible; animation-duration: 2.5s; animation-delay: .1s; animation-name: fadeInUp;">
                        <div class="contact-info">
                            <h4 class="foother_title">Información de contacto</h4>
                            <address>
                                <p class="address"><span class="resalted"><strong>Persona de contacto	</strong></span></p>
                                <p><i class="fa fa-user-circle-o" aria-hidden="true"></i> Posición en la organización </p>
                                <span> <i class="fa fa-phone-square" aria-hidden="true"></i> Teléfono : (456) 64 371 80 
                                <br>
                                Extensiones: 101, 106, 121 y 105 </span>
                                <p><i class="fa fa-envelope-o" aria-hidden="true"></i> &nbsp;Email :  <a href="mailto:correo@cica.com">correo@dominio.com</a></p>
                            </address>
                        </div>
                    </div>
        			<div class="col-lg-3 col-sm-3 wow fadeInUp animated" data-wow-duration="2.5s" data-wow-delay="4s" data-wow-animation-name="fadeInUp" style="visibility: visible; animation-duration: 2.5s; animation-delay: .5s; animation-name: fadeInUp;">
                        <div class="navigation">
                            <a href="index"><h4>CICA 2018</h4></a>
                            <p><a href="fechasImportantes">Fechas importantes</a></p>
                            <p><a href="guia">Autores</a></p>
                            <p><a href="informacion">Asistentes</a></p>
                            <p><a href="noticias">Noticias</a></p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6 wow fadeInUp animated" data-wow-duration="2.5s" data-wow-delay="4s" data-wow-animation-name="fadeInUp" style="visibility: visible; animation-duration: 2.5s; animation-delay: .9s; animation-name: fadeInUp;">
                          <h4>Gobierno del Estado de Guanajuato</h4>
                    </div>
        		</div>
        	</div>
        </foother>
        <foother class="foother-small">
        	<div class="container small-foother-container">
        		<div class="row">
        			<div class="col-md-12">
        				<div class="copyright text-center">
							<p>Copyright 2018 Congreso Interdisciplinario de Cuerpos Académicos </p>
                            <p>
                                <i data-toggle="tooltip" title="HTML5" class="fa fa-html5" aria-hidden="true"></i>
                                <i data-toggle="tooltip" title="Chrome" class="fa fa-chrome" aria-hidden="true"></i>
                                <i data-toggle="tooltip" title="Firefox" class="fa fa-firefox" aria-hidden="true"></i>
                                <i data-toggle="tooltip" title="Safari" class="fa fa-safari" aria-hidden="true"></i>
                            </p>
        				</div>
        			</div>
        		</div>
        	</div>
        </foother>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/prism/0.0.1/prism.min.js"></script>
        <?php 
            if (isset($this->js)) {
                foreach ($this->js as $js) {
                    echo '<script src="'.URL.$js.'"></script>';
                }
            }
         ?>
        <script>
                $(function () {
                    // You can use any kind of selectors for jQuery Fluidbox
                    $('.main_container a[data-fluidbox]').fluidbox();
                    $('.navbar-header a[data-fluidbox]').fluidbox();
                });
        </script>
    </body>
</html>