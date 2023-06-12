<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/carteras_controller.php');
	require_once('../../system/controllers/gestiones_controller.php');
	require_once('../../system/controllers/deudas_controller.php');
	require_once('../../system/controllers/estados_controller.php');
	require_once('../../system/controllers/promesas_de_pago_controller.php');
	require_once('../../system/controllers/proceso_judicial_controller.php');
	require_once('../../system/controllers/sub_estados_controller.php');
	require_once('../../system/controllers/usuario_cartera_controller.php');

	require_once('../../system/models/carteras_model.php');
	require_once('../../system/models/estados_model.php');
	require_once('../../system/models/sub_estados_model.php');
	require_once('../../system/models/usuario_cartera_model.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Progreso de Empleados</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/progreso_empleados.js"></script>
	<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>/assets/css/datatables.min.css">
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/datatables.min.js"></script>

<?php
	require_once('header2.php');

	// data
	$fecha_inicio = '';
	$fecha_final = '';
	$id_cartera = 0;
	$id_usuario = 0;

	if(isset($_POST['fecha_inicio'])){
		$fecha_inicio = strip_tags($_POST['fecha_inicio']);
	}

	if(isset($_POST['fecha_final'])){
		$fecha_final = strip_tags($_POST['fecha_final']);
	}

	if(isset($_POST['id_cartera'])){
		$id_cartera = strip_tags($_POST['id_cartera']);
	}

	if(isset($_POST['id_usuario'])){
		$id_usuario = strip_tags($_POST['id_usuario']);
	}
?>
	
	<br><br>
	
	<!-- Links -->
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a href="<?php echo PATH; ?>/area/admin/">Home</a>
			<a class="active">Progreso de Empleados</a>
		</div>
	</section>

	<!-- Form -->
	<section id="Content_Form">
		<form action="" method="post">
			<h2>Progreso de Empleados</h2>

			<div class="f_item">
				<label>Fecha de Inicio: <span>*</span></label>

				<input type="date" id="fecha_inicio" name="fecha_inicio" class="f_input_date" required value="<?php echo $fecha_inicio; ?>">
			</div>

			<div class="f_item">
				<label>Fecha Final:</label>

				<input type="date" id="fecha_final" name="fecha_final" class="f_input_date" value="<?php echo $fecha_final; ?>">
			</div>

			<div class="f_item">
				<label>Carteras: <span>*</span></label>

				<select id="id_cartera" name="id_cartera" class="f_select">
					<option value="0" <?php echo $id_cartera == 0 ? 'selected' : ''; ?>>Todas las carteras</option>

					<?php
						$Carteras_Controller = new Carteras_Controller();

						$arrayCarteras = $Carteras_Controller->select_all();

						if($arrayCarteras != null){
							for($i = 0; $i < sizeof($arrayCarteras); $i++){
								if($id_cartera == $arrayCarteras[$i]['id_cartera']){
									echo '<option value="' . $arrayCarteras[$i]['id_cartera'] . '" selected>' . $arrayCarteras[$i]['nombre_cartera'] . '</option>';
								}else{
									echo '<option value="' . $arrayCarteras[$i]['id_cartera'] . '">' . $arrayCarteras[$i]['nombre_cartera'] . '</option>';
								}
							}
						}
					?>
				</select>
			</div>

			<div class="f_item">
				<label>Empleado: <span>*</span></label>

				<select id="id_usuario" name="id_usuario" class="f_select">
					<option value="0" <?php echo $id_usuario == 0 ? 'selected' : ''; ?>>Todos los empleados</option>

					<?php
						$arrayUsuarios = $Usuarios_Controller->select_all();

						if($arrayUsuarios != null){
							for($i = 0; $i < sizeof($arrayUsuarios); $i++){
								if($id_usuario == $arrayUsuarios[$i]['id_usuario']){
									echo '<option value="' . $arrayUsuarios[$i]['id_usuario'] . '" selected>' . $arrayUsuarios[$i]['nombre_completo'] . '</option>';
								}else{
									echo '<option value="' . $arrayUsuarios[$i]['id_usuario'] . '">' . $arrayUsuarios[$i]['nombre_completo'] . '</option>';
								}
							}
						}
					?>
				</select>
			</div>

			<!-- btn -->
			<div class="f_btn">
				<input type="submit" id="btn_progreso_empleados" name="btn_progreso_empleados" class="f_input_btn" value="Generar Reporte">
			</div>
		</form>
	</section>

<?php
	if(isset($_POST['fecha_inicio']) && isset($_POST['fecha_final']) && isset($_POST['id_cartera']) && isset($_POST['id_usuario']) && isset($_POST['btn_progreso_empleados'])){
		// data
		$fecha_inicio = strip_tags($_POST['fecha_inicio']);
		$fecha_final = strip_tags($_POST['fecha_final']);
		$id_cartera = (int) strip_tags($_POST['id_cartera']);
		$id_usuario = (int) strip_tags($_POST['id_usuario']);

		// controllers
		$Gestiones_Controller = new Gestiones_Controller();
		$Deudas_Controller = new Deudas_Controller();
		$Estados_Controller = new Estados_Controller();
		$Promesas_De_Pago_Controller = new Promesas_De_Pago_Controller();
		$Proceso_Judicial_Controller = new Proceso_Judicial_Controller();
		$Sub_Estados_Controller = new Sub_Estados_Controller();
		$Usuario_Cartera_Controller = new Usuario_Cartera_Controller();

		// messages
		$message_periodo_cubierto = '';

		if(!empty($fecha_final)){
			$message_periodo_cubierto = 'Del <b>' . $fecha_inicio . '</b> hasta <b>' . $fecha_final . '</b>';
		}else{
			$message_periodo_cubierto = 'De la fecha <b>' . $fecha_inicio . '</b>';
		}

		// data
		$total_gestiones_realizadas = $Gestiones_Controller->count_by_fecha_registro_id_cartera_id_usuario($fecha_inicio, $fecha_final, $id_cartera, $id_usuario);
		$total_deudas_agregadas = $Deudas_Controller->count_by_fecha_registro_id_cartera_id_usuario($fecha_inicio, $fecha_final, $id_cartera, $id_usuario);
		$total_promesas_de_pago = $Promesas_De_Pago_Controller->count_by_fecha_registro_id_cartera_id_usuario($fecha_inicio, $fecha_final, $id_cartera, $id_usuario);
		$total_procesos_judiciales = $Proceso_Judicial_Controller->count_by_fecha_registro_id_cartera_id_usuario($fecha_inicio, $fecha_final, $id_cartera, $id_usuario);
?>
	<section class="Content_Info">
		<div class="ci_content">
			<h2>Estadísticas Generales</h2>

			<div class="cic_items">
				<!-- Campos -->
				<div class="cic_item">
					<p><b>Período Cubierto:</b> <?php echo $message_periodo_cubierto; ?></p>
				</div>

				<div class="cic_item">
					<p><b>Gestiones Realizadas:</b> <?php echo $total_gestiones_realizadas; ?></p>
				</div>

				<div class="cic_item">
					<p><b>Deudas Agregadas:</b> <?php echo $total_deudas_agregadas; ?></p>
				</div>

				<div class="cic_item">
					<p><b>Promesas de Pagos Creadas:</b> <?php echo $total_promesas_de_pago; ?></p>
				</div>

				<div class="cic_item">
					<p><b>Procesos Judiciales Creados:</b> <?php echo $total_procesos_judiciales; ?></p>
				</div>
			</div>
		</div>
	</section>

<?php
		$arrayCarteras = [];
		$user_count = 0;

		// generate by employees
		if($id_cartera > 0){
			$Cartera = $Carteras_Controller->select_by_id($id_cartera);

			if($Cartera != null){
				$array['id_cartera'] = $Cartera->get_id_cartera();
				$array['nombre_cartera'] = $Cartera->get_nombre_cartera();
				$array['descripcion'] = $Cartera->get_descripcion();
				$array['correo_contacto'] = $Cartera->get_correo_contacto();

				$arrayCarteras[] = $array;
			}
		}else{
			$arrayCarteras = $Carteras_Controller->select_all();
		}

		//
		if(sizeof($arrayCarteras) > 0){
			for($i = 0; $i < sizeof($arrayCarteras); $i++){
?>
	
	<section class="Content_Info_Cartera">
		<div class="cia_content">
			<h2><?php echo $arrayCarteras[$i]['nombre_cartera']; ?></h2>

			<?php
				$arrayUsuariosCarteras = $Usuario_Cartera_Controller->select_by_id_cartera($arrayCarteras[$i]['id_cartera']);

				if($arrayUsuariosCarteras != null){
					for($j = 0; $j < sizeof($arrayUsuariosCarteras); $j++){
						$Usuario = $Usuarios_Controller->select_by_id($arrayUsuariosCarteras[$j]['id_usuario']);
						if(($id_usuario == 0) || ($id_usuario == $Usuario->get_id_usuario())){
			?>

			<div class="Content_Info_Empleado">
				<div class="cie_content">
					<h3><?php echo $arrayCarteras[$i]['nombre_cartera']; ?> - <?php echo $Usuario->get_nombre_completo(); ?></h3>

					<div class="Content_Table_Empleado">
						<h4><?php echo $arrayCarteras[$i]['nombre_cartera']; ?> - <?php echo $Usuario->get_nombre_completo(); ?> - Gestiones Agregadas</h4>

						<table id="Tabla_Gestiones<?php echo $user_count; ?>" data-page-length='10'>
							<thead>
								<tr>
									<th>ID</th>
									<th>Descripción</th>
									<th>Estado</th>
									<th>Fecha de Registro</th>
								</tr>
							</thead>

							<tbody>
								<?php
									$arrayGestiones = $Gestiones_Controller->select_all_by_id_usuario_fecha_registro_id_cartera($Usuario->get_id_usuario(), $fecha_inicio, $fecha_final, $arrayUsuariosCarteras[$j]['id_cartera']);

									if($arrayGestiones != null){
										for($k = 0; $k < sizeof($arrayGestiones); $k++){
											echo '<tr>';
											echo '<td>' . $arrayGestiones[$k]['id_gestion'] . '</td>';
											echo '<td>' . $arrayGestiones[$k]['descripcion'] . '</td>';

											$Sub_Estado = $Sub_Estados_Controller->select_by_id($arrayGestiones[$k]['id_sub_estado']);
											$Estado = $Estados_Controller->select_by_id($Sub_Estado->get_id_estado());

											echo '<td>' . $Estado->get_descripcion() . ' <i class="fa-solid fa-arrow-right-long" style="margin: 0 15px; font-size: 12px;"></i> ' . $Sub_Estado->get_descripcion() . ' </td>';

											echo '<td>' . $arrayGestiones[$k]['fecha_registro'] . '</td>';
											echo '</tr>';
										}
									}
								?>
							</tbody>
						</table>
					</div>

					<div class="Content_Table_Empleado">
						<h4><?php echo $arrayCarteras[$i]['nombre_cartera']; ?> - <?php echo $Usuario->get_nombre_completo(); ?> - Deudas Agregadas</h4>

						<table id="Tabla_Deudas<?php echo $user_count; ?>" data-page-length='10'>
							<thead>
								<tr>
									<th>ID</th>
									<th># Factura</th>
									<th>Total de la Deuda</th>
									<th>Valor de Cuotas</th>
									<th># Cuotas</th>
									<th>Última Fecha de Pago</th>
									<th>Fecha de Registro</th>
									<th><i class="fa-solid fa-gear"></i></th>
								</tr>
							</thead>

							<tbody>
								<?php
									$arrayDeudas = $Deudas_Controller->select_all_by_id_usuario_fecha_registro_id_cartera($Usuario->get_id_usuario(), $fecha_inicio, $fecha_final, $arrayUsuariosCarteras[$j]['id_cartera']);

									if($arrayDeudas != null){
										for($k = 0; $k < sizeof($arrayDeudas); $k++){
											echo '<tr>';
											echo '<td>' . $arrayDeudas[$k]['id_deuda'] . '</td>';
											echo '<td>' . $arrayDeudas[$k]['numero_factura'] . '</td>';
											echo '<td>$' . $arrayDeudas[$k]['total_deuda'] . '</td>';
											echo '<td>$' . $arrayDeudas[$k]['valor_cuotas'] . '</td>';
											echo '<td>' . $arrayDeudas[$k]['numero_cuotas'] . '</td>';
											echo '<td>' . $arrayDeudas[$k]['ultima_fecha_pago'] . '</td>';
											
											echo '<td>' . $arrayDeudas[$k]['fecha_registro'] . '</td>';
											echo '<td class="content_opt">';
											echo '<a href="' . PATH . '/area/admin/deuda/' . $arrayDeudas[$k]['id_deuda'] . '" class="to_btn to_btn_see to_btn_r" title="Ver" target="_blank"><i class="fa-solid fa-circle-info"></i></a>';
											echo '</td>';
											echo '</tr>';
										}
									}
								?>
							</tbody>
						</table>
					</div>

					<div class="Content_Table_Empleado">
						<h4><?php echo $arrayCarteras[$i]['nombre_cartera']; ?> - <?php echo $Usuario->get_nombre_completo(); ?> - Promesas de Pago Agregadas</h4>

						<table id="Tabla_Promesas<?php echo $user_count; ?>" data-page-length='10'>
							<thead>
								<tr>
									<th>ID</th>
									<th>Saldo total</th>
									<th>Descuento</th>
									<th>Total a pagar</th>
									<th>Número de cuotas</th>
									<th>Valor de cuotas</th>
									<th>Fecha de pago</th>
									<th>Fecha de emisión</th>
								</tr>
							</thead>

							<tbody>
								<?php
									$arrayPromesas = $Promesas_De_Pago_Controller->select_all_by_id_usuario_fecha_emision_id_cartera($Usuario->get_id_usuario(), $fecha_inicio, $fecha_final, $arrayUsuariosCarteras[$j]['id_cartera']);

									if($arrayPromesas != null){
										for($k = 0; $k < sizeof($arrayPromesas); $k++){
											echo '<tr>';
											echo '<td>' . $arrayPromesas[$k]['id_promesa'] . '</td>';
											echo '<td>$' . $arrayPromesas[$k]['saldo_total'] . '</td>';
											echo '<td>' . $arrayPromesas[$k]['descuento'] . '%</td>';
											echo '<td>$' . $arrayPromesas[$k]['total_pagar'] . '</td>';
											echo '<td>' . $arrayPromesas[$k]['numero_cuotas'] . '</td>';
											echo '<td>$' . $arrayPromesas[$k]['valor_cuotas'] . '</td>';
											echo '<td>' . $arrayPromesas[$k]['fecha_pago'] . '</td>';
											echo '<td>' . $arrayPromesas[$k]['fecha_emision'] . '</td>';
											echo '</tr>';
										}
									}
								?>
							</tbody>
						</table>
					</div>

					<div class="Content_Table_Empleado">
						<h4><?php echo $arrayCarteras[$i]['nombre_cartera']; ?> - <?php echo $Usuario->get_nombre_completo(); ?> - Procesos Judiciales Agregados</h4>

						<table id="Tabla_Procesos<?php echo $user_count; ?>" data-page-length='10'>
							<thead>
								<tr>
									<th>ID</th>
									<th>Descripción</th>
									<th>Fecha de Registro</th>
									<th><i class="fa-solid fa-gear"></i></th>
								</tr>
							</thead>

							<tbody>
								<?php
									$arrayProcesos = $Proceso_Judicial_Controller->select_all_by_id_usuario_fecha_registro_id_cartera($Usuario->get_id_usuario(), $fecha_inicio, $fecha_final, $arrayUsuariosCarteras[$j]['id_cartera']);

									if($arrayProcesos != null){
										for($k = 0; $k < sizeof($arrayProcesos); $k++){
											echo '<tr>';
											echo '<td>' . $arrayProcesos[$k]['id_proceso'] . '</td>';
											echo '<td>' . $arrayProcesos[$k]['descripcion'] . '</td>';
											echo '<td>' . $arrayProcesos[$k]['fecha_registro'] . '</td>';
											echo '<td class="content_opt">';
											echo '<a href="' . PATH . '/area/admin/proceso_judicial/' . $arrayProcesos[$k]['id_proceso'] . '" class="to_btn to_btn_see to_btn_r" title="Ver" target="_blank"><i class="fa-solid fa-circle-info"></i></a>';
											echo '</td>';
											echo '</tr>';
										}
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<?php
						}
						
						$user_count++;
					}
				}
			?>
		</div>
	</section>

<?php
			}
		}
	}
?>

	<script type="text/javascript">
		jQuery(document).ready(function(){
			let table_id_gestiones = '';
			let table_id_deudas = '';
			let table_id_promesas = '';
			let table_id_procesos = '';

			/**
			 * DataTables
			*/
			<?php
				for($i = 0; $i < $user_count; $i++){
			?>

			table_id_gestiones = '#Tabla_Gestiones' + <?php echo $i; ?>;
			table_id_deudas = '#Tabla_Deudas' + <?php echo $i; ?>;
			table_id_promesas = '#Tabla_Promesas' + <?php echo $i; ?>;
			table_id_procesos = '#Tabla_Procesos' + <?php echo $i; ?>;
			
			jQuery(table_id_gestiones).DataTable({
				language: {
					processing:     "Procesando...",
					search:         "Buscar :",
					lengthMenu:     "Mostrar _MENU_ elementos",
					info:           "Mostrando _START_ a _END_ de _TOTAL_ elementos",
					infoEmpty:      "Mostrando 0 a 0 de 0 elementos",
					infoFiltered:   "(Filtrado de _MAX_ total de elementos)",
					infoPostFix:    "",
					loadingRecords: "Cargando...",
					zeroRecords:    "Sin resultados encontrados",
					emptyTable:     "No hay datos disponibles en la tabla",
					paginate: {
						first:      "Primero",
						previous:   "<i class=\"fa-solid fa-angle-left\"></i>",
						next:       "<i class=\"fa-solid fa-angle-right\"></i>",
						last:       "Último"
					},
					aria: {
						sortAscending:  ": habilitar para ordenar la columna en orden ascendente",
						sortDescending: ": habilitar para ordenar la columna en orden descendente"
					}
			    }
			});

			jQuery(table_id_deudas).DataTable({
				language: {
					processing:     "Procesando...",
					search:         "Buscar :",
					lengthMenu:     "Mostrar _MENU_ elementos",
					info:           "Mostrando _START_ a _END_ de _TOTAL_ elementos",
					infoEmpty:      "Mostrando 0 a 0 de 0 elementos",
					infoFiltered:   "(Filtrado de _MAX_ total de elementos)",
					infoPostFix:    "",
					loadingRecords: "Cargando...",
					zeroRecords:    "Sin resultados encontrados",
					emptyTable:     "No hay datos disponibles en la tabla",
					paginate: {
						first:      "Primero",
						previous:   "<i class=\"fa-solid fa-angle-left\"></i>",
						next:       "<i class=\"fa-solid fa-angle-right\"></i>",
						last:       "Último"
					},
					aria: {
						sortAscending:  ": habilitar para ordenar la columna en orden ascendente",
						sortDescending: ": habilitar para ordenar la columna en orden descendente"
					}
			    }
			});

			jQuery(table_id_promesas).DataTable({
				language: {
					processing:     "Procesando...",
					search:         "Buscar :",
					lengthMenu:     "Mostrar _MENU_ elementos",
					info:           "Mostrando _START_ a _END_ de _TOTAL_ elementos",
					infoEmpty:      "Mostrando 0 a 0 de 0 elementos",
					infoFiltered:   "(Filtrado de _MAX_ total de elementos)",
					infoPostFix:    "",
					loadingRecords: "Cargando...",
					zeroRecords:    "Sin resultados encontrados",
					emptyTable:     "No hay datos disponibles en la tabla",
					paginate: {
						first:      "Primero",
						previous:   "<i class=\"fa-solid fa-angle-left\"></i>",
						next:       "<i class=\"fa-solid fa-angle-right\"></i>",
						last:       "Último"
					},
					aria: {
						sortAscending:  ": habilitar para ordenar la columna en orden ascendente",
						sortDescending: ": habilitar para ordenar la columna en orden descendente"
					}
			    }
			});

			jQuery(table_id_procesos).DataTable({
				language: {
					processing:     "Procesando...",
					search:         "Buscar :",
					lengthMenu:     "Mostrar _MENU_ elementos",
					info:           "Mostrando _START_ a _END_ de _TOTAL_ elementos",
					infoEmpty:      "Mostrando 0 a 0 de 0 elementos",
					infoFiltered:   "(Filtrado de _MAX_ total de elementos)",
					infoPostFix:    "",
					loadingRecords: "Cargando...",
					zeroRecords:    "Sin resultados encontrados",
					emptyTable:     "No hay datos disponibles en la tabla",
					paginate: {
						first:      "Primero",
						previous:   "<i class=\"fa-solid fa-angle-left\"></i>",
						next:       "<i class=\"fa-solid fa-angle-right\"></i>",
						last:       "Último"
					},
					aria: {
						sortAscending:  ": habilitar para ordenar la columna en orden ascendente",
						sortDescending: ": habilitar para ordenar la columna en orden descendente"
					}
			    }
			});

			<?php
				}
			?>
		});
	</script>

<?php
	/**
	 * footer
	*/
	require_once('footer.php');
?>