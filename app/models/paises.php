<?php
include_once "app/models/db.class.php";
class Paises extends BaseDeDatos
{
  public function __construct()
  {
    parent::conectar();
  }

  public function getAll()
  {
    return $this->executeQuery("Select * from paises order by id_pais");
  }

  public function save($data)
  {
    return $this->executeInsert("insert into paises set pais='{$data['pais']}'");
  }

  public function update($data)
  {
    return $this->executeUpdate("update paises set pais='{$data['pais']}' where id_pais='{$data['id_pais']}'");
  }

  public function getPaisByName($pais)
  {
    return $this->executeQuery("Select * from paises where pais='$pais'");
  }

  public function getPaisByNameAndId($pais, $id)
  {
    return $this->executeQuery("Select * from paises where pais='$pais' and id_pais<>'$id'");
  }

  public function getOnePais($id)
  {
    return $this->executeQuery("Select * from paises where id_pais='$id'");
  }

  public function deletePais($id)
  {
    return $this->executeUpdate("delete from paises where id_pais='$id'");
  }
}
