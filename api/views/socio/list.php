<table id="t_afiliados_espera" class="table table-bordered table-striped" style="width:100%">
  <thead>
    <tr align="center">
      <th>Nro.</th>
      <th>Apellidos</th>
      <th>Nombres</th>
      <th>C.I.</th>
      <th>Fecha Nac.</th>
      <th>Celular</th>
      <th>Grado</th>
      <th>Opciones</th>
    </tr>
  </thead>
  <tbody id="afiliados_espera_body">
    <?php 
    $nro = 1;
    foreach ($socios as $socio): ?>
    <tr>
      <td><?= $nro ?></td>
      <td><?= $socio['paterno'].' '.$socio['materno'] ?></td>
      <td><?= $socio['nombre'] ?></td>
      <td><?= $socio['ci'] ?></td>
      <td><?= date('d/m/Y',strtotime($socio['fechaNacimiento'])) ?></td>
      <td><?= $socio['celular'] ?></td>
      <td><?= $socio['grado'] ?></td>
      <td>
        <div class="dropdown">
          <button class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            Acciones </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#" onclick="revisarSocio(<?= $socio['idSocio'] ?>)"><i class="fas fa-check-square text-success"></i> &nbsp;&nbsp;Revisar</a>
          </div>
      </td>
    </tr>
    <?php 
    $nro++;
    endforeach ?>
  </tbody>
</table>