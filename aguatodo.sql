-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-07-2024 a las 23:04:34
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aguatodo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_factura`
--

CREATE TABLE `tbl_factura` (
  `fac_id` int(11) NOT NULL,
  `fac_fecha` date DEFAULT NULL,
  `fac_cobrador` varchar(150) DEFAULT NULL,
  `fac_monto` float DEFAULT NULL,
  `fac_montoM` float DEFAULT NULL,
  `fac_total` float DEFAULT NULL,
  `fac_estado` varchar(2) DEFAULT NULL,
  `soc_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_factura`
--

INSERT INTO `tbl_factura` (`fac_id`, `fac_fecha`, `fac_cobrador`, `fac_monto`, `fac_montoM`, `fac_total`, `fac_estado`, `soc_id`) VALUES
(1, '2024-06-30', 'Dilan Sebas Monta Tian', 0.34, 0, 0.34, 'PP', 1),
(2, '2024-06-30', 'Dilan Sebas Monta Tian', 99.54, 0, 99.54, 'PG', 5),
(3, '2024-06-30', 'Dilan Sebas Monta Tian', 31, 0, 31, 'PP', 1),
(4, '2024-06-30', '13 123', 0.34, 0, 0.34, 'PP', 1),
(5, '2024-07-18', '13 123', 9.53, 0, 9.53, 'PP', 9),
(6, '2024-07-18', '13 123', 9.3, 0, 9.3, 'PG', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_medidor`
--

