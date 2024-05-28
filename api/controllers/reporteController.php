<?php

namespace App\Controllers;

use App\Models\Socio;
use App\Models\Expedicion;
use App\Models\Aporte;
use App\Models\Reporte;

class ReporteController {

    private $pdf;
    private $data;

    public function __construct(){
      $this->pdf = new Reporte();
      $this->data = [
        'header' => [
          'entity' => 'CIRCULO DE OFICIALES NAVALES',
          'name' => '"STELLA MARIS"',
          'country' => 'BOLIVIA',
          'title' => '',
          'subtitle' => '',
        ],
        'signature' => [
          'cfo' => 'CN. DAEN. Miranda Soto Fabian Sergio',
          'con' => 'CN. CGEN. Claros Ticona Freddy',
        ],
      ];
    }

    public function ResumenAportesSocioPDF($query){

        $idSocio = isset($query['id']) ? $query['id'] : $_SESSION['idSocio'];
        $socio = new Socio($idSocio);

        $this->data['header']['title'] = "ESTADO DE APORTES";
        $this->pdf->loadView('reporte/resumen_aportes_socio', [
            'header' => $this->data['header'],
            'socio' => $socio,
            'aportes'  => Aporte::getResumenSocio($socio->idSocio),
            'expedicion' => new Expedicion($socio->expedido_id),
        ]);
        
        $this->pdf->paginate();
        $this->pdf->stream("Resumen-Aportes.pdf");

    }

    public function HistorialAportesSocioPDF($query){

      $idSocio = isset($query['id']) ? $query['id'] : $_SESSION['idSocio'];
      $socio = new Socio($idSocio);

      $this->data['header']['title'] = "HISTORIAL DE APORTES";
      $this->pdf->loadView('reporte/historial_aportes_socio', [
          'header' => $this->data['header'],
          'socio' => $socio,
          'aportes'  => Aporte::getHistorialSocio($socio->idSocio),
          'expedicion' => new Expedicion($socio->expedido_id),
          'meses' => $this->pdf->getMonthsLiteral(),
      ]);
      
      $this->pdf->paginate();
      $this->pdf->stream("Historial-Aportes.pdf");

  }

  public function DetalleSociosAltaPDF(){
    $status = "ALTA";
    $socios = Socio::socioState($status);

    $mes = $this->pdf->convertMonthLiteral(date('m'));
    $anio = date('Y');

    $this->data['header']['title'] = "ALTA DE DESCUENTOS DE APORTES";
    $this->data['header']['subtitle'] = $mes." ".$anio;
    $this->pdf->loadView('reporte/detalle_socios_alta', [
      'header' => $this->data['header'],
      'signature' => $this->data['signature'],
      'socios' => $socios,
    ]);

    $this->pdf->paginate();
    $this->pdf->stream("Aportes-$mes-$anio.pdf");
  }

  public function DetalleSociosBajaPDF(){
    $status = "ALTA";
    $socios = Socio::allSociosDetalleBaja();

    $mes = date('m');
    $anio = date('Y');

    $this->data['header']['title'] = "SOCIOS DADOS DE BAJA";
    $this->data['header']['subtitle'] = "Al ".date('d')." de ".(Reporte::convertMonthLiteral($mes))." de ".$anio;
    $this->pdf->loadView('reporte/detalle_socios_baja', [
      'header' => $this->data['header'],
      'signature' => $this->data['signature'],
      'socios' => $socios,
    ]);

    $this->pdf->paginate();
    $this->pdf->stream("Socios-Baja-$mes-$anio.pdf");
  }

}