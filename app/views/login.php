<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Taekwondo Koryo</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public_html/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />

	<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public_html/css/login.css">
</head>

<!--<body class="bg-dark">
	<div class="container py-5">
		<div class="row">
			<div class="col-md-6 mx-auto">
				<div class="card">
					<div class="card-header">
						<h2 class="text-center">Login</h2>
					</div>
					<div class="card-body">
						<form id="loginform" action="guardar.php">
							<div class="form-label-group mb-4">
								<input type="text" name="user" id="user" class="form-control" placeholder="Usuario">
							</div>
							<div class="form-label-group mb-4">
								<input type="password" name="pass" id="pass" class="form-control" placeholder="Password">
							</div>
							<div class="alert alert-danger d-none mb-4" role="alert" id="mensaje">
							</div>
							<button class="btn btn-success btn-block mb-4" type="submit">Login</button>
							<p class="text-muted text-center">
								UNICAES&copy; 2020
							</p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
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