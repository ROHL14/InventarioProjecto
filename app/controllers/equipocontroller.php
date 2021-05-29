<?php
include_once "app/models/equipo.php";
class EquipoController extends Controller
{
  private $equipo;

  public function __construct($param)
  {
    $this->equipo = new Equipo();
    parent::__construct("equipo", $param, true);
  }

  public function getAll()
  {
    $records = $this->equipo->getAll();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function getAllCategorias()
  {
    $records = $this->equipo->getAllCategorias();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function save()
  {
    if ($_POST["id_equipo"] == "0") {
      if (count($this->equipo->getEquipoByName($_POST["nombre"])) > 0) {
        $info = array('success' => false, 'msg' => "El equipo ya existe");
      } else {
        $records = $this->equipo->save($_POST);
        $info = array('success' => true, 'msg' => "Registro guardado con exito");
      }
    } else {
      if (count($this->equipo->getEquipoByNameAndId($_POST["nombre"], $_POST["id_equipo"])) > 0) {
        $info = array('success' => false, 'msg' => "El equipo ya existe");
      } else {
        $records = $this->equipo->update($_POST);
        $info = array('success' => true, 'msg' => "Registro guardado con exito");
      }
    }
    echo json_encode($info);
  }

  public function getOneEquipo()
  {
    $records = $this->equipo->getOneEquipo($_GET["id"]);
    if (count($records) > 0) {
      $info = array('success' => true, 'records' => $records);
    } else {
      $info = array('success' => false, 'msg' => "El equipo no existe");
    }
    echo json_encode($info);
  }

  public function deleteEquipo()
  {
    $records = $this->equipo->deleteEquipo($_GET["id"]);
    $info = array('success' => true, 'msg' => 'Equipo eliminado con exito');
    echo json_encode($info);
  }
}
