<?php

    require_once('../dompdf/LiteralAmount.php');

    $contributions = $aportes;

    $acumulado = 0;
    $ganancia = 0;
    $capitalizacion = 0;
    $numAportes = 0;
    $totalMonto = 0;

    $namePartner = strtoupper($socio->paterno." ".$socio->materno." ".$socio->nombre);
    
    $data = array();
    $firstMonthContribution = (sizeof($contributions) > 0 ? $contributions[0]['primerMes'] : '');
    $firstYearContribution = (sizeof($contributions) > 0 ? $contributions[0]['gestion'] : '');
    $lastMonthContribution = (sizeof($contributions) > 0 ? $contributions[sizeof($contributions) - 1]['ultimoMes'] : '');
    $lastYearContribution = (sizeof($contributions) > 0 ? $contributions[sizeof($contributions) - 1]['gestion'] : '');

    foreach($contributions as $contribution){
        
        $acumulado += $contribution['monto'];
        $ganancia = $contribution['monto'] * floatval($contribution['rendimiento'] / 100);
        $capitalizacion = $contribution['monto'] + $ganancia;

        $numAportes += $contribution['cantidad'];
        $totalMonto += $contribution['monto'];

        $row = array(
            'gestion' => $contribution['gestion'],
            'aportes' => $contribution['cantidad'],
            'monto' => $contribution['monto'],
            'acumulado' => $acumulado,
            'rendimiento' => $contribution['rendimiento'],
            'ganancia' => $ganancia,
            'capitalizacion' => $capitalizacion
        );

        array_push($data,$row);

        $acumulado = $capitalizacion;
    }

    $helpAmount = 0;
    $currentCredit = 0;
    $totalDiscounts = 0;
    $fullRefund = (sizeof($data) > 0 ? $data[sizeof($data) - 1]['capitalizacion'] : 0);

    $nameCFO = $signature['cfo'];
    $nameCON = $signature['con'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contributions Summary</title>
    
    <style>
        @page {
            margin-right: 3cm;
            margin-left: 2.3cm;
        }

        body {
            font-family: Arial, Helvetica, sans-serif !important;
            background-image: url(/images/logo_dark.png);
        }

        #watermark {
            position: fixed;
            top: 90px;
            width: 100%;
            height: 100%;
            opacity: .2;
            z-index: -1000;
        }

        table {
            border: 1px solid #000;
        }
        th, td {
            border: 1px solid #000;
            padding: 0px 4px;
        }

        p {
            line-height: 1.4;
        }
        <?php
            ob_start();
            require('../static/css/bootstrap.min.css');
            $html = ob_get_clean();
            echo $html;
        ?>
    </style>
