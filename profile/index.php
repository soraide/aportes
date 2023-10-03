<?php
session_start();
$img="";
$nombre="";
$sobremi="";
$dataUser = array();
if(isset($_SESSION['idSocio'])){
	$img = file_exists('../images/users/'.$_SESSION['idSocio'].'.jpg') ? '../images/users/'.$_SESSION['idSocio'].'.jpg': '../images/users/default.jpg';
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
	<link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="./style.css">
	<script class="u-script" type="text/javascript" src="../static/js/nicepage.js" defer=""></script>
	<link href="../static/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="../static/js/bootstrap.min.js"></script>
	<!-- MDB -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />

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
					<img id="imagen" src="<?php echo $img; ?>"
						alt="user-image" />
					<form>
						<div class="file btn btn-lg btn-primary">
							Cambiar Foto
							<input type="file" name="file" id="perfil" accept="image/*" onchange="leerImagen()"/>
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-10">
				<div class="row">
					<div class="col-lg-12 mb-4">
						<div class="h3" style="font-weight: bold">
							Mi Perfil
						</div>
					</div>
					<div class="col-lg-6 mb-4">
						<div class="card">
							<div class="card-header">
								<b>Datos Personales</b>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-sm table-hover table-striped">
										<tbody>
											<tr>
												<td><b>Nombre:</b></td>
												<td><?=$dataUser['nombres'].' '.$dataUser['paterno'].' '.$dataUser['materno']?></td>
											</tr>
											<tr>
												<td><b>C.I.:</b></td>
												<td><?=$dataUser['ci'].' '.$dataUser['expedido']?></td>
											</tr>
											<tr>
												<td><b>Fecha de Nacimiento:</b></td>
												<?php $fecha = new DateTime($dataUser['fechaNac']);?>
												<td><?=$fecha->format('d-m-Y')?></td>
											</tr>
											<tr>
												<td><b>Estado Civil:</b></td>
												<td><?=$dataUser['estadoCivil']?></td>
											</tr>
											<tr>
												<td><b>Celular:</b></td>
												<td><?=$dataUser['celular']?></td>
											</tr>
											<tr>
												<td><b>Correo Electrónico:</b></td>
												<td><?=$dataUser['correoElec']?></td>
											</tr>
											<tr>
												<td><b>Ciudad Actual:</b></td>
												<td><?=$dataUser['ciudad']?></td>
											</tr>
											<tr>
												<td><b>Dirección:</b></td>
												<td><?=$dataUser['zona'].', '.$dataUser['avenida'].', ',$dataUser['nroDir'] ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 mb-4">
						<div class="card">
							<div class="card-header">
								<b>Datos Armada Boliviana</b>
							</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table table-sm table-hover table-striped">
										<tbody>
											<tr>
												<td><b>Número de T.I.N.:</b></td>
												<td><?=$dataUser['numeroTin']?></td>
											</tr>
											<tr>
												<td><b>Grado:</b></td>
												<td><?=$dataUser['grado']?></td>
											</tr>
											<tr>
												<td><b>Profesión:</b></td>
												<td><?=$dataUser['profesion']?></td>
											</tr>
											<tr>
												<td><b>Año de Promoción:</b></td>
												<td><?=$dataUser['promocion']?></td>
											</tr>
											<tr>
												<td><b>Fecha de Ingreso:</b></td>
												<?php $fecha = new DateTime($dataUser['fechaIncorporacion']);?>
												<td><?=$fecha->format('d-m-Y')?></td>
											</tr>
											<tr>
												<td><b>Código Boleta:</b></td>
												<td><?=$dataUser['codBoleta']?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include('../common/footer.php'); ?>
	<script src="../static/js/sweetalert2.min.js"></script>
	<script src="./js/profile.js"></script>
</body>

</html>