<?php
	/**
	 * Generales
	*/
	require_once('../settings/settings.php');
	require_once('../database/conexion.php');

	/**
	 * Modelos y Controladores
	*/
	require_once('../models/contactos_model.php');
	require_once('../controllers/contactos_controller.php');

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
		&& isset($_POST['nombre_completo'])
		&& isset($_POST['direccion'])
		&& isset($_POST['telefono'])
		&& isset($_POST['parentezco'])
		&& isset($_POST['trabajo'])
		&& isset($_POST['direccion_trabajo'])
		&& isset($_POST['telefono_trabajo'])
		&& isset($_POST['tipo_contacto'])
		&& isset($_POST['dui'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo agregar el Contacto, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear Modelo
		*/
		$Contactos = new Contactos_Model();

		/**
		 * Insertar datos al modelo y limpiarlo de etiquetas html con la funcion strip_tags
		*/
		$Contactos->set_nombre_completo(strip_tags($_POST['nombre_completo']));
		$Contactos->set_direccion(strip_tags($_POST['direccion']));
		$Contactos->set_telefono(strip_tags($_POST['telefono']));
		$Contactos->set_parentezco(strip_tags($_POST['parentezco']));
		$Contactos->set_trabajo(strip_tags($_POST['trabajo']));
		$Contactos->set_direccion_trabajo(strip_tags($_POST['direccion_trabajo']));
		$Contactos->set_telefono_trabajo(strip_tags($_POST['telefono_trabajo']));
		$Contactos->set_tipo_contacto(strip_tags($_POST['tipo_contacto']));
		$Contactos->set_fecha_registro($FechaActual);
		$Contactos->set_id_usuario($CurrentUser->get_id_usuario());
		$Contactos->set_dui(strip_tags($_POST['dui']));

		/**
		 * Crear Controlador
		*/
		$Contactos_Controller = new Contactos_Controller();

		/**
		 * Insertar deuda y validar si se registro o no
		*/
		if($Contactos_Controller->insert($Contactos)){
			$arrayRequest['success'] = true;
			$arrayRequest['message'] = 'Contacto agregado con exito.';
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
		&& isset($_POST['id_contacto'])
		&& isset($_POST['nombre_completo'])
		&& isset($_POST['direccion'])
		&& isset($_POST['telefono'])
		&& isset($_POST['parentezco'])
		&& isset($_POST['trabajo'])
		&& isset($_POST['direccion_trabajo'])
		&& isset($_POST['telefono_trabajo'])
		&& isset($_POST['tipo_contacto'])
		&& isset($_POST['dui'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo actualizar el Contacto, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear controlador
		*/
		$Contactos_Controller = new Contactos_Controller();

		/**
		 * Recuperar datos de este modelo
		*/
		$Contactos = $Contactos_Controller->select_by_id(strip_tags($_POST['id_contacto']));

		/**
		 * Comprobar si existe en la base de datos
		*/
		if($Contactos != null){
			/**
			 * Actualizar los valores
			*/
			$Contactos->set_nombre_completo(strip_tags($_POST['nombre_completo']));
			$Contactos->set_direccion(strip_tags($_POST['direccion']));
			$Contactos->set_telefono(strip_tags($_POST['telefono']));
			$Contactos->set_parentezco(strip_tags($_POST['parentezco']));
			$Contactos->set_trabajo(strip_tags($_POST['trabajo']));
			$Contactos->set_direccion_trabajo(strip_tags($_POST['direccion_trabajo']));
			$Contactos->set_telefono_trabajo(strip_tags($_POST['telefono_trabajo']));
			$Contactos->set_tipo_contacto(strip_tags($_POST['tipo_contacto']));
			$Contactos->set_dui(strip_tags($_POST['dui']));

			/**
			 * Actualizar en la base de datos y validar si se actualizo o no
			*/
			if($Contactos_Controller->update($Contactos)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Contacto actualizado con exito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de este Contacto no coincide con ningún registro.';
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
		&& isset($_POST['id_contacto'])
	){
		/**
		 * Definir la respuesta de la petición
		*/
		$arrayRequest = array(
			'success' => false,
			'message' => 'No se pudo eliminar el Contacto, inténtelo de nuevo. Si el error persiste contacte al desarrollador.'
		);

		/**
		 * Crear controlador
		*/
		$Contactos_Controller = new Contactos_Controller();

		/**
		 * Recuperar datos de este modelo
		*/
		$Contacto = $Contactos_Controller->select_by_id(strip_tags($_POST['id_contacto']));

		/**
		 * Comprobar si existe en la base de datos
		*/
		if($Contacto != null){
			if($Contactos_Controller->delete($Contacto)){
				$arrayRequest['success'] = true;
				$arrayRequest['message'] = 'Contacto eliminado con exito.';
			}
		}else{
			$arrayRequest['success'] = false;
			$arrayRequest['message'] = 'El id de este Contacto no coincide con ningún registro.';
		}

		/**
		 * Devolver la respuesta
		*/
		exit(json_encode($arrayRequest));
	}
?>