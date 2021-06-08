<?php
include_once "app/models/login.php";
class LoginController extends Controller
{
	private $user;
	public function __construct($param)
	{
		$this->user = new Login();
		parent::__construct("login", $param);

		/*if (!isset($_SESSION)) {
			parent::__construct("login", $param);
		} else {
			parent::__construct("dashboard", $param, true);
		}*/
	}
	public function validar()
	{
		$u = $_POST["user"] ?? "";
		$p = $_POST["pass"] ?? "";
		if ($record = $this->user->validarLogin($u, $p)) {
			if (!isset($_SESSION)) {
				session_start();
			}
			$_SESSION["id"] = $record["id"];
			$_SESSION["rol"] = $record["rol"];
			$_SESSION["username"] = $record["username"];
			$_SESSION["nombre"] = "{$record['nombre']}";
			$info = array('success' => true, 'msg' => 'Usuario correcto', 'link' => URL . "dashboard");
			/*if ($record["rol"] == "administrador") {
				$info = array('success' => true, 'msg' => 'Usuario correcto', 'link' => URL . "dashboard");
			} else {
				$info = array('success' => true, 'msg' => 'Usuario correcto', 'link' => URL . "dashboarduser");
			}*/
		} else {
			$info = array('success' => false, 'msg' => 'Usuario o password incorrecto');
		}
		echo json_encode($info);
	}

	public function cerrar()
	{
		if (!isset($_SESSION)) {
			session_start();
		}
		session_destroy();
		$this->view->render("login");
	}
}
