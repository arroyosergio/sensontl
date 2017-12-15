<?php

class Hospedaje extends Controller {

    function __construct() {
        parent::__construct();
//        Session::init();
//        $logged = Session::get("sesion");
//        if (!$logged) {
//            Session::destroy();
//            header("location: index");
//            exit;
//        }
//        $this->view->css = array(
//            'public/plugins/toastr/toastr.min.css',
//            'public/plugins/datatable/jquery.datatables.min.css',
//            'public/plugins/datapicker/bootstrap-datepicker.min.css',
//        );
        $this->view->js = array(
            'views/hospedaje/js/hospedaje.js'
        );
    }

    function index() {
        $this->view->render("hospedaje/index");
    }

}
