<?php
session_start();
$sesion = false;
if(isset($_SESSION['idSocio'])){
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
  <title>Inicio</title>
  <link rel="stylesheet" href="../static/css/nicepage.css" media="screen">
  <link rel="stylesheet" href="../static/css/Inicio.css" media="screen">
  <script class="u-script" type="text/javascript" src="../static/js/jquery.js"></script>
  <script class="u-script" type="text/javascript" src="../static/js/nicepage.js"></script>
  <meta name="generator" content="Nicepage 5.5.0, nicepage.com">

  <link id="u-theme-google-font" rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
  <link id="u-page-google-font" rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
  <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "Aprendizaje",
		"logo": "images/logo_en.png",
		"sameAs": []
}</script>
  <meta name="theme-color" content="#243f56">
  <meta property="og:title" content="Inicio">
  <meta property="og:type" content="website">
  <meta data-intl-tel-input-cdn-path="intlTelInput/">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />-->
  <link href="../mdb/css/mdb.min.css" rel="stylesheet" />
</head>

<body class="u-body u-xl-mode" data-lang="es">
  <?php 
  /*if($sesion){
    include('../common/header-log.php');
  }else{
    include('../common/header.php');
  }*/
  ?>
  <section
    class="skrollable skrollable-between u-align-center u-clearfix u-container-align-center u-image u-shading u-section-2">
    <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
      <div class="row align-items-center">
        <div class="col-lg-4 mt-4">
          <img class="img img-fluid" src="../images/logo.png" width="300" data-animation-name="customAnimationIn"
            data-animation-duration="1500">
        </div>
        <div class="col-lg-8">
          <div class="row mt-4">
            <div class="col-lg-12">
              <h2 class="text-center text-light"  data-lang-en="​How Coaching Works" data-animation-name="customAnimationIn"
                data-animation-duration="1500">¡BIENVENIDO!</h2>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-lg-12">
              <a role="button" href="../auth/"
                class="btn btn-lg btn-light me-2 text-dark"
                data-animation-name="customAnimationIn" data-animation-duration="1750" data-animation-delay="500">INICIAR SESIÓN</a>
              <a href="../register/" class="btn btn-lg btn-outline-light text-white"
                  data-animation-name="customAnimationIn" data-animation-duration="1750" data-animation-delay="500">REGISTRATE</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php //include('../common/footer.php'); ?>
  <!-- MDB -->
  <!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>-->
  <script type="text/javascript" src="../mdb/js/mdb.min.js"></script>
</body>

</html>