/*
SQLyog Ultimate v10.00 Beta1
MySQL - 5.5.24-log : Database - laempresa
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`laempresa` /*!40100 DEFAULT CHARACTER SET latin1 */;

/*Table structure for table `empleados` */

DROP TABLE IF EXISTS `empleados`;

CREATE TABLE `empleados` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `cedula` VARCHAR(20) NOT NULL,
  `direccion` VARCHAR(200) DEFAULT NULL,
  `passwordd` VARCHAR(200) DEFAULT NULL,
  `apellido` VARCHAR(200) DEFAULT NULL,
  `email` VARCHAR(200) DEFAULT NULL,
  `nombre` VARCHAR(200) DEFAULT NULL,
  `foto` VARCHAR(200) DEFAULT NULL,
  `telefono` VARCHAR(15) DEFAULT NULL,
  `sexo` CHAR(1) DEFAULT NULL,
  `fecha_nacimiento` DATE DEFAULT NULL,
  `id_posicion` INT(11) DEFAULT NULL,
  `estado` VARCHAR(20) DEFAULT 'inactivo',
  `simbolo_zodiaco` VARCHAR(30),
  PRIMARY KEY (`id`),
  KEY `fk_posicion` (`id_posicion`),
  CONSTRAINT `fk_posicion` FOREIGN KEY (`id_posicion`) REFERENCES `posicion` (`id`)
) ENGINE=INNODB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `empleados` */

/*Table structure for table `posicion` */

DROP TABLE IF EXISTS `posicion`;

CREATE TABLE `posicion` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) DEFAULT NULL,
  `salario` FLOAT DEFAULT NULL,
  `id_superior` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_superior` (`id_superior`),
  CONSTRAINT `fk_superior` FOREIGN KEY (`id_superior`) REFERENCES `posicion` (`id`)
) ENGINE=INNODB AUTO_INCREMENT=410 DEFAULT CHARSET=latin1;

/*Data for the table `posicion` */

SET GLOBAL log_bin_trust_function_creators=1;

/* Function  structure for function  `fn.Calcular_edad` */

/*!50003 DROP FUNCTION IF EXISTS `fn.Calcular_edad` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `fn.Calcular_edad`(fecha date) RETURNS int(11)
BEGIN
	declare edad int;
	
	set edad = (YEAR(CURDATE())-YEAR(fecha))-(RIGHT(CURDATE(),5)<RIGHT(fecha,5));
	
	return edad;
		
    END */$$
DELIMITER ;

/* Function  structure for function  `fn.Calcular_ISR` */

/*!50003 DROP FUNCTION IF EXISTS `fn.Calcular_ISR` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `fn.Calcular_ISR`(salario decimal) RETURNS decimal(10,0)
BEGIN
	declare ISR decimal(10,2);
	declare base_imponible decimal(10,2);
	declare desc_afp decimal(10,2);
	declare desc_sfs decimal(10,2);
		
	set desc_afp = 0.0272;
	set desc_sfs = 0.0301;	
	set base_imponible = salario - (salario * (0.0573));
	
	if((base_imponible*12)<=349326.00) 
	
		then set ISR = 0; 
	
	elseif(((base_imponible*12)>=349326.01) and ((base_imponible*12)<=523988.00)) 
	
		then set ISR = (base_imponible-(349326.01/12))*0.15;
	
	elseIF(((base_imponible*12)>=523988.01) AND ((base_imponible*12)<=727761.00))
	
		then SET ISR = (base_imponible-(523988.01/12))*0.20 + 26199.00;
	
	elseIF((base_imponible*12)>=727761.01)
	
		then SET ISR = (base_imponible-(727761.01/12))*0.25 + 66954.00;
	
	end if;
	
	return ISR;
	
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
