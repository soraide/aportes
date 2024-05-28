<table id="t_gestiones" class="table table-bordered table-striped" style="width:100%">
  <thead>
    <tr>
      <th>ID</th>
      <th>Gestion</th>
      <th>Rendimiento</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($gestiones as $gestion): ?>
      <tr>
        <td><?= $gestion['idGestion'] ?></td>
        <td><?= $gestion['gestion'] ?></td>
        <td><?= $gestion['rendimiento'] ?></td>
        <td align="center">
          <?php if($gestion['gestion'] == date('Y')): ?>
          <button class="btn btn-info" onclick="obtenerGestion(<?= $gestion['idGestion'] ?>)">Editar</button> 
          <?php endif; ?>
          <?php if(intval($gestion['gestion']) >= intval(date('Y'))): ?>
          <button class="btn btn-danger" onclick="removerGestion(<?= $gestion['idGestion'] ?>,<?= $gestion['gestion'] ?>)">Remover</button>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>