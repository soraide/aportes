<?php

    require_once('../../api/config/database.php');
    require '../phpSpreadsheet/vendor/autoload.php'; // para analizar el excel
    date_default_timezone_set('America/La_Paz');
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Worksheet\PageMargins;
    use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooterDrawing;
    use PhpOffice\PhpSpreadsheet\Style\Border;
    use PhpOffice\PhpSpreadsheet\Style\Fill;
    use PhpOffice\PhpSpreadsheet\IOFactory;

    $numeroColumnasEstablecido = 9; //numero de columnas que debe tetner el excel

    $data = array();
    $pdo = connectToDatabase();

    $sql = "SELECT ROW_NUMBER() OVER(ORDER BY ts.paterno) AS numero, ts.numeroTin, ts.paterno, ts.materno, ts.materno, ts.nombres, ts.estado, 200 AS monto, 'Aporte regular' AS observacion
            FROM tblSocio ts
            WHERE ts.estado = ?
            ORDER BY ts.paterno ASC;";
    $estado = "ALTA";
    try {
        // Prepara la consulta
        $stmt = $pdo->prepare($sql);
        // Ejecuta la consulta
        $stmt->execute([$estado]);
        // Obtiene los resultados como un arreglo asociativo
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Procesa los resultados
        foreach ($results as $row) {
            array_push($data, $row);
        }
        generarExcel($data);
    } catch (PDOException $e) {
        $response['message'] = "Error en la consulta: " . $e->getMessage();
    }

    function generarExcel($data){
        $fecha = new DateTime();
        $mes = $fecha->format('m');
        $gestion = $fecha->format('Y');
        // ARMADO DEL EXCEL CON LA LIBRERIA
        // armado del reporte cabecera
        $hoja_calculo = new Spreadsheet();
        $hoja_activa = $hoja_calculo->getActiveSheet();
        //quitar la cuadricula de la hoja
        $hoja_activa->setShowGridlines(true);
        // colocamos la escala en 56%
        $hoja_activa->getPageSetup()->setScale(56);
        //para los margenes
        $pageMargins = new PageMargins();
        $pageMargins->setTop(0.79);
        $pageMargins->setBottom(0);
        $pageMargins->setLeft(0.2);
        $pageMargins->setRight(0.2);
        $hoja_activa->setPageMargins($pageMargins);
        // para el contenido
        // ======================
        // Cambiar el ancho de la columna
        $hoja_activa->getColumnDimension('A')->setWidth(7);
        $hoja_activa->getColumnDimension('B')->setWidth(12);
        $hoja_activa->getColumnDimension('C')->setWidth(14);
        $hoja_activa->getColumnDimension('D')->setWidth(14);
        $hoja_activa->getColumnDimension('E')->setWidth(14);
        $hoja_activa->getColumnDimension('F')->setWidth(12);
        $hoja_activa->getColumnDimension('G')->setWidth(15);
        $hoja_activa->getColumnDimension('H')->setWidth(10);
        $hoja_activa->getColumnDimension('I')->setWidth(15);

        $celda = $hoja_activa->getCell('A1');
        $celda->setValue("ALTA DE DESCUENTOS DE APORTES CIRCULO DE OFICIALES NAVALES ".getLiteralMonth($mes)." ".$gestion);
        $estilo = $celda->getStyle();
        $estilo->getFont()->setBold(true);

        $headers = array(
            'A' => "N°",
            'B' => "CODIGO",
            'C' => "AP. PATERNO",
            'D' => "AP. MATERNO",
            'E' => "NOMBRES",
            'F' => "ESTADO",
            'G' => "TIPO MONEDA",
            'H' => "APORTE",
            'I' => "OBSERVACION"
        );
        $hoja_activa->getStyle('A2:I2')->getFont()->setBold(true)->setSize(11);
        foreach($headers as $key => $head){
            $celda = $hoja_activa->getCell($key . '2');
            $celda->setValue($head);
        }
        // Contenido del documento Excel
        foreach($data as $index => $row){
            $num_row = $index + 3;
            $hoja_activa->getStyle('A' . $num_row . ':I' . $num_row)->getFont()->setBold(false)->setSize(8);
            
            $hoja_activa->getStyle('A' . $num_row)->getAlignment()->setHorizontal('center');
            $celda = $hoja_activa->getCell('A' . $num_row);
            $celda->setValue($row['numero']);

            $celda = $hoja_activa->getCell('B' . $num_row);
            $celda->setValue($row['numeroTin']);

            $celda = $hoja_activa->getCell('C' . $num_row);
            $celda->setValue($row['paterno']);

            $celda = $hoja_activa->getCell('D' . $num_row);
            $celda->setValue($row['materno']);

            $celda = $hoja_activa->getCell('E' . $num_row);
            $celda->setValue($row['nombres']);

            $celda = $hoja_activa->getCell('F' . $num_row);
            $celda->setValue($row['estado']);

            $hoja_activa->getStyle('G' . $num_row)->getAlignment()->setHorizontal('center');
            $celda = $hoja_activa->getCell('G' . $num_row);
            $celda->setValue('Bs.');

            $hoja_activa->getStyle('A' . $num_row)->getAlignment()->setHorizontal('right');
            $celda = $hoja_activa->getCell('H' . $num_row);
            $celda->setValue($row['monto']);

            $celda = $hoja_activa->getCell('I' . $num_row);
            $celda->setValue($row['observacion']);
        }

        $filename = "Circulo-".$mes."-".$gestion;
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($hoja_calculo);
        $writer->save('php://output');

    }

    function getLiteralMonth($month){
        $literal = array(
            '01' => 'ENERO',
            '02' => 'FEBRERO',
            '03' => 'MARZO',
            '04' => 'ABRIL',
            '05' => 'MAYO',
            '06' => 'JUNIO',
            '07' => 'JULIO',
            '08' => 'AGOSTO',
            '09' => 'SEPTIEMBRE',
            '10' => 'OCTUBRE',
            '11' => 'NOVIEMBRE',
            '12' => 'DICIEMBRE'
        );
        return isset($literal[$month]) ? $literal[$month] : 'S/N';
    }
?>