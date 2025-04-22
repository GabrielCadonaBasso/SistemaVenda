CREATE DATABASE  IF NOT EXISTS `sistema` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci */;
USE `sistema`;
-- MySQL dump 10.13  Distrib 8.0.41, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: sistema
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `ID_CL` int(11) NOT NULL AUTO_INCREMENT,
  `NOME_CL` varchar(45) NOT NULL,
  `RG_CL` varchar(15) NOT NULL,
  `CPF_CL` varchar(15) NOT NULL,
  PRIMARY KEY (`ID_CL`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Carlos Eduardo Piccinini','111','22222'),(2,'Gabriel Basso','222222','333333'),(3,'Gean Pavei','333333','444444'),(4,'Danielly Piovezan','444444','555555');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresas` (
  `NOME_EMP` varchar(45) NOT NULL,
  `CNPJ_EMP` int(11) NOT NULL,
  `EMAIL_EMP` varchar(100) NOT NULL,
  `SENHA_EMP` varchar(16) NOT NULL,
  PRIMARY KEY (`CNPJ_EMP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES ('cadu',123,'a@a.c','123'),('147',147,'a@a.c','147');
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionarios` (
  `CPF_FUNC` int(11) NOT NULL,
  `NOME_FUNC` varchar(45) NOT NULL,
  `EMPRESAS_CNPJ_EMP` int(11) NOT NULL,
  PRIMARY KEY (`CPF_FUNC`),
  KEY `fk_FUNCIONARIOS_EMPRESAS1_idx` (`EMPRESAS_CNPJ_EMP`),
  CONSTRAINT `fk_FUNCIONARIOS_EMPRESAS1` FOREIGN KEY (`EMPRESAS_CNPJ_EMP`) REFERENCES `empresas` (`CNPJ_EMP`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios`
--

LOCK TABLES `funcionarios` WRITE;
/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `funcionarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produtos` (
  `ID_PROD` int(11) NOT NULL AUTO_INCREMENT,
  `CODIGO_PROD` int(11) DEFAULT NULL,
  `NOME_PROD` varchar(45) NOT NULL,
  `QUANTIDADE_PROD` varchar(45) NOT NULL,
  `PRECO_PROD` double NOT NULL,
  `FORNECEDOR_PROD` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID_PROD`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,78910,'Quadro Abstrato','10',50,'Gean das Artes'),(2,78911,'Pano de prato bordado','24',5,'Vovó Dani Confecções'),(3,78912,'Caminho de mesa','4',30,'Vovó Dani Confecções'),(4,78913,'Bolsa de tecido artesanal','3',40,'Vovó Dani Confecções'),(5,78914,'Tapete de crochê','6',20,'Gabriel Tecelagem '),(6,78915,'Tela pintada à mão','6',10,'Cadu Artes'),(7,78916,'Suporte para celular de madeira','7',1,'Cadu Artes'),(8,78917,'Kit Xicaras','6',2,'Gean das Artes'),(9,78918,'Porta-joias artesanal','7',3,'Gean das Artes'),(10,78920,'Velas artesanais aromáticas','8',4,'Gean das Artes');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendas`
--

DROP TABLE IF EXISTS `vendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vendas` (
  `ID_VEND` int(11) NOT NULL AUTO_INCREMENT,
  `DATA_VENDA` varchar(45) NOT NULL,
  `CLIENTES_ID_ CL` int(11) NOT NULL,
  `PRODUTOS_ID_PROD` int(11) NOT NULL,
  `FUNCIONARIOS_CPF_FUNC` int(11) NOT NULL,
  PRIMARY KEY (`ID_VEND`),
  KEY `fk_VENDAS_CLIENTES1_idx` (`CLIENTES_ID_ CL`),
  KEY `fk_VENDAS_PRODUTOS1_idx` (`PRODUTOS_ID_PROD`),
  KEY `fk_VENDAS_FUNCIONARIOS1_idx` (`FUNCIONARIOS_CPF_FUNC`),
  CONSTRAINT `fk_VENDAS_CLIENTES1` FOREIGN KEY (`CLIENTES_ID_ CL`) REFERENCES `clientes` (`ID_CL`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_VENDAS_FUNCIONARIOS1` FOREIGN KEY (`FUNCIONARIOS_CPF_FUNC`) REFERENCES `funcionarios` (`CPF_FUNC`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_VENDAS_PRODUTOS1` FOREIGN KEY (`PRODUTOS_ID_PROD`) REFERENCES `produtos` (`ID_PROD`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendas`
--

LOCK TABLES `vendas` WRITE;
/*!40000 ALTER TABLE `vendas` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-04-22 18:51:01
