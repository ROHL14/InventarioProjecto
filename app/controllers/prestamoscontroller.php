<?php
include_once "app/models/prestamos.php";
class PrestamosController extends Controller
{
  private $prestamos;

  public function __construct($param)
  {
    $this->prestamos = new Prestamos();
    parent::__construct("prestamos", $param, true);
  }

  public function getAll()
  {
    $records = $this->prestamos->getAll();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function getAllEquipo()
  {
    $records = $this->prestamos->getAllEquipo();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function getAllAlumnos()
  {
    $records = $this->prestamos->getAllAlumnos();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function save()
  {
    if ($_POST["id_prestamo"] == "0") {
      $records = $this->prestamos->save($_POST);
      $info = array('success' => true, 'msg' => "Registro guardado con exito");
    } else {
      /*if (count($this->prestamos->getOnePrestamo($_POST["id_prestamo"])) > 0) {
        $info = array('success' => false, 'msg' => "El registro ya existe");
      } else {*/
      $records = $this->prestamos->update($_POST);
      $info = array('success' => true, 'msg' => "Registro actualizado con exito");
      //}
    }
    echo json_encode($info);
  }

  public function getOnePrestamo()
  {
    $records = $this->prestamos->getOnePrestamo($_GET["id"]);
    if (count($records) > 0) {
      $info = array('success' => true, 'records' => $records);
    } else {
      $info = array('success' => false, 'msg' => "El registro no existe");
    }
    echo json_encode($info);
  }

  public function deletePrestamo()
  {
    $records = $this->prestamos->deletePrestamo($_GET["id"]);
    $info = array('success' => true, 'msg' => 'Registro eliminado con exito');
    echo json_encode($info);
  }
}
