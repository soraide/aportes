<?php 
  session_start();
  if(isset($_SESSION['idSocio'])){
    header('Location: ../home/');
    die();
  }
?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="es">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="description" content="">
  <title>Ingresar</title>
  <link rel="stylesheet" href="../static/css/nicepage.css" media="screen">
  <link rel="stylesheet" href="../static/css/Inicio.css" media="screen">
  <link rel="stylesheet" href="../static/css/bootstrap.min.css">
  <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
  <script class="u-script" type="text/javascript" src="../static/js/jquery.js" defer=""></script>
  <script class="u-script" type="text/javascript" src="../static/js/nicepage.js" defer=""></script>
  <meta name="generator" content="Nicepage 5.5.0, nicepage.com">

  <link id="u-theme-google-font" rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Open+Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i">
  <link id="u-page-google-font" rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i">
  <script type="application/ld+json">{
		"@context": "http://schema.org",
		"@type": "Organization",
		"name": "Aprendizaje",
		"logo": "/images/logo_en.png",
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
  <style>
    @media (max-width: 720px){
      #authForm{
        width:100%;
      }
      #logoAuth{
        display: none;
      }
    }
  </style>
</head>

<body data-home-page="../home/" class="u-body u-xl-mode" data-lang="es">
  <?php //include('../common/header.php'); ?>
  <section
    class="skrollable skrollable-between u-align-center u-clearfix u-container-align-center u-image u-shading u-section-2"
    id="carousel_e141" src="" data-image-width="1620" data-image-height="1080" style="background-color: rgba(36, 63, 87, 0.8);">
    <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-4 ps-5 pe-5" id="logoAuth">
            <img src="../images/logo.png" class="img img-fluid" alt="" srcset="" width="300">
          </div>
          <div class="col-lg-8 p-4" id="authForm">
            <div class="row justify-content-center">
              <div class="card" style="max-width:500px;background-color: rgba(255,255,255,0) !important;">
                <!-- FORMULARIO -->
                <form class="login">
                  <div class="card-header text-center">
                    <h4 class="card-title text-light mt-2"><b>Iniciar Sesión</b></h4>
                  </div>
                  <div class="card-body">
                    <div class="container">
                      <div class="row mb-4">
                        <div class="input-group flex-nowrap input-group-lg">
                          <span class="input-group-text" id="addon-wrapping"><i class="fas fa-user"></i></span>
                          <input type="email" class="form-control" placeholder="Tu usuario (Correo)" aria-label="Username"
                            aria-describedby="addon-wrapping" id="user" required />
                        </div>
                      </div>
                      <div class="row mb-4">
                        <div class="input-group flex-nowrap input-group-lg">
                          <span class="input-group-text" id="addon-wrapping"><i class="fas fa-key"></i></span>
                          <input type="password" class="form-control" placeholder="Tu contraseña" aria-label="Username"
                            aria-describedby="addon-wrapping" id="pass" required />
                        </div>
                      </div>
                    </div>
                    <a href="../home" class="mt-4 btn btn-lg btn-danger text-light"><i
                        class="fas fa-xmark"></i> <b>Cancelar</b></a>
                    <button type="submit" class="btn btn-lg btn-success text-light"><i class="fas fa-sign-in-alt"></i> <b>INICIAR SESIÓN</b></button>
                    <div id="mensaje" style="font-size:18px;background-color: blue; margin-top: 15px; border-radius: 6px;">
                    </div>
                    <div class="row mt-4">
                      <div class="col-12 text-muted">
                        ¿No tienes una cuenta? <a class="text-primary" href="../register/">Regístrate</a>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
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
  <!-- <script defer src="../fontawesome/js/all.js"></script> -->
  <!-- <script src="../fontawesome/js/fontawesome.js"></script> -->
    <script type="text/javascript" charset="utf8" src="../static/js/jquery.js"></script>
  <script src="./js/login.js"></script>
  <script src="../static/js/bootstrap.min.js"></script>
</body>

</html>