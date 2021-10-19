-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: findbug
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.17-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cartas`
--

DROP TABLE IF EXISTS `cartas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartas` (
  `idcarta` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL COMMENT '(1:Programador, 2:Modulo, 3:Tipo de error)',
  PRIMARY KEY (`idcarta`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cartas`
--

LOCK TABLES `cartas` WRITE;
/*!40000 ALTER TABLE `cartas` DISABLE KEYS */;
INSERT INTO `cartas` VALUES (1,'Pedro',1),(2,'Juan',1),(3,'Carlos',1),(4,'Juanita',1),(5,'Antonio',1),(6,'Carolina',1),(7,'Manuel',1),(8,'Nómina',2),(9,'Facturación',2),(10,'Recibos',2),(11,'Comprobante contable',2),(12,'Usuarios',2),(13,'Contabilidad',2),(14,'404',3),(15,'Stack overflow',3),(16,'Memory out of range',3),(17,'Null pointer',3),(18,'Syntax error',3),(19,'Encoding error',3);
/*!40000 ALTER TABLE `cartas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jugadores`
--

DROP TABLE IF EXISTS `jugadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jugadores` (
  `id_jugador` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_jugador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jugadores`
--

LOCK TABLES `jugadores` WRITE;
/*!40000 ALTER TABLE `jugadores` DISABLE KEYS */;
/*!40000 ALTER TABLE `jugadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partidas`
--

DROP TABLE IF EXISTS `partidas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partidas` (
  `id_partida` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(5) NOT NULL COMMENT 'Código hexadecimal que indifica la partida',
  `turno` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL COMMENT '0:Pendiente por comenzar, 1:Activa, 2:Finalizada',
  PRIMARY KEY (`id_partida`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partidas`
--

LOCK TABLES `partidas` WRITE;
/*!40000 ALTER TABLE `partidas` DISABLE KEYS */;
/*!40000 ALTER TABLE `partidas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partidas_preguntas`
--

DROP TABLE IF EXISTS `partidas_preguntas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partidas_preguntas` (
  `idpartidapregunta` int(11) NOT NULL AUTO_INCREMENT,
  `id_partida` int(11) DEFAULT NULL,
  `id_jugador` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL COMMENT '1:Activo, 2:Inactivo',
  `idcarta1` int(11) DEFAULT NULL,
  `idcarta2` int(11) DEFAULT NULL,
  `idcarta3` int(11) DEFAULT NULL,
  PRIMARY KEY (`idpartidapregunta`),
  KEY `partidas_preguntas_FK` (`id_partida`),
  KEY `partidas_preguntas_FK_1` (`id_jugador`),
  KEY `partidas_preguntas_FK_2` (`idcarta1`),
  KEY `partidas_preguntas_FK_3` (`idcarta2`),
  KEY `partidas_preguntas_FK_4` (`idcarta3`),
  CONSTRAINT `partidas_preguntas_FK` FOREIGN KEY (`id_partida`) REFERENCES `partidas` (`id_partida`),
  CONSTRAINT `partidas_preguntas_FK_1` FOREIGN KEY (`id_jugador`) REFERENCES `jugadores` (`id_jugador`),
  CONSTRAINT `partidas_preguntas_FK_2` FOREIGN KEY (`idcarta1`) REFERENCES `cartas` (`idcarta`),
  CONSTRAINT `partidas_preguntas_FK_3` FOREIGN KEY (`idcarta2`) REFERENCES `cartas` (`idcarta`),
  CONSTRAINT `partidas_preguntas_FK_4` FOREIGN KEY (`idcarta3`) REFERENCES `cartas` (`idcarta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partidas_preguntas`
--

LOCK TABLES `partidas_preguntas` WRITE;
/*!40000 ALTER TABLE `partidas_preguntas` DISABLE KEYS */;
/*!40000 ALTER TABLE `partidas_preguntas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partidas_secreto`
--

DROP TABLE IF EXISTS `partidas_secreto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partidas_secreto` (
  `id_partida_secreto` int(11) NOT NULL AUTO_INCREMENT,
  `id_partida` int(11) DEFAULT NULL,
  `idcarta1` int(11) DEFAULT NULL,
  `idcarta2` int(11) DEFAULT NULL,
  `idcarta3` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_partida_secreto`),
  KEY `partidas_secreto_FK` (`id_partida`),
  KEY `partidas_secreto_FK_2` (`idcarta2`),
  KEY `partidas_secreto_FK_3` (`idcarta3`),
  KEY `partidas_secreto_idcarta1_IDX` (`idcarta1`,`idcarta2`,`idcarta3`,`id_partida`) USING BTREE,
  CONSTRAINT `partidas_secreto_FK` FOREIGN KEY (`id_partida`) REFERENCES `partidas` (`id_partida`),
  CONSTRAINT `partidas_secreto_FK_1` FOREIGN KEY (`idcarta1`) REFERENCES `cartas` (`idcarta`),
  CONSTRAINT `partidas_secreto_FK_2` FOREIGN KEY (`idcarta2`) REFERENCES `cartas` (`idcarta`),
  CONSTRAINT `partidas_secreto_FK_3` FOREIGN KEY (`idcarta3`) REFERENCES `cartas` (`idcarta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partidas_secreto`
--

LOCK TABLES `partidas_secreto` WRITE;
/*!40000 ALTER TABLE `partidas_secreto` DISABLE KEYS */;
/*!40000 ALTER TABLE `partidas_secreto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rel_partida_jugador_cartas`
--

DROP TABLE IF EXISTS `rel_partida_jugador_cartas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rel_partida_jugador_cartas` (
  `id_partida_jugador_cartas` int(11) NOT NULL AUTO_INCREMENT,
  `id_partida` int(11) DEFAULT NULL,
  `id_jugador` int(11) DEFAULT NULL,
  `idcarta1` int(11) DEFAULT NULL,
  `idcarta2` int(11) DEFAULT NULL,
  `idcarta3` int(11) DEFAULT NULL,
  `idcarta4` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `orden_llegada` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_partida_jugador_cartas`),
  KEY `rel_partida_jugador_cartas_FK` (`id_jugador`),
  KEY `rel_partida_jugador_cartas_FK_1` (`id_partida`),
  KEY `rel_partida_jugador_cartas_FK_2` (`idcarta1`),
  KEY `rel_partida_jugador_cartas_FK_3` (`idcarta2`),
  KEY `rel_partida_jugador_cartas_FK_4` (`idcarta3`),
  KEY `rel_partida_jugador_cartas_FK_5` (`idcarta4`),
  CONSTRAINT `rel_partida_jugador_cartas_FK` FOREIGN KEY (`id_jugador`) REFERENCES `jugadores` (`id_jugador`),
  CONSTRAINT `rel_partida_jugador_cartas_FK_1` FOREIGN KEY (`id_partida`) REFERENCES `partidas` (`id_partida`),
  CONSTRAINT `rel_partida_jugador_cartas_FK_2` FOREIGN KEY (`idcarta1`) REFERENCES `cartas` (`idcarta`),
  CONSTRAINT `rel_partida_jugador_cartas_FK_3` FOREIGN KEY (`idcarta2`) REFERENCES `cartas` (`idcarta`),
  CONSTRAINT `rel_partida_jugador_cartas_FK_4` FOREIGN KEY (`idcarta3`) REFERENCES `cartas` (`idcarta`),
  CONSTRAINT `rel_partida_jugador_cartas_FK_5` FOREIGN KEY (`idcarta4`) REFERENCES `cartas` (`idcarta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rel_partida_jugador_cartas`
--

LOCK TABLES `rel_partida_jugador_cartas` WRITE;
/*!40000 ALTER TABLE `rel_partida_jugador_cartas` DISABLE KEYS */;
/*!40000 ALTER TABLE `rel_partida_jugador_cartas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rel_partida_jugador_tablas`
--

DROP TABLE IF EXISTS `rel_partida_jugador_tablas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rel_partida_jugador_tablas` (
  `id_partida_jugador_carta` int(11) NOT NULL AUTO_INCREMENT,
  `id_partida` int(11) DEFAULT NULL,
  `id_jugador` int(11) DEFAULT NULL,
  `idcarta` int(11) DEFAULT NULL,
  `poseedor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_partida_jugador_carta`),
  KEY `rel_partida_jugador_tablas_FK` (`id_partida`),
  KEY `rel_partida_jugador_tablas_FK_1` (`id_jugador`),
  KEY `rel_partida_jugador_tablas_FK_2` (`idcarta`),
  KEY `rel_partida_jugador_tablas_FK_3` (`poseedor_id`),
  CONSTRAINT `rel_partida_jugador_tablas_FK` FOREIGN KEY (`id_partida`) REFERENCES `partidas` (`id_partida`),
  CONSTRAINT `rel_partida_jugador_tablas_FK_1` FOREIGN KEY (`id_jugador`) REFERENCES `jugadores` (`id_jugador`),
  CONSTRAINT `rel_partida_jugador_tablas_FK_2` FOREIGN KEY (`idcarta`) REFERENCES `cartas` (`idcarta`),
  CONSTRAINT `rel_partida_jugador_tablas_FK_3` FOREIGN KEY (`poseedor_id`) REFERENCES `jugadores` (`id_jugador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rel_partida_jugador_tablas`
--

LOCK TABLES `rel_partida_jugador_tablas` WRITE;
/*!40000 ALTER TABLE `rel_partida_jugador_tablas` DISABLE KEYS */;
/*!40000 ALTER TABLE `rel_partida_jugador_tablas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'findbug'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-10-19 16:54:42
