<?php
include_once "app/models/libros.php";
class MainController extends Controller
{
	private $libros;
	public function __construct($param)
	{
		$this->libros = new Libros();
		parent::__construct("main", $param);
		//parent::__construct("login", $param);
	}
	public function getAllCategorias()
	{
		$records = $this->libros->getAllCategorias();
		$info = array('success' => true, 'records' => $records);
		echo json_encode($info);
	}
}
