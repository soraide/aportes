<?php

    $response = array('success' => false, 'message' => "");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        require_once('../../../api/config/database.php');

        if(isset($_POST['gestion']) && isset($_POST['rendimiento'])){

            $gestion = $_POST['gestion'];
            $rendimiento = $_POST['rendimiento'];

            $pdo = connectToDatabase();
            $mensajeError = '';

            $sqlGestiones = "INSERT INTO tblRendimiento (gestion,rendimiento) VALUES ( ? , ? );";
            try {
                // Prepara la consulta
                $stmt = $pdo->prepare($sqlGestiones);
                // Ejecuta la consulta
                $stmt->execute([$gestion,$rendimiento]);
                // Respuesta del Servidor
                $response['success'] = true;
                $response['message'] = "Registros guardados con éxito.";
            } catch (PDOException $e) {
                $mensajeError = "Error en la consulta: " . $e->getMessage();
                $response['message'] = $mensajeError;
            }
        }else{
            $response['message'] = 'Los campos gestión y rendimiento son necesarios.';
        }

    }else{
        $response['message'] = 'No method POST.';
    }

    echo json_encode($response);

?>