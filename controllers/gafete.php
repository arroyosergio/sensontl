<?php

class Gafete extends Controller {

    function __construct() {
        parent::__construct();
        Session::init();
        $logged = Session::get("sesion");
        if (!$logged) {
            Session::destroy();
            header("location: index");
            exit;
        }
    }

    function index() {
//        if (!empty($_GET['id'])) {
        $this->view->tblAsistentes = $this->listaAsistentes($_GET['id']);
        $this->view->render("gafete/index");
//        } else {
//            header("location: index");
//        }
    }

    function listaAsistentes($id) {
        $responseDB = $this->model->get_asistentes($id);
        if (!$responseDB) {
            $tabla = '<h2 class="text-center">No tienes nig&uacute;n art&iacute;culo registrado</h2>';
        } else {
            $tabla .= '<table class="table table-striped table-hover" id="tbl-asistentes">' .
                    '<thead>' .
                    '<tr>' .
                    '<th class="">Id</th>' .
                    '<th>Nombre</th>' .
                    '<th>Tipo</th>' .
                    '<th>Artículo</th>' .
                    '<th class="text-center">Gafete</th>' .
                    '</tr>' .
                    '</thead>';
            $tabla .= '<tbody>';
            foreach ($responseDB as $asistente) {
                $tabla .= '<tr>';
                $tabla .= '<td class="td-tabla">' . $asistente['art_id'] . '</td>';
                $tabla .= '<td class="td-tabla">' . utf8_encode($asistente['asi_nombre']) . '</td>';
                $tabla .= '<td class="td-tabla">' . $asistente['asi_tipo'] . '</td>';
                $tabla .= '<td class="td-tabla">' . $asistente['artNombre'] . '</td>';
//                $tabla .= '<td class="text-center"><a href="gafete/generarGafete?id=' . $asistente['art_id'] . '&nombre=' . $asistente['asi_nombre'] . '&tipo=' . $asistente['asi_tipo'] . '&art='.$asistente['artNombre'].'"><span class="glyphicon glyphicon-share-alt"></span> Generar</a></td>';
                $tabla .= '<td class="text-center"><a href="gafete/generarGafete?asi=' . $asistente['asi_id'] . '&id=' . $asistente['art_id'] . '"><span class="glyphicon glyphicon-share-alt"></span> Generar</a></td>';
            }
            $tabla .= '</tr>';
            $tabla .= '</tbody>';
            $tabla .= '</table>';
        }
        return $tabla;
    }

    function generarGafete() {
        if (empty($_GET['id']) || empty($_GET['asi'])) {
//            header("location: misArticulos");
        } else {
            $asistente = $this->model->get_datos_asistente($_GET['id'], $_GET['asi']);
            $nombreEvento = "Congreso Interdisciplinario de Cuerpos Académicos 2017";
            $nombreEvento = utf8_decode($nombreEvento);

            $fecha = "27y 28 de Septiembre del 2017 Guanajuato, Gto.";
            $lugar = "Centro de Convenciones y Auditorio Pueblito de Rocha s/n " .
                    "Guanajuato, Gto.";


            $pdf = $this->GeneratePDF;

            $pdf->AddPage();
            $pdf->AddFont('Sansation', '', 'Sansation_Bold.php');
            $pdf->SetMargins(20, 20, 10);
            $pdf->SetDrawColor(217, 217, 217);
            $pdf->SetLineWidth(1.5);
            $pdf->SetFont('Sansation', '', 12);

            $pdf->Rect(65, 10, 70, 10);
            $pdf->Rect(65, 10, 70, 120);

//        LOGO CICA
            $pdf->Image('./public/img/cica2017.png', 78, 22, 45, 45);


//        CODIGO DE BARRAS
            $pdf->Rect(65, 115, 70, 15);
            $pdf->EAN13(72, 116, $asistente['art_id'], 8, .60);

//        PONENCIA
            $pdf->SetXY(65, 68);
            $nombreArticulo = $asistente['artNombre'];
            $nombreArticulo = substr($nombreArticulo, 0, 90);
            $pdf->MultiCell(70, 6, $nombreArticulo, 0, 'C', false);

//        AUTOR
            $pdf->SetXY(65, 94);
            $pdf->SetFontSize(14);
            $pdf->MultiCell(70, 6, $asistente['asi_nombre'], 0, 'C', false);

//        TIPO DE ASISTENTE
            $pdf->SetXY(65, 105);
            $pdf->SetFillColor(15, 117, 188);
            $pdf->SetFontSize(16);
            $pdf->SetTextColor(255, 255, 255);
            $tipo = $asistente['asi_tipo'];
            if ($tipo == 'general') {
                $tipo = 'publico general';
            }
            $pdf->MultiCell(70, 10, utf8_decode(strtoupper($tipo)), 0, 'C', TRUE);

            $pdf->SetFontSize(12);
            $pdf->SetTextColor(0, 0, 0);

            $pdf->SetFillColor(217, 217, 217);
            $pdf->Circle(101, 15, 3);

            $pdf->Output('I', 'gafete.pdf');
        }
    }

}
