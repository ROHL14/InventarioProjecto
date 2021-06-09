<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inventario Donde Fer</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public_html/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

	<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public_html/css/login.css">
</head>

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
				<div class="alert alert-danger d-none mb-4" role="alert" id="mensaje">
				</div>
				<button type="submit" class="form-button button-l margin-b">Login</button>
			</form>

		</div>
	</div>
</body>

<script type="text/javascript" src="<?php echo URL; ?>public_html/js/api.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>public_html/js/login.js"></script>

</html>