<div id="divEmpleados">
	<h2>Empleados</h2>
	<button type="button" class="btn" id="btnAg" value="agregar">Nuevo</button>
	<hr />
	<div id="listaEmpleados">		
	</div>
	<div id="overlay_empleados"></div>
	<div id="div_modificar_empleado">
		<h2>Editar empleado</h2>		
		<form enctype="multipart/form-data" id="form_editar_empleado" action="javascript: void(0);" >
			<td><input type="hidden" name="tarea" value="modificar_empleado"></td>
			<table id="tblModEmpleado">
				<tr>
					<td><label for="id">ID:</label></td>
					<td><input type="text" readonly="readonly" name="id" id="txtid"></td>
				</tr>
				<tr>
					<td>
						<label class="req">*</label><label for="nombre">Nombre:</label>
					</td>
					<td>
						<input type="text" name="nombre" id="txtnombre">
					</td>
					<td>
						<label class="req">*</label><label for="password">Password:</label>
					</td>
					<td>
						<input type="password" name="password" id="txtpassword">
					</td>
				</tr>		
				<tr>
					<td>
						<label class="req">*</label><label for="apellido">Apellido:</label>
					</td>
					<td>
						<input type="text" name="apellido" id="txtapellido">
					</td>
						<td>
						<label for="salario" id="salario">Salario:</label>
					</td>
					<td>
						<input type="text" name="salario" id="txtsalario" readonly="readonly">
					</td>
				</tr>		
				<tr>
					<td>
						<label class="req">*</label><label for="fecha">Nacimiento:</label>
					</td>
					<td>
						<input type="text" name="fecha_nacimiento" id="txtfecha"></label>
					</td>
					<td>
						<label class="req">*</label><label for="posicion">Posici&oacute;n:</label>
					</td>			
					<td>				
						<select id="posicion2" name="posicion" id="posicion2">
							<option value="0">Seleccione una opci&oacute;n</option>
						</select>
					</td>
				</tr>		
				<tr>
					<td>
						<label class="req">*</label><label for="cedula">C&eacute;dula:</label>
					</td>
					<td>
						<input type="text" name="cedula" id="txtcedula">
					</td>
					<td><label class="req">*</label><label id="estado">Estado:</label></td>
					<td>
						<input type="radio" name="estado" value="Activo" class="radio" id="rdA"><label>Activo</label>
						<input type="radio" name="estado" value="Inactivo" class="radio" id="rdI"><label>Inactivo</label>			
					</td>
				</tr>
				<tr>
					<td>
						<label class="req">*</label><label for="sexo">Sexo:</label>
					</td>
					<td>
						<input type="radio" name="sexo" value="M" class="radio" id="rdM"><label>Masculino</label>
						<input type="radio" name="sexo" value="F" class="radio" id="rdF"><label>Femenino</label>
					</td>							
				</tr>
					
				<tr>
					<td>
						<label class="req">*</label><label for="telefono">Tel&eacute;fono:</label>
					</td>
					<td>
						<input type="text" name="telefono" id="txttelefono">
					</td>					
				</tr>
				<tr>
					<td>
						<label class="req">*</label><label for="direccion">Direcci&oacute;n:</label>
					</td>
					<td  colspan="3">
						<input type="text" name="direccion" id="txtdireccion">
					</td>
				</tr>	
				<tr>		
					<td>
						<label class="req">*</label><label for="email">Email:</label>
					</td>
					<td colspan="3">
						<input type="email" name="email" id="txtemail">
					</td>
				</tr> 		
			</table>
			<button type="submit" class="btn" id="btnGuardar" name="btnGuardar">Guardar</button>
		</form>
	</div>
</div>
<div id="overlay_foto"></div>
<div id="div_cambiar_foto">
	<h2>Cambiar foto</h2>
	<form action="javascript:void(0);" id="form_cambiar_foto">
		<input type="file" id="nueva_foto" name="foto">
		<input type="hidden" value="5000000" name="MAX_FILE_SIZE">
		<hr />
		<button type="submit" id="btnCambiarFoto" onclick="cambiar_foto();">Cambiar</button>
		<progress value="0" id="barra_progreso" max="100"><progress>
	</form>
</div>
<script type="text/javascript" src="Scripts/empleados.js"></script>
<script type="text/javascript" src="Scripts/upload.js"></script>
<script type="text/javascript">
	$("#barra_progreso").progressbar();
</script>