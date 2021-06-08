<?php
include_once "app/models/movimientos.php";
class SalidasController extends Controller
{
  private $salidas;

  public function __construct($param)
  {
    $this->salidas = new Movimientos();
    parent::__construct("salidas", $param, true);
  }

  public function getAllProductos()
  {
    $records = $this->salidas->getAllProductos();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function save()
  {
    $update = $this->salidas->updateProductoSalida($_POST);
    $records = $this->salidas->saveSalida($_POST, $_SESSION['id']);
    $info = array('success' => true, 'msg' => "Registro guardado con exito");
    echo json_encode($info);
  }
}
