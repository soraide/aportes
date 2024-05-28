<?php
namespace App\Controllers;

use App\Models\EstadoCivil;
use App\Resources\Response;

class EstadoCivilController{
  public function get_all(){
    $estadoCivil = EstadoCivil::all();
    Response::success_json('Estados civiles', ['estados' => $estadoCivil]);
  }
}