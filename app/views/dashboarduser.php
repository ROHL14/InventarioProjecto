<!DOCTYPE html>
<html>

<head>
  <?php include_once "app/views/secciones/css.php" ?>
</head>

<body>
  <div class="container">
    <section id="encabezado">
      <?php include_once "app/views/secciones/encabezado_user.php" ?>
    </section>
    <section id="menu">
      <?php include_once "app/views/secciones/menu_user.php" ?>
    </section>
    <section id="contenido">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="<?php echo URL ?>public_html/images/slider_pic1.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="<?php echo URL ?>public_html/images/slider_pic2.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="<?php echo URL ?>public_html/images/slider_pic3.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="<?php echo URL ?>public_html/images/slider_pic3.jpg" class="d-block w-100" alt="...">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Siguiente</span>
        </a>
      </div>
    </section>
    <section id="pie">
      <?php include_once "app/views/secciones/pie_user.php" ?>
    </section>
  </div>
  <?php include_once "app/views/secciones/scripts_user.php" ?>
</body>

</html>