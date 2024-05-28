<?php
namespace App\Controllers;

use App\Models\Grado;
use App\Resources\Response;

class GradoController{
  public function get_all($query){
    $grados = Grado::all();
    Response::success_json('OK', ['grados' => $grados]);
  }
}