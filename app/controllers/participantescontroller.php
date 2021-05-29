<?php
include_once "app/models/participantes.php";
class ParticipantesController extends Controller
{
  private $participantes;

  public function __construct($param)
  {
    $this->participantes = new Participantes();
    parent::__construct("participantes", $param, true);
  }

  public function getAll()
  {
    $records = $this->participantes->getAll();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function getAllTorneos()
  {
    $records = $this->participantes->getAllTorneos();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function getAllAlumnos()
  {
    $records = $this->participantes->getAllAlumnos();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function save()
  {
    if ($_POST["id_participante"] == "0") {
      $records = $this->participantes->save($_POST);
      $info = array('success' => true, 'msg' => "Registro guardado con exito");
    } else {
      if (count($this->participantes->getOneParticipante($_POST["id_participante"])) > 0) {
        $info = array('success' => false, 'msg' => "El registro ya existe");
      } else {
        $records = $this->participantes->update($_POST);
        $info = array('success' => true, 'msg' => "Registro actualizado con exito");
      }
    }
    echo json_encode($info);
  }

  public function getOneParticipante()
  {
    $records = $this->participantes->getOneParticipante($_GET["id"]);
    if (count($records) > 0) {
      $info = array('success' => true, 'records' => $records);
    } else {
      $info = array('success' => false, 'msg' => "El registro no existe");
    }
    echo json_encode($info);
  }

  public function deleteParticipante()
  {
    $records = $this->participantes->deleteParticipante($_GET["id"]);
    $info = array('success' => true, 'msg' => 'Registro eliminado con exito');
    echo json_encode($info);
  }
}
