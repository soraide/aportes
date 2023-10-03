
<?php
session_start();
include("../../connections/conexion.php");
if(isset($_SESSION['idUsuario']) && intval($_SESSION['idUsuario']) > 0){
}else{
  header('Location: ../login/index.php');
}
  
$idCurso = $_GET['curso'];
$sql = "SELECT tm.idModulo, tm.modulo, tc.curso 
FROM tblModulo AS tm
JOIN tblCurso AS tc
ON tc.idCurso = tm.idCurso
WHERE tc.idCurso = $idCurso
ORDER BY tm.idModulo;";

$query=sqlsrv_query($con,$sql);      

?>
<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modulos - Curso</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../js_lib/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../js_lib/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="../js_lib/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="../js_lib/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../js_lib/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="../js_lib/plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../js_lib/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="../css/spinner.css">
    <link rel="stylesheet" href="../css/modal.css">
    <link rel="stylesheet" href="../css/config.css">
    <link rel="stylesheet" href="../css/text_area.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.17/css/uikit.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.17/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-rc.17/js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="../css/reports-template.css">
    <link rel="stylesheet" href="../dist_pagination/simplePagination.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"></script>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
    <input type="hidden" id="carpeta-activa">
    <input type="hidden" id="pagina-activa">
    <div class="wrapper">

      <!-- Preloader -->
      <div style="position: absolute;" class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../../images/logo_en.png" alt="AdminLTELogo" height="60" width="60">
      </div>

      <?php
      include("../nav/nav.php");
      ?>

      <!-- INICIO TODO Content Wrapper. Contains page content -->
      <div class="content-wrapper" id="all-body">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-12">
                <input type="hidden" class="form-control" id="pagina" value="1">
                <h1 class="m-0" style="display:inline-block">Módulos</h1>
                <button style="display:inline-block;margin-left:100px" class="btn btn-primary btn-lg" onclick="add_modulo()"> <i class="fas fa-plus"></i> Añadir módulo</button>
                <button style="margin-left:15px;" class="btn btn-danger" onclick="curso(1)"> Volver</button>
              </div>
            </div>
          </div>
        </div>

        <section class="content">
          <div class="container-fluid">
              <!-- Small boxes (Stat box) -->
              <div class="row">
      
              </div>
              <div class="row">
                <section class="col-lg-12 connectedSortable">
                  <div class="card direct-chat direct-chat-primary">
                    <div class="card-body">
                      <div id="for-pagination1" style="text-align:center"></div>
                      <div id="modulo-result">
                        <div class="table-responsive">
                          <table style="text-align:center" class="table table-hover">
                            <tr>
                              <th>CURSO</th>
                              <th>MÓDULO</th>
                              <th>Opciones</th>
                            </tr>
                      <?php
                        $count_row=sqlsrv_has_rows($query);
                        if($count_row > 0){
                          while($row = sqlsrv_fetch_array($query)){
                            echo '
                            <tr style="cursor: default">
                              <td>'.$row['curso'].'</td>
                              <td>'.$row['modulo'].'</td>
                              <td>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_modulo" data-id="'.$row['idModulo'].'"> <i class="fas fa-trash"></i></button>
                                <button class="btn btn-primary" onclick="edit_modulo('.$row['idModulo'].')"><i class="fas fa-edit"></i></button>
                                <a href="../tema/?modulo='.$row['idModulo'].'" class="btn btn-info"><i class="fas fa-book"></i> Temas</a>
                              </td>
                            <tr>';
                          }
                          echo '
                          </table>
                        </div>';
                        }else{
                          echo '
                          </table>
                        </div>
                        <div style="padding: 20px;">
                          <p class="h3 text-danger text-center">Este curso no tiene módulos</p>
                          <button class="btn btn-danger" onclick="curso()" style="margin: 0 auto"><i class="fas fa-arrow-left"></i> Volver</button>
                        </div>';
                          }
                      ?>
                      </div>
                      <div id="for-pagination2" style="text-align:center"></div>
                    </div>
                    <div class="card-footer">
                    </div>
                  </div>
                </section>
              </div>
              <!-- /.row (main row) -->
          </div><!-- /.container-fluid -->
      </section>
      </div>
      <!-- FINAL -->
      <div id="spinner">
      </div>

      <!-- /.content-wrapper -->
      <footer class="main-footer" style="text-align:center">
      <strong>Copyright &copy;2023 &nbsp;<a href="https://stisbolivia.com">  Stis - Bolivia</a>.</strong>
      <div class="float-right d-none d-sm-inline-block">
      </div>
      </footer>
      <aside class="control-sidebar control-sidebar-dark">
      </aside>
    </div>


    <?php
         include("../avance/modal_eliminar.php");include("../contenido/modal_eliminar.php");include("../curso/modal_eliminar.php");include("../estudiante/modal_eliminar.php");include("../miCurso/modal_eliminar.php");include("../tema/modal_eliminar.php");include("../modulo/modal_eliminar.php");include("../notas/modal_eliminar.php");include("../usuario/modal_eliminar.php");
    ?>

    <div id="shadow" class="popup"></div>

    <script src="../js_lib/plugins/jquery/jquery.min.js"></script>
    <script src="../js_lib/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="../js_lib/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../js_lib/plugins/chart.js/Chart.min.js"></script>
    <script src="../js_lib/plugins/sparklines/sparkline.js"></script>
    <script src="../js_lib/plugins/jquery-knob/jquery.knob.min.js"></script>
    <script src="../js_lib/plugins/moment/moment.min.js"></script>
    <script src="../js_lib/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="../js_lib/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="../js_lib/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="../js_lib/dist/js/adminlte.js"></script>
    <script src="../js_lib/dist/js/demo.js"></script>
    <script src="../js_lib/dist/js/app_text.js"></script>
    <script src="../main-page/js/app.js"></script>
    <script src="../main-page/js/abm.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="../dist_pagination/jquery.simplePagination.js"></script>
    <script src="../avance/js/app.js"></script>
    <script src="../contenido/js/app.js"></script>
    <script src="../curso/js/app.js"></script>
    <script src="../estudiante/js/app.js"></script>
    <script src="../miCurso/js/app.js"></script>
    <script src="../tema/js/app.js"></script>
    <script src="../modulo/js/app.js"></script>
    <script src="../notas/js/app.js"></script>
    <script src="../usuario/js/app.js"></script>
    </body>

</html>