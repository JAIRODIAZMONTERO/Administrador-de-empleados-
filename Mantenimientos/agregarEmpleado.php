<h2>Empleados - Nuevo</h2>
<h3>Complete estos datos</h3>
<hr />
<form enctype="multipart/form-data" id="formEmpleados" action="javascript: void(0);" onsubmit="validar_empleado();">
	<input type="hidden" name="id">
	<table id="tblNuevoEmpleado" >
		<tr>
			<td>
				<label class="req">*</label><label for="nombre">Nombre:</label>
			</td>
			<td>
				<input type="text" name="nombre" id="nombre">
			</td>
			<td>
				<label class="req">*</label><label for="password">Password:</label>
			</td>
			<td>
				<input type="password" name="password" id="password">
			</td>
		</tr>		
		<tr>
			<td>
				<label class="req">*</label><label for="apellido">Apellido:</label>
			</td>
			<td>
				<input type="text" name="apellido" id="apellido">
			</td>
				<td style="text-align: right">
				<label for="salario" id="">Salario:</label>
			</td>
			<td>
				<input type="text" name="salario" id="salario">
			</td>
		</tr>		
		<tr>
			<td>
				<label class="req">*</label><label for="fecha">Nacimiento:</label>
			</td>
			<td>
				<input type="text" name="fecha_nacimiento" id="fecha"></label>
			</td>
			<td>
				<label class="req">*</label><label for="posicion">Posici&oacute;n:</label>
			</td>			
			<td>				
				<select id="posicion" name="posicion" id="posicion">
					<option value="0">Seleccione una opci&oacute;n</option>
				</select>
			</td>
		</tr>		
		<tr>
			<td>
				<label class="req">*</label><label for="cedula">C&eacute;dula:</label>
			</td>
			<td>
				<input type="text" name="cedula" id="cadula">
			</td>
			<td><label class="req">*</label><label id="estado">Estado:</label></td>
			<td>
				<input type="radio" name="estado" value="Activo" class="radio" id="estadoA"><label>Activo</label>
				<input type="radio" name="estado" value="Inactivo" class="radio" id="estadoI"><label>Inactivo</label>			
			</td>
		</tr>
		<tr>
			<td>
				<label class="req">*</label><label for="sexo">Sexo:</label>
			</td>
			<td>
				<input type="radio" name="sexo" value="M" class="radio" id="sexoM"><label>Masculino</label>
				<input type="radio" name="sexo" value="F" class="radio" id="sexoF"><label>Femenino</label>
			</td>			
		</tr>
			<td>
				<label for="foto" id="ft">Foto:</label>
			</td>
			<td>
				<input type="file" name="foto" id="ffoto"><!-- <button type="button" id="btnfoto">Examinar...</button> -->
				<input type="hidden" name="MAX_FILE_SIZE" value="50000000">
			</td>	
		</tr>				
		<tr>
			<td>
				<label class="req">*</label><label for="telefono">Tel&eacute;fono:</label>
			</td>
			<td>
				<input type="text" name="telefono" id="telefono">
			</td>
			
		</tr>
		<tr>
			<td>
				<label class="req">*</label><label for="direccion">Direcci&oacute;n:</label>
			</td>
			<td  colspan="3">
				<input type="text" name="direccion" id="direccion" id="direccion">
			</td>
		</tr>	
		<tr>		
			<td>
				<label class="req">*</label><label for="email">Email:</label>
			</td>
			<td colspan="3">
				<input type="email" name="email" id="email">
			</td>
		</tr> 		
	</table>
	<button type="submit" class="btn" id="btnGuardar" name="btnGuardar">Guardar</button>
</form>
<script type="text/javascript" src="Scripts/empleados.js"></script>
<script type="text/javascript" src="Scripts/upload.js"></script>