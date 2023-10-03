<?php
session_start();
$id = $_SESSION['idSocio'];
include_once('../../connections/conexion.php');

$sql = "INSERT INTO tblRespEncuesta(respuesta, idEstudiante, idEncuestaPreg) 
        VALUES (?,$id,2),
        (?,$id,3),
        (?,$id,4),
        (?,$id,5),
        (?,$id,6),
        (?,$id,7);";
$params = array($_POST['enc1'],$_POST['enc2'],$_POST['enc3'],$_POST['enc4'],$_POST['enc5'],$_POST['enc6']);
$stmt = sqlsrv_query($con, $sql, $params);
if($stmt){
  echo 1;
}else{
  print_r(sqlsrv_errors());
}
?>