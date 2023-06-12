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

	<title>Agregar Contacto</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/contactos.js"></script>

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
			<a class="active">Agregar Contacto</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Agregar Contacto</h2>

			<!-- Campos -->
			<div class="f_item">
				<label>Nombre Completo: <span>*</span></label>

				<input type="text" id="nombre_completo" class="f_input_text">
			</div>

			<div class="f_item">
				<label>Dirección: <span>*</span></label>

				<textarea id="direccion" class="f_textarea" rows="5"></textarea>
			</div>

			<div class="f_item">
				<label>Teléfono: <span>*</span></label>

				<input type="text" id="telefono" class="f_input_text">
			</div>

			<div class="f_item">
				<label>Parentezco:</label>

				<input type="text" id="parentezco" class="f_input_text">
			</div>

			<div class="f_item">
				<label>Trabajo: </label>

				<input type="text" id="trabajo" class="f_input_text">
			</div>

			<div class="f_item">
				<label>Dirección de Trabajo:</label>

				<textarea id="direccion_trabajo" class="f_textarea" rows="5"></textarea>
			</div>

			<div class="f_item">
				<label>Teléfono de Trabajo:</label>

				<input type="text" id="telefono_trabajo" class="f_input_text">
			</div>

			<div class="f_item">
				<label>Tipo de Contacto:</label>

				<select id="tipo_contacto" class="f_select">
					<option value="Contacto">Contacto</option>
					<option value="Referencia Familiar">Referencia Familiar</option>
					<option value="Referencia Personal">Referencia Personal</option>
				</select>
			</div>
		
			<div class="f_item">
				<label>DUI del cliente:</label>

				<input type="number" id="dui" class="f_input_number readonly" readonly="readonly" value="<?php echo $Cliente->get_dui(); ?>">
			</div>

			<!-- Botón -->
			<div class="f_btn">
				<input type="button" id="btn_agregar_contacto" class="f_input_btn" value="Agregar Contacto">
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