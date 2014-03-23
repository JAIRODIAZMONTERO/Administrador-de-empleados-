<?php 

	if(!isset($_SESSION)){
		session_start();
	}	

	include_once("empleado.class.php");
	include_once("posicion.class.php");
	include_once("conexion.class.php");
	include_once("usuario.class.php");
	include_once("../configuracion/DBconfig.php");

 ?>