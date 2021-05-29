<?php
class BaseDeDatos
{
	protected $conexion;
	protected $isConnected = false;
	public function conectar()
	{
		$this->conexion = new mysqli("localhost", "root", "", "taekwondo");
		if ($this->conexion->connect_errno) {
			echo "Error de conexion:{$this->conexion->connect_error}";
			$this->isConnected = false;
		} else {
			$this->isConnected = true;
		}
		return $this->isConnected;
	}

	public function executeQuery($query)
	{
		$result = $this->conexion->query($query);
		$records = array();
		while ($record = $result->fetch_assoc()) {
			$records[] = $record;
		}
		return $records;
	}

	public function executeInsert($query)
	{
		$result = $this->conexion->query($query);
		return $this->conexion->insert_id;
	}

	public function executeUpdate($query)
	{
		$result = $this->conexion->query($query);
		return true;
	}
}
