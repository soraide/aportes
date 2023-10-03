<?php
include('../panel/tcpdf/tcpdf.php');
include('./classForms.php');
use Forms\FormA1;
session_start();
date_default_timezone_set('America/La_Paz');
$user = json_decode($_SESSION['usuario']);
// print_r($user);

$carta = array(215.9, 279.4);

$pdf = new FormA1(PDF_PAGE_ORIENTATION, 'mm', $carta, true, 'UTF-8', false);
$pdf->SetMargins(20, 20, 20, 20);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('STIS Bolivia - CAS RL.');
$pdf->SetTitle('Formulario 1-A-B');
$pdf->SetSubject('--');

// $pdf->setPrintHeader(true);
// $pdf->setPrintFooter(true);
$pdf->SetAutoPageBreak(true, 13);

$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 7.5);
$pdf->MultiCell(0,8,'FORM. "CAS" R.L. 1-A'."\n".'Nro. ...........................',0,'R',0,0,8,24,true, 0, false, true, 8, 'M');

$pdf->SetFont('helvetica', 'BU', 12);
$pdf->setCellMargins(20,0,0,0);
$pdf->MultiCell(0,8,'SOLICITUD DE VINCULACIÓN',0,'C',0,0,8,35,true, 0, false, true, 8, 'M');

$pdf->SetFont('helvetica', '', 9);
$txt = 'El Presidente del Consejo Administrativo de la Cooperativa de Ahorro y Crédito de Vínculo Laboral “Oficiales de';

$pdf->MultiCell(0,6,$txt, 0, 'J',0,0,8,45,true, 0, false, true, 8, 'M');
// $pdf->Cell(0,6,$txt, 1, 1, 'J', false, '', 0, false, 'C', 'M');
$txt = '<p style="line-height: 2.5;">Caballería Apóstol Santiago” R.L., con atribuciones amplias y suficientes otorgadas por el Consejo de Administración, por otra parte, el señor (a): <b>'.strtoupper($user->nombres).' '.strtoupper($user->paterno).' '.strtoupper($user->materno).'</b>, mayor de edad, hábil por derecho con C.I. <b>'.$user->ci.'</b> expedido en '.FormA1::getCiudadExtension($user->expedido).'. Estado Civil '.ucfirst(strtolower($user->estadoCivil)).'. C.M. <u>'.$user->carnetMilitar.'.</u> C/COSSMIL. '.$user->carnetCossmil.'. Fecha de Nacimiento '.FormA1::getFechaLiteral($user->fechaNac).'. Dirección Actual Z. '.$user->zona.', '.$user->avenida.' Nro. '.$user->nroDir.'. Ciudad '.$user->ciudad.'. Proveniente del: <u>'.$user->provieneFuerza.'</u>. Grado: '.$user->grado.' con arma de '.$user->arma.' con fecha de Incorporación/Egreso '.FormA1::getFechaLiteral($user->fechaIncorporacion).'. Código de Boleta '.$user->codBoleta.' Telef. y/o Cel. '.$user->celular.', correo electrónico '.$user->correoElec.' que en adelante se denominará ASOCIADO o ASOCIADA, acordamos en forma conjunta lo siguiente:</p>';
// echo $txt;
$pdf->setCellMargins(30,0,0,0);
$pdf->setCellPaddings(0,0,0.5,0);
$pdf->MultiCell(0, 50, $txt, 0, 'J',false, 1, 8, 51,true,0,true, true);

$pdf->setCellMargins(15,0,0,0);

$txt = '<p style="line-height: 1.7;">
<ol style="text-align: justify;">
  <li>De acuerdo al Plan de Trabajo del “C.A.S.” RL., se invitó al personal de Oficiales (Superiores y Subalternos), 
Suboficiales, Sargentos de Armas y Servicios, Empleados Civiles de las Fuerzas Armadas, para vincularse a la 
Cooperativa de Ahorro y Crédito de Vínculo Laboral “Oficiales de Caballería Apóstol Santiago” R.L., en calidad 
de ASOCIADO o ASOCIADA.</li>
  <li>El Consejo Administrativo, se compromete hacer cumplir todos los derechos que tienen sus ASOCIADOS o 
ASOCIADAS, de acuerdo al Estatuto Orgánico y Reglamentos del “CAS” R.L.</li>
  <li>El nuevo Asociado(a), se compromete a cumplir todas las obligaciones que tienen dentro de la Cooperativa de 
Ahorro y Crédito de Vínculo Laboral “Oficiales de Caballería Apóstol Santiago” R.L.</li> 
  <li>El nuevo Asociado(a) autoriza en forma expresa y voluntaria a la Cooperativa de Ahorro y Crédito de Vínculo 
