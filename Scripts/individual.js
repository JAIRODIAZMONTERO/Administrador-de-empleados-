$(document).ready(function(){
	$("#mainmn").remove();
	$("#titulo").css("border-bottom", "10px solid rgb(20, 30, 40)");
});

setTimeout(mostrar_datos,500);

function mostrar_datos(){

	$.ajax({
		url: "./gestores/gestor_individual.php",
		type:"post",
		data:{tarea: "mostrar_datos_personales", id: $("#id").val()},
		success: function(datos){
			$("#emp_datos").append(datos);
		}
	});

	$.ajax({
		url: "./gestores/gestor_individual.php",
		type:"post",
		data:{tarea: "mostrar_nomina", id: $("#id").val()},
		success: function(datos){
			$("#tbl_datos_nomina").append(datos);
		}
	});
}

$("#btn_cambiar").click(function(){
	$("#emp_overlay").fadeIn(1000);
	$("#div_clave").fadeIn(1000);
});

$("#emp_overlay").click(function(){
	$(this).fadeOut(1000);
	$("#div_clave").fadeOut(1000);
});

$(function(){
	$("#form_clave").submit(function(){

		$.ajax({
			url: "./gestores/gestor_individual.php",
			type:"post",
			data:$(this).serialize(),
			success: function(respuesta){
				if(respuesta>0){
					alert("La clave actual no es correcta");
				}

				else{
					alert("Clave camabiada con exito");
					$("#form_clave").delay(1000).fadeOut(1000);
					$("#div_clave").fadeOut(1000);
					$("#emp_overlay").fadeOut(1000);
				}
			}			
		});


	});
});
