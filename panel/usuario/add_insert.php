<?php

include("../../connections/conexion.php");
$usuario = $_POST["usuario"];
$password = $_POST["password"];
$nombres = $_POST["nombres"];
$rol = $_POST["rol"];
$colorNav = $_POST["colorNav"];
$colorFondo = $_POST["colorFondo"];
$celular = $_POST["celular"];
$habilitado = $_POST["habilitado"];
$fechaCaduca = $_POST["fechaCaduca"];
$id = guidv4();
$sql = "  INSERT INTO tblUsuario (usuario,password,nombres,rol,colorNav,colorFondo,celular,habilitado,fechaCaduca) VALUES ('$usuario','$password','$nombres','$rol','$colorNav','$colorFondo','$celular','$habilitado','$fechaCaduca');";

$sql_rep = "SELECT * FROM tblUsuario WHERE usuario='$usuario' AND nombres='$nombres' ";
$query_rep = sqlsrv_query($con, $sql_rep);
$count_rep = sqlsrv_has_rows($query_rep);
if ($count_rep === false) {
  $query = sqlsrv_query($con, $sql);
  if ($query) {
    $sql_max = "SELECT MAX(idUsuario) FROM tblUsuario";
    $query_max = sqlsrv_query($con, $sql_max);
    $row_max = sqlsrv_fetch_array($query_max);
    $id = $row_max[0];

    $carpeta = "../../images/admins/";
    if (!file_exists($carpeta)) {
      mkdir($carpeta, 0777, true);
    }

    $imagen = $_POST['idbase1'];
    $base_to_php = explode(',', $imagen);
    $data = base64_decode($base_to_php[1]);
    $filepath = "../../images/admins/" . $id . ".jpg";
    file_put_contents($filepath, $data);

    echo 1;
  } else {
    echo 2;
  }
} else {
  echo 7;
}


?>