<?php
namespace App\Models;
use App\Models\BaseModel;
use PDO;

class Expedicion extends BaseModel{
  public int $idExpedicion;
  public string $detalle;
  public string $acronimo;
  public function __construct($idExpedicion = null){
    $this->objectNull();
    if($idExpedicion){
      $sql = "SELECT * FROM tblExpedicion WHERE idExpedicion = $idExpedicion";
      $con = connectToDatabase();
      $stmt = $con->prepare($sql);  
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if($row)
        $this->load($row);
    }
  }
  public static function all(){
    $sql = "SELECT * FROM tblExpedicion;";
    $con = connectToDatabase();
    $stmt = $con->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}