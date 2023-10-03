<?php
session_start();
include_once('../../connections/conexion.php');
$idTema = $_GET['idTema'];
$id = $_SESSION['idSocio'];
$footer = '
</div>';

$sql = "SELECT idContenido, titulo, recurso, consigna, orden, tipo, detalle
  FROM tblContenido WHERE idTema = ? 
  ORDER BY orden;";
$params = array($idTema);
$stmt = sqlsrv_query($con, $sql, $params);

$response = '';
$id_tipo = array();
if($stmt){
  while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
    $contenido = '';
    $head = '
    <div class="box" id="c'.$row['idContenido'].'">
      <div class="box-header with-border" style="background-color:#00294c;color:#b8c7ce;">';
    switch ($row['tipo']) {
      case 'texto':
        $contenido = $head.'
          <h2 class="box-title" style="text-transform:uppercase;text-align:center;display:block;font-size:2.2rem;">'.$row['titulo'].'</h2>
        </div>
        <div class="box-body">
          <p style="text-align:center;font-size:1.65rem;">'.$row['consigna'].'</p>
        </div>
        <div class="box-footer">
          <p style="padding:25px;font-size:1.5rem">'.$row['recurso'].'</p>
        </div>'.
        $footer;
        break;
      case 'video':
        $iframe = getIframeYT($row['recurso']);
        $contenido = $head.'
          <h2 class="box-title" style="text-transform:uppercase;text-align:center;display:block;font-size:2.2rem;">'.$row['titulo'].'</h2>
        </div>
        <div class="box-body">
          <p style="text-align:center;font-size:1.65rem;">'.$row['consigna'].'</p>
        </div>
        <div class="box-footer">
          <div style="display: flex;justify-content: center;" id="video'.$row['idContenido'].'">'
            .$iframe.
          '</div>
        </div>'.
        $footer;
        break;
      case 'pdf':
        $contenido = $head.'
          <h2 class="box-title" style="text-transform:uppercase;text-align:center;display:block;font-size:2.2rem;">'.$row['titulo'].'</h2>
        </div>
        <div class="box-body">
          <p style="text-align:center;font-size:1.65rem;">'.$row['consigna'].'</p>
        </div>
        <div class="box-footer">
          <embed src="'.$row['recurso'].'" type="application/pdf" width="100%" height="800px">
        </div>'.
        $footer;
        break;
      case 'foro':
        $sis = $row['detalle'] == 'si' ? 'SI':'NO';
        $titulo = $row['detalle'] != 'si' ? 
        '<p style="text-align:center;font-size:1.65rem;">'.$row['consigna'].'</p>
        <hr />
        <h4 class="display-3" style="color:#00294c;">'.$row['recurso'].'</h4>' : '';
        $cuerpo = respuestaForo($sis, $row['idContenido'], $con, $id);
        $contenido = $head.'
          <h2 class="box-title" style="text-transform:uppercase;text-align:center;display:block;font-size:2.2rem;">'.$row['titulo'].'</h2>
        </div>
        <div class="box-body">
         '.$titulo.' 
          '.$cuerpo.'
        </div>
        <div class="box-footer" style="display:flex;justify-content:center;"></div>
      </div>';
        break;
      case 'textoimg':
        $contenido = $head.'
          <h2 class="box-title" style="text-transform:uppercase;text-align:center;display:block;font-size:2.2rem;">'.$row['titulo'].'</h2>
        </div>
        <div class="box-body">
          <p style="text-align:center;font-size:1.65rem;">'.$row['consigna'].'</p>
        </div>
        <div class="box-footer">
          <div style="display: flex;justify-content: center;">
            <img src="../images/contenidos/'.$row['idContenido'].'.jpg" width="720px" height="auto" >
          </div>
          <hr />
          <p style="padding:25px;font-size:1.5rem">'.$row['recurso'].'</p>
        </div>'.
        $footer;
        break;

      case 'encuesta':
        $grafica = getGrafico($row['idContenido'], $con);
        $contenido = $head.'
          <h2 class="box-title" style="text-transform:uppercase;text-align:center;
          display:block;font-size:2.2rem;">'.$row['titulo'].'</h2>
        </div>
        <div class="box-body" id="resEncuesta'.$row['titulo'].'">
          <p style="text-align:center;font-size:1.65rem;">'.$row['consigna'].'</p>
          <hr />
          <h4 class="display-3" style="color:#00294c;">'.$row['recurso'].'</h4>
            <canvas id="grafico'.$row['idContenido'].'" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            '.$grafica.'
        </div>'.$footer;
        break;
      case 'seleccion':
        $respuestas = getRespuestasSelec($row['idContenido'], $con);
        $contenido = $head.'
          <h2 class="box-title" style="text-transform:uppercase;text-align:center;
          display:block;font-size:2.2rem;">'.$row['titulo'].'</h2>
        </div>
        <div class="box-body" id="resEncuesta">
          <p style="text-align:center;font-size:1.65rem;">'.$row['consigna'].'</p>
          <hr />
          <h4 class="display-3" style="color:#00294c;">'.$row['recurso'].'</h4>
          <div id="btns'.$row['idContenido'].'" style="display:flex;justify-content:center;flex-wrap:wrap;gap:7px;" class="btn-group'.$row['idContenido'].'" data-toggle="buttons">
            '.$respuestas.'
          </div>
        </div>'.$footer;
        break;
      
      default:
        $contenido = $head.'<h3 class="box-title" style="text-transform:uppercase">Contenido no identificado</h3>
        </div>'.$footer;
        break;
    }
    // $id_tipo[$row['idContenido']] = $row['tipo'];
    
    $response .= $contenido;
  }
  echo $response;
}
/*
  @sis en caso de ser SI se muestra el foro de todos, sino se muestra solo la respuesta de respuestas.
  @idContenido id del contenido 
  @con conexion SQL
*/
function respuestaForo($sis, $idContenido, $con, $id){
  $retornar = '';
  if($sis == 'SI'){
    $sql = "SELECT tc.recurso, ta.respuesta, te.nombre, CONVERT(VARCHAR(19), ta.fechaReg, 120) AS fechaReg FROM tblAvance AS ta
    INNER JOIN tblEstudiante AS te
    ON te.idEstudiante = ta.idEstudiante
    INNER JOIN tblContenido AS tc
    ON tc.idContenido = ta.idContenido  
    WHERE ta.idContenido = $idContenido 
    ORDER BY ta.fechaReg;";
    $stmt = sqlsrv_query($con, $sql, array());
    if(sqlsrv_has_rows($stmt)>0){
      while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
        $preg = $row['recurso'];
        $fecha = strtotime($row['fechaReg']);
        $fecha = date('d/m H:i', $fecha);
        $retornar .= '
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
      $retornar = $header.$retornar.
      '
          </ul>
        </div>
      </div>
      ';
    }else{
      $retornar = '<h1>No hay respuestas aún</h1>';
    }
  }else{
    $sql = "SELECT * FROM tblAvance WHERE idContenido = $idContenido AND idEstudiante = $id;";
    $stmt = sqlsrv_query($con, $sql);
    $res = '';
    if($stmt){
      $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
      $retornar = '
      <div class="form-group">
        <input type="text" disabled style="width:80%;margin:0 auto;" class="form-control" value="'.$row['respuesta'].'">
      </div>';
    }else{
      $retornar = '<p>Ocurrio un error</p>';
    }
  }
  return $retornar;
}
function getIframeYT($idYT){
  return '<iframe id="ytplayer" width="720" height="400" src="https://www.youtube.com/embed/'.$idYT.'?enablejsapi=1&autoplay=0" title="BMS" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen=""></iframe>';
}

