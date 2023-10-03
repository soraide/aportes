<?php
    $header = $data['header'];
    $contributions = $data['aportes'];
    $socio = $data['socio'];
    $index = 1;
    $total = 0;
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
            <table class="table table-sm table-bordered" style="width:500px;margin-left:100px;">
                <thead>
                    <tr>
                        <th align="center"><b>NRO.</b></th>
                        <th align="center"><b>AÑO</b></th>
                        <th align="center"><b>MES</b></th>
                        <th align="center"><b>MONTO</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($contributions as $contribution){
                            $total += $contribution['monto'];
                            echo '<tr>';
                            echo '<td align="center">'.$index.'</td>';
                            echo '<td align="center">'.$contribution['gestion'].'</td>';
                            echo '<td align="center">'.$contribution['mes'].'</td>';
                            echo '<td align="right">'.number_format($contribution['monto'], 2).'</td>';
                            echo '</tr>';

                            $index++;
                        }
                    ?>
                </tbody>
                <tfoot>
                    <td scope="col" align="center" colspan="3"><b><?php echo 'TOTAL'; ?></b></td>
                    <td scope="col" align="right"><b><?php echo number_format($total, 2); ?></b></td>
                </tfoot>
            </div>
        </div>
    </div>
</body>
</html>