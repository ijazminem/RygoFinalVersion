<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/carteras_controller.php');
	require_once('../../system/controllers/clientes_controller.php');
	require_once('../../system/controllers/contactos_controller.php');

	require_once('../../system/models/carteras_model.php');
	require_once('../../system/models/clientes_model.php');
	require_once('../../system/models/contactos_model.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Agregar Contactos</title>
	<!-- validaciones -->

<?php
	require_once('header2.php');

	/**
	 * Comprobación de datos necesarios
	*/
	if(isset($_GET['id_cartera'])){
		$Carteras_Controller = new Carteras_Controller();
		$Cartera = $Carteras_Controller->select_by_id(strip_tags($_GET['id_cartera']));

		if($Cartera != null){
?>

	<!-- Titulo Principal -->
	<section id="Title_Page">
		<h1>Agregar Contactos</h1>
	</section>
	
	<!-- Links -->
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_carteras">Lista de Carteras</a>
			<a href="<?php echo PATH; ?>/area/admin/cartera/<?php echo $Cartera->get_id_cartera(); ?>"><?php echo $Cartera->get_nombre_cartera(); ?></a>
			<a class="active">Agregar Contactos</a>
		</div>
	</section>

	<?php
		if(isset($_FILES['file_csv']) && isset($_POST['parentezco']) && isset($_POST['tipo_contacto']) && isset($_POST['id_cartera']) && isset($_POST['btn_agregar_file'])){
	?>
	
	<section class="Content_Info">
		<div class="ci_content">
			<h2>Información del CSV</h2>

			<div style="max-height: 600px; overflow-y: auto;">

	<?php
			if($_FILES['file_csv']['error'] > 0){
				echo 'No se pudo subir el archivo, inténtelo de nuevo. Si el ereror persiste contacte al desarrollador.';
			}else{
				// log messages
				$contact_registered = 0;
				$contact_not_registered = 0;
				$user_dui_invalid = 0;
				$user_total = 0;
				$empty_field = 0;

				// data
				$parentezco = strip_tags($_POST['parentezco']);
				$tipo_contacto = strip_tags($_POST['tipo_contacto']);
				$id_cartera = (int) strip_tags($_POST['id_cartera']);

				// comprobar archivo
				$name = $_FILES['file_csv']['name'];
				$archivo = explode('.', $name);
				$extension = $archivo[sizeof($archivo)-1];

				if($extension == 'csv'){
					$contentfile = file_get_contents($_FILES['file_csv']['tmp_name']);
					$contentfile = preg_replace('/"/', '', $contentfile);
					$contentfile_lines = explode("\n", $contentfile);

					$Clientes_Controller = new Clientes_Controller();
					$Contactos_Controller = new Contactos_Controller();

					for($i = 1; $i < sizeof($contentfile_lines); $i++){

						if(!empty($contentfile_lines[$i])){

							$user_total++;

						$arrayLine = explode(',', $contentfile_lines[$i]);
		

						// validar el número de dui
						$arrayLine[0] = str_replace('-', '', $arrayLine[0]);

						if(preg_match("/^[0-9]{9}$/", $arrayLine[0])){
							// verificar si no existe este dui ya registrado
							$Cliente = $Clientes_Controller->select_by_id($arrayLine[0]);

							if($Cliente != null){
								if(!empty($arrayLine[1])){
									$Contacto = new Contactos_Model();

									$Contacto->set_nombre_completo($arrayLine[1]);
									$Contacto->set_direccion($arrayLine[2]);

									if($arrayLine[3] == 0 || empty($arrayLine[3])){
										$arrayLine[3] = '';
									}

									$Contacto->set_telefono($arrayLine[3]);

									if(!empty($parentezco)){
										$arrayLine[4] = $parentezco;
									}

									$Contacto->set_parentezco($arrayLine[4]);
									$Contacto->set_trabajo($arrayLine[5]);
									$Contacto->set_direccion_trabajo($arrayLine[6]);

									if($arrayLine[7] == 0 || empty($arrayLine[7])){
										$arrayLine[7] = '';
									}

									$Contacto->set_telefono_trabajo($arrayLine[7]);
									$Contacto->set_tipo_contacto($tipo_contacto);
									$Contacto->set_fecha_registro($FechaActual);
									$Contacto->set_id_usuario($CurrentUser->get_id_usuario());
									$Contacto->set_dui($arrayLine[0]);

									if($Contactos_Controller->insert($Contacto)){
										$contact_registered++;
									}
								}else{
									echo '<p>No se agregó el contacto para la persona con número de DUI: <b>' . $arrayLine[0] . '</b>. El campo viene vacio...</p>';
									$empty_field++;
								}
							}else{
								echo '<p>No se agregó el contacto para la persona con número de DUI: <b>' . $arrayLine[0] . '</b>. Éste DUI no existe en la base de datos...</p>';
								$contact_not_registered++;
							}
						}else{
							if(sizeof($arrayLine) > 1){
								echo '<p>No se agregó porque el número de DUI: <b>' . $arrayLine[0] . '</b> del Deudor no es válido...</p>';
							}

							$user_dui_invalid++;
						}

						}
						
					}

					echo '<br><br><p>Total de contactos registrados: <b>' . $contact_registered . '</b></p>';
					echo '<p>Total de contactos no registrados porque no se encontró un registro de DUI: <b>' . $contact_not_registered . '</b></p>';
					echo '<p>Total de contactos no registrados porque el número de DUI no es válido: <b>' . $user_dui_invalid . '</b></p>';
					echo '<p>Total de contactos no registrados porque los campos vienen vacios: <b>' . $empty_field . '</b></p>';
					echo '<p>Total de contactos del CSV: <b>' . $user_total . '</b></p>';
				}else{
					echo 'El archivo no es un documento csv, por favor agregue un archivo válido.';
				}
			}
	?>
			</div>
		</div>
	</section>

	<?php
		}
	?>

	<section class="Content_Info">
		<div class="ci_content">
			<h2>Información del Archivo</h2>

			<p><b>Si se tiene los contactos en un archivo de excel, convertirlo a un archivo .csv, separando los atributos por comas.</b></p><br>

			<p><b>Esto se obtiene en excel de la siguiente forma:</b></p>

			<p>1- Teniendo la hoja de excel donde se encuentran los contactos seleccionar la ficha "Archivo".</p>
			<p>2- Seleccionar la opción "Guardar Como".</p>
			<p>3- Se mostrará la ventana para elegir donde guardar el archivo,donde en la opción "Tipo" debemos elegir "CSV (delimitado por comas)".</p>
			<p>4- Al presionar "Guardar" Excel nos advertirá que el formato seleccionado no es compatible con múltiples hojas, debemos presionar el botón "Aceptar".</p>
			<p>5- Luego nos preguntara si deseamos mantener el formato del libro a lo que debemos responder que si.</p>

			<br>
			<hr>
			<br>

			<p><b>Ejemplo:</b></p>

			<p>DUI,NombreCompleto,Dirección,Teléfono,Parentezco,Trabajo,DirecciónDeTrabajo,TeléfonoDeTrabajo</p>
			
			<p>123456789,José Morales,San Salvador - San Martín,77777777,Papá,Doctor,San Salvador - San Salvador,77777777</p>
			
			<p>987654321,Lidia Blanco,Cuscatlán - San Bartolomé Perulapía,77777777,Hija,Maestra,Cuscatlán - Cojutepeque,77777777</p>
			
			<p>963852741,Teresa Molina,Cuscatlán - Suchitoto,77777777,Conyuge,Empleada,Cuscatlán - San José Guayabal,77777777</p>
			
			<p>147258369,Kimberly Chacón,San Salvador - Soyapango,77777777,Conocida,Programadora,San Salvador - San Salvador,77777777</p>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form action="" method="post" enctype="multipart/form-data">
			<h2>Agregar Contacto</h2>

			<!-- Campos -->
			<div class="f_item">
				<label>Archivo CSV: <span>*</span></label>

				<input type="file" id="file_csv" name="file_csv" class="f_input_file" required>
			</div>

			<div class="f_item">
				<label>Parentezco (Agregue un parentezco para todos los datos a subir):</label>

				<input type="text" id="parentezco" name="parentezco" class="f_input_text">
			</div>

			<div class="f_item">
				<label>Tipo de Contacto: <span>*</span></label>

				<select id="tipo_contacto" name="tipo_contacto" class="f_select">
					<option value="Contacto">Contacto</option>
					<option value="Referencia Familiar">Referencia Familiar</option>
					<option value="Referencia Personal">Referencia Personal</option>
				</select>
			</div>

			<div class="f_item">
				<label>ID de Cartera:</label>

				<input type="number" id="id_cartera" name="id_cartera" class="f_input_number readonly" readonly="readonly" value="<?php echo $Cartera->get_id_cartera(); ?>" required>
			</div>

			<!-- Botón -->
			<div class="f_btn">
				<input type="submit" id="btn_agregar_file" name="btn_agregar_file" class="f_input_btn" value="Subir CSV">
			</div>
		</form>
	</section>

<?php
		}else{
			$error404 = 'No se encontró ningún resultado para este id de cartera: ' . $_GET['id_cartera'];

			require_once('404.php');
		}
	}else{
		$error404 = 'No se encontró el id de la cartera.';

		require_once('404.php');
	}

	/**
	 * footer
	*/
	require_once('footer.php');
?>