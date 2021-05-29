<?php
include_once "app/models/db.class.php";
class Asistencia extends BaseDeDatos
{
  public function __construct()
  {
    parent::conectar();
  }

  public function getAll()
  {
    return $this->executeQuery("Select a.*, b.*, c.* from alumnos c inner join (horarios b inner join asistencia a on b.id_horario=a.id_horario) on c.id_alumno=a.id_alumno");
  }

  public function getAsistenciaByHorario($id)
  {
    return $this->executeQuery("Select a.*, b.*, c.* from alumnos c inner join (horarios b inner join asistencia a on b.id_horario=a.id_horario) on c.id_alumnos=a.id_alumnos where b.id_horario='$id'");
  }

  public function getOneAsistenciaByID($id)
  {
    return $this->executeQuery("Select a.*, b.*, c.* from alumnos c inner join (horarios b inner join asistencia a on b.id_horario=a.id_horario) on c.id_alumno=a.id_alumno where a.id_asistencia='$id'");
  }

  public function getAllHorarios()
  {
    return $this->executeQuery("Select * from horarios");
  }

  public function getAllAlumnos()
  {
    return $this->executeQuery("Select * from alumnos");
  }

  public function save($data)
  {
    return $this->executeInsert("insert into asistencia set id_alumno='{$data['id_alumno']}', id_horario='{$data['id_horario']}', fecha='{$data['fecha']}'");
  }

  public function update($data)
  {
    return $this->executeUpdate("update libros set id_alumno='{$data['id_alumno']}', id_horario='{$data['id_horario']}', fecha='{$data['fecha']}' where id_asistencia='{$data['id_asistencia']}'");
  }

  public function getOneAsistencia($id)
  {
    return $this->executeQuery("Select * from asistencia where id_asistencia='$id'");
  }

  public function deleteAsistencia($id)
  {
    return $this->executeUpdate("delete from asistencia where id_asistencia='$id'");
  }
}
