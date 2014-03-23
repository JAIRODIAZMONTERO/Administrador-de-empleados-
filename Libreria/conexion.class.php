<?php 
	
	include_once("../configuracion/DBconfig.php");
	
	$con = new conexion($config['servidor'], $config['usuario'], $config['clave'], $config['basedatos']);

	class conexion{
		var $servidor;
		var $usuario;
		var $clave;
		var $basedatos;
		var $enlace;

		function __construct($servidor, $usuario, $clave, $basedatos){
			$this->servidor = $servidor;
			$this->usuario = $usuario;
			$this->clave = $clave;
			$this->basedatos = $basedatos;
			$this->enlace = mysql_connect($servidor, $usuario, $clave);
			
			mysql_select_db($basedatos);
		}

		function __destruct(){
			mysql_close($this->enlace);
		}
	}
 ?>