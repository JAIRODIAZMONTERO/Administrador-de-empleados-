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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cedula` varchar(20) NOT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `passwordd` varchar(200) DEFAULT NULL,
  `apellido` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `id_posicion` int(11) DEFAULT NULL,
  `estado` varchar(20) DEFAULT 'inactivo',
  PRIMARY KEY (`id`),
  KEY `fk_posicion` (`id_posicion`),
  CONSTRAINT `fk_posicion` FOREIGN KEY (`id_posicion`) REFERENCES `posicion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Table structure for table `posicion` */

DROP TABLE IF EXISTS `posicion`;

CREATE TABLE `posicion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `salario` float DEFAULT NULL,
  `id_superior` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_superior` (`id_superior`),
  CONSTRAINT `fk_superior` FOREIGN KEY (`id_superior`) REFERENCES `posicion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
