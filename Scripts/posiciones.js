$(document).ready(function(){

var valores = [
				{id: "1", value:"jairo"},
				{id: "2", value:"mario"},
				{id: "4",  value:"juan"},
				{id: "5", value:"pedro"}
			  ];

$("#autocomplete").autocomplete({
	source: valores,
	select: function(event, ui){
		alert("ID: "+ui.item.id+", nombre: "+ui.item.value);
	}
});	
	
	$.ajax({
		url: "./gestores/gestor_posiciones.php",
		type: "post",
		data:{tarea: "listar_posiciones"},
		success:function(posiciones){
			$("#tblPosiciones").append(posiciones);
		}
	});	
});	

$(function(){
	$("#btn_nueva_posicion").click(function(){
		$("#main").load("./mantenimientos/agregarPosicion.php");

		$.ajax({
			url: "./gestores/gestor_posiciones.php",
			type: "post",
			data:{tarea: "llenar_select"},
			success:function(posiciones){
				$("#lista_posicion1").append(posiciones);
				$("#lista_posicion").append(posiciones);				
			}
		});
	});
});

$(function(){
	$(".form_posiciones").submit(function(event){
		event.preventDefault();

		$.ajax({
			url:"./gestores/gestor_posiciones.php",
			type:"post",
			data: $(this).serialize(),
			success: function(respuesta){

				if(respuesta>0){
					alert("Error al guardar los datos");					
				}

				else{
					$("#main").load("./mantenimientos/posiciones.php");					
				}				
			}
		});
	});;
});

$(function(){
	$("#overlay").click(function(){
		$(this).fadeOut(1000);
		$("#div_modificar_posicion").fadeOut(1000);
	});
});

function modificar_posicion(btn){

	$.ajax({
		url:"./gestores/gestor_posiciones.php",
		type:"post",
		data:{tarea: "cargar_posicion", id: btn.value},
		success: function(datosJSON){				

			var datos = eval("("+datosJSON+")");

			$("#txtnombre").val(datos['nombre']);
			$("#txtsalario").val(datos['salario']);
			$("#txtcodigo").val(datos['id']);
			var posicion = datos['superior'];

			$.ajax({
				url: "./gestores/gestor_posiciones.php",
				type: "post",
				data:{tarea: "llenar_select"},
				success:function(posiciones){
					$("#lista_posicion").empty().append(posiciones);
					$("#lista_posicion> option[value="+posicion+"]").attr("selected", true);
				}
			});			
			
			$("#overlay").fadeIn(500);
			$("#div_modificar_posicion").fadeIn(500);
		}
	});
}


function eliminar_posicion(btn){
	if(confirm("Seguro desea borrar esta posicion de manera permanante")){
		$.ajax({
			url:"./gestores/gestor_posiciones.php",
			type:"post",
			data: {id: btn.value, tarea: "eliminar_posicion"},
			success: function(respuesta){
				if(respuesta){
					alert("No se puede borrar esta posicion. Verifique que no haya empleados ocupandola.");
				}
				$("#main").load("./mantenimientos/posiciones.php");
			}
		}); 
	}	
}

function validar_mod_posicion(){

}