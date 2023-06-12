<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/carteras_controller.php');
	require_once('../../system/controllers/clientes_controller.php');
	require_once('../../system/controllers/deudas_controller.php');
	require_once('../../system/controllers/gestiones_controller.php');
	require_once('../../system/controllers/proceso_judicial_controller.php');
    require_once('../../system/controllers/usuario_cartera_controller.php');


	require_once('../../system/models/carteras_model.php');
	require_once('../../system/models/clientes_model.php');
	require_once('../../system/models/gestiones_model.php');
	require_once('../../system/models/proceso_judicial_model.php');
    require_once('../../system/models/deudas_model.php');
    require_once('../../system/models/usuario_cartera_model.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Datos de la Deuda</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/clientes.js"></script>
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/deudas.js"></script>
	<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>/assets/css/datatables.min.css">
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/datatables.min.js"></script>

<?php
	require_once('header2.php');

	/**
	 * validar si existe el registro a modificar
	*/
	if(isset($_GET['id_deuda'])){
		$Deudas_Controller = new Deudas_Controller();
		$Deuda = $Deudas_Controller->select_by_id($_GET['id_deuda']);

		if($Deuda != null){
			// Recuperar datos
            $Clientes_Controller = new Clientes_Controller();
            $Cliente = $Clientes_Controller->select_by_id($Deuda->get_dui());
			$Carteras_Controller = new Carteras_Controller();
			$Cartera = $Carteras_Controller->select_by_id($Cliente->get_id_cartera());
            $Usuario_Cartera_Controller = new Usuario_Cartera_Controller();
			$Usuario_Cartera = $Usuario_Cartera_Controller->select_by_id_usuario_id_cartera($CurrentUser->get_id_usuario(), $Cartera->get_id_cartera());

			if($Usuario_Cartera != null){
?>

	<section id="Title_Page">
		<h1>Datos de la deuda</h1>
	</section>
	
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/empleado/lista_carteras">Lista de Carteras</a>
			<a href="<?php echo PATH; ?>/area/empleado/cartera/<?php echo $Cartera->get_id_cartera(); ?>"><?php echo $Cartera->get_nombre_cartera(); ?></a>
			<a href="<?php echo PATH; ?>/area/empleado/lista_clientes/<?php echo $Cartera->get_id_cartera(); ?>">Lista de Clientes</a>
            <a href="<?php echo PATH; ?>/area/empleado/cliente/<?php echo $Cliente->get_dui(); ?>"><?php echo $Cliente->get_nombre_completo(); ?></a>
            <a class="active">Deuda #<?php echo $Deuda->get_id_deuda(); ?></a>
			
		</div>
	</section>

	<section class="Content_Info">
		<div class="ci_content">
			<h2>Datos de la deuda</h2>

			<div class="cic_items">
				<!-- Campos -->
				<div class="cic_item">
					<p><b>ID:</b> <?php echo $Deuda->get_id_deuda(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Número de Factura:</b> <?php echo $Deuda->get_numero_factura(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Total de la Deuda:</b> $<?php echo $Deuda->get_total_deuda(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Valor de las Cuotas:</b> $<?php echo $Deuda->get_valor_cuotas(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Número de Cuotas:</b> <?php echo $Deuda->get_numero_cuotas(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Última Fecha de Pago:</b> <?php echo $Deuda->get_ultima_fecha_pago(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Día de Pago:</b> <?php echo $Deuda->get_dia_pago(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Número de Cuotas Pendientes:</b> <?php echo $Deuda->get_numero_cuotas_pendientes(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Total Pendiente:</b> $<?php echo $Deuda->get_total_pendiente(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Número de Cuotas Pagadas:</b> <?php echo $Deuda->get_numero_cuotas_pagadas(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Total Pagado:</b> $<?php echo $Deuda->get_total_pagado(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Porcentaje de Mora:</b> <?php echo $Deuda->get_porcentaje_mora(); ?>%</p>
				</div>

				<div class="cic_item">
					<p><b>Valor de la Mora:</b> $<?php echo $Deuda->get_valor_mora(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Número de Cuotas con Mora:</b> <?php echo $Deuda->get_numero_cuotas_mora(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Total de la Mora:</b> $<?php echo $Deuda->get_total_mora(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Total de la Deuda + Mora:</b> $<?php echo $Deuda->get_total_deuda_mora(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Fecha de Registro:</b> <?php echo $Deuda->get_fecha_registro(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Id Empleado:</b> <?php echo $Deuda->get_id_usuario(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>DUI del cliente:</b> <?php echo $Deuda->get_dui(); ?></p>
				</div>
			</div>
		</div>
	</section>
    
<?php

            }else{
                $error404 = 'Este usuario no tiene permisos para ver esta información.';

                require_once('404.php');
            }
		}else{
			$error404 = 'No se encontró ningún resultado para éste id de deuda: ' . $_GET['id_deuda'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el id de la deuda.';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>