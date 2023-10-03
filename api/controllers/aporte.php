<?php
  require_once('./models/socio.php');
  require_once('./models/aporte.php');
  require_once('./models/report.php');
  class Aporte
  {
    public function __construct(){}

    public function getAportes(){
      session_start();
      $aporteModel = new AporteModel();
      $idSocio = $_SESSION['idSocio'];
      $res = $aporteModel->getAportes($idSocio);
      echo json_encode(array('status' => 'success', 'aportes' => $res));
    }

    public function ContributionSummaryPDF($idSocio = null){
      session_start();
      $socioModel = new SocioModel();
      $aporteModel = new AporteModel();
      $idSocio = ($idSocio == null ? $_SESSION['idSocio'] : $idSocio);
      $socio = $socioModel->getSocioById($idSocio);
      $aportes = $aporteModel->getContributionSummary($idSocio);
      $data = [
        'header' => [
          'entity' => 'CIRCULO DE OFICIALES NAVALES',
          'name' => '"STELLA MARIS"',
          'country' => 'BOLIVIA',
          'title' => 'ESTADO DE APORTES'
        ],
        'aportes' => $aportes,
        'socio' => $socio[0],
      ];
      
      $pdf = new ReportModel();

      $pdf->loadView('../views/aporte/contributions_summary.php', $data);

      $pdf->stream("Resumen-Aportes.pdf");
      
    }

    public function ContributionHistoryPDF($idSocio = null){
      session_start();
      $socioModel = new SocioModel();
      $aporteModel = new AporteModel();
      $idSocio = ($idSocio == null ? $_SESSION['idSocio'] : $idSocio);
      $socio = $socioModel->getSocioById($idSocio);
      $aportes = $aporteModel->getContributionHistory($idSocio);
      $data = [
        'header' => [
          'entity' => 'CIRCULO DE OFICIALES NAVALES',
          'name' => '"STELLA MARIS"',
          'country' => 'BOLIVIA',
          'title' => 'HISTORIAL DE APORTES'
        ],
        'aportes' => $aportes,
        'socio' => $socio[0],
      ];
      
      $pdf = new ReportModel();

      $pdf->loadView('../views/aporte/contributions_history.php', $data);

      $pdf->stream("Historial-Aportes.pdf");
    }

  }
?>