<?php
include("../verify/verify.php");
$text_movil = "";
if ($device) {
  $text_movil = 'data-widget="pushmenu"';
}
$t = time();
$id_personita=$_SESSION['idUsuario'];
if (file_exists("../images/icono.jpg")) {
  $url_imagen = "../images/icono.jpg?r=" . $t;
} else {
  $url_imagen = "../../images/empty.jpg";
}
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>

  </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-warning elevation-4">
  <!-- Brand Logo -->
  <a href="" class="brand-link">
    <img src="<?php echo $url_imagen; ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">STELLA <i>MARIS</i></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
         <img src="../../images/empty.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?= isset($userData['nombres']) ? $userData['nombres'] : '' ?></a>
      </div>
    </div>
   <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="#espera" onclick="listarSociosEspera()" <?php echo $text_movil ?> id="nav_socios_espera" class="nav-link">
          <i class="nav-icon fas fa-solid fa-question"></i>
            <p>
              Ver socios espera
            </p>
          </a>
        </li> 

        <li class="nav-item">
          <a href="#socios" onclick="listarSocios()" <?php echo $text_movil ?> id="nav_socios" class="nav-link">
          <i class="nav-icon fas fa-eye"></i>
            <p>
              Ver Socios
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#sociosbajas" onclick="listarSociosBaja()" <?php echo $text_movil ?> id="nav_socios_baja" class="nav-link">
          <i class="nav-icon fas fa-external-link-alt"></i>            
          <p>
              Ver Socios dados de Baja
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#gestiones" onclick="listarGestiones()" <?php echo $text_movil ?> id="nav_gestiones" class="nav-link">
          <i class="nav-icon fas fa-pen"></i>
            <p>
              Gestiones
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#subirAportes" onclick="subirAportes()" <?php echo $text_movil ?> id="nav_subir_aportes" class="nav-link">
          <i class="nav-icon fas fa-upload"></i>
            <p>
              Subir excel aportes
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="../login/logout.php" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Cerrar sesión
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>


