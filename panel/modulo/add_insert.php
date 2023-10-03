<?php

include("../../connections/conexion.php");
$modulo = $_POST["modulo"];
$idCurso = $_POST["idCurso"];
$id = guidv4();
$sql = "  INSERT INTO tblModulo (modulo,idCurso) VALUES ('$modulo','$idCurso');";
$query = sqlsrv_query($con, $sql);
if ($query) {
  echo 1;
} else {
  echo 2;
}
?>