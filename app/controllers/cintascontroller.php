<?php
include_once "app/models/cintas.php";
class CintasController extends Controller
{
  private $cinta;
  public function __construct($param)
  {
    $this->cinta = new Cintas();
    parent::__construct("cintas", $param, true);
  }

  public function getAll()
  {
    $records = $this->cinta->getAll();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function save()
  {
    if ($_POST["id_cinta"] == "0") {
      if (count($this->cinta->getCintaByColor($_POST["color"])) > 0) {
        $info = array('success' => false, 'msg' => "El cinta ya existe");
      } else {
        $records = $this->cinta->save($_POST);
        $info = array('success' => true, 'msg' => "Registro guardado con exito");
      }
    } else {
      if (count($this->cinta->getCintaByColorAndId($_POST["color"], $_POST["id_cinta"])) > 0) {
        $info = array('success' => false, 'msg' => "La cinta ya existe");
      } else {
        $records = $this->cinta->update($_POST);
        $info = array('success' => true, 'msg' => "Registro guardado con exito");
      }
    }
    echo json_encode($info);
  }

  public function getOneCinta()
  {
    $records = $this->cinta->getOneCinta($_GET["id"]);
    if (count($records) > 0) {
      $info = array('success' => true, 'records' => $records);
    } else {
      $info = array('success' => false, 'msg' => "La cinta no existe");
    }
    echo json_encode($info);
  }

  public function deleteCinta()
  {
    $records = $this->cinta->deleteCinta($_GET["id"]);
    $info = array('success' => true, 'msg' => 'cinta eliminada con exito');
    echo json_encode($info);
  }
}
