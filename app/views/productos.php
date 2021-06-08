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
      <?php if ($_SESSION["rol"] == 'administrador') { ?>
        <div class="content-panel mt-4" id="panelDatos">
          <h4>
            <i class="fas fa-dolly-flatbed"></i>
            <span> Productos </span>
            <button class="btn btn-dark btn-md ml-4" id="btnAgregar">
              <i class="fa fa-plus"></i>
              Agregar Producto
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
                  <th scope="col">Descripcion</th>
                  <th scope="col">Precio</th>
                  <th scope="col">Cantidad en stock</th>
                  <th scope="col">Fecha Agregado</th>
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
                <span> Productos </span>
              </h4>
              <hr>
              <form class="form-horizontal" role="form" id="miform" enctype="multipart/form-data">
                <input type="hidden" id="id_producto" name="id_producto" value="0" class="campo">
                <div class="form-group row">
                  <label for="nombre_producto" class="col-sm-2 col-form-label">Nombre del Producto</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control campo" id="nombre_producto" name="nombre_producto" placeholder="Nombre del Producto" required autofocus>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="descripcion" class="col-sm-2 col-form-label">Descripcion</label>
                  <div class="col-sm-10">
                    <textarea class="form-control campo" id="descripcion" name="descripcion" required></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="cantidad" class="col-sm-2 col-form-label" id="cantidadlabel">Cantidad en Stock</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control campo" id="cantidad" name="cantidad" required min="1" step="1" />
                  </div>
                </div>

                <div class="form-group row">
                  <label for="precio" class="col-sm-2 col-form-label">Precio</label>
                  <div class="col-sm-10">
                    <input type="decimal" class="form-control campo" id="precio" name="precio" required min="0.1" />
                  </div>
                </div>

                <div class="form-group row">
                  <label for="fecha_agregado" class="col-sm-2 col-form-label" id="fechalabel">Fecha</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control campo" id="fecha_agregado" name="fecha_agregado" required />
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
      <?php } ?>
    </section>

  </div>
  <?php include "app/views/secciones/scripts.php" ?>
  <script type="text/javascript" src="<?php echo URL; ?>public_html/js/productos.js"></script>
</body>

</html>