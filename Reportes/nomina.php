<h2>N&oacute;mina</h2>
<a href="Reportes/generar_nomina.php" target="_blank"><button type="button" class="btn_pdf" id="">Exportar PDF</button></a>
<!-- <button type="button" id="btnxls">Exportar Excel</button> -->
<hr />
<div id="div_nomina">
	<table id="tbl_nomina" class="tbl_reportes">
		<thead>
			<th>ID</th>
			<th>Nombre</th>
			<th>Apellido</th>
			<th>C&eacute;dula</th>
			<th>Sueldo bruto</th>
			<th>AFP</th>
			<th>SFS</th>
			<th>ISR</th>
			<th>Sueldo neto</th>
		</thead>
		<tbody id="destino"></tbody>
		<tfoot>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</tfoot>
	</table>
	<hr />
</div>
<script type="text/javascript" src="Scripts/nomina.js"></script>
<script type="text/javascript" src="Libreria/jspdf/jspdf.js"></script>