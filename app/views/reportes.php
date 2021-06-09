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
      <div class="content-panel mt-4">
        <h4>
          <span> Reporte de Usuarios </span>
        </h4>
        <div class="row mb-3 p3 m1">
          <div class="col-md-12">
            <div class="form-inline">
              <label for="rol">Rol del usuario:</label>
              <select class="form-control ml-2" id="rol" name="rol" required>
                <option value="0" selected>Todos</option>
                <option value="administrador">Administrador</option>
                <option value="empleado">Empleado</option>
              </select>

              <button class="btn btn-primary ml-2" id="btnViewReportUser"><i class="fas fa-print"></i> Ver Reporte</button>
            </div>
          </div>
        </div>
        <iframe src="" width="100%" height="400" style="border:1px solid black;" id="framereporteUser"></iframe>
      </div>
    </section>

  </div>

  <div class="container pt-2">
    <section id="centro">
      <div class="content-panel mt-4">
        <h4>
          <span> Reporte de Productos </span>
        </h4>
        <div class="row mb-3 p3 m1">
          <div class="col-md-12">
            <div class="form-inline">
              <label for="id_categoria">Categoria:</label>
              <select class="form-control ml-2" id="id_categoria" name="id_categoria" required>

              </select>

              <button class="btn btn-primary ml-2" id="btnViewReportProduct"><i class="fas fa-print"></i> Ver Reporte</button>
            </div>
          </div>
        </div>
        <iframe src="" width="100%" height="400" style="border:1px solid black;" id="framereporteProduct"></iframe>
      </div>
    </section>

  </div>

  <div class="container pt-2">
    <section id="centro">
      <div class="content-panel mt-4">
        <h4>
          <span> Reporte de Movimientos </span>
        </h4>
        <div class="row mb-3 p3 m1">
          <div class="col-md-12">
            <div class="form-inline">
              <label for="tipo_mov">Tipo de movimiento:</label>
              <select class="form-control ml-2" id="tipo_mov" name="tipo_mov" required>
                <option value="0" selected>Todos</option>
                <option value="entrada">Entrada</option>
                <option value="salida">Salida</option>
              </select>

              <label for="id" class="ml-4">Usuario:</label>
              <select class="form-control ml-2" id="id" name="id" required>

              </select>

              <label for="username" class="ml-4">Producto:</label>
              <select class="form-control ml-2" id="id_producto" name="id_producto" required>

              </select>

              <button class="btn btn-primary ml-2" id="btnViewReportMov"><i class="fas fa-print"></i> Ver Reporte</button>
            </div>
          </div>
        </div>
        <iframe src="" width="100%" height="400" style="border:1px solid black;" id="framereporteMov"></iframe>
      </div>
    </section>

  </div>
  <?php include "app/views/secciones/scripts.php" ?>
  <script type="text/javascript" src="<?php echo URL; ?>public_html/js/reportes.js"></script>
</body>

</html>