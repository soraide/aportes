<?php
namespace App\Models;

use PDO;

class Gestion extends BaseModel{
  public int $idGestion;
  public string $gestion;
  public float $rendimiento;
  public function __construct($idGestion = null){
    $this->objectNull();
    if($idGestion != null){
      $sql = "SELECT * FROM tblGestion WHERE idGestion = ?";
      $stmt = connectToDatabase()->prepare($sql);
      $stmt->execute([$idGestion]);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if($result) $this->load($result);
    }
  }

  public static function all(){
    $sql = "SELECT * FROM tblGestion ORDER BY idGestion DESC";
    $stmt = connectToDatabase()->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
}