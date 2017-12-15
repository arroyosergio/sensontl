<?php

class Talleres extends Controller {

    function __construct() {
        parent::__construct();
        $this->view->js = array(
            'views/talleres/js/talleres.js'
        );
    }

    function index() {
        $this->view->render("talleres/index");
    }

}
