<?php
include_once "app/models/db.class.php";
class Reportes extends BaseDeDatos
{
  public function __construct()
  {
    parent::conectar();
  }

  public function getReporteUsuarios($data)
  {
    $condicion = "";
    if ($data["rol"] != "0") {
      $condicion .= " and rol='{$data['rol']}'";
    }

    return $this->executeQuery("
    Select * from usuarios 
    where 1=1 $condicion");
  }

  public function getReporteProductos($data)
  {
    $condicion = "";
    if ($data["id_categoria"] != "0") {
      $condicion .= " and b.id_categoria='{$data['id_categoria']}'";
    }

    return $this->executeQuery("
    Select a.*, b.categoria from categorias b inner join productos a on b.id_categoria=a.id_categoria 
    where 1=1 $condicion");
  }

  public function getReporteMovimientos($data)
  {
    $condicion = "";
    if ($data["tipo_mov"] != "0") {
      $condicion .= " and a.tipo_mov='{$data['tipo_mov']}'";
    }
    if ($data["id"] != "0") {
      $condicion .= " and b.id='{$data['id']}'";
    }
    if ($data["id_producto"]  != "0") {
      $condicion .= " and c.id_producto='{$data['id_producto']}'";
    }

    return $this->executeQuery("
    Select a.*, b.username, c.nombre_producto, c.precio, d.categoria from categorias d 
    inner join (productos c 
    inner join (usuarios b inner join movimientos a on b.id=a.id_usuario) 
    on c.id_producto=a.id_producto)
    on d.id_categoria=c.id_categoria 
    where 1=1 $condicion");
  }
}
