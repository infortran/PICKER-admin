<tr>
	<td><div class="margin-top-10"><input type="checkbox"></div></td>
	<td><div class="margin-top-10 text-center"><?php echo $row['sku_prod'] ?></div></td>
	<td><img src="<?php echo base_url() ?>assets/img/default-store.png" alt="" style="width:40px;height:40"></td>
	<td><div class="margin-top-10"><?php echo $row['nombre_prod'] ?></div></td>
	<!--td><div class="margin-top-10">referencia</div></td-->
	<td><div class="margin-top-10">categoria</div></td>
	<td><div class="margin-top-10 text-right">$<?php echo $row['precio_venta_prod'] ?></div></td>
	<td><div class="margin-top-10 text-right">$<?php echo $row['precio_venta_iva_prod'] ?></div></td>
	<td><div class="margin-top-10 text-center"><?php echo $row['cantidad_prod'] ?></div></td>
	<td><div class="margin-top-10 text-center">
	<?php if ($row['activo_prod'] == 1 ){ ?>
		<span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:green"></span>
	<?php }else{ ?>
		<span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red"></span>
	<?php }?>
	</div></td>
	<td><div class="margin-top-10">
	<button class="btn btn-default" onclick="ir_modificar_producto(<?php echo $row['id_prod'] ?>)">modificar</button>
	</div></td>

</tr>