<?php
include_once "app/models/db.class.php";
class Clientes extends BaseDeDatos
{
  public function __construct()
  {
    parent::conectar();
  }

  public function getAll()
  {
    return $this->executeQuery("Select * from clientes");
  }

  public function getOneClienteByID($id)
  {
    return $this->executeQuery("Select * from clientes where id_cliente= '$id'");
  }

  public function save($data)
  {
    return $this->executeInsert("
    insert into clientes set nombre='{$data['nombre']}', 
    apellido='{$data['apellido']}',
    telefono='{$data['telefono']}',
    email='{$data['email']}',
    dui='{$data['dui']}'
    ");
  }

  public function update($data)
  {
    return $this->executeUpdate("
    update clientes set nombre='{$data['nombre']}', 
    apellido='{$data['apellido']}',
    telefono='{$data['telefono']}',
    email='{$data['email']}',
    dui='{$data['dui']}' 
    where id_cliente='{$data['id_cliente']}'
    ");
  }

  public function getClienteByName($nombre)
  {
    return $this->executeQuery("Select * from clientes where nombre='$nombre'");
  }

  public function getClienteByNameAndId($nombre, $id)
  {
    return $this->executeQuery("Select * from clientes where nombre='$nombre' and id_cliente<>'$id'");
  }

  public function getOneCliente($id)
  {
    return $this->executeQuery("Select * from clientes where id_cliente='$id'");
  }

  public function deleteAlumno($id)
  {
    return $this->executeUpdate("delete from clientes where id_cliente='$id'");
  }
}
