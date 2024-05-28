<?php 
  session_start();

  if(isset($_SESSION['idSocio'])){
    header("Location: ../main-page");
    die();
  }

  date_default_timezone_set('America/La_Paz');
?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="es" data-mdb-theme="light">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <title>Registrar</title>
  <!-- Font Awesome -->
  <link href="../mdb/icons/font-awesome/css/fontawesome-all.min.css" rel="stylesheet" />
  <!-- MDB -->
  <link href="../mdb/css/mdb.min.css" rel="stylesheet" />
  <link href="../static/css/multi-steps.css" rel="stylesheet" />
  <script src="../static/js/sweetalert2.min.js"></script>
  <style>
    body {
      background-image: linear-gradient(0deg, rgba(36, 63, 86, 0.5), rgba(36, 63, 86, 0.5)), url("../images/background.jpg");
      background-size: cover;
    }
    .register{
      display:flex;
      gap:20px;
    }
    @media (max-width: 720px){
      /* #regisForm{
        width:100%;
      } */
      #logoRegis{
        display: none;
      }
      .register{
        flex-direction: column;
        flex-wrap: wrap;
      }
      .colRegister{
        width: 100%;;
      }
    }
    #swal2-title{
      font-size: 1.9rem;
    }
  </style>
</head>

<body data-lang="es">
  <!-- Multi step form --> 
  <section class="">
    <div class="container">
      <div class="card mt-5">
        <div class="card-header mt-5">
          <h1 class="text-center text-primary pb-4 mb-5">Círculo de Oficiales Navales "STELLA MARIS"</h1>
          <div class="wizard">
            <div class="wizard-inner">
              <div class="connecting-line"></div>
              <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active">
                      <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab"><span class="round-tab">1 </span> <i>Datos Personales</i></a>
                  </li>
                  <li role="presentation" class="disabled">
                      <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab"><span class="round-tab">2</span> <i>Datos Localización - Cuenta</i></a>
                  </li>
                  <li role="presentation" class="disabled">
                      <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"><span class="round-tab">3</span> <i>Datos Militares</i></a>
                  </li>
                  <li role="presentation" class="disabled">
                      <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab"><span class="round-tab">4</span> <i>Datos Beneficiario</i></a>
                  </li>
              </ul>
          </div>
        </div>
        <div class="card-body">
          <!--<form id="form_register">-->
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="wizard">
                <div class="tab-content">
                  
                  <?php

                    include('components/form_datos_personales.php');
                    include('components/form_datos_ubicacion.php');
                    include('components/form_datos_militares.php');
                    include('components/form_datos_beneficiarios.php');

                  ?>

                  <div class="clearfix"></div>

                </div> 
              </div>
            </div>
          </div>
          <!--</form>-->
        </div>
      </div>
    </div>
  </section>
<!-- End Multi step form -->   
  <!-- MDB -->
  <script type="text/javascript" charset="utf8" src="../static/js/jquery.js"></script>

  <script src="../js/data.js"></script>
  <script src="../js/options.js"></script>
  <script src="../js/forms.js"></script>
  <script src="../js/functions.js"></script>
  <script src="../js/services/grado.js"></script>
  <script src="../js/services/expedicion.js"></script>
  <script src="../js/services/parentesco.js"></script>
  <script src="../js/services/estado-civil.js"></script>
  <script src="../js/services/socio.js"></script>

  <script src="./js/app.js"></script>
  <script src="./js/register.js"></script>
  <script src="../static/js/bootstrap.min.js"></script>
</body>

</html>