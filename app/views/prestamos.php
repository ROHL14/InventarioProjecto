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
      <?php echo $_SESSION["nuser"]; ?>
    </div>
  </header>
  <?php include_once "app/views/secciones/sidenav.php" ?>
  <div class="container pt-2">
    <section id="centro">
      <div class="content-panel mt-4" id="panelDatos">

        <button class="btn btn-dark btn-md" id="btnAgregar">
          Prestar equipo
        </button>

        <div id="contentTable" class="pt-1">
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
                <th scope="col">Alumno</th>
                <th scope="col">Equipo</th>
                <th scope="col">Estado</th>
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
            <h4><i class="fa fa-user"></i>Prestamos
            </h4>
            <hr>
            <form class="form-horizontal" role="form" id="miform" enctype="multipart/form-data">
              <input type="hidden" id="id_prestamo" name="id_prestamo" value="0" class="campo">

              <div class="form-group row">
                <label for="id_alumno" class="col-sm-2 col-form-label">Alumno</label>
                <div class="col-sm-10">
                  <select class="form-control campo" id="id_alumno" name="id_alumno" required>

                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label for="id_equipo" class="col-sm-2 col-form-label">Equipo</label>
                <div class="col-sm-10">
                  <select class="form-control campo" id="id_equipo" name="id_equipo" required>

                  </select>
                </div>
              </div>
              <button type="button" class="btn btn-default" id="btnCancelar">Cancelar</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
          </div>
        </div>
      </div>
  </div>
  </div>
  </section>
  </div>
  <?php include "app/views/secciones/scripts.php" ?>
  <script type="text/javascript" src="<?php echo URL; ?>public_html/js/prestamos.js"></script>
</body>

</html>