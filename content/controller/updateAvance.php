<?php
// Recibimos el ID del contenido para insertar el registro
session_start();
include_once('../../connections/conexion.php');
$id = $_SESSION['idSocio'];

$idContenido = $_POST['id'];
$resp = $_POST['val'];

// id != -1
if($idContenido != -1){
  $sql = "INSERT INTO tblAvance (idContenido, idEstudiante, respuesta)
  SELECT ?, ?, ? 
  WHERE NOT EXISTS (
    SELECT * FROM tblAvance WHERE idContenido = ? AND idEstudiante = ?
  );";
  $params = array($idContenido, $id, $resp, $idContenido, $id);
  $ejecutar = sqlsrv_query($con, $sql, $params);
  if ($ejecutar){
    echo 1;
  }else{
    echo 0;
  }
}else{
  echo -1;
}



?>