Laboral “Oficiales de Caballería Apóstol Santiago” R.L., el descuento mensual mediante el Ministerio de Defensa 
del 5 % del total ganado.</li>
  <li>El nuevo Asociado(a) autoriza el descuento de Bs. 10 (Diez 00/100 bolivianos) para vinculación y/o retiro de la cooperativa según normativa de la AFCOOP, mismo que será descontado del aporte del 5%.</li>
  <li>El nuevo Asociado(a) autoriza el descuento de un monto minimo de tasa mensual obligatoria de acuerdo al D.S. 2762 según corresponda, mismo que será descontado del aporte mensual del 5%.</li>
  <li>El nuevo Asociado(a) se compromete a cumplir el ESTATUTO ORGÁNICO de la Cooperativa, los REGLAMENTOS en actual vigencia, además de cualquier otra normativa autorizada en el “CAS” R.L.</li>
</ol>
</p>';
$pdf->setCellPaddings(0,0,0.5,0);
$pdf->MultiCell(0, 40, $txt, 0, 'J',false, 1, 8, 109,true,0,true, true);

$txt = 'Como constancia y conformidad con lo establecido en los siete puntos anteriores, firmamos al pie del presente documento.';
$pdf->setCellMargins(20,0,0,0);
$pdf->MultiCell(0, 6, $txt, 0, 'J',0,0,8,215,true, 0, false, true, 8, 'M');

$hoy = date('Y-m-d');
$txt = 'La Paz, '.FormA1::getFechaLiteral($hoy);
$pdf->setCellMargins(20,0,0,0);
$pdf->MultiCell(0, 6, $txt, 0, 'R',0,0,8,220,true, 0, false, true, 8, 'M');

$pdf->SetFont('helvetica', 'B', 10);
$pdf->setCellMargins(20,0,0,0);
$pdf->MultiCell(0,8,'.........................................................',0,'C',0,0,8,227,true, 0, false, true, 8, 'M');
$pdf->MultiCell(0,8,'ASOCIADO o ASOCIADA.',0,'C',0,0,8,231,true, 0, false, true, 8, 'M');

$pdf->setCellMargins(120,0,0,0);
$pdf->MultiCell(0,8,'.........................................................',0,'C',0,0,8,245,true, 0, false, true, 8, 'M');
$pdf->MultiCell(0,8,'PRESIDENTE "CAS" R.L.',0,'C',0,0,8,249,true, 0, false, true, 8, 'M');


//************************ */
//  FIN PAGINA 1
$pdf->AddPage();
$pdf->SetFont('helvetica', 'B', 7.5);
$pdf->MultiCell(0,8,'FORM. "CAS" R.L. 1-B'."\n".'V.2              ',0,'R',0,0,8,24,true, 0, false, true, 8, 'M');
$pdf->SetFont('helvetica', 'BU', 12);
$pdf->setCellMargins(20,0,0,0);
$pdf->MultiCell(0,8,'MANIFESTACIÓN DE CONFORMIDAD AL PAGO DEL',0,'C',0,0,8,35,true, 0, false, true, 8, 'M');
$pdf->MultiCell(0,8,'FONDO VOLUNTARIO SOLIDARIO POR FALLECIMIENTO',0,'C',0,0,8,40,true, 0, false, true, 8, 'M');

$txt = '<p style="line-height: 1.5;">La Cooperativa de Ahorro y Crédito de Vínculo Laboral Oficiales de Caballería “Apóstol Santiago R.L.” representado legalmente por el Presidente del Consejo de Administración y el Asociado <b>'.strtoupper($user->nombres).' '.strtoupper($user->paterno).' '.strtoupper($user->materno).'</b> con C.I. '.$user->ci.'	'.$user->expedido.'. acuerdan voluntariamente el descuento mensual individual de $us 2 (Dos 00/100 Dólares americanos), aporte destinado al fondo solidario, para que, en caso de FALLECIMIENTO, los herederos legales sean beneficiados con un monto único, previa verificación del vínculo.</p>';
$pdf->setCellMargins(20,0,0,0);
$pdf->SetFont('helvetica', '', 10);
$pdf->MultiCell(0, 40, $txt, 0, 'J',false, 1, 8, 50,true,0,true, true);

