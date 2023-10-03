<?php
    session_start();
    $id = $_SESSION['idSocio'];
    include('../connections/conexion.php');

    $celular = "";
    $email = "";
    $sobremi = "";
    if (isset($_POST['sobremi'])) {
        $sobremi = $_POST['sobremi'];
    }
    if (isset($_POST['celular'])) {                        
        $celular = $_POST['celular'];
    }
    if (isset($_POST['email'])) {                        
        $email = $_POST['email'];
    }
    
    $_SESSION['email']=$email;
    $_SESSION['celular']=$celular;
    if($sobremi == ""){
        $array=array($email, $celular, $id);
        $consulta = "UPDATE tblEstudiante SET usuario = ?, celular = ? WHERE idEstudiante = ?";
    }else{
        $array=array($email, $celular, $sobremi, $id);
        $_SESSION['sobremi']=$sobremi;
        $consulta = "UPDATE tblEstudiante SET usuario = ?, celular = ?, acercademi = ? WHERE idEstudiante = ?";
    }
    $ejecutar = sqlsrv_query($con, $consulta, $array);

    if ($ejecutar){

        echo 1;
    }else{
        echo 2;
    }
?>