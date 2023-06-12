jQuery(document).ready(function(){
	/**
	 * expresiones regulares
	*/
	let regexDui = /^[0-9]{9}$/;

	/**
	 * ----------------------------------------------------
	 * insert
	 * ----------------------------------------------------
	*/
	/**
	 * variables generales para validación de datos
	*/
	let v_numero_factura = true;
	let v_total_deuda = false;
	let v_valor_cuotas = false;
	let v_numero_cuotas = false;
	let v_ultima_fecha_pago = false;
	let v_dia_pago = true;
	let v_numero_cuotas_pendientes = true;
	let v_total_pendiente = true;
	let v_numero_cuotas_pagadas = true;
	let v_total_pagado = true;
	let v_porcentaje_mora = true;
	let v_valor_mora = false;
	let v_numero_cuotas_mora = true;
	let v_total_mora = true;
	let v_total_deuda_mora = false;
	let v_dui = true;

	/**
	 * validación de datos
	*/
	/**
	 * numero_factura
	*/
	jQuery('#numero_factura').keyup(function(){
		let info = comprobar_validaciones('#numero_factura');

		if(info == 'success'){
			v_numero_factura = true;
		}else if(info == 'empty'){
			v_numero_factura = true;
		}else{
			v_numero_factura = false;
		}

		input_control('#numero_factura', info);
	});

	/**
	 * total_deuda
	*/
	jQuery('#total_deuda').keyup(function(){
		let info = comprobar_validaciones('#total_deuda');

		if(info == 'success'){
			v_total_deuda = true;
		}else{
			v_total_deuda = false;
		}

		input_control('#total_deuda', info);
	});

	/**
	 * valor_cuotas
	*/
	jQuery('#valor_cuotas').keyup(function(){
		let info = comprobar_validaciones('#valor_cuotas');

		if(info == 'success'){
			v_valor_cuotas = true;
		}else{
			v_valor_cuotas = false;
		}

		input_control('#valor_cuotas', info);
	});

	/**
	 * numero_cuotas
	*/
	jQuery('#numero_cuotas').keyup(function(){
		let info = comprobar_validaciones('#numero_cuotas');

		if(info == 'success'){
			v_numero_cuotas = true;
		}else{
			v_numero_cuotas = false;
		}

		input_control('#numero_cuotas', info);
	});

	/**
	 * ultima_fecha_pago
	*/
	jQuery('#ultima_fecha_pago').change(function(){
		let info = comprobar_validaciones('#ultima_fecha_pago');

		if(info == 'success'){
			v_ultima_fecha_pago = true;
		}else{
			v_ultima_fecha_pago = false;
		}

		input_control('#ultima_fecha_pago', info);
	});

	/**
	 * dia_pago
	*/
	jQuery('#dia_pago').keyup(function(){
		let info = comprobar_validaciones('#dia_pago');

		if(info == 'success'){
			v_dia_pago = true;
		}else if(info == 'empty'){
			v_dia_pago = true;
		}else{
			v_dia_pago = false;
		}

		input_control('#dia_pago', info);
	});

	/**
	 * numero_cuotas_pendientes
	*/
	jQuery('#numero_cuotas_pendientes').keyup(function(){
		let info = comprobar_validaciones('#numero_cuotas_pendientes');

		if(info == 'success'){
			v_numero_cuotas_pendientes = true;
		}else if(info == 'empty'){
			v_numero_cuotas_pendientes = true;
		}else{
			v_numero_cuotas_pendientes = false;
		}

		input_control('#numero_cuotas_pendientes', info);
	});

	/**
	 * total_pendiente
	*/
	jQuery('#total_pendiente').keyup(function(){
		let info = comprobar_validaciones('#total_pendiente');

		if(info == 'success'){
			v_total_pendiente = true;
		}else if(info == 'empty'){
			v_total_pendiente = true;
		}else{
			v_total_pendiente = false;
		}

		input_control('#total_pendiente', info);
	});

	/**
	 * numero_cuotas_pagadas
	*/
	jQuery('#numero_cuotas_pagadas').keyup(function(){
		let info = comprobar_validaciones('#numero_cuotas_pagadas');

		if(info == 'success'){
			v_numero_cuotas_pagadas = true;
		}else if(info == 'empty'){
			v_numero_cuotas_pagadas = true;
		}else{
			v_numero_cuotas_pagadas = false;
		}

		input_control('#numero_cuotas_pagadas', info);
	});

	/**
	 * total_pagado
	*/
	jQuery('#total_pagado').keyup(function(){
		let info = comprobar_validaciones('#total_pagado');

		if(info == 'success'){
			v_total_pagado = true;
		}else if(info == 'empty'){
			v_total_pagado = true;
		}else{
			v_total_pagado = false;
		}

		input_control('#total_pagado', info);
	});

	/**
	 * porcentaje_mora
	*/
	jQuery('#porcentaje_mora').keyup(function(){
		let info = comprobar_validaciones('#porcentaje_mora');

		if(info == 'success'){
			v_porcentaje_mora = true;
		}else{
			v_porcentaje_mora = false;
		}

		input_control('#porcentaje_mora', info);
	});

	/**
	 * valor_mora
	*/
	jQuery('#valor_mora').keyup(function(){
		let info = comprobar_validaciones('#valor_mora');

		if(info == 'success'){
			v_valor_mora = true;
		}else{
			v_valor_mora = false;
		}

		input_control('#valor_mora', info);
	});

	/**
	 * numero_cuotas_mora
	*/
	jQuery('#numero_cuotas_mora').keyup(function(){
		let info = comprobar_validaciones('#numero_cuotas_mora');

		if(info == 'success'){
			v_numero_cuotas_mora = true;
		}else if(info == 'empty'){
			v_numero_cuotas_mora = true;
		}else{
			v_numero_cuotas_mora = false;
		}

		input_control('#numero_cuotas_mora', info);
	});

	/**
	 * total_mora
	*/
	jQuery('#total_mora').keyup(function(){
		let info = comprobar_validaciones('#total_mora');

		if(info == 'success'){
			v_total_mora = true;
		}else if(info == 'empty'){
			v_total_mora = true;
		}else{
			v_total_mora = false;
		}

		input_control('#total_mora', info);
	});

	/**
	 * total_deuda_mora
	*/
	jQuery('#total_deuda_mora').keyup(function(){
		let info = comprobar_validaciones('#total_deuda_mora');

		if(info == 'success'){
			v_total_deuda_mora = true;
		}else{
			v_total_deuda_mora = false;
		}

		input_control('#total_deuda_mora', info);
	});

	/**
	 * dui
	*/
	jQuery('#dui').keyup(function(){
		let info = comprobar_validaciones('#dui', regexDui);

		if(info == 'success'){
			v_dui = true;
		}else{
			v_dui = false;
		}

		input_control('#dui', info);
	});

	/**
	 * boton
	*/
	jQuery('#btn_agregar_deuda').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

		if(!v_numero_factura){
			input_control('#numero_factura', 'error');
			message += '<b>Número de Factura:</b> Debe agregar un número de Factura válido.<br>';
		}

		if(!v_total_deuda){
			input_control('#total_deuda', 'error');
			message += '<b>Total de la Deuda:</b> Debe agregar un total de deuda válido.<br>';
		}

		if(!v_valor_cuotas){
			input_control('#valor_cuotas', 'error');
			message += '<b>Valor de la Cuota:</b> Debe agregar un valor válido para las cuotas.<br>';
		}

		if(!v_numero_cuotas){
			input_control('#numero_cuotas', 'error');
			message += '<b>Número de Cuotas:</b> Debe agregar un número de cuotas válido.<br>';
		}

		if(!v_ultima_fecha_pago){
			input_control('#ultima_fecha_pago', 'error');
			message += '<b>Última fecha de pago:</b> Debe agregar una fecha válida.<br>';
		}

		if(!v_dia_pago){
			input_control('#dia_pago', 'error');
			message += '<b>Día de Pago:</b> Debe agregar un día de pago válido.<br>';
		}

		if(!v_numero_cuotas_pendientes){
			input_control('#numero_cuotas_pendientes', 'error');
			message += '<b>Número de Cuotas Pendientes:</b> Debe agregar un número de cuotas válido.<br>';
		}

		if(!v_total_pendiente){
			input_control('#total_pendiente', 'error');
			message += '<b>Total Pendiente:</b> Debe agregar un valor válido.<br>';
		}

		if(!v_numero_cuotas_pagadas){
			input_control('#numero_cuotas_pagadas', 'error');
			message += '<b>Número de Cuotas Pagadas:</b> Debe agregar un número de cuotas válido.<br>';
		}

		if(!v_total_pagado){
			input_control('#total_pagado', 'error');
			message += '<b>Total Pagado:</b> Debe agregar un valor válido.<br>';
		}

		if(!v_porcentaje_mora){
			input_control('#porcentaje_mora', 'error');
			message += '<b>Porcentaje de Mora:</b> Debe agregar un porcentaje válido.<br>';
		}

		if(!v_valor_mora){
			input_control('#valor_mora', 'error');
			message += '<b>Valor de la Mora:</b> Debe agregar un valor de válido.<br>';
		}

		if(!v_numero_cuotas_mora){
			input_control('#numero_cuotas_mora', 'error');
			message += '<b>Número de Cuotas con Mora:</b> Debe agregar un número de cuotas válido.<br>';
		}

		if(!v_total_mora){
			input_control('#total_mora', 'error');
			message += '<b>Total de la Mora:</b> Debe agregar un valor válido.<br>';
		}

		if(!v_total_deuda_mora){
			input_control('#total_deuda_mora', 'error');
			message += '<b>Total de la Deuda + Mora:</b> Debe agregar un valor válido.<br>';
		}

		if(!v_dui){
			input_control('#dui', 'error');
			message += '<b>DUI:</b> Debe agregar un número de DUI válido.<br>';
		}

		/**
		 * Si hay errores mostrarlos, sino realizar la petición ajax
		*/
		if(message != ''){
			Swal.fire({
				icon: 'warning',
				title: 'Validaciones',
				html: message,
				confirmButtonText: 'Aceptar',
				confirmButtonColor: '#2BC521'
			});
		}else{
			/**
			 * Deshabilitar botón
			*/
			button_control('#btn_agregar_deuda', 'desactivar', 'Agregando Deuda...');

			/**
			 * Recuperación de datos
			*/
			let numero_factura           = jQuery('#numero_factura').val();
			let total_deuda              = jQuery('#total_deuda').val();
			let valor_cuotas             = jQuery('#valor_cuotas').val();
			let numero_cuotas            = jQuery('#numero_cuotas').val();
			let ultima_fecha_pago        = jQuery('#ultima_fecha_pago').val();
			let dia_pago                 = jQuery('#dia_pago').val();
			let numero_cuotas_pendientes = jQuery('#numero_cuotas_pendientes').val();
			let total_pendiente          = jQuery('#total_pendiente').val();
			let numero_cuotas_pagadas    = jQuery('#numero_cuotas_pagadas').val();
			let total_pagado             = jQuery('#total_pagado').val();
			let porcentaje_mora          = jQuery('#porcentaje_mora').val();
			let valor_mora               = jQuery('#valor_mora').val();
			let numero_cuotas_mora       = jQuery('#numero_cuotas_mora').val();
			let total_mora               = jQuery('#total_mora').val();
			let total_deuda_mora         = jQuery('#total_deuda_mora').val();
			let dui                      = jQuery('#dui').val();

			/**
			 * Ajax
			*/
			jQuery.ajax({
				url: URLactual + '/system/ajax/deudas_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'insert',
					numero_factura: numero_factura,
					total_deuda: total_deuda,
					valor_cuotas: valor_cuotas,
					numero_cuotas: numero_cuotas,
					ultima_fecha_pago: ultima_fecha_pago,
					dia_pago: dia_pago,
					numero_cuotas_pendientes: numero_cuotas_pendientes,
					total_pendiente: total_pendiente,
					numero_cuotas_pagadas: numero_cuotas_pagadas,
					total_pagado: total_pagado,
					porcentaje_mora: porcentaje_mora,
					valor_mora: valor_mora,
					numero_cuotas_mora: numero_cuotas_mora,
					total_mora: total_mora,
					total_deuda_mora: total_deuda_mora,
					dui: dui
				},
				success: function(data){
					try{
						if(data['success']){
							// limpiar campos
							jQuery('#numero_factura').val('');
							jQuery('#total_deuda').val('');
							jQuery('#valor_cuotas').val('');
							jQuery('#numero_cuotas').val('');
							jQuery('#ultima_fecha_pago').val('');
							jQuery('#dia_pago').val('');
							jQuery('#numero_cuotas_pendientes').val('');
							jQuery('#total_pendiente').val('');
							jQuery('#numero_cuotas_pagadas').val('');
							jQuery('#total_pagado').val('');
							jQuery('#porcentaje_mora').val('');
							jQuery('#valor_mora').val('');
							jQuery('#numero_cuotas_mora').val('');
							jQuery('#total_mora').val('');
							jQuery('#total_deuda_mora').val('');

							// Establecer borde por defecto
							input_control('#numero_factura', 'empty');
							input_control('#total_deuda', 'empty');
							input_control('#valor_cuotas', 'empty');
							input_control('#numero_cuotas', 'empty');
							input_control('#ultima_fecha_pago', 'empty');
							input_control('#dia_pago', 'empty');
							input_control('#numero_cuotas_pendientes', 'empty');
							input_control('#total_pendiente', 'empty');
							input_control('#numero_cuotas_pagadas', 'empty');
							input_control('#total_pagado', 'empty');
							input_control('#porcentaje_mora', 'empty');
							input_control('#valor_mora', 'empty');
							input_control('#numero_cuotas_mora', 'empty');
							input_control('#total_mora', 'empty');
							input_control('#total_deuda_mora', 'empty');
							input_control('#dui', 'empty');

							v_total_deuda = false;
							v_valor_cuotas = false;
							v_numero_cuotas = false;
							v_ultima_fecha_pago = false;
							v_valor_mora = false;
							v_total_deuda_mora = false;

							Swal.fire({
								icon: 'success',
								title: 'Deuda Creada',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Crear Deuda',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}
					}catch(e){
						Swal.fire({
							icon: 'error',
							title: 'Error Del Servidor',
							text: e,
							confirmButtonText: 'Aceptar',
							confirmButtonColor: '#2BC521'
						});
					}

					button_control('#btn_agregar_deuda', 'activar', 'Agregar Deuda');
				},
				error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_agregar_deuda', 'activar', 'Agregar Deuda');
				}
			});
		}
	});

	/**
	 * ----------------------------------------------------
	 * update
	 * ----------------------------------------------------
	*/
	/**
	 * variables generales para validación de datos
	*/
	let vu_id_deuda = true;
	let vu_numero_factura = true;
	let vu_total_deuda = true;
	let vu_valor_cuotas = true;
	let vu_numero_cuotas = true;
	let vu_ultima_fecha_pago = true;
	let vu_dia_pago = true;
	let vu_numero_cuotas_pendientes = true;
	let vu_total_pendiente = true;
	let vu_numero_cuotas_pagadas = true;
	let vu_total_pagado = true;
	let vu_porcentaje_mora = true;
	let vu_valor_mora = true;
	let vu_numero_cuotas_mora = true;
	let vu_total_mora = true;
	let vu_total_deuda_mora = true;
	let vu_dui = true;

	/**
	 * id_deuda
	*/
	jQuery('#id_deuda_u').keyup(function(){
		let info = comprobar_validaciones('#id_deuda_u');

		if(info == 'success'){
			vu_id_deuda = true;
		}else{
			vu_id_deuda = false;
		}
	});

	/**
	 * numero_factura
	*/
	jQuery('#numero_factura_u').keyup(function(){
		let info = comprobar_validaciones('#numero_factura_u');

		if(info == 'success'){
			vu_numero_factura = true;
		}else if(info == 'empty'){
			vu_numero_factura = true;
		}else{
			vu_numero_factura = false;
		}

		input_control('#numero_factura_u', info);
	});

	/**
	 * total_deuda
	*/
	jQuery('#total_deuda_u').keyup(function(){
		let info = comprobar_validaciones('#total_deuda_u');

		if(info == 'success'){
			vu_total_deuda = true;
		}else{
			vu_total_deuda = false;
		}

		input_control('#total_deuda_u', info);
	});

	/**
	 * valor_cuotas
	*/
	jQuery('#valor_cuotas_u').keyup(function(){
		let info = comprobar_validaciones('#valor_cuotas_u');

		if(info == 'success'){
			vu_valor_cuotas = true;
		}else{
			vu_valor_cuotas = false;
		}

		input_control('#valor_cuotas_u', info);
	});

	/**
	 * numero_cuotas
	*/
	jQuery('#numero_cuotas_u').keyup(function(){
		let info = comprobar_validaciones('#numero_cuotas_u');

		if(info == 'success'){
			vu_numero_cuotas = true;
		}else{
			vu_numero_cuotas = false;
		}

		input_control('#numero_cuotas_u', info);
	});

	/**
	 * ultima_fecha_pago
	*/
	jQuery('#ultima_fecha_pago_u').change(function(){
		let info = comprobar_validaciones('#ultima_fecha_pago_u');

		if(info == 'success'){
			vu_ultima_fecha_pago = true;
		}else{
			vu_ultima_fecha_pago = false;
		}

		input_control('#ultima_fecha_pago_u', info);
	});

	/**
	 * dia_pago
	*/
	jQuery('#dia_pago_u').keyup(function(){
		let info = comprobar_validaciones('#dia_pago_u');

		if(info == 'success'){
			vu_dia_pago = true;
		}else if(info == 'empty'){
			vu_dia_pago = true;
		}else{
			vu_dia_pago = false;
		}

		input_control('#dia_pago_u', info);
	});

	/**
	 * numero_cuotas_pendientes
	*/
	jQuery('#numero_cuotas_pendientes_u').keyup(function(){
		let info = comprobar_validaciones('#numero_cuotas_pendientes_u');

		if(info == 'success'){
			vu_numero_cuotas_pendientes = true;
		}else if(info == 'empty'){
			vu_numero_cuotas_pendientes = true;
		}else{
			vu_numero_cuotas_pendientes = false;
		}

		input_control('#numero_cuotas_pendientes_u', info);
	});

	/**
	 * total_pendiente
	*/
	jQuery('#total_pendiente_u').keyup(function(){
		let info = comprobar_validaciones('#total_pendiente_u');

		if(info == 'success'){
			vu_total_pendiente = true;
		}else if(info == 'empty'){
			vu_total_pendiente = true;
		}else{
			vu_total_pendiente = false;
		}

		input_control('#total_pendiente_u', info);
	});

	/**
	 * numero_cuotas_pagadas
	*/
	jQuery('#numero_cuotas_pagadas_u').keyup(function(){
		let info = comprobar_validaciones('#numero_cuotas_pagadas_u');

		if(info == 'success'){
			vu_numero_cuotas_pagadas = true;
		}else if(info == 'empty'){
			vu_numero_cuotas_pagadas = true;
		}else{
			vu_numero_cuotas_pagadas = false;
		}

		input_control('#numero_cuotas_pagadas_u', info);
	});

	/**
	 * total_pagado
	*/
	jQuery('#total_pagado_u').keyup(function(){
		let info = comprobar_validaciones('#total_pagado_u');

		if(info == 'success'){
			vu_total_pagado = true;
		}else if(info == 'empty'){
			vu_total_pagado = true;
		}else{
			vu_total_pagado = false;
		}

		input_control('#total_pagado_u', info);
	});

	/**
	 * porcentaje_mora
	*/
	jQuery('#porcentaje_mora_u').keyup(function(){
		let info = comprobar_validaciones('#porcentaje_mora_u');

		if(info == 'success'){
			vu_porcentaje_mora = true;
		}else{
			vu_porcentaje_mora = false;
		}

		input_control('#porcentaje_mora_u', info);
	});

	/**
	 * valor_mora
	*/
	jQuery('#valor_mora_u').keyup(function(){
		let info = comprobar_validaciones('#valor_mora_u');

		if(info == 'success'){
			vu_valor_mora = true;
		}else{
			vu_valor_mora = false;
		}

		input_control('#valor_mora_u', info);
	});

	/**
	 * numero_cuotas_mora
	*/
	jQuery('#numero_cuotas_mora_u').keyup(function(){
		let info = comprobar_validaciones('#numero_cuotas_mora_u');

		if(info == 'success'){
			vu_numero_cuotas_mora = true;
		}else if(info == 'empty'){
			vu_numero_cuotas_mora = true;
		}else{
			vu_numero_cuotas_mora = false;
		}

		input_control('#numero_cuotas_mora_u', info);
	});

	/**
	 * total_mora
	*/
	jQuery('#total_mora_u').keyup(function(){
		let info = comprobar_validaciones('#total_mora_u');

		if(info == 'success'){
			vu_total_mora = true;
		}else if(info == 'empty'){
			vu_total_mora = true;
		}else{
			vu_total_mora = false;
		}

		input_control('#total_mora_u', info);
	});

	/**
	 * total_deuda_mora
	*/
	jQuery('#total_deuda_mora_u').keyup(function(){
		let info = comprobar_validaciones('#total_deuda_mora_u');

		if(info == 'success'){
			vu_total_deuda_mora = true;
		}else{
			vu_total_deuda_mora = false;
		}

		input_control('#total_deuda_mora_u', info);
	});

	/**
	 * dui
	*/
	jQuery('#dui_u').keyup(function(){
		let info = comprobar_validaciones('#dui_u', regexDui);

		if(info == 'success'){
			vu_dui = true;
		}else{
			vu_dui = false;
		}

		input_control('#dui_u', info);
	});

	/**
	 * boton
	*/
	jQuery('#btn_actualizar_deuda').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

		if(!vu_id_deuda){
			message += '<b>Id Deuda:</b> El Id de la deuda no es válido, recarga esta página para volver a cargarlo.<br>';
		}

		if(!vu_numero_factura){
			input_control('#numero_factura_u', 'error');
			message += '<b>Número de Factura:</b> Debe agregar un número de Factura válido.<br>';
		}

		if(!vu_total_deuda){
			input_control('#total_deuda_u', 'error');
			message += '<b>Total de la Deuda:</b> Debe agregar un total de deuda válido.<br>';
		}

		if(!vu_valor_cuotas){
			input_control('#valor_cuotas_u', 'error');
			message += '<b>Valor de la Cuota:</b> Debe agregar un valor válido para las cuotas.<br>';
		}

		if(!vu_numero_cuotas){
			input_control('#numero_cuotas_u', 'error');
			message += '<b>Número de Cuotas:</b> Debe agregar un número de cuotas válido.<br>';
		}

		if(!vu_ultima_fecha_pago){
			input_control('#ultima_fecha_pago_u', 'error');
			message += '<b>Última fecha de pago:</b> Debe agregar una fecha válida.<br>';
		}

		if(!vu_dia_pago){
			input_control('#dia_pago_u', 'error');
			message += '<b>Día de Pago:</b> Debe agregar un día de pago válido.<br>';
		}

		if(!vu_numero_cuotas_pendientes){
			input_control('#numero_cuotas_pendientes_u', 'error');
			message += '<b>Número de Cuotas Pendientes:</b> Debe agregar un número de cuotas válido.<br>';
		}

		if(!vu_total_pendiente){
			input_control('#total_pendiente_u', 'error');
			message += '<b>Total Pendiente:</b> Debe agregar un valor válido.<br>';
		}

		if(!vu_numero_cuotas_pagadas){
			input_control('#numero_cuotas_pagadas_u', 'error');
			message += '<b>Número de Cuotas Pagadas:</b> Debe agregar un número de cuotas válido.<br>';
		}

		if(!vu_total_pagado){
			input_control('#total_pagado_u', 'error');
			message += '<b>Total Pagado:</b> Debe agregar un valor válido.<br>';
		}

		if(!vu_porcentaje_mora){
			input_control('#porcentaje_mora_u', 'error');
			message += '<b>Porcentaje de Mora:</b> Debe agregar un porcentaje válido.<br>';
		}

		if(!vu_valor_mora){
			input_control('#valor_mora_u', 'error');
			message += '<b>Valor de la Mora:</b> Debe agregar un valor de válido.<br>';
		}

		if(!vu_numero_cuotas_mora){
			input_control('#numero_cuotas_mora_u', 'error');
			message += '<b>Número de Cuotas con Mora:</b> Debe agregar un número de cuotas válido.<br>';
		}

		if(!vu_total_mora){
			input_control('#total_mora_u', 'error');
			message += '<b>Total de la Mora:</b> Debe agregar un valor válido.<br>';
		}

		if(!vu_total_deuda_mora){
			input_control('#total_deuda_mora_u', 'error');
			message += '<b>Total de la Deuda + Mora:</b> Debe agregar un valor válido.<br>';
		}

		if(!vu_dui){
			input_control('#dui_u', 'error');
			message += '<b>DUI:</b> Debe agregar un número de DUI válido.<br>';
		}

		/**
		 * Si hay errores mostrarlos, sino realizar el ajax
		*/
		if(message != ''){
			Swal.fire({
				icon: 'warning',
				title: 'Validaciones',
				html: message,
				confirmButtonText: 'Aceptar',
				confirmButtonColor: '#2BC521'
			});
		}else{
			/**
			 * Deshabilitar botón
			*/
			button_control('#btn_actualizar_deuda', 'desactivar', 'Actualizando Deuda...');

			/**
			 * Recuperación de datos
			*/
			let id_deuda                 = jQuery('#id_deuda_u').val();
			let numero_factura           = jQuery('#numero_factura_u').val();
			let total_deuda              = jQuery('#total_deuda_u').val();
			let valor_cuotas             = jQuery('#valor_cuotas_u').val();
			let numero_cuotas            = jQuery('#numero_cuotas_u').val();
			let ultima_fecha_pago        = jQuery('#ultima_fecha_pago_u').val();
			let dia_pago                 = jQuery('#dia_pago_u').val();
			let numero_cuotas_pendientes = jQuery('#numero_cuotas_pendientes_u').val();
			let total_pendiente          = jQuery('#total_pendiente_u').val();
			let numero_cuotas_pagadas    = jQuery('#numero_cuotas_pagadas_u').val();
			let total_pagado             = jQuery('#total_pagado_u').val();
			let porcentaje_mora          = jQuery('#porcentaje_mora_u').val();
			let valor_mora               = jQuery('#valor_mora_u').val();
			let numero_cuotas_mora       = jQuery('#numero_cuotas_mora_u').val();
			let total_mora               = jQuery('#total_mora_u').val();
			let total_deuda_mora         = jQuery('#total_deuda_mora_u').val();
			let dui                      = jQuery('#dui_u').val();

			/**
			 * Ajax
			*/
			jQuery.ajax({
				url: URLactual + '/system/ajax/deudas_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'update',
					id_deuda: id_deuda,
					numero_factura: numero_factura,
					total_deuda: total_deuda,
					valor_cuotas: valor_cuotas,
					numero_cuotas: numero_cuotas,
					ultima_fecha_pago: ultima_fecha_pago,
					dia_pago: dia_pago,
					numero_cuotas_pendientes: numero_cuotas_pendientes,
					total_pendiente: total_pendiente,
					numero_cuotas_pagadas: numero_cuotas_pagadas,
					total_pagado: total_pagado,
					porcentaje_mora: porcentaje_mora,
					valor_mora: valor_mora,
					numero_cuotas_mora: numero_cuotas_mora,
					total_mora: total_mora,
					total_deuda_mora: total_deuda_mora,
					dui: dui,
				},
				success: function(data){
					try{
						if(data['success']){
							// Establecer borde por defecto
							input_control('#id_deuda_u', 'empty');
							input_control('#numero_factura_u', 'empty');
							input_control('#total_deuda_u', 'empty');
							input_control('#valor_cuotas_u', 'empty');
							input_control('#numero_cuotas_u', 'empty');
							input_control('#ultima_fecha_pago_u', 'empty');
							input_control('#dia_pago_u', 'empty');
							input_control('#numero_cuotas_pendientes_u', 'empty');
							input_control('#total_pendiente_u', 'empty');
							input_control('#numero_cuotas_pagadas_u', 'empty');
							input_control('#total_pagado_u', 'empty');
							input_control('#porcentaje_mora_u', 'empty');
							input_control('#valor_mora_u', 'empty');
							input_control('#numero_cuotas_mora_u', 'empty');
							input_control('#total_mora_u', 'empty');
							input_control('#total_deuda_mora_u', 'empty');
							input_control('#dui_u', 'empty');

							Swal.fire({
								icon: 'success',
								title: 'Deuda Actualizada',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Actualizar Deuda',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}
					}catch(e){
						Swal.fire({
							icon: 'error',
							title: 'Error Del Servidor',
							text: e,
							confirmButtonText: 'Aceptar',
							confirmButtonColor: '#2BC521'
						});
					}

					button_control('#btn_actualizar_deuda', 'activar', 'Actualizar Deuda');
				},
				error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_actualizar_deuda', 'activar', 'Actualizar Deuda');
				}
			});
		}
	});

	/**
	 * ----------------------------------------------------
	 * delete
	 * ----------------------------------------------------
	*/
	/**
	 * botón
	*/
	jQuery('.btn_eliminar_deuda').click(function(){
		Swal.fire({
			icon: 'warning',
			title: '¿Está seguro que quiere eliminar a ésta deuda?',
			text: 'Si elimina ésta deuda, también se eliminarán todos los datos relacionados a ella.',
			showCancelButton: true,
			confirmButtonText: 'Eliminar',
			confirmButtonColor: '#cf433f',
			cancelButtonText: 'Cancelar',
			cancelButtonColor: '#ccc',
		}).then((result) => {
			if(result.isConfirmed){
				// Ajax Delete
				let id_deuda = jQuery(this).data('id');

				jQuery.ajax({
					url: URLactual + '/system/ajax/deudas_ajax.php',
					type: 'POST',
					dataType: 'json',
					data: {
						action: 'delete',
						id_deuda: id_deuda
					},
					success: function(data){
						try{
							if(data['success']){
								Swal.fire({
									icon: 'success',
									title: 'Deuda Eliminada',
									text: data['message'],
									confirmButtonText: 'Aceptar',
									confirmButtonColor: '#2BC521'
								});

								let id = '#id_deuda_' + id_deuda;
								let tabla_deudas = jQuery('#Tabla_Deudas').DataTable();
                                tabla_deudas.row(id).remove().draw();
							}else{
								Swal.fire({
									icon: 'error',
									title: 'Error Al Eliminar Deuda',
									text: data['message'],
									confirmButtonText: 'Aceptar',
									confirmButtonColor: '#2BC521'
								});
							}
						}catch(e){
							Swal.fire({
								icon: 'error',
								title: 'Error Del Servidor',
								text: e,
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}
					},
					error: function(data){
						Swal.fire({
							icon: 'error',
							title: 'Error De Conexión',
							text: 'Revise su conexión a internet e inténtelo de nuevo.',
							confirmButtonText: 'Aceptar',
							confirmButtonColor: '#2BC521'
						});
					}
				});
			}
		});
	});
});