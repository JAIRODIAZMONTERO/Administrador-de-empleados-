<h2>Social</h2>

	<a href="Reportes/generar_social.php" target="_blank"><button  class="btn_pdf" id="pdf" title="Generar documento en formato PDF">Exportar PDF</button></a>
	
<div id="div_filtros">	
	<h4>Filtros:</h4>
	<form action="javascript:void(0);" id="form_filtro" method="post">
		<input type="text" name="nombre" placeholder="Nombre">
		<input type="number" placeholder="Edad" min="16" max="100" name="edad">		
		<select name="sexo">
			<option value="0">Sexo</option>
			<option value="M">Masculino</option>
			<option value="F">Femenino</option>
		</select>
		<select name="zodiaco">
			<option value="0">S&iacute;mbolo Zod&iacute;aco</option>
			<option value="acuario">Acuario</option>
			<option value="piscis">Piscis</option>
			<option value="aries">Aries</option>
			<option value="tauro">Tauro</option>
			<option value="geminis">G&eacute;minis</option>
			<option value="cancer">C&aacute;ncer</option>
			<option value="leo">Leo</option>
			<option value="virgo">Virgo</option>
			<option value="libra">Libra</option>
			<option value="escorpio">Escorpio</option>
			<option value="sagitario">Sagitario</option>
			<option value="capricornio">Capricornio</option>
		</select>
		<select id="lista_posicion3" name="id_posicion">
			<option value="0">Posici&oacute;n</option>
		</select>
		<select name="estado">
			<option value="0">Estado</option>
			<option value="activo">Activo</option>
			<option value="inactivo">Inactivo</option>
		</select><br />	
		<button type="button" id="btn_todos">Ver todos</button>		
		<button type="submit">Filtrar</button>
	</form>
</div>
<div id="div_tbl_social">
	<table id="tbl_social" class="tbl_reportes">
		<thead>
			<th>Nombre</th>
			<th>Sexo</th>
			<th>Edad</th>
			<th>S. Zodiaco</th>
			<th>Posici&oacute;n</th>
			<th>Estado</th>		
		</thead>
		<tbody id="tbody_social"></tbody>
		<tfoot id="tfoot_social"></tfoot>
	</table>
</div>
<script type="text/javascript" src="Scripts/social.js">
</script>