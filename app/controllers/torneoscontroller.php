<?php
include_once "app/models/torneos.php";
class TorneosController extends Controller
{
	private $torneos;

	public function __construct($param)
	{
		$this->torneos = new Torneos();
		parent::__construct("torneos", $param, true);
	}

	public function getAll()
	{
		$records = $this->torneos->getAll();
		$info = array('success' => true, 'records' => $records);
		echo json_encode($info);
	}

	public function getAllPaises()
	{
		$records = $this->torneos->getAllPaises();
		$info = array('success' => true, 'records' => $records);
		echo json_encode($info);
	}

	public function save()
	{
		if ($_POST["id_torneo"] == "0") {
			if (count($this->torneos->getTorneoByName($_POST["nombre"])) > 0) {
				$info = array('success' => false, 'msg' => "El torneo ya existe");
			} else {
				$records = $this->torneos->save($_POST);
				$info = array('success' => true, 'msg' => "Registro guardado con exito");
			}
		} else {
			if (count($this->torneos->getTorneoByNameAndId($_POST["nombre"], $_POST["id_torneo"])) > 0) {
				$info = array('success' => false, 'msg' => "El torneo ya existe");
			} else {
				$records = $this->torneos->update($_POST);
				$info = array('success' => true, 'msg' => "Registro guardado con exito");
			}
		}
		echo json_encode($info);
	}

	public function getOneTorneo()
	{
		$records = $this->torneos->getOneTorneo($_GET["id"]);
		if (count($records) > 0) {
			$info = array('success' => true, 'records' => $records);
		} else {
			$info = array('success' => false, 'msg' => "El torneo no existe");
		}
		echo json_encode($info);
	}

	public function deleteTorneo()
	{
		$records = $this->torneos->deleteTorneo($_GET["id"]);
		$info = array('success' => true, 'msg' => 'Torneo eliminado con exito');
		echo json_encode($info);
	}
}
