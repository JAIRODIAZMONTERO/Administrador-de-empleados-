<?php 

	include_once("../Libreria/engine.php");

	$query = "SELECT e.id, e.nombre, e.apellido, e.cedula, p.salario AS 'Sueldo bruto', (p.salario*0.0272) AS AFP,
				(p.salario* 0.0301) AS SFS,(SELECT laempresa.`fn.Calcular_ISR`(p.salario)) AS 
				ISR, (p.salario -(p.salario*0.0272 + p.salario*0.0301)) AS 'Sueldo neto' FROM 
				empleados e, posicion p WHERE e.id_posicion = p.id";

	$rs = mysql_query($query);

	if(mysql_num_rows($rs)>0){

		while($fila = mysql_fetch_array($rs)){

			echo "
					<tr>
						<td>{$fila['id']}</td>
						<td>{$fila['nombre']}</td>
						<td>{$fila['apellido']}</td>
						<td>{$fila['cedula']}</td>
						<td class='dinero'>{$fila['Sueldo bruto']}</td>
						<td class='dinero'>{$fila['AFP']}</td>
						<td class='dinero'>{$fila['SFS']}</td>
						<td class='dinero'>{$fila['ISR']}</td>
						<td class='dinero'>{$fila['Sueldo neto']}</td>
					</tr>
			";
		}
	}
	else{
		echo "<h3>No existen empleados en la n&oacute;mina</h3>";
	}

	
 ?>