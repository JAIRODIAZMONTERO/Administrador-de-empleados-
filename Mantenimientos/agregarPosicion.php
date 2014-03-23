<h2>Posiciones - Nueva</h2>
<div id="div_agregar_posicion">
	<h3>Completa estos datos</h3>
	<hr />
	<form method="post" action="javascript: void(0);" class="form_posiciones" onsubmit="return validar_posicion();">
		<table>
			<tr>
				<td><label for="nombre">Nombre de la posici&oacute;n:</label></td>
				<td><input type="text" name="nombre" id="nombre"></td>
			</tr>			
			<tr>
				<td><label for="nombre">Salario:</label></td>
				<td><input type="text" name="salario" id="salario"></td>				
			</tr>
			<tr>			
				<td><label for="superior">Posici&oacute;n superior:</label></td>
				<td>
					<select name="superior" id="lista_posicion1" id="posicion">
						<option value="0">Seleccione una opci&oacute;n</option>
					</select>
				</td>
			</tr>
		</table>
		<button type="submit" class="btn">Guardar</button>
	</form>
</div>
<script type="text/javascript" src="Scripts/posiciones.js"></script>