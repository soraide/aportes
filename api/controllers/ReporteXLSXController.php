<?php

namespace App\Controllers;

use App\Models\Socio;
use App\Models\Aporte;
use App\Models\Gestion;
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
        if(count($aportes) > 0){
          Response::error_json(['message' => "Mes y gestion registrados con anterioridad."], 200);
          die();
        }
        // Verificando la existencia de la gestion en la BD
        $gestion = Gestion::getGestionByName($gestion);
        if(!$gestion){
          Response::error_json(['message' => "La gestion seleccionada no se encuentra registrada."], 200);
          die();
        }
        // Obteniendo la lista de socios dados de alta y la gestion a registrar
        $socios = Socio::socioState('ALTA');
        // Obteniendo los datos del archivo en Excel
        $temporal = $file['file']['tmp_name'];
        $name = $file['file']['name'];
        $numHeaders = 1;
        $xlsx = new ReporteXLSX($name, $temporal, $numHeaders, ['gestion','codigo','ci','grado','mension','nombres','monto_descuento','monto','observacion']);
        $registros = $xlsx->load();
        $inserts = array();
        $unregistered = array();
        // Verificando la existencia del codigo de usuario (numero tin) en la BD
        foreach($registros as $key => $registro){
            $lista = array_filter($socios, fn($socio) => $socio['nro_tin'] == $registro['codigo']);
            if(count($lista) > 0){
              array_push($inserts, array(
                'idSocio' => array_pop($lista)['idSocio'],
                'monto' => $registro['monto'],
                'mes' => $mes,
                'observacion' => $registro['observacion'],
                'gestion_id' => $gestion['idGestion'],
              ));
            }else{
              array_push($unregistered, array(
                'index' => $registro['gestion'],
                'codigo' => $registro['codigo'],
                'nombre' => $registro['nombres'],
                'row' => ($key + 1) + $numHeaders,
              ));
            }
        }

        if(count($inserts) == 0){
          Response::error_json(['message' => "El archivo no tiene socios registrados en el sistema."], 200);
          die();
        }

        $result = Aporte::registerFullData($inserts);
        
        if($result){
          Response::success_json('Aportes registrados con éxito.', [
            'nroRegistrados' => count($inserts),
            'unregistered' => $unregistered
          ], 200);
        }else{
          Response::error_json(['message' => "Se produjo un error al registrar el archivo."], 200);
        }

    }

}
