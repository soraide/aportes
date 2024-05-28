<?php $total = 0; ?>
<div class="col-lg-12">
	<div class="table-responsive" style="max-height:600px;">
		<table class="table table-sm">
			<thead>
				<tr align="center">
					<th scope="col"><b>#</b></th>
					<th scope="col"><b>Monto</b></th>
					<th scope="col"><b>Mes</b></th>
					<th scope="col"><b>Gestión</b></th>
					<th scope="col"><b>Observación</b></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($aportes as $key => $aporte){ ?>
					<tr class="text-center">
						<td><?=($key + 1)?></td>
						<td><?=$aporte['monto']?></td>
						<td><?=strtoupper($meses[$aporte['mes']])?></td>
						<td><?=$aporte['gestion']?></td>
						<td align="start"><?=$aporte['observacion']?></td>
					</tr>
				<?php 
						$total += floatval($aporte['monto']);
					} 
				?>
			</tbody>
			<tfoot>
				<td colspan="4" align="right"><b>TOTAL APORTES:</b></td>
				<td align="left"><?=number_format($total,	2)." Bs"?></td>
			</tfoot>
		</table>
	</div>
</div>