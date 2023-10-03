<?php
require_once('./models/userModel.php');
class User
{

  public function create($data, $files){
  }

  public function auth($data, $files=null){
    if(isset($data['name']) && isset($data['pwd'])){
      $user = new UserModel();
      $usuario = $user->getUser($data['name'], $data['pwd']);
      if($usuario != null){
        session_start();
        $_SESSION['idUsuario'] = $usuario[0]['idUsuario'];
        $_SESSION['admin'] = json_encode($usuario[0]);
        echo json_encode(array('status' => 'success', 'message' => 'Sesión iniciada Panel'));
      }else{
        echo json_encode(array('status' => 'error', 'message' => 'Correo o contraseña incorrectos'));
      }
    }else{
      echo json_encode(array('status' => 'error', 'message' => 'Faltan datos'));
    }
  }
}
?>