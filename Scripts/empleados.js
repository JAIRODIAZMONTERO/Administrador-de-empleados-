
$(document).ready(function(){   

  	$("#btnAg").click(function(){
  		$("#divEmpleados").load("./Mantenimientos/agregarEmpleado.php");

      $.ajax({
          url: "./gestores/gestor_posiciones.php",
          type: "post",
          data:{tarea: "llenar_select"},
          success:function(posiciones){
            $("#posicion").append(posiciones);
            //$("#posicion2").append(posiciones);

            $("#posicion2").css("border", "2px solid blue");
          }
      });
     
  	}); 

     $("#fecha, #txtfecha").datepicker({
        inline:true,
        changeYear: true
    });

  $("#progreso").progressbar();

  $(":text, :password").css("width", "300px");


     $(function(){
       $.datepicker.regional['es'] = {
          closeText: 'Cerrar',
          prevText: '<Anterior',
          nextText: 'Siguiente>',
          currentText: 'Hoy',
          monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
          monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
          dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
          dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
          dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
          weekHeader: 'Sm',
          dateFormat: 'yy-mm-dd',
          firstDay: 1,
          isRTL: false,
          showMonthAfterYear: false,
          changeMonth: true, 
          yearRange: '-100:+0',
          yearSuffix: ''};
       $.datepicker.setDefaults($.datepicker.regional['es']);
  });
 
});

$(document).ready(function(){// listar empleados
    $.ajax({
      url: "./gestores/gestor_empleado.php",
      type: "post",
      data:{tarea: 'listar_empleados'},
      success: function(empleados){
        $("#listaEmpleados").empty().append(empleados);
      }
    });
 });

$(document).ready(function(){
    $("#btnfoto").click(function(event){
      event.preventDefault();
        $("#ffoto").trigger('click');
    });
});

window.guardado = false;

function subir_foto(){    

     $("#ffoto").upload('./gestores/gestor_empleado.php',

          {tarea: "subir_foto"},
           function(respuesta){
             if(respuesta==0){
                window.guardado = true;
              }
           }           
      );
} 

$(function(){
        $('#formEmpleados').submit(function(event){

         event.preventDefault();

         subir_foto();         

         alert(window.guardado);

             if(window.guardado){

                $.ajax({
                    type: 'POST',
                    url: './gestores/gestor_empleado.php',
                    data: $(this).serialize(),
                    success: function(respuesta){
                      if(!respuesta){
                          alert("Datos guardados con exito!");
                          $("#main").delay(1000).load("./Mantenimientos/empleados.php");
                      }
                      else{
                        alert(respuesta);
                      }                       
                    }
                });        
              }

              else{
                alert("Error al guardar los datos. Intente enviarlos otra vez.");
              }
        });
  });
 
