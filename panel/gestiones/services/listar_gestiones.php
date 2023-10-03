<?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        require_once('../../../api/config/database.php');

        // obtenemos listados para asegurar que no introduzcan datos erroneos
        $listaGestiones = array();

        $pdo = connectToDatabase();
        $mensajeError = '';

        $sqlGestiones = "SELECT * FROM tblRendimiento ORDER BY idRendimiento DESC;";
        try {
            // Prepara la consulta
            $stmt = $pdo->prepare($sqlGestiones);
            // Ejecuta la consulta
            $stmt->execute();
            // Obtiene los resultados como un arreglo asociativo
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            // Procesa los resultados
            foreach ($results as $row) {
                array_push($listaGestiones,$row);
            }
            echo json_encode($listaGestiones);
        } catch (PDOException $e) {
            $mensajeError = "Error en la consulta: " . $e->getMessage();
            echo $mensajeError;
        }

    }else{
        echo 'Acceso no válido.';
    }

?>