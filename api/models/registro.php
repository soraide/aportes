<?php
namespace App\Models;

use PDO;

class Registro extends BaseModel{
  public int $idRegistro;
  public string $estado;
  public string $fecha_updated;
  public string $fechaAceptado;
  public string $fechaBaja;
  public string $observacion;
  public int $socio_id;
  public int $user_id;
  public function __construct($idSocio = null){
    $this->objectNull();
    if($idSocio){
      $sql = "SELECT * FROM tblRegistro WHERE socio_id = $idSocio";
      $stmt = connectToDatabase()->prepare($sql);
      $stmt->execute([]);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if($result){
        $this->load($result);
      }
    }
  }
  public function update(): bool{
    try {
      $sql = "UPDATE tblRegistro 
              SET estado = ?, observacion = ?, user_id = ?, 
                  fecha_updated = ? , fechaAceptado = ? , fechaBaja = ?
                  WHERE idRegistro = ?;";
      $stmt = connectToDatabase()->prepare($sql);
      return $stmt->execute([$this->estado, $this->observacion, $this->user_id, $this->fecha_updated, $this->fechaAceptado, $this->fechaBaja, $this->idRegistro]);
    } catch (\Throwable $th) {
      var_dump($th);
    }
    return false;
  }
}