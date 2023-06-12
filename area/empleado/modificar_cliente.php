<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/carteras_controller.php');
    require_once('../../system/controllers/clientes_controller.php');
    require_once('../../system/controllers/usuario_cartera_controller.php');

    require_once('../../system/models/carteras_model.php');
    require_once('../../system/models/clientes_model.php');
    require_once('../../system/models/usuario_cartera_model.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Actualizar Cliente</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/clientes.js"></script>

<?php
	require_once('header2.php');

	/**
	 * Comprobación de datos necesarios
	*/
	if(isset($_GET['dui'])){
		$Clientes_Controller = new Clientes_Controller();
		$Clientes_Model = $Clientes_Controller->select_by_id(strip_tags($_GET['dui']));

		if($Clientes_Model != null){
			// Recuperar datos de la cartera para mostrarlos
			$Carteras_Controller = new Carteras_Controller();
			$Cartera = $Carteras_Controller->select_by_id($Clientes_Model->get_id_cartera());

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
			<a class="active">Actualizar Cliente</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Actualizar Cliente</h2>

			<div class="f_item">
				<label>DUI: </label>

				<input type="number" id="dui_u" class="f_input_number readonly" readonly="readonly" value="<?php echo $Clientes_Model->get_dui(); ?>">
			</div>

            <div class="f_item">
				<label>ID de cliente: <span>*</span></label>

				<input type="number" id="id_cliente_u" class="f_input_number readonly" readonly="readonly" value="<?php echo $Clientes_Model->get_id_cliente(); ?>">
			</div>

			<div class="f_item">
				<label>Nombre Completo: <span>*</span></label>

				<input type="text" id="nombre_completo_u" class="f_input_text" value="<?php echo $Clientes_Model->get_nombre_completo(); ?>">
			</div>

			<div class="f_item">
				<label>Teléfono: <span>*</span></label>

				<input type="number" id="telefono_u" class="f_input_number" value="<?php echo $Clientes_Model->get_telefono(); ?>">
			</div>

			<div class="f_item">
				<label>Sexo: </label>

				<select id="sexo_u" class="f_select">
					<option value="Hombre" <?php echo $Clientes_Model->get_sexo() == 'Hombre' ? 'selected' : ''; ?>>Hombre</option>
					<option value="Mujer" <?php echo $Clientes_Model->get_Sexo() == 'Mujer' ? 'selected' : ''; ?>>Mujer</option>
				</select>
			</div>
			
			<div class="f_item">
				<label>Profesión/ocupación:</label>

				<input type="text" id="profesion_u" class="f_input_text"  value="<?php echo $Clientes_Model->get_profesion(); ?>">
			</div>

			<div class="f_item">
				<label>Fecha de nacimiento: </label>

				<input type="date" id="fecha_nacimiento_u" class="f_input_date" value="<?php echo $Clientes_Model->get_fecha_nacimiento(); ?>">
			</div>

			<div class="f_item">
				<label>Dirección: <span>*</span></label>

				<textarea id="direccion_u" class="f_textarea" rows="5"><?php echo $Clientes_Model->get_direccion(); ?></textarea>
			</div>

			<div class="f_item">
				<label>Dirección de trabajo:</label>

				<textarea id="direccion_trabajo_u" class="f_textarea" rows="5"><?php echo $Clientes_Model->get_direccion_trabajo(); ?></textarea>
			</div>

			<div class="f_item">
				<label>Teléfono de trabajo: </label>

				<input type="number" id="telefono_trabajo_u" class="f_input_number" value="<?php echo $Clientes_Model->get_telefono_trabajo(); ?>">
			</div>
			
			<div class="f_item">
				<label>Sueldo: </label>

				<input type="number" id="sueldo_u" class="f_input_number"  value="<?php echo $Clientes_Model->get_sueldo(); ?>">
			</div>

			<div class="f_item">
				<label>Estado: <span>*</span></label>

				<select id="estado_u" class="f_select">
					<option value="Con Deudas" <?php echo $Clientes_Model->get_estado() == 'Con Deudas' ? 'selected' : ''; ?>>Con Deudas</option>
					<option value="Información Incompleta" <?php echo $Clientes_Model->get_estado() == 'Información Incompleta' ? 'selected' : ''; ?>>Información Incompleta</option>
					<option value="Localizado" <?php echo $Clientes_Model->get_estado() == 'Localizado' ? 'selected' : ''; ?>>Localizado</option>
					<option value="Localizar" <?php echo $Clientes_Model->get_estado() == 'Localizar' ? 'selected' : ''; ?>>Localizar</option>
					<option value="Promesa de Pago Activa" <?php echo $Clientes_Model->get_estado() == 'Promesa de Pago Activa' ? 'selected' : ''; ?>>Promesa de Pago Activa</option>
					<option value="Proceso Judicial Activo" <?php echo $Clientes_Model->get_estado() == 'Proceso Judicial Activo' ? 'selected' : ''; ?>>Proceso Judicial Activo</option>
					<option value="Registrado" <?php echo $Clientes_Model->get_estado() == 'Registrado' ? 'selected' : ''; ?>>Registrado</option>
					<option value="Sin Deudas" <?php echo $Clientes_Model->get_estado() == 'Sin Deudas' ? 'selected' : ''; ?>>Sin Deudas</option>
				</select>
			</div>

			<div class="f_item">
				<label>ID de cartera: <span>*</span></label>
                
                <input type="number" id="id_cartera_u" class="f_input_number readonly" readonly="readonly" value="<?php echo $Clientes_Model->get_id_cartera(); ?>">
			</div>

			<div class="f_btn">
				<input type="button" id="btn_actualizar_cliente" class="f_input_btn" value="Actualizar Cliente">
			</div>			
		</form>
	</section>

<?php
			}else{
				$error404 = 'Este usuario no tiene permisos para modificar a este deudor de esta cartera.';

				require_once('404.php');
			}
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