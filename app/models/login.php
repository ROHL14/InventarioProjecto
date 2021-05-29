<?php
include_once "app/models/db.class.php";
class Login extends BaseDeDatos
{
	public function __construct()
	{
		parent::conectar();
	}

	public function validarLogin($user, $pass)
	{
		$result = $this->conexion->query("Select * from usuarios where usuario='$user' and password=md5('$pass')");
		//Inyeccion SQL
		//return $result->fetch_assoc();
		if ($record = $result->fetch_assoc()) {
			return $record;
		} else {
			return false;
		}
	}
}
