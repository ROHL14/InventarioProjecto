<?php
include_once "app/models/libros.php";
class LibrosController extends Controller
{
	private $libros;
	public function __construct($param)
	{
		$this->libros = new Libros();
		parent::__construct("libros", $param, true);
	}
	public function getAll()
	{
		$records = $this->libros->getAll();
		$info = array('success' => true, 'records' => $records);
		echo json_encode($info);
	}
	public function getAllCategorias()
	{
		$records = $this->libros->getAllCategorias();
		$info = array('success' => true, 'records' => $records);
		echo json_encode($info);
	}
	public function getAllAutores()
	{
		$records = $this->libros->getAllAutores();
		$info = array('success' => true, 'records' => $records);
		echo json_encode($info);
	}
	public function save()
	{
		$imgP = "";
		$imgM = "";
		$imgG = "";
		if (isset($_FILES["fotop"])) {
			if (is_uploaded_file($_FILES["fotop"]["tmp_name"])) {
				if (($_FILES['fotop']['type'] == "image/png") || ($_FILES['fotop']['type'] == "image/jpeg")) {
					copy($_FILES["fotop"]["tmp_name"], __DIR__ . "/../../public_html/fotos/" . $_FILES["fotop"]["name"]) or die("No se pudo guardar el archivo");
					$imgP = URL . "public_html/fotos/" . $_FILES["fotop"]["name"];
				} else {
					$imgP = "";
				}
			}
		}
		if (isset($_FILES["fotom"])) {
			if (is_uploaded_file($_FILES["fotom"]["tmp_name"])) {
				if (($_FILES['fotom']['type'] == "image/png") || ($_FILES['fotom']['type'] == "image/jpeg")) {
					copy($_FILES["fotom"]["tmp_name"], __DIR__ . "/../../public_html/fotos/" . $_FILES["fotom"]["name"]) or die("No se pudo guardar el archivo");
					$imgM = URL . "public_html/fotos/" . $_FILES["fotom"]["name"];
				} else {
					$imgM = "";
				}
			}
		}
		if (isset($_FILES["fotog"])) {
			if (is_uploaded_file($_FILES["fotog"]["tmp_name"])) {
				if (($_FILES['fotog']['type'] == "image/png") || ($_FILES['fotog']['type'] == "image/jpeg")) {
					copy($_FILES["fotog"]["tmp_name"], __DIR__ . "/../../public_html/fotos/" . $_FILES["fotog"]["name"]) or die("No se pudo guardar el archivo");
					$imgG = URL . "public_html/fotos/" . $_FILES["fotog"]["name"];
				} else {
					$imgG = "";
				}
			}
		}
		if ($_POST["id_libro"] == "0") {
			if (count($this->libros->getLibroByTitulo($_POST["titulo"])) > 0) {
				$info = array('success' => false, 'msg' => "El libro ya existe");
			} else {
				$records = $this->libros->save($_POST, $imgP, $imgM, $imgG);
				$info = array('success' => true, 'msg' => "Registro guardado con exito");
			}
		} else {
			if (count($this->libros->getLibroByTituloAndId($_POST["titulo"], $_POST["id_libro"])) > 0) {
				$info = array('success' => false, 'msg' => "El libro ya existe");
			} else {
				$records = $this->libros->update($_POST, $imgP, $imgM, $imgG);
				$info = array('success' => true, 'msg' => "Registro guardado con exito");
			}
		}
		echo json_encode($info);
	}
	public function getOneLibro()
	{
		$records = $this->libros->getOneLibro($_GET["id"]);
		if (count($records) > 0) {
			$info = array('success' => true, 'records' => $records);
		} else {
			$info = array('success' => false, 'msg' => "El libro no existe");
		}
		echo json_encode($info);
	}

	public function deleteLibro()
	{
		$records = $this->libros->deleteLibro($_GET["id"]);
		$info = array('success' => true, 'msg' => 'Libro eliminado con exito');
		echo json_encode($info);
	}
}
