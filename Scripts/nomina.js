$(document).ready(function(){
	$.ajax({
		url: "./gestores/gestor_nomina.php",
		type: "get",
		success:function(datos){
			$("#destino").empty().append(datos);
		}
	});

	$(function(){
		$("#btnpdf").click(function(){
			$.ajax({
				url: "./Reportes/generar_nomina.php",
				type: "post",
				success:function(respuesta){
					alert(respuesta);
				}
			});
		});
	});

	$("#btn_generar_pdf").click(function(){
		//alert($("#div_nomina").html());

		$.ajax({
				url: "./Reportes/generar_nomina.php",
				type: "post",
				data: {html: $("#div_nomina").html()},
				success:function(respuesta){
					var pdf = new jsPDF();
      				pdf.text(20, 20, respuesta);
     				pdf.output('datauri');
				}
			});

	});
});