$pdf->setCellMargins(7,0,0,0);
$tabla = '
<table border="1" cellpadding="2" cellspacing="0">
  <tr style="font-weight:bold;text-align:center;padding-top:5px;">
    <td style="height:25px;border-left:1px solid #000">Nº</td>
    <td style="height:25px;border-left:1px solid #000"colspan="4">NOMBRES Y APELLIDOS</td>
    <td style="height:25px;border-left:1px solid #000"colspan="3">C.I.</td>
    <td style="height:25px;border-left:1px solid #000"colspan="3">PARENTESCO</td>
    <td style="height:25px;border-left:1px solid #000;border-right:1px solid #000"colspan="2">TELÉFONO</td>
  </tr>
  '.
  str_repeat('<tr>
  <td style="height:22px;border:1px solid #000;"></td>
  <td style="height:22px;border:1px solid #000;"colspan="4"></td>
  <td style="height:22px;border:1px solid #000;"colspan="3"></td>
  <td style="height:22px;border:1px solid #000;"colspan="3"></td>
  <td style="height:22px;border:1px solid #000;"colspan="2"></td>
</tr>', 7)
  .' 
</table>
';
$pdf->WriteHTMLCell(0, 0, '', '83', $tabla, 0, 0);

$pdf->setCellMargins(20,0,0,0);
$pdf->SetFont('helvetica', '', 10);
$pdf->MultiCell(0, 40, 'Lugar y Fecha: La Paz, '.FormA1::getFechaLiteral($hoy), 0, 'L',false, 1, 8, 146,true,0,true, true);
$pdf->MultiCell(0, 40, '...................................................', 0, 'C',false, 1, 8, 158,true,0,true, true);
$pdf->MultiCell(0, 40, 'ASOCIADO o ASOCIADA', 0, 'C',false, 1, 8, 163,true,0,true, true);
$pdf->SetFont('helvetica', 'BU', 12);
$pdf->setCellMargins(20,0,0,0);
$pdf->MultiCell(0,8,'DECLINACIÓN AL PAGO DEL FONDO VOLUNTARIO',0,'C',0,0,8,173,true, 0, false, true, 8, 'M');
$pdf->MultiCell(0,8,'SOLIDARIO POR FALLECIMIENTO',0,'C',0,0,8,177,true, 0, false, true, 8, 'M');

$txt = 'Yo, '.$user->nombres.' '.$user->paterno.' '.$user->materno.', hábil por derecho, como asociado de la Cooperativa Apóstol Santiago, declaro haber sido informado de este beneficio y no autorizo el descuento de $us 2 (Dos 00/100 Dólares americanos), aceptando y reconociendo que en caso de fallecimiento mis herederos legales no recibirán el beneficio del pago único por el Fondo Voluntario Solidario.';
$pdf->SetFont('helvetica', '', 11);
$pdf->MultiCell(0, 40, $txt, 0, 'J',false, 1, 8, 184,true,0,true, true);
$pdf->SetFont('helvetica', '', 10);
$pdf->MultiCell(0, 40, 'Lugar y Fecha: La Paz, '.FormA1::getFechaLiteral($hoy), 0, 'L',false, 1, 8, 207,true,0,true, true);
$pdf->MultiCell(0, 40, '...................................................', 0, 'C',false, 1, 8, 220,true,0,true, true);
$pdf->MultiCell(0, 40, 'ASOCIADO o ASOCIADA', 0, 'C',false, 1, 8, 225,true,0,true, true);



$pdf->AddPage('L');
$tabla = '
<table border="1" cellpadding="2" cellspacing="0">
  <tr>
    <td rowspan="4" style="width:25px;text-align:center">N°</td>
    <td colspan="12" style="text-align:center">DENOMINACIÓN: COOPERATIVA DE AHORRO Y CRÉDITO DE VINCULO LABORAL "OFICIALES DE CABALLERIA APOSTOL SANTIAGO" R.L.
    </td>
  </tr>
  <tr>
    <td colspan="12" style="text-align:center;">CUADRO DE AFILIACIÓN Y FONDO SOCIAL</td>
  </tr>
  <tr style="text-align:center;display:flex;">
    <td colspan="7">DATOS DE LA ASOCIADA o ASOCIADO</td>
    <td colspan="3"> CERTIFICADO DE APORTACION</td>
    <td rowspan="2" style="align-items:center;">FIRMA</td>
    <td rowspan="2">HUELLA DIGITAL PULGAR DERECHO</td>
  </tr>
  <tr style="text-align:center">
    <td>APELLIDO PATERNO</td>
    <td>APELLIDO MATERNO</td>
    <td>APELLIDO CASADA</td>
    <td>NOMBRE (S)</td>
    <td>CEDULA DE IDENTIDAD</td>
    <td>EXPEDICIÓN</td>
    <td>SEXO</td>
    <td>CANTIDAD DE CERTIFICADOS</td>
    <td>VALOR UNITARIO</td>
    <td>MONTO TOTAL CANCELADO</td>
  </tr>
  <tr>
    '.str_repeat('<td style="height:70px"></td>',12).'
  </tr>
</table>
';
$pdf->SetMargins(-10,0,0,0);
$pdf->SetFont('helvetica', 'B', 8);
$pdf->WriteHTMLCell(0, 0, '', '40', $tabla, 0, 0);


$pdf->Output('FORM-1A-B.pdf', 'I');
?>