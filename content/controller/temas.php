<?php
// $footer = '
//   <div class="box-footer">
//     <button id="txt-btn" class="btn btn-info btn-right" style="float:right">Siguiente</button>
//   </div>
// </div>';
$footer = '
</div>';

$body = '';
$tema = $_GET['idTema'];
include '../../connections/conexion.php';
$sql = "SELECT idContenido, titulo, recurso, consigna, orden, tipo, detalle
  FROM tblContenido WHERE idTema = ? 
  ORDER BY orden;";
$params = array($tema);
$stmt = sqlsrv_query( $con,$sql,$params);

$response = array();
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
        $botonVer = $row['detalle'] == 'si' ? '<button id="btn-ver'.$row['idContenido'].'" onclick="respuestas('.$row['idContenido'].')" class="btn btn-primary btn-right margin" style="float:right; display:none">Respuestas de mis compañeros</button>' : '';
        $sis = $row['detalle'] == 'si' ? 'SI':'NO';
        $verForo = $row['detalle'] == 'si' ? 'verForo'.$row['idContenido'] : '';
        $contenido = $head.'
          <h2 class="box-title" style="text-transform:uppercase;text-align:center;display:block;font-size:2.2rem;">'.$row['titulo'].'</h2>
        </div>
        <div class="box-body" id="'.$verForo.'">
          <p style="text-align:center;font-size:1.65rem;">'.$row['consigna'].'</p>
          <hr />
          <h4 class="display-3" style="color:#00294c;">'.$row['recurso'].'</h4>
          <div class="form-group">
            <input type="text" style="width:80%;margin:0 auto;" class="form-control" id="respuesta'.$row['idContenido'].'" placeholder="Respuesta aquí...">
          </div>
        </div>
        <div class="box-footer" style="display:flex;justify-content:center;">
          '.$botonVer.'
          <button id="btn-foro'.$row['idContenido'].'" onclick="foroResp(\''.$sis.'\',this, '.$row['idContenido'].')" class="btn btn-success" style="float:right">Enviar Respuesta</button>
        </div>
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
        $respuestas = getRespuestas($row['idContenido'], $con);
        $contenido = $head.'
          <h2 class="box-title" style="text-transform:uppercase;text-align:center;
          display:block;font-size:2.2rem;">'.$row['titulo'].'</h2>
        </div>
        <div class="box-body" id="resEncuesta'.$row['idContenido'].'">
          <p style="text-align:center;font-size:1.65rem;">'.$row['consigna'].'</p>
          <hr />
          <h4 class="display-3" style="color:#00294c;">'.$row['recurso'].'</h4>
          <div id="btns'.$row['idContenido'].'" style="display:flex;justify-content:center;flex-wrap:wrap;gap:7px;" class="btn-group'.$row['idContenido'].'" data-toggle="buttons">
            '.$respuestas.'
          </div>
        </div>
        <div class="box-footer" style="display:flex;justify-content:center;">
          <button id="btn-enc'.$row['idContenido'].'" onclick="verResultadosEnc('.$row['idContenido'].')" class="btn btn-success" style="display:none">Ver Resultados parciales</button>
        </div>
        '.$footer;
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
    array_push($id_tipo, [$row['idContenido'], $row['tipo']]);
    array_push($response, $contenido);
  }
}else{
  echo 'Error Internal Server';
}
$res = array("ids"=>$id_tipo, "contenido"=>$response);
echo json_encode($res);

function getIframeYT($idYT){
  return '<iframe id="ytplayer" width="720" height="400" src="https://www.youtube.com/embed/'.$idYT.'?enablejsapi=1&autoplay=1" title="BMS" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen=""></iframe>';
}

function getRespuestas($idContenido, $con){
  $sql = "SELECT idRespuesta, respuesta FROM tblRespuesta WHERE idContenido = $idContenido";
  $stmt = sqlsrv_query($con, $sql);
  $res = '';
  if($stmt){
    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
      $res .= '
        <label class="btn btn-default">
          <input type="radio" name="options" id="selec'.$row['idRespuesta'].'" autocomplete="off" value="'.$row['idRespuesta'].'">'.$row['respuesta'].'
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
        <input type="radio" name="optionSelec" autocomplete="off" value="'.$row['correcto'].'">'.$row['respuesta'].'
      </label>';
    }
  }
  return $res;
}
?>