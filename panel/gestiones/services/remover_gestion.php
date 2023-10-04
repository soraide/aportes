<?php

    $response = array('success' => false, 'message' => "");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        require_once('../../../api/config/database.php');

        if(isset($_POST['idRendimiento'])){

            $idRendimiento = $_POST['idRendimiento'];

            $pdo = connectToDatabase();
            $mensajeError = '';

            $sqlGestiones = "DELETE FROM tblRendimiento WHERE idRendimiento = ? ;";
            try {
                // Prepara la consulta
                $stmt = $pdo->prepare($sqlGestiones);
                // Ejecuta la consulta
                $stmt->execute([$idRendimiento]);
                // Respuesta del Servidor
                $response['success'] = true;
                $response['message'] = "Registros guardados con éxito.";
            } catch (PDOException $e) {
                $mensajeError = "Error en la consulta: " . $e->getMessage();
                $response['message'] = $mensajeError;
            }
        }else{
            $response['message'] = 'Los campos idRendimiento son necesarios.';
        }

    }else{
        $response['message'] = 'No method POST.';
    }

    echo json_encode($response);

?>