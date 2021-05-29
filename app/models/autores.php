<?php
include_once "app/models/db.class.php";
class Autores extends BaseDeDatos
{
	public function __construct()
	{
		parent::conectar();
	}

	public function getAll()
	{
		return $this->executeQuery("Select * from autores order by id_autor");
	}

	public function save($data, $img)
	{
		return $this->executeInsert("insert into autores set nombre='{$data['nombre']}'");
	}

	public function update($data, $img)
	{
		return $this->executeUpdate("update autores set nombre='{$data['nombre']}' where id_autor='{$data['id_autor']}'");
	}

	public function getAutorByName($autor)
	{
		return $this->executeQuery("Select * from autores where nombre='$autor'");
	}

	public function getAutorByNameAndId($autor, $id)
	{
		return $this->executeQuery("Select * from autores where nombre='$autor' and id_autor<>'$id'");
	}

	public function getOneAutor($id)
	{
		return $this->executeQuery("Select * from autores where id_autor='$id'");
	}

	public function deleteAutor($id)
	{
		return $this->executeUpdate("delete from autores where id_autor='$id'");
	}
}
