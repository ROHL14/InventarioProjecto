<?php
include_once "app/models/db.class.php";
class Participantes extends BaseDeDatos
{
  public function __construct()
  {
    parent::conectar();
  }

  public function getAll()
  {
    return $this->executeQuery("Select a.*, b.*, c.* from alumnos c inner join (torneos b inner join participantes a on b.id_torneo=a.id_torneo) on c.id_alumno=a.id_alumno");
  }

  public function getParticipanteByTorneo($id)
  {
    return $this->executeQuery("Select a.*, b.*, c.* from alumnos c inner join (torneos b inner join participantes a on b.id_torneo=a.id_torneo) on c.id_alumnos=a.id_alumnos where b.id_torneo='$id'");
  }

  public function getOneParticipanteByID($id)
  {
    return $this->executeQuery("Select a.*, b.*, c.* from alumnos c inner join (torneos b inner join participantes a on b.id_torneo=a.id_torneo) on c.id_alumno=a.id_alumno where a.id_participante='$id'");
  }

  public function getAllTorneos()
  {
    return $this->executeQuery("Select * from torneos");
  }

  public function getAllAlumnos()
  {
    return $this->executeQuery("Select * from alumnos");
  }

  public function save($data)
  {
    return $this->executeInsert("insert into participantes set id_alumno='{$data['id_alumno']}', id_torneo='{$data['id_torneo']}'");
  }

  public function update($data)
  {
    return $this->executeUpdate("update libros set id_alumno='{$data['id_alumno']}', id_torneo='{$data['id_torneo']}' where id_participante='{$data['id_participante']}'");
  }

  public function getOneParticipante($id)
  {
    return $this->executeQuery("Select * from participantes where id_participante='$id'");
  }

  public function deleteParticipante($id)
  {
    return $this->executeUpdate("delete from participantes where id_participante='$id'");
  }
}
