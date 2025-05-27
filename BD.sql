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
  `RG_CL` varchar(20) NOT NULL,
  `CPF_CL` varchar(20) NOT NULL,
  `EMPRESAS_ID_EMP` int(11) NOT NULL,
  PRIMARY KEY (`ID_CL`),
  KEY `fk_CLIENTES_EMPRESAS1_idx` (`EMPRESAS_ID_EMP`),
  CONSTRAINT `fk_CLIENTES_EMPRESAS1` FOREIGN KEY (`EMPRESAS_ID_EMP`) REFERENCES `empresas` (`ID_EMP`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empresas` (
  `ID_EMP` int(11) NOT NULL AUTO_INCREMENT,
  `CNPJ_EMP` varchar(20) NOT NULL,
  `NOME_EMP` varchar(45) NOT NULL,
  `EMAIL_EMP` varchar(100) NOT NULL,
  `SENHA_EMP` varchar(16) NOT NULL,
  PRIMARY KEY (`ID_EMP`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionarios` (
  `ID_FUNC` int(11) NOT NULL AUTO_INCREMENT,
  `CPF_FUNC` varchar(20) NOT NULL,
  `NOME_FUNC` varchar(45) NOT NULL,
  `EMPRESAS_ID_EMP` int(11) NOT NULL,
  PRIMARY KEY (`ID_FUNC`),
  KEY `fk_FUNCIONARIOS_EMPRESAS1_idx` (`EMPRESAS_ID_EMP`),
  CONSTRAINT `fk_FUNCIONARIOS_EMPRESAS1` FOREIGN KEY (`EMPRESAS_ID_EMP`) REFERENCES `empresas` (`ID_EMP`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios`
--

LOCK TABLES `funcionarios` WRITE;
/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `funcionarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto_cupom`
--

DROP TABLE IF EXISTS `produto_cupom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produto_cupom` (
  `ID_PRODUTO_CUPOM` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PROD` int(11) DEFAULT NULL,
  `NOME_PRODUTO` varchar(45) DEFAULT NULL,
  `QUANT_ITENS` int(11) NOT NULL,
  `PRECO_UN` float unsigned zerofill DEFAULT NULL,
  `PRECO_TOTAL` float DEFAULT NULL,
  `vendas_ID_VEND` int(11) NOT NULL,
  PRIMARY KEY (`ID_PRODUTO_CUPOM`,`vendas_ID_VEND`),
  KEY `fk_produto_cupom_vendas1_idx` (`vendas_ID_VEND`),
  CONSTRAINT `fk_produto_cupom_vendas1` FOREIGN KEY (`vendas_ID_VEND`) REFERENCES `vendas` (`ID_VEND`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto_cupom`
--

LOCK TABLES `produto_cupom` WRITE;
/*!40000 ALTER TABLE `produto_cupom` DISABLE KEYS */;
/*!40000 ALTER TABLE `produto_cupom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produtos` (
  `ID_PROD` int(11) NOT NULL AUTO_INCREMENT,
  `CODIGO_PROD` int(15) DEFAULT NULL,
  `NOME_PROD` varchar(45) NOT NULL,
  `QUANTIDADE_PROD` int(11) NOT NULL,
  `PRECO_PROD` double NOT NULL,
  `FORNECEDOR_PROD` varchar(45) DEFAULT NULL,
  `EMPRESAS_ID_EMP` int(11) NOT NULL,
  PRIMARY KEY (`ID_PROD`),
  KEY `fk_PRODUTOS_EMPRESAS1_idx` (`EMPRESAS_ID_EMP`),
  CONSTRAINT `fk_PRODUTOS_EMPRESAS1` FOREIGN KEY (`EMPRESAS_ID_EMP`) REFERENCES `empresas` (`ID_EMP`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
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
  `DATA_VENDA` datetime NOT NULL,
  `EMPRESAS_ID_EMP` int(11) NOT NULL,
  `CLIENTES_ID_CL` varchar(45) DEFAULT NULL,
  `FUNCIONARIOS_ID_FUNC` varchar(45) DEFAULT NULL,
  `TOTAL_VENDA` float DEFAULT NULL,
  `METODO_PAGAMENTO` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID_VEND`),
  KEY `fk_VENDAS_EMPRESAS_idx` (`EMPRESAS_ID_EMP`),
  KEY `fk_VENDAS_CLIENTES1_idx` (`CLIENTES_ID_CL`),
  KEY `fk_VENDAS_FUNCIONARIOS1_idx` (`FUNCIONARIOS_ID_FUNC`),
  CONSTRAINT `fk_VENDAS_EMPRESAS` FOREIGN KEY (`EMPRESAS_ID_EMP`) REFERENCES `empresas` (`ID_EMP`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
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

-- Dump completed on 2025-05-26 21:29:06
