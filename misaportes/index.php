<?php
	session_start();
	$img="";
	$nombre="";
	$sobremi="";
	$dataUser = array();
	if(isset($_SESSION['idSocio'])){
		$img = file_exists('../images/users/'.$_SESSION['idSocio'].'.jpg') ? '../images/users/'.$_SESSION['idSocio'].'.jpg': '../images/profile-default.png';
		$dataUser = json_decode($_SESSION['usuario'], true);
	}else{
		header("Location: ../auth/");
		die();
	}
	$sobremi = $sobremi == "" ? "Agrega algo sobre tí en el botón de EDITAR PERFIL" : ucfirst($sobremi);
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Mis Aportes</title>
	<script type="text/javascript" src="../static/js/jquery.js"></script>
	<link rel="stylesheet" href="../static/css/nicepage.css" media="screen">
	<link rel="stylesheet" href="../static/css/Inicio.css" media="screen">
	<link rel="stylesheet" href="./style.css">
	<script class="u-script" type="text/javascript" src="../static/js/nicepage.js" defer=""></script>
	<!-- Font Awesome -->
	<link href="../mdb/icons/font-awesome/css/fontawesome-all.min.css" rel="stylesheet" />
	<!-- MDB -->
	<link href="../mdb/css/mdb.min.css" rel="stylesheet" />

	<style>
		div.file{
			cursor:pointer !important;
		}
		div.file input{
			cursor:pointer;			
		}
	</style>
</head>

<body class="u-body u-xl-mode" data-lang="es">
	<?php
		include("../common/header_session.php");
	?>
	<div class="container emp-profile">
		<div class="row">
			<div class="col-md-4">
				<div class="profile-img">
					<img id="imagen" src="<?php echo $img; ?>"
						alt="user-image" />
				</div>
				<div style="text-align:center;font-weight: bold" class="mt-4">
					<?=strtoupper($dataUser['nombre'].' '.$dataUser['paterno'].' '.$dataUser['materno'])?>
					<br>
					<?=$dataUser['ci'].' '.$dataUser['expedido_id']?>
				</div>
			</div>
			<div class="col-md-8">
				<div class="row mb-4">
					<div class="col-lg-6">
						<div class="h3" style="font-weight: bold">
							Mis Aportes
						</div>
					</div>
					<div class="col-lg-6 text-end">
						<a href="../api/reporte/ResumenAportesSocioPDF" target="_blank" class="btn btn-success"><i class="fas fa-file-lines me-2"></i>Resumen</a>
						<a href="../api/reporte/HistorialAportesSocioPDF" target="_blank" class="btn btn-primary"><i class="fas fa-rectangle-list me-2"></i>Historial</a>
					</div>
				</div>
				<div class="row" id="aportes-socio">
					
				</div>
			</div>
		</div>
	</div>
	<?php include('../common/footer.php'); ?>

	<script src="../js/options.js"></script>
	<script src="../js/functions.js"></script>
	<script src="../js/services/aporte.js"></script>

	<script src="../static/js/sweetalert2.min.js"></script>
	<script src="./js/app.js"></script>
	<script src="./js/misaportes.js"></script>
</body>

</html>