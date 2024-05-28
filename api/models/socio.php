<?php

namespace App\Models;

require_once(__DIR__ . '/details.php');
require_once(__DIR__ . '/vivienda.php');

use PDO;
use App\Models\BaseModel;
use App\Models\Registro;

class Socio extends BaseModel {
  public int $idSocio;
  public string $nombre;
  public string $paterno;
  public string $materno;
  public string $ci;
  public int $expedido_id;
  public string $fechaNacimiento;
  public string $estadoCivil_id;
  public string $celular;
  public string $correo;
  public string $creado_en;
  public string $password;
  public function __construct($idSocio = null) {
    $this->objectNull();
    if ($idSocio) {
      $con = connectToDatabase();
      $sql = "SELECT * FROM tblSocio WHERE idSocio = $idSocio";
      $stmt = $con->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($result)
        $this->load($result);
    }
  }
  public function get_all_data() {
    if ($this->idSocio > 0) {
      $sql = "SELECT a.*, b.*, g.detalle as grado, d.detalle as estadocivil, e.acronimo, e.detalle, v.*
      FROM tblSocio a INNER JOIN tblDetalleMilitar b ON a.idSocio = b.socio_id
      INNER JOIN tblGrado g ON b.grado_id = g.idGrado
      INNER JOIN tblEstadoCivil d ON d.idEstadoCivil = a.estadoCivil_id
      INNER JOIN tblExpedicion e ON e.idExpedicion = a.expedido_id
      INNER JOIN tblVivienda v ON v.socio_id = a.idSocio
      WHERE a.idSocio = ?;";
      $stmt = connectToDatabase()->prepare($sql);
      $stmt->execute([$this->idSocio]);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      $detalles = new Details();
      $detalles->load(['idDetalleMilitar' => $result['idDetalleMilitar'], 'grado_id' => $result['grado_id'], 'promo' => $result['promo'], 'profesion' => $result['profesion'], 'nro_tin' => $result['nro_tin'], 'codigo_boleta' => $result['codigo_boleta'], 'fecha_ingreso' => $result['fecha_ingreso']]);
      $this->{'details'} = $detalles;

      $vivienda = new Vivienda();
      $vivienda->load(['idVivienda' => $result['idVivienda'], 'calle' => $result['calle'] ?? '', 'avenida' => $result['avenida'] ?? '', 'zona' => $result['zona'], 'numero' => $result['numero'], 'lugar_nacimiento' => $result['lugar_nacimiento'], 'ciudad' => $result['ciudad'], 'socio_id' => $result['socio_id']]);

      $this->{'vivienda'} = $vivienda;
      $this->{'estado_civil'} = $result['estadocivil'];
      $this->{'expedido'} = $result['acronimo'];
      $this->{'grado'} = $result['grado'];
    }
  }
  public function details(): Details {
    $details = new Details($this->idSocio);
    $details->{'grado'} = $details->grado();
    return $details;
  }

