-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-01-2023 a las 23:56:26
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba_tecnica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestion`
--

CREATE TABLE `gestion` (
  `id_gestion` int(11) NOT NULL,
  `tipo_llamada_id` int(11) NOT NULL,
  `origen_llamada_id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `gestion` datetime NOT NULL,
  `estado` int(11) NOT NULL COMMENT '0=inactivo, 1=activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gestion`
--

INSERT INTO `gestion` (`id_gestion`, `tipo_llamada_id`, `origen_llamada_id`, `nombre`, `telefono`, `gestion`, `estado`) VALUES
(1, 1, 1, 'Curiosito', '75757575', '2023-01-07 15:03:00', 1),
(2, 3, 4, 'Consulta de bonos', '74747474', '2023-01-07 15:10:00', 1),
(3, 2, 2, 'Consulta', '75747574', '2023-01-07 16:53:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `origen_llamada`
--

CREATE TABLE `origen_llamada` (
  `id_origen_llamada` int(11) NOT NULL,
  `origen_llamada` varchar(200) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `estado` int(11) NOT NULL COMMENT '0=inactivo, 1=activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `origen_llamada`
--

INSERT INTO `origen_llamada` (`id_origen_llamada`, `origen_llamada`, `fecha_ingreso`, `estado`) VALUES
(1, 'Whatsapp', '2023-01-07', 1),
(2, 'Linea fija', '2023-01-07', 1),
(4, 'Celular', '2023-01-07', 1),
(5, 'Linee', '2023-01-07', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_llamada`
--

CREATE TABLE `tipo_llamada` (
  `id_tipo_llamada` int(11) NOT NULL,
  `tipo_llamada` varchar(200) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `estado` int(11) NOT NULL COMMENT '0=inactivo, 1=activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_llamada`
--

INSERT INTO `tipo_llamada` (`id_tipo_llamada`, `tipo_llamada`, `fecha_ingreso`, `estado`) VALUES
(1, 'Consulta de cuadratura', '2023-01-07', 1),
(2, 'Consulta de bonos', '2023-01-07', 1),
(3, 'Consulta de datos', '2023-01-07', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `gestion`
--
ALTER TABLE `gestion`
  ADD PRIMARY KEY (`id_gestion`),
  ADD KEY `fk_origen_llamada` (`origen_llamada_id`),
  ADD KEY `fk_tipo_llamada` (`tipo_llamada_id`);

--
-- Indices de la tabla `origen_llamada`
--
ALTER TABLE `origen_llamada`
  ADD PRIMARY KEY (`id_origen_llamada`);

--
-- Indices de la tabla `tipo_llamada`
--
ALTER TABLE `tipo_llamada`
  ADD PRIMARY KEY (`id_tipo_llamada`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `gestion`
--
ALTER TABLE `gestion`
  MODIFY `id_gestion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `origen_llamada`
--
ALTER TABLE `origen_llamada`
  MODIFY `id_origen_llamada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_llamada`
--
ALTER TABLE `tipo_llamada`
  MODIFY `id_tipo_llamada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `gestion`
--
ALTER TABLE `gestion`
  ADD CONSTRAINT `fk_origen_llamada` FOREIGN KEY (`origen_llamada_id`) REFERENCES `origen_llamada` (`id_origen_llamada`),
  ADD CONSTRAINT `fk_tipo_llamada` FOREIGN KEY (`tipo_llamada_id`) REFERENCES `tipo_llamada` (`id_tipo_llamada`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
