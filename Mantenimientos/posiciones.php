<h2>Posiciones</h2>
<div id="divPosiciones">
	<button type="button" id="btn_nueva_posicion" class="btn">Nueva</button>
	<hr />
	<table id="tblPosiciones">
		<thead>
			<th>ID</th>
			<th>Nombre</th>
			<th>Superior</th>
			<th>Salario</th>
			<th colspan="2"></th>			
		</thead>		
	</table>
</div>
<div id="overlay"></div>
<div id="div_modificar_posicion">
	<h2 id="titulo_modificar">Editar posici&oacute;n</h2>

	<form method="post" action="javascript: void(0);" class="form_posiciones" onsubmit="return validar_mod_posicion();">
		<input id="autocomplete" type="text" />
		<table>	
			<tr>
				<td>C&oacute;digo:</td>
				<td><input type="text" readonly="readonly" id="txtcodigo" name="id"></td>
			</tr>		
			<tr>
				<td><label for="nombre">Nombre de la posici&oacute;n:</label></td>
				<td><input type="text" name="nombre"id="txtnombre"></td>
			</tr>			
			<tr>
				<td><label for="nombre">Salario:</label></td>
				<td><input type="text" name="salario" id="txtsalario"></td>				
			</tr>
			<tr>			
				<td><label for="superior">Posici&oacute;n superior:</label></td>
				<td>
					<select name="superior" id="lista_posicion">
						<option value="0">Seleccione una opci&oacute;n</option>
					</select>
				</td>
			</tr>
		</table>
		<button type="submit" class="btn">Guardar</button>
	</form>
</div>
<script type="text/javascript" src="Scripts/posiciones.js">
</script>