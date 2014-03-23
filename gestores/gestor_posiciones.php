<?php 

	include("../Libreria/engine.php");

	$posicion = new posicion();

	if(isset($_POST['tarea'])){

		switch($_POST['tarea']){

			case "modificar_posicion": modificar_posicion();
			break;

			case "eliminar_posicion": eliminar_posicion();
			break;

			case "listar_posiciones": listar_posiciones();
			break;

			case "llenar_select": llenar_select();
			break;

			case "cargar_posicion": cargar_posicion();
			break;
		}
	}

	elseif(!isset($_POST['tarea'])){
		guardar_posicion();
	}


	function listar_posiciones(){

		global $posicion;

		$posiciones = $posicion->mostrar_posiciones();

		if(mysql_num_rows($posiciones)){

			while($fila = mysql_fetch_array($posiciones)){
				echo "
						<tr>
							<td>{$fila['id']}</td>
							<td>{$fila['nombre']}</td>
							<td name='id' class='tdSuperior'>{$fila['id_superior']}</td>
							<td class='tdSalario'>{$fila['salario']}</td>						
							<td class='tdAccion'>
								<button type='button' class='btnm' value='{$fila['id']}' onclick='modificar_posicion(this);' title='Modificar este empleado'>Modificar</button> |
								<button type='button' class='btn' value='{$fila['id']}' onclick='eliminar_posicion(this);' title='Eliminar este empleado'>Eliminar</button>
							</td>
						</tr>
					";
			}
		}

		else{
				echo "<h3 align='center'>No existen registros para mostrar</h3>";
		}
	}

	function llenar_select(){

		global $posicion;

		$posiciones = $posicion->mostrar_posiciones();

		while($fila = mysql_fetch_array($posiciones)){
			echo "
					<option value='{$fila['id']}'>{$fila['nombre']}</option>
				";
		}
	}

	function guardar_posicion(){

		global $posicion;

		$posicion->id = mysql_real_escape_string($_POST['id']);
		$posicion->nombre = mysql_real_escape_string($_POST['nombre']);
		$posicion->salario = mysql_real_escape_string($_POST['salario']);
		$posicion->id_superior = mysql_real_escape_string($_POST['superior']);
		$posicion->guardar() or die("0");
	}

	function eliminar_posicion(){

		global $posicion;

		$posicion->id = $_POST['id'];

		$posicion->eliminar_posicion();
	}

	function cargar_posicion(){

		global $posicion;

		$posicion->id = $_POST['id'];

		$posiciones = mysql_fetch_array($posicion->cargar_posicion());		

		echo json_encode(array("id"=>$posiciones['id'], "salario"=>$posiciones['salario'], "nombre"=>$posiciones['nombre'], "superior"=>$posiciones['id_superior']));

	}
 ?>