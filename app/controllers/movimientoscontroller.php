<?php
include_once "app/models/movimientos.php";
class MovimientosController extends Controller
{
  private $movimientos;

  public function __construct($param)
  {
    $this->movimientos = new Movimientos();
    parent::__construct("movimientos", $param, true);
  }

  public function getAll()
  {
    $records = $this->movimientos->getAll();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function getAllEntradas()
  {
    $records = $this->movimientos->getAllEntradas();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function getAllSalidas()
  {
    $records = $this->salidas->getAllSalidas();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }
}
