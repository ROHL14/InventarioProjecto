<?php
include_once "app/models/db.class.php";
class Categorias extends BaseDeDatos
{
	public function __construct()
	{
		parent::conectar();
	}

	public function getAll()
	{
		return $this->executeQuery("Select * from categorias order by id_categoria");
	}

	public function save($data)
	{
		return $this->executeInsert("insert into categorias set categoria='{$data['categoria']}'");
	}

	public function update($data)
	{
		return $this->executeUpdate("update categorias set categoria='{$data['categoria']}' where id_categoria='{$data['id_categoria']}'");
	}

	public function getCategoriaByName($categoria)
	{
		return $this->executeQuery("Select * from categorias where categoria='$categoria'");
	}

	public function getCategoriaByNameAndId($categoria, $id)
	{
		return $this->executeQuery("Select * from categorias where categoria='$categoria' and id_categoria<>'$id'");
	}

	public function getOneCategoria($id)
	{
		return $this->executeQuery("Select * from categorias where id_categoria='$id'");
	}

	public function deleteCategoria($id)
	{
		return $this->executeUpdate("delete from categorias where id_categoria='$id'");
	}
}
