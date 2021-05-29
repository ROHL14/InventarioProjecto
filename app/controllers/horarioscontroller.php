<?php
include_once "app/models/horarios.php";
class HorariosController extends Controller
{
  private $horario;
  public function __construct($param)
  {
    $this->horario = new Horarios();
    parent::__construct("horarios", $param, true);
  }

  public function getAll()
  {
    $records = $this->horario->getAll();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function save()
  {
    if ($_POST["id_horario"] == "0") {
      if (count($this->horario->getHorarioByName($_POST["nombre"])) > 0) {
        $info = array('success' => false, 'msg' => "El horario ya existe");
      } else {
        $records = $this->horario->save($_POST);
        $info = array('success' => true, 'msg' => "Registro guardado con exito");
      }
    } else {
      if (count($this->horario->getHorarioByNameAndId($_POST["nombre"], $_POST["id_horario"])) > 0) {
        $info = array('success' => false, 'msg' => "El horario ya existe");
      } else {
        $records = $this->horario->update($_POST);
        $info = array('success' => true, 'msg' => "Registro guardado con exito");
      }
    }
    echo json_encode($info);
  }

  public function getOneHorario()
  {
    $records = $this->horario->getOneHorario($_GET["id"]);
    if (count($records) > 0) {
      $info = array('success' => true, 'records' => $records);
    } else {
      $info = array('success' => false, 'msg' => "El horario no existe");
    }
    echo json_encode($info);
  }

  public function deleteHorario()
  {
    $records = $this->horario->deleteHorario($_GET["id"]);
    $info = array('success' => true, 'msg' => 'horario eliminado con exito');
    echo json_encode($info);
  }
}
