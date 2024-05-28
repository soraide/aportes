<?php
namespace App\Controllers;

use App\Models\Beneficiario;
use App\Models\Details;
use App\Models\Registro;
use App\Models\Socio;
use App\Models\Vivienda;
use App\Models\EstadoCivil;
use App\Models\Expedicion;
use App\Models\Grado;
use App\Resources\Render;
use App\Resources\Request;
use App\Resources\Response;

class SocioController{

  public function create($body, $files = null){
    if(!Request::required(['nombre', 'paterno', 'materno', 'ci', 'expedido_id', 'correo'], $body))
      Response::error_json(['message' => 'Parametros faltantes'],200);
    
    $socio = new Socio();
    $socio->nombre = $body['nombre'];
    $socio->paterno = $body['paterno'] ?? '';
    $socio->materno = $body['materno'] ?? '';
    $socio->ci = $body['ci'] ?? '';
    $socio->expedido_id = $body['expedido_id'];
    $socio->fechaNacimiento = $body['fecha_nacimiento'];
    $socio->estadoCivil_id = $body['estado_civil_id'];
    $socio->celular = $body['celular'];
    $socio->correo = $body['correo'];
    $socio->password = $body['password'];

    $r_socio = $socio->save('tblSocio', 'idSocio', ['creado_en']);
    if($r_socio && $socio->idSocio > 0){
      if($socio->add_dependencies($body)){
        $registro = new Registro();
        $registro->socio_id = $socio->idSocio;
        $registro->estado = 'ESPERA';
        $registro->fecha_updated = date('Y-m-d');
        if($registro->save('tblRegistro', 'idRegistro', ['user_id'])){
          $res_doc = $socio->save_document($body['documento']);
          if($res_doc){
            Response::success_json('Socio creado correctamente', [], 200);
          }else{
            Response::error_json(['message' => 'Error al crear documento del socio'], 200);
          }
        }else{
          Response::error_json(['message' => 'Error al crear registro del socio'], 200);
        }
      }else{
        Response::error_json(['message' => 'Error al crear dependencias del socio'], 200);
      }
    }else
      Response::error_json(['message' => 'Error al crear el socio'], 200);

  }
  public function auth($body, $files = null){
    if(!Request::required(['correo', 'password'], $body))
      Response::error_json(['message' => 'Parametros faltantes'], 200);

    $user = $body['correo'];
    $pass = $body['password'];
    $socio = Socio::auth($user, $pass);
    if($socio->idSocio > 0){
      $registro = $socio->registro();
      if($registro->idRegistro > 0 && $registro->estado == "ALTA"){
        $_SESSION['idSocio'] = $socio->idSocio;
        $_SESSION['usuario'] = json_encode($socio);
        Response::success_json('Sesión iniciada correctamente', [], 200);
      }else
        Response::error_json(['message' => 'No autorizado, comuníquese con el administrador'], 200);
    }else
      Response::error_json(['message' => 'Credenciales incorrectas'], 200);
  }
  public function add(){
    $ss = $_SESSION['usuario'];
    echo $ss;
  }
  public function logout(){
    session_destroy();
    Response::success_json('Sesión cerrada correctamente', [], 200);
  }

  public function socioEspera($query){
    $socios = Socio::socioState('ESPERA');
    Render::view('socio/list', ['socios' => $socios]);
  }
  public function sociosAceptados($query){
    $socios = Socio::socioState('ALTA');
    Render::view('socio/lista_alta', ['socios' => $socios]);
  }
  public function getSociosBaja($query){
    $socios = Socio::socioState('BAJA');
    Render::view('socio/lista_baja', ['socios' => $socios]);
  }
  public function revisar($query){
    $socio = new Socio($query['id']);
    $socio->get_all_data();
    $beneficiarios = Beneficiario::get_by_socio($socio->idSocio);
    
    Render::view('revision/revisar_socio', ['socio' => $socio, 'beneficiarios' => $beneficiarios]);
  }


