$(document).ready(function(){
	
	//Escondemos los submenus cuando el archivo se carga
	$('#mainmn li ul').hide();
	
	
	//Cuando el usuario se coloque encima de un elemento del menu
	$('#mainmn li').hover(
			//Funcion Hover
			function(){
				//Escondemos otros menus
				$('#mainmn li').not($('ul', this)).stop();
	
	
				// Mostramos el menú que corresponde
				$('ul', this).slideDown('fast');
			},
			//OnOut
			function(){
				// Hide Other Menus
				$('ul', this).slideUp('fast');
			}
	);

	//Cargamos el mantenimiento de empleados
	$("#empleados").click(function(evento){
		evento.preventDefault();
		$("#main").load("Mantenimientos/empleados.php");
	});

	//Cargamos el mantenimiento de posiciones
	$("#posiciones").click(function(evento){
		evento.preventDefault();

		$("#main").load("Mantenimientos/posiciones.php");
	});

	
	//Cargamos el organigrama
	$("#organigrama").click(function(evento){
		evento.preventDefault();

		$("#main").load("Reportes/organigrama.php");
	});


	//Cargamos la nomina
	$("#nomina").click(function(evento){
		evento.preventDefault();

		$("#main").load("Reportes/nomina.php");
	});

	//Cargamos el area social
	$("#social").click(function(evento){
		evento.preventDefault();

		$("#main").load("Reportes/social.php");
	});

	$("#reportes").click(function(evento){
		evento.preventDefault();
	});

	$("#salir").click(function(event){
		event.preventDefault();

		if(confirm("Realmente desea salir?")){
			$.ajax({
				url: "gestores/gestor_login.php",
				type: "post",
				data: {tarea: "cerrar_sesion"},
				success:function(respuesta){
					window.location = "./";
				}
			});
		}
	});	
});