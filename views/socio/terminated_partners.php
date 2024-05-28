<?php
    $header = $data['headers'];
    $socios = $data['socios'];
    $index = 1;
    $signature = $data['signature'];
    $nameCFO = $signature['cfo'];
    $nameCON = $signature['con'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terminated Partners</title>
    
    <style>
        @page {
            margin-left: 1.5cm;
            margin-right: 1.5cm;
            margin-top: 1cm;
            margin-bottom: 1cm;
        }
        <?php
            ob_start();
            require('../static/css/bootstrap.min.css');
            $html = ob_get_clean();
            echo $html;
        ?>
    </style>
</head>
<body style="width: 100%;">
    <div style="width:200px; font-size: 12px;">
        <div class="text-center">
            <?php echo $header['entity']; ?><br>
            <?php echo $header['name']; ?><br>
            <?php echo $header['country']; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center mt-2">
            <b><u><?php echo strtoupper($header['title']); ?></u></b><br>
            <b style="font-size: 12px;"><?php echo strtoupper($header['subtitle']); ?></b>
        </div>
    </div>
    <div class="row" style="font-size: 12px;">
        <div class="col-12">
            
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 p-0" style="font-size: 12px;">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th align="center"><b>N°</b></th>
                        <th align="center"><b>AP. PATERNO</b></th>
                        <th align="center"><b>AP. MATERNO</b></th>
                        <th align="center"><b>NOMBRES</b></th>
                        <th align="center"><b>C.I.</b></th>
                        <th align="center"><b>FECHA ACEPTADO</b></th>
                        <th align="center"><b>FECHA BAJA</b></th>
                        <th align="center"><b>MONTO DE RETIRO</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($socios as $socio){
                            echo '<tr>';
                            echo '<td align="center"><b>'.$socio['numero'].'</b></td>';
                            echo '<td align="left">'.strtoupper($socio['paterno']).'</td>';
                            echo '<td align="left">'.strtoupper($socio['materno']).'</td>';
                            echo '<td align="left">'.strtoupper($socio['nombres']).'</td>';
                            echo '<td align="left">'.strtoupper($socio['ci']).'</td>';
                            echo '<td align="center">'.$socio['aceptado'].'</td>';
                            echo '<td align="center">'.$socio['baja'].'</td>';
                            echo '<td align="right">'.($socio['monto'] == null ? '0.00' : $socio['monto']).'</td>';
                            echo '</tr>';
                        }
                    ?>
                </tbody>
            </div>
        </div>
        <div class="col-lg-12 p-0">
            <div class="row text-center">
                <div class="col-lg-12 p-0" style="line-height:1;margin-top:100px;">
                    <?= $nameCFO ?><br>
                    <b>DIRECTOR FINANCIERO</b>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-lg-12 p-0" style="line-height:1;margin-top:100px;">
                    <?= $nameCON ?><br>
                    <b>PRESIDENTE DEL C.O.N. "STELLA MARIS"</b>
                </div>
            </div>
        </div>
    </div>
</body>
</html>