<?php
include('../connections/conexion.php');
date_default_timezone_set('America/La_Paz');
$sql = "SELECT * FROM tblCurso WHERE idCurso = 1043";
$stmt = sqlsrv_query($con, $sql);
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$fechaInicio = $row['fechaInicio'];
$fechaFin = $row['fechaFin'];
$fechaInicio = strtotime($fechaInicio->format('Y-m-d'));
$fechaFinal = strtotime($fechaFin->format('Y-m-d'));
$hoy = strtotime(date('Y-m-d'));
echo '<br>'.$fechaInicio.'<br>'.$fechaFinal.'<br>'.$hoy;
if($hoy >= $fechaInicio && $hoy <= $fechaFinal){
    echo "ESTA EN EL RANGO";
}else{
    echo "NO ESTA EN EL RANGO";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pruebas</title>
</head>
<body>
    <h1>PRUEBA PETICIONES JSON</h1>
    <ul>
        <li>Nombre: </li>
        <li>Edad: </li>
        <li>Color: </li>
        <li>Numero: </li>
    </ul>
    <button id="number">HACER PETICION</button>

    <script src="./js/jquery.min.js"></script>
    <script src="./js/prueba.js"></script>
</body>
</html>