<?php
    $header = $data['header'];
    $contributions = $data['aportes'];
    $socio = $data['socio'];
    $acumulado = 0;
    $ganancia = 0;
    $capitalizacion = 0;
    $numAportes = 0;
    $totalMonto = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contributions Summary</title>
    
    <style>
        @page {
            margin-left: 2cm;
            margin-right: 2;
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
    <div style="width:200px; font-size: 12px;">
        <div class="text-center">
            <?php echo $header['entity']; ?><br>
            <?php echo $header['name']; ?><br>
            <?php echo $header['country']; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center mt-2">
            <div class="h5"><?php echo strtoupper($header['title']); ?></div>
        </div>
    </div>
    <div class="row" style="font-size: 12px;">
        <div class="col-12">
            <b>SOCIO: </b><?php echo $socio['paterno'].' '.$socio['materno'].' '.$socio['nombres']; ?><br>
            <b>CI: </b><?php echo $socio['ci']; ?>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12" style="font-size: 12px;">
            <table class="table table-sm table-bordered" style="width:680px;">
                <thead>
                    <tr>
                        <th scope="col" align="center">AÑO</th>
                        <th scope="col" align="center"># APORTES</th>
                        <th scope="col" align="center">MONTO Bs.</th>
                        <th scope="col" align="center">ACUMULADO</th>
                        <th scope="col" align="center">% Rendimiento</th>
                        <th scope="col" align="center">Ganancia Año</th>
                        <th scope="col" align="center">Capitalización</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($contributions as $contribution){
                            $acumulado += $contribution['monto'];
                            $ganancia = $acumulado * floatval($contribution['rendimiento'] / 100);
                            $capitalizacion = $acumulado + $ganancia;

                            $numAportes += $contribution['aportes'];
                            $totalMonto += $contribution['monto'];
                            
                            echo '<tr>';
                            echo '<td align="center">'.$contribution['gestion'].'</td>';
                            echo '<td align="center">'.$contribution['aportes'].'</td>';
                            echo '<td align="right">'.number_format($contribution['monto'], 2).'</td>';
                            echo '<td align="right">'.number_format($acumulado, 2).'</td>';
                            echo '<td align="right">'.number_format($contribution['rendimiento'], 2).'</td>';
                            echo '<td align="right">'.number_format($ganancia, 2).'</td>';
                            echo '<td align="right">'.number_format($capitalizacion, 2).'</td>';
                            echo '</tr>';

                            $acumulado = $capitalizacion;
                        }
                    ?>
                </tbody>
                <tfoot>
                    <td></td>
                    <td scope="col" align="center"><b><?php echo $numAportes; ?></b></td>
                    <td scope="col" align="right"><b><?php echo number_format($totalMonto, 2); ?></b></td>
                    <td colspan="4"></td>
                </tfoot>
            </div>
        </div>
    </div>
</body>
</html>