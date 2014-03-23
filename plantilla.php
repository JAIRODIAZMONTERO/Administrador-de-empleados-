<?php 

	$plantilla = new plantilla();

	class plantilla{

		function __construct(){
?>
			<!doctype hmtl>
			<html>
			<head>
				<meta charset = "utf-8">
				<title>JP-Building C. x A.</title>
				<link rel="stylesheet" type="text/css" href="Styles/plantilla.css">
				<link href="Styles/css/dark-hive/jquery-ui-1.10.3.custom.css" rel="stylesheet">
				<script src="Scripts/js/jquery-1.9.1.js"></script>
				<script src="Scripts/js/jquery-ui-1.10.3.custom.js"></script>
				<script type="text/javascript" src="Scripts/plantilla.js"></script>
			</head>
			<div>
			<header>
				<a href="#" id="salir">Cerrar sesi&oacute;n</a>
				<div id="titulo">
					<img src="App_Imagenes/imagen5.png" id="logo" onclick='window.location=""'>
					<img src="App_Imagenes/ingenieros1.jpg" id="foto">
				</div>				
				<ul id="mainmn"><div id="mnui">
					<li><a onclick='window.location=""' class="mni" id="home">Home</a></li>
					<li><a href="#" class="mni" id="empleados">Empleados</a></li>
					<li><a href="#" class="mni" id="posiciones">Posiciones</a></li>
					<li><a href="#" class="mni" id="reportes">Reportes</a>
						<ul class="sbmenu">
							<li><a href="#" id="organigrama">Organigrama</a></li>
							<li><a href="#" id="nomina">N&oacute;mina</a></li>
							<li><a href="#" id="social">Social</a></li>	
						</ul>
					</li></div>
				</ul>									
			</header>
			<body>

<?php 
		}


		function __destruct(){
?>
			</body>
			<footer>
				<p>Instituto Tecnol&oacute;gico de Las Am&eacute;ricas (ITLA) - Todos los derechos reservados 2013. 
				Centro de excelencia en Desarrollo de Software. <br /> Application developed by  <strong>Jairo Diaz</strong> 
				and <strong>Pamela Smith</strong> as a project for Web Programming</p>
			</footer>
			</div>			
			</html>
<?php
		}
	}
 ?>