</head>
<body>
    <!-- MARCA DE AGUA -->
    <div id="watermark">
        <div class="row justify-content-center">
            <div class="col-lg-12 text-center">
                <img src="data:image/jpeg;base64,<?=$watermark?>"/>
            </div>
        </div>
    </div>
    <div style="width:200px; font-size: 12px;line-height:1.2;">
        <div class="text-center">
            <?= $header['entity']; ?><br>
            <?= $header['name']; ?><br>
            <?= $header['country']; ?>
        </div>
    </div>
    <!-- TITULO DEL DOCUMENTO -->
    <div class="row">
        <div class="col-12 text-center mt-2" style="font-size: 16px;">
            <b><u><?= strtoupper($header['title']); ?></u></b>
        </div>
    </div>
    <!-- FECHA DE CREACIÓN -->
    <div class="row mt-2"  style="font-size: 15px;">
        <div class="col-lg-12 text-right">
            <?php $fecha = explode("-",$header['date']); ?>
            La Paz, <?= $fecha[2] ?> de <?=ucfirst($meses[$fecha[1]])?> de <?= $fecha[0] ?>
        </div>
    </div>

    <div class="row" style="font-size: 16px;">
        <div class="col-12 text-justify">
            <b class="mt-2">VISTOS</b>
            <p class="mt-2">
                Que el Señor <b><?= $namePartner ?></b>, con Cédula de Identidad N° <?= $socio->ci." ".$expedicion->acronimo ?>, solicita la devolución de sus aportes con incremento, realizados al Círculo de Oficiales Navales "Stella Maris" adjuntando la documentación conforme Normativa Vigente.
            </p>
            <b class="mt-2">CONSIDERANDO:</b>
            <p>
                Que el Círculo de Oficiales Navales “Stella Maris” se rige por su Estatuto Orgánico, el mismo que señala en su Capítulo 3 <i>“Permanencia, renuncia voluntaria y sus limitantes”, <b>Artículo 14.- (Permanencia)</b> El tiempo mínimo de permanencia obligatoria de los socios será de 10 años consecutivos con igual constancia en los aportes...”.</i>
            <br>
                Que el Reglamento para la Devolución de Aportes del Círculo de Oficiales Navales “Stella Maris”, aprobado en Asamblea General Ordinaria de Socios el 1 de junio de 2017, establece que la Dirección Financiera de la Institución deberá proceder con la devolución de los aportes a aquellos Socios que hayan cumplido con 120 aportes consecutivos o discontinuos al Círculo.
            <br>
                Que el Reglamento para la Devolución de Aportes del Círculo de Oficiales Navales “Stella Maris”, autoriza los procedimientos a seguir para la respectiva devolución.
            <br>
            <?php $fecha = ($detalle->fecha_ingreso == null ? ['','',''] : explode("-",$detalle->fecha_ingreso)); ?>
            Que el Señor <b><?= $namePartner ?></b> inicio sus aportes al Círculo de Oficiales Navales “Stella Maris”, en el mes de <?=$meses[$fecha[1]]?> de <?= $fecha[0] ?> y cumplió su aporte número <?= $numAportes ?> en el mes de <?=isset($meses[$lastMonthContribution]) ? $meses[$lastMonthContribution] : 'S/R'?> de <?= $lastYearContribution ?>.
            <br>
                Que el Señor <b><?= $namePartner ?></b> manifiesta su conformidad con el monto de devolución señalado en la presente Resolución Administrativa, firmando la misma con su puño y letra.
            </p>
            <b class="mt-2">POR TANTO:</b>
            <p>
                El Presidente del Directorio del Círculo de Oficiales Navales “Stella Maris” en cumplimiento de las atribuciones delegadas por la Asamblea General de Socios Ordinaria de fecha 27 de octubre de 2006 en base y sujeción al Estatuto Orgánico, El Reglamento para la Devolución de Aportes aprobado por la Asamblea General de Socios de fecha 1 de junio de 2017, además de leyes marco y otras Normas reguladoras.
            </p>
            <b class="mt-2">RESUELVE:</b>
            <p class="mt-2">
                <b>PRIMERO:</b> Aprobar la Devolución de aportes con incremento al Señor <b><?= $namePartner ?></b>, del periodo <?=isset($meses[$firstMonthContribution]) ? $meses[$firstMonthContribution] : 'S/R'?> de <?= $firstYearContribution ?> a <?=isset($meses[$lastMonthContribution]) ? $meses[$lastMonthContribution] : 'S/R' ?> de <?= $lastYearContribution ?>, conforme el siguiente cuadro:
            </p>
        </div>
    </div>
    <div style="page-break-before: always;"></div>
    <div class="row" style="font-size: 12px;">
        <div class="col-lg-12">
            SOCIO: <?= $namePartner ?><br>
            C.I.: <?=$socio->ci." ".$expedicion->acronimo?>
        </div>
    </div>
    <div class="row">
        <div class="col" style="font-size: 12px;">
            <table style="width:600px;border-colapse:black 1px solid;">
                <thead>
                    <tr>
                        <td align="center"><b>AÑO</b></td>
                        <td align="center"><b># APORTES</b></td>
                        <td align="center"><b>MONTO Bs.</b></td>
                        <td align="center"><b>ACUMULADO</b></td>
                        <td align="center"><b>% Rendimiento</b></td>
                        <td align="center"><b>Ganancia Año</b></td>
                        <td align="center"><b>Capitalización</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($data as $contribution){
                            echo '<tr>';
                            echo '<td align="center">'.$contribution['gestion'].'</td>';
                            echo '<td align="center">'.$contribution['aportes'].'</td>';
                            echo '<td align="right">'.number_format($contribution['monto'], 2).'</td>';
                            echo '<td align="right">'.number_format($contribution['acumulado'], 2).'</td>';
                            echo '<td align="right">'.number_format($contribution['rendimiento'], 2).'%</td>';
                            echo '<td align="right">'.number_format($contribution['ganancia'], 2).'</td>';
                            echo '<td align="right">'.number_format($contribution['capitalizacion'], 2).'</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
                <tfoot>
                    <td></td>
                    <td scope="col" align="center"><b><?= $numAportes ?></b></td>
                    <td scope="col" align="right"><b><?= number_format($totalMonto, 2) ?></b></td>
                    <td colspan="4"></td>
                </tfoot>
            </div>
        </div>
    </div>
    <div class="row mt-4" style="font-size: 12px;">
        <div class="col-lg-12">
            <b>DESCUENTOS:</b>
            <table>
                <tr>
                    <td style="width:300px;">Ayuda Bs.</td>
                    <td style="width:100px;" align="right"><?= number_format($helpAmount, 2) ?></td>
                </tr>
                <tr>
                    <td>CREDITO VIGENTE Bs.</td>
                    <td align="right"><?= number_format($currentCredit, 2) ?></td>
                </tr>
                <tr>
                    <td><b>TOTAL DESCUENTOS Bs.</b></td>
                    <td align="right"><?= number_format($totalDiscounts, 2) ?></td>
                </tr>
                <tr>
                    <td><b>TOTAL DEVOLUCIÓN Bs.</b></td>
                    <td align="right"><?= number_format($totalMonto, 2) ?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row mt-4 text-justify" style="font-size: 15px;">
        <div class="col-lg-12">
            <p>
                <b>SEGUNDO:</b> Autorizar a la Dirección Financiera del Círculo de Oficiales Navales “Stella Maris”, el depósito de los aportes más el incremento al Señor <b><?= $namePartner ?></b> a su cuenta individual en el Banco Unión S.A., monto que asciende a Bs. <?= number_format($totalMonto, 2) ?> (<?= numtoletras(round($totalMonto, 2)) ?> BOLIVIANOS).
            </p>
            <p>
                Regístrese, comuníquese al interesado y archívese:
            </p>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-lg-12" style="line-height:1;margin-top:70px;">
            <?=$socio->paterno." ".$socio->materno." ".$socio->nombre?><br>
            <b><?=$socio->ci." ".$expedicion->acronimo?></b>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-lg-12" style="line-height:1;margin-top:70px;">
            <?= $nameCFO ?><br>
            <b>DIRECTOR FINANCIERO</b>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-lg-12" style="line-height:1;margin-top:70px;">
            <?= $nameCON ?><br>
            <b>PRESIDENTE DEL C.O.N. "STELLA MARIS"</b>
        </div>
    </div>

</body>
</html>