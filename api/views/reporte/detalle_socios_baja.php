<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Socios Baja</title>
    
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
            <b style="font-size: 20px;"><?=strtoupper($header['title'])?></b><br>
            <b><?php echo strtoupper($header['subtitle']); ?></b>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12 p-0" style="font-size: 12px;">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr class="text-center">
                        <th><b>N°</b></th>
                        <th><b>Ap. Paterno</b></th>
                        <th><b>Ap. Materno</b></th>
                        <th><b>Nombres</b></th>
                        <th><b>C.I.</b></th>
                        <th><b>Fecha Aceptado</b></th>
                        <th><b>Fecha Baja</b></th>
                        <th><b>Monto de Retiro</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($socios as $key => $socio){
                    ?>
                        <tr>
                            <td align="center"><b><?=($key + 1)?></b></td>
                            <td align="left"><?=ucfirst($socio['paterno'])?></td>
                            <td align="left"><?=ucfirst($socio['materno'])?></td>
                            <td align="left"><?=ucfirst($socio['nombre'])?></td>
                            <td align="left"><?=$socio['ci']?></td>
                            <td align="center"><?=$socio['aceptado']?></td>
                            <td align="center"><?=$socio['baja']?></td>
                            <td align="right"><?=($socio['monto'] == null ? '0.00' : $socio['monto'])?></td>
                        </tr>';
                    <?php
                        }
                    ?>
                </tbody>
            </div>
        </div>
        <div class="col-lg-12 p-0">
            <div class="row text-center">
                <div class="col-lg-12 p-0" style="line-height:1;margin-top:100px;">
                    <?=$signature['cfo']?><br>
                    <b>DIRECTOR FINANCIERO</b>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-lg-12 p-0" style="line-height:1;margin-top:100px;">
                    <?=$signature['con']?><br>
                    <b>PRESIDENTE DEL C.O.N. "STELLA MARIS"</b>
                </div>
            </div>
        </div>
    </div>
</body>
</html>