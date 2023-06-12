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

	<title>Agregar Deudores</title>
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
                $Usuario_Cartera_Controller = new Usuario_Cartera_Controller();
                $Usuario_Cartera = $Usuario_Cartera_Controller->select_by_id_usuario_id_cartera($CurrentUser->get_id_usuario(), $Cartera->get_id_cartera());
    
                if($Usuario_Cartera != null){
?>

	<!-- Titulo Principal -->
	<section id="Title_Page">
		<h1>Agregar Deudores</h1>
	</section>
	
	<!-- Links -->
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/empleado/lista_carteras">Lista de Carteras</a>
			<a href="<?php echo PATH; ?>/area/empleado/cartera/<?php echo $Cartera->get_id_cartera(); ?>"><?php echo $Cartera->get_nombre_cartera(); ?></a>
			<a class="active">Agregar Deudores</a>
		</div>
	</section>

	<?php
		if(isset($_FILES['file_csv']) && isset($_POST['id_cartera']) && isset($_POST['btn_agregar_file'])){
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
				$user_registered = 0;
				$user_not_registered = 0;
				$user_dui_invalid = 0;
				$user_total = 0;

				// data
				$id_cartera = (int) strip_tags($_POST['id_cartera']);

				// comprobar archivo
				$name = $_FILES['file_csv']['name'];// example: archivo.txt
				$archivo = explode('.', $name);// example: array(0 => 'archivo', 1 => 'txt');
				$extension = $archivo[sizeof($archivo)-1];// example: $archivo[2-1] => $archivo[1]

				if($extension == 'csv'){
					$contentfile = file_get_contents($_FILES['file_csv']['tmp_name']);
					$contentfile = preg_replace('/"/', '', $contentfile);
					$contentfile_lines = explode("\n", $contentfile);

					//var_dump($contentfile_lines);
					$Clientes_Controller = new Clientes_Controller();

					for($i = 1; $i < sizeof($contentfile_lines); $i++){

						if(!empty($contentfile_lines[$i])){

							$user_total++;

						$arrayLine = explode(',', $contentfile_lines[$i]);

						// validar el número de dui
						$arrayLine[0] = str_replace('-', '', $arrayLine[0]);

						if(preg_match("/^[0-9]{9}$/", $arrayLine[0]) && $arrayLine[0] != '000000000'){
							// verificar si no existe este dui ya registrado
							$Cliente = $Clientes_Controller->select_by_id($arrayLine[0]);

							if($Cliente != null){
								echo '<p>La persona con número de DUI: <b>' . $arrayLine[0] . '</b> y nombre: <b>' . $arrayLine[2] . '</b> ya existe en la base de datos...</p>';
								$user_not_registered++;
							}else{
								$Cliente = new Clientes_Model();
								$Cliente->set_dui($arrayLine[0]);
								$Cliente->set_id_cliente($arrayLine[1]);
								$Cliente->set_nombre_completo($arrayLine[2]);

								if($arrayLine[3] == 0 || empty($arrayLine[3])){
									$arrayLine[3] = '';
								}

								$Cliente->set_telefono($arrayLine[3]);
								$Cliente->set_sexo($arrayLine[4]);
								$Cliente->set_profesion($arrayLine[5]);
								if(preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/",$arrayLine[6])){
									$date = explode('/', $arrayLine[6]);
									$new_date = $date[2] . '-' . $date[1] . '-' . $date[0];
									$Cliente->set_fecha_nacimiento($new_date);
								}
								$Cliente->set_direccion($arrayLine[7]);
								$Cliente->set_direccion_trabajo($arrayLine[8]);

								if($arrayLine[9] == 0 || empty($arrayLine[9])){
									$arrayLine[9] = '';
								}

								$Cliente->set_telefono_trabajo($arrayLine[9]);
								$Cliente->set_sueldo($arrayLine[10]);
								$Cliente->set_estado('Registrado');
								$Cliente->set_fecha_registro($FechaActual);
								$Cliente->set_id_cartera($id_cartera);

								if($Clientes_Controller->insert($Cliente)){
									$user_registered++;
								}
							}	
						}else{
							if(sizeof($arrayLine) > 1){
								echo '<p>La persona con número de DUI: <b>' . $arrayLine[0] . '</b> y nombre: <b>' . $arrayLine[2] . '</b> No se puede ingresar al sistema dedido a que no tiene un número de DUI válido...</p>';
							}

							$user_dui_invalid++;
						}
						}
						
					}

					echo '<br><br><p>Total de usuarios registrados: <b>' . $user_registered . '</b></p>';
					echo '<p>Total de usuarios con DUI repetido: <b>' . $user_not_registered . '</b></p>';
					echo '<p>Total de usuarios con DUI no válido: <b>' . $user_dui_invalid . '</b></p>';
					echo '<p>Total de usuarios del CSV: <b>' . $user_total . '</b></p>';
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

			<p><b>Si se tiene la cartera en un archivo de excel, convertirlo a un archivo .csv, separando los atributos por comas.</b></p><br>

			<p><b>Esto se obtiene en excel de la siguiente forma:</b></p>

			<p>1- Teniendo la hoja de excel donde se encuentra la cartera seleccionar la ficha "Archivo".</p>
			<p>2- Seleccionar la opción "Guardar Como".</p>
			<p>3- Se mostrará la ventana para elegir donde guardar el archivo,donde en la opción "Tipo" debemos elegir "CSV (delimitado por comas)".</p>
			<p>4- Al presionar "Guardar" Excel nos advertirá que el formato seleccionado no es compatible con múltiples hojas, debemos presionar el botón "Aceptar".</p>
			<p>5- Luego nos preguntara si deseamos mantener el formato del libro a lo que debemos responder que si.</p>

			<br>
			<hr>
			<br>

			<p><b>Ejemplo:</b></p>

			<p>DUI,CodigoCliente,NombreCompleto,Teléfono,Sexo,Profesión,FechaDeNacimiento,Dirección,DirecciónDeTrabajo,TeléfonoDeTrabajo,Sueldo</p>
			<p>123456789,15645487,Juan Carlos Rivera,77777777,Hombre,Doctor,01/12/2023,San Salvador - San Martín,San Salvador - San Salvador,77777777,600.00</p>
			<p>987654321,14415451,Ana Lidia Espinoza,77777777,Mujer,Maestra,01/12/2023,Cuscatlán - San Bartolomé Perulapía,Cuscatlán - Cojutepeque,77777777,360.00</p>
			<p>963852741,54145639,Yenny de la Rosa,77777777,Mujer,Empleada,01/12/2023,Cuscatlán - Suchitoto,Cuscatlán - San José Guayabal,77777777,360.00</p>
			<p>147258369,21225254,Julio Ricardo Pérez,77777777,Hombre,Programador,01/12/2023,San Salvador - Soyapango,San Salvador - San Salvador,77777777,800.00</p>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form action="" method="post" enctype="multipart/form-data">
			<h2>Agregar Deudores</h2>

			<!-- Campos -->
			<div class="f_item">
				<label>Archivo CSV: <span>*</span></label>

				<input type="file" id="file_csv" name="file_csv" class="f_input_file" required>
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
            $error404 = 'Este usuario no tiene permisos para agregar un nuevo deudor a esta cartera.';

            require_once('404.php');
        }
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