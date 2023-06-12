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
						<a href="<?php echo PATH; ?>/area/empleado/" aria-current="page">Inicio</a>
					</li>

					<li class="menu-item-has-children">
						<a>Hola, <?php echo $CurrentUser->get_nombre_completo(); ?></a>

						<ul class="sub-menu">
							<li>
								<a href="<?php echo PATH; ?>/area/empleado/logout"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a>
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
							<a href="<?php echo PATH; ?>/area/empleado/" aria-current="page">Inicio</a>
						</li>

						<li class="menu-item-has-children">
							<a>Hola, <?php echo $CurrentUser->get_nombre_completo(); ?></a>

							<ul class="sub-menu">
								<li>
									<a href="<?php echo PATH; ?>/area/empleado/logout"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a>
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