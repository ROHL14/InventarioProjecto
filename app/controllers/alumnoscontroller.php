<?php
include_once "app/models/alumnos.php";
class AlumnosController extends Controller
{
  private $alumnos;

  public function __construct($param)
  {
    $this->alumnos = new Alumnos();
    parent::__construct("alumnos", $param, true);
  }

  public function getAll()
  {
    $records = $this->alumnos->getAll();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function getAllCintas()
  {
    $records = $this->alumnos->getAllCintas();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function save()
  {
    if ($_POST["id_alumno"] == "0") {
      if (count($this->alumnos->getAlumnoByName($_POST["nombre"])) > 0) {
        $info = array('success' => false, 'msg' => "El alumno ya existe");
      } else {
        $records = $this->alumnos->save($_POST);
        $info = array('success' => true, 'msg' => "Registro guardado con exito");
      }
    } else {
      if (count($this->alumnos->getAlumnoByNameAndId($_POST["nombre"], $_POST["id_alumno"])) > 0) {
        $info = array('success' => false, 'msg' => "El alumno ya existe");
      } else {
        $records = $this->alumnos->update($_POST);
        $info = array('success' => true, 'msg' => "Registro guardado con exito");
      }
    }
    echo json_encode($info);
  }

  public function getOneAlumno()
  {
    $records = $this->alumnos->getOneAlumno($_GET["id"]);
    if (count($records) > 0) {
      $info = array('success' => true, 'records' => $records);
    } else {
      $info = array('success' => false, 'msg' => "El alumno no existe");
    }
    echo json_encode($info);
  }

  public function deleteAlumno()
  {
    $records = $this->alumnos->deleteAlumno($_GET["id"]);
    $info = array('success' => true, 'msg' => 'alumno eliminado con exito');
    echo json_encode($info);
  }
}
