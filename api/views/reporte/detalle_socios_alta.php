<?php
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
    <title>Detalle Socios Alta</title>
    
    <style>
        @page {
            margin-left: 1.5cm;
            margin-right: 1.5cm;
            margin-top: 1cm;
            margin-bottom: 1cm;
        }
        <?php
            ob_start();
            require('css/bootstrap.min.css');
            $html = ob_get_clean();
            echo $html;
        ?>
    </style>
</head>
<body style="width: 100%;">
    <div style="width:200px; font-size: 12px;">
        <div class="text-center">
            <?=$header['entity']?><br>
            <?=$header['name']?><br>
            <?=$header['country']?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center mt-2">
            <b style="font-size:20px;"><?=strtoupper($header['title'])?></b><br>
            <b><?=strtoupper($header['subtitle'])?></b>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 p-0" style="font-size: 12px;">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr class="text-center">
                        <th><b>N°</b></th>
                        <th><b>Código</b></th>
                        <th><b>Ap. Paterno</b></th>
                        <th><b>Ap. Materno</b></th>
                        <th><b>Nombres</b></th>
                        <th><b>Estado</b></th>
                        <th><b>Moneda</b></th>
                        <th><b>Aporte</b></th>
                        <th><b>Observación</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($socios as $key => $socio){
                    ?>
                        <tr>
                            <td align="center"><b><?=($key + 1)?></b></td>
                            <td align="left"><?=$socio['nro_tin']?></td>
                            <td align="left"><?=ucfirst($socio['paterno'])?></td>
                            <td align="left"><?=ucfirst($socio['materno'])?></td>
                            <td align="left"><?=ucfirst($socio['nombre'])?></td>
                            <td align="center"><?=strtoupper($socio['estado'])?></td>
                            <td align="center"><?='Bs.'?></td>
                            <td align="center"><?=number_format(200,    2)?></td>
                            <td align="center"><?=$socio['observacion']?></td>
                        </tr>
                    <?php
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