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
	<title>Perfil</title>
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
	<div class="container-fluid" style="width:100vw !important;height:85vh !important;">
		<div class="row d-flex align-items-center justify-content-center" style="width:100% !important;height:100% !important;">
			<div class="col-lg-2">
				<div class="profile-img">
					<img id="imagen" src="<?php echo $img; ?>" alt="user-image" />
					<form>
						<div class="file btn btn-lg btn-primary">
							Cambiar Foto
							<input type="file" name="file" id="perfil" accept="image/*" onchange="leerImagen()"/>
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-10 bg-light p-4">
				<div class="row">
					<div class="col-lg-12 mb-4">
						<div class="h3" style="font-weight: bold">
							Mi Perfil
						</div>
					</div>
				</div>
				<div class="row" id="datos-socio">
					
				</div>
			</div>
		</div>
	</div>
	<?php include('../common/footer.php'); ?>

	<script src="../js/options.js"></script>
	<script src="../js/functions.js"></script>
	<script src="../js/services/socio.js"></script>

	<script src="../static/js/sweetalert2.min.js"></script>
	<script src="./js/app.js"></script>
	<script src="./js/profile.js"></script>
</body>

</html>