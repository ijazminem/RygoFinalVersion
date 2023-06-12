<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/carteras_controller.php');
	require_once('../../system/controllers/clientes_controller.php');
	require_once('../../system/controllers/contactos_controller.php');
    require_once('../../system/controllers/usuario_cartera_controller.php');


	require_once('../../system/models/carteras_model.php');
	require_once('../../system/models/clientes_model.php');
    require_once('../../system/models/contactos_model.php');
    require_once('../../system/models/usuario_cartera_model.php');

    
	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Datos del Contacto</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/contactos.js"></script>
	<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>/assets/css/datatables.min.css">
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/datatables.min.js"></script>

<?php
	require_once('header2.php');

	/**
	 * validar si existe el registro a modificar
	*/
	if(isset($_GET['id_contacto'])){
		$Contactos_Controller = new Contactos_Controller();
		$Contacto = $Contactos_Controller->select_by_id($_GET['id_contacto']);

		if($Contacto != null){
			// Recuperar datos
            $Clientes_Controller = new Clientes_Controller();
            $Cliente = $Clientes_Controller->select_by_id($Contacto->get_dui());
			$Carteras_Controller = new Carteras_Controller();
			$Cartera = $Carteras_Controller->select_by_id($Cliente->get_id_cartera());
            $Usuario_Cartera_Controller = new Usuario_Cartera_Controller();
			$Usuario_Cartera = $Usuario_Cartera_Controller->select_by_id_usuario_id_cartera($CurrentUser->get_id_usuario(), $Cartera->get_id_cartera());

			if($Usuario_Cartera != null){
            
?>

	<section id="Title_Page">
		<h1>Datos del contacto</h1>
	</section>
	
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/empleado/">Home</a>
			<a href="<?php echo PATH; ?>/area/empleado/lista_carteras">Lista de Carteras</a>
			<a href="<?php echo PATH; ?>/area/empleado/cartera/<?php echo $Cartera->get_id_cartera(); ?>"><?php echo $Cartera->get_nombre_cartera(); ?></a>
			<a href="<?php echo PATH; ?>/area/empleado/lista_clientes/<?php echo $Cartera->get_id_cartera(); ?>">Lista de Clientes</a>
            <a href="<?php echo PATH; ?>/area/empleado/cliente/<?php echo $Cliente->get_dui(); ?>"><?php echo $Cliente->get_nombre_completo(); ?></a>
            <a class="active">Contacto: <?php echo $Contacto->get_nombre_completo(); ?></a>
		</div>
	</section>

	<section class="Content_Info">
		<div class="ci_content">
			<h2>Datos del contacto</h2>

			<div class="cic_items">
				<!-- Campos -->
				<div class="cic_item">
					<p><b>ID:</b> <?php echo $Contacto->get_id_contacto(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Nombre Completo:</b> <?php echo $Contacto->get_nombre_completo(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Dirección:</b> <?php echo $Contacto->get_direccion(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Teléfono:</b> <?php echo $Contacto->get_telefono(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Parentezco:</b> <?php echo $Contacto->get_parentezco(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Trabajo:</b> <?php echo $Contacto->get_trabajo(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Dirección de Trabajo:</b> <?php echo $Contacto->get_direccion_trabajo(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Teléfono del Trabajo:</b> <?php echo $Contacto->get_telefono_trabajo(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Tipo de Contacto:</b> <?php echo $Contacto->get_tipo_contacto(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Fecha de Registro:</b> <?php echo $Contacto->get_fecha_registro(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>Id Empleado:</b> <?php echo $Contacto->get_id_usuario(); ?></p>
				</div>

				<div class="cic_item">
					<p><b>DUI:</b> <?php echo $Contacto->get_dui(); ?></p>
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
			$error404 = 'No se encontró ningún resultado para ésta id de contacto: ' . $_GET['id_contacto'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el id de cartera';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>