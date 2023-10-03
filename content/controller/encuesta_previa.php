<?php
session_start();
$id = $_SESSION['idSocio'];
include_once('../../connections/conexion.php');
$sql = "SELECT * FROM tblRespEncuesta WHERE idEstudiante = $id";
$stmt = sqlsrv_query($con, $sql, []);
if ($stmt){
  if(sqlsrv_has_rows($stmt)>0){
    echo '<h1 align="center">Ya realizaste la encuesta </h1>';
  }else{
    if ($_POST['idCurso'] == '1043'){
      echo '
        <div class="box box-primary" style="font-size:1.63rem;">
          <div class="box-header with-border">
            <h4 class="box-title">Encuesta previa</h4>
          </div>
          <form id="enc1043">
            <div class="box-body" style="margin:0px 15px">
              <div class="form-group">
                <label>1. Al comenzar el curso, ¿cómo calificaría su competencia en la materia de Aspectos Fundamentales de la Gestión?</label>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc1" id="res1" value="Nada competente">
                    Nada competente
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc1" id="res2" value="Muy competente">
                    Muy competente
                  </label>
                </div>
              </div>
              <br>
              <div class="form-group">
                <label for="enc2">2. ¿Qué otros cursos o programas relacionados con los negocios consideraste tomar antes de inscribirte en Aspectos Fundamentales de la Gestión?</label>
                <input type="text" class="form-control" id="enc2" placeholder="Respuesta...">
              </div>
              <br>
              <div class="form-group">
                <label>3. ¿Cuál de las siguientes es su principal motivación para tomar este curso en línea de MBS?</label>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc3" id="res031" value="Hacer un cambio de carrera">
                    Hacer un cambio de carrera
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc3" id="res032" value="Obtener un ascenso o aumento de sueldo">
                    Obtener un ascenso o aumento de sueldo
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc3" id="res033" value="Mejorar en mi puesto actual">
                    Mejorar en mi puesto actual
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc3" id="res034" value="Cursar un programa de posgrado en una escuela de negocios">
                    Cursar un programa de posgrado en una escuela de negocios
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc3" id="res035" value="Cursar un programa de posgrado (no empresarial)">
                    Cursar un programa de posgrado (no empresarial)
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc3" id="res036" value="Para cumplir un requisito profesional, educativo o de licencia">
                    Para cumplir un requisito profesional, educativo o de licencia
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc3" id="res037" value="Crear una empresa">
                    Crear una empresa
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc3" id="res038" value="Para invertir en una empresa">
                    Para invertir en una empresa
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc3" id="res039" value="Para disfrutar de la propia experiencia de aprendizaje">
                    Para disfrutar de la propia experiencia de aprendizaje
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc3" id="res0310" value="Para unirse a una comunidad de compañeros con ideas afines">
                    Para unirse a una comunidad de compañeros con ideas afines
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc3" id="res0311" value="otros">
                    Otros: <input type="text" id="otros3" placeholder="Describa">
                  </label>
                </div>
              </div>
              <br>
              <div class="form-group">
                <label>4. ¿Cómo clasificaría la importancia relativa de estos tres factores? (De más importante a menos importante)</label>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc4" id="res041" value="Marca, comunidad y contenido">
                    Marca, comunidad y contenido
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc4" id="res042" value="Marca, contenido y comunidad">
                    Marca, contenido y comunidad
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc4" id="res043" value="Comunidad, marca y contenido">
                    Comunidad, marca y contenido
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc4" id="res044" value="Comunidad, contenido y marca">
                    Comunidad, contenido y marca
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc4" id="res045" value="Contenido, marca y comunidad">
                    Contenido, marca y comunidad
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc4" id="res046" value="Contenido, comunidad y marca">
                    Contenido, comunidad y marca
                  </label>
                </div>
              </div>
              <br>
              <div class="form-group">
                <label>5. ¿Qué característica del curso te entusiasma más?</label>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc5" id="res051" value="Aprender del profesorado de MBS">
                    Aprender del profesorado de MBS
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc5" id="res052" value="Aprender de líderes empresariales de todo el mundo">
                    Aprender de líderes empresariales de todo el mundo
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc5" id="res053" value="El método del caso y el uso de ejemplos del mundo real">
                    El método del caso y el uso de ejemplos del mundo real
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc5" id="res054" value="La interactividad de la plataforma">
                    La interactividad de la plataforma
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc5" id="res055" value="Participación de los compañeros">
                    Participación de los compañeros
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="enc5" id="res056" value="otros">
                    Otros <input type="text" id="otros5" placeholder="Describa">
                  </label>
                </div>
              </div>
              <br>
              <div class="form-group">
                <label for="enc6">6. Por último, díganos qué espera conseguir para sí mismo (o para su carrera) con este curso.</label>
                <input type="text" class="form-control" id="enc6" placeholder="Tu respuesta">
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
          </form>
        </div>
      ';
    }else{
      echo '<h1>Sin encuesta</h1>';
    }
  }
}else{
  echo '<h2>Ocurrio un error interno en la consulta</h2>';
}

?>
          