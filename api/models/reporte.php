<?php

namespace App\Models;

require_once('../dompdf/autoload.inc.php');

use Dompdf\Dompdf;
use Dompdf\Options;

class Reporte {

    private $pdf;
    private $options;

    public function __construct(){
        
        $this->pdf = new Dompdf();
        $this->options = new Options(); 
        $this->pdf->setPaper('letter','portrait');
        $this->options->set('isPhpEnabled', 'true');
    }

    public function setPaper($size, $orientation){

        $this->pdf->setPaper($size, $orientation);
    }

    public function setOption($option, $value){
        $this->pdf->set_option($option, $value);
    }

    public function loadView($view, $data){
        extract($data);

        ob_start();

        require(__DIR__ . '/../../api/views/' . $view . '.php');

        $html = ob_get_clean();
        
        $this->pdf->loadHtml($html);
    
        $this->pdf->render();
    }

    public function stream($filename){
        $this->pdf->stream($filename, array("Attachment" => false));
    }

    public function paginate(){
        $color = array(108/255, 117/255, 125/255);
        $this->pdf->get_canvas()->page_text(292, 760, '{PAGE_NUM} de {PAGE_COUNT}', null, 12, $color);
    }

    public static function getMonthsLiteral(){
        return array(
            '01' => "enero",
            '02' => "febrero",
            '03' => "marzo",
            '04' => "abril",
            '05' => "mayo",
            '06' => "junio",
            '07' => "julio",
            '08' => "agosto",
            '09' => "septiembre",
            '10' => "octubre",
            '11' => "noviembre",
            '12' => "diciembre",
        );
    }

    public static function convertMonthLiteral($month){
        $months = array(
            '01' => "enero",
            '02' => "febrero",
            '03' => "marzo",
            '04' => "abril",
            '05' => "mayo",
            '06' => "junio",
            '07' => "julio",
            '08' => "agosto",
            '09' => "septiembre",
            '10' => "octubre",
            '11' => "noviembre",
            '12' => "diciembre",
        );
        return isset($months[$month]) ? $months[$month] : 'S/N';
    }

}