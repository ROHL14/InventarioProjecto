<?php
include_once "app/models/productos.php";
class ProductosController extends Controller
{
  private $productos;

  public function __construct($param)
  {
    $this->productos = new Productos();
    parent::__construct("productos", $param, true);
  }

  public function getAll()
  {
    $records = $this->productos->getAll();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function getAllCategorias()
  {
    $records = $this->productos->getAllCategorias();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function save()
  {
    if ($_POST["id_producto"] == "0") {
      if (count($this->productos->getProductoByName($_POST["nombre_producto"])) > 0) {
        $info = array('success' => false, 'msg' => "El producto ya existe");
      } else {
        $records = $this->productos->save($_POST);
        $info = array('success' => true, 'msg' => "Registro guardado con exito");
      }
    } else {
      if (count($this->productos->getProductoByNameAndId($_POST["nombre_producto"], $_POST["id_producto"])) > 0) {
        $info = array('success' => false, 'msg' => "El producto ya existe");
      } else {
        $records = $this->productos->update($_POST);
        $info = array('success' => true, 'msg' => "Registro guardado con exito");
      }
    }
    echo json_encode($info);
  }

  public function getOneProducto()
  {
    $records = $this->productos->getOneProducto($_GET["id"]);
    if (count($records) > 0) {
      $info = array('success' => true, 'records' => $records);
    } else {
      $info = array('success' => false, 'msg' => "El producto no existe");
    }
    echo json_encode($info);
  }

  public function deleteProducto()
  {
    $records = $this->productos->deleteProducto($_GET["id"]);
    $info = array('success' => true, 'msg' => 'producto eliminado con exito');
    echo json_encode($info);
  }
}
