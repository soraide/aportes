<?php
    require_once('../dompdf/autoload.inc.php');

    use Dompdf\Dompdf;
    use Dompdf\Options;

    class ReportModel{

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

        public function loadView($view,$data){
            ob_start();

            require($view);

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

    }

?>