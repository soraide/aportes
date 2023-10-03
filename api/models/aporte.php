<?php
require_once('./config/database.php');
class AporteModel{
  private $pdo;
  private $table = 'tblAporte';

  public function __construct(){
    $this->pdo = connectToDatabase();
  }

  public function getAportes($idSocio){
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

  public function getContributionSummary($idSocio){
    $res = null;
    try {
      $sql = "SELECT ta.gestion, COUNT(*) AS aportes, SUM(ta.monto) AS monto, MAX(ta.mes) AS ultimoMes, MIN(ta.mes) AS primerMes,
                     (SELECT TOP 1 tr.rendimiento FROM tblRendimiento tr WHERE tr.gestion = ta.gestion ) AS rendimiento
              FROM tblAporte ta
              WHERE idSocio = ?
              GROUP BY gestion
              ORDER BY gestion ASC;";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute([$idSocio]);
      $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (\Throwable $th) {
      print_r($th);
    }
    return $res;
  }

  public function getContributionHistory($idSocio){
    $res = null;
    try {
      $sql = "SELECT gestion, monto,
                CASE mes WHEN '01' THEN 'ENERO' WHEN '02' THEN 'FEBRERO' WHEN '03' THEN 'MARZO'
                  WHEN '04' THEN 'ABRIL' WHEN '05' THEN 'MAYO' WHEN '06' THEN 'JUNIO'
                  WHEN '07' THEN 'JULIO' WHEN '08' THEN 'AGOSTO' WHEN '09' THEN 'SEPTIEMBRE'
                  WHEN '10' THEN 'OCTUBRE' WHEN '11' THEN 'NOVIEMBRE' WHEN '12' THEN 'DICIEMBRE' ELSE 'S/M' END AS mes
              FROM tblAporte
              WHERE idSocio = ? 
              ORDER BY gestion ASC;";
      $stmt = $this->pdo->prepare($sql);
      $stmt->execute([$idSocio]);
      $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }catch (\Throwable $th) {
      print_r($th);
    }
    return $res;
  }

}
?>