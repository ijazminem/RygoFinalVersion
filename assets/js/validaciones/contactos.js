jQuery(document).ready(function(){
	/**
	 * expresiones regulares
	*/
	let regexDui = /^[0-9]{9}$/;
	let regexName = /^[a-zA-ZáéíóúÁÉÍÓÚÜüñÑ ]{7,}$/;
	let regexPhone = /^[0-9]{8,}$/;

	/**
	 * ----------------------------------------------------
	 * insert
	 * ----------------------------------------------------
	*/
	/**
	 * variables generales para validación de datos
	*/
	let v_nombre_completo = false;
	let v_direccion = false;
    let v_telefono = false;
    let v_parentezco = true;
    let v_trabajo = true;
    let v_direccion_trabajo = true;
    let v_telefono_trabajo = true;
    let v_tipo_contacto = true;
    let v_dui = true;

	/**
	 * validación de datos
	*/
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
	 * direccion
	*/
	jQuery('#direccion').keyup(function(){
		let info = comprobar_validaciones('#direccion', null, false, 8);

		if(info == 'success'){
			v_direccion = true;
		}else{
			v_direccion = false;
		}

		input_control('#direccion', info);
	});

	/**
	 * telefono
	*/
	jQuery('#telefono').keyup(function(){
		let info = comprobar_validaciones('#telefono', regexPhone);

		if(info == 'success'){
			v_telefono = true;
		}else{
			v_telefono = false;
		}

		input_control('#telefono', info);
	});

	/**
	 * parentezco
	*/
	jQuery('#parentezco').keyup(function(){
		let info = comprobar_validaciones('#parentezco');

		if(info == 'success'){
			v_parentezco = true;
		}else if(info == 'empty'){
			v_parentezco = true;
		}else{
			v_parentezco = false;
		}

		input_control('#parentezco', info);
	});

	/**
	 * trabajo
	*/
	jQuery('#trabajo').keyup(function(){
		let info = comprobar_validaciones('#trabajo');

		if(info == 'success'){
			v_trabajo = true;
		}else if(info == 'empty'){
			v_trabajo = true;
		}else{
			v_trabajo = false;
		}

		input_control('#trabajo', info);
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
	 * tipo_contacto
	*/
	jQuery('#tipo_contacto').change(function(){
		let info = comprobar_validaciones('#tipo_contacto');

		if(info == 'success'){
			v_tipo_contacto = true;
		}else{
			v_tipo_contacto = false;

			input_control('#tipo_contacto', info);
		}
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
	jQuery('#btn_agregar_contacto').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

		if(!v_nombre_completo){
			input_control('#nombre_completo', 'error');
			message += '<b>Nombre Completo:</b> Debe agregar un nombre válido.<br>';
		}

		if(!v_direccion){
			input_control('#direccion', 'error');
			message += '<b>Dirección:</b> Debe agregar una dirección válida.<br>';
		}

		if(!v_telefono){
			input_control('#telefono', 'error');
			message += '<b>Teléfono:</b> Debe agregar un número de teléfono válido.<br>';
		}

		if(!v_parentezco){
			input_control('#parentezco', 'error');
			message += '<b>Parentezco:</b> Debe agregar un parentezco válido.<br>';
		}

		if(!v_trabajo){
			input_control('#trabajo', 'error');
			message += '<b>Trabajo:</b> Debe agregar un trabajo válido.<br>';
		}

		if(!v_direccion_trabajo){
			input_control('#direccion_trabajo', 'error');
			message += '<b>Dirección de Trabajo:</b> Debe agregar una dirección de trabajo válida.<br>';
		}

		if(!v_telefono_trabajo){
			input_control('#telefono_trabajo', 'error');
			message += '<b>Teléfono Trabajo:</b> Debe agregar un número de teléfono válido.<br>';
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
			button_control('#btn_agregar_contacto', 'desactivar', 'Agregando Contacto...');

			/**
			 * Recuperación de datos
			*/
            let nombre_completo   = jQuery('#nombre_completo').val();
            let direccion         = jQuery('#direccion').val();
			let telefono          = jQuery('#telefono').val();
			let parentezco        = jQuery('#parentezco').val();
			let trabajo           = jQuery('#trabajo').val();
			let direccion_trabajo = jQuery('#direccion_trabajo').val();
			let telefono_trabajo  = jQuery('#telefono_trabajo').val();
			let tipo_contacto     = jQuery('#tipo_contacto').val();
			let dui               = jQuery('#dui').val();

			/**
			 * Ajax
			*/
			jQuery.ajax({
				url: URLactual + '/system/ajax/contactos_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'insert',
					nombre_completo: nombre_completo,
                    direccion: direccion,
                    telefono: telefono,
                    parentezco: parentezco,
                    trabajo: trabajo,
                    direccion_trabajo: direccion_trabajo,
                    telefono_trabajo: telefono_trabajo,
                    tipo_contacto: tipo_contacto,
                    dui: dui
				},
				success: function(data){
					try{
						if(data['success']){
							// limpiar campos
                            jQuery('#nombre_completo').val('');
                            jQuery('#direccion').val('');
							jQuery('#telefono').val('');
							jQuery('#parentezco').val('');
							jQuery('#trabajo').val('');
							jQuery('#direccion_trabajo').val('');
							jQuery('#telefono_trabajo').val('');
							
							// Establecer borde por defecto
							input_control('#nombre_completo', 'empty');
							input_control('#direccion', 'empty');
							input_control('#telefono', 'empty');
							input_control('#parentezco', 'empty');
							input_control('#trabajo', 'empty');
							input_control('#direccion_trabajo', 'empty');
							input_control('#telefono_trabajo', 'empty');

							// resetear variables
                            v_nombre_completo = false;
                            v_direccion = false;
							v_telefono = false;

							Swal.fire({
								icon: 'success',
								title: 'Contacto Creado',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Crear Contacto',
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

					button_control('#btn_agregar_contacto', 'activar', 'Agregar Contacto');
				},
				error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});

					button_control('#btn_agregar_contacto', 'activar', 'Agregar Contacto');
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
	let vu_id_contacto = true;
	let vu_nombre_completo = true;
	let vu_direccion = true;
    let vu_telefono = true;
    let vu_parentezco = true;
    let vu_trabajo = true;
    let vu_direccion_trabajo = true;
    let vu_telefono_trabajo = true;
    let vu_tipo_contacto = true;
    let vu_dui = true;

    /**
     * id_contacto
    */
    jQuery('#id_contacto').keyup(function(){
        let info = comprobar_validaciones('#id_contacto');

        if(info == 'success'){
            vu_id_contacto = true;
        }else{
            vu_id_contacto = false;
        }

        input_control('#id_contacto', info);
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
	 * direccion
	*/
	jQuery('#direccion_u').keyup(function(){
		let info = comprobar_validaciones('#direccion_u', null, false, 8);

		if(info == 'success'){
			vu_direccion = true;
		}else{
			vu_direccion = false;
		}

		input_control('#direccion_u', info);
	});

	/**
	 * telefono
	*/
	jQuery('#telefono_u').keyup(function(){
		let info = comprobar_validaciones('#telefono_u', regexPhone);

		if(info == 'success'){
			vu_telefono = true;
		}else{
			vu_telefono = false;
		}

		input_control('#telefono_u', info);
	});

	/**
	 * parentezco
	*/
	jQuery('#parentezco_u').keyup(function(){
		let info = comprobar_validaciones('#parentezco_u');

		if(info == 'success'){
			vu_parentezco = true;
		}else if(info == 'empty'){
			vu_parentezco = true;
		}else{
			vu_parentezco = false;
		}

		input_control('#parentezco_u', info);
	});

	/**
	 * trabajo
	*/
	jQuery('#trabajo_u').keyup(function(){
		let info = comprobar_validaciones('#trabajo_u');

		if(info == 'success'){
			vu_trabajo = true;
		}else if(info == 'empty'){
			vu_trabajo = true;
		}else{
			vu_trabajo = false;
		}

		input_control('#trabajo_u', info);
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
	 * tipo_contacto
	*/
	jQuery('#tipo_contacto_u').change(function(){
		let info = comprobar_validaciones('#tipo_contacto_u');

		if(info == 'success'){
			vu_tipo_contacto = true;
		}else{
			vu_tipo_contacto = false;

			input_control('#tipo_contacto_u', info);
		}
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
	jQuery('#btn_actualizar_contacto').click(function(){
		/**
		 * comprobación de validaciones
		*/
		let message = '';

		if(!vu_id_contacto){
			input_control('#id_contacto_u', 'error');
			message += '<b>Id Contacto:</b> Debe agregar un Id de Contacto válido.<br>';
		}

		if(!vu_nombre_completo){
			input_control('#nombre_completo_u', 'error');
			message += '<b>Nombre Completo:</b> Debe agregar un nombre válido.<br>';
		}

		if(!vu_direccion){
			input_control('#direccion_u', 'error');
			message += '<b>Dirección:</b> Debe agregar una dirección válida.<br>';
		}

		if(!vu_telefono){
			input_control('#telefono_u', 'error');
			message += '<b>Teléfono:</b> Debe agregar un número de teléfono válido.<br>';
		}

		if(!vu_parentezco){
			input_control('#parentezco_u', 'error');
			message += '<b>Parentezco:</b> Debe agregar un parentezco válido.<br>';
		}

		if(!vu_trabajo){
			input_control('#trabajo_u', 'error');
			message += '<b>Trabajo:</b> Debe agregar un trabajo válido.<br>';
		}

		if(!vu_direccion_trabajo){
			input_control('#direccion_trabajo_u', 'error');
			message += '<b>Dirección de Trabajo:</b> Debe agregar una dirección de trabajo válida.<br>';
		}

		if(!vu_telefono_trabajo){
			input_control('#telefono_trabajo_u', 'error');
			message += '<b>Teléfono Trabajo:</b> Debe agregar un número de teléfono válido.<br>';
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
			button_control('#btn_actualizar_cliente', 'desactivar', 'Actualizando Cliente...');

			/**
			 * Recuperación de datos
			*/
			let id_contacto       = jQuery('#id_contacto_u').val();
            let nombre_completo   = jQuery('#nombre_completo_u').val();
            let direccion         = jQuery('#direccion_u').val();
			let telefono          = jQuery('#telefono_u').val();
			let parentezco        = jQuery('#parentezco_u').val();
			let trabajo           = jQuery('#trabajo_u').val();
			let direccion_trabajo = jQuery('#direccion_trabajo_u').val();
			let telefono_trabajo  = jQuery('#telefono_trabajo_u').val();
			let tipo_contacto     = jQuery('#tipo_contacto_u').val();
			let dui               = jQuery('#dui_u').val();

			/**
			 * Ajax
			*/
			jQuery.ajax({
				url: URLactual + '/system/ajax/contactos_ajax.php',
				type: 'POST',
				dataType: 'json',
				data: {
					action: 'update',
					id_contacto: id_contacto,
                    nombre_completo: nombre_completo,
                    direccion: direccion,
                    telefono: telefono,
                    parentezco: parentezco,
                    trabajo: trabajo,
                    direccion_trabajo: direccion_trabajo,
                    telefono_trabajo: telefono_trabajo,
                    tipo_contacto: tipo_contacto,
                    dui: dui
				},
				success: function(data){
					try{
						if(data['success']){
							// Establecer borde por defecto
							input_control('#nombre_completo_u', 'empty');
							input_control('#direccion_u', 'empty');
							input_control('#telefono_u', 'empty');
							input_control('#parentezco_u', 'empty');
							input_control('#trabajo_u', 'empty');
							input_control('#direccion_trabajo_u', 'empty');
							input_control('#telefono_trabajo_u', 'empty');
							input_control('#tipo_contacto_u', 'empty');
							input_control('#dui_u', 'empty');

							Swal.fire({
								icon: 'success',
								title: 'Contacto Actualizado',
								text: data['message'],
								confirmButtonText: 'Aceptar',
								confirmButtonColor: '#2BC521'
							});
						}else{
							Swal.fire({
								icon: 'error',
								title: 'Error Al Actualizar Contacto',
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

					button_control('#btn_actualizar_contacto', 'activar', 'Actualizar Contacto');
				},
				error: function(data){
					Swal.fire({
						icon: 'error',
						title: 'Error De Conexión',
						text: 'Revise su conexión a internet e inténtelo de nuevo.',
						confirmButtonText: 'Aceptar',
						confirmButtonColor: '#2BC521'
					});
					
					button_control('#btn_actualizar_contacto', 'activar', 'Actualizar Contacto');
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
	jQuery('.btn_eliminar_contacto').click(function(){
		Swal.fire({
			icon: 'warning',
			title: '¿Está seguro que quiere eliminar a éste contacto?',
			text: 'Si elimina éste contacto, también se eliminarán todos los datos relacionados a él.',
			showCancelButton: true,
			confirmButtonText: 'Eliminar',
			confirmButtonColor: '#cf433f',
			cancelButtonText: 'Cancelar',
			cancelButtonColor: '#ccc',
		}).then((result) => {
			if(result.isConfirmed){
				// Ajax Delete
				let id_contacto = jQuery(this).data('id');

				jQuery.ajax({
					url: URLactual + '/system/ajax/contactos_ajax.php',
					type: 'POST',
					dataType: 'json',
					data: {
						action: 'delete',
						id_contacto: id_contacto
					},
					success: function(data){
						try{
							if(data['success']){
								Swal.fire({
									icon: 'success',
									title: 'Contacto Eliminado',
									text: data['message'],
									confirmButtonText: 'Aceptar',
									confirmButtonColor: '#2BC521'
								});

								let id = '#id_contacto_' + id_contacto;
								let tabla_contactos = jQuery('#Tabla_Contactos').DataTable();
                                tabla_contactos.row(id).remove().draw();
							}else{
								Swal.fire({
									icon: 'error',
									title: 'Error Al Eliminar Contacto',
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