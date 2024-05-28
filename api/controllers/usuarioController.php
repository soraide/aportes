<?php
namespace App\Controllers;

use App\Models\Usuario;
use App\Resources\Request;
use App\Resources\Response;

class UsuarioController {
  public function auth($data, $files = null) {
    if(!Request::required(['name', 'pwd'], $data))
      Response::error_json(['message' => 'Datos faltantes'], 200);

    $user = Usuario::auth($data['name'], $data['pwd']);
    if($user->idUsuario > 0){
      $_SESSION['idUsuario'] = $user->idUsuario;
      unset($user->password);
      $_SESSION['admin'] = json_encode($user);
      Response::success_json('Autenticación exitosa',[], 200);
    }else{
      Response::error_json(['message' => 'Las credenciales son incorrectas'], 200);
    }
  }
}
