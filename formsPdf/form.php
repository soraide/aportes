<?php
include('./classForms.php');
use Forms\FormUtils;
// formulario para prestamo 
if(!isset($_GET['pres'])){
  echo 'Id de prestamo invalido';
}

echo $_GET['pres'];

?>