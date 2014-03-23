<?php 

	include_once("../Libreria/fpdf/fpdf.php");
	include_once("../Libreria/engine.php");

class  MiPDF extends FPDF {
		
	public function Header(){
			
		$this -> Image( "../App_Imagenes/Imagen4.png" , 5 , 5 , 100 , 50);
		$this -> SetFont ('Courier' , 'B' , 25);
		$this -> Cell(250, 50 , "Reporte social" , 0 , 0 , 'C');
		$this -> SetFillColor( 128, 0, 0 );
		$this -> Ln(50);
	}	
}

$cabeceraT = array("Nombre" , "Sexo" , "Edad", "S. zodiaco", "Posicion", "Estado");

//creamos el objeto pdf y lo configuramos
$mipdf = new MiPDF();

$mipdf -> addPage();

for ($i = 0; $i < count( $cabeceraT ) ; $i++)
{
	$mipdf -> SetFillColor( 0 , 150 , 800 );
	$mipdf -> SetFont( 'Courier' , 'B' , 6.5 );
	$mipdf -> SetTextColor( 0 , 0 , 0);
	$mipdf -> Cell ( 32 , 5 , $cabeceraT[ $i ] , 1 , 0 , 'C' , true );	
}

$mipdf -> Ln(7); //salto de linea

//Obtener query desde archivo
$archivo = file_get_contents("query.tmp.json");
$consultas = json_decode($archivo);

//ejecutar cada una de las consultas guardadas en archivo
mysql_query( $consultas[0] ); //eliminar_tabla
mysql_query( $consultas[1] ); //crear_tabla
$consulta = mysql_query( $consultas[2] ); //seleccionar_datos

while ( $datos = mysql_fetch_array( $consulta ))
{
	$nombre   = $datos['nombre'];
	$sexo 	  = $datos['sexo'];
	$edad	  = $datos['edad' ];
	$zodiaco  = $datos['zodiaco'];
	$posicion = $datos['posicion'];
	$estado   = $datos['estado'];

	$mipdf -> SetFillColor( 255 , 255 , 255 );	
	$mipdf -> Cell( 32, 5 , $nombre , 1, 0, 'C' , true );
	$mipdf -> Cell( 32, 5 , $sexo , 1, 0, 'C' , true );
	$mipdf -> Cell( 32, 5 , $edad, 1, 0, 'C' , true );
	$mipdf -> Cell( 32, 5 , $zodiaco, 1, 0, 'C' , true );
	$mipdf -> Cell( 32, 5 , $posicion , 1, 0, 'C' , true );
	$mipdf -> Cell( 32, 5 , $estado , 1, 0, 'C' , true );
	$mipdf -> Ln(7);	
}
	$mipdf -> Output();
?>