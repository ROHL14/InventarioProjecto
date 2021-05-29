<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Mantenimiento
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo URL ?>usuarios">Usuarios</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?php echo URL ?>categorias">Categorias</a>
          <a class="dropdown-item" href="<?php echo URL ?>paises">Paises</a>
          <a class="dropdown-item" href="<?php echo URL ?>cintas">Cintas</a>
          <a class="dropdown-item" href="<?php echo URL ?>horarios">Horarios</a>
          <a class="dropdown-item" href="<?php echo URL ?>encargados">Encargados</a>
          <a class="dropdown-item" href="<?php echo URL ?>torneos">Torneos</a>
          <a class="dropdown-item" href="<?php echo URL ?>equipo">Equipo</a>
          <a class="dropdown-item" href="<?php echo URL ?>alumnos">Alumnos</a>
          <a class="dropdown-item" href="<?php echo URL ?>autores">Autores</a>
          <a class="dropdown-item" href="<?php echo URL ?>libros">Libros</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Informes
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo URL ?>reportelibros">Libros</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?php echo URL ?>reporteusuarios">Usuarios</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo URL ?>login/cerrar">Cerrar sesion</a>
      </li>
    </ul>
    <img src="<?php echo URL ?>public_html/images/avatar.jpg" class="img-rounded" style="width:40px;">
    <span><?php echo $_SESSION["nuser"]; ?></span>
  </div>
</nav>