<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/carteras_controller.php');
	require_once('../../system/controllers/clientes_controller.php');

	require_once('../../system/models/carteras_model.php');
	require_once('../../system/models/clientes_model.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Agregar Deuda</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/deudas.js"></script>

<?php
	require_once('header2.php');

	/**
	 * Comprobación de datos necesarios
	*/
	if(isset($_GET['dui'])){
		$Clientes_Controller = new Clientes_Controller();
		$Cliente = $Clientes_Controller->select_by_id(strip_tags($_GET['dui']));

		if($Cliente != null){
			// Recuperar datos
			$Carteras_Controller = new Carteras_Controller();
			$Cartera = $Carteras_Controller->select_by_id($Cliente->get_id_cartera());
?>

<br><br>
	
	<!-- Links -->
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_carteras">Lista de Carteras</a>
			<a href="<?php echo PATH; ?>/area/admin/cartera/<?php echo $Cartera->get_id_cartera(); ?>"><?php echo $Cartera->get_nombre_cartera(); ?></a>
			<a href="<?php echo PATH; ?>/area/admin/lista_clientes/<?php echo $Cartera->get_id_cartera(); ?>">Lista de Clientes</a>
			<a href="<?php echo PATH;?>/area/admin/cliente/<?php echo $Cliente->get_dui(); ?>"><?php echo $Cliente->get_nombre_completo(); ?></a>
			<a class="active">Agregar Deuda</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Agregar Deuda</h2>

			<!-- Campos -->
			<div class="f_item">
				<label>Número de Factura:</label>

				<input type="text" id="numero_factura" class="f_input_text">
			</div>

			<div class="f_item">
				<label>Total de la Deuda: <span>*</span></label>

				<input type="number" id="total_deuda" class="f_input_number" min="1" step="0.01">
			</div>

			<div class="f_item">
				<label>Valor de la Cuota: <span>*</span></label>

				<input type="number" id="valor_cuotas" class="f_input_number" min="1" step="0.01">
			</div>

			<div class="f_item">
				<label>Número de Cuotas: <span>*</span></label>

				<input type="number" id="numero_cuotas" class="f_input_number" min="1" step="1">
			</div>

			<div class="f_item">
				<label>Última Fecha de Pago: <span>*</span></label>

				<input type="date" id="ultima_fecha_pago" class="f_input_date">
			</div>

			<div class="f_item">
				<label>Día de Pago:</label>

				<input type="number" id="dia_pago" class="f_input_number" min="1" step="1" max="31">
			</div>

			<div class="f_item">
				<label>Número de Cuotas Pendientes:</label>

				<input type="number" id="numero_cuotas_pendientes" class="f_input_number" min="1" step="1">
			</div>

			<div class="f_item">
				<label>Total de Cuotas Pendientes:</label>

				<input type="number" id="total_pendiente" class="f_input_number" min="1" step="0.01">
			</div>

			<div class="f_item">
				<label>Número de Cuotas Pagadas:</label>

				<input type="number" id="numero_cuotas_pagadas" class="f_input_number" min="1" step="1">
			</div>

			<div class="f_item">
				<label>Total de Cuotas Pagadas:</label>

				<input type="number" id="total_pagado" class="f_input_number" min="1" step="0.01">
			</div>

			<div class="f_item">
				<label>Porcentaje de Mora:</label>

				<input type="number" id="porcentaje_mora" class="f_input_number" min="1" step="0.01">
			</div>

			<div class="f_item">
				<label>Valor de la Mora: <span>*</span></label>

				<input type="number" id="valor_mora" class="f_input_number" min="1" step="0.01">
			</div>

			<div class="f_item">
				<label>Número de Cuotas con Mora:</label>

				<input type="number" id="numero_cuotas_mora" class="f_input_number" min="1" step="1">
			</div>

			<div class="f_item">
				<label>Total de Mora:</label>

				<input type="number" id="total_mora" class="f_input_number" min="1" step="0.01">
			</div>

			<div class="f_item">
				<label>Total de la Deuda Actual + Mora: <span>*</span></label>

				<input type="number" id="total_deuda_mora" class="f_input_number" min="1" step="0.01">
			</div>
		
			<div class="f_item">
				<label>DUI del cliente:</label>

				<input type="number" id="dui" class="f_input_number readonly" readonly="readonly" value="<?php echo $Cliente->get_dui(); ?>">
			</div>

			<!-- Botón -->
			<div class="f_btn">
				<input type="button" id="btn_agregar_deuda" class="f_input_btn" value="Agregar Deuda">
			</div>
		</form>
	</section>

<?php
		}else{
			$error404 = 'No se encontró ningún resultado para éste dui: ' . $_GET['dui'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el dui del cliente.';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>