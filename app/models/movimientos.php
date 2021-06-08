<?php
include_once "app/models/db.class.php";
class Movimientos extends BaseDeDatos
{
  public function __construct()
  {
    parent::conectar();
  }

  public function getAll()
  {
    /*return $this->executeQuery("
    Select a.*, b.*, c.* from productos c 
    inner join (usuarios b inner join movimientos a on b.id=a.id_usuario) 
    on c.id_producto=a.id_producto");*/
    return $this->executeQuery("
    Select a.*, b.*, c.*, d.* from categorias d inner join (productos c 
    inner join (usuarios b inner join movimientos a on b.id=a.id_usuario) 
    on c.id_producto=a.id_producto) on c.id_categoria=d.id_categoria");
  }

  public function getAllEntradas()
  {
    return $this->executeQuery("
    Select a.*, b.*, c.* from productos c 
    inner join (usuarios b inner join movimientos a on b.id_usuario=a.id_usuario) 
    on c.id_producto=a.id_producto 
    where tipo_mov='entrada'");
  }

  public function getAllSalidas()
  {
    return $this->executeQuery("
    Select a.*, b.*, c.* from productos c 
    inner join (usuarios b inner join movimientos a on b.id_usuario=a.id_usuario) 
    on c.id_producto=a.id_producto 
    where a.tipo_mov='salida'");
  }

  public function getMovimientoByProducto($id)
  {
    return $this->executeQuery("
    Select a.*, b.*, c.* from productos c 
    inner join (usuarios b inner join movimientos a on b.id_usuario=a.id_usuario) 
    on c.id_producto=a.id_producto 
    where c.id_producto='$id'");
  }

  public function getMovimientoByUsuario($id)
  {
    return $this->executeQuery("
    Select a.*, b.*, c.* from productos c 
    inner join (usuarios b inner join movimientos a on b.id_usuario=a.id_usuario) 
    on c.id_producto=a.id_producto 
    where b.id_usuario='$id'");
  }

  public function getOneMovimientoByID($id)
  {
    return $this->executeQuery("
    Select a.*, b.*, c.* from productos c 
    inner join (usuarios b inner join movimientos a on b.id_usuario=a.id_usuario) 
    on c.id_producto=a.id_producto 
    where a.id_movimiento='$id'");
  }

  public function getAllProductos()
  {
    return $this->executeQuery("Select a.*, b.categoria from categorias b inner join productos a on b.id_categoria=a.id_categoria");
  }

  public function getAllUsuarios()
  {
    return $this->executeQuery("Select * from usuarios");
  }

  public function saveEntrada($data, $id)
  {
    return $this->executeInsert("
    insert into movimientos set 
    tipo_mov='{$data['tipo_movimiento']}', 
    cantidad_inicial='{$data['cantidad_inicial']}',
    cantidad_final={$data['cantidad_inicial']} + {$data['cantidad']},
    precio_inicial='{$data['precio_inicial']}', 
    precio_final={$data['precio_inicial']} + {$data['precio']} * {$data['cantidad']}, 
    fecha_movimiento='{$data['fecha_movimiento']}',
    id_producto='{$data['id_producto']}', 
    id_usuario='{$id}'
    ");
  }

  public function saveSalida($data, $id)
  {
    return $this->executeInsert("
    insert into movimientos set 
    tipo_mov='{$data['tipo_movimiento']}', 
    cantidad_inicial='{$data['cantidad_inicial']}',
    cantidad_final={$data['cantidad_inicial']} - {$data['cantidad']},
    precio_inicial='{$data['precio_inicial']}', 
    precio_final={$data['precio_inicial']} - {$data['precio']} * {$data['cantidad']}, 
    fecha_movimiento='{$data['fecha_movimiento']}',
    id_producto='{$data['id_producto']}', 
    id_usuario='{$id}'
    ");
  }

  public function update($data)
  {
    return $this->executeUpdate("
    update productos set 
    tipo_mov='{$data['tipo_mov']}', 
    cantidad_inicial='{$data['cantidad_inicial']}',
    cantidad_final='{$data['cantidad_final']}',
    precio_inicial='{$data['precio_inicial']}', 
    precio_final='{$data['precio_final']}', 
    fecha_movimiento='{$data['fecha_movimiento']}',
    id_producto='{$data['id_producto']}', 
    id_usuario='{$data['id_usuario']}'
    where id_movimiento='{$data['id_movimiento']}'
    ");
  }

  public function updateProductoEntrada($data)
  {
    return $this->executeUpdate("
    update productos set 
    cantidad=cantidad + {$data['cantidad']}
    where id_producto='{$data['id_producto']}'
    ");
  }

  public function updateProductoSalida($data)
  {
    return $this->executeUpdate("
    update productos set 
    cantidad=cantidad - {$data['cantidad']}
    where id_producto='{$data['id_producto']}'
    ");
  }

  public function getOneMovimiento($id)
  {
    return $this->executeQuery("Select * from movimientos where id_movimiento='$id'");
  }

  public function deleteMovimiento($id)
  {
    return $this->executeUpdate("delete from movimientos where id_movimiento='$id'");
  }
}
