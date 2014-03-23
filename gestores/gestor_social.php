<?php 

	include_once("../Libreria/engine.php");

	if(isset($_POST)){

		$consultas = array();

		if(isset($_POST['tarea'])){
			mostrar_todos();
		}

		else{

			$eliminar_tabla = "DROP TABLE IF EXISTS tmp_empleados";
			mysql_query($eliminar_tabla);

			$consultas[0] = $eliminar_tabla;

			$crear_tabla = "CREATE TEMPORARY TABLE tmp_empleados AS SELECT p.id as id_posicion, e.nombre, e.sexo,
								  e.fecha_nacimiento, laempresa.`fn.Calcular_edad`(e.fecha_nacimiento)
								  AS edad, e.simbolo_zodiaco AS zodiaco,(SELECT p.nombre FROM posicion p WHERE 
								  e.id_posicion = p.id) AS posicion, e.estado FROM empleados e, posicion
								  p WHERE e.id_posicion = p.id ORDER BY e.nombre;";

			mysql_query($crear_tabla);

			$consultas[1] = $crear_tabla;

			$parametros = array();

			if(!empty($_POST['nombre']))									$parametros[] = "nombre";
			if(!empty($_POST['edad']))										$parametros[] = "edad";
			if(!empty($_POST['sexo']) && $_POST['sexo']!="0")				$parametros[] = "sexo";		
			if(!empty($_POST['zodiaco']) && $_POST['zodiaco'] !="0")		$parametros[] = "zodiaco";
			if(!empty($_POST['id_posicion']) && $_POST['id_posicion']!="0")	$parametros[] = "id_posicion";
			if(!empty($_POST['estado']) && $_POST['estado']!="0")			$parametros[] = "estado";

			$query = "SELECT nombre, sexo, edad, zodiaco, posicion, estado from tmp_empleados where ";

			if(count($parametros)==1){
				$query .="$parametros[0] LIKE '{$_POST[$parametros[0]]}' ";
			}

			elseif(count($parametros)>1){

				$query .= "$parametros[0] LIKE '{$_POST[$parametros[0]]}' ";

				for($x=1;$x<count($parametros);$x++){

					$query .= "AND $parametros[$x] LIKE '{$_POST[$parametros[$x]]}' ";
				}
			}

			elseif(count($parametros)==0){
				mostrar_todos();
			}

			$query .=" ORDER BY nombre";
			$consultas[2] = $query;			

			$rs = mysql_query($query) or die(mysql_error());

			if(mysql_num_rows($rs)>0){
				while($fila=mysql_fetch_array($rs)){
					echo "
							<tr>
								<td>{$fila['nombre']}</td>
								<td>{$fila['sexo']}</td>
								<td>{$fila['edad']}</td>
								<td>{$fila['zodiaco']}</td>
								<td>{$fila['posicion']}</td>
								<td>{$fila['estado']}</td>
							</tr>
					";
				}
			}

			else{
				echo "0";
			}

			$datos = json_encode($consultas);
			file_put_contents("../Reportes/query.tmp.json", $datos);
		}
	}

	function mostrar_todos(){

		$eliminar_tabla = "DROP TABLE IF EXISTS tmp_empleados";
		mysql_query($eliminar_tabla);		

		$crear_tabla = "CREATE TEMPORARY TABLE tmp_empleados AS SELECT e.nombre, e.sexo,
							  e.fecha_nacimiento, laempresa.`fn.Calcular_edad`(e.fecha_nacimiento)
							  AS edad, e.simbolo_zodiaco AS zodiaco,(SELECT p.nombre FROM posicion p WHERE 
							  e.id_posicion = p.id) AS posicion, e.estado FROM empleados e, posicion
							  p WHERE e.id_posicion = p.id;";

		mysql_query($crear_tabla);		

		$query = "SELECT * FROM tmp_empleados";

		$consultas[0] = $eliminar_tabla;
		$consultas[1] = $crear_tabla;
		$consultas[2] = $query;
		$datos = json_encode($consultas);
		file_put_contents("../Reportes/query.tmp.json", $datos);

		$rs = mysql_query($query);

		if(mysql_num_rows($rs)>0){
			while($fila=mysql_fetch_array($rs)){
				echo "
						<tr>
							<td>{$fila['nombre']}</td>
							<td>{$fila['sexo']}</td>
							<td>{$fila['edad']}</td>
							<td>{$fila['zodiaco']}</td>
							<td>{$fila['posicion']}</td>
							<td>{$fila['estado']}</td>
						</tr>
				";
			}
		}

		else{
			echo "<h4 align='center'>No hay resultados para mostrar</h4>";
		}		
	}
 ?>