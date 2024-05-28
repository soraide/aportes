<?php
namespace App\Models;
use App\Models\BaseModel;
use PDO;
class Usuario extends BaseModel{
  public int $idUsuario;
  public string $usuario;
  public string $password;
  public string $nombres;
  public string $rol;
  public function __construct($idUsuario = null){
    $this->objectNull();
    if($idUsuario){
      $con = connectToDatabase();
      $sql = "SELECT * FROM tblUsuario WHERE idUsuario = $idUsuario;";
      $stmt = $con->prepare($sql);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      if($result){
        $this->load($result);
      }
    }
  }
  public static function auth($username, $pwd): Usuario{
    $con = connectToDatabase();
    $user = new Usuario();
    $sql = "SELECT * FROM tblUsuario WHERE usuario = '$username' AND password = '$pwd';";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result) $user->load($result);
    return $user;
  }
}