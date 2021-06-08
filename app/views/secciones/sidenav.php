<div class="l-navbar" id="nav-bar">
  <nav class="nav">
    <div>
      <a href="<?php echo URL ?>dashboard" class="nav_logo">
        <i class="fas fa-store nav_logo-icon"></i>
        <span class="nav_logo-name">
          Donde
          <br />
          Fer
        </span>
      </a>
      <div class="nav_list">
        <?php if ($_SESSION["rol"] == 'administrador') { ?>
          <a href="<?php echo URL ?>usuarios" class="nav_link">
            <i class="fas fa-user"></i>
            <span class="nav_name">Usuarios</span>
          </a>
          <a href="<?php echo URL ?>productos" class="nav_link">
            <i class="fas fa-dolly-flatbed"></i>
            <span class="nav_name">Productos</span>
          </a>
          <a href="<?php echo URL ?>categorias" class="nav_link">
            <i class="fas fa-inbox"></i>
            <span class="nav_name">Categorias</span>
          </a>
        <?php } ?>
        <a href="<?php echo URL ?>entradas" class="nav_link">
          <i class="far fa-arrow-alt-circle-up"></i>
          <span class="nav_name">Entradas</span>
        </a>
        <a href="<?php echo URL ?>salidas" class="nav_link">
          <i class="far fa-arrow-alt-circle-down"></i>
          <span class="nav_name">Salidas</span>
        </a>
        <?php if ($_SESSION["rol"] == 'administrador') { ?>
          <a href="<?php echo URL ?>movimientos" class="nav_link">
            <i class="far fa-save"></i>
            <span class="nav_name">Movimientos</span>
          </a>
        <?php } ?>
      </div>
    </div>
    <a href="<?php echo URL ?>login/cerrar" class="nav_link">
      <i class="fas fa-sign-out-alt"></i>
      <span class="nav_name">SignOut</span> </a>
  </nav>
</div>