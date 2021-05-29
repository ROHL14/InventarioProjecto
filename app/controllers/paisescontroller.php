<?php
include_once "app/models/paises.php";
class PaisesController extends Controller
{
  private $pais;
  public function __construct($param)
  {
    $this->pais = new Paises();
    parent::__construct("paises", $param, true);
  }

  public function getAll()
  {
    $records = $this->pais->getAll();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function save()
  {
    if ($_POST["id_pais"] == "0") {
      if (count($this->pais->getPaisByName($_POST["pais"])) > 0) {
        $info = array('success' => false, 'msg' => "El pais ya existe");
      } else {
        $records = $this->pais->save($_POST);
        $info = array('success' => true, 'msg' => "Registro guardado con exito");
      }
    } else {
      if (count($this->pais->getPaisByNameAndId($_POST["pais"], $_POST["id_pais"])) > 0) {
        $info = array('success' => false, 'msg' => "El pais ya existe");
      } else {
        $records = $this->pais->update($_POST);
        $info = array('success' => true, 'msg' => "Registro guardado con exito");
      }
    }
    echo json_encode($info);
  }

  public function getOnePais()
  {
    $records = $this->pais->getOnePais($_GET["id"]);
    if (count($records) > 0) {
      $info = array('success' => true, 'records' => $records);
    } else {
      $info = array('success' => false, 'msg' => "El pais no existe");
    }
    echo json_encode($info);
  }

  public function deletePais()
  {
    $records = $this->pais->deletePais($_GET["id"]);
    $info = array('success' => true, 'msg' => 'pais eliminado con exito');
    echo json_encode($info);
  }
}
