<?php
namespace Forms;
use TCPDF;

class FormA1 extends TCPDF{
  public function Header(){
    $image_file = './cas.jpg';
    $this->Image($image_file, 18, 8, 22, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        
    $this->SetFont('helvetica', 'B', 11.5);
    $this->setCellMargins(20,0,0,0);
    $this->MultiCell(0,8,'COOPERATIVA DE AHORRO Y CRÉDITO DE VÍNCULO LABORAL',0,'C',0,0,8,10,true, 0, false, true, 8, 'M');
    $this->MultiCell(0,8,'OFICIALES DE CABALLERÍA "APOSTOL SANTIAGO" RL.',0,'C',0,0,8,14,true, 0, false, true, 8, 'M');

  }
  public function Footer(){}

  public static function getFechaLiteral($cadFecha){
    $meses = array(
      "01"=>"enero","02"=>"febrero","03"=>"marzo",
      "04"=>"abril","05"=>"mayo","06"=>"junio",
      "07"=>"julio","08"=>"agosto","09"=>"septiembre",
      "10"=>"octubre","11"=>"noviembre","12"=>"diciembre"
    );
    $fecha = explode("-", $cadFecha);
    return $fecha[2]." de ".$meses[$fecha[1]]." de ".$fecha[0];
  }
  public static function getCiudadExtension($abrev){
    $ciudades = array(
      "LP"=>"La Paz",
      "OR"=>"Oruro",
      "PT"=>"Potosí",
      "CB"=>"Cochabamba",
      "SC"=>"Santa Cruz",
      "BN"=>"Beni",
      "PA"=>"Pando",
      "TJ"=>"Tarija",
      "CH"=>"Chuquisaca"
    );
    return isset($ciudades[$abrev])?$ciudades[$abrev]:"";
  }
}

class FormUtils{
  public static function getData(){
    
  }
}


?>