<?php

namespace App\Controllers;

use App\Models\Socio;
use App\Models\Aporte;
use App\Models\ReporteXLSX;
use App\Resources\Request;
use App\Resources\Response;


class ReporteXLSXController {

    public function registrarAportes($body, $file = null){
        if(!Request::required(['mes', 'gestion'], $body))
          Response::error_json(['message' => 'Parametros faltantes'], 200);
    
        // Verificando la existencia de registros anteriores
        $mes = $body['mes'];
        $gestion = $body['gestion'];
        $aportes = Aporte::getAportesMesGestion($mes, $gestion);
        if(count($aportes) == 0){
            // Obteniendo la lista de socios dados de alta
            $socios = Socio::socioState('ALTA');
            // Obteniendo los datos del archivo en Excel
            $temporal = $file['file']['tmp_name'];
            $name = $file['file']['name'];
            $xlsx = new ReporteXLSX($name, $temporal, 2, ['index','codigo','paterno','materno','nombre','estado','moneda','monto','observacion']);
            $registros = $xlsx->load();
            $inserts = array();
            // Verificando la existencia del codigo de usuario (numero tin) en la BD
            foreach($registros as $key => $registro){
                //print_r($registro);
                $lista = array_filter($socios, fn($socio) => $socio['nro_tin'] == $registro['codigo']);

                if(count($lista) > 0){
                  print_r($lista);
                  /*array_push($inserts, array(
                    'idSocio' => $lista[0]['idSocio'],
                    'monto' => $registro['monto'],
                    'observacion' => $registro['observacion'],
                  ));*/
                  echo "asdasdasd\n";
                }else{
                  echo "Socio no encontrado: ".$registro['codigo']."<br>";
                }
            }
            print_r($inserts);
        }else{
          Response::error_json(['message' => "Mes y gestion registrados con anterioridad."], 200);
        }
    }

}
