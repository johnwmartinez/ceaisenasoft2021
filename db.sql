-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 22-10-2021 a las 15:13:51
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

CREATE TABLE `jugadores` (
  `id_jugador` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `id_partida` int(11) NOT NULL,
  `codigo` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` int(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`id_jugador`, `nombre`, `id_partida`, `codigo`, `created_at`, `updated_at`) VALUES
(15, 'John W.', 20, '2021634829672', '2021-10-21 15:21:12', 1634832469),
(18, 'Pepito', 21, '7791634829836', '2021-10-21 15:23:56', 1634829850),
(19, 'Angelicia', 20, '5301634830147', '2021-10-21 15:29:07', 1634830149),
(20, 'Angelicia', 20, '9491634830197', '2021-10-21 15:29:57', 1634830750),
(21, 'Justin', 20, '6351634830785', '2021-10-21 15:39:45', 1634833341),
(22, 'asdasdasd', 22, '2391634832481', '2021-10-21 16:08:01', 1634832564),
(23, 'fsdfdsf', 23, '2791634832568', '2021-10-21 16:09:28', 1634832635),
(24, 'hjghjhgjghj', 24, '4551634832638', '2021-10-21 16:10:38', 1634832701),
(25, 'fsdfdsf', 25, '8711634832704', '2021-10-21 16:11:44', 1634832777),
(26, 'asdsad', 26, '9101634832779', '2021-10-21 16:12:59', 1634832828),
(27, 'sdfdsf', 27, '9201634832830', '2021-10-21 16:13:50', 1634832895),
(28, 'sdfdsfdf', 28, '2051634832899', '2021-10-21 16:14:59', 1634832973),
(29, 'fghfgh', 29, '2041634832977', '2021-10-21 16:16:17', 1634833076),
(30, '567657', 30, '9471634833081', '2021-10-21 16:18:01', 1634833103),
(31, 'hgjghjhghj', 31, '4791634833106', '2021-10-21 16:18:26', 1634833119),
(32, 'bcfghfgh', 32, '7091634833123', '2021-10-21 16:18:43', 1634833331),
(33, 'Justin', 33, '8021634833356', '2021-10-21 16:22:36', 1634833641),
(34, 'Justin 2', 34, '2301634833654', '2021-10-21 16:27:34', 1634833993),
(35, 'Angélica', 34, '8051634833706', '2021-10-21 16:28:26', 1634834025),
(36, 'Samir', 35, '8491634834006', '2021-10-21 16:33:26', 1634834690),
(37, 'Pepito', 35, '6571634834046', '2021-10-21 16:34:06', 1634838125),
(38, 'Justin', 35, '9961634834097', '2021-10-21 16:34:57', 1634838338),
(39, 'Jeronimo', 35, '8481634834163', '2021-10-21 16:36:03', 1634838337),
(40, 'Pepito', 35, '6551634834718', '2021-10-21 16:45:18', 1634834761),
(41, 'Pendiente', 35, '7231634834791', '2021-10-21 16:46:31', 1634834813),
(42, 'Andresito', 35, '6561634834832', '2021-10-21 16:47:12', 1634838338),
(43, 'Bob Esponja', 35, '6531634838242', '2021-10-21 17:44:02', 1634853874),
(44, 'Jeronimoasasd', 35, '4391634838369', '2021-10-21 17:46:09', 1634853873),
(45, 'Otra prueba', 35, '1041634838500', '2021-10-21 17:48:20', 1634854147),
(46, 'asdasd', 36, '1541634842032', '2021-10-21 18:47:12', 1634842093),
(47, 'asdasd', 37, '6871634842099', '2021-10-21 18:48:19', 1634842122),
(48, 'fsdfdsf', 38, '5161634842127', '2021-10-21 18:48:47', 1634842329),
(49, 'fsdfdsfasdasd', 39, '4441634842333', '2021-10-21 18:52:13', 1634842390),
(50, 'amigos', 35, '7261634842405', '2021-10-21 18:53:25', 1634853874),
(51, 'Jugador 1', 40, '3471634854168', '2021-10-21 22:09:28', 1634858111),
(52, 'Jugador 2', 40, '6601634854205', '2021-10-21 22:10:05', 1634857752),
(53, 'Jugador 3', 40, '8411634854316', '2021-10-21 22:11:56', 1634858118),
(54, 'Jugador 4', 40, '9921634854339', '2021-10-21 22:12:19', 1634858121),
(55, 'Hernando 1', 41, '4761634858162', '2021-10-21 23:16:02', 1634858378),
(56, 'Angélica 2', 41, '2721634858201', '2021-10-21 23:16:41', 1634858379),
(57, 'John 3', 41, '8541634858223', '2021-10-21 23:17:03', 1634858380),
(58, 'Justin 4', 41, '6081634858235', '2021-10-21 23:17:15', 1634858379),
(59, 'John 1', 42, '2851634880584', '2021-10-22 05:29:44', 1634884117),
(60, 'Allison 2', 42, '4121634882133', '2021-10-22 05:55:33', 1634884142),
(61, 'Prueba 3', 42, '1491634882214', '2021-10-22 05:56:54', 1634884157),
(62, 'Partido 4', 42, '3531634882317', '2021-10-22 05:58:37', 1634882371),
(63, 'John 1', 43, '1491634884191', '2021-10-22 06:29:51', 1634908426),
(64, 'Allison 2', 43, '2751634884222', '2021-10-22 06:30:22', 1634886948),
(65, 'Milo 3', 43, '7651634884236', '2021-10-22 06:30:36', 1634884344),
(66, 'Django 4', 43, '6701634884279', '2021-10-22 06:31:19', 1634886943);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidas`
--

CREATE TABLE `partidas` (
  `id_partida` int(11) NOT NULL,
  `codigo` varchar(5) NOT NULL COMMENT 'Código hexadecimal que indifica la partida',
  `turno` int(11) DEFAULT 1,
  `ganador` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT 0 COMMENT '0:Pendiente por comenzar, 1:Activa, 2:Finalizada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `partidas`
--

INSERT INTO `partidas` (`id_partida`, `codigo`, `turno`, `ganador`, `estado`) VALUES
(20, '8334E', 1, NULL, 0),
(21, '2C3E9', 1, NULL, 0),
(22, '784F0', 1, NULL, 0),
(23, 'EDD84', 1, NULL, 0),
(24, '60E1F', 1, NULL, 0),
(25, 'D80C0', 1, NULL, 0),
(26, 'A9AAE', 1, NULL, 0),
(27, 'BBA30', 1, NULL, 0),
(28, '14E21', 1, NULL, 0),
(29, 'C1892', 1, NULL, 0),
(30, 'CEF70', 1, NULL, 0),
(31, '73387', 1, NULL, 0),
(32, '21F43', 1, NULL, 0),
(33, '9A0A0', 1, NULL, 0),
(34, '426E9', 1, NULL, 0),
(35, 'B57C5', 1, NULL, 1),
(36, '6DFAC', 1, NULL, 0),
(37, 'E470B', 1, NULL, 0),
(38, '9A4EF', 1, NULL, 0),
(39, '4E122', 1, NULL, 0),
(40, 'F2B94', 1, NULL, 1),
(41, 'D2F50', 1, NULL, 1),
(42, 'DD547', 1, NULL, 1),
(43, 'B94DB', 1, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidas_preguntas`
--

CREATE TABLE `partidas_preguntas` (
  `idpartidapregunta` int(11) NOT NULL,
  `id_partida` int(11) NOT NULL,
  `id_jugador` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1 COMMENT '1:Activo, 0:Inactivo',
  `idcarta1` int(11) NOT NULL,
  `idcarta2` int(11) NOT NULL,
  `idcarta3` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `partidas_preguntas`
--

INSERT INTO `partidas_preguntas` (`idpartidapregunta`, `id_partida`, `id_jugador`, `estado`, `idcarta1`, `idcarta2`, `idcarta3`) VALUES
(2, 41, 55, 0, 5, 8, 14);

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
-- Volcado de datos para la tabla `partidas_secreto`
--

INSERT INTO `partidas_secreto` (`id_partida_secreto`, `id_partida`, `idcarta1`, `idcarta2`, `idcarta3`) VALUES
(7, 20, 1, 8, 19),
(15, 28, 1, 9, 19),
(17, 30, 1, 11, 19),
(23, 36, 1, 11, 19),
(25, 38, 1, 13, 18),
(26, 39, 1, 13, 19),
(13, 26, 2, 9, 19),
(11, 24, 2, 11, 19),
(8, 21, 3, 9, 15),
(27, 40, 3, 9, 18),
(29, 42, 3, 10, 19),
(10, 23, 3, 13, 15),
(28, 41, 3, 13, 15),
(9, 22, 4, 8, 16),
(24, 37, 4, 10, 16),
(20, 33, 4, 13, 17),
(12, 25, 5, 8, 15),
(30, 43, 5, 9, 15),
(18, 31, 5, 9, 17),
(19, 32, 5, 11, 16),
(16, 29, 5, 13, 17),
(22, 35, 6, 8, 17),
(21, 34, 7, 11, 16),
(14, 27, 7, 13, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_partida_jugador_cartas`
--

CREATE TABLE `rel_partida_jugador_cartas` (
  `id_partida_jugador_cartas` int(11) NOT NULL,
  `id_partida` int(11) NOT NULL,
  `id_jugador` int(11) NOT NULL,
  `idcarta1` int(11) NOT NULL,
  `idcarta2` int(11) NOT NULL,
  `idcarta3` int(11) NOT NULL,
  `idcarta4` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `orden_llegada` int(11) DEFAULT NULL,
  `activo` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rel_partida_jugador_cartas`
--

INSERT INTO `rel_partida_jugador_cartas` (`id_partida_jugador_cartas`, `id_partida`, `id_jugador`, `idcarta1`, `idcarta2`, `idcarta3`, `idcarta4`, `fecha`, `orden_llegada`, `activo`) VALUES
(2, 20, 15, 2, 1, 14, 12, '2021-10-21 17:10:21', 1, 0),
(3, 21, 18, 8, 12, 2, 13, '2021-10-21 17:10:23', 1, 0),
(4, 22, 22, 4, 3, 1, 10, '2021-10-21 18:10:08', 1, 0),
(5, 23, 23, 1, 11, 2, 11, '2021-10-21 18:10:09', 1, 0),
(6, 24, 24, 13, 9, 10, 8, '2021-10-21 18:10:10', 1, 0),
(7, 25, 25, 3, 12, 1, 1, '2021-10-21 18:10:11', 1, 0),
(8, 26, 26, 2, 9, 13, 5, '2021-10-21 18:10:12', 1, 0),
(9, 27, 27, 14, 13, 9, 10, '2021-10-21 18:10:13', 1, 0),
(10, 28, 28, 14, 10, 14, 9, '2021-10-21 18:10:14', 1, 0),
(11, 29, 29, 4, 4, 4, 10, '2021-10-21 18:10:16', 1, 0),
(12, 30, 30, 15, 8, 14, 3, '2021-10-21 18:10:18', 1, 0),
(13, 31, 31, 14, 13, 16, 3, '2021-10-21 18:10:18', 1, 0),
(14, 32, 32, 8, 1, 14, 17, '2021-10-21 18:10:18', 1, 0),
(15, 34, 34, 5, 1, 15, 6, '2021-10-21 18:10:27', 1, 0),
(22, 35, 43, 4, 3, 7, 9, '2021-10-21 19:10:44', 1, 0),
(23, 35, 44, 2, 5, 19, 11, '2021-10-21 19:10:46', 2, 0),
(24, 35, 45, 1, 16, 10, 12, '2021-10-21 19:10:48', 3, 0),
(25, 36, 46, 7, 3, 9, 2, '2021-10-21 20:10:47', 1, 0),
(26, 37, 47, 7, 12, 18, 14, '2021-10-21 20:10:48', 1, 0),
(27, 38, 48, 5, 16, 7, 11, '2021-10-21 20:10:48', 1, 0),
(28, 39, 49, 5, 3, 6, 2, '2021-10-21 20:10:52', 1, 0),
(29, 35, 50, 18, 15, 14, 13, '2021-10-21 20:10:53', 4, 0),
(30, 40, 51, 15, 14, 10, 16, '2021-10-22 00:10:09', 1, 0),
(31, 40, 52, 6, 2, 5, 7, '2021-10-22 00:10:10', 2, 0),
(32, 40, 53, 4, 17, 12, 1, '2021-10-22 00:10:11', 3, 0),
(33, 40, 54, 13, 19, 8, 11, '2021-10-22 00:10:12', 4, 0),
(34, 41, 55, 18, 14, 2, 12, '2021-10-22 01:10:16', 1, 0),
(35, 41, 56, 8, 19, 4, 5, '2021-10-22 01:10:16', 2, 0),
(36, 41, 57, 9, 6, 1, 17, '2021-10-22 01:10:17', 3, 0),
(37, 41, 58, 7, 10, 16, 11, '2021-10-22 01:10:17', 4, 0),
(38, 42, 59, 1, 14, 17, 9, '2021-10-22 07:10:29', 1, 0),
(39, 42, 60, 6, 16, 18, 13, '2021-10-22 07:10:55', 2, 0),
(40, 42, 61, 8, 4, 5, 2, '2021-10-22 07:10:56', 3, 0),
(41, 42, 62, 15, 7, 12, 11, '2021-10-22 07:10:58', 4, 0),
(42, 43, 63, 16, 18, 7, 10, '2021-10-22 08:10:29', 1, 1),
(43, 43, 64, 11, 12, 13, 17, '2021-10-22 08:10:30', 2, 0),
(44, 43, 65, 6, 3, 4, 2, '2021-10-22 08:10:30', 3, 0),
(45, 43, 66, 1, 19, 14, 8, '2021-10-22 08:10:31', 4, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rel_partida_jugador_tablas`
--

CREATE TABLE `rel_partida_jugador_tablas` (
  `id_partida_jugador_carta` int(11) NOT NULL,
  `id_partida` int(11) NOT NULL,
  `id_jugador` int(11) NOT NULL,
  `idcarta` int(11) NOT NULL,
  `poseedor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rel_partida_jugador_tablas`
--

INSERT INTO `rel_partida_jugador_tablas` (`id_partida_jugador_carta`, `id_partida`, `id_jugador`, `idcarta`, `poseedor_id`) VALUES
(1, 36, 46, 7, 46),
(2, 36, 46, 3, 46),
(3, 36, 46, 9, 46),
(4, 36, 46, 2, 46),
(5, 37, 47, 7, 47),
(6, 37, 47, 12, 47),
(7, 37, 47, 18, 47),
(8, 37, 47, 14, 47),
(9, 38, 48, 5, 48),
(10, 38, 48, 16, 48),
(11, 38, 48, 7, 48),
(12, 38, 48, 11, 48),
(13, 39, 49, 5, 49),
(14, 39, 49, 3, 49),
(15, 39, 49, 6, 49),
(16, 39, 49, 2, 49),
(17, 35, 50, 18, 50),
(18, 35, 50, 15, 50),
(19, 35, 50, 14, 50),
(20, 35, 50, 13, 50),
(21, 40, 51, 15, 51),
(22, 40, 51, 14, 51),
(23, 40, 51, 10, 51),
(24, 40, 51, 16, 51),
(25, 40, 52, 6, 52),
(26, 40, 52, 2, 52),
(27, 40, 52, 5, 52),
(28, 40, 52, 7, 52),
(29, 40, 53, 4, 53),
(30, 40, 53, 17, 53),
(31, 40, 53, 12, 53),
(32, 40, 53, 1, 53),
(33, 40, 54, 13, 54),
(34, 40, 54, 19, 54),
(35, 40, 54, 8, 54),
(36, 40, 54, 11, 54),
(7441, 41, 55, 18, 55),
(7442, 41, 55, 14, 55),
(7443, 41, 55, 2, 55),
(7444, 41, 55, 12, 55),
(7445, 41, 56, 8, 56),
(7446, 41, 56, 19, 56),
(7447, 41, 56, 4, 56),
(7448, 41, 56, 5, 56),
(7449, 41, 57, 9, 57),
(7450, 41, 57, 6, 57),
(7451, 41, 57, 1, 57),
(7452, 41, 57, 17, 57),
(7453, 41, 58, 7, 58),
(7454, 41, 58, 10, 58),
(7455, 41, 58, 16, 58),
(7456, 41, 58, 11, 58),
(7457, 42, 59, 1, 59),
(7458, 42, 59, 14, 59),
(7459, 42, 59, 17, 59),
(7460, 42, 59, 9, 59),
(7461, 42, 60, 6, 60),
(7462, 42, 60, 16, 60),
(7463, 42, 60, 18, 60),
(7464, 42, 60, 13, 60),
(7465, 42, 61, 8, 61),
(7466, 42, 61, 4, 61),
(7467, 42, 61, 5, 61),
(7468, 42, 61, 2, 61),
(7469, 42, 62, 15, 62),
(7470, 42, 62, 7, 62),
(7471, 42, 62, 12, 62),
(7472, 42, 62, 11, 62),
(7473, 42, 59, 15, 62),
(7474, 42, 59, 7, 62),
(7475, 42, 59, 12, 62),
(7476, 42, 59, 11, 62),
(7477, 42, 60, 15, 62),
(7478, 42, 60, 7, 62),
(7479, 42, 60, 12, 62),
(7480, 42, 60, 11, 62),
(7481, 42, 61, 15, 62),
(7482, 42, 61, 7, 62),
(7483, 42, 61, 12, 62),
(7484, 42, 61, 11, 62),
(7485, 43, 63, 16, 63),
(7486, 43, 63, 18, 63),
(7487, 43, 63, 7, 63),
(7488, 43, 63, 10, 63),
(7489, 43, 64, 11, 64),
(7490, 43, 64, 12, 64),
(7491, 43, 64, 13, 64),
(7492, 43, 64, 17, 64),
(7493, 43, 65, 6, 65),
(7494, 43, 65, 3, 65),
(7495, 43, 65, 4, 65),
(7496, 43, 65, 2, 65),
(7497, 42, 60, 1, 59),
(7498, 42, 60, 14, 59),
(7499, 42, 60, 17, 59),
(7500, 42, 60, 9, 59),
(7501, 42, 61, 1, 59),
(7502, 42, 61, 14, 59),
(7503, 42, 61, 17, 59),
(7504, 42, 61, 9, 59),
(7505, 42, 61, 6, 60),
(7506, 42, 61, 16, 60),
(7507, 42, 61, 18, 60),
(7508, 42, 61, 13, 60),
(7509, 43, 66, 1, 66),
(7510, 43, 66, 19, 66),
(7511, 43, 66, 14, 66),
(7512, 43, 66, 8, 66),
(7513, 43, 63, 6, 65),
(7514, 43, 63, 3, 65),
(7515, 43, 63, 4, 65),
(7516, 43, 63, 2, 65),
(7517, 43, 64, 6, 65),
(7518, 43, 64, 3, 65),
(7519, 43, 64, 4, 65),
(7520, 43, 64, 2, 65),
(7521, 43, 66, 6, 65),
(7522, 43, 66, 3, 65),
(7523, 43, 66, 4, 65),
(7524, 43, 66, 2, 65),
(7525, 43, 63, 11, 64),
(7526, 43, 63, 12, 64),
(7527, 43, 63, 13, 64),
(7528, 43, 63, 17, 64),
(7529, 43, 66, 11, 64),
(7530, 43, 66, 12, 64),
(7531, 43, 66, 13, 64),
(7532, 43, 66, 17, 64),
(7533, 43, 63, 1, 66),
(7534, 43, 63, 19, 66),
(7535, 43, 63, 14, 66),
(7536, 43, 63, 8, 66),
(7537, 43, 66, 1, 66),
(7538, 43, 66, 19, 66),
(7539, 43, 66, 14, 66),
(7540, 43, 66, 8, 66),
(7541, 43, 63, 1, 66),
(7542, 43, 63, 19, 66),
(7543, 43, 63, 14, 66),
(7544, 43, 63, 8, 66);

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
  ADD PRIMARY KEY (`id_jugador`),
  ADD KEY `fb_partida_jugador` (`id_partida`);

--
-- Indices de la tabla `partidas`
--
ALTER TABLE `partidas`
  ADD PRIMARY KEY (`id_partida`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `fk_partidas_ganador` (`ganador`);

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
  MODIFY `id_jugador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `partidas`
--
ALTER TABLE `partidas`
  MODIFY `id_partida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `partidas_preguntas`
--
ALTER TABLE `partidas_preguntas`
  MODIFY `idpartidapregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `partidas_secreto`
--
ALTER TABLE `partidas_secreto`
  MODIFY `id_partida_secreto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `rel_partida_jugador_cartas`
--
ALTER TABLE `rel_partida_jugador_cartas`
  MODIFY `id_partida_jugador_cartas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `rel_partida_jugador_tablas`
--
ALTER TABLE `rel_partida_jugador_tablas`
  MODIFY `id_partida_jugador_carta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7545;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD CONSTRAINT `fb_partida_jugador` FOREIGN KEY (`id_partida`) REFERENCES `partidas` (`id_partida`);

--
-- Filtros para la tabla `partidas`
--
ALTER TABLE `partidas`
  ADD CONSTRAINT `fk_partidas_ganador` FOREIGN KEY (`ganador`) REFERENCES `jugadores` (`id_jugador`);

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
