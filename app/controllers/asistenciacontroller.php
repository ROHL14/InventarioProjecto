<?php
include_once "app/models/asistencia.php";
class AsistenciaController extends Controller
{
  private $asistencia;

  public function __construct($param)
  {
    $this->asistencia = new Asistencia();
    parent::__construct("asistencia", $param, true);
  }

  public function getAll()
  {
    $records = $this->asistencia->getAll();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function getAllHorarios()
  {
    $records = $this->asistencia->getAllHorarios();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function getAllAlumnos()
  {
    $records = $this->asistencia->getAllAlumnos();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function save()
  {
    if ($_POST["id_asistencia"] == "0") {
      $records = $this->asistencia->save($_POST);
      $info = array('success' => true, 'msg' => "Registro guardado con exito");
    } else {
      if (count($this->asistencia->getOneAsistencia($_POST["id_asistencia"])) > 0) {
        $info = array('success' => false, 'msg' => "El registro ya existe");
      } else {
        $records = $this->asistencia->update($_POST);
        $info = array('success' => true, 'msg' => "Registro actualizado con exito");
      }
    }
    echo json_encode($info);
  }

  public function getOneAsistencia()
  {
    $records = $this->asistencia->getOneAsistencia($_GET["id"]);
    if (count($records) > 0) {
      $info = array('success' => true, 'records' => $records);
    } else {
      $info = array('success' => false, 'msg' => "El registro no existe");
    }
    echo json_encode($info);
  }

  public function deleteAsistencia()
  {
    $records = $this->asistencia->deleteAsistencia($_GET["id"]);
    $info = array('success' => true, 'msg' => 'Registro eliminado con exito');
    echo json_encode($info);
  }
}
