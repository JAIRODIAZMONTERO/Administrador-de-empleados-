<?php 

	include_once("../Libreria/fpdf/fpdf.php");
	include_once("../Libreria/engine.php");

class  MiPDF extends FPDF {
		
	public function Header(){
			
		$this -> Image( "../App_Imagenes/Imagen4.png" , 5 , 5 , 100 , 50);
		$this -> SetFont ('Courier' , 'B' , 25);
		$this -> Cell(200, 50 , "Reporte de la Nomina" , 0 , 0 , 'C');
		$this -> SetFillColor( 128, 0, 0 );
		$this -> Ln(50);
	}	
}

$cabeceraT = array("ID" , "Nombre" ,"Apellido", "Cedula" , "Sueldo bruto", "AFP", "SFS", "ISR", "Sueldo neto");

//creamos el objeto pdf y lo configuramos
$mipdf = new MiPDF();

$mipdf -> addPage();

for ($i = 0; $i < count( $cabeceraT ) ; $i++)
{
	$mipdf -> SetFillColor( 0 , 150 , 800 );
	$mipdf -> SetFont( 'Courier' , 'B' , 6.5 );
	$mipdf -> SetTextColor( 0 , 0 , 0);
	$mipdf -> Cell ( 21 , 5 , $cabeceraT[ $i ] , 1 , 0 , 'C' , true );	
}

$mipdf -> Ln(7);

$consulta = mysql_query( "SELECT e.id, e.nombre, e.apellido, e.cedula, p.salario AS 'Sueldo bruto', (p.salario*0.0272) AS AFP,
						(p.salario* 0.0301) AS SFS,(SELECT laempresa.`fn.Calcular_ISR`(p.salario)) AS 
						ISR, (p.salario -(p.salario*0.0272 + p.salario*0.0301)) AS 'Sueldo neto' FROM 
						empleados e, posicion p WHERE e.id_posicion = p.id" );

while ( $datos = mysql_fetch_array( $consulta ))
{
	$id 		 = $datos ['id'];
	$nombre 	 = $datos ['nombre'];
	$apellido 	 = $datos ['apellido'];
	$cedula 	 = $datos ['cedula'];
	$salario 	 = $datos ['Sueldo bruto'];
	$afp 		 = $datos ['AFP'];
	$sfs 		 = $datos ['SFS'];
	$isr 		 = $datos ['ISR'];
	$sueldo_neto = $datos ['Sueldo neto'];

	$mipdf -> SetFillColor( 255 , 255 , 255 );	
	$mipdf -> Cell( 21, 5 , $id , 1, 0, 'C' , true );
	$mipdf -> Cell( 21, 5 , $nombre , 1, 0, 'C' , true );
	$mipdf -> Cell( 21, 5 , $apellido, 1, 0, 'C' , true );
	$mipdf -> Cell( 21, 5 , $cedula, 1, 0, 'C' , true );
	$mipdf -> Cell( 21, 5 , $salario , 1, 0, 'C' , true );
	$mipdf -> Cell( 21, 5 , $afp , 1, 0, 'C' , true );
	$mipdf -> Cell( 21, 5 , $sfs , 1, 0, 'C' , true );
	$mipdf -> Cell( 21, 5 , $isr , 1, 0, 'C' , true );
	$mipdf -> Cell( 21, 5 , $sueldo_neto , 1, 0, 'C' , true );
	$mipdf -> Ln( 7);	
}

	$mipdf -> Output();
?>