jQuery(document).ready(function(){
	jQuery('#fecha_inicio').change(function(){
		jQuery('#fecha_final').attr('min', jQuery(this).val());
	});

	jQuery('#fecha_final').change(function(){
		jQuery('#fecha_inicio').attr('max', jQuery(this).val());
	});
});