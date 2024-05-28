<?php

namespace App\Models;

require_once('../phpSpreadsheet/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReporteXLSX {
    
    private $name;
    private $path;
    private $numHeaders;
    //private $spreadsheet;
    private $sheet;

    public function __construct($name, $temporal, $numHeaders = 0, $headers = []){
        $this->name = $name;
        $this->path = $temporal;
        $this->sheet = null;
        $this->numHeaders = $numHeaders;
        $this->headers = $headers;
        //$this->spreadsheet = new Spreadsheet();
    }

    public function load(){
        $ioFactory = IOFactory::load($this->path);
        $sheet = $ioFactory->getActiveSheet();

        $data = array();

        $dataArray = $sheet->toArray();

        foreach ($dataArray as $key => $row) {
            if($key >= $this->numHeaders){
                $rowData = array();
                foreach ($row as $key => $cellValue) {
                    $rowData[isset($this->headers[$key]) ? $this->headers[$key] : 'non'] = $cellValue;
                }
                array_push($data, $rowData);
            }
        }

        return $data;

    }

}

?>