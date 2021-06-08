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
      <?php echo $_SESSION["id"]; ?>
    </div>
  </header>
  <?php include_once "app/views/secciones/sidenav.php" ?>
  <div class="container pt-2">
    <section id="centro">
      <?php if ($_SESSION["rol"] == 'administrador') { ?>
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
                  <th scope="col">Precio</th>
                  <th scope="col">Categoria</th>
                  <th scope="col">Stock Inicial</th>
                  <th scope="col">Stock Final</th>
                  <th scope="col">Precio Total Inicial</th>
                  <th scope="col">Precio Total Final</th>
                  <th scope="col">Movimiento</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Usuario</th>
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
      <?php } ?>
    </section>

  </div>
  <?php include "app/views/secciones/scripts.php" ?>
  <script type="text/javascript" src="<?php echo URL; ?>public_html/js/movimientos.js"></script>
</body>

</html>