$(function(){
    $("#overlay_empleados").click(function(){
      $(this).fadeOut(1000);
      $("#div_modificar_empleado").fadeOut(1000);
    });
});

 function modificar_empleado(btn){  

    $.ajax({
        url: './gestores/gestor_empleado.php',
        type: "post",
        data:{tarea: "cargar_empleado", id: btn.value},
        success:function(datosJSON){
          datos = eval("("+datosJSON+")");

          $("#txtid").val(datos['id']);
          $("#txtnombre").val(datos['nombre']);
          $("#txtapellido").val(datos['apellido']);
          $("#txtfecha").val(datos['fecha_nacimiento']);
          $("#txttelefono").val(datos['telefono']);
          $("#txtdireccion").val(datos['direccion']);
          $("#txtemail").val(datos['email']);
          $("#txtcedula").val(datos['cedula']);
          $("#txtsalario").val(datos['salario']);

          if(datos['estado']=="Activo"){
            $("#rdA").attr("checked", true);
          }

          else if(datos['estado']=="Inactivo"){
            $("#rdI").attr("checked", true);
          }

          if(datos['sexo']=="M"){
            $("#rdM").attr("checked", true);
          }

          else if(datos['sexo']=="F"){
            $("#rdF").attr("checked", true);
          }

          var posicion = datos['posicion'];

          $.ajax({
              url: "./gestores/gestor_posiciones.php",
              type: "post",
              data:{tarea: "llenar_select"},
              success:function(posiciones){
                 $("#posicion2").empty().append(posiciones);
                 $("#posicion2> option[value="+posicion+"]").attr("selected", true);
              }
          });   

          $("#overlay_empleados").fadeIn(500);
          $("#div_modificar_empleado").fadeIn(500);
        }
    });
 }

 function eliminar_empleado(btn){
    if(confirm("Realmente desea eliminar este empleado?")){
      $.ajax({
          url: './gestores/gestor_empleado.php',
          type: "post",
          data: {tarea: "eliminar_empleado", id: btn.value},

          success: function(){
            alert("Transaccion realizada con exito!");
          },

          fail:function(){
            alert("Error al tratar de eliminar el registro.");
          } 
      });

      $.ajax({
          url: "./gestores/gestor_empleado.php",
          type: "post",
          data:{tarea: 'listar_empleados'},
          success: function(empleados){
            $("#listaEmpleados").empty().append(empleados);
          }
       });
    }
 }

 function cambiar_foto(){

  $("#div_cambiar_foto form input").upload('./gestores/gestor_empleado.php',
        {tarea: "subir_foto"},

       function(respuesta){
          if(respuesta==0){
            $("#barra_progreso").fadeIn("fast");
            $("#barra_progreso").val(10);
                $.ajax({
                  url: './gestores/gestor_empleado.php',
                  type: "post",
                  data:{tarea: "cambiar_foto", id: foto_id},
                  beforeSend:  function(){$("#barra_progreso").val(20)},
                  success:function(respuesta){
                    if(respuesta==0){
                      $("#barra_progreso").val(100).fadeOut("fast");  
                    }

                    else{
                      alert("Error al intentar cambiar la foto");
                    }
                  }
                });
          }
          else{
            alert("Error al cambiar la foto");
          }
        }
      );    
 }

 function mostrar_panel_foto(foto){
    $("#overlay_foto").fadeIn(500);
    $("#div_cambiar_foto").fadeIn(500);

    $("#div_cambiar_foto> button").val(foto.id);

   foto_id = foto.id;//para guardar el id de la foto que sera modificada.
 }

 $(function(){
    $("#overlay_foto").click(function(){
      $(this).fadeOut(500);
      $("#div_cambiar_foto").fadeOut(500);
    });
});

 $(function(){
      $("#form_editar_empleado").submit(function(){
        $.ajax({
          url: './gestores/gestor_empleado.php',
          type: "post",
          data: $(this).serialize(),

          success:function(respuesta){
              if(respuesta>0){
                alert(respuesta);
              }

              else{
                alert("Datos guardados con exito!");
              }
          }
        });
      });
 });

 // function validar_empleado(){
 //    valido = false;

 //    nombre    = $.trim($("#nombre").val());
 //    apellido  = $.trim($("#apellido").val());
 //    sexoM     = $("#sexoM").val();
 //    sexoF     = $("#sexoF").val();
 //    fecha     = $.trim($("#fecha").val());
 //    cedula    = $.trim($("#cedula").val());
 //    foto      = $.trim($("#ffoto").val());
 //    telefono  = $.trim($("#telefono").val());
 //    direccion = $.trim($("#direccion").val());
 //    email     = $.trim($("#email").val());
 //    password  = $.trim($("#password").val());
 //    salario   = $.trim($("#salario").val());
 //    posicion  = $.trim($("#posicion").val());
 //    estadoI    = $.trim($("#estadoI").val());
 //    estadoA    = $.trim($("#estadoA").val());

 //    if(nombre.length == 0){
 //        alert("Los campos marcados como * son obligarotirios");
 //        $("#nombre").css("background-color", "pink");
 //        $("#nombre").trigger("focus");

 //        valido = false;
 //    }

 //     if(apellido.length == 0){
 //        alert("Los campos marcados como * son obligarotirios");
 //        $("#apellido").css("background-color", "pink");
 //        $("#apellido").trigger("focus");

 //        valido = false;
 //    }

 //     if(fecha.length == 0){
 //        alert("Los campos marcados como * son obligarotirios");
 //        $("#fecha").trigger("focus");

 //        valido = false;
 //    }

 //     if(sexoM == "" && sexoF == ""){
 //        alert("Los campos marcados como * son obligarotirios. Seleccione el sexo")

 //        valido = false;
 //    }

 //     if(cedula.length == 0){
 //        alert("Los campos marcados como * son obligarotirios");
 //        $("#cedula").css("background-color", "pink");
 //        $("#cedula").trigger("focus");

 //        valido = false;
 //    }

 //     if(nombre.length == 0){
 //        alert("Los campos marcados como * son obligarotirios");
 //        $("#nombre").css("background-color", "pink");
 //        $("#nombre").trigger("focus");

 //        valido = false;
 //    }

 //     if(telefono.length == 0){
 //        alert("Los campos marcados como * son obligarotirios");
 //        $("#telefono").css("background-color", "pink");
 //        $("#telefono").trigger("focus");

 //        valido = false;
 //    }

 //     if(direccion.length == 0){
 //        alert("Los campos marcados como * son obligarotirios");
 //        $("#direccion").css("background-color", "pink");
 //        $("#direccion").trigger("focus");

 //        valido = false;
 //    }

 //     if(email.length == 0){
 //        alert("Los campos marcados como * son obligarotirios");
 //        $("#email").css("background-color", "pink");
 //        $("#email").trigger("focus");

 //        valido = false;
 //    }

 //     if(posicion.length == 0){
 //        alert("Los campos marcados como * son obligarotirios");
 //        $("#posicion").css("background-color", "pink");
 //        $("#posicion").trigger("focus");

 //        valido = false;
 //    }

 //     if(password.length == 0){
 //        alert("Los campos marcados como * son obligarotirios");
 //        $("#password").css("background-color", "pink");
 //        $("#password").trigger("focus");

 //        valido = false;
 //    }

 //     if(posicion.length == 0){
 //        alert("Los campos marcados como * son obligarotirios");
 //        $("#posicion").css("background-color", "pink");
 //        $("#posicion").trigger("focus");

 //        valido = false;
 //    }

 //     if(salario.length == 0){
 //        alert("Los campos marcados como * son obligarotirios");
 //        $("#salario").css("background-color", "pink");
 //        $("#salario").trigger("focus");

 //        valido = false;
 //    }

 //     if(nombre.length == 0){
 //        alert("Los campos marcados como * son obligarotirios");
 //        $("#nombre").css("background-color", "pink");
 //        $("#nombre").trigger("focus");

 //        valido = false;
 //    }

 //     if(nombre.length == 0){
 //        alert("Los campos marcados como * son obligarotirios");
 //        $("#nombre").css("background-color", "pink");
 //        $("#nombre").trigger("focus");

 //        valido = false;
 //    }

 //     if(nombre.length == 0){
 //        alert("Los campos marcados como * son obligarotirios");
 //        $("#nombre").css("background-color", "pink");
 //        $("#nombre").trigger("focus");

 //        valido = false;
 //    }
 // }

 function validar_mod_empleado(){

 }