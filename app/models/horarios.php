<?php
include_once "app/models/db.class.php";
class Horarios extends BaseDeDatos
{
  public function __construct()
  {
    parent::conectar();
  }

  public function getAll()
  {
    return $this->executeQuery("Select * from horarios order by id_horario");
  }

  public function save($data)
  {
    return $this->executeInsert("insert into horarios set nombre='{$data['nombre']}', hora='{$data['hora']}'");
  }

  public function update($data)
  {
    return $this->executeUpdate("update horarios set nombre='{$data['nombre']}', hora='{$data['hora']}' where id_horario='{$data['id_horario']}'");
  }

  public function getHorarioByName($nombre)
  {
    return $this->executeQuery("Select * from horarios where nombre='$nombre'");
  }

  public function getHorarioByNameAndId($nombre, $id)
  {
    return $this->executeQuery("Select * from horarios where nombre='$nombre' and id_horario<>'$id'");
  }

  public function getOneHorario($id)
  {
    return $this->executeQuery("Select * from horarios where id_horario='$id'");
  }

  public function deleteHorario($id)
  {
    return $this->executeUpdate("delete from horarios where id_horario='$id'");
  }
}
