<?php
session_start();
if(isset($_SESSION['idSocio']) && isset($_GET['nsp'])){
  $nroSol = $_GET['nsp'];
  $img = file_exists('../images/users/'.$_SESSION['idSocio'].'.jpg') ? '../images/users/'.$_SESSION['idSocio'].'.jpg': '../images/users/default.jpg';
}else{
  header("Location: ../profile/");
  die();
}
$data = file_get_contents('./solicitudes.json');
$data = json_decode($data, true);
$soli = $data[$nroSol];
?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="es">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="keywords" content="">
  <meta name="description" content="">
  <title>Solicitud</title>
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
      <h2 class="u-align-center u-text u-text-palette-1-base u-text-1">SOLICITUD <?=$soli['title']?></h2>
      <div class="row">
        <div class="col-md-8 p-3" style="background-color:rgba(0,0,0,0.02);">
          <h3>Los siguientes campos son requeridos</h3>
          <form id="formSoli" >
            <input type="hidden" id="tipoPrestamo" value="<?=$soli['tipo']?>" />
            <?php

            $form = $soli['formulario'];
            foreach ($form as $value) {
            ?>
            <div class="form-group mb-2">
              <label><?=$value['label']?></label>
              <input type="<?=$value['input']?>" class="form-control" id="<?=$value['id']?>" placeholder="<?=$value['placeholder']?>" required>
            </div>
            <?php
            }
            if($soli['garante'] == 'SI'){
            ?>
            <hr>
            <h3>Este préstamo necesita dos garantes <b>(asociados en C.A.S. R.L.)</b></h3>
            <b>* GARANTE 1</b>
            <div class="row mb-3">
              <label for="">Carnet de identidad (solo números)</label>
              <div class="input-group flex-nowrap input-group-lg">
                <span class="input-group-text"><i class="fas fa-circle-user"></i></span>
                <input id="cig1" type="text" data-id="0" class="form-control cig" placeholder="Nro. C.I." required />
                <div class="invalid-feedback">
                  No se encontró ningun asociado con ese carnet.
                </div>
              </div>
            </div>
            <br>
            <hr>

            <b>* GARANTE 2</b>
            <div class="row mb-3">
              <label for="">Carnet de identidad (solo números)</label>
              <div class="input-group flex-nowrap input-group-lg">
                <span class="input-group-text"><i class="fas fa-circle-user"></i></span>
                <input id="cig2" type="text" data-id="0" class="form-control cig" placeholder="Nro. C.I." required />
                <div class="invalid-feedback">
                  No se encontró ningun asociado con ese carnet.
                </div>
              </div>
            </div>
            <?php
            }?>
            <div style="float:right" class="mt-2">
              <button class="btn btn-secondary" type="buttom" onclick="history.back()">Cancelar</button>
              <button class="btn btn-primary ml-2" type="submit" >Enviar</button>
            </div>
          </form>
        </div>
        <div class="col-md-4 p-3">
          <h3>Requisitos físicos</h3>
          <ol type="a">
            <?php
            $req = $soli['requisitos'];
            foreach($req as $r){
            ?>
            <li><?=$r?></li>  
            <?php
            }
            ?>
          </ol>
          <hr>
          <span>Todos estos documentos deben ser presentados en fólder amarillo.</span>
        </div>
      </div>
    </div>

  </section>
  <br> <br><br>
  <?php include('../common/footer.php'); ?>
  <script src="./js/app.js"></script>
</body>

</html>