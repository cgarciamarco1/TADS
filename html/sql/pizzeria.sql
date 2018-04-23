-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 23-04-2018 a las 16:22:26
-- Versión del servidor: 10.1.23-MariaDB-9+deb9u1
-- Versión de PHP: 7.0.27-0+deb9u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pizzeria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

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

-- --------------------------------------------------------

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

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_unicode_ci NOT NULL COMMENT 'nombre del producto',
  `lista_ingredientes` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `precio` decimal(10,0) NOT NULL,
  `disponible` enum('si','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'si' COMMENT 'define si es disponible o menos, para no borrarlo de la base de datos',
  `tipo_producto` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`ID`, `nombre`, `lista_ingredientes`, `precio`, `disponible`, `tipo_producto`) VALUES
(1, 'Margarita', 'tomate, orégano', '10', 'si', 1),
(6, 'Zumo naranja', 'naranja', '2', 'si', 2),
(7, 'Tarta de queso', 'queso, galleta, mantequilla', '3', 'si', 3),
(8, 'Carbonara', 'Nata, bacon, champiñones', '6', 'si', 1),
(9, 'Carbonara Italiana', 'tomate, mozzarella, huevo, bacon, queso parmesano, pimienta negra', '6', 'si', 1),
(10, 'York', 'Jamon queso', '10', 'si', 1),
(11, 'Gambusino', 'Gambas, atun y huevo', '7', 'si', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `id` int(11) NOT NULL,
  `tipo_nombre` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_producto`
--

INSERT INTO `tipo_producto` (`id`, `tipo_nombre`) VALUES
(1, 'Pizza'),
(2, 'Bebida'),
(3, 'Postre');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `direccion`
--
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

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_direccion` (`direccion_entrega`),
  ADD KEY `ID_estado` (`estado`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `tipo` (`tipo_producto`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
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
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
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
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`tipo_producto`) REFERENCES `tipo_producto` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
