<?php
namespace App\Models;

use PDO;

class Parentesco extends BaseModel{
  public int $idParentesco;
  public string $parentesco;
  public function __construct(){
    $this->objectNull();
  }
  public static function all(){
    $sql = "SELECT * FROM tblParentesco";
    $stmt = connectToDatabase()->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
}