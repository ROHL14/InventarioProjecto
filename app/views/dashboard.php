<!DOCTYPE html>
<html>

<head>
	<?php include_once "app/views/secciones/css.php" ?>
</head>

<body id="body-pd">
	<header class="header" id="header">
		<div class="header_toggle">
			<i class="fas fa-bars" id="header-toggle"></i>
		</div>
		<div>
			<?php echo $_SESSION["nombre"]; ?>
		</div>
	</header>
	<?php include_once "app/views/secciones/sidenav.php" ?>
	<div class="container">
		<section id="contenido">

			<div class="cards-list">

				<div class="card-content">
					<div class="card card-1">
						<div class="card_title">
							<p>Productos Totales</p>
						</div>
						<div class="card_information" id="productosTotales">

						</div>

					</div>
				</div>

				<div class="card-content">
					<div class="card card-2">
						<div class="card_title">
							<p>Productos distintos</p>
						</div>
						<div class="card_information" id="productosDistintos">

						</div>

					</div>
				</div>

				<div class="card-content">
					<div class="card card-3">
						<div class="card_title">
							<p>Valor del Inventario</p>
						</div>
						<div class="card_information" id="valorInventario">

						</div>

					</div>
				</div>

				<div class="card-content">
					<div class="card card-3">
						<div class="card_title">
							<p>Usuarios Registrados</p>
						</div>
						<div class="card_information" id="usuariosRegistrados">

						</div>

					</div>
				</div>

			</div>
		</section>
	</div>
	<?php include_once "app/views/secciones/scripts.php" ?>
	<script type="text/javascript" src="<?php echo URL; ?>public_html/js/dashboard.js"></script>
</body>

</html>