<?php
session_start();
$id = $_SESSION['idSocio'];
// Obtener el archivo de imagen subido

$imagen = $_FILES['imagen'];

// Cambiar la extensión a .jpg
$nombre_archivo = $id . '.jpg';

// Mover el archivo subido al directorio deseado
if(move_uploaded_file($imagen['tmp_name'], '../images/users/' . $nombre_archivo)) {
  echo 1;
} else {
  echo -1;
  // Ocurrió un error al mover el archivo, manejar el error aquí
}

?>