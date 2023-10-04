<?php
require_once('./config/database.php');
class SocioModel{
  private $pdo;
  private $table = 'tblSocio';

  public function __construct(){
    $this->pdo = connectToDatabase();
  }

  public function createSocio($data){
    try {
      $sql = "INSERT INTO $this->table(paterno, materno, nombres, ci, expedido, fechaNac, lugarNac, celular, ciudad, zona, avenida, nroDir, correoElec, estadoCivil, grado, profesion, fechaIncorporacion, promocion, numeroTin, codBoleta, password) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute([
        $data['paterno'],$data['materno'], $data['nombres'], $data['ci'], $data['expedido'], $data['fechaNac'], $data['lugar_nac'], $data['celular'], $data['ciudad'], $data['zona'], $data['avenida'], $data['nroDir'], $data['correoElec'], $data['estadoCivil'], $data['grado'], $data['profesion'], $data['fechaIncorporacion'], $data['promocion'], $data['numeroTin'], $data['codBoleta'], $data['password']
      ]);
      $lastInsert = $this->pdo->lastInsertId();
      if($lastInsert != false){
        return $lastInsert;
      }else{
        return -1;
      }      
    } catch (\Throwable $th) {
      return -1;
    }
  }

  public function getSocio($correo, $pass){
    $res = null;
    try {
      $sql = "SELECT * FROM $this->table WHERE correoElec = ? AND password = ?";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute([$correo, $pass]);
      $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (\Throwable $th) {
      print_r($th);
    }
    return $res;
  }


  public function getSociosEspera(){
    $sql = "SELECT ROW_NUMBER() OVER(ORDER BY idSocio) AS numero, idSocio, concat(paterno, ' ', materno) as apellidos, nombres, concat(ci,' ',expedido) as ci, fechaNac, celular, lugarNac, grado FROM $this->table WHERE estado LIKE 'ESPERA';";
    try {
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute();
      $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (\Throwable $th) {
      print_r($th);
    }
    return $res;
  }

  public function getSociosAceptados(){
    $sql = "SELECT ROW_NUMBER() OVER(ORDER BY idSocio) AS numero, idSocio, concat(paterno, ' ', materno) as apellidos, nombres, concat(ci,' ',expedido) as ci, fechaNac, celular, grado, observacion, fechaAceptado FROM $this->table WHERE estado LIKE 'ALTA';";
    try {
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute();
      $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (\Throwable $th) {
      print_r($th);
    }
    return $res;
  }

  public function getSociosBaja(){
    $sql = "SELECT ROW_NUMBER() OVER(ORDER BY idSocio) AS numero, idSocio, concat(paterno, ' ', materno) as apellidos, nombres, concat(ci,' ',expedido) as ci,  celular, grado, fechaAceptado, fechaBaja FROM $this->table WHERE estado LIKE 'BAJA';";
    try {
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute();
      $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (\Throwable $th) {
      print_r($th);
    }
    return $res;
  }

  public function getDetallesById($id){
    $res = array();
    try {
      $sql = "SELECT concat(paterno, ' ', materno, ' ', nombres) as nombre, estadoCivil, correoElec, ciudad, concat(avenida,' ',nroDir) as direccion, fechaIncorporacion, numeroTin, profesion,  concat(ci,' ', expedido) as ci, codBoleta, fechaNac, lugarNac, grado, celular  FROM $this->table WHERE idSocio = ? ";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute([$id]);
      $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    } catch (\Throwable $th) {
      print_r($th);
    }
    return $res;
  }

  public function deleteSocioEspera($id){
    $res = null;
    try {
      $sql = "UPDATE $this->table SET estado = 'RECHAZADO' WHERE idSocio = ?";
      $stmt = $this->pdo->prepare($sql);
      if($stmt->execute([$id])){
        $res = 1;
      }
    } catch (\Throwable $th) {
      print_r($th);
      return null;
    }
    return $res;
  }

  public function aceptarSocio($id, $observacion){
    $res = null;
    date_default_timezone_set('America/La_Paz');
    $fecha = date('Y-m-d H:i:s');
    $sql = "UPDATE $this->table SET estado = 'ALTA', observacion = ?, fechaAceptado = ? WHERE idSocio = ?";
    try {
      $stmt = $this->pdo->prepare($sql);
      if($stmt->execute([$observacion, $fecha, $id])){
        $res = 1;
      }
    } catch (\Throwable $th) {
      print_r($th);
      return null;
    }
    return $res;
  }

  public function getByCI($ci){
    $res = null;
    try {
      $sql = "SELECT idSocio FROM $this->table WHERE ci LIKE '$ci';";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute();
      $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (\Throwable $th) {
      print_r($th);
    }
    return $res;

  }

  public function socioBaja($id){
    $res = null;
    date_default_timezone_set('America/La_Paz');
    $fecha = date('Y-m-d H:i:s');
    try {
      $sql = "UPDATE $this->table SET estado = 'BAJA', fechaBaja = ? WHERE idSocio = ?";
      $stmt = $this->pdo->prepare($sql);
      if($stmt->execute([$fecha, $id])){
        $res = 1;
      }
    } catch (\Throwable $th) {
      print_r($th);
      return null;
    }
    return $res;
  }

  public function getSocioById($idSocio){
    $res = null;
    try {
      $sql = "SELECT * FROM $this->table WHERE idSocio = ? ;";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute([$idSocio]);
      $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (\Throwable $th) {
      print_r($th);
    }
    return $res;
  }
}
?>