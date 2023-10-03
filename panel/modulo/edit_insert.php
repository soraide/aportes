<?php

include("../../connections/conexion.php");
$id = $_POST["idModulo"];

$modulo = $_POST["modulo"];
$idCurso = $_POST["idCurso"];
$update = " UPDATE tblModulo set  modulo = '$modulo' , idCurso = '$idCurso'  WHERE idModulo=$id; ";

$query = sqlsrv_query($con, $update);
if ($query) {



    echo 1;
} else {
    echo 2;
}


?>