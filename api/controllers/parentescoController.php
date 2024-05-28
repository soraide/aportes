<?php
namespace App\Controllers;

use App\Models\Parentesco;
use App\Resources\Response;

class ParentescoController{
  public function get_all($query){
    $parentesco = Parentesco::all();
    Response::success_json('OK', ['parentesco' => $parentesco]);
  }
}