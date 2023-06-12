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

	<title>Agregar Deudas</title>
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
		<h1>Agregar Deudas</h1>
	</section>
	
	<!-- Links -->
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a href="<?php echo PATH; ?>/area/admin/lista_carteras">Lista de Carteras</a>
			<a href="<?php echo PATH; ?>/area/admin/cartera/<?php echo $Cartera->get_id_cartera(); ?>"><?php echo $Cartera->get_nombre_cartera(); ?></a>
			<a class="active">Agregar Deudas</a>
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
				$deudas_registered = 0;
				$deudas_not_registered = 0;
				$user_dui_invalid = 0;
				$deudas_total = 0;
				$empty_field = 0;

				// data
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
					$Deudas_Controller = new Deudas_Controller();

					for($i = 1; $i < sizeof($contentfile_lines); $i++){

						if(!empty($contentfile_lines[$i])){
							$deudas_total++;

						$arrayLine = explode(',', $contentfile_lines[$i]);

						// validar el número de dui
						$arrayLine[0] = str_replace('-', '', $arrayLine[0]);

						if(preg_match("/^[0-9]{9}$/", $arrayLine[0])){
							// verificar si no existe este dui ya registrado
							$Cliente = $Clientes_Controller->select_by_id($arrayLine[0]);

							if($Cliente != null){
								if(!empty($arrayLine[1])){
									$Deuda = new Deudas_Model();

									$Deuda->set_numero_factura($arrayLine[1]);
									$Deuda->set_total_deuda($arrayLine[2]);
									$Deuda->set_valor_cuotas($arrayLine[3]);
									$Deuda->set_numero_cuotas($arrayLine[4]);

									if(preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])\/(0[1-9]|1[0-2])\/[0-9]{4}$/",$arrayLine[5])){
										$date = explode('/', $arrayLine[5]);
										$new_date = $date[2] . '-' . $date[1] . '-' . $date[0];
										$Deuda->set_ultima_fecha_pago($new_date);
									}
									$Deuda->set_dia_pago($arrayLine[6]);
									$Deuda->set_numero_cuotas_pendientes($arrayLine[7]);
									$Deuda->set_total_pendiente($arrayLine[8]);
									$Deuda->set_numero_cuotas_pagadas($arrayLine[9]);
									$Deuda->set_total_pagado($arrayLine[10]);
									$Deuda->set_porcentaje_mora($arrayLine[11]);
									$Deuda->set_valor_mora($arrayLine[12]);
									$Deuda->set_numero_cuotas_mora($arrayLine[13]);
									$Deuda->set_total_mora($arrayLine[14]);
									$Deuda->set_total_deuda_mora($arrayLine[15]);
									$Deuda->set_fecha_registro($FechaActual);
									$Deuda->set_id_usuario($CurrentUser->get_id_usuario());
									$Deuda->set_dui($arrayLine[0]);

									if($Deudas_Controller->insert($Deuda)){
										$deudas_registered++;

										$Cliente->set_estado('Con Deudas');
										$Clientes_Controller->update($Cliente);
									}
								}else{
									echo '<p>No se agregó la deuda para la persona con número de DUI: <b>' . $arrayLine[0] . '</b>. El campo viene vacio...</p>';
									$empty_field++;
								}
							}else{
								echo '<p>No se agregó la deuda para la persona con número de DUI: <b>' . $arrayLine[0] . '</b>. Éste DUI no existe en la base de datos...</p>';
								$deudas_not_registered++;
							}
						}else{
							if(sizeof($arrayLine) > 1){
								echo '<p>No se agregó porque el número de DUI: <b>' . $arrayLine[0] . '</b> no es válido...</p>';
							}

							$user_dui_invalid++;
						}

						}
						
					}

					echo '<br><br><p>Total de deudas registradas: <b>' . $deudas_registered . '</b></p>';
					echo '<p>Total de deudas no registradas porque no se encontró un registro de DUI: <b>' . $deudas_not_registered . '</b></p>';
					echo '<p>Total de deudas no registradas porque el número de DUI no es válido: <b>' . $user_dui_invalid . '</b></p>';
					echo '<p>Total de deudas no registradas porque los campos vienen vacios: <b>' . $empty_field . '</b></p>';
					echo '<p>Total de deudas del CSV: <b>' . $deudas_total . '</b></p>';
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

			<p>DUI, NúmeroFactura, TotalDeuda, ValorCuota, NumeroCuotas, UltimaFechaPago, DiaPago, NumeroCuotasPendientes, TotalPendiente, NumeroCuotasPagadas, TotalPagado, PorcentajeMora, ValorMora, NumeroCuotasMora, TotalMora, TotalDeudaActualMasMora</p>
			
			<p>123456789,001,504.00,21.00,24,01/12/2020,1,12,252.00,12,252.00,3,15.12,12,181.44,433.44</p>
			
			<p>987654321,002,864.00,36.00,24,01/12/2021,2,3,108.00,21,756.00,3,25.92,3,77.76,185.76</p>
			
			<p>963852741,003,240.00,10.00,24,01/12/2022,3,1,10.00,23,216.00,3,7.2,21.60,3,64.80,74.80</p>
			
			<p>147258369,004,240.00,10.00,24,01/12/2023,4,1,10.00,23,216.00,3,7.2,21.60,3,64.80,74.80</p>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form action="" method="post" enctype="multipart/form-data">
			<h2>Agregar Deudas</h2>

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