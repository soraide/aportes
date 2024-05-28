<?php
    /*$header = $data['header'];
    $contributions = $data['aportes'];
    $socio = $data['socio'];*/
    $index = 1;
    $total = 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial Aportes</title>
    
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
<body width="100%">
    <div style="width:200px; font-size: 12px;">
        <div class="text-center">
            <?=$header['entity']?><br>
            <?=$header['name']?><br>
            <?=$header['country']?>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center mt-2">
            <b style="font-size:20px;"><?=strtoupper($header['title'])?></b>
        </div>
    </div>
    <div class="row mt-2" style="font-size: 12px;">
        <div class="col-12">
            <b>SOCIO: </b><?=strtoupper($socio->paterno.' '.$socio->materno.' '.$socio->nombre)?><br>
            <b>CI: </b><?=$socio->ci.' '.$expedicion->acronimo?>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12" style="font-size: 12px;">
            <table class="table table-sm table-bordered" style="width:500px;margin-left:100px;">
                <thead>
                    <tr class="text-center">
                        <th><b>N°</b></th>
                        <th><b>Gestión</b></th>
                        <th><b>Mes</b></th>
                        <th><b>Monto [Bs]</b></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($aportes as $key => $aporte){
                            $total += floatval($aporte['monto']);
                    ?>
                        <tr>
                            <td align="center"><?=($key + 1)?></td>
                            <td align="center"><?=$aporte['gestion']?></td>
                            <td align="center"><?=strtoupper($meses[$aporte['mes']])?></td>
                            <td align="right"><?=number_format($aporte['monto'], 2)?></td>
                        </tr>
                    <?php
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