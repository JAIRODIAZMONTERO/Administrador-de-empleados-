<?php 

	include_once("../Libreria/engine.php");

	$empleado = new empleado();

	//Examinar para que es la solicitud...

	if(isset($_POST)){

		switch($_POST['tarea']){

			case "listar_empleados": listar_empleados();
			break;

			case "eliminar_empleado": eliminar_empleado();
			break;

			case "subir_foto": subir_foto();
			break;

			case "cargar_empleado": cargar_empleado();
			break;

			case "cambiar_foto": cambiar_foto();
			break;

			case "modificar_empleado": modificar_empleado();
			break;

			default: guardar_empleado();
			break;
		}		
	}

	function listar_empleados(){	

		global $empleado;

		$empleados = $empleado->mostrar_empleados();

		if(mysql_num_rows($empleados)>0){

		 	while($row = mysql_fetch_array($empleados)){
			
				echo"
						<br/><br/><br/>
						<div id='divCodigo'><label>C&oacute;digo:</label><label><strong>{$row['id']}</strong></label></div>
						<div id='divTblEmpleados'>
							<table id='tblempleados' border='1'>
								<tr>								
									<td rowspan='5' id='colfoto'><img src='{$row['foto']}' alt='Foto' class='foto' title='Click para cambiar foto de empleado' id='{$row['id']}' onclick='mostrar_panel_foto(this);'></td>
									<td><label><strong>Sexo:</strong></label></td>
									<td>{$row['sexo']}</td>
									<td><label><strong>Fecha nacimiento:</strong></label></td>
									<td>{$row['fecha_nacimiento']}</td>
								</tr>
								<tr>
									<td><label><strong>C&eacute;dula:</strong></label></td>
									<td>{$row['cedula']}</td>
									<td><label><strong>Email:</strong></label></td>
									<td>{$row['email']}</td>
								</tr>
								<tr>
									<td><label><strong>Tel&eacute;fono:</strong></label></td>
									<td>{$row['telefono']}</td>
									<td><label><strong>Salario:</strong></label></td>
									<td>{$row['salario']}</td>
								</tr>

								<tr>
									<td><label><strong>Direcci&oacute;n:</strong></label></td>
									<td>{$row['direccion']}</td>
									<td><label><strong>Estado:</strong></label></td>
									<td>{$row['estado']}</td>
								</tr>

								<tr></tr>

								<tr>
									<td>{$row['nombre']} {$row['apellido']}</td>
								</tr>

								<tr>
									<td><strong>{$row['posicion']}</strong></td>
									<td colspan='4'>
										<button type='button' class='btnMod' value='{$row['id']}' title='Modificar este empleado' onclick='modificar_empleado(this);'>Modificar</button>
										<button type='button' class='btnEl' value='{$row['id']}' title='Eliminar este empleado' onclick='eliminar_empleado(this);'>Eliminar</button>									
									</td>								
								</tr>
							</table>
						<div class='divEdicion'>
							<label><label>
							
						</div>
						</div>
				";
			}
		}
		else{
			echo "<h3 align='center'>No existen empleados para mostrar<h3>";
		}
	}

