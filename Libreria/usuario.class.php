<?php 
	
	include_once("engine.php");

	class usuario{
		
		var $posicion;
		var $autenticado;

		function __construct($email, $clave){

			$this->autenticado = false;

			$query = "SELECT p.nombre AS rol, e.id, e.nombre FROM empleados e, posicion p WHERE
					  e.email = '$email' AND  e.password = SHA('$clave') AND e.id_posicion  = p.id";

			$rs = mysql_query($query);			

			if(mysql_num_rows($rs)>0){
				$fila = mysql_fetch_array($rs);

				$this->id = $fila['id'];				
				$this->autenticado = true;

				session_start();

				$_SESSION['autenticado'] = true;
				$_SESSION['rol'] = $fila['rol'];
				$_SESSION['id'] = $fila['id'];
				$_SESSION['nombre'] = $fila['nombre'];

				// var_dump($_SESSION);
				// exit();
			}
		}

		function cargar_usuario(){

			$query = "";
		}
	}

 ?>