<?php

namespace App\Models;

use PDO;
use App\Models\BaseModel;

class Aporte extends BaseModel{
  
  public int $idAporte;
  public string $idSocio;
  public float $monto;
  public string $mes;
  public int $gestion_id;
  public string $observacion;

  public function __construct(){
    $this->objectNull();
  }

  public static function getBySocio($idSocio) {
    $res = null;
    try {
      $sql = "SELECT ta.idAporte, ta.monto, ta.mes, ta.observacion,
                      tg.gestion, tg.rendimiento
              FROM tblAporte ta
              LEFT JOIN tblGestion tg ON ta.gestion_id = tg.idGestion
              WHERE idSocio = $idSocio
              ORDER BY tg.gestion DESC, ta.mes DESC;";
      $stmt = connectToDatabase()->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (\Throwable $th) {
      //print_r($th);
    }
    return $res;
  }

  public static function getResumenSocio($idSocio) {
    $res = null;
    try {
      $sql = "SELECT tg.idGestion, tg.gestion, COUNT(*) AS cantidad, SUM(ta.monto) AS monto, 
                      MAX(ta.mes) AS ultimoMes, MIN(ta.mes) AS primerMes, tg.rendimiento
              FROM tblAporte ta
              LEFT JOIN tblGestion tg ON ta.gestion_id = tg.idGestion
              WHERE idSocio = $idSocio
              GROUP BY tg.idGestion, tg.gestion, tg.rendimiento
              ORDER BY tg.idGestion ASC;";
      $stmt = connectToDatabase()->prepare($sql);
      $stmt->execute();
      $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (\Throwable $th) {
      //print_r($th);
    }
    return $res;
  }

  public static function getHistorialSocio($idSocio){
    $res = null;
    try {
      $sql = "SELECT tg.gestion, ta.monto, ta.mes
              FROM tblAporte ta
              LEFT JOIN tblGestion tg ON ta.gestion_id = tg.idGestion
              WHERE ta.idSocio = $idSocio
              ORDER BY tg.gestion ASC;";
      $stmt = connectToDatabase()->prepare($sql);
      $stmt->execute();
      $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (\Throwable $th) {
      //print_r($th);
    }
    return $res;
  }

  public static function getAportesMesGestion($mes, $gestion){
    $res = [];
    try {
      $sql = "SELECT * 
              FROM tblAporte ta
              LEFT JOIN tblGestion tg on ta.gestion_id = tg.idGestion
              WHERE ta.mes = '$mes'
                AND tg.gestion = '$gestion';";
      $stmt = connectToDatabase()->prepare($sql);
      $stmt->execute();
      $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch(\Throwable $th){
        //print_r($th);
    }
    return $res;
  }

  public static function registerFullData($registros){
    $res = false;
    try {
      if(count($registros) > 0){
        $values = "";
        foreach($registros as $registro){
          $values .= "(".$registro['idSocio'].",".$registro['monto'].",'".$registro['mes']."','".
                      $registro['observacion']."',".$registro['gestion_id']."),";
        }
        $values = substr($values, 0, -1);
        $sql = "INSERT 
                INTO tblAporte (idSocio,monto,mes,observacion,gestion_id)
                VALUES $values;";
                
        $con = connectToDatabase();
        
        $stmt = $con->prepare($sql);
        
        return $stmt->execute();
      }
    } catch (\Throwable $th) {
      print_r($th);
    }
    return $res;
  }

  /*public function getAportes($idSocio){
    $res = null;
    try {
      $sql = "SELECT * 
                FROM tblAporte 
                WHERE idSocio = ? 
                ORDER BY gestion DESC, mes DESC;";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute([$idSocio]);
      $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (\Throwable $th) {
      print_r($th);
    }
    return $res;
  }
*/

}
?>