<table id="t_socios_baja" class="table table-bordered table-striped" style="width:100%">
  <thead>
    <tr>
      <th>Nro.</th>
      <th>Apellidos</th>
      <th>Nombres</th>
      <th>C.I.</th>
      <th>Celular</th>
      <th>Grado</th>
      <th>Fecha registro.</th>
      <th>Fecha Baja</th>
    </tr>
  </thead>
  <tbody>
  <?php 
  $i = 1;
  foreach($socios as $socio):  ?>
    <tr>
      <td><?= $i ?></td>
      <td><?= $socio['paterno']. ' '.$socio['materno'] ?></td>
      <td><?= $socio['nombre'] ?></td>
      <td><?= $socio['ci'] ?></td>
      <td><?= $socio['celular'] ?></td>
      <td><?= $socio['grado'] ?></td>
      <td><?= date('d/m/Y', strtotime($socio['creado_en'])) ?></td>
      <td><?= date('d/m/Y', strtotime($socio['fecha_updated'])) ?></td>
    </tr>
  <?php 
  $i++;
  endforeach; ?>
  </tbody>
</table>