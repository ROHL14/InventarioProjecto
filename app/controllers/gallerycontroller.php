<?php
include_once "app/models/libros.php";
class GalleryController extends Controller
{
	private $libros;
	public function __construct($param)
	{
		$this->libros = new Libros();
		parent::__construct("gallery", $param);
	}
	public function getLibros()
	{
		$records = $this->libros->getLibrosByCategory($_GET["id"]);
		$info = array('success' => true, 'records' => $records);
		echo json_encode($info);
	}
	public function verlibro()
	{
		parent::__construct("verlibro", "");
	}
	public function getOneLibro()
	{
		$records = $this->libros->getOneLibroByID($_GET["id"]);
		$info = array('success' => true, 'records' => $records);
		echo json_encode($info);
	}
}
