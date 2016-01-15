<tr>
	<td><div class="margin-top-10"><input type="checkbox"></div></td>
	<td><div class="margin-top-10" style="font-size:25px"><?php echo $row['cod_probador'] ?></div></td>
	
	<td><div class="margin-top-10" style="font-size:25px">

	<?php echo $row['id_tienda'] ?></div></td>
	
	
	<td><div class="margin-top-10 text-center">
	<?php if ($row['estado_probador'] == 1 ){ ?>
		<span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:green"></span>
	<?php }else{ ?>
		<span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red"></span>
	<?php } ?>
	</div></td>
	
	<td><div class="margin-top-10 text-center">
	<?php if ($row['id_tienda'] > 0 ){ ?>
		<span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:green"></span>
	<?php }else{ ?>
		<span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red"></span>
	<?php }?>
	</div></td>

	<td><div class="margin-top-10">
	<button class="btn btn-default" onclick="modificar_probador(<?php echo $row['id_probador'] ?>)">modificar</button></div></td>
</tr>