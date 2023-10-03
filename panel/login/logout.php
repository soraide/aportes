
<?php
session_start();
unset($_SESSION['idUsuario']); unset($_SESSION['nombres']); unset($_SESSION['usuario']); unset($_SESSION['rol']); 
header('Location: index.php');
?>
