<?php
namespace App\Models;

use PDO;

// class BeneficiarioModel{
//   private $pdo;
//   private $table = 'tblBeneficiario';

//   public function __construct(){
//     $this->pdo = connectToDatabase();
//   }

//   public function insertBeneficiarios($nombres, $paternos, $maternos, $cis, $parentescos, $id){
//     try {
//       $datos = self::getCadenaInsert($nombres, $paternos, $maternos, $cis, $parentescos, $id);
//       $sql = "INSERT INTO $this->table(paterno, materno, nombres, parentesco, ci, idSocio) VALUES $datos";
//       $stmt = $this->pdo->prepare($sql);
//       $stmt->execute([]);
//       $lastInsert = $this->pdo->lastInsertId();
//       if($lastInsert != false){
//         return $lastInsert;
//       }else{
//         return -1;
//       }
//     } catch (\Throwable $th) {
//       return -1;
//     }
//   }
//   public function getBeneficiariosById($idSocio){
//     $res = [];
//     try {
//       $sql = "SELECT nombres, concat(paterno, ' ', materno) as apellidos, ci, parentesco FROM $this->table WHERE idSocio = ?";
//       $stmt = $this->pdo->prepare($sql);
//       $stmt->execute([$idSocio]);
//       $res = $stmt->fetchAll();
//     } catch (\Throwable $th) {
//       print_r($th);
//     }
//     return $res;

//   }
//   static public function getCadenaInsert($nombres, $paternos, $maternos, $cis, $parentescos, $id){
//     $nombresArr = explode(",", $nombres);
//     $paternosArr = explode(",", $paternos);
//     $maternosArr = explode(",", $maternos);
//     $cisArr = explode(",", $cis);
//     $parentescosArr = explode(",", $parentescos);
//     $cadena = "";
//     for($i = 0; $i < count($nombresArr); $i++){
//       $cadena .= "('".$paternosArr[$i]."', '".$maternosArr[$i]."', '".$nombresArr[$i]."', '".$parentescosArr[$i]."', '".$cisArr[$i]."', ".$id."),";
//     }
//     return rtrim($cadena, ",");
//   }
// }

class Beneficiario extends BaseModel{
  public int $idBeneficiario;
  public string $paterno;
  public string $materno;
  public string $nombres;
  public string $ci;
  public int $idSocio;
  public int $expedido_id;
  public int $parentesco_id;
  public function __construct($idBeneficiario = null){
    $this->objectNull();
    if($idBeneficiario){
      $sql = "SELECT * FROM tblBeneficiario WHERE idBeneficiario = ?";
      $stmt = connectToDatabase()->prepare($sql);
      $stmt->execute([$idBeneficiario]);
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if($result) $this->load($result);
    }
  }
  public static function get_by_socio($idSocio){
    $sql = "SELECT * 
    FROM tblBeneficiario a INNER JOIN tblExpedicion b ON a.expedido_id = b.idExpedicion
    INNER JOIN tblParentesco c ON c.idParentesco = a.parentesco_id WHERE a.idSocio = $idSocio;";
    $stmt = connectToDatabase()->prepare($sql);
    $stmt->execute([$idSocio]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $beneficiarios = [];
    foreach($result as $beneficiario){
      $new = new Beneficiario();
      $new->load($beneficiario);
      $beneficiarios[] = $new;
    }
    return $beneficiarios;
  }
}