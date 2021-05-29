<?php
include_once "app/models/db.class.php";
class Encargados extends BaseDeDatos
{
  public function __construct()
  {
    parent::conectar();
  }

  public function getAll()
  {
    return $this->executeQuery("Select * from encargados order by id_encargado");
  }

  public function save($data)
  {
    return $this->executeInsert("insert into encargados set nombres='{$data['nombres']}', apellidos='{$data['apellidos']}', telefono='{$data['telefono']}', email='{$data['email']}', direccion='{$data['direccion']}', dui='{$data['dui']}'");
  }

  public function update($data)
  {
    return $this->executeUpdate("update encargados set nombres='{$data['nombres']}', apellidos='{$data['apellidos']}', telefono='{$data['telefono']}', email='{$data['email']}', direccion='{$data['direccion']}', dui='{$data['dui']}' where id_encargado='{$data['id_encargado']}'");
  }

  public function getEncargadoByName($nombres)
  {
    return $this->executeQuery("Select * from encargados where nombres='$nombres'");
  }

  public function getEncargadoByNameAndId($nombres, $id)
  {
    return $this->executeQuery("Select * from encargados where nombres='$nombres' and id_encargado<>'$id'");
  }

  public function getOneEncargado($id)
  {
    return $this->executeQuery("Select * from encargados where id_encargado='$id'");
  }

  public function deleteEncargado($id)
  {
    return $this->executeUpdate("delete from encargados where id_encargado='$id'");
  }
}
