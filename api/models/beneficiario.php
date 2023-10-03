<?php
require_once('./config/database.php');
class BeneficiarioModel{
  private $pdo;
  private $table = 'tblBeneficiario';

  public function __construct(){
    $this->pdo = connectToDatabase();
  }

  public function insertBeneficiarios($nombres, $paternos, $maternos, $cis, $parentescos, $id){
    try {
      $datos = self::getCadenaInsert($nombres, $paternos, $maternos, $cis, $parentescos, $id);
      $sql = "INSERT INTO $this->table(paterno, materno, nombres, parentesco, ci, idSocio) VALUES $datos";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute([]);
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
  public function getBeneficiariosById($idSocio){
    $res = [];
    try {
      $sql = "SELECT nombres, concat(paterno, ' ', materno) as apellidos, ci, parentesco FROM $this->table WHERE idSocio = ?";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute([$idSocio]);
      $res = $stmt->fetchAll();
    } catch (\Throwable $th) {
      print_r($th);
    }
    return $res;

  }
  static public function getCadenaInsert($nombres, $paternos, $maternos, $cis, $parentescos, $id){
    $nombresArr = explode(",", $nombres);
    $paternosArr = explode(",", $paternos);
    $maternosArr = explode(",", $maternos);
    $cisArr = explode(",", $cis);
    $parentescosArr = explode(",", $parentescos);
    $cadena = "";
    for($i = 0; $i < count($nombresArr); $i++){
      $cadena .= "('".$paternosArr[$i]."', '".$maternosArr[$i]."', '".$nombresArr[$i]."', '".$parentescosArr[$i]."', '".$cisArr[$i]."', ".$id."),";
    }
    return rtrim($cadena, ",");
  }
}
?>