<?php
session_start();
include('../connections/conexion.php');
$sesion = false;
$id = 0;
$idCurso = 0;
if(isset($_SESSION['idSocio'])){
  $id = $_SESSION['idSocio'];
  $idCurso = $_GET['id'];
  $sesion=true;
  $img  = file_exists('../images/users/'.$_SESSION['idSocio'].'.jpg') ? '../images/users/'.$_SESSION['idSocio'].'.jpg': '../images/users/default.jpg';
}
?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="es">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="keywords" content="​Happiness &amp;amp; Mindfulness Courses, Welcome Message, Benefits of working with us​, 01, 02, 03, 04, 05, 06, ​How Coaching Works, ​How and where to learn mindfulness, Meet The Team
Our Professionals, ​Start using Our App for free">
  <meta name="description" content="">
  <title>Compañeros</title>
  <link rel="stylesheet" href="../static/css/nicepage.css" media="screen">
  <link rel="stylesheet" href="../static/css/Inicio.css" media="screen">
  <link rel="stylesheet" href="./users/resources/css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/tarjetas.css">
  <script class="u-script" type="text/javascript" src="../static/js/jquery.js"></script>
  <script class="u-script" type="text/javascript" src="../static/js/nicepage.js" defer=""></script>
  
  <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
  <link id="u-page-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
  <script type="application/ld+json">{
  "@context": "http://schema.org",
  "@type": "Organization",
  "name": "Aprendizaje",
  "logo": "images/logo_en.png",
  "sameAs": []
}</script>
  <meta name="theme-color" content="#243f56">
  <meta property="og:type" content="website">
<meta data-intl-tel-input-cdn-path="intlTelInput/">
<!-- Font Awesome -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css"
  rel="stylesheet"
/>
</head>
  <body class="u-body u-xl-mode" data-lang="es">

    <?php 
    if($sesion){
      include('../common/header-log.php');
    }else{
      include('../common/header.php');
    }
    ?>
    <section class="u-clearfix u-section-1" id="sec-4891">
      <div class="u-clearfix u-sheet u-sheet-1">
      <?php
    echo '
    <section class="content">
    <div class="page-header" style="border: none">
      <h1>Compañeros de Curso<br>
        <small>'.'</small>
      </h1>
    </div>
    <div style="width:330px; margin:0 auto 20px auto"><a class="btn btn-primary btn-block" href="./?id='.$idCurso.'" role="button" >VOLVER</a></div>
    ';
    $sql = "SELECT * FROM tblEstudiante 
    WHERE idEstudiante IN (
      SELECT idEstudiante
      FROM tblMiCurso 
      WHERE idCurso = ?
    ) AND idEstudiante != ?;";
    $params = array($idCurso, $id);
    // $sql = "SELECT * FROM tblEstudiante WHERE idEstudiante = ? AND idEstudiante = 3";
    // $params = array($id);
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmt = sqlsrv_query($con, $sql, $params, $options);
    if ($stmt){
      if(sqlsrv_has_rows($stmt)>0){
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
          $img = file_exists('../images/users/'.$row['idEstudiante'].'.jpg') ? '../images/users/'.$row['idEstudiante'].'.jpg' : '../images/users/default.jpg';
          
          echo '
          <div class="col-md-4 col-sm-6 col-xs-12">
              <article class="material-card Blue-Grey">
                  <h2>
                      <span>' . ($row["nombre"]) . '</span>
                      <strong>
                          <i class="fa fa-fw fa-envelope"></i>
                          ' . ($row["usuario"]) . '
                      </strong>
                  </h2>
                  <div class="mc-content">
                      <div class="img-container">
                          <img class="img-responsive" style="width:445px" src="'.$img.'">
                      </div>
                      <div class="mc-description">
                          ' . ($row["acercademi"]) . '
                      </div>
                  </div>
                  <a class="mc-btn-action">
                      <i class="fa fa-bars"></i>
                  </a>
                  <div class="mc-footer">
                      <h4>
                          Contacto
                      </h4>
                      <a class="fa fa-fw fa-envelope" href="mailto: ' . $row["usuario"] . '"></a>
                      <a class="fa-brands fa-whatsapp" href="https://wa.me/591'.$row['celular'].'" target="_blank" style="padding-left: 15px;"></a>
                      <h4 id="phone">&nbsp&nbsp&nbsp&nbsp&nbsp +591 ' . $row["celular"] . '</h4>
                  </div>
              </article>
              </div>';
        }
      }else{
        echo '
        <div class="alert alert-primary" role="alert">
          <h4 class="alert-heading">AÚN NO TIENES COMPAÑEROS</h4>
          <p>Vuelve más tarde, quizá tengas nuevos compañeros.</p>
          <hr>
          <p class="mb-0">¡Aprender con compañeros es más divertido!</p>
        </div>';
      }
    }else{
      echo '
      <div class="alert alert-warning" role="alert">
        <h4 class="alert-heading">Ocurrió un error inesperado</h4>
        <p>No pasa nada, vuelve a intentarlo en unos minutos.</p>
        <hr>
        <p class="mb-0">Si no funciona, puedes comunicarte con soporte técnico.</p>
      </div>
      ';
    }

    echo '
    </section>';
    ?>
      </div>
    </section>
    
    <?php include('../common/footer.php'); ?>

    <script src="./js//tarjetas.js"></script>
</body>
</html>