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
  <link href="../static/css/multi-steps.css" rel="stylesheet" />
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
  <!-- Multi step form --> 
  <section class="">
    <div class="container">
      <div class="card">
        <div class="card-header mt-5">
          <div class="wizard">
            <div class="wizard-inner">
              <div class="connecting-line"></div>
              <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active">
                      <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab">1 </span> <i>Step 1</i></a>
                  </li>
                  <li role="presentation" class="disabled">
                      <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab">2</span> <i>Step 2</i></a>
                  </li>
                  <li role="presentation" class="disabled">
                      <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"><span class="round-tab">3</span> <i>Step 3</i></a>
                  </li>
                  <li role="presentation" class="disabled">
                      <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab"><span class="round-tab">4</span> <i>Step 4</i></a>
                  </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row justify-content-center">
              <div class="col-md-8">
                  <div class="wizard">
                          <div class="tab-content" id="main_form">
                              <div class="tab-pane active" role="tabpanel" id="step1">
                                  <h4 class="text-center">Datos Personales</h4>
                                  <div class="row mb-4 mt-4">
                                    <div class="col-md-12">
                                      <div class="form-outline">
                                        <input type="text" class="form-control form-control-lg" name="nombres" required />
                                        <label class="form-label">Nombres</label>
                                      </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                      <div class="form-outline">
                                        <input type="text" class="form-control form-control-lg" name="paterno" required>
                                        <label class="form-label">Ap. Paterno</label>
                                      </div>
                                    </div>
                                    <div class="col-md-6 ps-0 mt-3">
                                      <div class="form-outline">
                                        <input type="text" class="form-control form-control-lg" name="materno" required>
                                        <label class="form-label">Ap. Materno</label>
                                      </div>
                                    </div>
                                    <div class="col-md-9 mt-3">
                                      <div class="form-outline">
                                        <input type="text" class="form-control form-control-lg" name="ci" required />
                                        <label class="form-label">Cédula de Identidad</label>
                                      </div>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                      <div class="form-outline">
                                          <select id="extension_ci" name="expedido" class="form-select form-control-lg" required>
                                            <option value="" title="extensión">Exp</option>
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
                                    <div class="col-md-6 mt-3">
                                      <span style="color:#a0a0a0;text-align:left">Fecha de nacimiento</span>
                                      <div class="input-group input-group-lg flex-nowrap">
                                        <input type="date" class="form-control form-control-lg" name="fechaNac" required/>
                                      </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                      <span style="color:#a0a0a0;text-align:left">Estado Civil</span>
                                      <select id="estado_civil" name="estadoCivil" class="form-select pl-2">
                                        <option value="" disabled selected>- Seleccionar -</option>
                                        <option value="SOLTERO (A)">SOLTERO (A)</option>
                                        <option value="CASADO (A)">CASADO (A)</option>
                                        <option value="VIUDO (A)">VIUDO (A)</option>
                                        <option value="DIVORCIADO (A)">DIVORCIADO (A)</option>
                                      </select>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                      <span class="text-secondary">- Carnet de Identidad (Escaneado PDF)</span>
                                      <div class="input-group">                      
                                        <input type="file" class="form-control filePdf" accept=".pdf" data-filename="ci" required>
                                      </div>
                                    </div>
                                  </div>
                                  <ul class="list-inline pull-right">
                                      <li><button type="button" class="btn btn-primary next-step">Siguiente</button></li>
                                  </ul>
                              </div>
                              <div class="tab-pane" role="tabpanel" id="step2">
                                  <h4 class="text-center">Datos Personales</h4>
                                  <div class="row mb-4 mt-4">
                                    <div class="col-md-12 mt-3">
                                      <div class="form-outline">
                                        <input type="text" name="lugar_nac" class="form-control form-control-lg" required>
                                        <label class="form-label">Lugar de Nacimiento</label>
                                      </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                      <span style="color:#C0C0C0;">Su dirección actual</span>
                                      <div class="form-outline">
                                        <input type="text" class="form-control form-control-lg" name="ciudad">
                                        <label class="form-label">Ciudad</label>
                                      </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                      <div class="form-outline">
                                        <input type="text" class="form-control form-control-lg" name="zona">
                                        <label class="form-label">Zona</label>
                                      </div>
                                    </div>
                                  </div>
                                  <ul class="list-inline pull-right">
                                      <li><button type="button" class="btn btn-outline-primary prev-step">Back</button></li>
                                      <li><button type="button" class="btn btn-primary next-step">Continue</button></li>
                                  </ul>
                              </div>
                              <div class="tab-pane" role="tabpanel" id="step3">
                                  <h4 class="text-center">Step 3</h4>
                                    <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Account Name *</label> 
                                          <input class="form-control" type="text" name="name" placeholder=""> 
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Demo</label> 
                                          <input class="form-control" type="text" name="name" placeholder=""> 
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Inout</label> 
                                          <input class="form-control" type="text" name="name" placeholder=""> 
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Information</label> 
                                          <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="customFile">
                                            <label class="custom-file-label" for="customFile">Select file</label>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Number *</label> 
                                          <input class="form-control" type="text" name="name" placeholder=""> 
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <label>Input Number</label> 
                                          <input class="form-control" type="text" name="name" placeholder=""> 
                                      </div>
                                  </div>
                                      </div>
                                  <ul class="list-inline pull-right">
                                      <li><button type="button" class="default-btn prev-step">Back</button></li>
                                      <li><button type="button" class="default-btn next-step skip-btn">Skip</button></li>
                                      <li><button type="button" class="default-btn next-step">Continue</button></li>
                                  </ul>
                              </div>
                              <div class="tab-pane" role="tabpanel" id="step4">
                                  <h4 class="text-center">Step 4</h4>
                                  <div class="all-info-container">
                                      <div class="list-content">
                                          <a href="#listone" data-toggle="collapse" aria-expanded="false" aria-controls="listone">Collapse 1 <i class="fa fa-chevron-down"></i></a>
                                          <div class="collapse" id="listone">
                                              <div class="list-box">
                                                  <div class="row">
                                                      
                                                      <div class="col-md-6">
                                                          <div class="form-group">
                                                              <label>First and Last Name *</label> 
                                                              <input class="form-control" type="text"  name="name" placeholder="" disabled="disabled"> 
                                                          </div>
                                                      </div>
                                                      
                                                      <div class="col-md-6">
                                                          <div class="form-group">
                                                              <label>Phone Number *</label> 
                                                              <input class="form-control" type="text" name="name" placeholder="" disabled="disabled"> 
                                                          </div>
                                                      </div>
                                                      
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="list-content">
                                          <a href="#listtwo" data-toggle="collapse" aria-expanded="false" aria-controls="listtwo">Collapse 2 <i class="fa fa-chevron-down"></i></a>
                                          <div class="collapse" id="listtwo">
                                              <div class="list-box">
                                                  <div class="row">
                                                      
                                                      <div class="col-md-6">
                                                          <div class="form-group">
                                                              <label>Address 1 *</label> 
                                                              <input class="form-control" type="text" name="name" placeholder="" disabled="disabled"> 
                                                          </div>
                                                      </div>
                                                      
                                                      <div class="col-md-6">
                                                          <div class="form-group">
                                                              <label>City / Town *</label> 
                                                              <input class="form-control" type="text" name="name" placeholder="" disabled="disabled"> 
                                                          </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="form-group">
                                                              <label>Country *</label> 
                                                              <select name="country2" class="form-control" id="country2" disabled="disabled">
                                                                  <option value="NG" selected="selected">Nigeria</option>
                                                                  <option value="NU">Niue</option>
                                                                  <option value="NF">Norfolk Island</option>
                                                                  <option value="KP">North Korea</option>
                                                                  <option value="MP">Northern Mariana Islands</option>
                                                                  <option value="NO">Norway</option>
                                                              </select>
                                                          </div>
                                                      </div>
                                                      
                                                      
                                                      
                                                      <div class="col-md-6">
                                                          <div class="form-group">
                                                              <label>Legal Form</label> 
                                                              <select name="legalform2" class="form-control" id="legalform2" disabled="disabled">
                                                                  <option value="" selected="selected">-Select an Answer-</option>
                                                                  <option value="AG">Limited liability company</option>
                                                                  <option value="GmbH">Public Company</option>
                                                                  <option value="GbR">No minimum capital, unlimited liability of partners, non-busines</option>
                                                              </select> 
                                                          </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="form-group">
                                                              <label>Business Registration No.</label> 
                                                              <input class="form-control" type="text" name="name" placeholder="" disabled="disabled"> 
                                                          </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="form-group">
                                                              <label>Registered</label> 
                                                              <select name="vat2" class="form-control" id="vat2" disabled="disabled">
                                                                  <option value="" selected="selected">-Select an Answer-</option>
                                                                  <option value="yes">Yes</option>
                                                                  <option value="no">No</option>
                                                              </select> 
                                                          </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                          <div class="form-group">
                                                              <label>Seller</label> 
                                                              <input class="form-control" type="text" name="name" placeholder="" disabled="disabled"> 
                                                          </div>
                                                      </div>
                                                      <div class="col-md-12">
                                                          <div class="form-group">
                                                              <label>Company Name *</label> 
                                                              <input class="form-control" type="password" name="name" placeholder="" disabled="disabled"> 
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="list-content">
                                          <a href="#listthree" data-toggle="collapse" aria-expanded="false" aria-controls="listthree">Collapse 3 <i class="fa fa-chevron-down"></i></a>
                                          <div class="collapse" id="listthree">
                                              <div class="list-box">
                                                  <div class="row">
                                                      
                                                      <div class="col-md-6">
                                                          <div class="form-group">
                                                              <label>Name *</label> 
                                                              <input class="form-control" type="text" name="name" placeholder=""> 
                                                          </div>
                                                      </div>
                                                      
                                                      
                                                      <div class="col-md-6">
                                                          <div class="form-group">
                                                              <label>Number *</label> 
                                                              <input class="form-control" type="text" name="name" placeholder=""> 
                                                          </div>
                                                      </div>
                                                      
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  
                                  <ul class="list-inline pull-right">
                                      <li><button type="button" class="default-btn prev-step">Back</button></li>
                                      <li><button type="button" class="default-btn next-step">Finish</button></li>
                                  </ul>
                              </div>
                              <div class="clearfix"></div>
                          </div>
                          
                  </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- End Multi step form -->   
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
                          <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                          <input type="text" class="form-control" placeholder="Tu celular" name="celular" />
                        </div>
                      </div>
                      <div class="row mb-4">
                        <div class="input-group flex-nowrap input-group-lg">
                          <span class="input-group-text"><i class="fas fa-house-user"></i></span>
                          <input type="text" class="form-control" name="avenida" placeholder="Calle/Avenida">
                          <input type="text" class="form-control" name="nroDir" placeholder="Nro. de domicilio">
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
  <script src="./js/app.js"></script>
  <script src="./js/register.js"></script>
  <script src="../static/js/bootstrap.min.js"></script>
</body>

</html>