  // public function create($data, $files)
  // {
  //   $socioModel = new SocioModel();
  //   $id = $socioModel->createSocio($data);
  //   if ($id > 0) {
  //     $writeFiles = Socio::createDirSocio($id, $files);
  //     $bene = new BeneficiarioModel();
  //     if ($writeFiles > 0) {
  //       $resBen = $bene->insertBeneficiarios($data['benNombres'], $data['benPaterno'], $data['benMaterno'], $data['benCi'], $data['benParent'], $id);
  //       if($resBen > 0){
  //         echo json_encode(array('status' => 'success', 'message' => 'Socio creado correctamente'));
  //       }else{
  //         echo json_encode(array('status' => 'error', 'message' => 'Error al crear beneficiarios'));
  //       }
  //     } else {
  //       echo json_encode(array('status' => 'error', 'message' => 'Error al crear archivos'));
  //     }
  //   } else {
  //     // header("HTTP/1.0 500 Internal Server Error");
  //     echo json_encode(array('status' => 'error', 'message' => 'Error al crear socio'));
  //   }
  // }

  // public function auth($data, $files = null)
  // {
  //   if (isset($data['correo']) && isset($data['password'])) {
  //     $socioModel = new SocioModel();
  //     $socio = $socioModel->getSocio($data['correo'], $data['password']);
  //     if ($socio != null) {
  //       session_start();
  //       $_SESSION['idSocio'] = $socio[0]['idSocio'];
  //       $_SESSION['usuario'] = json_encode($socio[0]);
  //       echo json_encode(array('status' => 'success', 'message' => 'Sesión iniciada'));
  //     } else {
  //       echo json_encode(array('status' => 'error', 'message' => 'Correo o contraseña incorrectos'));
  //     }
  //   } else {
  //     echo json_encode(array('status' => 'error', 'message' => 'Faltan datos'));
  //   }
  // }
  // public function getAll(){
  //   $socioModel = new SocioModel();
  //   $res = $socioModel->getSociosAceptados();
  //   echo json_encode(array('status' => 'success', 'socios' => $res));
  // }
  // public function getSociosBaja(){
  //   $socioModel = new SocioModel();
  //   $res = $socioModel->getSociosBaja();
  //   echo json_encode(array('status' => 'success', 'socios' => $res));
  // }

  // public function socioEsperaDetalle($id)
  // {
  //   $socioModel = new SocioModel();
    
  //   $res = $socioModel->getDetallesById($id);
  //   if (count($res) > 0) {
  //     $res = $res[0];
  //     echo json_encode(array('status' => 'success', 'socio' => $res));        
  //   } else {
  //     echo json_encode(array('status' => 'error', 'message' => 'No se encontro socio'));
  //   }
  // }

