<?php
	/**
	 * General
	*/
	require_once('../../system/settings/settings.php');
	require_once('../../system/database/conexion.php');

	/**
	 * User Login
	*/
	require_once('../../system/models/usuarios_model.php');
	require_once('../../system/controllers/usuarios_controller.php');

	/**
	 * Sesión
	*/
	require_once('../../system/controllers/sesion_usuario_controller.php');

	/**
	 * Verify Sesion
	*/
	require_once('../../system/sessions/admin_session.php');

	/**
	 * models and controllers
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


	/**
	 * fpdf
	*/
	require_once('../../assets/fpdf/fpdf.php');

	$pdf = new FPDF('L');
	$pdf->AddPage();
	$pdf->SetFont('Arial', 'B', 14);

	$width = $pdf->GetPageWidth();
	$width_half = ($width-20) / 2;

	// info
	$fecha_inicio = '';
	$fecha_final = '';
	$id_cartera = 0;
	$id_usuario = 0;
	$tipo_reporte = 'all';

	if(isset($_POST['fecha_inicio']) && isset($_POST['fecha_final']) && isset($_POST['id_cartera']) && isset($_POST['tipo_reporte'])){
		// post
		$fecha_inicio = strip_tags($_POST['fecha_inicio']);
		$fecha_final = strip_tags($_POST['fecha_final']);
		$id_cartera = (int) strip_tags($_POST['id_cartera']);
		$tipo_reporte = strip_tags($_POST['tipo_reporte']);

		// controllers
		$Carteras_Controller = new Carteras_Controller(); 
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
			$message_periodo_cubierto = 'Del ' . $fecha_inicio . ' hasta ' . $fecha_final;
		}else{
			$message_periodo_cubierto = $fecha_inicio;
		}

		// data
		$total_gestiones_realizadas = $Gestiones_Controller->count_by_fecha_registro_id_cartera_id_usuario($fecha_inicio, $fecha_final, $id_cartera, $id_usuario);
		$total_deudas_agregadas = $Deudas_Controller->count_by_fecha_registro_id_cartera_id_usuario($fecha_inicio, $fecha_final, $id_cartera, $id_usuario);
		$total_promesas_de_pago = $Promesas_De_Pago_Controller->count_by_fecha_registro_id_cartera_id_usuario($fecha_inicio, $fecha_final, $id_cartera, $id_usuario);
		$total_procesos_judiciales = $Proceso_Judicial_Controller->count_by_fecha_registro_id_cartera_id_usuario($fecha_inicio, $fecha_final, $id_cartera, $id_usuario);

		$pdf->SetFillColor(34, 98, 198);
		$pdf->SetTextColor(255, 255, 255);

		$h_1 = 14;
		$size1 = 10;

		$pdf->Cell($width_half, 14, utf8_decode('ESTADÍSTICAS GENERALES'), 1, 1, 'C', 1);
		$pdf->SetFont('Arial', 'B', $size1);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->Cell($width_half/2, $h_1, utf8_decode('Período Cubierto:'), 1, 0, 'C');
		$pdf->SetFont('Arial', '', $size1);
		$pdf->Cell($width_half/2, $h_1, $message_periodo_cubierto, 1, 1, 'C');

		if($tipo_reporte == 'all' || $tipo_reporte == 'Gestiones'){
			// gestiones
			$pdf->SetFont('Arial', 'B', $size1);
			$pdf->Cell($width_half/2, $h_1, utf8_decode('Gestiones Agregadas:'), 1, 0, 'C');
			$pdf->SetFont('Arial', '', $size1);
			$pdf->Cell($width_half/2, $h_1, $total_gestiones_realizadas, 1, 1, 'C');
		}

		if($tipo_reporte == 'all' || $tipo_reporte == 'Deudas'){
			// deudas
			$pdf->SetFont('Arial', 'B', $size1);
			$pdf->Cell($width_half/2, $h_1, utf8_decode('Deudas Agregadas:'), 1, 0, 'C');
			$pdf->SetFont('Arial', '', $size1);
			$pdf->Cell($width_half/2, $h_1, $total_deudas_agregadas, 1, 1, 'C');
		}

		if($tipo_reporte == 'all' || $tipo_reporte == 'Promesas De Pago'){
			// promesas
			$pdf->SetFont('Arial', 'B', $size1);
			$pdf->Cell($width_half/2, $h_1, utf8_decode('Promesas de Pago Agregadas:'), 1, 0, 'C');
			$pdf->SetFont('Arial', '', $size1);
			$pdf->Cell($width_half/2, $h_1, $total_promesas_de_pago, 1, 1, 'C');
		}

		if($tipo_reporte == 'all' || $tipo_reporte == 'Procesos Judiciales'){
			// procesos judiciales
			$pdf->SetFont('Arial', 'B', $size1);
			$pdf->Cell($width_half/2, $h_1, utf8_decode('Procesos Judiciales Agregados:'), 1, 0, 'C');
			$pdf->SetFont('Arial', '', $size1);
			$pdf->Cell($width_half/2, $h_1, $total_procesos_judiciales, 1, 1, 'C');
		}

		// GENERAR REPORTE DE EMPLEADOS SELECCIONADOS
		$t_gestiones = 0;
		$t_deudas = 0;
		$t_promesas = 0;
		$t_procesos = 0;

		$pdf->AddPage();

		$size_h = 10;

		$pdf->SetFont('Arial', 'B', 14);
		$pdf->Cell(0, 8, utf8_decode('REPORTE DETALLADO (' . $message_periodo_cubierto . ')'), 0, 1, 'C');
		$pdf->Ln(10);
		$pdf->SetFont('Arial','B', 9);
		$pdf->SetFillColor(34, 98, 198);
		$pdf->SetTextColor(255, 255, 255);

		$pdf->Cell(67.16, $size_h, utf8_decode('CARTERA'), 1, 0, 'C', 1);
	    $pdf->Cell(78.16, $size_h, utf8_decode('EMPLEADO'), 1, 0, 'C', 1);

	    if($tipo_reporte == 'Gestiones'){
	    	$pdf->Cell(0, $size_h, utf8_decode('GESTIONES'), 1, 1, 'C', 1);
	    }else if($tipo_reporte == 'all'){
	    	$pdf->Cell(25.16, $size_h, utf8_decode('GESTIONES'), 1, 0, 'C', 1);
	    }

	    if($tipo_reporte == 'Deudas'){
	    	$pdf->Cell(0, $size_h, utf8_decode('DEUDAS'), 1, 1, 'C', 1);
	    }else if($tipo_reporte == 'all'){
	    	$pdf->Cell(20.16, $size_h, utf8_decode('DEUDAS'), 1, 0, 'C', 1);
	    }

	    if($tipo_reporte == 'Promesas De Pago'){
	    	$pdf->Cell(0, $size_h, utf8_decode('PROMESAS DE PAGO'), 1, 1, 'C', 1);
	    }else if($tipo_reporte == 'all'){
	    	$pdf->Cell(40.16, $size_h, utf8_decode('PROMESAS DE PAGO'), 1, 0, 'C', 1);
	    }

	    if($tipo_reporte == 'Procesos Judiciales'){
	    	$pdf->Cell(0, $size_h, utf8_decode('PROCESOS JUDICIALES'), 1, 1, 'C', 1);
	    }else if($tipo_reporte == 'all'){
	    	$pdf->Cell(46.16, $size_h, utf8_decode('PROCESOS JUDICIALES'), 1, 1, 'C', 1);
	    }

		$pdf->SetTextColor(0, 0, 0);

	    // data
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
				// totales por cartera
				$tc_gestiones = 0;
				$tc_deudas = 0;
				$tc_promesas = 0;
				$tc_procesos = 0;

				$arrayUsuariosCarteras = $Usuario_Cartera_Controller->select_by_id_cartera($arrayCarteras[$i]['id_cartera']);

				// print cartera
				$size_height_cell = (sizeof($arrayUsuariosCarteras)+1) * $size_h;
				$pdf->Cell(67.16, $size_height_cell, utf8_decode($arrayCarteras[$i]['nombre_cartera']), 1, 0, 'C');

				if($arrayUsuariosCarteras != null){
					for($j = 0; $j < sizeof($arrayUsuariosCarteras); $j++){
						// agrega el espacio por cada usuario nuevo
						if($j > 0){
							$pdf->Cell(67.16);
						}

						// Datos del usuario
						$Usuario = $Usuarios_Controller->select_by_id($arrayUsuariosCarteras[$j]['id_usuario']);
						$pdf->Cell(78.16, $size_h, utf8_decode($Usuario->get_nombre_completo()), 1, 0, 'C');

						// gestiones
						$arrayGestiones = $Gestiones_Controller->select_all_by_id_usuario_fecha_registro_id_cartera($Usuario->get_id_usuario(), $fecha_inicio, $fecha_final, $arrayUsuariosCarteras[$j]['id_cartera']);

						if($arrayGestiones == null){
							$arrayGestiones = [];
						}

						$size_gestiones = sizeof($arrayGestiones);
						$tc_gestiones += $size_gestiones;
						$t_gestiones += $size_gestiones;

						if($tipo_reporte == 'Gestiones'){
					    	$pdf->Cell(0, $size_h, $size_gestiones, 1, 1, 'C');
					    }else if($tipo_reporte == 'all'){
					    	$pdf->Cell(25.16, $size_h, $size_gestiones, 1, 0, 'C');
					    }

					    // deudas
					    $arrayDeudas = $Deudas_Controller->select_all_by_id_usuario_fecha_registro_id_cartera($Usuario->get_id_usuario(), $fecha_inicio, $fecha_final, $arrayUsuariosCarteras[$j]['id_cartera']);

					    if($arrayDeudas == null){
							$arrayDeudas = [];
						}

						$size_deudas = sizeof($arrayDeudas);
						$tc_deudas += $size_deudas;
						$t_deudas += $size_deudas;

					    if($tipo_reporte == 'Deudas'){
					    	$pdf->Cell(0, $size_h, $size_deudas, 1, 1, 'C');
					    }else if($tipo_reporte == 'all'){
					    	$pdf->Cell(20.16, $size_h, $size_deudas, 1, 0, 'C');
					    }

					    // promesas
					    $arrayPromesas = $Promesas_De_Pago_Controller->select_all_by_id_usuario_fecha_emision_id_cartera($Usuario->get_id_usuario(), $fecha_inicio, $fecha_final, $arrayUsuariosCarteras[$j]['id_cartera']);

					    if($arrayPromesas == null){
							$arrayPromesas = [];
						}

						$size_promesas = sizeof($arrayPromesas);
						$tc_promesas += $size_promesas;
						$t_promesas += $size_promesas;

					    if($tipo_reporte == 'Promesas De Pago'){
					    	$pdf->Cell(0, $size_h, sizeof($arrayPromesas), 1, 1, 'C');
					    }else if($tipo_reporte == 'all'){
					    	$pdf->Cell(40.16, $size_h, sizeof($arrayPromesas), 1, 0, 'C');
					    }

					    // procesos
					    $arrayProcesos = $Proceso_Judicial_Controller->select_all_by_id_usuario_fecha_registro_id_cartera($Usuario->get_id_usuario(), $fecha_inicio, $fecha_final, $arrayUsuariosCarteras[$j]['id_cartera']);

					    if($arrayProcesos == null){
							$arrayProcesos = [];
						}

						$size_procesos = sizeof($arrayProcesos);
						$tc_procesos += $size_procesos;
						$t_procesos += $size_procesos;

					    if($tipo_reporte == 'Procesos Judiciales'){
					    	$pdf->Cell(0, $size_h, $size_procesos, 1, 1, 'C');
					    }else if($tipo_reporte == 'all'){
					    	$pdf->Cell(46.16, $size_h, $size_procesos, 1, 1, 'C');
					    }
					}
				}

				// total by cartera
				$pdf->Cell(67.16);

				$pdf->SetFillColor(225, 225, 225);

				$pdf->Cell(78.16, $size_h, utf8_decode('Total por cartera: '), 1, 0, 'C', 1);

				// gestiones
				if($tipo_reporte == 'Gestiones'){
			    	$pdf->Cell(0, $size_h, $tc_gestiones, 1, 1, 'C', 1);
			    }else if($tipo_reporte == 'all'){
			    	$pdf->Cell(25.16, $size_h, $tc_gestiones, 1, 0, 'C', 1);
			    }

			    if($tipo_reporte == 'Deudas'){
			    	$pdf->Cell(0, $size_h, $tc_deudas, 1, 1, 'C', 1);
			    }else if($tipo_reporte == 'all'){
			    	$pdf->Cell(20.16, $size_h, $tc_deudas, 1, 0, 'C', 1);
			    }

			    if($tipo_reporte == 'Promesas De Pago'){
			    	$pdf->Cell(0, $size_h, $tc_promesas, 1, 1, 'C', 1);
			    }else if($tipo_reporte == 'all'){
			    	$pdf->Cell(40.16, $size_h, $tc_promesas, 1, 0, 'C', 1);
			    }

			    if($tipo_reporte == 'Procesos Judiciales'){
			    	$pdf->Cell(0, $size_h, $tc_procesos, 1, 1, 'C', 1);
			    }else if($tipo_reporte == 'all'){
			    	$pdf->Cell(46.16, $size_h, $tc_procesos, 1, 1, 'C', 1);
			    }
			}
		}

		$pdf->SetFillColor(34, 98, 198);
		$pdf->SetTextColor(255, 255, 255);

		// total by cartera
		$pdf->Cell(145.32, $size_h, utf8_decode('Total General:'), 1, 0, 'C', 1);

		// gestiones
		if($tipo_reporte == 'Gestiones'){
	    	$pdf->Cell(0, $size_h, $t_gestiones, 1, 1, 'C', 1);
	    }else if($tipo_reporte == 'all'){
	    	$pdf->Cell(25.16, $size_h, $t_gestiones, 1, 0, 'C', 1);
	    }

	    if($tipo_reporte == 'Deudas'){
	    	$pdf->Cell(0, $size_h, $t_deudas, 1, 1, 'C', 1);
	    }else if($tipo_reporte == 'all'){
	    	$pdf->Cell(20.16, $size_h, $t_deudas, 1, 0, 'C', 1);
	    }

	    if($tipo_reporte == 'Promesas De Pago'){
	    	$pdf->Cell(0, $size_h, $t_promesas, 1, 1, 'C', 1);
	    }else if($tipo_reporte == 'all'){
	    	$pdf->Cell(40.16, $size_h, $t_promesas, 1, 0, 'C', 1);
	    }

	    if($tipo_reporte == 'Procesos Judiciales'){
	    	$pdf->Cell(0, $size_h, $t_procesos, 1, 1, 'C', 1);
	    }else if($tipo_reporte == 'all'){
	    	$pdf->Cell(46.16, $size_h, $t_procesos, 1, 1, 'C', 1);
	    }
	}

	// salida
	$pdf->Output('D', 'reporte_' . $FechaHora[0] . ' ' . $FechaHora[1] . '.pdf');
?>