function getRespuestas($idContenido, $con){
  $sql = "SELECT idRespuesta, respuesta FROM tblRespuesta WHERE idContenido = $idContenido";
  $stmt = sqlsrv_query($con, $sql);
  $res = '';
  if($stmt){
    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
      $res .= '
        <label class="btn btn-default">
          <input type="radio" disabled name="options" id="selec'.$row['idRespuesta'].'" autocomplete="off" value="'.$row['idRespuesta'].'">'.$row['respuesta'].'
        </label>';
    }
  }
  return $res;
}

function getRespuestasSelec($idContenido, $con){
  $sql = "SELECT idRespuesta, respuesta, correcto FROM tblRespuesta WHERE idContenido = $idContenido";
  $stmt = sqlsrv_query($con, $sql);
  $res = '';
  if($stmt){
    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
      $corr = $row['correcto'] == 'si' ? 'id="correct"' : '';
      $res .= '
      <label class="btn btn-default" '.$corr.'>
        <input type="radio" disabled name="optionSelec" autocomplete="off" value="'.$row['correcto'].'">'.$row['respuesta'].'
      </label>';
    }
  }
  return $res;
}

function getGrafico($idContenido, $con){
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
    $cadNombres = '';
    $cadCantidades = '';
    $cant = 0;
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
      $cadNombres .= '"'.$row['respuesta'].'",';
      $cadCantidades .= $row['cantidad'].',';
      $cant++;
    }
    $cadNombres = substr($cadNombres, 0, -1);
    $cadCantidades = substr($cadCantidades, 0, -1);
  }else{
    $cadNombres = '';
    $cadCantidades = 0;
  }
  $respuesta = '
  <script>
  let colores = ["#f56954", "#00a65a", "#f39c12", "#00c0ef", "#3c8dbc", "#d2d6de", "#03bf0f"];
  var donutChartCanvas = $("#grafico"+'.$idContenido.').get(0).getContext("2d")
  var donutData        = {
    labels: ['.$cadNombres.'],
    datasets: [
      {
        data: ['.$cadCantidades.'],
        backgroundColor : [... colores.slice(0, '.$cant.')],
      }
    ]
  }
  var donutOptions     = {
    maintainAspectRatio : false,
    responsive : true,
  }
  new Chart(donutChartCanvas, {
    type: "doughnut",
    data: donutData,
    options: donutOptions
  })
  </script>';
  return $respuesta;
}
?>