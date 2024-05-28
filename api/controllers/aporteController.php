<?php

namespace App\Controllers;

use App\Models\Socio;
use App\Models\Expedicion;
use App\Models\Aporte;
use App\Models\Reporte;
use App\Resources\Render;
use App\Resources\Request;
use App\Resources\Response;
use App\Models\ReporteXLSX;

class AporteController{
    
  public function cardAportesSocio( ){
    $idSocio = $_SESSION['idSocio'];
    $socio = new Socio($idSocio);
    $socio->password = '';
    $expedicion = new Expedicion($socio->expedido_id);
    $aportes = Aporte::getBySocio($socio->idSocio);
    Render::view('aporte/lista_aportes_socio', [
      'socio' => $socio,
      'expedicion' => $expedicion,
      'aportes' => $aportes,
      'meses' => Reporte::getMonthsLiteral(),
    ]);
  }

  public function checkRegistroAnterior($query){
    if(!Request::required(['mes', 'gestion'], $query))
      Response::error_json(['message' => 'Parametros faltantes'], 200);

    $mes = $query['mes'];
    $gestion = $query['gestion'];
    $aportes = Aporte::getAportesMesGestion($mes, $gestion);

    if(count($aportes) == 0){
      Response::success_json("Mes y Gestion disponibles para su registro.", [], 200);
    }else{
      Response::error_json(['message' => "Mes y gestion registrados con anterioridad."], 200);
    }
  }

}