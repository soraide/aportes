<?php

    $response = array('success' => false, 'message' => "");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        require_once('../../../api/config/database.php');

        if(isset($_POST['idRendimiento']) && isset($_POST['rendimiento'])){

            $idRendimiento = $_POST['idRendimiento'];
            $rendimiento = $_POST['rendimiento'];

            $pdo = connectToDatabase();
            $mensajeError = '';

            $sqlGestiones = "UPDATE tblGestion SET rendimiento = ? WHERE idGestion = ? ;";
            try {
                // Prepara la consulta
                $stmt = $pdo->prepare($sqlGestiones);
                // Ejecuta la consulta
                $stmt->execute([$rendimiento,$idRendimiento]);
                // Respuesta del Servidor
                $response['success'] = true;
                $response['message'] = "Registros guardados con éxito.";
            } catch (PDOException $e) {
                $mensajeError = "Error en la consulta: " . $e->getMessage();
                $response['message'] = $mensajeError;
            }
        }else{
            $response['message'] = 'Los campos idRendimiento y rendimiento son necesarios.';
        }

    }else{
        $response['message'] = 'No method POST.';
    }

    echo json_encode($response);

?>