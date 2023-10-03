<?php
session_start();
if(isset($_SESSION['idSocio'])){
  $img = file_exists('../images/users/'.$_SESSION['idSocio'].'.jpg') ? '../images/users/'.$_SESSION['idSocio'].'.jpg': '../images/users/default.jpg';
}else{
  header("Location: ../profile/");
}
?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="es">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <title>Mis Cursos</title>
  <link rel="stylesheet" href="../static/css/nicepage.css" media="screen">
  <link rel="stylesheet" href="./css/soli.css" media="screen">
  <script class="u-script" type="text/javascript" src="../static/js/jquery.js"></script>
  <script class="u-script" type="text/javascript" src="../static/js/nicepage.js" defer=""></script>
  <meta name="generator" content="Nicepage 5.5.0, nicepage.com">
  <link id="u-theme-google-font" rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
  <link id="u-page-google-font" rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="../static/js/sweetalert2.min.js"></script>
  <script type="application/ld+json">{
    "@context": "http://schema.org",
    "@type": "Organization",
    "name": "Aprendizaje",
    "logo": "images/logo_en.png",
    "sameAs": []
}</script>
  <meta name="theme-color" content="#243f56">
  <meta data-intl-tel-input-cdn-path="intlTelInput/">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
  <style>
    .swal2-title {
      font-size: 25px !important;
    }
  </style>
</head>

<body class="u-body u-xl-mode" data-lang="es">
  <?php include('../common/header-log.php'); ?>
  <section class="u-clearfix u-section-1" id="sec-f910" style="height: auto;">
  <br>
    <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
      <div class="container" style="display:flex; flex-wrap:wrap">
        <div class="card">
          <div class="title">
            <h1>Préstamo de consumo</h1>
            <h2>Solicita esta categoria de préstamo</h2>
          </div>
          <div class="content">
            <div class="social">
              <a href="./solicitud.php?nsp=0xc01" class="btn btn-primary">
                Solicitar</a>
            </div>
          </div>
          <div class="circle"></div>
        </div>

        <div class="card">
          <div class="title">
            <h1>Préstamo de emergencia</h1>
            <h2>Solicita esta categoria de préstamo</h2>
          </div>
          <div class="content">

            <div class="social">
              <a href="./solicitud.php?nsp=0xe08" class="btn btn-primary">
                Solicitar</a>
            </div>
          </div>
          <div class="circle"></div>
        </div>
        <div class="card">
          <div class="title">
            <h1>Préstamo auxilio</h1>
            <h2>Solicita esta categoria de préstamo</h2>
          </div>
          <div class="content">
            <div class="social">
              <a href="./solicitud.php?nsp=0xa03" class="btn btn-primary">
                Solicitar</a>
            </div>
          </div>
          <div class="circle"></div>
        </div>
        <div class="card">
          <div class="title">
            <h1>Préstamo regular</h1>
            <h2>Solicita esta categoria de préstamo</h2>
          </div>
          <div class="content">
            <div class="social">
              <a href="./solicitud.php?nsp=0xr07" class="btn btn-primary">
                Solicitar</a>
            </div>
          </div>
          <div class="circle"></div>
        </div>
      </div>
    </div>

  </section>
  <br> <br><br>
  <?php include('../common/footer.php'); ?>
  <script src="./js/app.js"></script>
</body>

</html>