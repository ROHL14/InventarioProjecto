<?php
include_once "app/models/db.class.php";
class Usuarios extends BaseDeDatos
{
	public function __construct()
	{
		parent::conectar();
	}

	public function getAll()
	{
		return $this->executeQuery("Select id, username, password, nombre, email, rol from usuarios order by id");
	}

	public function getUserByName($username)
	{
		return $this->executeQuery("Select id, username, password, nombre, email, rol from usuarios where username='$username'");
	}

	public function getUserByNameAndId($username, $id)
	{
		return $this->executeQuery("Select id, username, password, nombre, email, rol from usuarios where username='$username' and id<>'$id'");
	}

	public function save($data)
	{
		return $this->executeInsert("insert into usuarios set username='{$data['username']}',password=md5('{$data['password']}'), nombre='{$data['nombre']}', email='{$data['email']}, rol='{$data['rol']}'");
		//echo $this->conexion->error;
	}

	public function update($data)
	{
		return $this->executeUpdate("update usuarios set username='{$data['username']}',password=if('{$data['password']}'='', password,md5('{$data['password']}')), nombre='{$data['nombre']}', email='{$data['email']}, rol='{$data['rol']}' where id='{$data['id']}'");
		//echo $this->conexion->error;
	}

	public function getOneUser($id)
	{
		return $this->executeQuery("Select id, nombre, username, rol from usuarios where id='$id'");
	}

	public function deleteUser($id)
	{
		return $this->executeUpdate("delete from usuarios where id='$id'");
	}
}