function guardar_empleado(){

	global $empleado;
	
	$empleado->nombre 			= mysql_real_escape_string($_POST['nombre']);
	$empleado->apellido 		= mysql_real_escape_string($_POST['apellido']);
	$empleado->sexo 			= mysql_real_escape_string($_POST['sexo']);
	$empleado->fecha_nacimiento = mysql_real_escape_string($_POST['fecha_nacimiento']);
	sleep(1);
	$empleado->foto 			= get_ruta();
	$empleado->telefono 		= mysql_real_escape_string($_POST['telefono']);
	$empleado->direccion 		= mysql_real_escape_string($_POST['direccion']);
	$empleado->posicion 		= mysql_real_escape_string($_POST['posicion']);
	$empleado->password 		= mysql_real_escape_string($_POST['password']);
	$empleado->email 			= mysql_real_escape_string($_POST['email']);
	$empleado->estado 			= mysql_real_escape_string($_POST['estado']);
	$empleado->cedula 			= mysql_real_escape_string($_POST['cedula']);
	$empleado->simbolo_zodiaco  = calcular_simbolo_zodiaco($empleado->fecha_nacimiento);

	$empleado->guardar_empleado() or die("Ha ocurrido un error. Datos NO guardados.");
 }

	function subir_foto(){
		
		$foto 	= $_FILES['foto']['name'];
		$ruta1	= "../fotos_empleados/".time()."_".$foto;
		$ruta2	= "fotos_empleados/".time()."_".$foto;
		$temp 	= $_FILES['foto']['tmp_name'];
		$movido = move_uploaded_file($temp, $ruta1);
		sleep(1);
		
		if($movido){
			
			$datos = json_encode($ruta2);
			file_put_contents("../configuracion/images.path", $datos);
			echo 0;
			exit();
		}

		else{
			echo 1;
			exit();
		}
	}

	function get_ruta(){
		$archivo = file_get_contents("../configuracion/images.path");
		$datos = json_decode($archivo);

		return $datos;
	}

	function cargar_empleado(){

		global $empleado;

		$empleado->id = $_POST['id'];

		$empleado_cargado = mysql_fetch_array($empleado->cargar_empleado());

		echo json_encode(array("id"				 =>$empleado_cargado['id'], 
							   "nombre"			 =>$empleado_cargado['nombre'],
							   "apellido"        =>$empleado_cargado['apellido'],
							   "fecha_nacimiento"=>$empleado_cargado['fecha_nacimiento'],
							   "cedula"          =>$empleado_cargado['cedula'],
							   "sexo"            =>$empleado_cargado['sexo'],
							   "telefono"        =>$empleado_cargado['telefono'],
							   "direccion"       =>$empleado_cargado['direccion'],
							   "email"           =>$empleado_cargado['email'],
							   "salario"         =>$empleado_cargado['salario'],
							   "estado"          =>$empleado_cargado['estado'],
							   "posicion"        =>$empleado_cargado['posicion']
							   ));

	}

	function eliminar_empleado(){

		global $empleado;

		$empleado->id = $_POST['id'];

		$empleado->eliminar_empleado();
	}

	function cambiar_foto(){

		global $empleado;

		$empleado->foto = get_ruta();
		$empleado->id = $_POST['id'];

		sleep(1);

		$empleado->cambiar_foto();
	}

	function modificar_empleado(){

		global $empleado;

		$empleado->id 			    = mysql_real_escape_string($_POST['id']);
		$empleado->nombre 			= mysql_real_escape_string($_POST['nombre']);
		$empleado->apellido 		= mysql_real_escape_string($_POST['apellido']);
		$empleado->sexo 			= mysql_real_escape_string($_POST['sexo']);
		$empleado->fecha_nacimiento = mysql_real_escape_string($_POST['fecha_nacimiento']);
		$empleado->telefono 		= mysql_real_escape_string($_POST['telefono']);
		$empleado->direccion 		= mysql_real_escape_string($_POST['direccion']);
		$empleado->posicion 		= mysql_real_escape_string($_POST['posicion']);
		$empleado->password 		= mysql_real_escape_string($_POST['password']);
		$empleado->email 			= mysql_real_escape_string($_POST['email']);
		$empleado->estado 			= mysql_real_escape_string($_POST['estado']);
		$empleado->cedula 			= mysql_real_escape_string($_POST['cedula']);
		$empleado->simbolo_zodiaco  = calcular_simbolo_zodiaco($empleado->fecha_nacimiento);

		$empleado->guardar_empleado() or die(mysql_error());
	}

	function calcular_simbolo_zodiaco($fecha){

		$simbolo = "";
		$sub_fecha = explode("-", $fecha);
		$intvl_fecha = $sub_fecha[1]."-".$sub_fecha[2];

		if(($intvl_fecha>="03-21") && ($intvl_fecha<="04-19")) $simbolo = "Aries";
		if(($intvl_fecha>="09-23") && ($intvl_fecha<="10-22")) $simbolo = "Libra";
		if(($intvl_fecha>="04-20") && ($intvl_fecha<="05-20")) $simbolo = "Tauro";
		if(($intvl_fecha>="10-23") && ($intvl_fecha<="11-21")) $simbolo = "Escorpio";
		if(($intvl_fecha>="05-21") && ($intvl_fecha<="06-20")) $simbolo = "G&eacute;minis";
		if(($intvl_fecha>="11-22") && ($intvl_fecha<="12-21")) $simbolo = "Sagitario";
		if(($intvl_fecha>="06-21") && ($intvl_fecha<="07-22")) $simbolo = "Cancer";
		if(($intvl_fecha>="07-23") && ($intvl_fecha<="08-22")) $simbolo = "Leo";
		if(($intvl_fecha>="01-20") && ($intvl_fecha<="02-18")) $simbolo = "Acuario";
		if(($intvl_fecha>="08-23") && ($intvl_fecha<="09-22")) $simbolo = "Virgo";
		if(($intvl_fecha>="02-19") && ($intvl_fecha<="03-20")) $simbolo = "Piscis";
		if(!$simbolo) 										   $simbolo = "Capricornio";
		
		return $simbolo;
	}	
?>	