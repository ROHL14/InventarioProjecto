<!DOCTYPE html>
<html>

<head>
	<?php include "app/views/secciones/css.php" ?>
	<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public_html/css/login.css">
</head>

<!--<body>
	<div class="container">
		<section id="encabezado">
			<?php include "app/views/secciones/encabezado_user.php" ?>
		</section>
		<section id="menu">
			<?php include "app/views/secciones/menu_user.php" ?>
		</section>
		<section id="centro">
			<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
				</ol>
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img class="d-block w-100" src="<?php echo URL ?>public_html/images/slider_pic1.jpg" alt="First slide">
					</div>
					<div class="carousel-item">
						<img class="d-block w-100" src="<?php echo URL ?>public_html/images/slider_pic2.jpg" alt="Second slide">
					</div>
					<div class="carousel-item">
						<img class="d-block w-100" src="<?php echo URL ?>public_html/images/slider_pic3.jpg" alt="Third slide">
					</div>
					<div class="carousel-item">
						<img class="d-block w-100" src="<?php echo URL ?>public_html/images/slider_pic3.jpg" alt="Four slide">
					</div>
				</div>
				<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Anterior</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Siguiente</span>
				</a>
			</div>
		</section>
		<section id="pie">
			<?php include "app/views/secciones/pie_user.php" ?>
		</section>
	</div>
	<?php include "app/views/secciones/script_user.php" ?>
</body>-->

<body class="main-bg">
	<div class="login-container text-c">
		<div>
			<h1 class="logo-badge text-whitesmoke"><span class="fa fa-user-circle"></span></h1>
		</div>
		<h3 class="text-whitesmoke">Login</h3>
		<p class="text-whitesmoke"></p>
		<div class="container-content">
			<form class="margin-t" id="loginform" action="guardar.php">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Usuario" name="user" id="user" required>
				</div>
				<div class="form-group">
					<input type="password" class="form-control" placeholder="*****" name="pass" id="pass" required>
				</div>
				<button type="submit" class="form-button button-l margin-b">Login</button>
			</form>

		</div>
	</div>
</body>
<script type="text/javascript" src="<?php echo URL; ?>public_html/js/api.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>public_html/js/login.js"></script>

</html>