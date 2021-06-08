<?php
include_once "app/models/movimientos.php";
class DashboardController extends Controller
{
	//private $user;
	private $movimientos;

	public function __construct($param)
	{
		$this->movimientos = new Movimientos();
		parent::__construct("dashboard", $param, true);
	}

	public function getAll()
	{
		$records = $this->movimientos->getAll();
		$info = array('success' => true, 'records' => $records);
		echo json_encode($info);
	}

	public function getAllProductos()
	{
		$records = $this->movimientos->getAllProductos();
		$info = array('success' => true, 'records' => $records);
		echo json_encode($info);
	}
}
