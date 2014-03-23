$(document).ready(function(){
	$.ajax({
          url: "./gestores/gestor_posiciones.php",
          type: "post",
          data:{tarea: "llenar_select"},
          success:function(posiciones){
           		$("#lista_posicion3").append(posiciones);
		  }
	});

	mostrar_todos();

	$("#btn_todos").click(function(){
		mostrar_todos();
	});	
	
});


$("#form_filtro").submit(function(){

		$.ajax({
			url: "./gestores/gestor_social.php",
			type: "post",
			data: $(this).serialize(),
			success:function(datos){
				if(datos!=0){
					$("#tfoot_social").empty();
					$("#tbody_social").empty().append(datos);
				}

				else{
					$("#tbody_social").empty();
					$("#tfoot_social").empty();
					$("#tfoot_social").append("<td colspan='6'><h4 align='center'>No hay resultados para mostrar</h4></td>")
				}				
			}
		});
	});

function mostrar_todos(){
	$.ajax({
		url: "./gestores/gestor_social.php",
		type: "post",
		data: {tarea: "mostrar_todos"},
		success:function(datos){
			$("#tfoot_social").empty();
			$("#tbody_social").empty().append(datos);
		}
	});
};