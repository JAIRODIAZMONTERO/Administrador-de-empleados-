TRUNCATE TABLE `posicion`

SELECT SHA(' ')

SELECT * FROM `empleados`


SELECT p.nombre AS posicion, e.email, e.id FROM empleados e, posicion p WHERE
e.email = '20112450@itla.edu.do' AND  e.passwordd = SHA('1234') AND e.id_posicion  = p.id

SELECT p.nombre AS rol, e.id FROM empleados e, posicion p WHERE
e.email = 'jairo' AND  e.passwordd = SHA('123') AND e.id_posicion  = p.id

INSERT INTO `empleados`(email, passwordd, `id_posicion`)VALUES('jairo', SHA('123'), 1)


SELECT e.id, e.cedula, e.direccion, e.apellido, e.email, e.nombre, e.estado,
e.telefono, e.sexo, e.fecha_nacimiento, p.nombre AS posicion, p.salario FROM
empleados e, posicion p WHERE e.id_posicion = p.id ORDER BY e.id


SELECT e.id, e.cedula, e.direccion, e.apellido, e.email, e.nombre, e.estado,
					  e.telefono, e.sexo, e.fecha_nacimiento, e.id_posicion AS posicion, p.salario FROM
					  empleados e, posicion p WHERE e.id=1 ORDER BY e.id
					    

TRUNCATE TABLE empleados





SELECT 4%3

CREATE FUNCTION


SELECT e.id, e.nombre, e.apellido, e.cedula, p.salario AS 'Sueldo bruto', (p.salario*0.0272) AS 'AFP',
(p.salario* 0.0301) AS 'Seguro Familiar de Salud',(SELECT laempresa.`fn.Calcular_ISR`(p.salario)) AS 
'Imp. Sobre la Renta'  FROM empleados e, posicion p WHERE e.id_posicion = p.id


SET GLOBAL log_bin_trust_function_creators=1

DELIMITER $$

CREATE
    /*[DEFINER = { user | CURRENT_USER }]*/
    FUNCTION `laempresa`.`fn.Calcular_ISR`(salario DECIMAL) RETURNS DECIMAL(3,2);
	
    BEGIN
	DECLARE ISR DECIMAL;
	SET salario2 = salario*12;
	
		IF(salario2<=349326.00, ISR=0);
				
	END IF;
		
	RETURN ISR;

    END$$

DELIMITER ;

DELIMITER$$
CREATE FUNCTION saludar(nombre VARCHAR(50) RETURNS VARCHAR(100);
BEGIN 
	RETURN nombre;

END$$
DELIMITER;

SELECT laempresa.`fn.Calcular_ISR`(50000) AS ISR



SELECT (37500 - (37500*(0.0272 + 0.0301))) AS base_impositiva


SELECT SUM(salario) AS 'Total nomina' FROM posicion 


