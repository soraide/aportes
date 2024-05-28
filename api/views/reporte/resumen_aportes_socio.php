<?php
    $acumulado = 0;
    $ganancia = 0;
    $capitalizacion = 0;
    $numeroAportes = 0;
    $totalMonto = 0;
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Resumen de Aportes</title>
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
                <table class="table table-sm table-bordered" style="width:680px;">
                    <thead>
                        <tr>
                            <th scope="col" align="center">N°</th>
                            <th scope="col" align="center">Gestión</th>
                            <th scope="col" align="center">Aportes</th>
                            <th scope="col" align="center">Monto [Bs]</th>
                            <th scope="col" align="center">Acumulado</th>
                            <th scope="col" align="center">Rendimiento [%]</th>
                            <th scope="col" align="center">Ganancia Año</th>
                            <th scope="col" align="center">Capitalización</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($aportes as $key => $aporte){ 
                                
                                $acumulado += floatval($aporte['monto']);
                                $ganancia = $acumulado * floatval($aporte['rendimiento']) / 100;
                                $capitalizacion = $acumulado + $ganancia;

                                $numeroAportes += $aporte['cantidad'];
                                $totalMonto += floatval($aporte['monto']);
                        ?>
                            <tr>
                                <td align="center"><?=($key + 1)?></td>
                                <td align="center"><?=$aporte['gestion']?></td>
                                <td align="center"><?=$aporte['cantidad']?></td>
                                <td align="center"><?=number_format($aporte['monto'],       2)?></td>
                                <td align="center"><?=number_format($acumulado,             2)?></td>
                                <td align="center"><?=number_format($aporte['rendimiento'], 2)?></td>
                                <td align="center"><?=number_format($ganancia,              2)?></td>
                                <td align="center"><?=number_format($capitalizacion,        2)?></td>
                            </tr>
                        <?php 
                            }
                            $acumulado = $capitalizacion;
                        ?>
                    </tbody>
                    <tfoot>
                        <td colspan="2"></td>
                        <td scope="col" align="center"><b><?=$numeroAportes?></b></td>
                        <td scope="col" align="right"><b><?=number_format($totalMonto,      2)?></b></td>
                        <td colspan="4"></td>
                    </tfoot>
                </div>
            </div>
        </div>
    </body>
</html>