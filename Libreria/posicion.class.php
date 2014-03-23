<?php 

	include ("../Libreria/engine.php");

	class posicion{
		var $id;
		var $nombre;
		var $salario;
		var $id_superior;

		function __construct($id=0){
			if($id>0){
				$this->id = $id;
			}
		}

		function guardar(){

			if($this->id >0){
				$query= "UPDATE posicion set nombre = '$this->nombre', salario = $this->salario, id_superior = $this->id_superior where id=$this->id";
						//(select id_superior from posiciones where nombre = '$this->nombre')";

				mysql_query($query);
			}

			else{
				$query = "INSERT INTO posicion(nombre, salario, id_superior)values('$this->nombre', '$this->salario', $this->id_superior)";
						// (SELECT id from posiciones where nombre = '$this->superior'))";

				mysql_query($query);
			}
		}

		function mostrar_posiciones(){
			$query = "SELECT * from posicion order by id asc";			

			return 	$rs = mysql_query($query);	
		}

		function eliminar_posicion(){
			$query = "DELETE from posicion where id = $this->id";

			mysql_query($query) or die(mysql_error());
		} 

		function cargar_posicion(){
			$query = "SELECT * from posicion where id = $this->id";

			return $rs = mysql_query($query);
		}
	}
 ?>