<?php

    $response = array( 'status' => false, 'message' => "" );

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        require_once('../../api/config/database.php');
        require '../phpSpreadsheet/vendor/autoload.php'; // para analizar el excel

        if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
            $fechaInput = $_POST['fecha'];
            $fechaInputVector = explode('-', $fechaInput); // [0] = anio , [1] = mes
            $gestionAporte = $fechaInputVector[0];
            $mesAporte = $fechaInputVector[1];
            // Verificar registro anterior de mes y gestion de aportes
            if(verificarRegistroAnterior($mesAporte,$gestionAporte)){
                $respuesta = array(
                    "status" => false,
                    "mensaje" => 'Los aportes del mes y la gestion ya fueron registrados.'
                );
                echo json_encode($respuesta);
                die();
            }
            $numeroColumnasEstablecido = 8; //numero de columnas que debe tetner el excel
            $nombreArchivo = $_FILES['archivo']['name']; //nombre del excel
            $rutaTemporal = $_FILES['archivo']['tmp_name']; // ruta temporal del excel
            // obtenemos listados para asegurar que no introduzcan datos erroneos
            $listaSocio = array();

            $pdo = connectToDatabase();
            $mensajeError = '';

            $sqlSocio = "SELECT idSocio, numeroTin as codigo FROM tblsocio;";
            try {
                // Prepara la consulta
                $stmt = $pdo->prepare($sqlSocio);
                // Ejecuta la consulta
                $stmt->execute();
                // Obtiene los resultados como un arreglo asociativo
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                // Procesa los resultados
                foreach ($results as $row) {
                    $listaSocio[$row['idSocio']] = $row['codigo'];
                }
            } catch (PDOException $e) {
                $mensajeError = "Error en la consulta: " . $e->getMessage();
                echo $mensajeError;
            }
            // =====================
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($rutaTemporal);
            // Obtener la primera hoja del libro
            $hoja = $spreadsheet->getActiveSheet();
            // Obtener el rango de columnas como un array
            $columnasArray = $hoja->rangeToArray('A1:' . $hoja->getHighestColumn() . '1', null, true, false)[0];
            // Contar el número de columnas en el array
            $numeroColumnas = count($columnasArray);

            // Obtener los valores de la columna en un array
            $columnaSocio = [];
            foreach ($hoja->getColumnIterator('B') as $columna) {
                //foreach ($columna->getCellIterator(3) as $celda) {
                foreach ($columna->getCellIterator(2) as $celda) {
                    if ($celda->getRow() > 2) { // Excluir la primera fila
                        $posicion = 'B' . $celda->getRow();
                        $columnaSocio[$posicion] = trim($celda->getValue());
                    }
                }
                break;
            }

            $listaCeldasError = array();
            // para la comparacion de arrays
            $existeSocio = true;
            foreach ($columnaSocio as $key => $value) {
                if (!in_array($value, $listaSocio)) {
                    $existeSocio = false;
                    $listaCeldasError[] = $key;
                }
            }

            //if ($numeroColumnasEstablecido == $numeroColumnas && $existeSocio) {
            if ($existeSocio) {
                // echo "El número de columnas de la hoja activa es: {$numeroColumnas}";
                $valoresFilas = [];

                foreach ($hoja->getRowIterator(2) as $fila) { // Comenzamos desde la fila 2 para omitir los encabezados
                    $valoresFila = [];
                    $celdas = $fila->getCellIterator();

                    foreach ($celdas as $celda) {
                        $valoresFila[] = $celda->getValue();
                    }

                    $idSocio = array_search(trim($valoresFila[1]), $listaSocio);
                    $valoresFila[1] = $idSocio;

                    $valoresFilas[] = $valoresFila;
                }
                // echo '<br><br>';
                // print_r($valoresFilas); // Imprime los valores de todas las filas (excepto la primera) en un array
                $estado = true;
                $mensaje = "¡Se guardaron los aportes con éxito!";
                foreach ($valoresFilas as $key => $value) {
                    // print_r($value);
                    $sqlInsert = "INSERT INTO tblAporte (idSocio, monto, mes, gestion, observacion) VALUES ('$value[1]', '$value[7]', '$mesAporte', '$gestionAporte', 'Registro regular');";
                    // echo $sqlInsert;
                    try {
                        // Prepara la consulta
                        $stmt = $pdo->prepare($sqlInsert);
                        // Ejecuta la consulta
                        $stmt->execute();
                    } catch (PDOException $e) {
                        echo "Error en la consulta: " . $e->getMessage();
                    }
                }
                $respuesta = array(
                    "status" => $estado,
                    "mensaje" => $mensaje
                );

                echo json_encode($respuesta);
            } else {
                // echo "Los productos no pueden ser actualizados, revise el archivo excel que subió.";
                $listaCeldasErrorString = 'no se pudo identificar la posición del error.';
                if (count($listaCeldasError) > 0) {
                    $listaCeldasErrorString = implode(", ", $listaCeldasError);
                }

                $respuesta = array(
                    "status" => false,
                    "mensaje" => 'Los aportes no pueden ser guardados, SOCIO NO ENCONTRADO, revise el archivo excel que subió. Posible causa en la celda: ' . $listaCeldasErrorString
                );

                echo json_encode($respuesta);
            }
        } else {
            $respuesta = array(
                "status" => false,
                "mensaje" => 'No se pudo subir el archivo.'
            );

            echo json_encode($respuesta);
        }
    } else {
        echo 'Acceso no válido.';
        // $redireccion = "";
        // header("Location: $redireccion");
    }

    echo json_encode($response);
