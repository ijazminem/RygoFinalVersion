jQuery(document).ready(function(){
	/**
	 * expresiones regulares
	*/
	let regexDui = /^[0-9]{9}$/;
	let regexName = /^[a-zA-ZáéíóúÁÉÍÓÚÜüñÑ ]{7,}$/;
	let regexPhone = /^[0-9]{8,}$/;
	let regexOccupation = /^[a-zA-ZáéíóúÁÉÍÓÚÜüñÑ ]{5,}$/;
	let regexSalary =  /^(\d)*(\.)?([0-9]{2})?$/;

	/**
	 * ----------------------------------------------------
	 * insert
	 * ----------------------------------------------------
	*/
	/**
	 * variables generales para validación de datos
	*/
    let v_dui = false;
    let v_id_cliente = false;
	let v_nombre_completo = false;
    let v_telefono = true;
	let v_sexo = true;
	let v_profesion = true;
	let v_fecha_nacimiento = true;
	let v_direccion = true;
	let v_direccion_trabajo = true;
	let v_telefono_trabajo = true;
	let v_sueldo = true;
    let v_estado = true;
    let v_id_cartera = true;

	/**
	 * validación de datos
	*/

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
    
    jQuery('#id_cliente').keyup(function(){
        let info = comprobar_validaciones('#id_cliente')

        if(info == 'success'){
            v_id_cliente = true;
        }else{
            v_id_cliente = false;
        }

        input_control('#id_cliente', info);
    });

	/**
	 * nombre_completo
	*/
	jQuery('#nombre_completo').keyup(function(){
		let info = comprobar_validaciones('#nombre_completo', regexName);

		if(info == 'success'){
			v_nombre_completo = true;
		}else{
			v_nombre_completo = false;
		}

		input_control('#nombre_completo', info);
	});

	/**
	 * telefono
	*/
	jQuery('#telefono').keyup(function(){
		let info = comprobar_validaciones('#telefono', regexPhone, true);

		if(info == 'success'){
			v_telefono = true;
		}else if(info == 'empty'){
			v_telefono = true;
		}else{
			v_telefono = false;
		}

		input_control('#telefono', info);
	});

	/**
	 * sexo
	 */
	jQuery('#sexo').change(function(){
		let info = comprobar_validaciones('#sexo');

		if(info == 'success'){
			v_sexo = true;
		}else{
			v_sexo = false;
			input_control('#sexo', info);
		}
	});

	/**
	 * profesion
	 */
	jQuery('#profesion').keyup(function(){
		let info = comprobar_validaciones('#profesion', regexOccupation);

		if(info == 'success'){
			v_profesion = true;
		}else if(info == 'empty'){
			v_profesion = true;
		}else{
			v_profesion = false;
		}

		input_control('#profesion', info);
	});

	/**
	 * fecha_nacimiento
	 */
	jQuery('#fecha_nacimiento').keyup(function(){
		let info = comprobar_validaciones('#fecha_nacimiento');

		if(info == 'success'){
			v_fecha_nacimiento = true;
		}else if(info == 'empty'){
			v_fecha_nacimiento = true;
		}else{
			v_fecha_nacimiento = false;
		}

		input_control('#fecha_nacimiento', info);
	});
	
	/**
	 * direccion
	 */
	jQuery('#direccion').keyup(function(){
		let info = comprobar_validaciones('#direccion');

		if(info == 'success'){
			v_direccion = true;
		}else if(info == 'empty'){
			v_direccion = true;
		}else{
			v_direccion = false;
		}

		input_control('#direccion', info);
	});

		/**
	 * direccion_trabajo
	 */
	jQuery('#direccion_trabajo').keyup(function(){
		let info = comprobar_validaciones('#direccion_trabajo');

		if(info == 'success'){
			v_direccion_trabajo = true;
		}else if(info == 'empty'){
			v_direccion_trabajo = true;
		}else{
			v_direccion_trabajo = false;
		}

		input_control('#direccion_trabajo', info);
	});

	/**
	 * telefono_trabajo
	 */
	jQuery('#telefono_trabajo').keyup(function(){
		let info = comprobar_validaciones('#telefono_trabajo', regexPhone, true);

		if(info == 'success'){
			v_telefono_trabajo = true;
		}else if(info == 'empty'){
			v_telefono_trabajo = true;
		}else{
			v_telefono_trabajo = false;
		}

		input_control('#telefono_trabajo', info);
	});

	/**
	 * Sueldo
	 */
	jQuery('#sueldo').keyup(function(){
		let info = comprobar_validaciones('#sueldo', regexSalary);

		if(info == 'success'){
			v_sueldo = true;
		}else if(info == 'empty'){
			v_sueldo = true;
	
		}else{
			v_sueldo = false;
		}

		input_control('#sueldo', info);
	});

	/**
	 * estado
	*/
	jQuery('#estado').change(function(){
		let info = comprobar_validaciones('#estado');

		if(info == 'success'){
			v_estado = true;
		}else{
			v_estado = false;
        	input_control('#estado', info);    
		}	
	});	

	/**
	 * id_cartera
	*/
	jQuery('#id_cartera').change(function(){
		let info = comprobar_validaciones('#id_cartera');

		if(info == 'success'){
			v_id_cartera = true;
		}else{
			v_id_cartera = false;
			input_control('#id_cartera', info);
		}
	});

	/**
	 * boton
	*/
	jQuery('#btn_agregar_cliente').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

        if(!v_dui){
			input_control('#dui', 'error');
			message += '<b>DUI:</b> Debe agregar un número de DUI válido.<br>';
		}

        if(!v_id_cliente){
			input_control('#id_cliente', 'error');
			message += '<b>ID cliente:</b> Debe agregar un ID válido.<br>';
		}

		if(!v_nombre_completo){
			input_control('#nombre_completo', 'error');
			message += '<b>Nombre Completo:</b> Debe agregar un nombre válido.<br>';
		}

		if(!v_telefono){
			input_control('#telefono', 'error');
			message += '<b>Teléfono:</b> Debe agregar un número de teléfono válido.<br>';
		}

		if(!v_sexo){
			input_control('#sexo', 'error');
			message += '<b>Género:</b> Debe seleccionar un género.<br>';
		}

		if(!v_profesion){
			input_control('#profesion', 'error');
			message += '<b>Profesión:</b> Debe introducir una profesión.<br>';
		}

		if(!v_fecha_nacimiento){
			input_control('#fecha_nacimiento', 'error');
			message += '<b>Fecha de nacimiento:</b> Debe introducir una fecha válida.<br>';
		}
		
		if(!v_direccion){
			input_control('#direccion', 'error');
			message += '<b>Dirección:</b> Debe ingresar una dirección.<br>';
		}
		
		if(!v_direccion_trabajo){
			input_control('#direccion_trabajo', 'error');
			message += '<b>Dirección de trabajo:</b> Debe agregar una dirección de trabajo válida.<br>';
		}

		if(!v_telefono_trabajo){
			input_control('#telefono_trabajo', 'error');
			message += '<b>Teléfono de trabajo:</b> Debe agregar un número de teléfono válido.<br>';
		}
		
		if(!v_sueldo){
			input_control('#sueldo', 'error');
			message += '<b>Sueldo:</b> Debe agregar una cantidad válida.<br>';
		}

		if(!v_estado){
			input_control('#estado', 'error');
			message += '<b>Estado:</b> Debe establecer una opción válida.<br>';
		}

		if(!v_id_cartera){
			input_control('#id_cartera', 'error');
			message += '<b>Id de cartera:</b> Debe seleccionar un Id de cartera válido.<br>';
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
			button_control('#btn_agregar_cliente', 'desactivar', 'Agregando cliente...');

			/**
			 * Recuperación de datos
			*/
            let dui               = jQuery('#dui').val();
            let id_cliente        = jQuery('#id_cliente').val();
			let nombre_completo   = jQuery('#nombre_completo').val();
			let telefono          = jQuery('#telefono').val();
			let sexo 			  = jQuery('#sexo').val();
			let profesion		  = jQuery('#profesion').val();
			let fecha_nacimiento  = jQuery('#fecha_nacimiento').val();
			let direccion		  = jQuery('#direccion').val();
			let direccion_trabajo = jQuery('#direccion_trabajo').val();
			let telefono_trabajo  = jQuery('#telefono_trabajo').val();
			let sueldo 			  = jQuery('#sueldo').val();
			let estado            = jQuery('#estado').val();
			let id_cartera        = jQuery('#id_cartera').val();

			/**
			 * Ajax
			*/
			jQuery.ajax({
				url: URLactual + '/system/ajax/clientes_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'insert',
                    dui: dui,
                    id_cliente: id_cliente,
					nombre_completo: nombre_completo,
                    telefono: telefono,
					sexo: sexo,
					profesion: profesion,
					fecha_nacimiento: fecha_nacimiento,
					direccion: direccion,
					direccion_trabajo: direccion_trabajo,
					telefono_trabajo,
					sueldo: sueldo,
                    estado: estado,
                    id_cartera: id_cartera
				},
				success: function(data){
					try{
						if(data['success']){
							// limpiar campos
                            jQuery('#dui').val('');
                            jQuery('#id_cliente').val('');
							jQuery('#nombre_completo').val('');
							jQuery('#telefono').val('');
							jQuery('#profesion').val('');
							jQuery('#fecha_nacimiento').val('');
							jQuery('#direccion').val('');
							jQuery('#direccion_trabajo').val('');
							jQuery('#telefono_trabajo').val('');
							jQuery('#sueldo').val('');
							
							// Establecer borde por defecto
							input_control('#dui', 'empty');
							input_control('#id_cliente', 'empty');
							input_control('#nombre_completo', 'empty');
							input_control('#telefono', 'empty');
							input_control('#sexo', 'empty')
							input_control('#profesion', 'empty');
							input_control('#fecha_nacimiento', 'empty');
							input_control('#direccion', 'empty');
							input_control('#direccion_trabajo', 'empty');
							input_control('#telefono_trabajo', 'empty');
							input_control('#sueldo', 'empty');
							input_control('#estado', 'empty');
							input_control('#id_cartera', 'empty');

							// resetear variables
                            v_dui = false;
                            v_id_cliente = false;
							v_nombre_completo = false;

							Swal.fire({
								icon: 'success',
								title: 'Cliente Creado',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Crear Cliente',
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

					button_control('#btn_agregar_cliente', 'activar', 'Agregar Cliente');
				},
				error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_agregar_cliente', 'activar', 'Agregar Cliente');
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
	let vu_dui = true;
    let vu_id_cliente = true;
	let vu_nombre_completo = true;
	let vu_telefono = true;
	let vu_sexo = true;
	let vu_profesion = true;
	let vu_fecha_nacimiento = true;
	let vu_direccion = true;
	let vu_direccion_trabajo = true;
	let vu_telefono_trabajo = true;
	let vu_sueldo = true;
	let vu_estado = true;
	let vu_id_cartera = true;

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
	});

    /**
	 * id_cliente
	*/
	jQuery('#id_cliente_u').keyup(function(){
		let info = comprobar_validaciones('#id_cliente_u');

		if(info == 'success'){
			vu_id_cliente = true;
		}else{
			vu_id_cliente = false;
		}

		input_control('#id_cliente_u', info);
	});

	/**
	 * nombre_completo
	*/
	jQuery('#nombre_completo_u').keyup(function(){
		let info = comprobar_validaciones('#nombre_completo_u', regexName);

		if(info == 'success'){
			vu_nombre_completo = true;
		}else{
			vu_nombre_completo = false;
		}

		input_control('#nombre_completo_u', info);
	});

	/**
	 * telefono
	*/
	jQuery('#telefono_u').keyup(function(){
		let info = comprobar_validaciones('#telefono_u', regexPhone, true);

		if(info == 'success'){
			vu_telefono = true;
		}else if(info == 'empty'){
			vu_telefono = true;
		}else{
			vu_telefono = false;
		}

		input_control('#telefono_u', info);
	});


	/**
	 * sexo
	 */
	jQuery('#sexo_u').change(function(){
		let info = comprobar_validaciones('#sexo_u');

		if(info == 'success'){
			vu_sexo = true;
		}else{
			vu_sexo = false;
			input_control('#sexo_u', info);
		}
	});

	/**
	 * profesion
	 */
	jQuery('#profesion_u').keyup(function(){
		let info = comprobar_validaciones('#profesion_u', regexOccupation);

		if(info == 'success'){
			vu_profesion = true;
		}else if(info == 'empty'){
			vu_profesion = true;
		}else{
			vu_profesion = false;
		}

		input_control('#profesion_u', info);
	});

	/**
	 * fecha_nacimiento
	 */
	jQuery('#fecha_nacimiento_u').keyup(function(){
		let info = comprobar_validaciones('#fecha_nacimiento_u');

		if(info == 'success'){
			vu_fecha_nacimiento = true;
		}else if(info == 'empty'){
			vu_fecha_nacimiento = true;
		}else{
			vu_fecha_nacimiento = false;
		}

		input_control('#fecha_nacimiento_u', info);
	});
	
	/**
	 * direccion
	 */
	jQuery('#direccion_u').keyup(function(){
		let info = comprobar_validaciones('#direccion_u');

		if(info == 'success'){
			vu_direccion = true;
		}if(info == 'empty'){
			vu_direccion = true;
		}else{
			vu_direccion = false;
		}

		input_control('#direccion_u', info);
	});

	/**
	 * direccion_trabajo
	*/
	jQuery('#direccion_trabajo_u').keyup(function(){
		let info = comprobar_validaciones('#direccion_trabajo_u');

		if(info == 'success'){
			vu_direccion_trabajo = true;
		}else if(info == 'empty'){
			vu_direccion_trabajo = true;
		}else{
			vu_direccion_trabajo = false;
		}

		input_control('#direccion_trabajo_u', info);
	});

	/**
	 * telefono_trabajo
	 */
	jQuery('#telefono_trabajo_u').keyup(function(){
		let info = comprobar_validaciones('#telefono_trabajo_u', regexPhone, true);

		if(info == 'success'){
			vu_telefono_trabajo = true;
		}else if(info == 'empty'){
			vu_telefono_trabajo = true;
		}else{
			vu_telefono_trabajo = false;
		}

		input_control('#telefono_trabajo_u', info);
	});

	/**
	 * Sueldo
	 */
	jQuery('#sueldo_u').keyup(function(){
		let info = comprobar_validaciones('#sueldo_u', regexSalary);

		if(info == 'success'){
			vu_sueldo = true;
		}else if(info == 'empty'){
			vu_sueldo = true;
		}else{
			vu_sueldo = false;
		}

		input_control('#sueldo_u', info);
	});


	/**
	 * estado
	*/
	jQuery('#estado_u').change(function(){
		let info = comprobar_validaciones('#estado_u');

		if(info == 'success'){
			vu_estado = true;
		}else{
			vu_estado = false;
			input_control('#estado_u', info);
		}
	});

	/**
	 * id_cartera
	*/
	jQuery('#id_cartera_u').change(function(){
		let info = comprobar_validaciones('#id_cartera_u');

		if(info == 'success'){
			vu_id_cartera = true;
		}else{
			vu_id_cartera = false;
			input_control('#id_cartera_u', info);
		}
	});

	/**
	 * boton
	*/
	jQuery('#btn_actualizar_cliente').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

		if(!vu_dui){
			message += '<b>DUI:</b> El dui del cliente no es válido, recarga esta página para volver a cargarlo.<br>';
		}
        if(!vu_id_cliente){
			message += '<b>ID:</b> El id del cliente no es válido, recarga esta página para volver a cargarlo.<br>';
		}

		if(!vu_nombre_completo){
			input_control('#nombre_completo_u', 'error');
			message += '<b>Nombre Completo:</b> Debe agregar un nombre válido.<br>';
		}

		if(!vu_telefono){
			input_control('#telefono_u', 'error');
			message += '<b>Teléfono:</b> Debe agregar un número de teléfono válido.<br>';
		}

		if(!vu_sexo){
			input_control('#sexo_u', 'error');
			message += '<b>Género:</b> Debe seleccionar un género.<br>';
		}

		if(!vu_profesion){
			input_control('#profesion_u', 'error');
			message += '<b>Profesión:</b> Debe introducir una profesión.<br>';
		}

		if(!vu_fecha_nacimiento){
			input_control('#fecha_nacimiento_u', 'error');
			message += '<b>Fecha de nacimiento:</b> Debe introducir una fecha válida.<br>';
		}
		
		if(!vu_direccion){
			input_control('#direccion_u', 'error');
			message += '<b>Dirección:</b> Debe ingresar una dirección.<br>';
		}
		
		if(!vu_direccion_trabajo){
			input_control('#direccion_trabajo_u', 'error');
			message += '<b>Dirección de trabajo:</b> Debe agregar una dirección de trabajo válida.<br>';
		}

		if(!vu_telefono_trabajo){
			input_control('#telefono_trabajo_u', 'error');
			message += '<b>Teléfono de trabajo:</b> Debe agregar un número de teléfono válido.<br>';
		}
		
		if(!vu_sueldo){
			input_control('#sueldo_u', 'error');
			message += '<b>Sueldo:</b> Debe agregar una cantidad válida.<br>';
		}

		if(!vu_estado){
			input_control('#estado_u', 'error');
			message += '<b>Estado:</b> Debe establecer una opción válida.<br>';
		}

		if(!vu_id_cartera){
			input_control('#id_cartera_u', 'error');
			message += '<b>Id de cartera:</b> Debe seleccionar un Id de cartera válido.<br>';
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
			button_control('#btn_actualizar_cliente', 'desactivar', 'Actualizando Cliente...');

			/**
			 * Recuperación de datos
			*/
            let dui               = jQuery('#dui_u').val();
            let id_cliente        = jQuery('#id_cliente_u').val();
			let nombre_completo   = jQuery('#nombre_completo_u').val();
			let telefono          = jQuery('#telefono_u').val();
			let sexo 			  = jQuery('#sexo_u').val();
			let profesion		  = jQuery('#profesion_u').val();
			let fecha_nacimiento  = jQuery('#fecha_nacimiento_u').val();
			let direccion		  = jQuery('#direccion_u').val();
			let direccion_trabajo = jQuery('#direccion_trabajo_u').val();
			let telefono_trabajo  = jQuery('#telefono_trabajo_u').val();
			let sueldo 			  = jQuery('#sueldo_u').val();
			let estado            = jQuery('#estado_u').val();
			let id_cartera        = jQuery('#id_cartera_u').val();

			/**
			 * Ajax
			*/
			jQuery.ajax({
				url: URLactual + '/system/ajax/clientes_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'update',
                    dui: dui,
                    id_cliente: id_cliente,
					nombre_completo: nombre_completo,
                    telefono: telefono,
					sexo: sexo,
					profesion: profesion,
					fecha_nacimiento: fecha_nacimiento,
					direccion: direccion,
					direccion_trabajo: direccion_trabajo,
					telefono_trabajo,
					sueldo: sueldo,
                    estado: estado,
                    id_cartera: id_cartera
				},
				success: function(data){
					try{
						if(data['success']){
							// Establecer borde por defecto
							input_control('#dui_u', 'empty');
							input_control('#id_cliente_u', 'empty');
							input_control('#nombre_completo_u', 'empty');
							input_control('#telefono_u', 'empty');
							input_control('#sexo', 'empty')
							input_control('#profesion', 'empty');
							input_control('#fecha_nacimiento', 'empty');
							input_control('#direccion', 'empty');
							input_control('#direccion_trabajo', 'empty');
							input_control('#telefono_trabajo', 'empty');
							input_control('#sueldo', 'empty');
							input_control('#estado_u', 'empty');
							input_control('#id_cartera_u', 'empty');

							Swal.fire({
								icon: 'success',
								title: 'Cliente Actualizado',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Actualizar Cliente',
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

					button_control('#btn_actualizar_cliente', 'activar', 'Actualizar Cliente');
				},
				error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_actualizar_cliente', 'activar', 'Actualizar Cliente');
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
	jQuery('.btn_eliminar_cliente').click(function(){
		Swal.fire({
			icon: 'warning',
			title: '¿Está seguro que quiere eliminar a éste cliente?',
			text: 'Si elimina éste cliente, también se eliminarán todos los datos relacionados a él.',
			showCancelButton: true,
			confirmButtonText: 'Eliminar',
			confirmButtonColor: '#cf433f',
			cancelButtonText: 'Cancelar',
			cancelButtonColor: '#ccc',
		}).then((result) => {
			if(result.isConfirmed){
				// Ajax Delete
				let dui = jQuery(this).data('id');

				jQuery.ajax({
					url: URLactual + '/system/ajax/clientes_ajax.php',
					type: 'POST',
					dataType: 'json',
					data: {
						action: 'delete',
						dui: dui
					},
					success: function(data){
						try{
							if(data['success']){
								Swal.fire({
									icon: 'success',
									title: 'Cliente Eliminado',
									text: data['message'],
									confirmButtonText: 'Aceptar',
									confirmButtonColor: '#2BC521'
								});

								let id = '#dui_' + dui;
                                let tabla_clientes = jQuery('#Tabla_Clientes').DataTable();
                                tabla_clientes.row(id).remove().draw();
							}else{
								Swal.fire({
									icon: 'error',
									title: 'Error Al Eliminar Cliente',
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