<?php 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\PageMargins;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooterDrawing;

require 'vendor/autoload.php';

$hoja_calculo = new Spreadsheet();
$hoja_activa = $hoja_calculo->getActiveSheet();
// $hoja_activa->getHeaderFooter()->setOddHeader('Encabezado de la página');
// $encabezado = "&F - &D - &P";
// $hoja_activa->getHeaderFooter()->setOddHeader($encabezado);
// $encabezado = "&L Mi encabezado alineado a la izquierda. &R hola este encabezado esta a la derecha.";
// $hoja_activa->getHeaderFooter()->setOddHeader($encabezado);
// $encabezado = "&G perro.jpg";
// $hoja_activa->getHeaderFooter()->setOddHeader($encabezado);
// $encabezado = "&G perro.jpg &H30";
// $hoja_activa->getHeaderFooter()->setOddHeader($encabezado);

// $hoja_activa->setPrintScale(85);
$hoja_activa->getPageSetup()->setScale(56);


$drawing = new HeaderFooterDrawing();
$drawing->setName('PhpSpreadsheet logo');
// $drawing->setPath('app/files/images/example.jpeg');
$drawing->setPath('perro.jpg');
$drawing->setHeight(25);
$hoja_activa->getHeaderFooter()->addImage($drawing, \PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooter::IMAGE_HEADER_RIGHT);

// Set header
$hoja_activa->getHeaderFooter()->setOddHeader('&L&"Verdana,Negrita"&8HEADER TEXT&R&G');

$pageMargins = new PageMargins();
$pageMargins->setTop(0.79);
$pageMargins->setBottom(0);
$pageMargins->setLeft(0.2);
$pageMargins->setRight(0.2);
$hoja_activa->setPageMargins($pageMargins);

$hoja_activa->setCellValue('A1', 'Nombres');
$hoja_activa->setCellValue('B1', 'Edades');
$hoja_activa->setCellValue('A2', 'Juanes');
$hoja_activa->setCellValue('B2', '31');



$archivo = 'datos';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $archivo . '.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($hoja_calculo);
$writer->save('php://output');