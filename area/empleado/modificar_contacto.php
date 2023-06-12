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

	<title>Actualizar Contacto</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/contactos.js"></script>

<?php
	require_once('header2.php');

	/**
	 * Comprobación de datos necesarios
	*/
	if(isset($_GET['id_contacto'])){
		$Contactos_Controller = new Contactos_Controller();
		$Contacto = $Contactos_Controller->select_by_id(strip_tags($_GET['id_contacto']));

		if($Contacto != null){
			$Clientes_Controller = new Clientes_Controller();
			$Cliente = $Clientes_Controller->select_by_id($Contacto->get_dui());

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
			<a href="<?php echo PATH;?>/area/empleado/cliente/<?php echo $Contacto->get_dui(); ?>"><?php echo $Cliente->get_nombre_completo(); ?></a>
			<a class="active">Actualizar Contacto</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Actualizar Contacto</h2>

            <div class="f_item">
				<label>ID del Contacto: <span>*</span></label>

				<input type="number" id="id_contacto_u" class="f_input_number readonly" readonly="readonly" value="<?php echo $Contacto->get_id_contacto(); ?>">
			</div>

			<div class="f_item">
				<label>Nombre Completo: <span>*</span></label>

				<input type="text" id="nombre_completo_u" class="f_input_text" value="<?php echo $Contacto->get_nombre_completo(); ?>">
			</div>

			<div class="f_item">
				<label>Dirección: <span>*</span></label>

				<textarea id="direccion_u" class="f_textarea" rows="5"><?php echo $Contacto->get_direccion(); ?></textarea>
			</div>

			<div class="f_item">
				<label>Teléfono: <span>*</span></label>

				<input type="text" id="telefono_u" class="f_input_text" value="<?php echo $Contacto->get_telefono(); ?>">
			</div>

			<div class="f_item">
				<label>Parentezco:</label>

				<input type="text" id="parentezco_u" class="f_input_text" value="<?php echo $Contacto->get_parentezco(); ?>">
			</div>

			<div class="f_item">
				<label>Trabajo: </label>

				<input type="text" id="trabajo_u" class="f_input_text" value="<?php echo $Contacto->get_trabajo(); ?>">
			</div>

			<div class="f_item">
				<label>Dirección de Trabajo:</label>

				<textarea id="direccion_trabajo_u" class="f_textarea" rows="5"><?php echo $Contacto->get_direccion_trabajo(); ?></textarea>
			</div>

			<div class="f_item">
				<label>Teléfono de Trabajo:</label>

				<input type="text" id="telefono_trabajo_u" class="f_input_text" value="<?php echo $Contacto->get_telefono_trabajo(); ?>">
			</div>

			<div class="f_item">
				<label>Tipo de Contacto:</label>

				<select id="tipo_contacto_u" class="f_select">
					<option value="Contacto" <?php echo $Contacto->get_tipo_contacto() == 'Contacto' ? 'selected' : ''; ?>>Contacto</option>
					<option value="Referencia Familiar" <?php echo $Contacto->get_tipo_contacto() == 'Referencia Familiar' ? 'selected' : ''; ?>>Referencia Familiar</option>
					<option value="Referencia Personal" <?php echo $Contacto->get_tipo_contacto() == 'Referencia Personal' ? 'selected' : ''; ?>>Referencia Personal</option>
				</select>
			</div>
		
			<div class="f_item">
				<label>DUI del cliente:</label>

				<input type="number" id="dui_u" class="f_input_number readonly" readonly="readonly" value="<?php echo $Contacto->get_dui(); ?>">
			</div>

			<div class="f_btn">
				<input type="button" id="btn_actualizar_contacto" class="f_input_btn" value="Actualizar Contacto">
			</div>
		</form>
	</section>

    <?php
			}else{
				$error404 = 'Este usuario no tiene permisos para modificar a este contacto de esta cartera.';

				require_once('404.php');
			}
		}else{
			$error404 = 'No se encontró ningún resultado para éste id de contacto: ' . $_GET['id_contacto'];

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