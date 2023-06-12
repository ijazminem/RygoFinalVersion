<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/carteras_controller.php');
	require_once('../../system/controllers/usuario_cartera_controller.php');

	require_once('../../system/models/carteras_model.php');
	require_once('../../system/models/usuario_cartera_model.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Agregar Cliente</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/clientes.js"></script>

<?php
	require_once('header2.php');

	/**
	 * Comprobación de datos necesarios
	*/
	if(isset($_GET['id_cartera'])){
		$Carteras_Controller = new Carteras_Controller();
		$Cartera = $Carteras_Controller->select_by_id(strip_tags($_GET['id_cartera']));

		if($Cartera != null){
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
			<a class="active">Agregar Cliente</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Agregar Cliente</h2>

			<!-- Campos -->
			<div class="f_item">
				<label>DUI: <span>*</span></label>

				<input type="number" id="dui" class="f_input_number">
			</div>

			<div class="f_item">
				<label>ID Cliente: <span>*</span></label>

				<input type="number" id="id_cliente" class="f_input_number">
			</div>

			<div class="f_item">
				<label>Nombre Completo: <span>*</span></label>

				<input type="text" id="nombre_completo" class="f_input_text">
			</div>

			<div class="f_item">
				<label>Teléfono:</label>

				<input type="number" id="telefono" class="f_input_number">
			</div>

			<div class="f_item">
				<label>Sexo: <span>*</span></label>

				<select id="sexo" class="f_select">
					<option value="Hombre">Hombre</option>
					<option value="Mujer">Mujer</option>
				</select>
			</div>
			
			<div class="f_item">
				<label>Profesión/ocupación: </label>

				<input type="text" id="profesion" class="f_input_text">
			</div>

			<div class="f_item">
				<label>Fecha de Nacimiento: </label>

				<input type="date" id="fecha_nacimiento" class="f_input_date">
			</div>

			<div class="f_item">
				<label>Dirección:</label>

				<textarea id="direccion" class="f_textarea" rows="5"></textarea>
			</div>

			<div class="f_item">
				<label>Dirección de Trabajo: </label>

				<textarea id="direccion_trabajo" class="f_textarea" rows="5"></textarea>
			</div>

			<div class="f_item">
				<label>Teléfono de Trabajo:</label>

				<input type="number" id="telefono_trabajo" class="f_input_number">
			</div>
			
			<div class="f_item">
				<label>Sueldo:</label>

				<input type="number" id="sueldo" class="f_input_number" min="0" step="0.01">
			</div>

			<div class="f_item">
				<label>Estado: <span>*</span></label>

				<select id="estado" class="f_select">
					<option value="Con Deudas">Con Deudas</option>
					<option value="Información Incompleta">Información Incompleta</option>
					<option value="Localizado">Localizado</option>
					<option value="Localizar">Localizar</option>
					<option value="Promesa de Pago Activa">Promesa de Pago Activa</option>
					<option value="Proceso Judicial Activo">Proceso Judicial Activo</option>
					<option value="Registrado">Registrado</option>
					<option value="Sin Deudas">Sin Deudas</option>
				</select>
			</div>

			<div class="f_item">
				<label>ID de cartera:</label>

				<input type="number" id="id_cartera" class="f_input_number readonly" readonly="readonly" value="<?php echo $Cartera->get_id_cartera(); ?>">
			</div>

			<!-- Botón -->
			<div class="f_btn">
				<input type="button" id="btn_agregar_cliente" class="f_input_btn" value="Crear Cliente">
			</div>
		</form>
	</section>

<?php
			}else{
				$error404 = 'Este usuario no tiene permisos para agregar un nuevo deudor a esta cartera.';

				require_once('404.php');
			}
		}else{
			$error404 = 'No se encontró ningún resultado para ésta cartera de cliente: ' . $_GET['id_cartera'];

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