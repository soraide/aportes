<div class="row">
  <div class="col-md-6">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-exclamation-triangle"></i>
          Datos
        </h3>
      </div>
      <div class="card-body">
        <table class="table">
          <thead>
            <tr align="center">
              <th scope="col">Detalle</th>
              <th scope="col">Valor </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td style="font-weight:bolder">Nombre Completo</td>
              <td><?= $socio->nombre .' '. $socio->paterno.' '.$socio->materno?></td>
            </tr>
            <tr>
              <td style="font-weight:bolder">Estado Civil</td>
              <td><?= $socio->estado_civil ?></td>
            </tr>
            <tr>
              <td style="font-weight:bolder">Correo Electrónico</td>
              <td><?= $socio->correo ?></td>
            </tr>
            <tr>
              <td style="font-weight:bolder">Celular</td>
              <td><?= $socio->celular ?></td>
            </tr>
            <tr>
              <td style="font-weight:bolder">Ciudad</td>
              <td><?= $socio->vivienda->ciudad ?></td>
            </tr>
            <tr>
              <td style="font-weight:bolder">Fecha Nac.</td>
              <td><?= date('d/m/Y', strtotime($socio->fechaNacimiento)) ?></td>
            </tr>
            <tr>
              <td style="font-weight:bolder">Lugar Nac.</td>
              <td><?= $socio->vivienda->lugar_nacimiento ?></td>
            </tr>
            <tr>
              <td style="font-weight:bolder">Dirección</td>
              <td><?= $socio->vivienda->zona.' '.$socio->vivienda->avenida.' '.$socio->vivienda->calle.' #'.$socio->vivienda->numero ?></td>
            </tr>
            <tr>
              <td style="font-weight:bolder">Código Boleta</td>
              <td><?= $socio->details->codigo_boleta ?></td>
            </tr>
            <tr>
              <td style="font-weight:bolder">Profesión</td>
              <td><?= $socio->details->profesion ?></td>
            </tr>
            <tr>
              <td style="font-weight:bolder">Fecha Incorporación</td>
              <td><?= date('d/m/Y', strtotime($socio->details->fecha_ingreso)) ?></td>
            </tr>
            <tr>
              <td style="font-weight:bolder">Grado</td>
              <td><?= $socio->grado ?></td>
            </tr>
            <tr>
              <td style="font-weight:bolder">Número TIN</td>
              <td><?= $socio->details->nro_tin ?></td>
            </tr>
            <tr>
              <td style="font-weight:bolder">Archivo Carnet</td>
              <td><a class="btn btn-info" href="../../api/documents/file_<?= $socio->idSocio ?>_user.pdf" target="_blank"><i class="fas fa-file-pdf"></i> Ver</a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card card-default">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-users"></i>
          Beneficiarios
        </h3>
      </div>
      <div class="card-body">

        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Apellidos</th>
              <th>CI</th>
              <th>Patentesco</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($beneficiarios as $bene):  ?>
            <tr>
              <td><?= $bene->nombres ?></td>
              <td><?= $bene->paterno .' '. $bene->materno ?></td>
              <td><?= $bene->ci .' '.$bene->acronimo ?></td>
              <td><?= $bene->parentesco ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="d-flex justify-content-center mt-3">
  <button class="btn btn-secondary ml-2" onclick="listarSociosEspera()">Volver</button>
  <button class="btn btn-danger ml-2" data-id="<?= $socio->idSocio ?>" data-toggle="modal" data-target="#modal_rechazar">Rechazar</button>
  <button class="btn btn-success ml-2" data-id="<?= $socio->idSocio ?>" data-toggle="modal" data-target="#modal_aceptar">Aceptar</button>
</div>