<?php
namespace App\Models;

use PDO;

class EstadoCivil extends BaseModel{
  public int $idEstadoCivil;
  public string $detalle;
  public function __construct($idEstadoCivil = null){
    $this->objectNull();
    if($idEstadoCivil){
      $con = connectToDatabase();
      $sql = "SELECT * 
              FROM tblEstadoCivil
              WHERE idEstadoCivil = $idEstadoCivil;";
      $stmt = $con->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($result)
        $this->load($result);
    }
  }
  public static function all(){
    $con = connectToDatabase();
    $sql = "SELECT * FROM tblEstadoCivil;";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }
}