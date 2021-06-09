<?php
include_once "app/models/reportes.php";
include_once "vendor/autoload.php";
class ReportesController extends Controller
{
  private $reporte;
  public function __construct($param)
  {
    $this->reporte = new Reportes;
    parent::__construct("reportes", $param, true);
  }

  public function getReporteUsuarios()
  {
    $resultado = $this->reporte->getReporteUsuarios($_GET);

    $htmlheader = "<h1>Donde Fer</h1>";
    $htmlheader .= "<h3>Listado de usuarios</h3>";
    $html = "<table width='100%' border='none'><thead><tr>";
    $html .= "<th>Corr</th>";
    $html .= "<th>Username</th>";
    $html .= "<th>Nombre</th>";
    $html .= "<th>Email</th>";
    $html .= "<th>Rol</th>";
    $html .= "</tr></thead><tbody>";
    foreach ($resultado as $key => $value) {
      $html .= "<tr>";
      $html .= "<td style='text-align: center;'>" . ($key + 1) . "</td>";
      $html .= "<td style='text-align: center;'>{$value['username']}</td>";
      $html .= "<td style='text-align: center;'>{$value['nombre']}</td>";
      $html .= "<td style='text-align: center;'>{$value['email']}</td>";
      $html .= "<td style='text-align: center;'>{$value['rol']}</td>";
      $html .= "</tr>";
    }
    $html .= "</tbody></table>";
    $mpdfConfig = array(
      'mode' => 'utf-8',
      'format' => 'Letter',
      'default_font_size' => 0,
      'default_font' => '',
      'margin_left' => 10,
      'margin_right' => 10,
      'margin_header' => 10,
      'margin_footer' => 20,
      'margin_top' => 40,
      'orientation' => 'P'
    );
    $mpdf = new \Mpdf\Mpdf($mpdfConfig);
    $mpdf->SetHTMLHeader($htmlheader);
    $mpdf->WriteHTML($html);
    $mpdf->Output();
  }

  public function getReporteProductos()
  {
    $resultado = $this->reporte->getReporteProductos($_GET);

    $htmlheader = "<h1>Donde Fer</h1>";
    $htmlheader .= "<h3>Listado de productos</h3>";
    $html = "<table width='100%' border='none'><thead><tr>";
    $html .= "<th>Corr</th>";
    $html .= "<th>Producto</th>";
    $html .= "<th>Descripcion</th>";
    $html .= "<th>Precio</th>";
    $html .= "<th>Cantidad</th>";
    $html .= "<th>Categoria</th>";
    $html .= "</tr></thead><tbody>";
    foreach ($resultado as $key => $value) {
      $html .= "<tr>";
      $html .= "<td style='text-align: center;'>" . ($key + 1) . "</td>";
      $html .= "<td style='text-align: center;'>{$value['nombre_producto']}</td>";
      $html .= "<td style='text-align: center;'>{$value['descripcion']}</td>";
      $html .= "<td style='text-align: center;'>{$value['precio']}</td>";
      $html .= "<td style='text-align: center;'>{$value['cantidad']}</td>";
      $html .= "<td style='text-align: center;'>{$value['categoria']}</td>";
      $html .= "</tr>";
    }
    $html .= "</tbody></table>";
    $mpdfConfig = array(
      'mode' => 'utf-8',
      'format' => 'Letter',
      'default_font_size' => 0,
      'default_font' => '',
      'margin_left' => 10,
      'margin_right' => 10,
      'margin_header' => 10,
      'margin_footer' => 20,
      'margin_top' => 40,
      'orientation' => 'P'
    );
    $mpdf = new \Mpdf\Mpdf($mpdfConfig);
    $mpdf->SetHTMLHeader($htmlheader);
    $mpdf->WriteHTML($html);
    $mpdf->Output();
  }

  public function getReporteMovimientos()
  {
    $resultado = $this->reporte->getReporteMovimientos($_GET);

    $htmlheader = "<h1>Donde Fer</h1>";
    $htmlheader .= "<h3>Listado de Movimientos</h3>";
    $html = "<table width='100%' border='none'><thead><tr>";
    $html .= "<th>Corr</th>";
    $html .= "<th>Producto</th>";
    $html .= "<th>Precio Unitario</th>";
    $html .= "<th>Categoria</th>";
    $html .= "<th>Stock Inicial</th>";
    $html .= "<th>Stock Final</th>";
    $html .= "<th>Precio Total Inicial</th>";
    $html .= "<th>Precio Total Final</th>";
    $html .= "<th>Movimiento</th>";
    $html .= "<th>Fecha</th>";
    $html .= "<th>Usuario</th>";
    $html .= "</tr></thead><tbody>";
    foreach ($resultado as $key => $value) {
      $html .= "<tr>";
      $html .= "<td style='text-align: center;'>" . ($key + 1) . "</td>";
      $html .= "<td style='text-align: center;'>{$value['nombre_producto']}</td>";
      $html .= "<td style='text-align: center;'>{$value['precio']}</td>";
      $html .= "<td style='text-align: center;'>{$value['categoria']}</td>";
      $html .= "<td style='text-align: center;'>{$value['cantidad_inicial']}</td>";
      $html .= "<td style='text-align: center;'>{$value['cantidad_final']}</td>";
      $html .= "<td style='text-align: center;'>{$value['precio_inicial']}</td>";
      $html .= "<td style='text-align: center;'>{$value['precio_final']}</td>";
      $html .= "<td style='text-align: center;'>{$value['tipo_mov']}</td>";
      $html .= "<td style='text-align: center;'>{$value['fecha_movimiento']}</td>";
      $html .= "<td style='text-align: center;'>{$value['username']}</td>";
      $html .= "</tr>";
    }
    $html .= "</tbody></table>";
    $mpdfConfig = array(
      'mode' => 'utf-8',
      'format' => 'Letter',
      'default_font_size' => 0,
      'default_font' => '',
      'margin_left' => 10,
      'margin_right' => 10,
      'margin_header' => 10,
      'margin_footer' => 20,
      'margin_top' => 40,
      'orientation' => 'P'
    );
    $mpdf = new \Mpdf\Mpdf($mpdfConfig);
    $mpdf->SetHTMLHeader($htmlheader);
    $mpdf->WriteHTML($html);
    $mpdf->Output();
  }
}
