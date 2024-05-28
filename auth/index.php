<?php 
  session_start();
  if(isset($_SESSION['idSocio'])){
    header('Location: ../profile/');
    die();
  }
?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="es" data-mdb-theme="light">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="description" content="">
  <title>Ingresar</title>
  <link rel="stylesheet" href="../static/css/nicepage.css" media="screen">
  <link rel="stylesheet" href="../static/css/Inicio.css" media="screen">
  <meta name="theme-color" content="#243f56">
  <meta property="og:title" content="Inicio">
  <meta property="og:type" content="website">
  <meta data-intl-tel-input-cdn-path="intlTelInput/">
  <!-- Font Awesome -->
  <link href="../mdb/icons/font-awesome/css/fontawesome-all.min.css" rel="stylesheet" />
  <!-- MDB -->
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
    id="carousel_e141" src="" data-image-width="1620" data-image-height="1080">
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
                          <input type="email" class="form-control" placeholder="Tu usuario (Correo)" aria-label="Username"
                            aria-describedby="addon-wrapping" id="user" required />
                        </div>
                      </div>
                      <div class="row mb-4">
                        <div class="input-group flex-nowrap input-group-lg">
                          <input type="password" class="form-control" placeholder="Tu contraseña" aria-label="Username" aria-describedby="addon-wrapping" id="pass" required data-obscure="1"/>
                          <button class="btn btn-light" type="button" id="btn-obscure-password" data-mdb-ripple-init data-mdb-ripple-color="dark" >
                            <i class="fas fa-eye"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                    <a href="../home" class="mt-4 btn btn-lg btn-outline-light text-light me-4"><i class="fas fa-times me-2"></i> <b>Cancelar</b></a>
                    <button type="submit" class="btn btn-lg btn-light text-light text-dark"><i class="fas fa-sign-in-alt me-2"></i> <b>INICIAR SESIÓN</b></button>
                    <div id="mensaje" class="mt-4 p-2 text-light" style="border-radius: 6px;display: none;"></div>
                    <div class="row mt-4">
                      <div class="col-12 text-light">
                        ¿No tienes una cuenta? <a class="text-light" href="../register/"><b>Regístrate</b></a>
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
  <script type="text/javascript" charset="utf8" src="../static/js/jquery.js"></script>
  <script src="./js/login.js"></script>
</body>

</html>