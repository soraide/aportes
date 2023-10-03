<?php
session_start();
if(isset($_SESSION['idSocio'])){
    echo 1;
}else{
    echo -1;
}
?>