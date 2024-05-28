<?php
namespace App\Controllers;

use App\Models\Gestion;
use App\Resources\Render;
use App\Resources\Request;
use App\Resources\Response;

class GestionController{
  public function get($query){
    $gestiones = Gestion::all();
    Render::view('gestion/list', ['gestiones' => $gestiones]);
  }
  public function create($data, $files = null){
    if(!Request::required(['gestion','rendimiento'], $data))
      Response::error_json(['message' => 'Parametros faltantes'], 200);

    $gestion = new Gestion();
    $gestion->gestion = $data['gestion'];
    $gestion->rendimiento = floatval($data['rendimiento']);
    if($gestion->save('tblGestion', 'idGestion'))
      Response::success_json('Gestion agregada', [], 200);
    else
      Response::error_json(['message' => 'Error al agregar gestion'], 200);
  }
}