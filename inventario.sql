-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 08-06-2021 a las 03:03:13
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(100) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `categoria`) VALUES
(1, 'Varios'),
(2, 'Electronicos'),
(3, 'Domesticos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

DROP TABLE IF EXISTS `movimientos`;
CREATE TABLE IF NOT EXISTS `movimientos` (
  `id_movimiento` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_mov` enum('entrada','salida') NOT NULL,
  `cantidad_inicial` int(11) NOT NULL,
  `cantidad_final` int(11) NOT NULL,
  `precio_inicial` decimal(10,0) NOT NULL,
  `precio_final` decimal(10,0) NOT NULL,
  `fecha_movimiento` date NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_movimiento`),
  KEY `FK_mov_prod` (`id_producto`),
  KEY `FK_mov_user` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id_movimiento`, `tipo_mov`, `cantidad_inicial`, `cantidad_final`, `precio_inicial`, `precio_final`, `fecha_movimiento`, `id_producto`, `id_usuario`) VALUES
(6, 'entrada', 60, 65, '180', '195', '2021-06-07', 3, 1),
(7, 'salida', 75, 70, '150', '140', '2021-06-07', 1, 1),
(8, 'salida', 70, 60, '140', '120', '2021-06-07', 1, 1),
(9, 'entrada', 60, 65, '120', '130', '2021-06-07', 1, 1),
(10, 'salida', 65, 60, '130', '120', '2021-06-07', 1, 1),
(11, 'salida', 65, 60, '195', '180', '2021-06-07', 3, 1),
(12, 'entrada', 60, 70, '120', '140', '2021-06-07', 1, 1),
(13, 'entrada', 70, 80, '140', '160', '2021-06-07', 1, 4),
(14, 'entrada', 60, 90, '180', '270', '2021-06-07', 3, 4),
(15, 'salida', 90, 85, '270', '255', '2021-06-07', 3, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,0) NOT NULL,
  `fecha_agregado` date NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id_producto`),
  KEY `FK_pro_cat` (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre_producto`, `descripcion`, `cantidad`, `precio`, `fecha_agregado`, `id_categoria`) VALUES
(1, 'Vaso', 'Vaso de vidrio', 80, '2', '2021-05-29', 3),
(3, 'Taza', 'Taza de porcelana', 85, '3', '2021-06-06', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rol` enum('administrador','empleado') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `nombre`, `email`, `rol`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrador Principal', 'administradorprincipal@gmail.com', 'administrador'),
(4, 'usuario', 'f8032d5cae3de20fcec887f395ec9a6a', 'Usuario de prueba', 'usuario@gmail.com', 'empleado');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `FK_mov_prod` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mov_user` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `FK_pro_cat` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
