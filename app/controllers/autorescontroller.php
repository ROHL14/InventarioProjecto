<?php

include_once "app/models/autores.php";
class AutoresController extends Controller
{
	private $autor;
	public function __construct($param)
	{
		$this->autor = new Autores();
		parent::__construct("autores", $param, true);
	}

	public function getAll()
	{
		$records = $this->autor->getAll();
		$info = array('success' => true, 'records' => $records);
		echo json_encode($info);
	}

	public function save()
	{
		$img = "";
		if ($_POST["id_autor"] == "0") {
			if (count($this->autor->getAutorByName($_POST["nombre"])) > 0) {
				$info = array('success' => false, 'msg' => "El autor ya existe");
			} else {
				$records = $this->autor->save($_POST, $img);
				$info = array('success' => true, 'msg' => "Registro guardado con exito");
			}
		} else {
			if (count($this->autor->getAutorByNameAndId($_POST["nombre"], $_POST["id_autor"])) > 0) {
				$info = array('success' => false, 'msg' => "El usuario ya existe");
			} else {
				$records = $this->autor->update($_POST, $img);
				$info = array('success' => true, 'msg' => "Registro guardado con exito");
			}
		}
		echo json_encode($info);
	}

	public function getOneAutor()
	{
		$records = $this->autor->getOneAutor($_GET["id"]);
		if (count($records) > 0) {
			$info = array('success' => true, 'records' => $records);
		} else {
			$info = array('success' => false, 'msg' => "El autor no existe");
		}
		echo json_encode($info);
	}

	public function deleteAutor()
	{
		$records = $this->autor->deleteAutor($_GET["id"]);
		$info = array('success' => true, 'msg' => 'Autor eliminado con exito');
		echo json_encode($info);
	}
}
