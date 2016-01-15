<div class="col-md-9 border-shadow nopadding margin-top-10" id="div-producto-imagenes">
	<div  style="background:#cfcfcf">
		<span class="glyphicon glyphicon-picture" style="margin-left:10px"></span>
		<span style="font-size:20px">Imagenes</span>
		<span class="badge">0</span>
	</div>

	<div class="padding-10">
		<div class="row margin-top-20">
			<div class="col-sm-4">
				<label>Seleccione una imagen para subir</label>
			</div>
			<div class="col-sm-8">
				<div class="upload-contenedor">
					<input type="file" accept="image/x-png, image/gif, image/jpeg" id="file-img-producto" >
				</div>
			</div>
		</div>

		<div class="container-fluid margin-top-20 img-producto-dinamico">
			<div class="col-sm-4">
				
			</div>
			<div class="col-sm-5">
				<div class="imagen-dinamica-producto">
					<img src="" style="width:200px;height:200px;display:none">
					<button class="btn btn-primary margin-top-30" id="btn-subir-img-producto" onclick="subir_img_producto()">Subir esta imagen</button>
				</div>
			</div>
			<div class="col-sm-3">
				<button class="btn btn-default margin-top-30" id="btn-eliminar-img-previa-producto">Eliminar imagen</button>
			</div>
		</div>
		
		<div class="row margin-top-30">
			<div class="col-sm-4 text-right">
				<label class="text-right">Nombre de imagen</label>
			</div>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="nombre-img-producto">
			</div>
		</div>

		<div class="row margin-top-40">
			<div class="col-sm-2">
				Imagen
			</div>
			<div class="col-sm-2">
				Numero
			</div>
			
			<div class="col-sm-3">
				Nombre de imagen
			</div>
			<div class="col-sm-2">
				Portada
			</div>
			<div class="col-sm-3">
				
			</div>
		</div>
		<div class="aparecedor-img-producto"></div>
	</div>
</div>