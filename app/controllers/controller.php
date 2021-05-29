<?php
require_once "app/views/view.php";
class Controller
{
	public $view;
	public function __construct($view, $param, $validar = false)
	{
		$this->view = new View();
		if ($validar) {
			if (!isset($_SESSION)) {
				session_start();
			}
			if (!isset($_SESSION["id_usuario"])) {
				$this->view->render("login");
				exit(0);
			}
		}
		if (empty($param)) {
			$this->view->render($view);
			//$this->view->render("login");
			return;
		}
		if (method_exists($this, $param)) {
			$this->$param();
		} else {
			//$this->view->render($view);
			echo "Metodo no disponible";
		}
	}
}
