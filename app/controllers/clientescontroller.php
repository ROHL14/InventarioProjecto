<?php
include_once "app/models/clientes.php";
class Clientes extends Controller
{
  private $clientes;

  public function __construct($param)
  {
    $this->clientes = new Clientes();
    parent::__construct("clientes", $param, true);
  }

  public function getAll()
  {
    $records = $this->clientes->getAll();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function getAllCLientes()
  {
    $records = $this->clientes->getAllCLientes();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function save()
  {
    if ($_POST["id_cliente"] == "0") {
      if (count($this->clientes->getClienteByName($_POST["nombre"])) > 0) {
        $info = array('success' => false, 'msg' => "El cliente ya existe");
      } else {
        $records = $this->clientes->save($_POST);
        $info = array('success' => true, 'msg' => "Registro guardado con exito");
      }
    } else {
      if (count($this->clientes->getClienteByNameAndId($_POST["nombre"], $_POST["id_alumno"])) > 0) {
        $info = array('success' => false, 'msg' => "El cliente ya existe");
      } else {
        $records = $this->clientes->update($_POST);
        $info = array('success' => true, 'msg' => "Registro guardado con exito");
      }
    }
    echo json_encode($info);
  }

  public function getOneCliente()
  {
    $records = $this->clientes->getOneCliente($_GET["id"]);
    if (count($records) > 0) {
      $info = array('success' => true, 'records' => $records);
    } else {
      $info = array('success' => false, 'msg' => "El cliente no existe");
    }
    echo json_encode($info);
  }

  public function deleteCliente()
  {
    $records = $this->clientes->deleteCliente($_GET["id"]);
    $info = array('success' => true, 'msg' => 'Cliente eliminado con exito');
    echo json_encode($info);
  }
}
