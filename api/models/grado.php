<?php
namespace App\Models;

use PDO;

class Grado extends BaseModel{
  public int $idGrado;
  public string $detalle;
  public string $sigla;
  public function __construct($idGrado = null){
    $this->objectNull();
    if($idGrado){
      $con = connectToDatabase();
      $sql = "SELECT * FROM tblGrado WHERE idGrado = ?";
      $stmt = $con->prepare($sql);
      $stmt->execute([$idGrado]);
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if($row)
        $this->load($row);
    }
  }
  public static function all(){
    $sql = "SELECT * FROM tblGrado;";
    $stmt = connectToDatabase()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}