  // public function socioDetalleHtml($id){
  //   $cadHTML = '
  //   <div class="col-md-6">
  //     <div class="card card-default">
  //       <div class="card-header">
  //         <h3 class="card-title">
  //           <i class="fas fa-exclamation-triangle"></i>
  //           Datos
  //         </h3>
  //       </div>
  //       <div class="card-body">
  //         <table class="table">
  //           <thead>
  //             <tr align="center">
  //               <th scope="col">Detalle</th>
  //               <th scope="col">Valor </th>
  //             </tr>
  //           </thead>
  //           <tbody>';
  //   $tabla = 'Ocurrio un error al cargar los datos';
  //   $socioModel = new SocioModel();
  //   $res = $socioModel->getDetallesById($id);
  //   if(count($res) > 0){
  //     $socio = $res[0];
  //     // Obtener la fecha en formato d-m-Y
  //     $fechaN = date_format(date_create($socio->fechaNac), 'd/m/Y');
  //     $fechaIn = date_format(date_create($socio->fechaIncorporacion), 'd/m/Y');
  //     // print_r($socio);
  //     $tabla = '<tr><td style="font-weight:bolder">Nombre Completo</td>
  //     <td>'.$socio->nombre.'</td></tr>
  //     <tr><td style="font-weight:bolder">Estado Civil</td>
  //     <td>'.$socio->estadoCivil.'</td></tr>
  //     <tr><td style="font-weight:bolder">Correo Electrónico</td>
  //     <td>'.$socio->correoElec.'</td></tr>
  //     <tr><td style="font-weight:bolder">Celular</td>
  //     <td>'.$socio->celular.'</td></tr>
  //     <tr><td style="font-weight:bolder">Ciudad</td>
  //     <td>'.$socio->ciudad.'</td></tr>
  //     <tr><td style="font-weight:bolder">Fecha Nac.</td>
  //     <td>'.$fechaN.'</td></tr>
  //     <tr><td style="font-weight:bolder">Lugar Nac.</td>
  //     <td>'.$socio->lugarNac.'</td></tr>
  //     <tr><td style="font-weight:bolder">Dirección</td>
  //     <td>'.$socio->direccion.'</td></tr>
  //     <tr><td style="font-weight:bolder">Código Boleta</td>
  //     <td>'.$socio->codBoleta.'</td></tr>
  //     <tr><td style="font-weight:bolder">Profesión</td>
  //     <td>'.$socio->profesion.'</td></tr>
  //     <tr><td style="font-weight:bolder">Fecha Incorporación</td>
  //     <td>'.$fechaIn.'</td></tr>
  //     <tr><td style="font-weight:bolder">Grado</td>
  //     <td>'.$socio->grado.'</td></tr>
  //     <tr><td style="font-weight:bolder">Número TIN</td>
  //     <td>'.$socio->numeroTin.'</td></tr>
  //     <tr><td style="font-weight:bolder">Archivo Carnet</td>
  //     <td><a class="btn btn-info" href="../../api/documents/file_'.$id.'_user.pdf" target="_blank"><i class="fas fa-file-pdf"></i> Ver</a></td></tr>';
  //   }
  //   $cadHTML .= $tabla.'</tbody></table></div></div></div>';
  //   echo $cadHTML;
  // }

  // public function socioArchivosHtml($id){
    
  //   $beneficiario = new BeneficiarioModel();
  //   $beneficiarios = $beneficiario->getBeneficiariosById($id);
    
  //   $htmlRes = '
  //   <div class="col-md-6">
  //     <div class="card card-default">
  //       <div class="card-header">
  //         <h3 class="card-title">
  //           <i class="fas fa-users"></i>
  //           Beneficiarios
  //         </h3>
  //       </div>
  //       <div class="card-body">
  //       ';
  //   $table = '
  //   <table class="table table-striped">
  //     <thead>
  //       <tr>
  //         <th>Nombre</th>
  //         <th>Apellidos</th>
  //         <th>CI</th>
  //         <th>Patentesco</th>
  //       </tr>
  //     </thead>
  //     <tbody>
  //     ';
  //   $rows = '';
  //   foreach ($beneficiarios as $beneficiario) {
  //     $rows .= '<tr>
  //     <td>'.$beneficiario['nombres'].'</td>
  //     <td>'.$beneficiario['apellidos'].'</td>
  //     <td>'.$beneficiario['ci'].'</td>
  //     <td>'.$beneficiario['parentesco'].'</td></tr>';
  //   }
    
    
  //   $htmlRes .= $table.$rows.'</tbody></table></div></div></div>';
  //   echo $htmlRes;
  // }

  // public function rechazarSocio($params){
  //   $socioModel = new SocioModel();
  //   $res = $socioModel->deleteSocioEspera($params['idUsuario']);
  //   if($res != null){
  //     echo json_encode(array('status' => 'success', 'message' => 'Socio rechazado'));
  //   }else{
  //     echo json_encode(array('status' => 'error', 'message' => 'No se pudo rechazar el socio'));
  //   }
  // }

