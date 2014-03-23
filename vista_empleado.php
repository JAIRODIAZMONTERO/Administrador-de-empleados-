<?php 

	include_once("plantilla.php");

	if(!isset($_SESSION)){
		session_start();
	}

	if(isset($_SESSION['rol']) && $_SESSION['rol']!="Administrador"){

		if(isset($_SESSION['id']) && $_SESSION['id']>0){
		$id = $_SESSION['id'];
		}
	}

	else{
		header("Location: index.php");
		exit();
	}	
	
 ?>	 
 <div id="emp_overlay"></div>
 <div id="div_clave">
			<h3>Cambiar clave</h3>			
			<form method="post" action="javascript:void(0);" id="form_clave">
				<input type="hidden" value="<?php echo $id ?>" id="id_clave" name="id">	
				<table id="form_clave">
					<tr>
						<td><label for="actual">Actual:</label></td>
						<td><input type="password" name="actual"></td>
					</tr>
					<tr>
						<td><label for="nueva"></label>Nueva:</td>
						<td><input type="password" name="nueva"></td>
					</tr>
					<tr>
						<td><label for="repetir"></label>Confirmar:</td>
						<td><input type="password" name="repetir"></td>
					</tr>
					<tr>
						<td colspan="2" align="right"><button type="submit">Cambiar</button></td>
					</tr>
				</table>
			</form>
		</div>
	<div id="personales">
				
		<h2>Mis datos personales</h2>
		<button type="button" id="btn_cambiar">Cambiar clave</button>
		<div id="datos">
			<input type="hidden" value="<?php echo $id ?>" id="id">			
			<div id="emp_datos"></div>
			<div id="emp_info">
				<h4>N&oacute;mina</h4>
				<table id="tbl_datos_nomina">
					<thead>
						<th>Sueldo bruto</th>
						<th>AFP</th>
						<th>SFS</th>
						<th>ISR</th>
						<th>Sueldo neto</th>
					</thead>
					<tbody id="destino"></tbody>
				</table>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="Scripts/individual.js">
	</script>

