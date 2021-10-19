-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-10-2021 a las 00:40:53
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
-- Estructura de tabla para la tabla `rel_partida_jugador_cartas`
--

CREATE TABLE `rel_partida_jugador_cartas` (
  `id_partida_jugador_cartas` int(11) NOT NULL,
  `id_partida` int(11) DEFAULT NULL,
  `id_jugador` int(11) DEFAULT NULL,
  `idcarta1` int(11) DEFAULT NULL,
  `idcarta2` int(11) DEFAULT NULL,
  `idcarta3` int(11) DEFAULT NULL,
  `idcarta4` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `orden_llegada` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `rel_partida_jugador_cartas`
--
ALTER TABLE `rel_partida_jugador_cartas`
  MODIFY `id_partida_jugador_cartas` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

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
COMMIT;
