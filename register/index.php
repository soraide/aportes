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
                      <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true"><span class="round-tab">1 </span> <i>Datos</i></a>
                  </li>
                  <li role="presentation" class="disabled">
                      <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false"><span class="round-tab">2</span> <i>Datos</i></a>
                  </li>
                  <li role="presentation" class="disabled">
                      <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab"><span class="round-tab">3</span> <i>Militar</i></a>
                  </li>
                  <li role="presentation" class="disabled">
                      <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab"><span class="round-tab">4</span> <i>Beneficiario</i></a>
                  </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="card-body">
          <form id="form_register">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="wizard">
                <div class="tab-content">
                  
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
                      <div class="col-md-6 mt-3">
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
                        <div class="">
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
                        <span class="text-info"><i>Fecha de nacimiento</i></span>
                        <div class="input-group input-group-lg flex-nowrap">
                          <input type="date" class="form-control form-control-lg" name="fechaNac" required/>
                        </div>
                      </div>
                      <div class="col-md-6 mt-3">
                        <span class="text-info"><i>Estado Civil</i></span>
                        <select id="estado_civil" name="estadoCivil" class="form-select pl-2 form-control-lg">
                          <option value="" disabled selected>- Seleccionar -</option>
                          <option value="SOLTERO (A)">SOLTERO (A)</option>
                          <option value="CASADO (A)">CASADO (A)</option>
                          <option value="VIUDO (A)">VIUDO (A)</option>
                          <option value="DIVORCIADO (A)">DIVORCIADO (A)</option>
                        </select>
                      </div>
                      <div class="col-md-12 mt-3">
                        <span class="text-info"><i>PDF - Cédula de Identidad</i></span>
                        <div class="input-group">                      
                          <input type="file" class="form-control filePdf" accept=".pdf" data-filename="ci" required>
                        </div>
                      </div>
                    </div>
                    <ul class="list-inline pull-right">
                        <li><button type="button" class="btn btn-success next-step">Siguiente</button></li>
                    </ul>
                  </div>
                  
                  <div class="tab-pane" role="tabpanel" id="step2">
                      <h4 class="text-center">Datos Personales</h4>
                      <div class="row mb-4 mt-4">
                        <div class="col-md-6 mt-3">
                          <div class="form-outline">
                            <input type="text" name="lugar_nac" class="form-control form-control-lg" required>
                            <label class="form-label">Lugar de Nacimiento</label>
                          </div>
                        </div>
                        <div class="col-md-6 mt-3">
                          <div class="form-outline">
                            <input type="text" class="form-control form-control-lg" name="celular" />
                            <label class="form-label">Celular</label>
                          </div>
                        </div>
                        <div class="col-md-12 mt-3">
                          <span><b>Su dirección actual</b></span>
                        </div>
                        <div class="col-md-6 mt-3">
                          <div class="form-outline">
                            <input type="text" class="form-control form-control-lg" name="avenida">
                            <label class="form-label">Calle</label>
                          </div>
                        </div>
                        <div class="col-md-6 mt-3">
                          <div class="form-outline">
                            <input type="text" class="form-control form-control-lg" name="zona">
                            <label class="form-label">Zona</label>
                          </div>
                        </div>
                        <div class="col-md-6 mt-3">
                          <div class="form-outline">
                            <input type="text" class="form-control form-control-lg" name="nroDir">
                            <label class="form-label">Numero</label>
                          </div>
                        </div>
                        <div class="col-md-6 mt-3">
                          <div class="form-outline">
                            <input type="text" class="form-control form-control-lg" name="ciudad">
                            <label class="form-label">Ciudad</label>
                          </div>
                        </div>
                        <div class="col-md-12 mt-3">
                          <span><b>Datos de la Cuenta</b></span>
                        </div>
                        <div class="col-md-6 mt-3">
                          <div class="form-outline">
                            <input type="email" class="form-control form-control-lg" name="correoElec" required />
                            <label class="form-label">Correo Electrónico</label>
                          </div>
                        </div>
                        <div class="col-md-6 mt-3">
                          <div class="form-outline">
                            <input type="password" class="form-control form-control-lg" name="password" id="pass" required />
                            <label class="form-label">Contraseña</label>
                          </div>
                          <span id="verifyPass" style="color:orange;display:none">8 caracteres alfanuméricos</span>
                        </div>
                      </div>
                      <ul class="list-inline pull-right">
                          <li><button type="button" class="btn btn-info prev-step">Regresar</button></li>
                          <li><button type="button" class="btn btn-success next-step">Siguiente</button></li>
                      </ul>
                  </div>
                  
                  <div class="tab-pane" role="tabpanel" id="step3">
                    <h4 class="text-center">Datos Militares</h4>
                    <div class="row mb-4 mt-4">
                      <div class="col-md-6 mt-3">
                        <div class="">
                          <span class="text-info"><i>Grado</i></span>
                          <select name="grado" class="form-select form-control-lg pl-2">
                            <option value=""> Seleccione Grado...</option>
                            <option value="ALMTE.">Almte.</option>
                            <option value="V. ALMTE.">V. Almte.</option>
                            <option value="C. ALMTE.">C. Almte.</option>
                            <option value="CN.">CN.</option>
                            <option value="CF.">CF.</option>
                            <option value="CC.">CC.</option>
                            <option value="TN.">TN.</option>
                            <option value="TF.">TF.</option>
                            <option value="ALF.">Alf.</option>
                            <option value="SOF. MTRE.">Sof. Mtre.</option>
                            <option value="SOF. MY.">Sof. My.</option>
                            <option value="SOF. 1ro.">Sof. 1ro.</option>
                            <option value="SOF. 2do.">Sof. 2do.</option>
                            <option value="SOF. Incl.">Sof. Incl.</option>
                            <option value="SGTO. 1ro.">Sgto. 1ro.</option>
                            <option value="SGTO. 2do.">Sgto. 2do.</option>
                            <option value="SGTO. Incl.">Sgto. Incl.</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-6 mt-3">
                        <span class="text-info"><i>Fecha de Ingreso Armada Boliviana</i></span>
                        <div class="input-group input-group-lg flex-nowrap">
                          <input type="date" class="form-control form-control-lg" name="fechaIncorporacion" required/>
                        </div>
                      </div>
                      <div class="col-md-6 mt-3">
                        <div class="form-outline">
                          <input type="text" class="form-control form-control-lg" name="promocion" required />
                          <label class="form-label">Año de Promoción ENM</label>
                        </div>
                      </div>
                      <div class="col-md-6 mt-3">
                        <div class="form-outline">
                          <input type="text" name="profesion" class="form-control form-control-lg" />
                          <label class="form-label">Profesión</label>
                        </div>
                      </div>
                      <div class="col-md-6 mt-3">
                        <div class="form-outline">
                          <input type="text" class="form-control form-control-lg" name="numeroTin" required />
                          <label class="form-label">Número de T.I.N.</label>
                        </div>
                      </div>
                      <div class="col-md-6 mt-3">
                        <div class="form-outline">
                          <input type="text" class="form-control form-control-lg" name="codBoleta" required />
                          <label class="form-label">Código Boleta</label>
                        </div>
                      </div>
                    </div>
                    <ul class="list-inline pull-right">
                        <li><button type="button" class="btn btn-info prev-step">Regresar</button></li>
                        <li><button type="button" class="btn btn-success next-step">Siguiente</button></li>
                    </ul>
                  </div>
                  
                  <div class="tab-pane" role="tabpanel" id="step4">
                      <h4 class="text-center">Beneficiarios</h4>
                      <div class="row mb-4 mt-4" id="beneficiarios">
                        <div class="col-md-12 mt-3" id="bnf-1">
                          <h5><i class="fas fa-circle-user"></i> Beneficiario 1</h5>
                          <div class="row">
                            <div class="col-md-12 mt-3">
                              <div class="form-outline">
                                <input type="text" class="form-control" name="nombresBen[]" required />
                                <label class="form-label">Nombres</label>
                              </div>
                            </div>
                            <div class="col-md-6 mt-3">
                              <div class="form-outline">
                                <input type="text" class="form-control" name="paternoBen[]" required>
                                <label class="form-label">Ap. Paterno</label>
                              </div>
                            </div>
                            <div class="col-md-6 mt-3">
                              <div class="form-outline">
                                <input type="text" class="form-control" name="maternoBen[]" required>
                                <label class="form-label">Ap. Materno</label>
                              </div>
                            </div>
                            <div class="col-md-6 mt-3">
                              <div class="form-outline">
                                <input type="text" class="form-control" name="parentesco[]" required>
                                <label class="form-label">Parentezco</label>
                              </div>
                            </div>
                            <div class="col-md-6 mt-3">
                              <div class="form-outline">
                                <input type="text" class="form-control" name="ciBen[]" required>
                                <label class="form-label">Cédula de Identidad</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row mt-4 mb-4">
                        <div class="col-md-12">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked />
                            <label class="form-check-label text-muted" for="flexCheckChecked">Al hacer click aquí, (i) estoy
                              de acuerdo con las <a class="text-primary" href="#">políticas</a>
                              para mi afiliación en <a class="text-primary" href="#"> "Stella Maris"</a>.
                            </label>
                            <span id="checkPoliticas" style="color:orange;display:none"></span>
                          </div>
                        </div>
                      </div>
                      <ul class="list-inline pull-right">
                        <li><button type="button" class="btn btn-danger" onclick="removerBeneficiario()">Remover</button></li>
                        <li><button type="button" class="btn btn-primary" onclick="nuevoBeneficiario()">Adicionar</button></li>
                        <li><button type="button" class="btn btn-info prev-step">Regresar</button></li>
                        <li><button class="btn btn-success next-step" type="submit" id="btn-submit">Registrar</button></li>
                      </ul>
                  </div>
                  <div class="clearfix"></div>
                </div> 
              </div>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
  </section>
<!-- End Multi step form -->   
  <!-- MDB -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
  <script type="text/javascript" charset="utf8" src="../static/js/jquery.js"></script>
  <script src="./js/app.js"></script>
  <script src="./js/register.js"></script>
  <script src="../static/js/bootstrap.min.js"></script>
</body>

</html>