<?php
include_once "app/models/db.class.php";
class Productos extends BaseDeDatos
{
  public function __construct()
  {
    parent::conectar();
  }

  public function getAll()
  {
    return $this->executeQuery("Select a.*, b.categoria from categorias b inner join productos a on b.id_categoria=a.id_categoria");
  }

  public function getProductoByCategoria($id)
  {
    return $this->executeQuery("Select a.*, b.categoria from categorias b inner join productos a on b.id_categoria=a.id_categoria where b.id_categoria='$id'");
  }

  public function getOneProductoByID($id)
  {
    return $this->executeQuery("Select a.*, b.categoria from categorias b inner join productos a on b.id_categoria=a.id_categoria where a.id_producto='$id'");
  }

  public function getAllCategorias()
  {
    return $this->executeQuery("Select * from categorias");
  }

  public function save($data)
  {
    return $this->executeInsert("
    insert into productos set nombre_producto='{$data['nombre_producto']}', 
    descripcion='{$data['descripcion']}',
    cantidad='{$data['cantidad']}',
    precio='{$data['precio']}', 
    fecha_agregado='{$data['fecha_agregado']}',
    id_categoria='{$data['id_categoria']}'
    ");
  }

  public function update($data)
  {
    return $this->executeUpdate("
    update productos set nombre_producto='{$data['nombre_producto']}', 
    descripcion='{$data['descripcion']}', 
    cantidad='{$data['cantidad']}',
    precio='{$data['precio']}', 
    fecha_agregado='{$data['fecha_agregado']}',
    id_categoria='{$data['id_categoria']}' 
    where id_producto='{$data['id_producto']}'
    ");
  }

  public function getProductoByName($nombre_producto)
  {
    return $this->executeQuery("Select * from productos where nombre_producto='$nombre_producto'");
  }

  public function getProductoByNameAndId($nombre_producto, $id)
  {
    return $this->executeQuery("Select * from productos where nombre_producto='$nombre_producto' and id_producto<>'$id'");
  }

  public function getOneProducto($id)
  {
    return $this->executeQuery("Select * from productos where id_producto='$id'");
  }

  public function deleteProducto($id)
  {
    return $this->executeUpdate("delete from productos where id_producto='$id'");
  }
}
