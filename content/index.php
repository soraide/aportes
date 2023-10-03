<?php
session_start();
$idCurso = 0;
$id = 0;
date_default_timezone_set('America/La_Paz');
$hoy = strtotime(date('Y-m-d'));
if(isset($_GET['id']) && isset($_SESSION['idSocio'])){
  include_once('../connections/conexion.php');
  $modulos = array();
  $avancePorcentaje = array();
  $idCurso = $_GET['id'];
  $id = $_SESSION['idSocio'];
  $sql = "SELECT tmp.*, mm.idModulo, mm.modulo, md.idTema, md.tema
        FROM (
          SELECT idCurso, curso, fechaInicio, fechaFin FROM tblCurso
          WHERE idCurso = ?
        ) AS tmp
        LEFT JOIN tblModulo AS mm
        ON tmp.idCurso=mm.idCurso
        LEFT JOIN tblTema AS md
        ON md.idModulo = mm.idModulo;";
  $params = array($idCurso);
  $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
  $stmt = sqlsrv_query( $con, $sql , $params, $options );
  $curso = "";
  if($stmt){
    $fechaInicio = '';
    $fechaFinal = '';
    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
      if(isset($modulos[$row['modulo']])){
        $modulos[$row['modulo']][$row['idTema']] = $row['tema'];
      }else{
        $modulos[$row['modulo']] = array($row['idTema']=>$row['tema']);
      }      
      $curso = $row['curso'];
      $fechaInicio = $row['fechaInicio'];
      $fechaFinal = $row['fechaFin'];
    }
    $fechaInicio = strtotime($fechaInicio->format('Y-m-d'));
    $fechaFinal = strtotime($fechaFinal->format('Y-m-d'));
    if(!($hoy >= $fechaInicio && $hoy <= $fechaFinal)){
      header("Location: ../miscursos/");
      die();
    }
  }else{
    echo "ERROR";
    print_r(sqlsrv_errors());
  }    
  // Consultamos el avance de cada estudiante
  $sql = "SELECT tt.idTema, count(tc.idContenido) as contenido , count(ta.idcontenido) as avanzado 
  FROM tblModulo tm
  JOIN tblTema AS tt ON tt.idModulo = tm.idModulo
  LEFT JOIN tblContenido AS tc ON tc.idTema = tt.idTema
  LEFT JOIN tblAvance AS ta ON ta.idContenido = tc.idContenido
  AND ta.idEstudiante = ?
  WHERE tm.idCurso = ?
  group by tt.idTema;";
  $params = array($id, $idCurso);
  $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
  $stmt = sqlsrv_query( $con, $sql , $params, $options );
  $avance = array();
  if($stmt){
    while($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
      $avance[$row['idTema']] = ($row['contenido'] == $row['avanzado']) ? 'SI' : 'NO';
    }
  }else{
    echo "ERROR";
    print_r(sqlsrv_errors());
  }

  // Encontrar el porcentaje de avance
  $valor = 0;
  foreach ($modulos as $modulo => $temas) {
    $total = count($temas);
    $valor = 0;
    foreach ($temas as $idTema=>$tema) {
      if($avance[$idTema] == 'SI'){
        $valor++;
      }
    }
    $avancePorcentaje[$modulo] = intval($valor*100/$total);
    // $avancePorcentaje[$modulo] = array($valor,$total);
  }
  $totalCurso = count($avancePorcentaje)*100;
  $totalAvanzado = 0;
  foreach ($avancePorcentaje as $avance) {
    $totalAvanzado += $avance;
  }
  $avanceTotalCurso = intval(($totalAvanzado*100)/$totalCurso);
}else{
  header("Location: ../miscursos/");
  die();
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $curso; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="./css/ionicons.min.css">
  <link rel="stylesheet" href="./js/morris.js/morris.css">
  <link rel="stylesheet" href="./css/AdminLTE.min.css">
  <link rel="stylesheet" href="./css/_all-skins.min.css">


  <link id="u-theme-google-font" rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
  <link id="u-page-google-font" rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
    <style>
      .swal2-popup{
        font-size: 1.5rem !important;
      }
      .floating-button {
        position: fixed;
        /* top: 60px; */
        bottom: 50px;
        right: 20px;
        z-index: 9999;
        box-shadow: 2px 2px 8px #00294c;
      }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- header -->
    <?php include("./modules/header.php");?>
    <!-- menu aside -->

    <?php include("./modules/menu.php"); ?>
    <!-- contenido -->
    <?php include("./modules/content.php"); ?>

    <footer class="main-footer">
      <strong>Copyright &copy; 2023 <a href="../home/">Mining Business School</a>.</strong> Todos los derechos reservados.
    </footer>
  </div>
  <!-- jQuery 3 -->
  <script src="./js/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.knob/1.2.13/jquery.knob.min.js"></script>

  <!-- Bootstrap 3.3.7 -->
  <script src="./js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="./js/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="./js/fastclick.js"></script>
  <script src="./js/raphael/raphael.min.js"></script>
  <script src="./js/morris.js/morris.min.js"></script>

  <!-- API del reproductor de Youtube -->
  <script src="https://www.youtube.com/iframe_api"></script>

  <script src="../static/js/sweetalert2.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="./js/demo.js"></script>
  <script>
    $(document).ready(function () {
      $('.sidebar-menu').tree()
    })
    $(function() {
      $(".knob").knob({
        'draw' : function () { 
          $(this.i).val(this.cv + '%')
        }
      });
    });

  </script>
  <script src="./js/app.js"></script>
  <script src="./js/prueba.js"></script>
  <script src="../panel/js_lib/plugins/chart.js/Chart.min.js"></script>
</body>

</html>