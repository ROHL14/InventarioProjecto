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
		return $this->executeQuery("Select id_usuario, nombres, apellidos, usuario, if(tipo=1,'Administrador','Usuario') as ntipo from usuarios order by id_usuario");
	}

	public function getUserByName($name)
	{
		return $this->executeQuery("Select id_usuario, nombres, apellidos, usuario, if(tipo=1,'Administrador','Usuario') as ntipo from usuarios where usuario='$name'");
	}

	public function getUserByNameAndId($name, $id)
	{
		return $this->executeQuery("Select id_usuario, nombres, apellidos, usuario, if(tipo=1,'Administrador','Usuario') as ntipo from usuarios where usuario='$name' and id_usuario<>'$id'");
	}

	public function save($data)
	{
		return $this->executeInsert("insert into usuarios set usuario='{$data['usuario']}',password=md5('{$data['password']}'),nombres='{$data['nombres']}',apellidos='{$data['apellidos']}',tipo='{$data['tipo']}'");
		//echo $this->conexion->error;
	}

	public function update($data)
	{
		return $this->executeUpdate("update usuarios set usuario='{$data['usuario']}',password=if('{$data['password']}'='', password,md5('{$data['password']}')),nombres='{$data['nombres']}',apellidos='{$data['apellidos']}',tipo='{$data['tipo']}' where id_usuario='{$data['id_usuario']}'");
		//echo $this->conexion->error;
	}

	public function getOneUser($id)
	{
		return $this->executeQuery("Select id_usuario, nombres, apellidos, usuario, tipo from usuarios where id_usuario='$id'");
	}

	public function deleteUser($id)
	{
		return $this->executeUpdate("delete from usuarios where id_usuario='$id'");
	}
}
