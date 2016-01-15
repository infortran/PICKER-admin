<div class="titulo-tienda col-md-12">Panel KPI</div>

<div class="scrollable col-md-12" id="div-kpi" style="background:#efefef">
	<div class="row">
		<div class="col-sm-10 border-shadow col-sm-offset-1"  style="background:#fff">

		<?php
			$mes = '';
			$mes_num = date("n");
			switch($mes_num){
				case 1: $mes = 'Enero';
				break;
				case 2: $mes = 'Febrero';
				break;
				case 3: $mes = 'Marzo';
				break;
				case 4: $mes = 'Abril';
				break;
				case 5: $mes = 'Mayo';
				break;
				case 6: $mes = 'Junio';
				break;
				case 7: $mes = 'Julio';
				break;
				case 8: $mes = 'Agosto';
				break;
				case 9: $mes = 'Septiembre';
				break;
				case 10: $mes = 'Octubre';
				break;
				case 11: $mes = 'Noviembre';
				break;
				case 12: $mes = 'Diciembre';
				break;
				default: $mes = 'Error';
			}
		?>
			<span style="font-size:30px"><?php echo $mes ?> de 2015</span>
			<button class="btn btn-default pull-right margin-top-5">Ver</button>
			<input type="date" class="pull-right margin-top-10" style="margin-right:10px">
		</div>
	</div>

	<div class="container-fluid margin-top-20 nopadding">

		<!--SECTION-->
		<div class="col-sm-9">

			<!--GRAFICO VENTAS PICKER-->
			<div class="row modulo-kpi"  style="background:#fff">
				<div class="container-fluid fondo-gris-claro">
					<div class="col-sm-10">Ventas PICKER</div>
					<div class="col-sm-2">
						<span class="glyphicon glyphicon-refresh pull-right" aria-hidden="true"></span>
					</div>
				</div>
				<div class="col-sm-12">
					
					<div id="canvas-holder">
						<canvas id="chart-area" width="750" height="300"></canvas>
					</div>
					
					<script type="text/javascript">var data = {
							labels: ["1", "7", "15", "24", "30",],
							datasets: [
							{
								label: "My First dataset",
								fillColor: "rgba(220,220,220,0.2)",
								strokeColor: "rgba(220,220,220,1)",
								pointColor: "rgba(220,220,220,1)",
								pointStrokeColor: "#fff",
								pointHighlightFill: "#fff",
								pointHighlightStroke: "rgba(220,220,220,1)",
								data: [65, 59, 80, 81, 56]
							},
							{
								label: "My Second dataset",
								fillColor: "rgba(151,187,205,0.2)",
								strokeColor: "rgba(151,187,205,1)",
								pointColor: "rgba(151,187,205,1)",
								pointStrokeColor: "#fff",
								pointHighlightFill: "#fff",
								pointHighlightStroke: "rgba(151,187,205,1)",
								data: [28, 48, 40, 19, 86]
							}
							]
};
						var ctx = document.getElementById("chart-area").getContext("2d");
						window.myPie = new Chart(ctx).Line(data);
					</script>
					

				</div>
					
				
			</div>
			
			<!--TOTALES-->
			<div class="row modulo-kpi" style="background:#fff">
				<div class="container-fluid  fondo-gris-claro">
					<div class="col-sm-10">Totales</div>
					<div class="col-sm-2">
						<span class="glyphicon glyphicon-refresh"></span>
					</div>
				</div>
				<div class="col-sm-6 text-center" style="border-right:1px solid #dfdfdf">
					<div class="margin-top-20" style="font-size:20px">Total Ganado con picker</div>
					<div style="font-size:40px">$<?php echo $total_picker ?></div>
				</div>
				<div class="col-sm-6 text-center">
					<div class="margin-top-20" style="font-size:20px">Total Ganado sin picker</div>
					<div style="font-size:40px">$<?php echo $total_no_picker ?></div>
				</div>
			</div>
			
			<!--TOP 10-->
			<div class="row height-300 modulo-kpi" style="background:#fff">
				<div class="container-fluid fondo-gris-claro">
					<div class="col-sm-10">TOP 10</div>
					<div class="col-sm-2">
						<span class="glyphicon glyphicon-refresh"></span>
					</div>
				</div>
				<div class="container-fluid">
					
						<div class="btn-group btn-group-justified margin-top-20" role="group" aria-label="..." >
							<div class="btn-group" role="group">
								<button class="btn btn-default">+ recientes</button>
							</div>

							<div class="btn-group" role="group">
								<button class="btn btn-default">+ Vendidos</button>
							</div>

							<div class="btn-group" role="group">
								<button class="btn btn-default">+ Vistos</button>
							</div>

							<div class="btn-group" role="group">
								<button class="btn btn-default">+ Buscados</button>
							</div>
							
							
						</div>
					
				</div>
			</div>
		</div>



		<!--ASIDE-->
		<div class="col-sm-3" style="background:#fff">
			<div class="row" >
				<div class="container-fluid fondo-gris-claro">
					<div class="col-sm-10">Resumen</div>
					<div class="col-sm-2">
						<span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
					</div>
				</div>

			</div>
			<div class="row resumenes">
				<div class="col-sm-9 margin-top-15" style="font-size:18px">
					Pickers Activos
				</div>
				<div class="col-sm-2 nopadding nro-resumenes">
					<?php echo $pickers_activos ?>
				</div>
			</div>

			<div class="row resumenes">
				<div class="col-sm-9 margin-top-5" style="font-size:18px">
					Productos rechazados
				</div>
				<div class="col-sm-2 nopadding nro-resumenes">
					10
				</div>
			</div>

			<div class="row resumenes">
				<div class="col-sm-9 margin-top-5" style="font-size:18px">
					Productos fuera de stock
				</div>
				<div class="col-sm-2 nopadding nro-resumenes">
					<?php echo $productos_fuera_stock ?>
				</div>
			</div>

			<div class="border-shadow nopadding">
				<div class="container-fluid fondo-gris-claro">
					Clientes
				</div>
				<div class="container-fluid padding-10" style="border-bottom:1px solid #afafaf">
					<div class="col-sm-9">Nuevos</div>
					<div class="col-sm-2" style="font-size:20px">2</div>
				</div>
				<div class="container-fluid padding-10">
					<div class="col-sm-9">Total</div>
					<div class="col-sm-2" style="font-size:20px">563</div>
				</div>
			</div>
			<div class="border-shadow nopadding">
				<div class="container-fluid fondo-gris-claro">
					Rating PICKER
				</div>
				<div class="container-fluid padding-10" >
					<div class="col-sm-2">
						<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</div>
					<div class="col-sm-2">
						<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</div>
					<div class="col-sm-2">
						<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</div>
					<div class="col-sm-2">
						<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</div>
					<div class="col-sm-2">
						<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
					</div>
					
				</div>
				
			</div>
			<div class="border-shadow nopadding">
				<div class="container-fluid fondo-gris-claro">
					Vendedores
				</div>

				<div class="container-fluid nopadding" style="border-bottom:1px solid #cfcfcf">
					<div class="col-sm-8" style="font-size:17px;margin-left:0">
						Aprueban PICKER
					</div>
					<div class="col-sm-3 nopadding margin-top-5" style="font-size:25px">
						20/35
					</div>
				</div>
				
				
			</div>
		</div>
	</div>
</div>
