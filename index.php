<html>
<head>
	<title>JP-Building C. x A. | Login</title>
	<link rel="stylesheet" type="text/css" href="Styles/plantilla.css">
</head>
<body>
	<div id="cinta"></div>
	<div id="div_login">
		<h2>Iniciar Sesi&oacute;n</h2>
	<form method="post" action="gestores/gestor_login.php">
		<br />
		<table>
			<tr>
				<td><label for="email">Email:</label></td>
				<td><input type="text" name="email"></td>
			</tr>
			<tr>
				<td><label for="clave">Clave:</label></td>
				<td><input type="password" name="clave"></td>
			</tr>
			<tr>
				<td colspan="2"><button type="submit">Login</button></td>
			</tr>
		</table>		
	</form>
	</div>
</body>
</html>