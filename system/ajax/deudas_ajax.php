<?php
	/**
	 * Generales
	*/
	require_once('../settings/settings.php');
	require_once('../database/conexion.php');

	/**
	 * Modelos y Controladores
	*/
	require_once('../models/deudas_model.php');
	require_once('../controllers/deudas_controller.php');

	/**
	 * User Login
	*/
	require_once('../models/usuarios_model.php');
	require_once('../controllers/usuarios_controller.php');

	/**
	 * Sesión
	*/
	require_once('../controllers/sesion_usuario_controller.php');

	/**
	 * Verify Sesion
	*/
	require_once('../sessions/session_ajax.php');

	/**
	 * Ajax para los datos del usuario
	*/

	/**
	 * insert
	*/
	if(
		isset($_POST['action']) 
		&& $_POST['action'] == 'insert' 
		&& isset($_POST['numero_factura'])
		&& isset($_POST['total_deuda'])
		&& isset($_POST['valor_cuotas'])
		&& isset($_POST['numero_cuotas'])
		&& isset($_POST['ultima_fecha_pago'])
		&& isset($_POST['dia_pago'])
		&& isset($_POST['numero_cuotas_pendientes'])
		&& isset($_POST['total_pendiente'])
		&& isset($_POST['numero_cuotas_pagadas'])
		&& isset($_POST['total_pagado'])
		&& isset($_POST['porcentaje_mora'])
		&& isset($_POST['valor_mora'])
		&& isset($_POST['numero_cuotas_mora'])
		&& isset($_POST['total_mora'])
		&& isset($_POST['total_deuda_mora'])
		&& isset($_POST['dui'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo agregar la Deuda, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear Modelo
		*/
		$Deudas = new Deudas_Model();

		/**
		 * Insertar datos al modelo y limpiarlo de etiquetas html con la funcion strip_tags
		*/
		$Deudas->set_numero_factura(strip_tags($_POST['numero_factura']));
		$Deudas->set_total_deuda(strip_tags($_POST['total_deuda']));
		$Deudas->set_valor_cuotas(strip_tags($_POST['valor_cuotas']));
		$Deudas->set_numero_cuotas(strip_tags($_POST['numero_cuotas']));
		$Deudas->set_ultima_fecha_pago(strip_tags($_POST['ultima_fecha_pago']));
		$Deudas->set_dia_pago(strip_tags($_POST['dia_pago']));
		$Deudas->set_numero_cuotas_pendientes(strip_tags($_POST['numero_cuotas_pendientes']));
		$Deudas->set_total_pendiente(strip_tags($_POST['total_pendiente']));
		$Deudas->set_numero_cuotas_pagadas(strip_tags($_POST['numero_cuotas_pagadas']));
		$Deudas->set_total_pagado(strip_tags($_POST['total_pagado']));
		$Deudas->set_porcentaje_mora(strip_tags($_POST['porcentaje_mora']));
		$Deudas->set_valor_mora(strip_tags($_POST['valor_mora']));
		$Deudas->set_numero_cuotas_mora(strip_tags($_POST['numero_cuotas_mora']));
		$Deudas->set_total_mora(strip_tags($_POST['total_mora']));
		$Deudas->set_total_deuda_mora(strip_tags($_POST['total_deuda_mora']));
		$Deudas->set_fecha_registro($FechaActual);
		$Deudas->set_id_usuario($CurrentUser->get_id_usuario());
		$Deudas->set_dui(strip_tags($_POST['dui']));

		/**
		 * Crear Controlador
		*/
		$Deudas_Controller = new Deudas_Controller();

		/**
		 * Insertar deuda y validar si se registro o no
		*/
		if($Deudas_Controller->insert($Deudas)){
			$arrayRequest['success'] = true;
			$arrayRequest['message'] = 'Deuda agregada con exito.';
		}

		/**
		 * Devolver la respuesta
		*/
		exit(json_encode($arrayRequest));
	}

	/**
	 * Update
	*/
	if(
		isset($_POST['action'])
		&& $_POST['action'] == 'update'
		&& isset($_POST['id_deuda'])
		&& isset($_POST['numero_factura'])
		&& isset($_POST['total_deuda'])
		&& isset($_POST['valor_cuotas'])
		&& isset($_POST['numero_cuotas'])
		&& isset($_POST['ultima_fecha_pago'])
		&& isset($_POST['dia_pago'])
		&& isset($_POST['numero_cuotas_pendientes'])
		&& isset($_POST['total_pendiente'])
		&& isset($_POST['numero_cuotas_pagadas'])
		&& isset($_POST['total_pagado'])
		&& isset($_POST['porcentaje_mora'])
		&& isset($_POST['valor_mora'])
		&& isset($_POST['numero_cuotas_mora'])
		&& isset($_POST['total_mora'])
		&& isset($_POST['total_deuda_mora'])
		&& isset($_POST['dui'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo actualizar la Deuda, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear controlador
		*/
		$Deudas_Controller = new Deudas_Controller();

		/**
		 * Recuperar datos de este modelo
		*/
		$Deuda = $Deudas_Controller->select_by_id(strip_tags($_POST['id_deuda']));

		/**
		 * Comprobar si existe en la base de datos
		*/
		if($Deuda != null){
			/**
			 * Actualizar los valores
			*/
			$Deuda->set_dui(strip_tags($_POST['dui']));
			$Deuda->set_numero_factura(strip_tags($_POST['numero_factura']));
			$Deuda->set_total_deuda(strip_tags($_POST['total_deuda']));
			$Deuda->set_valor_cuotas(strip_tags($_POST['valor_cuotas']));
			$Deuda->set_numero_cuotas(strip_tags($_POST['numero_cuotas']));
			$Deuda->set_ultima_fecha_pago(strip_tags($_POST['ultima_fecha_pago']));
			$Deuda->set_dia_pago(strip_tags($_POST['dia_pago']));
			$Deuda->set_numero_cuotas_pendientes(strip_tags($_POST['numero_cuotas_pendientes']));
			$Deuda->set_total_pendiente(strip_tags($_POST['total_pendiente']));
			$Deuda->set_numero_cuotas_pagadas(strip_tags($_POST['numero_cuotas_pagadas']));
			$Deuda->set_total_pagado(strip_tags($_POST['total_pagado']));
			$Deuda->set_porcentaje_mora(strip_tags($_POST['porcentaje_mora']));
			$Deuda->set_valor_mora(strip_tags($_POST['valor_mora']));
			$Deuda->set_numero_cuotas_mora(strip_tags($_POST['numero_cuotas_mora']));
			$Deuda->set_total_mora(strip_tags($_POST['total_mora']));
			$Deuda->set_total_deuda_mora(strip_tags($_POST['total_deuda_mora']));

			/**
			 * Actualizar en la base de datos y validar si se actualizo o no
			*/
			if($Deudas_Controller->update($Deuda)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Deuda actualizada con exito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de esta Deuda no coincide con ningún registro.';
		}

		/**
		 * Devolver la respuesta
		*/
		exit(json_encode($arrayRequest));
	}
	
	/**
	 * delete
	*/
	if(
		isset($_POST['action'])
		&& $_POST['action'] == 'delete'
		&& isset($_POST['id_deuda'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo eliminar la Deuda, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear controlador
		*/
		$Deudas_Controller = new Deudas_Controller();

		/**
		 * Recuperar datos de este modelo
		*/
		$Deuda = $Deudas_Controller->select_by_id(strip_tags($_POST['id_deuda']));

		/**
		 * Comprobar si existe en la base de datos
		*/
		if($Deuda != null){
			if($Deudas_Controller->delete($Deuda)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Deuda eliminada con exito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de esta Deuda no coincide con ningún registro.';
		}

		/**
		 * Devolver la respuesta
		*/
		exit(json_encode($arrayRequest));
	}
?>