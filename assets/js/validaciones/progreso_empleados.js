jQuery(document).ready(function(){
	jQuery('#fecha_inicio').change(function(){
		jQuery('#fecha_final').attr('min', jQuery(this).val());
	});

	jQuery('#fecha_final').change(function(){
		jQuery('#fecha_inicio').attr('max', jQuery(this).val());
	});

	jQuery('#id_cartera').change(function(){
		let id_cartera = jQuery(this).val();

		jQuery.ajax({
			url: URLactual + '/system/ajax/progreso_empleados_ajax.php',
			type: 'POST',
			dataType: 'html',
			data: {
				action: 'select',
				id_cartera: id_cartera
			},
			success: function(data){
				jQuery('#id_usuario').html(data);
			},
			error: function(data){
				
			}
		});
	});
});