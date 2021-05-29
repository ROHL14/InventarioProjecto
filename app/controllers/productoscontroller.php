<?php
include_once "app/models/productos.php";
class ProductosController extends Controller
{
  private $producto;

  public function __construct($param)
  {
    $this->producto = new Productos();
    parent::__construct("productos", $param, true);
  }

  public function getAll()
  {
    $records = $this->producto->getAll();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function getAllCategorias()
  {
    $records = $this->producto->getAllCategorias();
    $info = array('success' => true, 'records' => $records);
    echo json_encode($info);
  }

  public function save()
  {
    if ($_POST["id_producto"] == "0") {
      if (count($this->producto->getProductoByName($_POST["nombre_producto"])) > 0) {
        $info = array('success' => false, 'msg' => "El producto ya existe");
      } else {
        $records = $this->producto->save($_POST);
        $info = array('success' => true, 'msg' => "Registro guardado con exito");
      }
    } else {
      if (count($this->producto->getProductoByNameAndId($_POST["nombre_producto"], $_POST["id_producto"])) > 0) {
        $info = array('success' => false, 'msg' => "El producto ya existe");
      } else {
        $records = $this->producto->update($_POST);
        $info = array('success' => true, 'msg' => "Registro guardado con exito");
      }
    }
    echo json_encode($info);
  }

  public function getOneProducto()
  {
    $records = $this->producto->getOneProducto($_GET["id"]);
    if (count($records) > 0) {
      $info = array('success' => true, 'records' => $records);
    } else {
      $info = array('success' => false, 'msg' => "El producto no existe");
    }
    echo json_encode($info);
  }

  public function deleteProducto()
  {
    $records = $this->producto->deleteProducto($_GET["id"]);
    $info = array('success' => true, 'msg' => 'producto eliminado con exito');
    echo json_encode($info);
  }
}