  // public function bajaSocio($params){
  //   $socioModel = new SocioModel();
  //   $res = $socioModel->socioBaja($params['idUsuario']);
  //   if($res != null){
  //     echo json_encode(array('status' => 'success', 'message' => 'Socio Dado de Baja'));
  //   }else{
  //     echo json_encode(array('status' => 'error', 'message' => 'No se pudo dar de baja al socio'));
  //   }
  // }

  // public function aceptarSocio($params){
  //   $socioModel = new SocioModel();
  //   $res = $socioModel->aceptarSocio($params['idUsuario'], $params['observacion']);
  //   if($res != null){
  //     echo json_encode(array('status' => 'success', 'message' => 'Socio aceptado'));
  //   }else{
  //     echo json_encode(array('status' => 'error', 'message' => 'No se pudo aceptar el socio'));
  //   }
  // }

  // public function socioCI($ci){
  //   $socioModel = new SocioModel();
  //   $res = $socioModel->getByCI($ci);
  //   if($res != null){
  //     if(count($res) == 1){
  //       echo json_encode(array('status'=>'success', 'idUser'=>$res[0]['idUsuario']));
  //     }else{
  //       echo json_encode(array('status'=>'error (no existe)'));
  //     }
  //   }else{
  //     echo json_encode(array('status'=>'error (vacio)'));
  //   }
  // }

  // public static function createDirSocio($id, $files){
  //   $pathFile = './documents/';
  //   if (!is_dir($pathFile)) {
  //     mkdir($pathFile, 0777, true);
  //   }
  //   $res = 0;
  //   if(isset($files['ci'])){
  //     // guardar archivo pdf
  //     $res = move_uploaded_file($files['ci']['tmp_name'], $pathFile . '/file_'.$id.'_user.pdf');
  //   }
  //   return $res;
  // }

  // public static function UnsubscribePartnerPDF($idSocio = null){
  //   session_start();
  //   $socioModel = new SocioModel();
  //   $aporteModel = new AporteModel();
  //   $idSocio = ($idSocio == null ? $_SESSION['idSocio'] : $idSocio);
  //   $socio = $socioModel->getSocioById($idSocio);
  //   $aportes = $aporteModel->getContributionSummary($idSocio);

  //   $watermark = base64_encode(file_get_contents('../images/logo_original.png'));

  //   $data = [
  //     'header' => [
  //       'entity' => 'CIRCULO DE OFICIALES NAVALES',
  //       'name' => '"STELLA MARIS"',
  //       'country' => 'BOLIVIA',
  //       'title' => 'RESOLUCIÓN ADMINISTRATIVA Nº 018/2023',
  //       'date' => (new DateTime())->format("Y-m-d"),
  //     ],
  //     'watermark' => $watermark,
  //     'aportes' => $aportes,
  //     'socio' => $socio[0],
  //     'signature' => [
  //       'cfo' => 'CN. DAEN. Miranda Soto Fabian Sergio',
  //       'con' => 'CN. CGEN. Claros Ticona Freddy',
  //     ]
  //   ];

  //   $pdf = new ReportModel();

  //   $pdf->loadView('../views/socio/unsubscribe_partner.php', $data);

  //   $pdf->paginate();

  //   $pdf->stream("Resumen-Aportes.pdf");

  // }

  public function cardDatosSocio( ){
    $idSocio = $_SESSION['idSocio'];
    $socio = new Socio($idSocio);
    $socio->password = '';
    $detalle = new Details($idSocio);
    $vivienda = new Vivienda($idSocio);
    $expedicion = new Expedicion($socio->expedido_id);
    $estadoCivil = new EstadoCivil($socio->estadoCivil_id);
    $grado = new Grado($detalle->grado_id);
    Render::view('socio/datos_personales', [
      'socio' => $socio,
      'detalle' => $detalle,
      'vivienda' => $vivienda,
      'estadoCivil' => $estadoCivil,
      'expedicion' => $expedicion,
      'grado' => $grado,
    ]);
  }

}
