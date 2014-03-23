<?php 

	include_once("../Libreria/engine.php");

	if(!isset($_SESSION)){
		session_start();
	}

	if(isset($_POST['tarea'])){
		
		switch($_POST['tarea']){

			case "mostrar_datos_personales": mostrar_datos_personales();
			break;

			case "mostrar_nomina": mostrar_nomina();
			break;
		}
	}

	else{
		cambiar_clave();
	}

	function mostrar_datos_personales(){

		if(isset($_SESSION['id']) && $_SESSION['id']>0){

			$id = mysql_real_escape_string($_SESSION['id']);

			$query = "SELECT e.id, e.foto,e.cedula, e.direccion, e.apellido, e.email, e.nombre, e.estado,
						  e.telefono, e.sexo, e.fecha_nacimiento, p.nombre AS posicion, p.salario FROM
						  empleados e, posicion p WHERE e.id_posicion= p.id and e.id = $id";

			$rs = mysql_query($query);

			$fila=mysql_fetch_array($rs);
				echo "<img id='foto_personal' src='{$fila['foto']}'>
						<h4>Informaci&oacute;n personal</h4>
						<table id='tbl_emp'>
							<thead>
								<th>Nombre</th>
								<th>Apellido</th>
								<th><label>Sexo</th>
								<th><label>Direcci&oacute;n</th>
								<th>Telefono</th>
								<th>Fecha nac.</th>
								<th><label>C&eacute;dula</th>
								<th>Email</th>
								<th>Posici&oacute;n</th>
								<th>Salario</th>
								<th>Estado</th>
							</thead>
							<tbody>
								<tr>							
									<td>{$fila['nombre']}</td>							
									<td>{$fila['apellido']}</td>							
									<td>{$fila['sexo']}</td>							
									<td>{$fila['direccion']}</td>							
									<td>{$fila['telefono']}</td>							
									<td>{$fila['fecha_nacimiento']}</td>							
									<td>{$fila['cedula']}</td>							
									<td>{$fila['email']}</td>							
									<td>{$fila['posicion']}</td>							
									<td>{$fila['salario']}</td>														
									<td>{$fila['estado']}</td>							
								</tr>
							</tbody>
						</table>
				";
			
		}
	}

	function mostrar_nomina(){

		if(isset($_SESSION['id']) and $_SESSION['id']>0){
			$id = mysql_real_escape_string($_SESSION['id']);

			$query = "SELECT e.id, e.nombre, e.apellido, e.cedula, p.salario AS 'Sueldo bruto', (p.salario*0.0272) AS AFP,
					(p.salario* 0.0301) AS SFS,(SELECT laempresa.`fn.Calcular_ISR`(p.salario)) AS 
					ISR, (p.salario -(p.salario*0.0272 + p.salario*0.0301)) AS 'Sueldo neto' FROM 
					empleados e, posicion p WHERE e.id_posicion = p.id and e.id = $id";

			$rs = mysql_query($query);

			while($fila = mysql_fetch_array($rs)){

				echo "
						<tr>
							<td class='dinero'>{$fila['Sueldo bruto']}</td>
							<td class='dinero'>{$fila['AFP']}</td>
							<td class='dinero'>{$fila['SFS']}</td>
							<td class='dinero'>{$fila['ISR']}</td>
							<td class='dinero'>{$fila['Sueldo neto']}</td>
						</tr>
				";
			}
		}		
	}	

	function cambiar_clave(){
		$actual = mysql_real_escape_string($_POST['actual']);
		$nueva = mysql_real_escape_string($_POST['nueva']);
		$id = $_SESSION['id'];
		$query = "SELECT password from empleados where password = sha('$actual') and id = $id";

		$rs = mysql_query($query);

		if(mysql_num_rows($rs)>0){
			$query = "UPDATE empleados set password = sha('$nueva') where id = $id";

			mysql_query($query);

			echo "0";
		}

		else{
			echo "1";
		}
	}
 ?>