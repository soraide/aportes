<?php
session_start();
if(isset($_SESSION['idUsuario']) && intval($_SESSION['idUsuario']) > 0){
  header('Location: ../main-page/');
  die();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">

  <link href="../fontawesome/css/all.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>

<body style="background-image:linear-gradient(0deg, rgba(36, 63, 86, 0.5), rgba(36, 63, 86, 0.5)), url('../../images/background.jpg');background-size: cover"">
  <form class="login">
    <div class="card">
      <div class="card-header text-center">
        <h5 class="card-title m-0 text-primary">PANEL DE CONTROL</h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <label>
              <span class="text-secondary"><i class="fa fa-user"></i> <b>Usuario:</b></span> 
              <input class="form-control mt-2" type="text" placeholder="Usuario" id="user_name" required />
            </label>
          </div>
          <div class="col-md-12">
            <label>
              <span class="text-secondary"><i class="fa fa-lock"></i> <b>Contraseña:</b></span>
              <input class="form-control mt-2" type="password" placeholder="Password" id="password" required />
            </label>
          </div>
        </div>
      </div>
    </div>
    <button type="submit" id="boton-estilo" class="submit"><i class="fa fa-arrow-right"></i></button>
    <div id="mensaje">
    </div>
  </form>
</body>
<script defer src="../fontawesome/js/all.js"></script>
<script src="../fontawesome/js/fontawesome.js"></script>
<script type="text/javascript" charset="utf8" src="../js/jquery-3.3.1.js"></script>
<script src="../js/login.js"></script>
<script src="../js/bootstrap.min.js"></script>

<script>
  function mostrarContrasena() {
    var tipo = document.getElementById("password");
    if (tipo.type == "password") {
      tipo.type = "text";
    } else {
      tipo.type = "password";
    }
  }
</script>

</html>