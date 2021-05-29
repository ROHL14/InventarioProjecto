<?php
include_once "app/models/db.class.php";
class Prestamos extends BaseDeDatos
{
  public function __construct()
  {
    parent::conectar();
  }

  public function getAll()
  {
    return $this->executeQuery("Select a.*, b.*, c.* from alumnos c inner join (equipo b inner join prestamos a on b.id_equipo=a.id_equipo) on c.id_alumno=a.id_alumno");
  }

  public function getPrestamoByEquipo($id)
  {
    return $this->executeQuery("Select a.*, b.*, c.* from alumnos c inner join (equipo b inner join prestamos a on b.id_equipo=a.id_equipo) on c.id_alumnos=a.id_alumnos where b.id_equipo='$id'");
  }

  public function getOnePrestamoByID($id)
  {
    return $this->executeQuery("Select a.*, b.*, c.* from alumnos c inner join (equipo b inner join prestamos a on b.id_equipo=a.id_equipo) on c.id_alumno=a.id_alumno where a.id_prestamo='$id'");
  }

  public function getAllEquipo()
  {
    return $this->executeQuery("Select * from equipo");
  }

  public function getAllAlumnos()
  {
    return $this->executeQuery("Select * from alumnos");
  }

  public function save($data)
  {
    return $this->executeInsert("insert into prestamos set id_alumno='{$data['id_alumno']}', id_equipo='{$data['id_equipo']}', estado_prestamo='prestado'");
  }

  public function update($data)
  {
    return $this->executeUpdate("update libros set id_alumno='{$data['id_alumno']}', id_equipo='{$data['id_equipo']}', estado_prestamo='entregado' where id_prestamo='{$data['id_prestamo']}'");
  }

  public function getOnePrestamo($id)
  {
    return $this->executeQuery("Select * from prestamos where id_prestamo='$id'");
  }

  public function deletePrestamo($id)
  {
    return $this->executeUpdate("delete from prestamos where id_prestamo='$id'");
  }
}
