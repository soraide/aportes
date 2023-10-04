<?php
session_start();
// $userData = (object)array();
// include_once("../../connections/conexion.php");
if (isset($_SESSION['idUsuario']) && intval($_SESSION['idUsuario']) > 0) {
  $userData = get_object_vars(json_decode($_SESSION['admin']));
} else {
  header('Location: ../login/index.php');
  die();
}
// echo "LA ruta actual es: ".$_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aportes</title>

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
  <script src="../js_lib/plugins/jquery/jquery.min.js"></script>
  <link rel="stylesheet" href="../css/reports-template.css">
  <link rel="stylesheet" href="../dist_pagination/simplePagination.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css" />
  <link rel="stylesheet" href="../DataTables/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../DataTables/css/responsive.bootstrap4.min.css">
  <script src="../DataTables/js/jquery.dataTables.min.js"></script>
  <script src="../DataTables/js/dataTables.bootstrap4.min.js"></script>
  <script src="../DataTables/js/dataTables.responsive.min.js"></script>
  <script src="../DataTables/js/responsive.bootstrap4.min.js"></script>
  <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"></script>
  <script src="../../static/js/sweetalert2.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <input type="hidden" id="carpeta-activa">
  <input type="hidden" id="pagina-activa">
  <div class="wrapper">

    <!-- Preloader -->
    <div style="position: absolute;" class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../images/icono.jpg" alt="AdminLTELogo" height="60" width="60">
    </div>

    <?php
    include("../nav/nav.php");
    ?>

    <!-- INICIO TODO Content Wrapper. Contains page content -->
    <div class="content-wrapper" id="all-body">
    </div>
    <!-- FINAL -->
    <div id="spinner">
    </div>

    <!-- /.content-wrapper -->
    <footer class="main-footer" style="text-align:center">
      <strong>Copyright &copy;2023 &nbsp;<a href="https://stisbolivia.com">Stis - Bolivia</a>.</strong>
      <div class="float-right d-none d-sm-inline-block">
      </div>
    </footer>
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>


  <?php
  include("../modulo/modal_eliminar.php");
  include("../usuario/modal_eliminar.php");
  include('../socios/modalAvisos.php');
  include('../gestiones/modal_adicionar.php');
  include('../gestiones/modal_editar.php');
  include('../gestiones/modal_remover.php');
  ?>

  <div id="shadow" class="popup"></div>


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
  <script src="js/app.js"></script>
  <script src="js/abm.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <script src="../dist_pagination/jquery.simplePagination.js"></script>

  <script src="../usuario/js/app.js"></script>
  <script src="../socios/js/app.js"></script>
  <!-- <script src="../afiliados/js/app.js"></script> -->
  <script src="../subirAportes/js/app.js"></script>
  <script src="../gestiones/js/app.js"></script>
</body>

</html>