<?php
$controllers = ['socio', 'user', 'prestamo','aporte'];
foreach ($controllers as $controller) {
  require_once("controllers/$controller.php");
}
?>