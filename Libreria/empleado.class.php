<?php 

	include_once("engine.php");

	class empleado{
		
		var $id;
		var $nombre;		
		var $apellido;
		var $sexo;
		var $telefono;
		var $direccion;
		var $foto;
		var $email;
		var $password;
		var $cedula;
		var $fecha_nacimiento;
		var $estado;
		var $posicion;
		var $simbolo_zodiaco;

		function __construct($id=0){
			if($id>0){
				$this->id = $id;
			}
		}

		function guardar_empleado(){

			if($this->id > 0){

				$query = "UPDATE empleados SET nombre = '$this->nombre', 
											 apellido = '$this->apellido',
												 sexo = '$this->sexo',
											 telefono = '$this->telefono', 
											direccion = '$this->direccion',
												email = '$this->email', 
											   cedula = '$this->cedula',
									  simbolo_zodiaco = '$this->simbolo_zodiaco', 
									 fecha_nacimiento = '$this->fecha_nacimiento',
											   estado = '$this->estado',
										  id_posicion = '$this->posicion' where id = '$this->id'";

				mysql_query($query) or die(mysql_error());
			}

			else{
				$query = "INSERT INTO empleados (nombre, apellido, sexo, telefono, direccion, email,
						  password, cedula, foto, fecha_nacimiento, estado, id_posicion, simbolo_zodiaco) values('$this->nombre', '$this->apellido',
						 '$this->sexo','$this->telefono','$this->direccion','$this->email', sha('$this->password'),
						 '$this->cedula','$this->foto','$this->fecha_nacimiento','$this->estado', '$this->posicion', '$this->simbolo_zodiaco')";
				
				mysql_query($query) or die(mysql_error());
			}
		}

		function mostrar_empleados(){
			$query = "SELECT e.id, e.cedula, e.direccion, e.apellido, e.email, e.nombre, e.estado,
						e.foto, e.telefono, e.sexo, e.fecha_nacimiento, p.nombre as posicion,
					    p.salario from empleados e, posicion p where e.id_posicion = p.id order by e.id";
					    
			$rs = mysql_query($query) or die(mysql_error()); 

			return $rs; 			
		}

		function cargar_empleado(){
			$query = "SELECT e.id, e.cedula, e.direccion, e.apellido, e.email, e.nombre, e.estado,
					  e.telefono, e.sexo, e.fecha_nacimiento, e.id_posicion AS posicion, p.salario FROM
					  empleados e, posicion p WHERE e.id=$this->id AND e.`id_posicion` = p.id ORDER BY e.id";

			return $rs = mysql_query($query);
		}

		function eliminar_empleado(){
			$query = "DELETE from empleados where id = $this->id";

			mysql_query($query);
		}

		function cambiar_foto(){
			$query = "UPDATE empleados set foto = '$this->foto' where id='$this->id'";

			mysql_query($query);
		}
	}
 ?>