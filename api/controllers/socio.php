<?php
require_once('./models/socio.php');
require_once('./models/beneficiario.php');
class Socio
{
  public function __construct(){}

  public function create($data, $files)
  {
    $socioModel = new SocioModel();
    $id = $socioModel->createSocio($data);
    if ($id > 0) {
      $writeFiles = Socio::createDirSocio($id, $files);
      $bene = new BeneficiarioModel();
      if ($writeFiles > 0) {
        $resBen = $bene->insertBeneficiarios($data['benNombres'], $data['benPaterno'], $data['benMaterno'], $data['benCi'], $data['benParent'], $id);
        if($resBen > 0){
          echo json_encode(array('status' => 'success', 'message' => 'Socio creado correctamente'));
        }else{
          echo json_encode(array('status' => 'error', 'message' => 'Error al crear beneficiarios'));
        }
      } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error al crear archivos'));
      }
    } else {
      // header("HTTP/1.0 500 Internal Server Error");
      echo json_encode(array('status' => 'error', 'message' => 'Error al crear socio'));
    }
  }

  public function auth($data, $files = null)
  {
    if (isset($data['correo']) && isset($data['password'])) {
      $socioModel = new SocioModel();
      $socio = $socioModel->getSocio($data['correo'], $data['password']);
      if ($socio != null) {
        session_start();
        $_SESSION['idSocio'] = $socio[0]['idSocio'];
        $_SESSION['usuario'] = json_encode($socio[0]);
        echo json_encode(array('status' => 'success', 'message' => 'Sesión iniciada'));
      } else {
        echo json_encode(array('status' => 'error', 'message' => 'Correo o contraseña incorrectos'));
      }
    } else {
      echo json_encode(array('status' => 'error', 'message' => 'Faltan datos'));
    }
  }
  public function getAll(){
    $socioModel = new SocioModel();
    $res = $socioModel->getSociosAceptados();
    echo json_encode(array('status' => 'success', 'socios' => $res));
  }
  public function getSociosBaja(){
    $socioModel = new SocioModel();
    $res = $socioModel->getSociosBaja();
    echo json_encode(array('status' => 'success', 'socios' => $res));
  }
  public function socioEspera()
  {
    $socioModel = new SocioModel();
    $res = $socioModel->getSociosEspera();
    echo json_encode(array('status' => 'success', 'socios' => $res));
  }

  public function socioEsperaDetalle($id)
  {
    $socioModel = new SocioModel();
    
    $res = $socioModel->getDetallesById($id);
    if (count($res) > 0) {
      $res = $res[0];
      echo json_encode(array('status' => 'success', 'socio' => $res));        
    } else {
      echo json_encode(array('status' => 'error', 'message' => 'No se encontro socio'));
    }
  }

  public function socioDetalleHtml($id){
    $cadHTML = '
    <div class="col-md-6">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-exclamation-triangle"></i>
            Datos
          </h3>
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr align="center">
                <th scope="col">Detalle</th>
                <th scope="col">Valor </th>
              </tr>
            </thead>
            <tbody>';
    $tabla = 'Ocurrio un error al cargar los datos';
    $socioModel = new SocioModel();
    $res = $socioModel->getDetallesById($id);
    if(count($res) > 0){
      $socio = $res[0];
      // Obtener la fecha en formato d-m-Y
      $fechaN = date_format(date_create($socio->fechaNac), 'd/m/Y');
      $fechaIn = date_format(date_create($socio->fechaIncorporacion), 'd/m/Y');
      // print_r($socio);
      $tabla = '<tr><td style="font-weight:bolder">Nombre Completo</td>
      <td>'.$socio->nombre.'</td></tr>
      <tr><td style="font-weight:bolder">Estado Civil</td>
      <td>'.$socio->estadoCivil.'</td></tr>
      <tr><td style="font-weight:bolder">Correo Electrónico</td>
      <td>'.$socio->correoElec.'</td></tr>
      <tr><td style="font-weight:bolder">Celular</td>
      <td>'.$socio->celular.'</td></tr>
      <tr><td style="font-weight:bolder">Ciudad</td>
      <td>'.$socio->ciudad.'</td></tr>
      <tr><td style="font-weight:bolder">Fecha Nac.</td>
      <td>'.$fechaN.'</td></tr>
      <tr><td style="font-weight:bolder">Lugar Nac.</td>
      <td>'.$socio->lugarNac.'</td></tr>
      <tr><td style="font-weight:bolder">Dirección</td>
      <td>'.$socio->direccion.'</td></tr>
      <tr><td style="font-weight:bolder">Código Boleta</td>
      <td>'.$socio->codBoleta.'</td></tr>
      <tr><td style="font-weight:bolder">Profesión</td>
      <td>'.$socio->profesion.'</td></tr>
      <tr><td style="font-weight:bolder">Fecha Incorporación</td>
      <td>'.$fechaIn.'</td></tr>
      <tr><td style="font-weight:bolder">Grado</td>
      <td>'.$socio->grado.'</td></tr>
      <tr><td style="font-weight:bolder">Número TIN</td>
      <td>'.$socio->numeroTin.'</td></tr>
      <tr><td style="font-weight:bolder">Archivo Carnet</td>
      <td><a class="btn btn-info" href="../../api/documents/file_'.$id.'_user.pdf" target="_blank"><i class="fas fa-file-pdf"></i> Ver</a></td></tr>';
    }
    $cadHTML .= $tabla.'</tbody></table></div></div></div>';
    echo $cadHTML;
  }

  public function socioArchivosHtml($id){
    
    $beneficiario = new BeneficiarioModel();
    $beneficiarios = $beneficiario->getBeneficiariosById($id);
    
    $htmlRes = '
    <div class="col-md-6">
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-users"></i>
            Beneficiarios
          </h3>
        </div>
        <div class="card-body">
        ';
    $table = '
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Apellidos</th>
          <th>CI</th>
          <th>Patentesco</th>
        </tr>
      </thead>
      <tbody>
      ';
    $rows = '';
    foreach ($beneficiarios as $beneficiario) {
      $rows .= '<tr>
      <td>'.$beneficiario['nombres'].'</td>
      <td>'.$beneficiario['apellidos'].'</td>
      <td>'.$beneficiario['ci'].'</td>
      <td>'.$beneficiario['parentesco'].'</td></tr>';
    }
    
    
    $htmlRes .= $table.$rows.'</tbody></table></div></div></div>';
    echo $htmlRes;
  }

  public function rechazarSocio($params){
    $socioModel = new SocioModel();
    $res = $socioModel->deleteSocioEspera($params['idUsuario']);
    if($res != null){
      echo json_encode(array('status' => 'success', 'message' => 'Socio rechazado'));
    }else{
      echo json_encode(array('status' => 'error', 'message' => 'No se pudo rechazar el socio'));
    }
  }

  public function bajaSocio($params){
    $socioModel = new SocioModel();
    $res = $socioModel->socioBaja($params['idUsuario']);
    if($res != null){
      echo json_encode(array('status' => 'success', 'message' => 'Socio Dado de Baja'));
    }else{
      echo json_encode(array('status' => 'error', 'message' => 'No se pudo dar de baja al socio'));
    }
  }

  public function aceptarSocio($params){
    $socioModel = new SocioModel();
    $res = $socioModel->aceptarSocio($params['idUsuario'], $params['observacion']);
    if($res != null){
      echo json_encode(array('status' => 'success', 'message' => 'Socio aceptado'));
    }else{
      echo json_encode(array('status' => 'error', 'message' => 'No se pudo aceptar el socio'));
    }
  }

  public function socioCI($ci){
    $socioModel = new SocioModel();
    $res = $socioModel->getByCI($ci);
    if($res != null){
      if(count($res) == 1){
        echo json_encode(array('status'=>'success', 'idUser'=>$res[0]['idUsuario']));
      }else{
        echo json_encode(array('status'=>'error (no existe)'));
      }
    }else{
      echo json_encode(array('status'=>'error (vacio)'));
    }
  }

  public static function createDirSocio($id, $files){
    $pathFile = './documents/';
    if (!is_dir($pathFile)) {
      mkdir($pathFile, 0777, true);
    }
    $res = 0;
    if(isset($files['ci'])){
      // guardar archivo pdf
      $res = move_uploaded_file($files['ci']['tmp_name'], $pathFile . '/file_'.$id.'_user.pdf');
    }
    return $res;
  }

  public static function UnsubscribePartnerPDF($idSocio = null){
    session_start();
    $socioModel = new SocioModel();
    $aporteModel = new AporteModel();
    $idSocio = ($idSocio == null ? $_SESSION['idSocio'] : $idSocio);
    $socio = $socioModel->getSocioById($idSocio);
    $aportes = $aporteModel->getContributionSummary($idSocio);

    $watermark = base64_encode(file_get_contents('../images/logo_original.png'));

    $data = [
      'header' => [
        'entity' => 'CIRCULO DE OFICIALES NAVALES',
        'name' => '"STELLA MARIS"',
        'country' => 'BOLIVIA',
        'title' => 'RESOLUCIÓN ADMINISTRATIVA Nº 018/2023',
        'date' => (new DateTime())->format("Y-m-d"),
      ],
      'watermark' => $watermark,
      'aportes' => $aportes,
      'socio' => $socio[0],
      'signature' => [
        'cfo' => 'CN. DAEN. Miranda Soto Fabian Sergio',
        'con' => 'CN. CGEN. Claros Ticona Freddy',
      ]
    ];

    $pdf = new ReportModel();

    $pdf->loadView('../views/socio/unsubscribe_partner.php', $data);

    $pdf->paginate();

    $pdf->stream("Resumen-Aportes.pdf");

  }
}
?>