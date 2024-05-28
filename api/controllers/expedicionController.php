<?php
namespace App\Controllers;

use App\Models\Expedicion;
use App\Resources\Response;

class ExpedicionController{
  public function get_all($query){
    $expediciones = Expedicion::all();
    Response::success_json('OK', ['expediciones' => $expediciones]);
  }
}