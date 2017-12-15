<?php

class Controller {

    function __construct() {
//        echo "main controller <br/>";
        $this->view = new View();
       
    }
    
    public function loadModel($modelName) {
        $file = 'models/'.$modelName.'_model.php';
         if (file_exists($file)) {
            require_once $file;
            $modelName = $modelName ."_Model";
            $this->model = new $modelName;
        }
    }
    
    public function loadMail() {
        $classPhpMailer = 'libs/class.phpmailer.php';
        if (file_exists($classPhpMailer)) {
            require_once $classPhpMailer;
            $this->mail = new PHPMailer;
            $this->mail->SMTP = TRUE;
            $this->mail->Host = HOST_MAIL;
            $this->mail->SMTPAuth = true;
            $this->mail->Username = USER_SMTP;
            $this->mail->Password = PASS_SMTP;
            $this->mail->Port = '26';
        }
    }
    
    public function loadPDF() {
        $classfpdf = 'libs/pdf/fpdf.php';
        if (file_exists($classfpdf)) {
            require_once $classfpdf;
            $this->GeneratePDF = new FPDF();
        }
    }
    
//    public function loadBarCodeEAN13() {
//        $fileClass = 'libs/pdf/ean13.php';
//        if (file_exists($fileClass)) {
//            require_once $fileClass;
//            $this->BarCondeEAN13 = new PDF_EAN13();
//        }
//    }

}