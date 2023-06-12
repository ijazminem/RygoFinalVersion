<?php
	/**
	 * Generales
	*/
	require_once('../settings/settings.php');
	require_once('../database/conexion.php');

	/**
	 * Modelos y Controladores
	*/
	require_once('../controllers/carteras_controller.php');
	require_once('../controllers/usuario_cartera_controller.php');

	require_once('../models/carteras_model.php');
	require_once('../models/usuario_cartera_model.php');

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
	 * insert
	*/
	if(
		isset($_POST['action']) 
		&& $_POST['action'] == 'select' 
		&& isset($_POST['id_cartera'])
	){	
		$generalHTML = '<option value="0">Todos los empleados</option>';
		$id_cartera = (int) strip_tags($_POST['id_cartera']);
		$arrayUsuarios = null;

		// verificar cartera
		if($id_cartera > 0){
			$arrayUsuarios = $Usuarios_Controller->select_all_by_id_usuario_in_join_usuario_cartera($id_cartera);
		}else{
			$arrayUsuarios = $Usuarios_Controller->select_all();
		}

		if($arrayUsuarios != null){
			for($i = 0; $i < sizeof($arrayUsuarios); $i++){
				$generalHTML .= '<option value="' . $arrayUsuarios[$i]['id_usuario'] . '">' . $arrayUsuarios[$i]['nombre_completo'] . '</option>';
			}
		}

		exit($generalHTML);
	}
?>