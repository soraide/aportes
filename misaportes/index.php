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
	<meta name="keywords" content="​Happiness &amp;amp; Mindfulness Courses, Welcome Message, Benefits of working with us​, 01, 02, 03, 04, 05, 06, ​How Coaching Works, ​How and where to learn mindfulness, Meet The Team
Our Professionals, ​Start using Our App for free">
	<title>Mis Aportes</title>
	<script type="text/javascript" src="../static/js/jquery.js"></script>
	<link rel="stylesheet" href="../static/css/nicepage.css" media="screen">
	<link rel="stylesheet" href="../static/css/Inicio.css" media="screen">
	<link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
	<link rel="stylesheet" href="./style.css">
	<script class="u-script" type="text/javascript" src="../static/js/nicepage.js" defer=""></script>
	<link href="../static/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="../static/js/bootstrap.min.js"></script>
	<!-- Font Awesome -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
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
	<div class="container emp-profile">
		<div class="row">
			<div class="col-md-4">
				<div class="profile-img">
					<img id="imagen" src="<?php echo $img; ?>"
						alt="user-image" />
				</div>
				<div style="text-align:center;font-weight: bold" class="mt-4">
					<?=$dataUser['nombres'].' '.$dataUser['paterno'].' '.$dataUser['materno']?>
					<br>
					<?=$dataUser['ci'].' '.$dataUser['expedido']?>
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
						<a href="../api/aporte/ContributionSummaryPDF" target="_blank" class="btn btn-success"><i class="fas fa-file-lines me-2"></i>Resumen</a>
						<a href="../api/aporte/ContributionHistoryPDF" target="_blank" class="btn btn-primary"><i class="fas fa-rectangle-list me-2"></i>Historial</a>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive" style="max-height:600px;">
							<table class="table table-sm">
								<thead>
									<tr align="center">
										<th scope="col">#</th>
										<th scope="col">Monto</th>
										<th scope="col">Mes</th>
										<th scope="col">Gestión</th>
										<th scope="col">Observación</th>
									</tr>
								</thead>
								<tbody id="tbody">
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-lg-12">
						<b>TOTAL APORTES: </b><span id="total-aportes"></span> Bs.
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include('../common/footer.php'); ?>
	<script src="../static/js/sweetalert2.min.js"></script>
	<script src="./js/misaportes.js"></script>
</body>

</html>