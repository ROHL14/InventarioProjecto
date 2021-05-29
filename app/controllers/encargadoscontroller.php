<?php
include_once "app/models/encargados.php";
class EncargadosController extends Controller
{
  private $encargado;
  public function __construct($param)
  {
    $this->encargado = new Encargados();
    parent::__construct("encargados", $param, true);
  }

  public function getAll()
  {
    $records = $this->encargado->getAll();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function save()
  {
    if ($_POST["id_encargado"] == "0") {
      if (count($this->encargado->getEncargadoByName($_POST["nombres"])) > 0) {
        $info = array('success' => false, 'msg' => "El encargado ya existe");
      } else {
        $records = $this->encargado->save($_POST);
        $info = array('success' => true, 'msg' => "Registro guardado con exito");
      }
    } else {
      if (count($this->encargado->getEncargadoByNameAndId($_POST["nombres"], $_POST["id_encargado"])) > 0) {
        $info = array('success' => false, 'msg' => "El encargado ya existe");
      } else {
        $records = $this->encargado->update($_POST);
        $info = array('success' => true, 'msg' => "Registro guardado con exito");
      }
    }
    echo json_encode($info);
  }

  public function getOneEncargado()
  {
    $records = $this->encargado->getOneEncargado($_GET["id"]);
    if (count($records) > 0) {
      $info = array('success' => true, 'records' => $records);
    } else {
      $info = array('success' => false, 'msg' => "El encargado no existe");
    }
    echo json_encode($info);
  }

  public function deleteEncargado()
  {
    $records = $this->encargado->deleteEncargado($_GET["id"]);
    $info = array('success' => true, 'msg' => 'encargado eliminado con exito');
    echo json_encode($info);
  }
}
