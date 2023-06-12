<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/carteras_controller.php');
	require_once('../../system/controllers/clientes_controller.php');
    require_once('../../system/controllers/deudas_controller.php');
    require_once('../../system/controllers/usuario_cartera_controller.php');


    require_once('../../system/models/carteras_model.php');
    require_once('../../system/models/clientes_model.php');
    require_once('../../system/models/deudas_model.php');
    require_once('../../system/models/usuario_cartera_model.php');


	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Actualizar Deuda</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/deudas.js"></script>

<?php
	require_once('header2.php');

	/**
	 * Comprobación de datos necesarios
	*/
	if(isset($_GET['id_deuda'])){
		$Deudas_Controller = new Deudas_Controller();
		$Deuda = $Deudas_Controller->select_by_id(strip_tags($_GET['id_deuda']));

		if($Deuda != null){
			$Clientes_Controller = new Clientes_Controller();
			$Cliente = $Clientes_Controller->select_by_id($Deuda->get_dui());

			$Carteras_Controller = new Carteras_Controller();
			$Cartera = $Carteras_Controller->select_by_id($Cliente->get_id_cartera());
            $Usuario_Cartera_Controller = new Usuario_Cartera_Controller();
			$Usuario_Cartera = $Usuario_Cartera_Controller->select_by_id_usuario_id_cartera($CurrentUser->get_id_usuario(), $Cartera->get_id_cartera());

			if($Usuario_Cartera != null){
?>
	
	<br><br>
	
	<!-- Links -->
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/empleado/lista_carteras">Lista de Carteras</a>
			<a href="<?php echo PATH; ?>/area/empleado/cartera/<?php echo $Cartera->get_id_cartera(); ?>"><?php echo $Cartera->get_nombre_cartera(); ?></a>
			<a href="<?php echo PATH; ?>/area/empleado/lista_clientes/<?php echo $Cartera->get_id_cartera(); ?>">Lista de Clientes</a>
			<a href="<?php echo PATH;?>/area/empleado/cliente/<?php echo $Deuda->get_dui(); ?>"><?php echo $Cliente->get_nombre_completo(); ?></a>
			<a class="active">Actualizar Deuda</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Actualizar Deuda</h2>

            <div class="f_item">
				<label>ID de la Deuda: <span>*</span></label>

				<input type="number" id="id_deuda_u" class="f_input_number readonly" readonly="readonly" value="<?php echo $Deuda->get_id_deuda(); ?>">
			</div>

			<div class="f_item">
				<label>Número de Factura:</label>

				<input type="text" id="numero_factura_u" class="f_input_text" value="<?php echo $Deuda->get_numero_factura(); ?>">
			</div>

			<div class="f_item">
				<label>Total de la Deuda: <span>*</span></label>

				<input type="number" id="total_deuda_u" class="f_input_number" min="1" step="0.01" value="<?php echo $Deuda->get_total_deuda(); ?>">
			</div>

			<div class="f_item">
				<label>Valor de la Cuota: <span>*</span></label>

				<input type="number" id="valor_cuotas_u" class="f_input_number" min="1" step="0.01" value="<?php echo $Deuda->get_valor_cuotas(); ?>">
			</div>

			<div class="f_item">
				<label>Número de Cuotas: <span>*</span></label>

				<input type="number" id="numero_cuotas_u" class="f_input_number" min="1" step="1" value="<?php echo $Deuda->get_numero_cuotas(); ?>">
			</div>

			<div class="f_item">
				<label>Última Fecha de Pago: <span>*</span></label>

				<?php
					$fecha_pago = '';

					if(!empty($Deuda->get_ultima_fecha_pago())){
						$fecha_pago = explode(' ', $Deuda->get_ultima_fecha_pago());
						$fecha_pago = $fecha_pago[0];
					}
				?>
				<input type="date" id="ultima_fecha_pago_u" class="f_input_date" value="<?php echo $fecha_pago; ?>">
			</div>

			<div class="f_item">
				<label>Día de Pago:</label>

				<input type="number" id="dia_pago_u" class="f_input_number" min="1" step="1" max="31" value="<?php echo $Deuda->get_dia_pago(); ?>">
			</div>

			<div class="f_item">
				<label>Número de Cuotas Pendientes:</label>

				<input type="number" id="numero_cuotas_pendientes_u" class="f_input_number" min="1" step="1" value="<?php echo $Deuda->get_numero_cuotas_pendientes(); ?>">
			</div>

			<div class="f_item">
				<label>Total de Cuotas Pendientes:</label>

				<input type="number" id="total_pendiente_u" class="f_input_number" min="1" step="0.01" value="<?php echo $Deuda->get_total_pendiente(); ?>">
			</div>

			<div class="f_item">
				<label>Número de Cuotas Pagadas:</label>

				<input type="number" id="numero_cuotas_pagadas_u" class="f_input_number" min="1" step="1" value="<?php echo $Deuda->get_numero_cuotas_pagadas(); ?>">
			</div>

			<div class="f_item">
				<label>Total de Cuotas Pagadas:</label>

				<input type="number" id="total_pagado_u" class="f_input_number" min="1" step="0.01" value="<?php echo $Deuda->get_total_pagado(); ?>">
			</div>

			<div class="f_item">
				<label>Porcentaje de Mora:</label>

				<input type="number" id="porcentaje_mora_u" class="f_input_number" min="1" step="0.01" value="<?php echo $Deuda->get_porcentaje_mora(); ?>">
			</div>

			<div class="f_item">
				<label>Valor de la Mora: <span>*</span></label>

				<input type="number" id="valor_mora_u" class="f_input_number" min="1" step="0.01" value="<?php echo $Deuda->get_valor_mora(); ?>">
			</div>

			<div class="f_item">
				<label>Número de Cuotas con Mora:</label>

				<input type="number" id="numero_cuotas_mora_u" class="f_input_number" min="1" step="1" value="<?php echo $Deuda->get_numero_cuotas_mora(); ?>">
			</div>

			<div class="f_item">
				<label>Total de Mora:</label>

				<input type="number" id="total_mora_u" class="f_input_number" min="1" step="0.01" value="<?php echo $Deuda->get_total_mora(); ?>">
			</div>

			<div class="f_item">
				<label>Total de la Deuda Actual + Mora: <span>*</span></label>

				<input type="number" id="total_deuda_mora_u" class="f_input_number" min="1" step="0.01" value="<?php echo $Deuda->get_total_deuda_mora(); ?>">
			</div>

			<div class="f_item">
				<label>DUI del cliente: <span>*</span></label>
                
                <input type="number" id="dui_u" class="f_input_number readonly" readonly="readonly" value="<?php echo $Deuda->get_dui(); ?>">
			</div>

			<div class="f_btn">
				<input type="button" id="btn_actualizar_deuda" class="f_input_btn" value="Actualizar Deuda">
			</div>
		</form>
	</section>

<?php
			}else{
				$error404 = 'Este usuario no tiene permisos para modificar esta deuda.';

				require_once('404.php');
			}
		}else{
			$error404 = 'No se encontró ningún resultado para éste id de deuda: ' . $_GET['id_deuda'];

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