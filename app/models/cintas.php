<?php
include_once "app/models/db.class.php";
class Cintas extends BaseDeDatos
{
  public function __construct()
  {
    parent::conectar();
  }

  public function getAll()
  {
    return $this->executeQuery("Select * from cintas order by id_cinta");
  }

  public function save($data)
  {
    return $this->executeInsert("insert into cintas set color='{$data['color']}'");
  }

  public function update($data)
  {
    return $this->executeUpdate("update cintas set color='{$data['color']}' where id_cinta='{$data['id_cinta']}'");
  }

  public function getCintaByColor($color)
  {
    return $this->executeQuery("Select * from cintas where color='$color'");
  }

  public function getCintaByColorAndId($color, $id)
  {
    return $this->executeQuery("Select * from cintas where color='$color' and id_cinta<>'$id'");
  }

  public function getOneCinta($id)
  {
    return $this->executeQuery("Select * from cintas where id_cinta='$id'");
  }

  public function deleteCinta($id)
  {
    return $this->executeUpdate("delete from cintas where id_cinta='$id'");
  }
}
