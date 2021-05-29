<?php
include_once "app/models/usuarios.php";
class UsuariosController extends Controller
{
	private $user;
	public function __construct($param)
	{
		$this->user = new Usuarios();
		parent::__construct("usuarios", $param, true);
	}

	public function getAll()
	{
		$records = $this->user->getAll();
		$info = array('success' => true, 'records' => $records);
		echo json_encode($info);
	}

	public function save()
	{
		if ($_POST["id_usuario"] == "0") {
			if (count($this->user->getUserByName($_POST["usuario"])) > 0) {
				$info = array('success' => false, 'msg' => "El usuario ya existe");
			} else {
				$records = $this->user->save($_POST);
				$info = array('success' => true, 'msg' => "Registro guardado con exito");
			}
		} else {
			if (count($this->user->getUserByNameAndId($_POST["usuario"], $_POST["id_usuario"])) > 0) {
				$info = array('success' => false, 'msg' => "El usuario ya existe");
			} else {
				$records = $this->user->update($_POST);
				$info = array('success' => true, 'msg' => "Registro guardado con exito");
			}
		}
		echo json_encode($info);
	}

	public function getOneUser()
	{
		$records = $this->user->getOneUser($_GET["id"]);
		if (count($records) > 0) {
			$info = array('success' => true, 'records' => $records);
		} else {
			$info = array('success' => false, 'msg' => "El usuario no existe");
		}
		echo json_encode($info);
	}

	public function deleteUser()
	{
		$records = $this->user->deleteUser($_GET["id"]);
		$info = array('success' => true, 'msg' => "Usuario eliminado con exito");
		echo json_encode($info);
	}
}
