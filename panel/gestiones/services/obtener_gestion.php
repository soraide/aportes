<?php

    $response = array('success' => false, 'message' => "");

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        require_once('../../../api/config/database.php');
        if(isset($_GET['idRendimiento'])){
            // obtenemos listados para asegurar que no introduzcan datos erroneos
            $listaGestiones = array();

            $pdo = connectToDatabase();
            $mensajeError = '';

            $idRendimiento = $_GET['idRendimiento'];

            $sql = "SELECT * FROM tblGestion WHERE idGestion = ? ;";

            try {
                // Prepara la consulta
                $stmt = $pdo->prepare($sql);
                // Ejecuta la consulta
                $stmt->execute([$idRendimiento]);
                // Obtiene los resultados como un arreglo asociativo
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // Procesa los resultados
                foreach ($results as $row) {
                    $response['data'] = $row;
                }
                // Procesa los resultados
                $response['success'] = true;
                $response['message'] = "Consulta realizada con éxito.";
            } catch (PDOException $e) {
                $mensajeError = "Error en la consulta: " . $e->getMessage();
                $response['message'] = $mensajeError;
            }
        }else{
            $response['message'] = "El campo idRendimiento es necesario.";
        }
    }else{
        $response['message'] = "No method GET.";
    }

    echo json_encode($response);

?>