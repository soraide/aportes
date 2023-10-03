<?php
if(isset($_GET['token'])){
  file_put_contents('datos.txt', $_GET['token']);  
}
header("Location: http://localhost/escueladenegocios/cursos/");

?>