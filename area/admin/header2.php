</head>
<body>
	<!-- nav -->
	<nav class="menu_principal">
		<!-- logo -->
		<div class="logo">
			<a href="<?php echo PATH; ?>">
                <img src="<?php echo PATH; ?>/assets/img/logo2.png" alt="Logo de la empresa">
            </a>
		</div>
		<!-- end logo -->

		<!-- menu -->
		<div class="menu">
			<div class="menu-menu-principal-container">
				<ul id="menu-menu-principal" class="menu_escritorio">
					<li id="menu-item-14" class="current-menu-item">
						<a href="<?php echo PATH; ?>/area/admin/" aria-current="page">Inicio</a>
					</li>

					<li class="menu-item-has-children">
						<a>Carteras</a>

						<ul class="sub-menu">
							<li>
								<a href="<?php echo PATH; ?>/area/admin/nueva_cartera"><i class="fa-regular fa-folder"></i> Agregar Cartera</a>
							</li>

							<li>
								<a href="<?php echo PATH; ?>/area/admin/lista_carteras"><i class="fa-regular fa-rectangle-list"></i> Lista de Carteras</a>
							</li>

							<li>
								<a href="<?php echo PATH; ?>/area/admin/reportes"><i class="fa-solid fa-chart-pie"></i> Reportes</a>
							</li>
						</ul>
					</li>
					
					<li class="menu-item-has-children">
						<a>Usuario</a>

						<ul class="sub-menu">
							<li>
								<a href="<?php echo PATH; ?>/area/admin/nuevo_usuario"><i class="fa-solid fa-user-plus"></i> Agregar Usuario</a>
							</li>

							<li>
								<a href="<?php echo PATH; ?>/area/admin/lista_usuarios"><i class="fa-solid fa-users"></i> Lista de Usuarios</a>
							</li>

							<li>
								<a href="<?php echo PATH; ?>/area/admin/progreso_empleados"><i class="fa-solid fa-chart-pie"></i> Progreso de Usuarios</a>
							</li>
						</ul>
					</li>

					<li class="menu-item-has-children">
						<a>Hola, <?php echo $CurrentUser->get_nombre_completo(); ?></a>

						<ul class="sub-menu">
							<li>
								<a href="<?php echo PATH; ?>/area/admin/logout"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		<!-- end menu -->

		<!-- Icons -->
		<div class="menu_icons">
			<!-- ICON -->
			<img class="menu_button" src="<?php echo PATH; ?>/assets/img/menu_white.svg" width="35px" height="35px">
		</div>
		<!-- End Icons -->
	</nav>
	<!-- end nav -->

	<!-- Menu Mobile -->
	<div class="nav_mobile">
		<div class="content_menu_mobile">
			<div class="logo_mobile">
				<a href="#">
					<h1>Rivas y Gonzales</h1>
				</a>
			</div>

			<div class="menu_mobile">
				<div class="menu-menu-principal-container">
					<ul id="menu-menu-principal-1" class="menu_movil">
						<li id="menu-item-14" class="current-menu-item">
							<a href="<?php echo PATH; ?>/area/admin/" aria-current="page">Inicio</a>
						</li>

						<li class="menu-item-has-children">
							<a>Carteras</a>

							<ul class="sub-menu">
								<li>
									<a href="<?php echo PATH; ?>/area/admin/nueva_cartera"><i class="fa-regular fa-folder"></i> Agregar Cartera</a>
								</li>

								<li>
									<a href="<?php echo PATH; ?>/area/admin/lista_carteras"><i class="fa-regular fa-rectangle-list"></i> Lista de Carteras</a>
								</li>

								<li>
									<a href="<?php echo PATH; ?>/area/admin/reportes"><i class="fa-solid fa-chart-pie"></i> Reportes</a>
								</li>
							</ul>
						</li>
						
						<li class="menu-item-has-children">
							<a href="#">Usuario</a>

							<ul class="sub-menu">
								<li>
									<a href="<?php echo PATH; ?>/area/admin/nuevo_usuario"><i class="fa-solid fa-user-plus"></i> Agregar Usuario</a>
								</li>

								<li>
									<a href="<?php echo PATH; ?>/area/admin/lista_usuarios"><i class="fa-solid fa-users"></i> Lista de Usuarios</a>
								</li>

								<li>
									<a href="<?php echo PATH; ?>/area/admin/progreso_empleados"><i class="fa-solid fa-chart-pie"></i> Progreso de Usuarios</a>
								</li>
							</ul>
						</li>

						<li class="menu-item-has-children">
							<a>Hola, <?php echo $CurrentUser->get_nombre_completo(); ?></a>

							<ul class="sub-menu">
								<li>
									<a href="<?php echo PATH; ?>/area/admin/logout"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- End Menu Mobile -->

	<!-- Content Web Site -->
	<div class="content_web_site">