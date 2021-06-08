<?php
include_once "app/models/movimientos.php";
class EntradasController extends Controller
{
  private $entradas;

  public function __construct($param)
  {
    $this->entradas = new Movimientos();
    parent::__construct("entradas", $param, true);
  }

  public function getAllProductos()
  {
    $records = $this->entradas->getAllProductos();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function save()
  {
    $update = $this->entradas->updateProductoEntrada($_POST);
    $records = $this->entradas->saveEntrada($_POST, $_SESSION['id']);
    $info = array('success' => true, 'msg' => "Registro guardado con exito");
    echo json_encode($info);
  }
}
