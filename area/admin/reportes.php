<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/carteras_controller.php');

	//require_once('../../system/models/carteras_model.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Generar Reportes</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/reportes.js"></script>
	<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>/assets/css/datatables.min.css">
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/datatables.min.js"></script>

<?php
	require_once('header2.php');
?>
	
	<br><br>
	
	<!-- Links -->
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a class="active">Generar Reportes</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form action="generar_reporte.php" method="post">
			<h2>Generar Reportes</h2>

			<div class="f_item">
				<label>Fecha de Inicio: <span>*</span></label>

				<input type="date" id="fecha_inicio" name="fecha_inicio" class="f_input_date" required value="<?php echo $fecha_inicio; ?>">
			</div>

			<div class="f_item">
				<label>Fecha Final:</label>

				<input type="date" id="fecha_final" name="fecha_final" class="f_input_date" value="<?php echo $fecha_final; ?>">
			</div>

			<div class="f_item">
				<label>Carteras: <span>*</span></label>

				<select id="id_cartera" name="id_cartera" class="f_select">
					<option value="0">Todas las carteras</option>

					<?php
						$Carteras_Controller = new Carteras_Controller();

						$arrayCarteras = $Carteras_Controller->select_all();

						if($arrayCarteras != null){
							for($i = 0; $i < sizeof($arrayCarteras); $i++){
								if($id_cartera == $arrayCarteras[$i]['id_cartera']){
									echo '<option value="' . $arrayCarteras[$i]['id_cartera'] . '" selected>' . $arrayCarteras[$i]['nombre_cartera'] . '</option>';
								}else{
									echo '<option value="' . $arrayCarteras[$i]['id_cartera'] . '">' . $arrayCarteras[$i]['nombre_cartera'] . '</option>';
								}
							}
						}
					?>
				</select>
			</div>

			<div class="f_item">
				<label>Tipo de Reporte: <span>*</span></label>

				<select id="tipo_reporte" name="tipo_reporte" class="f_select">
					<option value="all">Toda la información</option>
					<option value="Gestiones">Gestiones</option>
					<option value="Deudas">Deudas</option>
					<option value="Promesas de Pago">Promesas de Pago</option>
					<option value="Procesos Judiciales">Procesos Judiciales</option>
				</select>
			</div>

			<!-- btn -->
			<div class="f_btn">
				<input type="submit" id="btn_progreso_empleados" name="btn_progreso_empleados" class="f_input_btn" value="Generar Reporte">
			</div>
		</form>
	</section>

<?php
	/**
	 * footer
	*/
	require_once('footer.php');
?>