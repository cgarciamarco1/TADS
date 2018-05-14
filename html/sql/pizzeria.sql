-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
-- Host: localhost:3306
-- Generation Time: May 01, 2018 at 05:16 PM
-- Server version: 10.1.23-MariaDB-9+deb9u1
-- PHP Version: 7.0.27-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzeria`
--
CREATE DATABASE IF NOT EXISTS `pizzeria` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `pizzeria`;

-- --------------------------------------------------------



CREATE TABLE `direccion` (
  `ID` int(11) NOT NULL,
  `direccion1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `direccion2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `poblacion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'he puesto 15 como maximo para incluir todos los numeros internacionales (como están estudiantes de intercambio en la zona)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_pedido`
--

CREATE TABLE `estado_pedido` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



--
-- Estructura de tabla para la tabla `linea_pedido`
--

CREATE TABLE `linea_pedido` (
  `ID` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `pedido` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,0) NOT NULL COMMENT 'registra el precio total de la linea (hecho para guardar correctamente los precios en la base de datos, en el caso que se modifique el precio del producto)',
  `comentario` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Comentario opcional (para añadir o quitar ingredientes)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `ID` int(11) NOT NULL,
  `nombre_cliente` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_hora_pedido` datetime NOT NULL,
  `fecha_hora_activacion` datetime NOT NULL,
  `precio_total` decimal(10,0) NOT NULL,
  `domicilio` tinyint(1) NOT NULL,
  `direccion_entrega` int(11) NOT NULL COMMENT 'separo la dirección en otra tabla para separar los campos relativos a esa',
  `estado` int(11) NOT NULL,
  `comentarios` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------



DROP TABLE IF EXISTS `estado_pedido`;
CREATE TABLE `estado_pedido` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `estado_pedido`
--

INSERT INTO `estado_pedido` (`ID`, `nombre`, `descripcion`) VALUES
(1, 'Activo', 'Pedido que debe procesarse');

-- --------------------------------------------------------

--
-- Table structure for table `linea_pedido`
--

DROP TABLE IF EXISTS `linea_pedido`;
CREATE TABLE `linea_pedido` (
  `ID` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `pedido` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `preciototal` decimal(10,0) NOT NULL COMMENT 'registra el precio total de la linea (hecho para guardar correctamente los precios en la base de datos, en el caso que se modifique el precio del producto)',
  `comentario` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Comentario opcional (para añadir o quitar ingredientes)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `linea_pedido`
--

INSERT INTO `linea_pedido` (`ID`, `idproducto`, `pedido`, `cantidad`, `preciototal`, `comentario`) VALUES
(124, 1, 159, 1, '10', ''),
(125, 6, 159, 1, '2', ''),
(126, 7, 159, 1, '3', '');

-- --------------------------------------------------------

--
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE `pedido` (
  `ID` int(11) NOT NULL,
  `nombre_cliente` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` text COLLATE utf8_unicode_ci NOT NULL,
  `fecha_hora_pedido` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fecha_hora_activacion` time NOT NULL,
  `precio_total` decimal(10,0) NOT NULL,
  `direccion_entrega` varchar(500) COLLATE utf8_unicode_ci NOT NULL COMMENT 'separo la dirección en otra tabla para separar los campos relativos a esa',
  `estado` int(11) NOT NULL,
  `comentarios` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pedido`
--

INSERT INTO `pedido` (`ID`, `nombre_cliente`, `telefono`, `fecha_hora_pedido`, `fecha_hora_activacion`, `precio_total`, `direccion_entrega`, `estado`, `comentarios`) VALUES
(159, 'Fabio', '', '2018-05-01 14:37:05', '16:36:00', '15', '', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_unicode_ci NOT NULL COMMENT 'nombre del producto',
  `lista_ingredientes` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precio` decimal(10,0) NOT NULL,
  `disponible` enum('si','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'si' COMMENT 'define si es disponible o menos, para no borrarlo de la base de datos',
  `tipo_producto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`ID`, `nombre`, `lista_ingredientes`, `precio`, `disponible`, `tipo_producto`) VALUES
(1, 'Margarita', 'tomate, orégano', '10', 'si', 1),
(6, 'Zumo naranja', 'naranja', '2', 'si', 2),
(7, 'Tarta de queso', 'queso, galleta, mantequilla', '3', 'si', 3),
(8, 'Carbonara', 'Nata, bacon, champiñones', '6', 'si', 1),
(9, 'Carbonara Italiana', 'tomate, mozzarella, huevo, bacon, queso parmesano, pimienta negra', '6', 'si', 1),
(10, 'York', 'Jamon queso', '10', 'si', 1),


-- --------------------------------------------------------

--
-- Table structure for table `tipo_producto`
--

DROP TABLE IF EXISTS `tipo_producto`;
CREATE TABLE `tipo_producto` (
  `id` int(11) NOT NULL,
  `tipo_nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tipo_producto`
--

INSERT INTO `tipo_producto` (`id`, `tipo_nombre`) VALUES
(1, 'Pizza'),
(2, 'Bebida'),
(3, 'Postre');

-- --------------------------------------------------------

--
-- Table structure for table `tmppedido`
--

DROP TABLE IF EXISTS `tmppedido`;
CREATE TABLE `tmppedido` (
  `id` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `producto` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `preciounidad` int(11) NOT NULL,
  `preciototal` int(11) NOT NULL,
  `idpedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `estado_pedido`
--
ALTER TABLE `estado_pedido`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `linea_pedido`
--
ALTER TABLE `linea_pedido`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_pedido` (`pedido`),
  ADD KEY `ID_producto` (`idproducto`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_direccion` (`direccion_entrega`(255)),
  ADD KEY `ID_estado` (`estado`);


-- Indices de la tabla `direccion`
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `estado_pedido`
--
ALTER TABLE `estado_pedido`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `linea_pedido`
--
ALTER TABLE `linea_pedido`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_pedido` (`pedido`),
  ADD KEY `ID_producto` (`producto`);

-- Indices de la tabla `pedido`
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_direccion` (`direccion_entrega`),
  ADD KEY `ID_estado` (`estado`);


-- Indexes for table `productos`
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `tipo` (`tipo_producto`);

--
-- Indexes for table `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tmppedido`
--
ALTER TABLE `tmppedido`
  ADD PRIMARY KEY (`id`);



--
-- AUTO_INCREMENT for table `estado_pedido`
--
ALTER TABLE `estado_pedido`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `linea_pedido`
--
ALTER TABLE `linea_pedido`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;
--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estado_pedido`
--
ALTER TABLE `estado_pedido`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `linea_pedido`
--
ALTER TABLE `linea_pedido`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tmppedido`
--
ALTER TABLE `tmppedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `linea_pedido`
--
ALTER TABLE `linea_pedido`
  ADD CONSTRAINT `linea_pedido_ibfk_1` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `linea_pedido_ibfk_2` FOREIGN KEY (`pedido`) REFERENCES `pedido` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estado_pedido` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

-- Filtros para la tabla `linea_pedido`
--
ALTER TABLE `linea_pedido`
  ADD CONSTRAINT `linea_pedido_ibfk_1` FOREIGN KEY (`producto`) REFERENCES `productos` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `linea_pedido_ibfk_2` FOREIGN KEY (`pedido`) REFERENCES `pedido` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`estado`) REFERENCES `estado_pedido` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`direccion_entrega`) REFERENCES `direccion` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`tipo_producto`) REFERENCES `tipo_producto` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
