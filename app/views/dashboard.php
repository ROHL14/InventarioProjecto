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

				<a href="<?php echo URL ?>asistencia" class="card-link">
					<div class="card card-1">
						<div class="card_image">
							<img src="<?php echo URL ?>public_html/images/calendario.png" alt="">
						</div>
						<div class="card_title">
							<p>Asistencia</p>
						</div>
					</div>
				</a>

				<a href="<?php echo URL ?>prestamos" class="card-link">
					<div class="card card-2">
						<div class="card_image">
							<img src="<?php echo URL ?>public_html/images/apreton-de-manos.png" alt="">
						</div>
						<div class="card_title">
							<p>Prestamos</p>
						</div>
					</div>
				</a>

				<a href="<?php echo URL ?>participantes" class="card-link">
					<div class="card card-3">
						<div class="card_image">
							<img src="<?php echo URL ?>public_html/images/torneo.png" alt="">
						</div>
						<div class="card_title">
							<p>Inscribir a Torneo</p>
						</div>
					</div>
				</a>

				<a href="<?php echo URL ?>informes" class="card-link">
					<div class="card card-3">
						<div class="card_image">
							<img src="<?php echo URL ?>public_html/images/reporte.png" alt="">
						</div>
						<div class="card_title">
							<p>Informes</p>
						</div>
					</div>
				</a>

			</div>
		</section>
	</div>
	<?php include_once "app/views/secciones/scripts.php" ?>
</body>

</html>