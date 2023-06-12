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

	<title>Agregar Proceso Judicial</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/proceso_judicial.js"></script>

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
			<a href="<?php echo PATH;?>/area/empleado/cliente/<?php echo $Cliente->get_dui(); ?>"><?php echo $Cliente->get_nombre_completo(); ?></a>
			<a class="active">Agregar Proceso Judicial</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form>
			<h2>Agregar Proceso Judicial</h2>

			<!-- Campos -->
			<div class="f_item">
				<label>Descripción: <span>*</span></label>
				
				<textarea id="descripcion" class="f_textarea" rows="5"></textarea>
			</div>

			<div class="f_item">
				<label>DUI del cliente:<span></span></label>

				<input type="number" id="dui" class="f_input_number readonly" readonly="readonly" value="<?php echo $Cliente->get_dui(); ?>">
			</div>

			<!-- Botón -->
			<div class="f_btn">
				<input type="button" id="btn_agregar_proceso" class="f_input_btn" value="Agregar Proceso">
			</div>
		</form>
	</section>

  <?php
            }else{
                $error404 = 'Este usuario no tiene permisos para agregar un nuevo proceso judicial a esta cartera.';

                require_once('404.php');
            }
            }else{
                $error404 = 'Este usuario no tiene permisos para ver el detalle de cartera.';

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