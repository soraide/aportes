<table id="t_afiliados" class="table table-bordered table-striped" style="width:100%">
  <thead>
    <tr>
      <th>Nro.</th>
      <th>Apellidos</th>
      <th>Nombres</th>
      <th>C.I.</th>
      <th>Fecha Nac.</th>
      <th>Celular</th>
      <th>Grado</th>
      <th>Observaciones</th>
      <th>Fecha Aceptado</th>
      <th>Opciones</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $i = 0;
    foreach ($socios as $socio) : ?>
      <tr>
        <td><?= $i ?></td>
        <td><?= $socio['paterno'] .' '.$socio['materno'] ?></td>
        <td><?= $socio['nombre'] ?></td>
        <td><?= $socio['ci'] . ' '. $socio['acronimo'] ?></td>
        <td><?= date('d/m/Y', strtotime($socio['fechaNacimiento'])) ?></td>
        <td><?= $socio['celular'] ?></td>
        <td><?= $socio['grado'] ?></td>
        <td><?= $socio['observacion'] ?></td>
        <td><?= date('d/m/Y', strtotime($socio['fecha_updated'])) ?></td>
        <td>
          <div class="dropdown">
            <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
              Acciones </button>
            <div class="dropdown-menu">
              <!--<a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal_detalle" data-id="${element.idSocio}"><i class="fas fa-eye text-info"></i> &nbsp;&nbsp; Detalles</a>
        <a class="dropdown-item editarUsuario" data-id="${element.idSocio}" href="#"><i class="fas fa-edit text-primary"></i> &nbsp;&nbsp;Editar</a>-->
              <a class="dropdown-item" href="#" data-id="<?=$socio['idSocio']?>" data-toggle="modal" data-target="#modal_baja"><i class="fas fa-external-link-alt text-danger"></i> &nbsp;&nbsp; Dar de baja</a>
              <a class="dropdown-item" data-id="${element.idSocio}" href="../../api/reporte/ResumenAportesSocioPDF?id=<?=$socio['idSocio']?>" target="_blank"><i class="fas fa-money-bill text-success"></i> &nbsp;&nbsp;Ver aportes resumen</a>
              <a class="dropdown-item" data-id="${element.idSocio}" href="../../api/reporte/HistorialAportesSocioPDF?id=<?=$socio['idSocio']?>" target="_blank"><i class="fas fa-money-bill text-primary"></i> &nbsp;&nbsp;Ver aportes detallado</a>
            </div>
        </td>
      </tr>
    <?php 
    $i++;
    endforeach; ?>
  </tbody>
</table>