<tr>
	<td><img src="<?php echo base_url() ?>assets/uploads/img/<?php echo $row['img_trabajador'] ?>" alt="" style="width:40px;height:40px"></td>	
	<td><?php echo $row['id_trabajador'] ?></td>
	<td><?php echo $row['nombre_trabajador'] ?></td>
	<td><?php echo $row['cargo_trabajador'] ?></td>

	<td><button onclick="loadWorker('<?php echo $row['run_trabajador'] ?>')" 
		class="btn btn-default" 
		data-toggle="modal" 
		data-target="#modalVerTrabajador">detalles</button></td>

		<input type="hidden" value="<?php echo $row['id_trabajador'] ?>">
</tr>