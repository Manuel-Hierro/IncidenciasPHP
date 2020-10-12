--
-- Borra la Base de Datos
--
DROP DATABASE IF EXISTS `db_incidencias`;
--
-- Base de datos: `db`
--
CREATE DATABASE IF NOT EXISTS `db_incidencias` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_incidencias`;
--
-- Estructura de tabla para la tabla `usuario`
--
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` 
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nif` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido1` varchar(255) DEFAULT NULL,
  `apellido2` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,  
  `password` varchar(255) DEFAULT NULL,
  `perfil` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fotografia` varchar(255) DEFAULT NULL,
  `telefono` varchar(9) DEFAULT NULL,
  `departamento` varchar(255) DEFAULT NULL,  
  `fecha` varchar(255) DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) 
ENGINE = InnoDB AUTO_INCREMENT = 0 DEFAULT CHARSET = utf8;
--
-- Estructura de tabla para la tabla `incidencia`
--
DROP TABLE IF EXISTS `incidencia`;
CREATE TABLE IF NOT EXISTS `incidencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,  
  `fecha_incidencia` varchar(255) DEFAULT NULL,
  `prioridad` varchar(255) DEFAULT NULL,  
  `aula` varchar(255) DEFAULT NULL, 
  `asunto` varchar(255) DEFAULT NULL, 
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_incidencia_usuario_idx` (`usuario_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Estructura de tabla para la tabla `mensaje`
--
DROP TABLE IF EXISTS `mensaje`;
CREATE TABLE IF NOT EXISTS `mensaje` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,  
  `fecha_mensaje` varchar(255) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_mensaje_usuario_idx` (`usuario_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Estructura de tabla para la tabla `log`
