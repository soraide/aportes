<?php
include_once('../../connections/conexion.php');
$response = array();
if(isset($_POST['idContenido'])){
  $idContenido = $_POST['idContenido'];
  $sql = "SELECT r.idRespuesta, r.respuesta, COALESCE(a.cantidad_respuestas, 0) AS cantidad
  FROM tblRespuesta r
  LEFT JOIN (
    SELECT respuesta, COUNT(*) AS cantidad_respuestas
    FROM tblAvance
    WHERE idContenido = ?
    GROUP BY respuesta
  ) a ON r.idRespuesta = a.respuesta
  WHERE r.idContenido = ?";
  $stmt = sqlsrv_query($con, $sql, array($idContenido, $idContenido));
  if($stmt){
    $registros = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
      $registros[] = $row;
    }
    $response['success'] = 1;
    $response['data'] = $registros;
  }else{
    $response['success'] = 0;
    $response['data'] = 'Error consult';
  }
}else{
  $response['success'] = 0;
  $response['data'] = 'Error Request Method';
}
echo json_encode($response);
?>