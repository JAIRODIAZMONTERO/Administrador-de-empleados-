<?php 

	include("plantilla.php");

	if(!isset($_SESSION)){
		session_start();
	}

	if(!$_SESSION['autenticado']){
		header("Location: index.php");
		exit();
	}

	if($_SESSION['autenticado']){

		if($_SESSION['rol'] != "Administrador"){
			header("Location: index.php");
			exit();
		}		
	}

 ?>
<div id="main">
	<h2>Bienvenido</h2>
	<img src="App_Imagenes/empleados.jpg" id="fondo_home">
	<h3 id="mensaje">Sistema de gesti&oacute;n de Recursos Humanos</h3>
</div>