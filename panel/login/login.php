<?php
include('../../connections/conexion.php');
session_start();

$username = "";
$password = "";
if (isset($_POST['name'])) {
  $username = $_POST['name'];
}
if (isset($_POST['pwd'])) {
  $password = $_POST['pwd'];
}

$array = array($username, $password);

$consulta = "SELECT * FROM tblUsuario WHERE usuario=? AND password=?";
$ejecutar = sqlsrv_query($con, $consulta, $array);
$row_count = sqlsrv_has_rows($ejecutar);
if ($row_count === false) {
  echo 2;
} else {
  $row = sqlsrv_fetch_array($ejecutar);
  $_SESSION['idUsuario'] = $row['idUsuario'];
  $_SESSION['nombres'] = $row['nombres'];
  $_SESSION['usuario'] = $row['usuario'];
  $_SESSION['rol'] = $row['rol'];
  echo 1;
}


?>