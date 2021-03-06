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
                <th scope="col">Producto</th>
                <th scope="col">Categoria</th>
                <th scope="col">Precio</th>
                <th scope="col">Stock</th>
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

            <form class="form-horizontal" role="form" id="miform" enctype="multipart/form-data">
              <input type="hidden" id="id_producto" name="id_producto" value="0" class="campo">

              <input type="hidden" id="tipo_movimiento" name="tipo_movimiento" value="0" class="campo">
              <input type="hidden" id="cantidad_inicial" name="cantidad_inicial" value="0" class="campo">
              <input type="hidden" id="precio_inicial" name="precio_inicial" value="0" class="campo">
              <input type="hidden" id="precio" name="precio" value="0" class="campo">
              <input type="hidden" id="fecha_movimiento" name="fecha_movimiento" value="0" class="campo">

              <div class="form-group row">
                <label for="cantidad" class="col-sm-2 col-form-label">Aumentar cantidad en Stock</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control campo" id="cantidad" name="cantidad" min="1" step="1" required />
                </div>
              </div>

              <button type="submit" class="btn btn-success">Guardar</button>
              <button type="button" class="btn btn-default" id="btnCancelar">Cancelar</button>
            </form>
          </div>
        </div>
      </div>

    </section>

  </div>
  <?php include "app/views/secciones/scripts.php" ?>
  <script type="text/javascript" src="<?php echo URL; ?>public_html/js/entradas.js"></script>
</body>

</html>