-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2021 a las 21:43:06
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de datos: `findbug`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidas_secreto`
--

CREATE TABLE `partidas_secreto` (
  `id_partida_secreto` int(11) NOT NULL,
  `id_partida` int(11) NOT NULL,
  `idcarta1` int(11) NOT NULL,
  `idcarta2` int(11) NOT NULL,
  `idcarta3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `partidas_secreto`
--
ALTER TABLE `partidas_secreto`
  MODIFY `id_partida_secreto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `partidas_secreto`
--
ALTER TABLE `partidas_secreto`
  ADD CONSTRAINT `partidas_secreto_FK` FOREIGN KEY (`id_partida`) REFERENCES `partidas` (`id_partida`),
  ADD CONSTRAINT `partidas_secreto_FK_1` FOREIGN KEY (`idcarta1`) REFERENCES `cartas` (`idcarta`),
  ADD CONSTRAINT `partidas_secreto_FK_2` FOREIGN KEY (`idcarta2`) REFERENCES `cartas` (`idcarta`),
  ADD CONSTRAINT `partidas_secreto_FK_3` FOREIGN KEY (`idcarta3`) REFERENCES `cartas` (`idcarta`);
COMMIT;
