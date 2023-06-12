<?php
	/**
	 * Modelos y Controles Acá
	 * Usuarios_Model y Usuarios_Controller ya estan cargados por defecto.
	*/
	require_once('../../system/controllers/usuario_cartera_controller.php');

	require_once('../../system/models/usuario_cartera_model.php');

	/**
	 * header
	*/
	require_once('header1.php');
?>

	<title>Panel Principal</title>
	<!-- validaciones -->
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/validaciones/carteras.js"></script>
	<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="<?php echo PATH; ?>/assets/css/datatables.min.css">
	<script type="text/javascript" src="<?php echo PATH; ?>/assets/js/datatables.min.js"></script>

<?php
	require_once('header2.php');
?>

	<section id="Title_Page">
		<h1>Lista de Carteras</h1>
	</section>
	
	<section id="Breadcrumbs">
		<div class="breadcrumbs_contet">
			<a class="active">Lista de Carteras</a>
		</div>
	</section>

	<section class="Content_Table">
		<!-- Table -->
		<div class="ct_table">
			<div class="ct_header">
				<div>
					<h3>Lista de Carteras</h3>
				</div>

				<div></div>
			</div>

			<table id="Tabla_Carteras" data-page-length='25'>
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre Cartera</th>
						<th>Descripción</th>
						<th>Correo Contacto</th>
						<th><i class="fa-solid fa-gear"></i></th>
					</tr>
				</thead>

				<tbody>
					<?php
						$Usuario_Cartera_Controller = new Usuario_Cartera_Controller();
						$arrayCarteras = $Usuario_Cartera_Controller->select_all_by_id_usuario_join_carteras($CurrentUser->get_id_usuario());

						if(is_array($arrayCarteras) && $arrayCarteras != null){
							for($i = 0; $i < sizeof($arrayCarteras); $i++){
								echo '<tr id="id_cartera_' . $arrayCarteras[$i]['id_cartera'] . '">';
								echo '<td>' . $arrayCarteras[$i]['id_cartera'] . '</td>';
								echo '<td>' . $arrayCarteras[$i]['nombre_cartera'] . '</td>';
								echo '<td>' . $arrayCarteras[$i]['descripcion'] . '</td>';
								echo '<td><a href="mailto:' . $arrayCarteras[$i]['correo_contacto'] . '">' . $arrayCarteras[$i]['correo_contacto'] . '</a></td>';
								echo '<td class="content_opt">';
								echo '<a href="' . PATH . '/area/empleado/cartera/' . $arrayCarteras[$i]['id_cartera'] . '" class="to_btn to_btn_see to_btn_r" title="Ver"><i class="fa-solid fa-circle-info"></i></a>';
								echo '</td>';
								echo '</tr>';
							}
						}
					?>
				</tbody>
			</table>
		</div>
	</section>

	<script type="text/javascript">
		jQuery(document).ready(function(){
			/**
			 * DataTables
			*/
			jQuery('#Tabla_Carteras').DataTable({
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
		});
	</script>


<?php
	/**
	 * footer
	*/
	require_once('footer.php');
?>