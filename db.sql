-- phpMyAdmin SQL Dump 
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 20-10-2021 a las 19:06:24
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `findbug`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartas`
--
DROP TABLE IF EXISTS cartas;
CREATE TABLE `cartas` (
  `idcarta` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL COMMENT '(1:Programador, 2:Modulo, 3:Tipo de error)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cartas`
--

INSERT INTO `cartas` (`idcarta`, `nombre`, `categoria`) VALUES
(1, 'Pedro', 1),
(2, 'Juan', 1),
(3, 'Carlos', 1),
(4, 'Juanita', 1),
(5, 'Antonio', 1),
(6, 'Carolina', 1),
(7, 'Manuel', 1),
(8, 'Nómina', 2),
(9, 'Facturación', 2),
(10, 'Recibos', 2),
(11, 'Comprobante contable', 2),
(12, 'Usuarios', 2),
(13, 'Contabilidad', 2),
(14, '404', 3),
(15, 'Stack overflow', 3),
(16, 'Memory out of range', 3),
(17, 'Null pointer', 3),
(18, 'Syntax error', 3),
(19, 'Encoding error', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--
DROP TABLE IF EXISTS jugadores;
CREATE TABLE `jugadores` (
  `id_jugador` int(11) NOT NULL,
  `codigo` varchar(100) DEFAULT NULL,
  `nombre` varchar(150) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`id_jugador`, `codigo`, `nombre`, `created_at`, `updated_at`) VALUES
(5, '9581634749462', 'Pepito Sanchez', '2021-10-20 17:04:22', '2021-10-20 19:10:04'),
(6, '2911634749558', 'John Martinez', '2021-10-20 17:05:58', '2021-10-20 19:10:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidas`
--

DROP TABLE IF EXISTS partidas;
CREATE TABLE `partidas` (
  `id_partida` int(11) NOT NULL,
  `codigo` varchar(5) NOT NULL COMMENT 'Código hexadecimal que indifica la partida',
  `turno` int(11) DEFAULT 1,
  `estado` int(11) DEFAULT 0 COMMENT '0:Pendiente por comenzar, 1:Activa, 2:Finalizada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `partidas`
--

INSERT INTO `partidas` (`id_partida`, `codigo`, `turno`, `estado`) VALUES
(10, '22993', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidas_preguntas`
--
DROP TABLE IF EXISTS partidas_preguntas;
CREATE TABLE `partidas_preguntas` (
  `idpartidapregunta` int(11) NOT NULL,
  `id_partida` int(11) NOT NULL,
  `id_jugador` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1 COMMENT '1:Activo, 0:Inactivo',
  `idcarta1` int(11) NOT NULL,
  `idcarta2` int(11) NOT NULL,
  `idcarta3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidas_secreto`
--
DROP TABLE IF EXISTS partidas_secreto;
CREATE TABLE `partidas_secreto` (
  `id_partida_secreto` int(11) NOT NULL,
  `id_partida` int(11) NOT NULL,
  `idcarta1` int(11) NOT NULL,
  `idcarta2` int(11) NOT NULL,
  `idcarta3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_partida_jugador_cartas`
--
DROP TABLE IF EXISTS rel_partida_jugador_cartas;
CREATE TABLE `rel_partida_jugador_cartas` (
  `id_partida_jugador_cartas` int(11) NOT NULL,
  `id_partida` int(11) NOT NULL,
  `id_jugador` int(11) NOT NULL,
  `idcarta1` int(11) NOT NULL,
  `idcarta2` int(11) NOT NULL,
  `idcarta3` int(11) NOT NULL,
  `idcarta4` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `orden_llegada` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_partida_jugador_tablas`
--
DROP TABLE IF EXISTS rel_partida_jugador_tablas;
CREATE TABLE `rel_partida_jugador_tablas` (
  `id_partida_jugador_carta` int(11) NOT NULL,
  `id_partida` int(11) NOT NULL,
  `id_jugador` int(11) NOT NULL,
  `idcarta` int(11) NOT NULL,
  `poseedor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cartas`
--
ALTER TABLE `cartas`
  ADD PRIMARY KEY (`idcarta`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`id_jugador`);

--
-- Indices de la tabla `partidas`
--
ALTER TABLE `partidas`
  ADD PRIMARY KEY (`id_partida`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `partidas_preguntas`
--
ALTER TABLE `partidas_preguntas`
  ADD PRIMARY KEY (`idpartidapregunta`),
  ADD KEY `partidas_preguntas_FK_1` (`id_jugador`),
  ADD KEY `partidas_preguntas_FK_2` (`idcarta1`),
  ADD KEY `partidas_preguntas_FK_3` (`idcarta2`),
  ADD KEY `partidas_preguntas_FK_4` (`idcarta3`),
  ADD KEY `partidas_preguntas_FK` (`id_partida`);

--
-- Indices de la tabla `partidas_secreto`
--
ALTER TABLE `partidas_secreto`
  ADD PRIMARY KEY (`id_partida_secreto`),
  ADD KEY `partidas_secreto_FK` (`id_partida`),
  ADD KEY `partidas_secreto_FK_2` (`idcarta2`),
  ADD KEY `partidas_secreto_FK_3` (`idcarta3`),
  ADD KEY `partidas_secreto_idcarta1_IDX` (`idcarta1`,`idcarta2`,`idcarta3`,`id_partida`) USING BTREE;

--
-- Indices de la tabla `rel_partida_jugador_cartas`
--
ALTER TABLE `rel_partida_jugador_cartas`
  ADD PRIMARY KEY (`id_partida_jugador_cartas`),
  ADD KEY `rel_partida_jugador_cartas_FK` (`id_jugador`),
  ADD KEY `rel_partida_jugador_cartas_FK_1` (`id_partida`),
  ADD KEY `rel_partida_jugador_cartas_FK_2` (`idcarta1`),
  ADD KEY `rel_partida_jugador_cartas_FK_3` (`idcarta2`),
  ADD KEY `rel_partida_jugador_cartas_FK_4` (`idcarta3`),
  ADD KEY `rel_partida_jugador_cartas_FK_5` (`idcarta4`);

--
-- Indices de la tabla `rel_partida_jugador_tablas`
--
ALTER TABLE `rel_partida_jugador_tablas`
  ADD PRIMARY KEY (`id_partida_jugador_carta`),
  ADD KEY `rel_partida_jugador_tablas_FK` (`id_partida`),
  ADD KEY `rel_partida_jugador_tablas_FK_1` (`id_jugador`),
  ADD KEY `rel_partida_jugador_tablas_FK_2` (`idcarta`),
  ADD KEY `rel_partida_jugador_tablas_FK_3` (`poseedor_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cartas`
--
ALTER TABLE `cartas`
  MODIFY `idcarta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `id_jugador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `partidas`
--
ALTER TABLE `partidas`
  MODIFY `id_partida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `partidas_preguntas`
--
ALTER TABLE `partidas_preguntas`
  MODIFY `idpartidapregunta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `partidas_secreto`
--
ALTER TABLE `partidas_secreto`
  MODIFY `id_partida_secreto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rel_partida_jugador_cartas`
--
ALTER TABLE `rel_partida_jugador_cartas`
  MODIFY `id_partida_jugador_cartas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rel_partida_jugador_tablas`
--
ALTER TABLE `rel_partida_jugador_tablas`
  MODIFY `id_partida_jugador_carta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `partidas_preguntas`
--
ALTER TABLE `partidas_preguntas`
  ADD CONSTRAINT `partidas_preguntas_FK` FOREIGN KEY (`id_partida`) REFERENCES `partidas` (`id_partida`),
  ADD CONSTRAINT `partidas_preguntas_FK_1` FOREIGN KEY (`id_jugador`) REFERENCES `jugadores` (`id_jugador`),
  ADD CONSTRAINT `partidas_preguntas_FK_2` FOREIGN KEY (`idcarta1`) REFERENCES `cartas` (`idcarta`),
  ADD CONSTRAINT `partidas_preguntas_FK_3` FOREIGN KEY (`idcarta2`) REFERENCES `cartas` (`idcarta`),
  ADD CONSTRAINT `partidas_preguntas_FK_4` FOREIGN KEY (`idcarta3`) REFERENCES `cartas` (`idcarta`);

--
-- Filtros para la tabla `partidas_secreto`
--
ALTER TABLE `partidas_secreto`
  ADD CONSTRAINT `partidas_secreto_FK` FOREIGN KEY (`id_partida`) REFERENCES `partidas` (`id_partida`),
  ADD CONSTRAINT `partidas_secreto_FK_1` FOREIGN KEY (`idcarta1`) REFERENCES `cartas` (`idcarta`),
  ADD CONSTRAINT `partidas_secreto_FK_2` FOREIGN KEY (`idcarta2`) REFERENCES `cartas` (`idcarta`),
  ADD CONSTRAINT `partidas_secreto_FK_3` FOREIGN KEY (`idcarta3`) REFERENCES `cartas` (`idcarta`);

--
-- Filtros para la tabla `rel_partida_jugador_cartas`
--
ALTER TABLE `rel_partida_jugador_cartas`
  ADD CONSTRAINT `rel_partida_jugador_cartas_FK` FOREIGN KEY (`id_jugador`) REFERENCES `jugadores` (`id_jugador`),
  ADD CONSTRAINT `rel_partida_jugador_cartas_FK_1` FOREIGN KEY (`id_partida`) REFERENCES `partidas` (`id_partida`),
  ADD CONSTRAINT `rel_partida_jugador_cartas_FK_2` FOREIGN KEY (`idcarta1`) REFERENCES `cartas` (`idcarta`),
  ADD CONSTRAINT `rel_partida_jugador_cartas_FK_3` FOREIGN KEY (`idcarta2`) REFERENCES `cartas` (`idcarta`),
  ADD CONSTRAINT `rel_partida_jugador_cartas_FK_4` FOREIGN KEY (`idcarta3`) REFERENCES `cartas` (`idcarta`),
  ADD CONSTRAINT `rel_partida_jugador_cartas_FK_5` FOREIGN KEY (`idcarta4`) REFERENCES `cartas` (`idcarta`);

--
-- Filtros para la tabla `rel_partida_jugador_tablas`
--
ALTER TABLE `rel_partida_jugador_tablas`
  ADD CONSTRAINT `rel_partida_jugador_tablas_FK` FOREIGN KEY (`id_partida`) REFERENCES `partidas` (`id_partida`),
  ADD CONSTRAINT `rel_partida_jugador_tablas_FK_1` FOREIGN KEY (`id_jugador`) REFERENCES `jugadores` (`id_jugador`),
  ADD CONSTRAINT `rel_partida_jugador_tablas_FK_2` FOREIGN KEY (`idcarta`) REFERENCES `cartas` (`idcarta`),
  ADD CONSTRAINT `rel_partida_jugador_tablas_FK_3` FOREIGN KEY (`poseedor_id`) REFERENCES `jugadores` (`id_jugador`);
COMMIT;
