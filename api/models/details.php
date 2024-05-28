<?php
namespace App\Models;

use PDO;

class Details extends BaseModel{
  public int $idDetalleMilitar;
  public int $grado_id;
  public string $promo;
  public string $profesion;
  public string $nro_tin;
  public string $codigo_boleta;
  public string $fecha_ingreso;
  public int $socio_id;
  public function __construct($idSocio = null){
    $this->objectNull();
    if($idSocio){
      $sql = "SELECT * FROM tblDetalleMilitar WHERE socio_id = $idSocio;";
      $stmt = connectToDatabase()->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if($result) $this->load($result);
    }
  }
  public function grado(): Grado{
    $grado = new Grado($this->grado_id);
    return $grado;
  }
  public function delete(): bool{
    try {
      $sql = "DELETE FROM tblDetalleMilitar WHERE idDetalleMilitar = ?";
      $stmt = connectToDatabase()->prepare($sql);
      return $stmt->execute([$this->idDetalleMilitar]);
    } catch (\Throwable $th) {
      var_dump($th);
    }
    return false;
  }
}