<!DOCTYPE html>
<html>

<head>
  <?php include "app/views/secciones/css.php" ?>
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
  <div class="container pt-2">
    <section id="centro">
      <div class="content-panel mt-4" id="panelDatos">
        <h4>
          <i class="fas fa-dolly-flatbed"></i>
          <span> Equipo </span>
          <button class="btn btn-dark btn-md ml-4" id="btnAgregar">
            <i class="fa fa-plus"></i>
            Agregar Equipo
          </button>
        </h4>
        <hr>
        <div id="contentTable">
          <div class="row mb-1">
            <div class="input-group col-md-4">
              <input class="form-control py-2" type="search" placeholder="Buscar" id="txtSearch">
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
                <th scope="col">Nombre</th>
                <th scope="col">Cantidad en stock</th>
                <th scope="col">Categoria</th>
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
      <div class="content-panel m-4 d-none" id="panelFormulario">
        <div class="row">
          <div class="col-md-10 mx-auto">
            <h4>
              <i class="fas fa-dolly-flatbed"></i>
              <span> Equipo </span>
            </h4>
            <hr>
            <form class="form-horizontal" role="form" id="miform" enctype="multipart/form-data">
              <input type="hidden" id="id_equipo" name="id_equipo" value="0" class="campo">
              <div class="form-group row">
                <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control campo" id="nombre" name="nombre" placeholder="Nombre del equipo" required autofocus>
                </div>
              </div>

              <div class="form-group row">
                <label for="stock" class="col-sm-2 col-form-label">Cantidad en Stock</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control campo" rows="3" id="stock" name="stock" />
                </div>
              </div>

              <div class="form-group row">
                <label for="id_categoria" class="col-sm-2 col-form-label">Categoria</label>
                <div class="col-sm-10">
                  <select class="form-control campo" id="id_categoria" name="id_categoria" required>

                  </select>
                </div>
              </div>
              <button type="button" class="btn btn-default" id="btnCancelar">Cancelar</button>
              <button type="submit" class="btn btn-success">Guardar</button>
            </form>
          </div>
        </div>
      </div>
    </section>

  </div>
  <?php include "app/views/secciones/scripts.php" ?>
  <script type="text/javascript" src="<?php echo URL; ?>public_html/js/equipo.js"></script>
</body>

</html>