<?php
namespace App\Controllers;

use App\Models\Registro;
use App\Resources\Request;
use App\Resources\Response;

class RegistroController{
  public function aceptar($body){
    if(!Request::required(['idUsuario', 'observacion'], $body))
      Response::error_json(['message' => 'Parámetros faltantes'], 200);

    $idUsuario = json_decode($_SESSION['idUsuario']);
    if($idUsuario != null){
      $registro = new Registro($body['idUsuario']);
      $registro->estado = "ALTA";
      $registro->observacion = $body['observacion'];
      $registro->fecha_updated = date('Y-m-d');
      $registro->fechaAceptado = date('Y-m-d');
      $registro->user_id = $idUsuario;
      if($registro->update()){
        Response::success_json('Registro aceptado correctamente', [], 200);
      }else{
        Response::error_json(['message' => 'Error al aceptar el registro'], 200);
      }
    }else{
      Response::error_json(['message' => 'Usuario no logueado'], 200);
    }
  }
  public function rechazar($body){
    if(!Request::required(['idUsuario'], $body))
      Response::error_json(['message' => 'Parámetros faltantes'], 200);

    $idUsuario = json_decode($_SESSION['idUsuario']);
    if($idUsuario != null){
      $registro = new Registro($body['idUsuario']);
      $registro->estado = "RECHAZADO";
      $registro->observacion = 'rechazado';
      $registro->fecha_updated = date('Y-m-d');
      $registro->user_id = $idUsuario;
      if($registro->update()){
        Response::success_json('Registro rechazado correctamente', [], 200);
      }else{
        Response::error_json(['message' => 'Error al rechazar el registro'], 200);
      }
    }else{
      Response::error_json(['message' => 'Usuario no logueado'], 200);
    }
  }
  public function baja($body){
    if(!Request::required(['idUsuario'], $body))
      Response::error_json(['message' => 'Parámetros faltantes'], 200);

    $idUsuario = json_decode($_SESSION['idUsuario']);
    if($idUsuario != null){
      $registro = new Registro($body['idUsuario']);
      $registro->estado = "BAJA";
      $registro->fecha_updated = date('Y-m-d');
      $registro->fechaBaja = date('Y-m-d');
      $registro->user_id = $idUsuario;
      if($registro->update()){
        Response::success_json('Socio dado de baja correctamente.', [], 200);
      }else{
        Response::error_json(['message' => 'Error al dar de baja al socio.'], 200);
      }
    }else{
      Response::error_json(['message' => 'Socio no encontrado.'], 200);
    }
  }
}