--
DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `fecha_log` varchar(255) DEFAULT NULL,
  `accion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_log_usuario_idx` (`usuario_id`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Filtros para la tabla `incidencia`
--
ALTER TABLE `incidencia`
  ADD CONSTRAINT `fk_incidencia_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;
--
-- Filtros para la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD CONSTRAINT `fk_mensaje_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;
--
-- Filtros para la tabla `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `fk_log_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;
--
-- Volcado de datos para la tabla `usuario` para el ROOT
--
INSERT INTO `usuario` 
(`id`, `nif`, `nombre`, `apellido1`, `apellido2`, `username`, `password`, `perfil`,  `email`, `fotografia`,
`telefono`, `departamento`, `fecha`, `activo`) 
VALUES
(0, '12345678R', 'Manuel', 'Jesus', 'Hierro', 'root', '$2y$04$bzD2G5HF0WtH.04a1y2BZ.LB.XMDdX2aucrKM/xgCWF5RtCF89Wd6',
'administrador', 'root@root.com', 'user.png', '959123456', 'informatica', CURDATE(), 1);
COMMIT;
--
-- Volcado de datos para la tabla `usuario`
--
INSERT INTO `usuario` (`id`, `nif`, `nombre`, `apellido1`, `apellido2`, `username`, `password`, `perfil`, `email`, `fotografia`, `telefono`, `departamento`, `fecha`, `activo`) 
VALUES
(10, '56565656R', 'manu', 'jesus', 'garcia', 'manu', '$2y$04$bzD2G5HF0WtH.04a1y2BZ.LB.XMDdX2aucrKM/xgCWF5RtCF89Wd6', 'profesor', 'manu@manu.com', '1.gif', '959123456', 'informatica', CURDATE(), 1),
(20, '34565656R', 'jose', 'garrido', 'garcia', 'jose', '$2y$04$ttgEDe7MbTVNX7uTWLFz/ufFxKxoLRaLvcPjH9kUSEA7rqPtyohoS', 'profesor', 'jose@jose.com', '2.png', '959123456', 'informatica', CURDATE(), 1),
(30, '66565656R', 'juan', 'miguel', 'garcia', 'fernando', '$2y$04$ttgEDe7MbTVNX7uTWLFz/ufFxKxoLRaLvcPjH9kUSEA7rqPtyohoS', 'profesor', 'jose@jose.com', '3.jpg', '959123456', 'informatica', CURDATE(), 1),
(40, '46565656R', 'antonio', 'jose', 'garcia', 'tamara', '$2y$04$ttgEDe7MbTVNX7uTWLFz/ufFxKxoLRaLvcPjH9kUSEA7rqPtyohoS', 'profesor', 'jose@jose.com', '4.jpg', '959123456', 'informatica', CURDATE(), 1),
(50, '32565656R', 'lucas', 'garcia', 'garcia', 'joselito', '$2y$04$ttgEDe7MbTVNX7uTWLFz/ufFxKxoLRaLvcPjH9kUSEA7rqPtyohoS', 'profesor', 'jose@jose.com', '5.png', '959123456', 'informatica', CURDATE(), 1),
(60, '86565656R', 'maria', 'angel', 'garcia', 'platero', '$2y$04$ttgEDe7MbTVNX7uTWLFz/ufFxKxoLRaLvcPjH9kUSEA7rqPtyohoS', 'profesor', 'jose@jose.com', '13.jpg', '959123456', 'informatica', CURDATE(), 1),
(70, '15765656R', 'lucia', 'gordo', 'garcia', 'lucas', '$2y$04$ttgEDe7MbTVNX7uTWLFz/ufFxKxoLRaLvcPjH9kUSEA7rqPtyohoS', 'profesor', 'jose@jose.com', '11.jpg', '959123456', 'informatica', CURDATE(), 1),
(80, '29565656R', 'claudia', 'fernandez', 'garcia', 'estefania', '$2y$04$ttgEDe7MbTVNX7uTWLFz/ufFxKxoLRaLvcPjH9kUSEA7rqPtyohoS', 'profesor', 'jose@jose.com', '10.png', '959123456', 'informatica', CURDATE(), 1),
(100, '96565656R', 'isabel', 'reyes', 'garcia', 'isabel', '$2y$04$bzD2G5HF0WtH.04a1y2BZ.LB.XMDdX2aucrKM/xgCWF5RtCF89Wd6', 'administrador', 'manu@manu.com', '17.jpg', '959123456', 'informatica', CURDATE(), 0),
(200, '16565656R', 'jose', 'angel', 'garcia', 'marta', '$2y$04$ttgEDe7MbTVNX7uTWLFz/ufFxKxoLRaLvcPjH9kUSEA7rqPtyohoS', 'profesor', 'jose@jose.com', '19.png', '959123456', 'informatica', CURDATE(), 0),
(300, '26565656R', 'juan', 'jesus', 'garcia', 'pitu', '$2y$04$ttgEDe7MbTVNX7uTWLFz/ufFxKxoLRaLvcPjH9kUSEA7rqPtyohoS', 'profesor', 'jose@jose.com', '12.jpg', '959123456', 'informatica', CURDATE(), 0),
(400, '46565656R', 'antonio', 'loco', 'garcia', 'piolin', '$2y$04$ttgEDe7MbTVNX7uTWLFz/ufFxKxoLRaLvcPjH9kUSEA7rqPtyohoS', 'profesor', 'jose@jose.com', '6.jpg', '959123456', 'informatica', CURDATE(), 0),
(500, '32565656R', 'lucas', 'miguel', 'garcia', 'tania', '$2y$04$ttgEDe7MbTVNX7uTWLFz/ufFxKxoLRaLvcPjH9kUSEA7rqPtyohoS', 'profesor', 'jose@jose.com', '7.png', '959123456', 'informatica', CURDATE(), 0),
(600, '86565656R', 'maria', 'jesus', 'garcia', 'yeni', '$2y$04$ttgEDe7MbTVNX7uTWLFz/ufFxKxoLRaLvcPjH9kUSEA7rqPtyohoS', 'profesor', 'jose@jose.com', '15.png', '959123456', 'informatica', CURDATE(), 0),
(700, '15765656R', 'lucia', 'perez', 'garcia', 'piti', '$2y$04$ttgEDe7MbTVNX7uTWLFz/ufFxKxoLRaLvcPjH9kUSEA7rqPtyohoS', 'profesor', 'jose@jose.com', '14.jpg', '959123456', 'informatica', CURDATE(), 0),
(800, '29565656R', 'claudia', 'pinto', 'garcia', 'alberto', '$2y$04$ttgEDe7MbTVNX7uTWLFz/ufFxKxoLRaLvcPjH9kUSEA7rqPtyohoS', 'profesor', 'jose@jose.com', '18.png', '959123456', 'informatica', CURDATE(), 0);

INSERT INTO `incidencia` (`id`, `usuario_id`, `fecha_incidencia`, `prioridad`, `aula`, `asunto`, `descripcion`) 
VALUES 
('1', '1', CURDATE(), 'media', 'Aula 1', 'Fuego', 'El ordenador Nº2 esta ardiendo'),
('2', '1', CURDATE(), 'alta', 'Aula 1', 'Robo', 'Los ordenadores del Aula 1 han sido robados'),
('3', '10', CURDATE(), 'alta', 'Aula 2', 'Baja', 'Antonio esta de baja'),
('4', '10', CURDATE(), 'alta', 'Aula 2', 'Hace calor', 'El aire acondicionado no funciona'),
('5', '20', CURDATE(), 'baja', 'Aula 3', 'Sin conexion', 'Se ha ido el internet en el instituto'),
('6', '30', CURDATE(), 'media', 'Aula 3', 'Estropeado', 'Algunos ordenadores no funcionan'),
('7', '50', CURDATE(), 'baja', 'Aula 4', 'Muerte', 'Algunos alumnos han muerto de aburrimiento'),
('8', '50', CURDATE(), 'baja', 'Aula 4', 'Muerte Feliz', 'Algunos alumnos han muerto de risa');

INSERT INTO `mensaje` (`id`, `usuario_id`, `fecha_mensaje`, `descripcion`) 
VALUES 
('1', '1', CURDATE(), 'Hola a todos mis nuevos amigos'),
('2', '1', CURDATE(), 'Deberias callarte pesado'),
('3', '10', CURDATE(), 'Hola me dejas los apuntes'),
('4', '10', CURDATE(), 'Tu ordenador se ha quedado encendido'),
('5', '20', CURDATE(), 'Como estas, cuanto tiempo'),
('6', '20', CURDATE(), 'Muchas gracias'),
('7', '30', CURDATE(), 'Han encontrado lo que perdiste'),
('8', '50', CURDATE(), 'Adios tio'),
('9', '70', CURDATE(), 'El insti se quema xd');

INSERT INTO `log` (`id`, `usuario_id`, `fecha_log`, `accion`) 
VALUES 
('1', '1', CURDATE(), 'login'),
('2', '1', CURDATE(), 'borrar'),
('3', '1', CURDATE(), 'añadir'),
('4', '1', CURDATE(), 'editar'),
('5', '10', CURDATE(), 'enviar'),
('6', '10', CURDATE(), 'enviar'),
('7', '10', CURDATE(), 'login'),
('8', '10', CURDATE(), 'enviar');


