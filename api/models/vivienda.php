<?php

namespace App\Models;

use PDO;
use App\Models\BaseModel;

class Vivienda extends BaseModel{
  public int $idVivienda;
  public string $calle;
  public string $avenida;
  public string $zona;
  public string $numero;
  public int $socio_id;
  public string $lugar_nacimiento;
  public string $ciudad;
  public function __construct($idSocio = null){
    $this->objectNull();
    if ($idSocio) {
      $con = connectToDatabase();
      $sql = "SELECT * 
              FROM tblVivienda
              WHERE socio_id = $idSocio;";
      $stmt = $con->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($result)
        $this->load($result);
    }
  }
  public function delete(){
    try {
      $sql = "DELETE FROM tblVivienda WHERE idVivienda = ?";
      $stmt = connectToDatabase()->prepare($sql);
      return $stmt->execute([$this->idVivienda]);
    } catch (\Throwable $th) {
      var_dump($th);
    }
    return false;
  }
}