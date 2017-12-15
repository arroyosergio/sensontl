<?php

class Programa extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array(
            'views/programa/js/programa.js'
        );
    }

    function index() {
        $this->view->render("programa/index");
    }

}
