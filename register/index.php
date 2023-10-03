<?php 
session_start();

if(isset($_SESSION['idSocio'])){
  header("Location: ../main-page");
  die();
}
?>
<!DOCTYPE html>
<html style="font-size: 16px;" lang="es">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="description" content="">
  <title>Registrar</title>

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
  <meta property="og:type" content="website">
  <meta data-intl-tel-input-cdn-path="intlTelInput/">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
  <script src="../static/js/sweetalert2.min.js"></script>
  <style>
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

<body data-lang="es" style="background-image:linear-gradient(0deg, rgba(36, 63, 86, 0.5), rgba(36, 63, 86, 0.5)), url('../images/background.jpg');background-size: cover">
  <div class="container mt-4 mb-4">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="text-light text-center">Círculo de Oficiales Navales "STELLA MARIS"</h1>
      </div>
    </div>
  </div>
  <section
    class="skrollable skrollable-between u-align-center u-clearfix u-container-align-center u-image u-shading u-section-2"
    id="carousel_e141" src="" data-image-width="1620" data-image-height="1080">
    <div class="u-clearfix u-sheet u-valign-middle u-sheet-1">
      <form id="form_register">
        <div class="container-fluid">
          <div class="row">
              <div class="col-lg-4 colRegister">
                <div class="card">
                  <div class="card-header text-start">
                    <h3 class="card-title text-dark align-left mt-2"><i class="fas fa-table"></i> <b>Registrarse</b></h3>
                  </div>
                  <div class="card-body">
                    <div class="container">
                      <div class="row mb-4">
                        <div class="input-group flex-nowrap input-group-lg">
                          <span class="input-group-text"><i class="fas fa-circle-user"></i></span>
                          <input type="text" class="form-control" name="paterno" placeholder="Ap. Paterno" required>
                          <input type="text" class="form-control" name="materno" placeholder="Ap. Materno" required>
                        </div>
                      </div>
                      <div class="row mb-4">
                        <div class="input-group flex-nowrap input-group-lg">
                          <span class="input-group-text"><i class="fas fa-circle-user"></i></span>
                          <input type="text" class="form-control" placeholder="Nombres" name="nombres" required />
                        </div>
                      </div>
                      <div class="row mb-4">
                        <div class="input-group flex-nowrap input-group-lg">
                          <span class="input-group-text"><i class="fas fa-regular fa-id-card"></i></span>
                          <input type="text" class="form-control" placeholder="Carnet de identidad" name="ci" required />
                          <div class="input-group-text p-0" style="width:70px;">
                            <select id="extension_ci" title="Extendido en..." name="expedido" class="form-select px-1" required style="border:none">
                              <option value="" title="extensión">S/E</option>
                              <option value="LP">LP</option>
                              <option value="OR">OR</option>
                              <option value="PT">PT</option>
                              <option value="CB">CB</option>
                              <option value="SC">SC</option>
                              <option value="BN">BN</option>
                              <option value="PA">PA</option>
                              <option value="TJ">TJ</option>
                              <option value="CH">CH</option>
                            </select>
                          </div>  
                        </div>
                      </div>
                      <div class="row mb-4">
                        <span style="color:#a0a0a0;text-align:left">Fecha de nacimiento</span>
                        <div class="input-group flex-nowrap input-group-lg">
                          <span class="input-group-text"><i class="fas fa-regular fa-calendar"></i></span>
                          <input type="date" class="form-control" placeholder="Fecha de nacimiento" name="fechaNac" required/>
                        </div>
                      </div>
                      <div class="row mb-4">
                        <div class="input-group flex-nowrap input-group-lg">
                          <span class="input-group-text"><i class="fas fa-globe"></i></span>
                          <input type="text" name="lugar_nac" class="form-control" placeholder="Lugar de nacimiento">
                        </div>
                      </div>
                      <div class="row mb-4">
                        <div class="input-group flex-nowrap input-group-lg">
                          <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                          <input type="text" class="form-control" placeholder="Tu celular" name="celular" />
                        </div>
                      </div>
                      <div class="row mb-4">
                        <span style="color:#C0C0C0;">Su dirección actual</span>
                        <div class="input-group flex-nowrap input-group-lg">
                          <span class="input-group-text"><i class="fas fa-house-user"></i></span>
                          <input type="text" class="form-control" name="ciudad" placeholder="Ciudad">
                          <input type="text" class="form-control" name="zona" placeholder="Zona">
                        </div>
                      </div>
                      <div class="row mb-4">
                        <div class="input-group flex-nowrap input-group-lg">
                          <span class="input-group-text"><i class="fas fa-house-user"></i></span>
                          <input type="text" class="form-control" name="avenida" placeholder="Calle/Avenida">
                          <input type="text" class="form-control" name="nroDir" placeholder="Nro. de domicilio">
                        </div>
                      </div>
                      <div class="row">
                        <span style="color:#8c95cc;text-align:left">- Carnet de Identidad (Escaneado PDF)</span>
                        <div class="input-group">                      
                          <input type="file" class="form-control filePdf" accept=".pdf" data-filename="ci" required>
                        </div>
                      </div>
                    </div>  
                  </div>
                </div>
              </div>

              <div class="col-lg-4 colRegister">
                <div class="card">
                  <div class="card-header text-start">
                    <h3 class="card-title text-dark align-left mt-2"><i class="fas fa-table"></i> <b>Datos</b></h3>
                  </div>
                  <div class="card-body">
                    <div class="container">
                      <div class="row mb-4">
                        <div class="input-group flex-nowrap input-group-lg">
                          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                          <input type="email" class="form-control" placeholder="Tu correo electrónico" name="correoElec" required />
                        </div>
                      </div>
                      <div class="row mb-4">
                        <div class="input-group flex-nowrap input-group-lg">
                          <span class="input-group-text"><i class="fas fa-ring"></i></span>
                          <select id="estado_civil" name="estadoCivil" class="form-select pl-2">
                            <option value=""> Estado civil</option>
                            <option value="SOLTERO (A)">SOLTERO (A)</option>
                            <option value="CASADO (A)">CASADO (A)</option>
                            <option value="VIUDO (A)">VIUDO (A)</option>
                            <option value="DIVORCIADO (A)">DIVORCIADO (A)</option>
                          </select>
                        </div>
                      </div>
                      <div class="row mb-4">
                        <div class="input-group flex-nowrap input-group-lg">
                          <span class="input-group-text"><i class="fa fa-solid fa-bolt-lightning"></i></span>
                          <select name="grado" class="form-select pl-2">
                            <option value=""> Seleccione Grado...</option>
                            <option value="GRAL. FZA.">Gral. Fza. (Almte.)</option>
                            <option value="GRAL. DIV.">Gral. Div. (V. Almte.)</option>
                            <option value="GRAL. BRIG.">Gral. Brig. (C. Almte.)</option>
                            <option value="CNL.">Cnl. (CN.)</option>
                            <option value="TCNL.">Tcnl. (CF.)</option>
                            <option value="MY.">My. (CC.)</option>
                            <option value="CAP.">Cap. (TN.)</option>
                            <option value="TTE.">Tte. (TF.)</option>
                            <option value="SBTTE.">Sbtte. (Alf.)</option>
                            <option value="SOF. MTRE.">Sof. Mtre.</option>
                            <option value="SOF. MY.">Sof. My.</option>
                            <option value="SOF. 1ro.">Sof. 1ro.</option>
                            <option value="SOF. 2do.">Sof. 2do.</option>
                            <option value="SOF. Incl.">Sof. Incl.</option>
                            <option value="SGTO. 1ro.">Sgto. 1ro.</option>
                            <option value="SGTO. 2do.">Sgto. 2do.</option>
                            <option value="SGTO. Incl.">Sgto. Incl.</option>
                          </select>
                        </div>
                      </div>
                      <div class="row mb-4">
                        <div class="input-group flex-nowrap input-group-lg">
                          <span class="input-group-text"><i class="fa fa-solid fa-shield"></i></span>
                          <input type="text" name="profesion" class="form-control" placeholder="Profesion" />
                        </div>
                      </div>
                      <div class="row mb-4">
                        <span style="color:#a0a0a0;text-align:left">Fecha de ingreso Armada Boliviana</span>
                        <div class="input-group flex-nowrap input-group-lg">
                          <span class="input-group-text"><i class="fas fa-regular fa-calendar"></i></span>
                          <input type="date" class="form-control" name="fechaIncorporacion" required/>
                        </div>
                      </div>
                      <div class="row mb-4">
                        <span style="color:#a0a0a0;text-align:left">Año de promoción ENM</span>
                        <div class="input-group flex-nowrap input-group-lg">
                          <span class="input-group-text"><i class="fa fa-solid fa-id-card-clip"></i></span>
                          <input type="text" class="form-control" name="promocion" placeholder="Año" required />
                        </div>
                      </div>
                      <div class="row mb-4">
                        <div class="input-group flex-nowrap input-group-lg">
                          <span class="input-group-text"><i class="fa fa-solid fa-id-card-clip"></i></span>
                          <input type="text" class="form-control" name="numeroTin" placeholder="Número de T.I.N." required />
                        </div>
                      </div>
                    
                      <div class="row mb-4">
                        <span style="color:#a0a0a0;text-align:left">Código boleta de haberes</span>
                        <div class="input-group flex-nowrap input-group-lg">
                          <span class="input-group-text"><i class="fa fa-solid fa-ticket"></i></span>
                          <input type="text" class="form-control" name="codBoleta" placeholder="Código Boleta" required />
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-group flex-nowrap input-group-lg">
                          <span class="input-group-text"><i class="fas fa-key"></i></span>
                          <input type="password" class="form-control" name="password" placeholder="Tu contraseña" id="pass" required />
                        </div>
                        <span id="verifyPass" style="color:orange;display:none">8 caracteres alfanuméricos</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="col-lg-4 colRegister">
                <div class="card">
                  <div class="card-header text-start">
                    <h3 class="card-title text-dark align-left mt-2"><i class="fas fa-users"></i> <b>Beneficiarios</b></h3>
                  </div>
                  <div class="card-body">
                    <div class="container">
                      <div id="beneficiarios">
                        <h5>Beneficiario 1</h5>
                        <div class="row mb-1">
                          <div class="input-group flex-nowrap input-group-lg">
                            <span class="input-group-text"><i class="fas fa-circle-user"></i></span>
                            <input type="text" class="form-control" name="paternoBen[]" placeholder="Ap. Paterno" required>
                            <input type="text" class="form-control" name="maternoBen[]" placeholder="Ap. Materno" required>
                          </div>
                        </div>
                        <div class="row mb-1">
                          <div class="input-group flex-nowrap input-group-lg">
                            <span class="input-group-text"><i class="fas fa-circle-user"></i></span>
                            <input type="text" class="form-control" placeholder="Nombres" name="nombresBen[]" required />
                          </div>
                        </div>
                        <div class="row mb-4">
                          <span style="color:#a0a0a0;text-align:left">Parentesco y CI</span>
                          <div class="input-group flex-nowrap input-group-lg">
                            <input type="text" class="form-control" name="parentesco[]" placeholder="Parentesco" required>
                            <input type="text" class="form-control" name="ciBen[]" placeholder="3412122 LP" required>
                          </div>
                        </div>
                        <hr>
                        
                      </div>
                      <div class="row">
                        <button type="button" class="btn btn-primary mt-1" style="float:right" onclick="nuevoBeneficiario()">Nuevo Beneficiario</button>
                      </div>
                      <hr>
                      <!-- Checked checkbox -->
                      <div class="form-check text-start">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked />
                        <label class="form-check-label text-muted" for="flexCheckChecked">Al hacer click aquí, (i) estoy
                          de acuerdo con las <a class="text-primary" href="#">políticas</a>
                          para mi afiliación en <a class="text-primary" href="#"> "Stella Maris"</a>.
                        </label>
                        <span id="checkPoliticas" style="color:orange;display:none"></span>
                      </div>
                    </div>
                    <a href="../home/" class="mt-4 btn btn-lg btn-rounded btn-danger text-light"><i
                        class="fas fa-xmark"></i> <b>Cancelar</b></a>
                    <button type="submit" id="btn-submit" class="btn btn-lg btn-rounded btn-success text-light"><i
                        class="fas fa-user-plus"></i> <b>Registrar</b></button>
                    <div id="mensaje" style="background-color: rgba(15,15,15,0.2);"></div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </form>
    </div>
  </section>
  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
  <script type="text/javascript" charset="utf8" src="../static/js/jquery.js"></script>
  <script src="./js/register.js"></script>
  <script src="../static/js/bootstrap.min.js"></script>
</body>

</html>