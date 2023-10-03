<?php
include_once('../../connections/conexion.php');
$response = "";
$header = "";
$preg = "";

if(isset($_POST['idContenido'])){
  $sql = "SELECT tc.recurso, ta.respuesta, te.nombre, CONVERT(VARCHAR(19), ta.fechaReg, 120) AS fechaReg FROM tblAvance AS ta
    INNER JOIN tblEstudiante AS te
    ON te.idEstudiante = ta.idEstudiante
    INNER JOIN tblContenido AS tc
    ON tc.idContenido = ta.idContenido  
    WHERE ta.idContenido = ".$_POST['idContenido']." 
    ORDER BY ta.fechaReg;";
  $stmt = sqlsrv_query($con, $sql, array());
  if(sqlsrv_has_rows($stmt)>0){
    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
      $preg = $row['recurso'];
      $fecha = strtotime($row['fechaReg']);
      $fecha = date('d/m H:i', $fecha);
      $response .='
          <li>
            <i class="fa fa-user bg-blue"></i>
            <div class="timeline-item">
              <span class="time"><i class="fa fa-clock-o"></i> '.$fecha.'</span>
              <h3 class="timeline-header"><a href="#">'.$row['nombre'].'</a></h3>
              <div class="timeline-body h4">
                '.$row['respuesta'].'
              </div>
            </div>
          </li>';
    }
    $header = '
    <div class="row">
      <div class="col-md-12">
        <ul class="timeline">
          <li class="time-label">
            <span class="bg-yellow">
              Foro - '.$preg.'
            </span>
          </li>
          <hr/>
    ';
    $response = $header.$response.
    '
        </ul>
      </div>
    </div>
    ';
  }else{
    $response = '<h1>No hay respuestas aún</h1>';
  }
  echo $response;
}else{
  echo "Parametros incorrectos";
}

?>