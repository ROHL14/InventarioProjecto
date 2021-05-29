<?php
include_once "app/models/db.class.php";
class Alumnos extends BaseDeDatos
{
  public function __construct()
  {
    parent::conectar();
  }

  public function getAll()
  {
    return $this->executeQuery("Select a.*, b.color from cintas b inner join alumnos a on b.id_cinta=a.id_cinta");
  }

  public function getAlumnoByCinta($id)
  {
    return $this->executeQuery("Select a.*, b.color from cintas b inner join alumnos a on b.id_cinta=a.id_cinta where b.id_cinta='$id'");
  }

  public function getOneAlumnoByID($id)
  {
    return $this->executeQuery("Select a.*, b.color from cintas b inner join alumnos a on b.id_cinta=a.id_cinta where a.id_alumno='$id'");
  }

  public function getAllCintas()
  {
    return $this->executeQuery("Select * from cintas");
  }

  public function save($data)
  {
    return $this->executeInsert("
    insert into alumnos set nombre='{$data['nombre']}', 
    apellido='{$data['apellido']}',
    dui='{$data['dui']}',
    fechanac='{$data['fechanac']}',
    email='{$data['email']}',
    telefono='{$data['telefono']}',
    estado='{$data['estado']}',
    id_cinta='{$data['id_cinta']}'
    ");
  }

  public function update($data)
  {
    return $this->executeUpdate("
    update alumnos set nombre='{$data['nombre']}', 
    apellido='{$data['apellido']}',
    dui='{$data['dui']}',
    fechanac='{$data['fechanac']}',
    email='{$data['email']}',
    telefono='{$data['telefono']}', 
    estado='{$data['estado']}', 
    id_cinta='{$data['id_cinta']}' 
    where id_alumno='{$data['id_alumno']}'
    ");
  }

  public function getAlumnoByName($nombre)
  {
    return $this->executeQuery("Select * from alumnos where nombre='$nombre'");
  }

  public function getAlumnoByNameAndId($nombre, $id)
  {
    return $this->executeQuery("Select * from alumnos where nombre='$nombre' and id_alumno<>'$id'");
  }

  public function getOneAlumno($id)
  {
    return $this->executeQuery("Select * from alumnos where id_alumno='$id'");
  }

  public function deleteAlumno($id)
  {
    return $this->executeUpdate("delete from alumnos where id_alumno='$id'");
  }
}
