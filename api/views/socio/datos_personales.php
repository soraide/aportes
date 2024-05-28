<div class="col-lg-6 mb-4">
    <div class="card">
        <div class="card-header">
            <b>Datos Personales</b>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-striped">
                    <tbody>
                        <tr>
                            <td><b>Nombre:</b></td>
                            <td><?=$socio->nombre.' '.$socio->paterno.' '.$socio->materno?></td>
                        </tr>
                        <tr>
                            <td><b>C.I.:</b></td>
                            <td><?=$socio->ci.' '.$expedicion->acronimo?></td>
                        </tr>
                        <tr>
                            <td><b>Fecha de Nacimiento:</b></td>
                            <td><?=(new DateTime($socio->fechaNacimiento))->format('d/m/Y')?></td>
                        </tr>
                        <tr>
                            <td><b>Estado Civil:</b></td>
                            <td><?=$estadoCivil->detalle?></td>
                        </tr>
                        <tr>
                            <td><b>Celular:</b></td>
                            <td><?=$socio->celular?></td>
                        </tr>
                        <tr>
                            <td><b>Correo Electrónico:</b></td>
                            <td><?=$socio->correo?></td>
                        </tr>
                        <tr>
                            <td><b>Lugar Nacimiento:</b></td>
                            <td><?=$vivienda->lugar_nacimiento?></td>
                        </tr>
                        <tr>
                            <td><b>Dirección:</b></td>
                            <td><?=$vivienda->ciudad.' '.$vivienda->zona.', '.$vivienda->calle.' '.$vivienda->numero?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-6 mb-4">
    <div class="card">
        <div class="card-header">
            <b>Datos Armada Boliviana</b>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-hover table-striped">
                    <tbody>
                        <tr>
                            <td><b>Número de T.I.N.:</b></td>
                            <td><?=$detalle->nro_tin?></td>
                        </tr>
                        <tr>
                            <td><b>Grado:</b></td>
                            <td><?=$grado->detalle?></td>
                        </tr>
                        <tr>
                            <td><b>Profesión:</b></td>
                            <td><?=$detalle->profesion?></td>
                        </tr>
                        <tr>
                            <td><b>Año de Promoción:</b></td>
                            <td><?=$detalle->promo?></td>
                        </tr>
                        <tr>
                            <td><b>Fecha de Ingreso:</b></td>
                            <td><?=(new DateTime($detalle->fecha_ingreso))->format('d/m/Y')?></td>
                        </tr>
                        <tr>
                            <td><b>Código Boleta:</b></td>
                            <td><?=$detalle->codigo_boleta?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>