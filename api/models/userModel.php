<?php
require_once('./config/database.php');
class UserModel{
  private $pdo;
  private $table = 'tblUsuario';
  public function __construct(){
    $this->pdo = connectToDatabase();
  }

  public function getUser($correo, $pass){
    $res = null;
    try {
      $sql = "SELECT idUsuario, usuario, nombres FROM $this->table WHERE usuario = ? AND password = ?";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute([$correo, $pass]);
      $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (\Throwable $th) {
      print_r($th);
    }
    return $res;
  }
}
?>