CREATE TABLE `tbl_medidor` (
  `med_id` int(11) NOT NULL,
  `med_identificacion` varchar(200) DEFAULT NULL,
  `med_fechaA` date DEFAULT NULL,
  `med_lecturaA` decimal(6,2) DEFAULT 0.00,
  `med_fechaN` date DEFAULT NULL,
  `med_lecturaN` decimal(6,2) DEFAULT NULL,
  `soc_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_medidor`
--

INSERT INTO `tbl_medidor` (`med_id`, `med_identificacion`, `med_fechaA`, `med_lecturaA`, `med_fechaN`, `med_lecturaN`, `soc_id`) VALUES
(1, 'qwe22', '2024-07-18', 720.00, '2024-07-25', 56.00, 4),
(2, 'asdfg', '2024-05-23', 123.00, '2024-06-05', 223.00, 4),
(4, 'sdsa', '2024-05-08', 324.00, '2024-08-08', 500.00, 4),
(5, 'wrewr', '2024-07-04', 234.00, '2024-07-19', 9999.99, 5),
(6, 'asd', '2024-07-19', 123.00, '2024-07-04', 1244.00, 4),
(7, 'qwe', '2024-07-30', 234.00, '2024-07-16', 324.00, 4),
(8, 'qwe', '2024-07-17', 0.00, '2024-08-01', 30.75, 23),
(9, 'dfgh', '2024-07-04', 0.00, '2024-07-19', 30.00, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_multa`
--

CREATE TABLE `tbl_multa` (
  `mul_id` int(11) NOT NULL,
  `mul_codMul` varchar(10) DEFAULT NULL,
  `mul_fecha` date DEFAULT NULL,
  `mul_monto` float DEFAULT NULL,
  `mul_descrip` varchar(250) DEFAULT NULL,
  `mul_estado` varchar(1) DEFAULT NULL,
  `soc_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_multa`
--

INSERT INTO `tbl_multa` (`mul_id`, `mul_codMul`, `mul_fecha`, `mul_monto`, `mul_descrip`, `mul_estado`, `soc_id`) VALUES
(1, NULL, '2024-07-17', 5, 'et', 'M', 1),
(2, NULL, '2024-07-18', 7, 'ghjk', 'M', 1),
(3, NULL, '2024-07-18', 5, 'sdf', 'M', 1),
(4, NULL, '2024-07-18', 7, 'tyui', 'M', 9),
(5, NULL, '2024-07-18', 7, 'fghj', 'N', 24),
(6, '8765504926', '2024-07-21', 3, 'wwe', 'M', 5),
(7, '8336269597', '2024-07-21', 3, 'asd', 'M', 5),
(8, '4317001237', '2024-07-21', 34, 'asd', 'M', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pago`
--

CREATE TABLE `tbl_pago` (
  `pag_id` int(11) NOT NULL,
  `pag_fecha` date DEFAULT NULL,
  `pag_monto` float DEFAULT NULL,
  `pag_codMul` varchar(10) DEFAULT NULL,
  `pag_estado` varchar(2) DEFAULT NULL,
  `soc_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_pago`
--

INSERT INTO `tbl_pago` (`pag_id`, `pag_fecha`, `pag_monto`, `pag_codMul`, `pag_estado`, `soc_id`) VALUES
(1, '2024-07-17', 31, NULL, 'PP', 1),
(2, '2024-07-17', 31, NULL, 'PP', 1),
(3, '2024-06-30', 99.54, '8336269597', 'PP', 5),
(4, '2024-07-17', 31, NULL, 'PP', 1),
(5, '2024-07-17', 31, NULL, 'PP', 1),
(6, '2024-07-17', 31, NULL, 'PP', 1),
(7, '2024-07-17', 31, NULL, 'PP', 1),
(8, '2024-07-17', 31, NULL, 'PP', 1),
(9, '2024-07-17', 31, NULL, 'PP', 1),
(10, '2024-07-17', 31, NULL, 'PP', 1),
(11, '2024-07-18', 9.53, NULL, 'PP', 9),
(12, '2024-07-18', 9.3, '4317001237', 'PP', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_perfil`
--

CREATE TABLE `tbl_perfil` (
  `per_id` int(11) NOT NULL,
  `per_tipo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_perfil`
--

INSERT INTO `tbl_perfil` (`per_id`, `per_tipo`) VALUES
(1, 'Administrador'),
(2, 'Tesorero'),
(3, 'Operador'),
(4, 'Socio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_socio`
--

CREATE TABLE `tbl_socio` (
  `soc_id` int(11) NOT NULL,
  `soc_cedula` decimal(10,0) DEFAULT NULL,
  `soc_nombre` varchar(50) DEFAULT NULL,
  `soc_apellido` varchar(50) DEFAULT NULL,
  `soc_telefono` decimal(10,0) DEFAULT NULL,
  `soc_email` varchar(150) DEFAULT NULL,
  `soc_direccion` varchar(150) DEFAULT NULL,
  `soc_contra` varchar(200) DEFAULT NULL,
  `per_id` int(11) DEFAULT NULL,
  `soc_estado` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tbl_socio`
--

INSERT INTO `tbl_socio` (`soc_id`, `soc_cedula`, `soc_nombre`, `soc_apellido`, `soc_telefono`, `soc_email`, `soc_direccion`, `soc_contra`, `per_id`, `soc_estado`) VALUES
(1, 123456, 'Dilan Sebas', 'Monta Tian', 12345678, 'asd@gmail.com', 'asd', '$2y$10$tMMWb4XTKOubs7eg0j.XsO7dnVm39LhZSuoMX1fCF25bMJl6Ll9y.', 1, 'A'),
(2, 123456, 'Dilan Sebas22', 'Monta Tian', 12345678, 'asd@gmail.com', 'asd', '$2y$10$g86UPjimGArS1ivX6yUw1uZEDsPYrHJmuSc2FD1SNAnO.5bU4s8f6', 2, 'A'),
(3, 123456, 'Dilan Sebas', 'Monta Tian', 12345678, 'asd@gmail.com', 'asd', '$2y$10$pB/CkxtJ6U6iGfHAhlNboega5f1na40hKsUQrqBcG0kj5DBZa.1Ea', 3, 'A'),
(4, 123456, 'Dilan Sebas', 'Monta Tian', 12345678, 'asd@gmail.com', 'asd', NULL, 4, 'A'),
(5, 12345678, 'asd asdss', 'asd asd', 123, 'asd@gmail.com', 'asd', NULL, 4, 'A'),
(6, 1234, NULL, NULL, NULL, NULL, NULL, '$2y$10$9kQn2e9O4oMLZ/24X7.dDeocIDrVKhcTsQBAMBd/f11/kfj9zmoIm', 1, 'A'),
(8, 12345, NULL, NULL, NULL, NULL, NULL, '$2y$10$GC.O1jZr5QTywhHis9kTh.Z4nuWE94uxjri7LPQRMcQ3Tn0YUx/ym', 1, 'A'),
(9, 111, NULL, NULL, NULL, NULL, NULL, '$2y$10$TJakkCRe2smcwLdUCFND/urU5ZxOxUoWhTO9Z5.8ephv4q8mup8he', 1, 'A'),
(10, 222, NULL, NULL, NULL, NULL, NULL, '$2y$10$UFwDuAoxasZohQm.WgwmGusSVbYmlcX2hUixr9v78OOl2wZQvbF0a', 1, 'A'),
(11, 333, NULL, NULL, NULL, NULL, NULL, '$2y$10$jMz7htqiRM7A/RQEauApVe9BG7hOi7iXotH9BGlSK.u/7xy0VPVIm', 1, 'A'),
(21, 123, '13', '123', 123, '123@gmail.com', '123', '$2y$10$trgTJ3GuYdagHTK1wRA5Hel.NLJSAg2s.bdFVDt.f2ZqAoXQGbEQO', 2, 'A'),
(22, 123, '123', '123', 123, '123@gmail.com', '123', '$2y$10$dQh84tgtl/7KKi3.zTZaT.gJxaCSz1HCOf82A1CauDEvrZUlUlJ/2', 3, 'A'),
(23, 111, 'dfgh', 'sdfg', 2345, 'asd@gmail.com', 'qwertyu', NULL, 4, 'A'),
(24, 999, '999', 'fghjk', 12345, 'asd@gmail.com', 'hgfd', NULL, 4, 'A');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_factura`
--
ALTER TABLE `tbl_factura`
  ADD PRIMARY KEY (`fac_id`),
  ADD KEY `IXFK_tbl_factura_tbl_socio` (`soc_id`);

--
-- Indices de la tabla `tbl_medidor`
--
ALTER TABLE `tbl_medidor`
  ADD PRIMARY KEY (`med_id`),
  ADD KEY `IXFK_tbl_medidor_tbl_socio` (`soc_id`);

--
-- Indices de la tabla `tbl_multa`
--
ALTER TABLE `tbl_multa`
  ADD PRIMARY KEY (`mul_id`),
  ADD KEY `IXFK_tbl_multa_tbl_socio` (`soc_id`);

--
-- Indices de la tabla `tbl_pago`
--
ALTER TABLE `tbl_pago`
  ADD PRIMARY KEY (`pag_id`),
  ADD KEY `IXFK_tbl_pago_tbl_socio` (`soc_id`);

--
-- Indices de la tabla `tbl_perfil`
--
ALTER TABLE `tbl_perfil`
  ADD PRIMARY KEY (`per_id`);

--
-- Indices de la tabla `tbl_socio`
--
ALTER TABLE `tbl_socio`
  ADD PRIMARY KEY (`soc_id`),
  ADD KEY `IXFK_tbl_socio_tbl_perfil` (`per_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_factura`
--
ALTER TABLE `tbl_factura`
  MODIFY `fac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_medidor`
--
ALTER TABLE `tbl_medidor`
  MODIFY `med_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tbl_multa`
--
ALTER TABLE `tbl_multa`
  MODIFY `mul_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tbl_pago`
--
ALTER TABLE `tbl_pago`
  MODIFY `pag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tbl_perfil`
--
ALTER TABLE `tbl_perfil`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbl_socio`
--
ALTER TABLE `tbl_socio`
  MODIFY `soc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_factura`
--
ALTER TABLE `tbl_factura`
  ADD CONSTRAINT `FK_tbl_factura_tbl_socio` FOREIGN KEY (`soc_id`) REFERENCES `tbl_socio` (`soc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_medidor`
--
ALTER TABLE `tbl_medidor`
  ADD CONSTRAINT `FK_tbl_medidor_tbl_socio` FOREIGN KEY (`soc_id`) REFERENCES `tbl_socio` (`soc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_multa`
--
ALTER TABLE `tbl_multa`
  ADD CONSTRAINT `FK_tbl_multa_tbl_socio` FOREIGN KEY (`soc_id`) REFERENCES `tbl_socio` (`soc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_pago`
--
ALTER TABLE `tbl_pago`
  ADD CONSTRAINT `FK_tbl_pago_tbl_socio` FOREIGN KEY (`soc_id`) REFERENCES `tbl_socio` (`soc_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_socio`
--
ALTER TABLE `tbl_socio`
  ADD CONSTRAINT `FK_tbl_socio_tbl_perfil` FOREIGN KEY (`per_id`) REFERENCES `tbl_perfil` (`per_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