  public function delete() {
    try {
      $sql = "DELETE FROM tblSocio WHERE idSocio = $this->idSocio";
      $con = connectToDatabase();
      $stmt = $con->prepare($sql);
      $res = $stmt->execute();
      if ($res) return true;
    } catch (\Throwable $th) {
      //throw $th;
    }
    return false;
  }
  public function add_dependencies($body): bool {
    $vivienda = new Vivienda();
    $vivienda->calle = $body['calle'] ?? '';
    $vivienda->numero = $body['numero'] ?? 'NN';
    $vivienda->zona = $body['zona'] ?? 'NN';
    $vivienda->lugar_nacimiento = $body['lugar_nacimiento'] ?? 'S/L';
    $vivienda->ciudad = $body['ciudad'] ?? '';
    $vivienda->socio_id = $this->idSocio;
    $r_vivienda = $vivienda->save('tblVivienda', 'idVivienda', []);
    if ($r_vivienda) {
      $detail = new Details();
      $detail->grado_id = $body['grado_id'];
      $detail->promo = $body['promo'];
      $detail->profesion = $body['profesion'];
      $detail->nro_tin = $body['nro_tin'];
      $detail->codigo_boleta = $body['codigo_boleta'];
      $detail->fecha_ingreso = $body['fecha_ingreso'];
      $detail->socio_id = $this->idSocio;
      $r_detail = $detail->save('tblDetalleMilitar', 'idDetalleMilitar', []);
      if ($r_detail) {
        $n = count($body['nombre_beneficiario']);
        for ($i = 0; $i < $n; $i++) {
          $beneficiario = new Beneficiario();
          $beneficiario->nombres = $body['nombre_beneficiario'][$i] ?? '';
          $beneficiario->paterno = $body['paterno_beneficiario'][$i] ?? '';
          $beneficiario->materno = $body['materno_beneficiario'][$i] ?? '';
          $beneficiario->parentesco_id = intval($body['parentesco_id_beneficiario'][$i]);
          $beneficiario->idSocio = $this->idSocio;
          $beneficiario->ci = $body['ci_beneficiario'][$i];
          $beneficiario->expedido_id = intval($body['expedido_id_beneficiario'][$i]);
          $res_ben = $beneficiario->save('tblBeneficiario', 'idBeneficiario', []);
          if(!$res_ben){
            break;
          }
        }
        if($res_ben){
          return true;
        }else{
          $detail->delete();
          $vivienda->delete();
          $this->delete();
        }
      } else {
        $vivienda->delete();
        $this->delete();
      }
    } else {
      $this->delete();
    }
    return false;
  }
  public function save_document($file): bool{
    $pathFile = __DIR__.'/../documents/';
    if (!is_dir($pathFile)) {
      mkdir($pathFile, 0777, true);
    }
    try {
      $nameFile = 'file_'.$this->idSocio.'_user.pdf';
      // $file_open = fopen($pathFile.$nameFile, 'wb');
      $base_to_php = explode(',', $file);
      $data_decode = base64_decode($base_to_php[1]);
      // fwrite($file_open, $data_decode);
      // fclose($file_open);
      file_put_contents($pathFile.$nameFile, $data_decode);
      return true;
    } catch (\Throwable $th) {
      var_dump($th);
    }
    return false;
  }
  public function registro(): Registro {
    $registro = new Registro($this->idSocio);
    return $registro;
  }

  public static function auth($user, $pass): Socio {
    $socio = new Socio();
    try {
      $sql = "SELECT * FROM tblSocio WHERE correo = '$user' AND password = '$pass';";
      $stmt = connectToDatabase()->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($result) {
        $socio->load($result);
        unset($socio->password);
      }
    } catch (\Throwable $th) {
      var_dump($th);
    }
    return $socio;
  }
  public static function socioState($state = 'ESPERA') {
    try {
      $sql = "SELECT a.*, c.detalle as grado, d.estado, d.observacion, d.fecha_updated, x.acronimo, b.nro_tin
              FROM tblSocio a 
              INNER JOIN tblDetallemilitar b ON a.idSocio = b.socio_id 
              INNER JOIN tblExpedicion x ON x.idExpedicion = a.expedido_id
              INNER JOIN tblGrado c ON b.grado_id = c.idGrado 
              INNER JOIN tblRegistro d ON d.socio_id = a.idSocio AND d.estado = '$state';";
      $stmt = connectToDatabase()->prepare($sql);
      $stmt->execute();
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    } catch (\Throwable $th) {
      //throw $th;
    }
    return [];
  }

  public static function allSociosDetalleBaja(){
    $res = [];
    $status = "BAJA";
    try {
      $sql = "SELECT ts.idSocio, ts.paterno, ts.materno, ts.nombre, CONCAT(ts.ci,' ',te.acronimo) AS ci,
                CONVERT(varchar, tr.fechaAceptado, 103) AS aceptado,
                CONVERT(varchar, tr.fechaBaja, 103) AS baja,
                (SELECT SUM(ta.monto) FROM tblAporte ta WHERE ta.idSocio = ts.idSocio) AS monto
            FROM tblSocio ts
            LEFT JOIN tblRegistro tr ON tr.socio_id = ts.idSocio
            LEFT JOIN tblExpedicion te ON te.idExpedicion = ts.expedido_id
            WHERE tr.estado LIKE '$status'
            ORDER BY ts.paterno ASC;";
      $stmt = connectToDatabase()->prepare($sql);
      $stmt->execute();
      $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (\Throwable $th) {
      print_r($th);
    }
    return $res;
  }
}
