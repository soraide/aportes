<?php

include("../../connections/conexion.php");
$id = $_POST["id"];
$sql = "SELECT * FROM tblModulo WHERE idModulo ='$id' ";
$query = sqlsrv_query($con, $sql);
$row = sqlsrv_fetch_array($query);

$modulo = $row["modulo"];
$idCurso = $row["idCurso"];
$t = time();

?>

<form style="padding:10px" id="edit_modulo">
  <input type="hidden" name="idModulo" value="<?php echo $id; ?>">

  <div class="row g-3 align-items-center">
    <div class="" style="margin:30px auto">
      <button type="submit" class="btn btn-success">Actualizar</button>
      <button type="button" onclick="listar_modulo(1)" class="btn btn-danger">Volver</button>
    </div>
  </div>

  <div class="row g-3 align-items-center">
    <div class="col-2">
      <label class="col-form-label">Módulo</label>
    </div>
    <div class="col-9">
      <input type="text" name="modulo" required autocomplete="off" class="form-control" placeholder="Escriba..."
        value="<?php echo $modulo ?>">
    </div>
  </div><br>

  <div class="row g-3 align-items-center">
    <div class="col-2">
      <label class="col-form-label">Curso</label>
    </div>
    <div class="col-9">
      <select class="form-control" name="idCurso">
        <?php
        $sql = "SELECT * FROM tblCurso";
        $query = sqlsrv_query($con, $sql);
        while ($row = sqlsrv_fetch_array($query)) {
          $value = $row["idCurso"];
          $texto = $row["curso"];
          if ($idCurso == $value) {
            echo ' <option value="' . $value . '" selected="selected">' . $texto . '</option> ';
          } else {
            echo ' <option value="' . $value . '" >' . $texto . '</option> ';
          }
        }
        ?>
      </select>
    </div>
  </div><br>
</form>