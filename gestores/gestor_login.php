<?php 

	include_once("../Libreria/engine.php");

	if(isset($_POST)){

		if(isset($_POST['tarea'])){
			cerrar_sesion();
		}

		else{

			$email = mysql_real_escape_string($_POST['email']);
			$clave = mysql_real_escape_string($_POST['clave']);

			$usuario = new usuario($email, $clave);

			if($usuario->autenticado==true){

				if($_SESSION['rol'] == "administrador" || $_SESSION['rol'] == "Administrador" ){
					header("Location: ../Admin.php");

					// var_dump($_SESSION);
					exit();
				}

				else{
					header("Location: ../vista_empleado.php");
					exit();	
				}
			}

			else{
				header("Location: ../");
				exit();
			}
		}
	}

	function cerrar_sesion(){

		$_SESSION = array();

		header("Location: ../");
	}
 ?>