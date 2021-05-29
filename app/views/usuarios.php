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
			<?php echo $_SESSION["nuser"]; ?>
		</div>
	</header>
	<?php include_once "app/views/secciones/sidenav.php" ?>
	<div class="container pt-2">
		<div class="content-panel mt-4" id="panelDatos">
			<h4>
				<i class="fas fa-user"></i>
				<span>Usuarios</span>
				<button class="btn btn-dark btn-md ml-4" id="btnAgregar">
					<i class="fa fa-plus"></i>
					Agregar Usuario
				</button>
			</h4>
			<hr>
			<div id="contentTable">
				<div class="row mb-1">
					<div class="input-group col-md-4">
						<input type="search" class="form-control py-2" placeholder="Buscar" id="txtSearch">
						<span class="input-group-append">
							<button class="btn btn-outline-secondary" type="button">
								<i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</div>
				<table class="table table-striped">
					<thead class="thead-dark">
						<tr>
							<th scope="col">Corr</th>
							<th scope="col">Nombres</th>
							<th scope="col">Apellidos</th>
							<th scope="col">Usuario</th>
							<th scope="col">Tipo</th>
							<th scope="col">&nbsp;</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
				<div class="row">
					<div class="col-md-12">
						<nav aria-label="Page navigation example" class="float-right">
							<ul class="pagination">

							</ul>
						</nav>
					</div>
				</div>
			</div>
		</div>
		<div class="content-panel mt-4 d-none" id="panelFormulario">
			<div class="row">
				<div class="col-md-10 mx-auto ">
					<h4>
						<i class="fas fa-user"></i>
						<span>Usuarios</span>
					</h4>
					<hr>
					<form class="form-horizontal" role="form" id="miform" enctype="multipart/form-data">
						<input type="hidden" name="id_usuario" id="id_usuario" value="0">
						<div class="form-group row">
							<label for="usuario" class="col-sm-2 col-form-label">Usuario:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="usuario" name="usuario" required autofocus>
							</div>
						</div>
						<div class="form-group row">
							<label for="password" class="col-sm-2 col-form-label">Password:</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" id="password" name="password" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="nombres" class="col-sm-2 col-form-label">Nombres:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="nombres" name="nombres" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="apellidos" class="col-sm-2 col-form-label">Apellidos:</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="apellidos" name="apellidos" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="tipo" class="col-sm-2 col-form-label">Tipo de usuario:</label>
							<div class="col-sm-10">
								<select class="form-control" id="tipo" name="tipo" required>
									<option value="1" selected>Administrador</option>
									<option value="2">Usuario</option>
								</select>
							</div>
						</div>
						<div class="alert alert-danger d-none" id="mensaje"></div>
						<button type="button" class="btn btn-default" id="btnCancelar">Cancelar</button>
						<button type="submit" class="btn btn-success">Guardar</button>
					</form>
				</div>
			</div>
		</div>
		</section>

	</div>
	<?php include_once "app/views/secciones/scripts.php" ?>
	<script type="text/javascript" src="<?php echo URL; ?>public_html/js/usuarios.js"></script>
</body>

</html>