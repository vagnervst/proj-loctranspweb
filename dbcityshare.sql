-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: dbcityshare
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.19-MariaDB

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
-- Table structure for table `acessorioveiculo_tipoveiculo`
--

DROP TABLE IF EXISTS `acessorioveiculo_tipoveiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `acessorioveiculo_tipoveiculo` (
  `idAcessorio` int(11) NOT NULL,
  `idTipoVeiculo` int(11) NOT NULL,
  KEY `idAcessorio` (`idAcessorio`),
  KEY `idTipoVeiculo` (`idTipoVeiculo`),
  CONSTRAINT `acessorioveiculo_tipoveiculo_ibfk_1` FOREIGN KEY (`idAcessorio`) REFERENCES `tbl_acessorioveiculo` (`id`),
  CONSTRAINT `acessorioveiculo_tipoveiculo_ibfk_2` FOREIGN KEY (`idTipoVeiculo`) REFERENCES `tbl_tipoveiculo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `acessorioveiculo_tipoveiculo`
--

LOCK TABLES `acessorioveiculo_tipoveiculo` WRITE;
/*!40000 ALTER TABLE `acessorioveiculo_tipoveiculo` DISABLE KEYS */;
INSERT INTO `acessorioveiculo_tipoveiculo` VALUES (3,1),(3,25),(3,26),(1,1),(4,1),(4,25),(4,26),(4,27);
/*!40000 ALTER TABLE `acessorioveiculo_tipoveiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fabricanteveiculo_tipoveiculo`
--

DROP TABLE IF EXISTS `fabricanteveiculo_tipoveiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fabricanteveiculo_tipoveiculo` (
  `idFabricante` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  KEY `idFabricante` (`idFabricante`),
  KEY `idTipo` (`idTipo`),
  CONSTRAINT `fabricanteveiculo_tipoveiculo_ibfk_1` FOREIGN KEY (`idFabricante`) REFERENCES `tbl_fabricanteveiculo` (`id`),
  CONSTRAINT `fabricanteveiculo_tipoveiculo_ibfk_2` FOREIGN KEY (`idTipo`) REFERENCES `tbl_tipoveiculo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fabricanteveiculo_tipoveiculo`
--

LOCK TABLES `fabricanteveiculo_tipoveiculo` WRITE;
/*!40000 ALTER TABLE `fabricanteveiculo_tipoveiculo` DISABLE KEYS */;
INSERT INTO `fabricanteveiculo_tipoveiculo` VALUES (3,1),(4,1),(4,25),(4,26),(1,26);
/*!40000 ALTER TABLE `fabricanteveiculo_tipoveiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nivel_acesso_juridico_tela_software`
--

DROP TABLE IF EXISTS `nivel_acesso_juridico_tela_software`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nivel_acesso_juridico_tela_software` (
  `idNivelAcessoJuridico` int(11) NOT NULL,
  `idPermissaoJuridico` int(11) NOT NULL,
  `idTelaSoftware` int(11) NOT NULL,
  KEY `idNivelAcessoJuridico` (`idNivelAcessoJuridico`),
  KEY `idPermissaoJuridico` (`idPermissaoJuridico`),
  KEY `permissao_tela_software` (`idTelaSoftware`),
  CONSTRAINT `nivel_acesso_juridico_tela_software_ibfk_1` FOREIGN KEY (`idNivelAcessoJuridico`) REFERENCES `tbl_nivelacesso_juridico` (`id`),
  CONSTRAINT `nivel_acesso_juridico_tela_software_ibfk_2` FOREIGN KEY (`idPermissaoJuridico`) REFERENCES `tbl_permissao_juridico` (`id`),
  CONSTRAINT `permissao_tela_software` FOREIGN KEY (`idTelaSoftware`) REFERENCES `tbl_tela_software` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivel_acesso_juridico_tela_software`
--

LOCK TABLES `nivel_acesso_juridico_tela_software` WRITE;
/*!40000 ALTER TABLE `nivel_acesso_juridico_tela_software` DISABLE KEYS */;
/*!40000 ALTER TABLE `nivel_acesso_juridico_tela_software` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nivelacesso_permissaocs`
--

DROP TABLE IF EXISTS `nivelacesso_permissaocs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nivelacesso_permissaocs` (
  `idNivelAcesso` int(11) NOT NULL,
  `idPermissao` int(11) NOT NULL,
  `idTelaCS` int(11) NOT NULL,
  KEY `idNivelAcesso` (`idNivelAcesso`),
  KEY `idPermissao` (`idPermissao`),
  CONSTRAINT `nivelacesso_permissaocs_ibfk_1` FOREIGN KEY (`idNivelAcesso`) REFERENCES `tbl_nivelacesso_cs` (`id`),
  CONSTRAINT `nivelacesso_permissaocs_ibfk_2` FOREIGN KEY (`idPermissao`) REFERENCES `tbl_permissao_cs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nivelacesso_permissaocs`
--

LOCK TABLES `nivelacesso_permissaocs` WRITE;
/*!40000 ALTER TABLE `nivelacesso_permissaocs` DISABLE KEYS */;
INSERT INTO `nivelacesso_permissaocs` VALUES (3,7,0),(1,5,0),(1,6,0),(1,7,0),(1,8,0),(1,9,0),(1,10,0),(6,5,0),(6,6,0),(4,5,0);
/*!40000 ALTER TABLE `nivelacesso_permissaocs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publicacao_acessorioveiculo`
--

DROP TABLE IF EXISTS `publicacao_acessorioveiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publicacao_acessorioveiculo` (
  `idPublicacao` int(11) NOT NULL,
  `idAcessorio` int(11) NOT NULL,
  KEY `idPublicacao` (`idPublicacao`),
  KEY `idAcessorio` (`idAcessorio`),
  CONSTRAINT `publicacao_acessorioveiculo_ibfk_1` FOREIGN KEY (`idPublicacao`) REFERENCES `tbl_publicacao` (`id`),
  CONSTRAINT `publicacao_acessorioveiculo_ibfk_2` FOREIGN KEY (`idAcessorio`) REFERENCES `tbl_acessorioveiculo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publicacao_acessorioveiculo`
--

LOCK TABLES `publicacao_acessorioveiculo` WRITE;
/*!40000 ALTER TABLE `publicacao_acessorioveiculo` DISABLE KEYS */;
/*!40000 ALTER TABLE `publicacao_acessorioveiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_acessorioveiculo`
--

DROP TABLE IF EXISTS `tbl_acessorioveiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_acessorioveiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) NOT NULL,
  `visivel` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_acessorioveiculo`
--

LOCK TABLES `tbl_acessorioveiculo` WRITE;
/*!40000 ALTER TABLE `tbl_acessorioveiculo` DISABLE KEYS */;
INSERT INTO `tbl_acessorioveiculo` VALUES (1,'Ar Condicionado',1),(2,'Acessorio B',1),(3,'Acessório C',1),(4,'teste',0);
/*!40000 ALTER TABLE `tbl_acessorioveiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_agencia`
--

DROP TABLE IF EXISTS `tbl_agencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_agencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(30) NOT NULL,
  `telefone` varchar(25) NOT NULL,
  `email` varchar(70) NOT NULL,
  `endereco` varchar(300) NOT NULL,
  `idCidade` int(11) NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `agencia_cidade` (`idCidade`),
  KEY `agencia_empresa_idx` (`idEmpresa`),
  CONSTRAINT `agencia_cidade` FOREIGN KEY (`idCidade`) REFERENCES `tbl_cidade` (`id`),
  CONSTRAINT `agencia_empresa` FOREIGN KEY (`idEmpresa`) REFERENCES `tbl_empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_agencia`
--

LOCK TABLES `tbl_agencia` WRITE;
/*!40000 ALTER TABLE `tbl_agencia` DISABLE KEYS */;
INSERT INTO `tbl_agencia` VALUES (7,'qwe','123','123','123',1,7),(8,'Agencia 1','123','123','123123',1,7);
/*!40000 ALTER TABLE `tbl_agencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_alteracao_pedido`
--

DROP TABLE IF EXISTS `tbl_alteracao_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_alteracao_pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dataOcorrencia` datetime NOT NULL,
  `idStatus` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `historicoAlteracaoPedido_statusPedido` (`idStatus`),
  KEY `pedido_historicoAlteracao` (`idPedido`),
  CONSTRAINT `historicoAlteracaoPedido_statusPedido` FOREIGN KEY (`idStatus`) REFERENCES `tbl_statuspedido` (`id`),
  CONSTRAINT `pedido_historicoAlteracao` FOREIGN KEY (`idPedido`) REFERENCES `tbl_pedido` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=256 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_alteracao_pedido`
--

LOCK TABLES `tbl_alteracao_pedido` WRITE;
/*!40000 ALTER TABLE `tbl_alteracao_pedido` DISABLE KEYS */;
INSERT INTO `tbl_alteracao_pedido` VALUES (246,'2017-05-21 12:45:55',1,27),(247,'2017-05-21 13:01:16',2,27),(248,'2017-05-21 13:04:48',3,27),(249,'2017-05-21 13:07:33',4,27),(250,'2017-05-21 13:07:56',5,27),(251,'2017-05-21 13:15:53',6,27),(253,'2017-05-21 13:16:19',7,27),(254,'2017-05-21 13:22:47',12,27),(255,'2017-05-21 13:22:48',8,27);
/*!40000 ALTER TABLE `tbl_alteracao_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_assunto`
--

DROP TABLE IF EXISTS `tbl_assunto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_assunto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_assunto`
--

LOCK TABLES `tbl_assunto` WRITE;
/*!40000 ALTER TABLE `tbl_assunto` DISABLE KEYS */;
INSERT INTO `tbl_assunto` VALUES (43,'Dúvidas Gerais'),(44,'Sugestão'),(45,'Reportar Problema'),(46,'Outro');
/*!40000 ALTER TABLE `tbl_assunto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_avaliacao`
--

DROP TABLE IF EXISTS `tbl_avaliacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_avaliacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nota` int(1) NOT NULL,
  `mensagem` varchar(200) DEFAULT NULL,
  `data` datetime DEFAULT NULL,
  `idUsuarioAvaliador` int(11) NOT NULL,
  `idUsuarioAvaliado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuarioAvaliador_avaliacao` (`idUsuarioAvaliador`),
  KEY `usuarioAvaliado_avaliacao` (`idUsuarioAvaliado`),
  CONSTRAINT `usuarioAvaliado_avaliacao` FOREIGN KEY (`idUsuarioAvaliado`) REFERENCES `tbl_usuario` (`id`),
  CONSTRAINT `usuarioAvaliador_avaliacao` FOREIGN KEY (`idUsuarioAvaliador`) REFERENCES `tbl_usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_avaliacao`
--

LOCK TABLES `tbl_avaliacao` WRITE;
/*!40000 ALTER TABLE `tbl_avaliacao` DISABLE KEYS */;
INSERT INTO `tbl_avaliacao` VALUES (1,2,'qweqewq',NULL,24,23),(2,5,'Locador muito prestativo. Faria negócio novamente.','2017-05-19 23:56:38',23,24),(3,5,'Locador muito prestativo. Faria negócio novamente.','2017-05-19 23:56:48',23,24),(4,5,'123','2017-05-19 23:58:17',23,24),(5,1,'123','2017-05-19 23:58:45',24,23),(6,1,'qwe','2017-05-20 00:00:26',24,23),(7,5,NULL,'2017-05-20 00:00:56',24,23),(8,2,NULL,'2017-05-20 00:01:07',24,23),(9,4,'123','2017-05-20 00:17:01',23,24),(10,3,'123','2017-05-20 00:17:05',24,23),(11,4,NULL,'2017-05-20 03:00:46',24,23),(12,4,NULL,'2017-05-20 03:04:29',24,23),(13,5,NULL,'2017-05-20 03:15:18',23,24),(14,3,NULL,'2017-05-20 04:05:44',24,23),(15,5,NULL,'2017-05-20 04:06:12',23,24),(16,5,'Excelente cliente','2017-05-20 04:39:53',24,23),(17,5,'123','2017-05-20 04:41:56',23,24),(18,4,'123','2017-05-20 04:42:59',23,24),(19,4,'123','2017-05-20 04:43:09',24,23),(20,4,'123','2017-05-20 04:44:59',24,23),(21,4,'123','2017-05-20 04:45:53',24,23),(22,2,'123','2017-05-20 04:45:58',23,24);
/*!40000 ALTER TABLE `tbl_avaliacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_banco`
--

DROP TABLE IF EXISTS `tbl_banco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_banco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(3) NOT NULL,
  `nome` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qtdDigitosVerificadores` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_banco`
--

LOCK TABLES `tbl_banco` WRITE;
/*!40000 ALTER TABLE `tbl_banco` DISABLE KEYS */;
INSERT INTO `tbl_banco` VALUES (5,123,'Banco A',3);
/*!40000 ALTER TABLE `tbl_banco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_beneficiosprojeto`
--

DROP TABLE IF EXISTS `tbl_beneficiosprojeto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_beneficiosprojeto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(70) NOT NULL,
  `introducao` text NOT NULL,
  `imagemA` varchar(50) DEFAULT NULL,
  `imagemB` varchar(50) DEFAULT NULL,
  `imagemC` varchar(50) DEFAULT NULL,
  `descricaoA` text NOT NULL,
  `descricaoB` text NOT NULL,
  `descricaoC` text NOT NULL,
  `previaImagem` varchar(50) DEFAULT NULL,
  `previaTexto` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_beneficiosprojeto`
--

LOCK TABLES `tbl_beneficiosprojeto` WRITE;
/*!40000 ALTER TABLE `tbl_beneficiosprojeto` DISABLE KEYS */;
INSERT INTO `tbl_beneficiosprojeto` VALUES (1,'Por que utilizar os serviços City Share?','Veja aqui alguns dos benefí­cios que o nosso projeto pode proporcionar:','beneficio\\_imagem\\_A.jpg','beneficio\\_imagem\\_B.jpg','beneficio\\_imagem\\_C.jpg','- Você tem remuneração pelo veículo alugado, pagando apenas uma pequena taxa que varia de acordo com o tipo de veículo cadastrado em nosso sistema.\r\n- Com a facilidade do sistema City Share você poderá¡ cadastrar ou alugar um veículo em questão de minutos, sem nenhuma burocracia envolvida. Mas fique atento aos requisitos mínimos que o seu veículo precisa atender para ser cadastrado.\r\n- Tenha sua agência divulgada caso utilize o sistema City Share na sua empresa.','- Você não paga pelo valor total do veículo, apenas a diária de uso prescrita pelo proprietário do veículo que está alugando.\r\n- Você encontra uma grande variedade de veículos disponí­veis, podendo encontrar um para cada situação.\r\n- Pague somente no momento da retirada, evitando inconveniências.','- Negocie diretamente, o sistema permite uma negociação direta entre usuários, facilitando na transparência e facilitando a transação.\r\n- Transações são seguras, o pagamento por débito auxilia na concretização da negociação, diminuindo em muito as chances de falhas na mesma.\r\n- Com o nosso sistema de filtragem dentro do site encontre o veículo mais próximo de você, evitando longas deslocações até o local da negociação.','beneficio\\_imagem\\_previa.jpg','O projeto City Share traz também benefí­cios para quem o utiliza, sendo alguns deles:\r\nRemuneração pelo veí­culo alugado;\r\nO Sistema dinâmico permite que o veí­culo seja alugado em questão de minutos;\r\nPague somente pelo uso e não pela propriedade do carro.');
/*!40000 ALTER TABLE `tbl_beneficiosprojeto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cartao_credito`
--

DROP TABLE IF EXISTS `tbl_cartao_credito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cartao_credito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vencimento` date DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  `idTipo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idTipo` (`idTipo`),
  CONSTRAINT `tbl_cartao_credito_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbl_usuario` (`id`),
  CONSTRAINT `tbl_cartao_credito_ibfk_2` FOREIGN KEY (`idTipo`) REFERENCES `tbl_tipo_cartao_credito` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cartao_credito`
--

LOCK TABLES `tbl_cartao_credito` WRITE;
/*!40000 ALTER TABLE `tbl_cartao_credito` DISABLE KEYS */;
INSERT INTO `tbl_cartao_credito` VALUES (5,'123','1996-07-17',23,2),(6,'15141619','2033-07-01',26,2),(7,'15141619','2033-07-01',27,2),(8,'15141619','2033-07-01',28,2),(9,'15141619','2033-07-01',29,2),(10,'15141619','2033-07-01',30,2),(11,'15141619','2033-07-01',31,2),(12,'15141619','2033-07-01',32,2),(13,'15141619','2033-07-01',33,2),(14,'15141619','2033-07-01',34,2),(15,'15141619','2033-07-01',35,2),(16,'15141619','2033-07-01',36,2),(17,'123','2017-05-17',37,2);
/*!40000 ALTER TABLE `tbl_cartao_credito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_categoriaveiculo`
--

DROP TABLE IF EXISTS `tbl_categoriaveiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_categoriaveiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) NOT NULL,
  `percentualLucro` decimal(5,2) NOT NULL,
  `valorMinimoVeiculo` decimal(9,2) DEFAULT '0.00',
  `idTipoVeiculo` int(11) NOT NULL,
  `visivel` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `tipoVeiculo_categoriaVeiculo` (`idTipoVeiculo`),
  CONSTRAINT `tipoVeiculo_categoriaVeiculo` FOREIGN KEY (`idTipoVeiculo`) REFERENCES `tbl_tipoveiculo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categoriaveiculo`
--

LOCK TABLES `tbl_categoriaveiculo` WRITE;
/*!40000 ALTER TABLE `tbl_categoriaveiculo` DISABLE KEYS */;
INSERT INTO `tbl_categoriaveiculo` VALUES (1,'Luxo',25.00,30000.00,1,1),(2,'Categoria A',15.00,1000.00,25,1),(13,'Esportivas',0.00,0.00,26,1),(14,'Domésticas',0.00,0.00,26,1),(15,'Passeio Popular',0.00,0.00,1,1),(16,'123',0.00,0.00,26,0);
/*!40000 ALTER TABLE `tbl_categoriaveiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cidade`
--

DROP TABLE IF EXISTS `tbl_cidade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cidade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `idEstado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cidade_estado` (`idEstado`),
  CONSTRAINT `cidade_estado` FOREIGN KEY (`idEstado`) REFERENCES `tbl_estado` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cidade`
--

LOCK TABLES `tbl_cidade` WRITE;
/*!40000 ALTER TABLE `tbl_cidade` DISABLE KEYS */;
INSERT INTO `tbl_cidade` VALUES (1,'Carapicuiba',1);
/*!40000 ALTER TABLE `tbl_cidade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cityshare`
--

DROP TABLE IF EXISTS `tbl_cityshare`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cityshare` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `saldo` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cityshare`
--

LOCK TABLES `tbl_cityshare` WRITE;
/*!40000 ALTER TABLE `tbl_cityshare` DISABLE KEYS */;
INSERT INTO `tbl_cityshare` VALUES (1,0);
/*!40000 ALTER TABLE `tbl_cityshare` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cnh`
--

DROP TABLE IF EXISTS `tbl_cnh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_cnh` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numeroRegistro` int(11) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_cnh` (`idUsuario`),
  CONSTRAINT `usuario_cnh` FOREIGN KEY (`idUsuario`) REFERENCES `tbl_usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cnh`
--

LOCK TABLES `tbl_cnh` WRITE;
/*!40000 ALTER TABLE `tbl_cnh` DISABLE KEYS */;
INSERT INTO `tbl_cnh` VALUES (5,123,23),(6,15474849,26),(7,15474849,27),(8,15474849,28),(9,15474849,29),(10,15474849,30),(11,15474849,31),(12,15474849,32),(13,15474849,33),(14,15474849,34),(15,15474849,35),(16,15474849,36);
/*!40000 ALTER TABLE `tbl_cnh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_conta_bancaria`
--

DROP TABLE IF EXISTS `tbl_conta_bancaria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_conta_bancaria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numeroAgencia` int(10) DEFAULT NULL,
  `conta` int(15) DEFAULT NULL,
  `digito` int(1) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  `idTipoConta` int(11) NOT NULL,
  `idBanco` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idTipoConta` (`idTipoConta`),
  KEY `tbl_conta_bancaria_ibfk_3_idx` (`idBanco`),
  CONSTRAINT `tbl_conta_bancaria_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `tbl_usuario` (`id`),
  CONSTRAINT `tbl_conta_bancaria_ibfk_2` FOREIGN KEY (`idTipoConta`) REFERENCES `tbl_tipo_conta_bancaria` (`id`),
  CONSTRAINT `tbl_conta_bancaria_ibfk_3` FOREIGN KEY (`idBanco`) REFERENCES `tbl_banco` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_conta_bancaria`
--

LOCK TABLES `tbl_conta_bancaria` WRITE;
/*!40000 ALTER TABLE `tbl_conta_bancaria` DISABLE KEYS */;
INSERT INTO `tbl_conta_bancaria` VALUES (1,8850,8850,5,24,1,5);
/*!40000 ALTER TABLE `tbl_conta_bancaria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_contato`
--

DROP TABLE IF EXISTS `tbl_contato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_contato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(120) NOT NULL,
  `email` varchar(70) NOT NULL,
  `mensagem` varchar(400) NOT NULL,
  `idAssunto` int(11) NOT NULL,
  `resposta` varchar(200) DEFAULT NULL,
  `respondido` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `faleConosco_assunto` (`idAssunto`),
  CONSTRAINT `faleConosco_assunto` FOREIGN KEY (`idAssunto`) REFERENCES `tbl_assunto` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_contato`
--

LOCK TABLES `tbl_contato` WRITE;
/*!40000 ALTER TABLE `tbl_contato` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_contato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_deposito`
--

DROP TABLE IF EXISTS `tbl_deposito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_deposito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valor` decimal(5,2) NOT NULL,
  `quando` datetime NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_saque` (`idUsuario`),
  CONSTRAINT `usuario_saque` FOREIGN KEY (`idUsuario`) REFERENCES `tbl_usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_deposito`
--

LOCK TABLES `tbl_deposito` WRITE;
/*!40000 ALTER TABLE `tbl_deposito` DISABLE KEYS */;
INSERT INTO `tbl_deposito` VALUES (1,637.50,'2017-05-19 03:48:02',24),(2,999.99,'2017-05-20 07:50:07',24),(3,999.99,'2017-05-20 07:51:06',24),(4,999.99,'2017-05-20 07:51:08',24),(5,999.99,'2017-05-20 07:51:11',24),(6,999.99,'2017-05-20 07:51:39',24);
/*!40000 ALTER TABLE `tbl_deposito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_empresa`
--

DROP TABLE IF EXISTS `tbl_empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_empresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomeHost` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razaoSocial` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomeFantasia` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnpj` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logomarca` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idUsuarioJuridico` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `CNPJ_UNIQUE` (`cnpj`),
  UNIQUE KEY `codigoIdentificacao` (`nomeHost`),
  KEY `idUsuarioJuridico` (`idUsuarioJuridico`),
  CONSTRAINT `tbl_empresa_ibfk_1` FOREIGN KEY (`idUsuarioJuridico`) REFERENCES `tbl_usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_empresa`
--

LOCK TABLES `tbl_empresa` WRITE;
/*!40000 ALTER TABLE `tbl_empresa` DISABLE KEYS */;
INSERT INTO `tbl_empresa` VALUES (7,'companyhost','Razão Social','Empresa','1234.5678.9101','person-flat.png',24);
/*!40000 ALTER TABLE `tbl_empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_empreste`
--

DROP TABLE IF EXISTS `tbl_empreste`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_empreste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(70) NOT NULL,
  `descricao` text NOT NULL,
  `imagemA` varchar(50) DEFAULT NULL,
  `tituloA` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_empreste`
--

LOCK TABLES `tbl_empreste` WRITE;
/*!40000 ALTER TABLE `tbl_empreste` DISABLE KEYS */;
INSERT INTO `tbl_empreste` VALUES (1,'Quer lucrar com seu veículo?','Lucrar com seu veículo aqui na City Share é fácil e prático, nosso sistema foi desenvolvido especialmente para facilitar esse processo para você usuário, mas tenha em mente que existem também critérios a serem seguidos. Entenda melhor o processo de cadastro.','logo\\_eita\\_2.jpg','Como funciona?');
/*!40000 ALTER TABLE `tbl_empreste` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_estado`
--

DROP TABLE IF EXISTS `tbl_estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) NOT NULL,
  `idPais` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `estado_pais` (`idPais`),
  CONSTRAINT `estado_pais` FOREIGN KEY (`idPais`) REFERENCES `tbl_pais` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_estado`
--

LOCK TABLES `tbl_estado` WRITE;
/*!40000 ALTER TABLE `tbl_estado` DISABLE KEYS */;
INSERT INTO `tbl_estado` VALUES (1,'Sao Paulo',1);
/*!40000 ALTER TABLE `tbl_estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_fabricanteveiculo`
--

DROP TABLE IF EXISTS `tbl_fabricanteveiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_fabricanteveiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `visivel` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_fabricanteveiculo`
--

LOCK TABLES `tbl_fabricanteveiculo` WRITE;
/*!40000 ALTER TABLE `tbl_fabricanteveiculo` DISABLE KEYS */;
INSERT INTO `tbl_fabricanteveiculo` VALUES (1,'Caloy',1),(3,'Fabricante A',1),(4,'Fabricante C',1),(5,'teste',0);
/*!40000 ALTER TABLE `tbl_fabricanteveiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_faleconosco`
--

DROP TABLE IF EXISTS `tbl_faleconosco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_faleconosco` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tituloA` varchar(70) DEFAULT NULL,
  `tituloB` varchar(70) DEFAULT NULL,
  `descricaoA` varchar(70) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `horarioAtendimento` varchar(20) DEFAULT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_faleconosco`
--

LOCK TABLES `tbl_faleconosco` WRITE;
/*!40000 ALTER TABLE `tbl_faleconosco` DISABLE KEYS */;
INSERT INTO `tbl_faleconosco` VALUES (1,'Fale Conosco','Perguntas Frequentes','Não sanou sua dúvida? Contate-nos!','contato@cityshare.com.br','(11) 3061-5678','Das 09h às 18h','Rua Gustavo da Silveira, 23 - Vila Santa Catarina CEP 04376-002 - São Paulo/SP');
/*!40000 ALTER TABLE `tbl_faleconosco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_formapagamento`
--

DROP TABLE IF EXISTS `tbl_formapagamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_formapagamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_formapagamento`
--

LOCK TABLES `tbl_formapagamento` WRITE;
/*!40000 ALTER TABLE `tbl_formapagamento` DISABLE KEYS */;
INSERT INTO `tbl_formapagamento` VALUES (1,'Cartão de Crédito'),(2,'Dinheiro');
/*!40000 ALTER TABLE `tbl_formapagamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_funcionario`
--

DROP TABLE IF EXISTS `tbl_funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_funcionario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(120) NOT NULL,
  `credencial` varchar(50) NOT NULL,
  `senha` varchar(70) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `statusOnline` tinyint(4) NOT NULL DEFAULT '0',
  `idNivelAcesso` int(11) NOT NULL,
  `idAgencia` int(11) NOT NULL,
  `idEmpresa` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `funcionario_nivelAcesso` (`idNivelAcesso`),
  KEY `funcionario_agencia` (`idAgencia`),
  KEY `funcionario_empresa_idx` (`idEmpresa`),
  CONSTRAINT `funcionario_agencia` FOREIGN KEY (`idAgencia`) REFERENCES `tbl_agencia` (`id`),
  CONSTRAINT `funcionario_empresa` FOREIGN KEY (`idEmpresa`) REFERENCES `tbl_empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `funcionario_nivelAcesso` FOREIGN KEY (`idNivelAcesso`) REFERENCES `tbl_nivelacesso_juridico` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_funcionario`
--

LOCK TABLES `tbl_funcionario` WRITE;
/*!40000 ALTER TABLE `tbl_funcionario` DISABLE KEYS */;
INSERT INTO `tbl_funcionario` VALUES (3,'funcionario','funcionario@companyhost','$2y$10$.90KFtEFG0JShexr1FJdvuDzih5jSfv.cw/vPFDVhKEhD3LsF5PYu','123','123','a@a.com',0,17,8,7);
/*!40000 ALTER TABLE `tbl_funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_home`
--

DROP TABLE IF EXISTS `tbl_home`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_home` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(70) NOT NULL,
  `imagemA` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_home`
--

LOCK TABLES `tbl_home` WRITE;
/*!40000 ALTER TABLE `tbl_home` DISABLE KEYS */;
INSERT INTO `tbl_home` VALUES (1,'Como alugar?','logo\\_eita\\_1.jpg');
/*!40000 ALTER TABLE `tbl_home` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_itenspedido`
--

DROP TABLE IF EXISTS `tbl_itenspedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_itenspedido` (
  `idPedido` int(11) NOT NULL,
  `idVeiculo` int(11) NOT NULL,
  KEY `pedido_itensPedido` (`idPedido`),
  KEY `veiculo_itensPedido` (`idVeiculo`),
  CONSTRAINT `pedido_itensPedido` FOREIGN KEY (`idPedido`) REFERENCES `tbl_pedido` (`id`),
  CONSTRAINT `veiculo_itensPedido` FOREIGN KEY (`idVeiculo`) REFERENCES `tbl_veiculo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_itenspedido`
--

LOCK TABLES `tbl_itenspedido` WRITE;
/*!40000 ALTER TABLE `tbl_itenspedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_itenspedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_licencadesktop`
--

DROP TABLE IF EXISTS `tbl_licencadesktop`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_licencadesktop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `conexoesSimultaneas` int(6) NOT NULL,
  `preco` decimal(7,2) NOT NULL,
  `duracaoMeses` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_licencadesktop`
--

LOCK TABLES `tbl_licencadesktop` WRITE;
/*!40000 ALTER TABLE `tbl_licencadesktop` DISABLE KEYS */;
INSERT INTO `tbl_licencadesktop` VALUES (1,'Basico',50,100.00,1);
/*!40000 ALTER TABLE `tbl_licencadesktop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mes`
--

DROP TABLE IF EXISTS `tbl_mes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_mes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mes` int(2) NOT NULL,
  `titulo` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mes`
--

LOCK TABLES `tbl_mes` WRITE;
/*!40000 ALTER TABLE `tbl_mes` DISABLE KEYS */;
INSERT INTO `tbl_mes` VALUES (1,1,'Janeiro'),(2,2,'Fevereiro'),(3,3,'Março'),(4,4,'Abril'),(5,5,'Maio'),(6,6,'Junho'),(7,7,'Julho'),(8,8,'Agosto'),(9,9,'Setembro'),(10,10,'Outubro'),(11,11,'Novembro'),(12,12,'Dezembro');
/*!40000 ALTER TABLE `tbl_mes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_modulo_cs`
--

DROP TABLE IF EXISTS `tbl_modulo_cs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_modulo_cs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_modulo_cs`
--

LOCK TABLES `tbl_modulo_cs` WRITE;
/*!40000 ALTER TABLE `tbl_modulo_cs` DISABLE KEYS */;
INSERT INTO `tbl_modulo_cs` VALUES (1,'Clientes'),(2,'City Share'),(3,'Desktop');
/*!40000 ALTER TABLE `tbl_modulo_cs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_nivelacesso_cs`
--

DROP TABLE IF EXISTS `tbl_nivelacesso_cs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_nivelacesso_cs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) NOT NULL,
  `visivel` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nivelacesso_cs`
--

LOCK TABLES `tbl_nivelacesso_cs` WRITE;
/*!40000 ALTER TABLE `tbl_nivelacesso_cs` DISABLE KEYS */;
INSERT INTO `tbl_nivelacesso_cs` VALUES (1,'Administrador',1),(3,'Editor de Conteúdo',1),(4,'Gerenciador de Clientes',1),(5,'Administrador de Desktop',1),(6,'123',0);
/*!40000 ALTER TABLE `tbl_nivelacesso_cs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_nivelacesso_juridico`
--

DROP TABLE IF EXISTS `tbl_nivelacesso_juridico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_nivelacesso_juridico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(40) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nivelacesso_juridico`
--

LOCK TABLES `tbl_nivelacesso_juridico` WRITE;
/*!40000 ALTER TABLE `tbl_nivelacesso_juridico` DISABLE KEYS */;
INSERT INTO `tbl_nivelacesso_juridico` VALUES (17,'Administrador',24);
/*!40000 ALTER TABLE `tbl_nivelacesso_juridico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_notificacao`
--

DROP TABLE IF EXISTS `tbl_notificacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_notificacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mensagem` varchar(100) NOT NULL,
  `idUsuarioRemetente` int(11) DEFAULT NULL,
  `idUsuarioDestinatario` int(11) DEFAULT NULL,
  `idPedido` int(11) DEFAULT NULL,
  `idAvaliacao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuarioRemetente_notificacao` (`idUsuarioRemetente`),
  KEY `usuarioDestinatario_notificacao` (`idUsuarioDestinatario`),
  KEY `notificacao_pedido` (`idPedido`),
  KEY `notificacao_avaliacao` (`idAvaliacao`),
  CONSTRAINT `notificacao_avaliacao` FOREIGN KEY (`idAvaliacao`) REFERENCES `tbl_avaliacao` (`id`),
  CONSTRAINT `notificacao_pedido` FOREIGN KEY (`idPedido`) REFERENCES `tbl_pedido` (`id`),
  CONSTRAINT `usuarioDestinatario_notificacao` FOREIGN KEY (`idUsuarioDestinatario`) REFERENCES `tbl_usuario` (`id`),
  CONSTRAINT `usuarioRemetente_notificacao` FOREIGN KEY (`idUsuarioRemetente`) REFERENCES `tbl_usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_notificacao`
--

LOCK TABLES `tbl_notificacao` WRITE;
/*!40000 ALTER TABLE `tbl_notificacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_notificacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pais`
--

DROP TABLE IF EXISTS `tbl_pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pais`
--

LOCK TABLES `tbl_pais` WRITE;
/*!40000 ALTER TABLE `tbl_pais` DISABLE KEYS */;
INSERT INTO `tbl_pais` VALUES (1,'Brasil');
/*!40000 ALTER TABLE `tbl_pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pedido`
--

DROP TABLE IF EXISTS `tbl_pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `valorDiaria` decimal(5,2) DEFAULT '0.00',
  `valorCombustivel` decimal(4,2) DEFAULT '0.00',
  `valorQuilometragem` decimal(4,2) DEFAULT '0.00',
  `dataRetirada` datetime DEFAULT NULL,
  `dataEntrega` datetime DEFAULT NULL,
  `dataEntregaEfetuada` datetime DEFAULT NULL,
  `localRetiradaLocador` tinyint(1) DEFAULT '0',
  `localDevolucaoLocador` tinyint(1) DEFAULT '0',
  `localRetiradaLocatario` tinyint(1) DEFAULT '0',
  `localDevolucaoLocatario` tinyint(1) DEFAULT '0',
  `solicitacaoRetiradaLocador` tinyint(1) DEFAULT '0',
  `solicitacaoDevolucaoLocador` tinyint(1) DEFAULT '0',
  `solicitacaoRetiradaLocatario` tinyint(1) DEFAULT '0',
  `solicitacaoDevolucaoLocatario` tinyint(1) DEFAULT '0',
  `pagamentoPendenciaLocador` tinyint(1) DEFAULT '0',
  `pagamentoPendenciaLocatario` tinyint(1) DEFAULT '0',
  `locadorAvaliado` tinyint(1) DEFAULT '0',
  `locatarioAvaliado` tinyint(1) DEFAULT '0',
  `combustivelRestante` decimal(4,1) DEFAULT '0.0',
  `quilometragemExcedida` int(5) DEFAULT '0',
  `limiteQuilometragem` int(5) DEFAULT '0',
  `idPublicacao` int(11) NOT NULL,
  `idUsuarioLocador` int(11) NOT NULL,
  `idUsuarioLocatario` int(11) NOT NULL,
  `idStatusPedido` int(11) NOT NULL,
  `idTipoPedido` int(11) NOT NULL,
  `idFormaPagamento` int(11) NOT NULL,
  `idFormaPagamentoPendencias` int(11) DEFAULT NULL,
  `idFuncionario` int(11) DEFAULT NULL,
  `idCnh` int(11) NOT NULL,
  `idVeiculo` int(11) NOT NULL,
  `idAgencia` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedido_publicacao` (`idPublicacao`),
  KEY `pedido_usuarioLocatario` (`idUsuarioLocatario`),
  KEY `pedido_statusPedido` (`idStatusPedido`),
  KEY `pedido_tipoPedido` (`idTipoPedido`),
  KEY `pedido_formaPagamento` (`idFormaPagamento`),
  KEY `pedido_funcionario` (`idFuncionario`),
  KEY `pedido_cnd_idx` (`idCnh`),
  KEY `pedido_veiculo_idx` (`idVeiculo`),
  KEY `pedido_usuarioLocador_idx` (`idUsuarioLocador`),
  KEY `pedido_formaPagamentoPendencias_idx` (`idFormaPagamentoPendencias`),
  KEY `pedido_agencia_idx` (`idAgencia`),
  CONSTRAINT `pedido_agencia` FOREIGN KEY (`idAgencia`) REFERENCES `tbl_agencia` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `pedido_cnd` FOREIGN KEY (`idCnh`) REFERENCES `tbl_cnh` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `pedido_formaPagamento` FOREIGN KEY (`idFormaPagamento`) REFERENCES `tbl_formapagamento` (`id`),
  CONSTRAINT `pedido_formaPagamentoPendencias` FOREIGN KEY (`idFormaPagamentoPendencias`) REFERENCES `tbl_formapagamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `pedido_funcionario` FOREIGN KEY (`idFuncionario`) REFERENCES `tbl_funcionario` (`id`),
  CONSTRAINT `pedido_publicacao` FOREIGN KEY (`idPublicacao`) REFERENCES `tbl_publicacao` (`id`),
  CONSTRAINT `pedido_statusPedido` FOREIGN KEY (`idStatusPedido`) REFERENCES `tbl_statuspedido` (`id`),
  CONSTRAINT `pedido_tipoPedido` FOREIGN KEY (`idTipoPedido`) REFERENCES `tbl_tipopedido` (`id`),
  CONSTRAINT `pedido_usuarioLocador` FOREIGN KEY (`idUsuarioLocador`) REFERENCES `tbl_usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `pedido_usuarioLocatario` FOREIGN KEY (`idUsuarioLocatario`) REFERENCES `tbl_usuario` (`id`),
  CONSTRAINT `pedido_veiculo` FOREIGN KEY (`idVeiculo`) REFERENCES `tbl_veiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pedido`
--

LOCK TABLES `tbl_pedido` WRITE;
/*!40000 ALTER TABLE `tbl_pedido` DISABLE KEYS */;
INSERT INTO `tbl_pedido` VALUES (27,37.50,2.30,4.70,'2017-05-21 16:30:15','2017-05-29 12:45:15','2017-05-21 13:15:29',1,1,1,1,1,1,1,1,0,0,0,0,6.0,0,0,8,24,23,8,1,1,NULL,NULL,5,190,NULL);
/*!40000 ALTER TABLE `tbl_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_percentual_lucro`
--

DROP TABLE IF EXISTS `tbl_percentual_lucro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_percentual_lucro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `percentual` decimal(5,2) DEFAULT NULL,
  `valorMinimo` decimal(9,2) DEFAULT NULL,
  `idCategoria` int(11) DEFAULT NULL,
  `idTipoVeiculo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_percentual_lucro_ibfk_1` (`idCategoria`),
  KEY `tbl_percentual_lucro_ibfk_2` (`idTipoVeiculo`),
  CONSTRAINT `tbl_percentual_lucro_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `tbl_categoriaveiculo` (`id`),
  CONSTRAINT `tbl_percentual_lucro_ibfk_2` FOREIGN KEY (`idTipoVeiculo`) REFERENCES `tbl_tipoveiculo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_percentual_lucro`
--

LOCK TABLES `tbl_percentual_lucro` WRITE;
/*!40000 ALTER TABLE `tbl_percentual_lucro` DISABLE KEYS */;
INSERT INTO `tbl_percentual_lucro` VALUES (1,7.50,NULL,14,26);
/*!40000 ALTER TABLE `tbl_percentual_lucro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_perguntasfrequentes`
--

DROP TABLE IF EXISTS `tbl_perguntasfrequentes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_perguntasfrequentes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pergunta` varchar(100) NOT NULL,
  `resposta` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_perguntasfrequentes`
--

LOCK TABLES `tbl_perguntasfrequentes` WRITE;
/*!40000 ALTER TABLE `tbl_perguntasfrequentes` DISABLE KEYS */;
INSERT INTO `tbl_perguntasfrequentes` VALUES (3,'Aonde devo ir para pegar o veículo? ','A retirada do carro deve ser combinada com o proprietário, fica a critério de ambos escolherem um local favorável para retirada do veículo. '),(4,'Como é feito o pagamento?','O pagamento deve ser feito em conjunto com a retirada do veículo no local combinado para evitar inconveniências à ambos os negociantes.'),(5,'Quem é responsável pelo combustível durante a locação?','É imprescindível que o usuário que alugou o veículo o devolva com o tanque cheio assim como foi entregue, caso esse critério não seja cumprido, o valor complementar do combustível será cobrado como taxa no momento da devolução.'),(6,'Eu preciso avaliar o proprietário do carro após o aluguel?','Após devolver o carro, ambos os usuários (Proprietário e Condutor) poderão avaliar a experiência que tiveram com a transação. Essa avaliação será disponibilizada no perfil do usuário e servirá como base para as transações futuras do usuário no site da City Share.'),(7,'Um familiar/amigo também pode dirigir o carro durante a locação?','Sim, você pode cadastrar outras CNH caso não esteja apto a dirigir, mas tenha em mente que as CNH extras cadastradas devem estar válidas e sem qualquer restrição de uso.'),(8,'O que acontece se eu atrasar para devolver o carro?','Existe uma pequena taxa de atraso acumulativa a qual deve ser paga caso o veículo não seja entregue no dia e local combinados. Porém damos ao usuário uma tolerância de no máximo 30 minutos depois do prazo, após isso a taxa será aplicada.'),(9,'Eu serei cobrado caso a minha solicitação de reserva não seja aceita pelo proprietário?','Não. Já que o pagamento da diária ocorre no momento da retirada, você não será cobrado previamente pelo veículo alugado.'),(10,'Como entro em contato com o proprietário do veículo?','Após enviar uma solicitação de aluguel para o proprietário, o mesmo deverá confirmá-la caso queira realmente alugar o veículo. Quando confirmada, ambos, proprietário e usuário receberão os dados para entrar em contato um com o outro.');
/*!40000 ALTER TABLE `tbl_perguntasfrequentes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_permissao_cs`
--

DROP TABLE IF EXISTS `tbl_permissao_cs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_permissao_cs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_permissao_cs`
--

LOCK TABLES `tbl_permissao_cs` WRITE;
/*!40000 ALTER TABLE `tbl_permissao_cs` DISABLE KEYS */;
INSERT INTO `tbl_permissao_cs` VALUES (5,'Usuario'),(6,'Planos de Conta'),(7,'Conteudo'),(8,'Níveis de Acesso'),(9,'Administradores'),(10,'Veículos');
/*!40000 ALTER TABLE `tbl_permissao_cs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_permissao_juridico`
--

DROP TABLE IF EXISTS `tbl_permissao_juridico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_permissao_juridico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_permissao_juridico`
--

LOCK TABLES `tbl_permissao_juridico` WRITE;
/*!40000 ALTER TABLE `tbl_permissao_juridico` DISABLE KEYS */;
INSERT INTO `tbl_permissao_juridico` VALUES (1,'Leitura'),(2,'Escrita'),(3,'Edição'),(4,'Remoção');
/*!40000 ALTER TABLE `tbl_permissao_juridico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_permissaoconta`
--

DROP TABLE IF EXISTS `tbl_permissaoconta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_permissaoconta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_permissaoconta`
--

LOCK TABLES `tbl_permissaoconta` WRITE;
/*!40000 ALTER TABLE `tbl_permissaoconta` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_permissaoconta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_planoconta`
--

DROP TABLE IF EXISTS `tbl_planoconta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_planoconta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) NOT NULL,
  `preco` decimal(6,2) NOT NULL,
  `duracaoMeses` int(11) NOT NULL,
  `limitePublicacao` int(2) NOT NULL,
  `diasAnalisePublicacao` int(2) NOT NULL,
  `descPlano` varchar(500) NOT NULL,
  `visivel` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_planoconta`
--

LOCK TABLES `tbl_planoconta` WRITE;
/*!40000 ALTER TABLE `tbl_planoconta` DISABLE KEYS */;
INSERT INTO `tbl_planoconta` VALUES (1,'Padrao',0.00,0,5,7,'123',1),(2,'Plano Padrão Jurídico',0.00,0,5,7,'123',0);
/*!40000 ALTER TABLE `tbl_planoconta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_publicacao`
--

DROP TABLE IF EXISTS `tbl_publicacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_publicacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `descricao` varchar(400) NOT NULL,
  `valorDiaria` decimal(5,2) NOT NULL,
  `valorCombustivel` decimal(4,2) NOT NULL,
  `valorQuilometragem` decimal(4,2) DEFAULT NULL,
  `quilometragemAtual` int(5) NOT NULL,
  `limiteQuilometragem` int(5) NOT NULL,
  `dataPublicacao` datetime NOT NULL,
  `imagemPrincipal` varchar(40) DEFAULT NULL,
  `precoMedio` decimal(9,2) NOT NULL,
  `imagemA` varchar(40) DEFAULT NULL,
  `imagemB` varchar(40) DEFAULT NULL,
  `imagemC` varchar(40) DEFAULT NULL,
  `imagemD` varchar(40) DEFAULT NULL,
  `disponivelOnline` tinyint(1) NOT NULL,
  `idStatusPublicacao` int(11) NOT NULL,
  `idAgencia` int(11) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  `idFuncionario` int(11) DEFAULT NULL,
  `idVeiculo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `publicacao_statusPublicacao` (`idStatusPublicacao`),
  KEY `publicacao_agencia` (`idAgencia`),
  KEY `publicacao_usuario` (`idUsuario`),
  KEY `publicacao_funcionario` (`idFuncionario`),
  KEY `publicacao_veiculo_idx` (`idVeiculo`),
  CONSTRAINT `publicacao_agencia` FOREIGN KEY (`idAgencia`) REFERENCES `tbl_agencia` (`id`),
  CONSTRAINT `publicacao_funcionario` FOREIGN KEY (`idFuncionario`) REFERENCES `tbl_funcionario` (`id`),
  CONSTRAINT `publicacao_statusPublicacao` FOREIGN KEY (`idStatusPublicacao`) REFERENCES `tbl_statuspublicacao` (`id`),
  CONSTRAINT `publicacao_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `tbl_usuario` (`id`),
  CONSTRAINT `publicacao_veiculo` FOREIGN KEY (`idVeiculo`) REFERENCES `tbl_veiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_publicacao`
--

LOCK TABLES `tbl_publicacao` WRITE;
/*!40000 ALTER TABLE `tbl_publicacao` DISABLE KEYS */;
INSERT INTO `tbl_publicacao` VALUES (7,'Bicicleta em Ótimo Estado!','123',123.00,99.99,99.99,123,123,'0000-00-00 00:00:00','post\\_7\\_imagem\\_principal.jpg',0.00,'post\\_7\\_imagem\\_a.jpg','post\\_7\\_imagem\\_b.jpg','post\\_7\\_imagem\\_c.jpg','post\\_7\\_imagem\\_d.jpg',0,2,NULL,24,NULL,188),(8,'Tesla S 2016 em Perfeito Estado!','',37.50,2.30,4.70,5000,5000,'0000-00-00 00:00:00',NULL,0.00,NULL,NULL,NULL,NULL,0,3,NULL,24,NULL,190);
/*!40000 ALTER TABLE `tbl_publicacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sexo`
--

DROP TABLE IF EXISTS `tbl_sexo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sexo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sexo`
--

LOCK TABLES `tbl_sexo` WRITE;
/*!40000 ALTER TABLE `tbl_sexo` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_sexo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sobreempresa`
--

DROP TABLE IF EXISTS `tbl_sobreempresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sobreempresa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(70) NOT NULL,
  `introducao` text NOT NULL,
  `imagemA` varchar(50) DEFAULT NULL,
  `tituloA` varchar(50) NOT NULL,
  `descricaoA` text NOT NULL,
  `imagemB` varchar(50) DEFAULT NULL,
  `tituloB` varchar(50) NOT NULL,
  `descricaoB` text NOT NULL,
  `previaTexto` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sobreempresa`
--

LOCK TABLES `tbl_sobreempresa` WRITE;
/*!40000 ALTER TABLE `tbl_sobreempresa` DISABLE KEYS */;
INSERT INTO `tbl_sobreempresa` VALUES (1,'Sobre a Empresa','O Projeto City Share só foi possível por conta da parceria entre duas empresas, que trabalharam em conjunto para trazer essa solução até você! Conheça aqui um pouco sobre ambas as empresas envolvidas:','sobre\\_empresa\\_img\\_A.jpg','City Share','A empresa City Share é uma empresa de iniciativa privada que atua em parceria com prefeituras em todo o território nacional com o objetivo de auxiliar as prefeituras em projetos de mobilidade e urbanismo. Dentre os projetos que a empresa atuou podemos citar três, que são eles: Bicicletários,  Miniparques em vagas de rua e Espaços de convivência, gastronomia e arte. Com 5 anos de vida, a City Share tem ganhado espaço no mercado com seus projetos inovadores e parceirias duradouras. Sua trajetória conta com os mais diversos projetos desenvolvidos para melhorias em municípios, todos muito bem implantados, e isso trouxe a confiança dos clientes até a City Share, que a cada dia conquista mais espaço no ramo.','sobre\\_empresa\\_img\\_B.png','E.I.T.A.','Originário da Nova Zelândia, O grupo E.I.T.A. foi fundado por três pessoas que compartilhavam do mesmo ideal, desenvolver soluções para problemas. A empresa começou como uma simples agência de soluções e hoje é uma das líderes de mercado de desenvolvimento de softwares. Atuando há mais de 10 anos no mercado, a E.I.T.A. soluções é conhecida pela fidelização dos seus clientes destacando-se assim das demais empresas do ramo. Em seus 11 anos de vida, a E.I.T.A. tem expandido cada vez mais seu negócio, tendo filiais espalhadas pela Europa e Américas. Sua filial no Brasil, já está há 3 anos atuando no mercado. A equipe da E.I.T.A. já conta com mais de 1000 funcionários por filial onde pelo menos 300 deles atuam na área de TI, O foco atual da empresa.','O Projeto City Share só foi possível por conta da parceria entre duas empresas, que trabalharam em conjunto para trazer essa solução até você! Conheça aqui um pouco sobre ambas as empresas envolvidas');
/*!40000 ALTER TABLE `tbl_sobreempresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sobreprojeto`
--

DROP TABLE IF EXISTS `tbl_sobreprojeto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sobreprojeto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(70) NOT NULL,
  `conteudo` text NOT NULL,
  `imagemA` varchar(50) DEFAULT NULL,
  `imagemB` varchar(50) DEFAULT NULL,
  `descricaoA` text NOT NULL,
  `descricaoB` text NOT NULL,
  `previaTexto` text NOT NULL,
  `previaImagem` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sobreprojeto`
--

LOCK TABLES `tbl_sobreprojeto` WRITE;
/*!40000 ALTER TABLE `tbl_sobreprojeto` DISABLE KEYS */;
INSERT INTO `tbl_sobreprojeto` VALUES (1,'Sobre o projeto City Share','Com uma interface simples e intuitiva é fácil cadastrar seu veículo em nosso sistema e disponibilizá-lo para aluguel, com algumas poucas informações você poderá tanto alugar quanto disponibilizar um veículo de sua preferência. Nosso sistema busca reunir proprietários e usuários, e preza pelo bom relacionamento entre os mesmos, e para isso implantamos um sistema de reputação para que o usuário saiba com quem está fazendo negócio, facilitando a transparência na hora da negociação. E com o intuito de facilitar ainda mais a experiência para nossos usuários comuns, foi desenvolvido um aplicativo para smartphones onde você poderá gerenciar todas as suas atividades como faz no desktop, porém diretamente do seu celular!','imagemA.jpg','imagemB.jpg','A cada dia que passa, mais pessoas realizam o sonho de comprar um carro ou uma moto, alguns até mesmo dois. Mas não é sempre que tais veículos são utilizados, muitas das vezes eles ficam estacionados, fora de uso. Por outro lado exitem também aquelas pessoas que não tem condições de comprar efetivamente um veículo e geralmente se utilizam de transporte público para se locomover. O projeto City Share nasceu da necessidade de tirar carros e bicicletas que estão obsoletas das garagens e colocá-los em circulação, ajudando pessoas com a necessidade de um transporte a conseguir um de forma prática e rápida.<br> Pensando nisso, a City Share decidiu implantar o sistema de mesmo nome que permite que você alugue ou empreste um veículo para outra pessoa, melhorando assim o fluxo de veículos dentro do município que adotou o sistema.','O projeto já foi adotado em mais de 10 municípios e tem ganhado popularidade entre os usuarios comuns, muitos deles tem sua vida facilitada pelo sistema City Share e seu uso tem sido cada vez mais frequente, visto que a praticidade que o sistema proporciona é grande. O projeto City Share também tem um papel importante na ecologia, visto que ele incentiva os usuários ao uso de veículos mais econômicos por um período de tempo menor do que de costume, diminuindo a frequência de agentes poluentes ambientais, ou até mesmo anulando, como no caso das bicicletas. Recentemente temos cultivado parceria com outras empresas de aluguéis de veículos, que utilizam o sistema da City Share para encontrar e fidelizar novos clientes, tendo em cada município uma agência onde poderá ser feito o cadastro diretamente e você já poderá sair com seu carro alugado.','O City Share é um projeto da empresa de mesmo nome que consiste em um sistema de empréstimo de veículos implantado em municípios onde o usuário (físico ou jurídico) poderá disponibilizar sua bicicleta, moto ou carro o qual não utiliza ou tenha sobrando para aluguel.\r\n<br>\r\nO sistema é voltado tanto para usuários que desejam alugar quanto disponibilizar para aluguel. Nele você poderá encontrar o carro perfeito para passeios ou até mesmo o carro dos seus sonhos, basta fazer uma pequena pesquisa!\r\n<br>\r\nTem algum carro parado ou obsoleto? Cadastre ele e fature um dinheiro extra com o aluguel!\r\n<br>\r\nBicicletas também são bem-vindas! Se você não usa sua bicicleta, coloque-a em nosso site, com certeza alguém fará bom uso dela, e você ainda ganha com isso!\r\n<br>\r\n<br>\r\nCadastre-se agora e comece a usar o nosso sistema!','imagemPrevia.jpg');
/*!40000 ALTER TABLE `tbl_sobreprojeto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_statuspedido`
--

DROP TABLE IF EXISTS `tbl_statuspedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_statuspedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod` int(2) DEFAULT NULL,
  `titulo` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_statuspedido`
--

LOCK TABLES `tbl_statuspedido` WRITE;
/*!40000 ALTER TABLE `tbl_statuspedido` DISABLE KEYS */;
INSERT INTO `tbl_statuspedido` VALUES (1,2,'Agendado'),(2,4,'Aguardando confirmação do local de retirada'),(3,5,'Aguardando confirmação de retirada'),(4,6,'Aguardando confirmação do local de entrega'),(5,7,'Aguardando confirmação de entrega'),(6,8,'Aguardando definição de pendências'),(7,9,'Aguardando confirmação de pendências'),(8,12,'Aguardando pagamento de pendências'),(9,16,'Concluido'),(10,1,'Rejeitado'),(11,11,'Pendências recusadas'),(12,10,'Pendências aceitas'),(13,15,'Pendências pagas - Dinheiro'),(14,14,'Pendências pagas - Cartão de Crédito'),(16,3,'Cancelado'),(17,13,'Aguardando confirmação do pagamento de pendências');
/*!40000 ALTER TABLE `tbl_statuspedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_statuspublicacao`
--

DROP TABLE IF EXISTS `tbl_statuspublicacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_statuspublicacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cod` int(2) DEFAULT NULL,
  `titulo` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_statuspublicacao`
--

LOCK TABLES `tbl_statuspublicacao` WRITE;
/*!40000 ALTER TABLE `tbl_statuspublicacao` DISABLE KEYS */;
INSERT INTO `tbl_statuspublicacao` VALUES (1,1,'Disponível'),(2,2,'Indisponível'),(3,3,'Pendente');
/*!40000 ALTER TABLE `tbl_statuspublicacao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tela_cs`
--

DROP TABLE IF EXISTS `tbl_tela_cs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tela_cs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tela_cs`
--

LOCK TABLES `tbl_tela_cs` WRITE;
/*!40000 ALTER TABLE `tbl_tela_cs` DISABLE KEYS */;
INSERT INTO `tbl_tela_cs` VALUES (1,'Usuario'),(2,'Planos de Conta'),(3,'Conteudo'),(4,'Níveis de Acesso'),(5,'Administradores'),(6,'Veículos');
/*!40000 ALTER TABLE `tbl_tela_cs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tela_software`
--

DROP TABLE IF EXISTS `tbl_tela_software`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tela_software` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leitura` tinyint(1) NOT NULL,
  `escrita` tinyint(1) NOT NULL,
  `edicao` tinyint(1) NOT NULL,
  `remocao` tinyint(1) NOT NULL,
  `cod` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tela_software`
--

LOCK TABLES `tbl_tela_software` WRITE;
/*!40000 ALTER TABLE `tbl_tela_software` DISABLE KEYS */;
INSERT INTO `tbl_tela_software` VALUES (1,'Funcionários',1,1,1,1,1),(2,'Publicações',1,1,1,1,2),(3,'Agências',1,1,1,1,3),(4,'Perfís de Nível de Acesso',1,1,1,1,4),(5,'Clientes',1,1,1,1,5),(6,'Pedidos',1,1,0,0,6),(7,'Plano de Software',1,0,0,0,7),(8,'Estatísticas de Locação',1,0,0,0,8),(9,'Estatísticas de Publicação',1,0,0,0,9);
/*!40000 ALTER TABLE `tbl_tela_software` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipo_cartao_credito`
--

DROP TABLE IF EXISTS `tbl_tipo_cartao_credito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipo_cartao_credito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qtdDigitosSeguranca` int(2) DEFAULT NULL,
  `visivel` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipo_cartao_credito`
--

LOCK TABLES `tbl_tipo_cartao_credito` WRITE;
/*!40000 ALTER TABLE `tbl_tipo_cartao_credito` DISABLE KEYS */;
INSERT INTO `tbl_tipo_cartao_credito` VALUES (1,'blablaasdasd',3,NULL),(2,'Cartão A',3,1),(3,'Bisaa',4,0),(4,'Inferno',3,0),(5,'Bolt',3,0),(6,'asd',1234,0),(7,'Cartão B',4,1),(8,'Faster Card',4,1);
/*!40000 ALTER TABLE `tbl_tipo_cartao_credito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipo_conta_bancaria`
--

DROP TABLE IF EXISTS `tbl_tipo_conta_bancaria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipo_conta_bancaria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipo_conta_bancaria`
--

LOCK TABLES `tbl_tipo_conta_bancaria` WRITE;
/*!40000 ALTER TABLE `tbl_tipo_conta_bancaria` DISABLE KEYS */;
INSERT INTO `tbl_tipo_conta_bancaria` VALUES (1,'Corrente');
/*!40000 ALTER TABLE `tbl_tipo_conta_bancaria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipocombustivel`
--

DROP TABLE IF EXISTS `tbl_tipocombustivel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipocombustivel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipocombustivel`
--

LOCK TABLES `tbl_tipocombustivel` WRITE;
/*!40000 ALTER TABLE `tbl_tipocombustivel` DISABLE KEYS */;
INSERT INTO `tbl_tipocombustivel` VALUES (1,'Álcool'),(2,'Gasolina');
/*!40000 ALTER TABLE `tbl_tipocombustivel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipoconta`
--

DROP TABLE IF EXISTS `tbl_tipoconta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipoconta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipoconta`
--

LOCK TABLES `tbl_tipoconta` WRITE;
/*!40000 ALTER TABLE `tbl_tipoconta` DISABLE KEYS */;
INSERT INTO `tbl_tipoconta` VALUES (1,'Fisico'),(2,'Juridico');
/*!40000 ALTER TABLE `tbl_tipoconta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipopedido`
--

DROP TABLE IF EXISTS `tbl_tipopedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipopedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipopedido`
--

LOCK TABLES `tbl_tipopedido` WRITE;
/*!40000 ALTER TABLE `tbl_tipopedido` DISABLE KEYS */;
INSERT INTO `tbl_tipopedido` VALUES (1,'Online'),(2,'Local');
/*!40000 ALTER TABLE `tbl_tipopedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipoveiculo`
--

DROP TABLE IF EXISTS `tbl_tipoveiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipoveiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(30) NOT NULL,
  `visivel` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipoveiculo`
--

LOCK TABLES `tbl_tipoveiculo` WRITE;
/*!40000 ALTER TABLE `tbl_tipoveiculo` DISABLE KEYS */;
INSERT INTO `tbl_tipoveiculo` VALUES (1,'Carro',1),(25,'Moto',1),(26,'Bicicleta',1),(27,'teste',0);
/*!40000 ALTER TABLE `tbl_tipoveiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_transmissaoveiculo`
--

DROP TABLE IF EXISTS `tbl_transmissaoveiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_transmissaoveiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_transmissaoveiculo`
--

LOCK TABLES `tbl_transmissaoveiculo` WRITE;
/*!40000 ALTER TABLE `tbl_transmissaoveiculo` DISABLE KEYS */;
INSERT INTO `tbl_transmissaoveiculo` VALUES (1,'Automático'),(2,'Manual');
/*!40000 ALTER TABLE `tbl_transmissaoveiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuario`
--

DROP TABLE IF EXISTS `tbl_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `sexo` char(1) NOT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `telefone` varchar(25) DEFAULT NULL,
  `celular` varchar(25) DEFAULT NULL,
  `emailContato` varchar(100) DEFAULT NULL,
  `rg` varchar(15) DEFAULT NULL,
  `dataNascimento` date NOT NULL,
  `saldo` decimal(5,2) NOT NULL DEFAULT '0.00',
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(70) DEFAULT NULL,
  `autenticacaoDupla` tinyint(1) DEFAULT NULL,
  `fotoPerfil` varchar(50) DEFAULT NULL,
  `idCidade` int(11) NOT NULL,
  `idTipoConta` int(11) NOT NULL,
  `idPlanoConta` int(11) NOT NULL,
  `idLicencaDesktop` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_cidade` (`idCidade`),
  KEY `usuario_tipoConta` (`idTipoConta`),
  KEY `usuario_planoConta` (`idPlanoConta`),
  KEY `usuario_licencaDesktop` (`idLicencaDesktop`),
  CONSTRAINT `usuario_cidade` FOREIGN KEY (`idCidade`) REFERENCES `tbl_cidade` (`id`),
  CONSTRAINT `usuario_licencaDesktop` FOREIGN KEY (`idLicencaDesktop`) REFERENCES `tbl_licencadesktop` (`id`),
  CONSTRAINT `usuario_planoConta` FOREIGN KEY (`idPlanoConta`) REFERENCES `tbl_planoconta` (`id`),
  CONSTRAINT `usuario_tipoConta` FOREIGN KEY (`idTipoConta`) REFERENCES `tbl_tipoconta` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario`
--

LOCK TABLES `tbl_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_usuario` DISABLE KEYS */;
INSERT INTO `tbl_usuario` VALUES (23,'Vagner','Santana','m','123','11 9999-9999','11 9 9999-9999',NULL,'123','1996-07-17',0.00,'usuario@email.com','$2y$10$uobfkb8hAfIXl2p/E8GBVuCgTuUhjjppkcKTTY0BaZQZ0Z5g7GuKK',NULL,'usr\\_23.jpg',1,1,1,1),(24,'Usuário','Jurídico','m',NULL,'11 9999-9999','11 9999-9999',NULL,NULL,'1980-01-15',300.00,'juridico@email.com','$2y$10$EXuW8Ou0S/vzPcWRtxGcq.8Y7GRS2xOcAg6paiUch3ZSPg.APVaw2',NULL,'usr\\_24.png',1,2,1,1),(25,'victor','azevedo','m','48042813805','119544212123654','111222146321',NULL,'55925182454','1999-05-21',0.00,'victor@email.com','$2y$10$ytjZR9WKRjJNuYVT0bSbQ.tj59w0ywb69s4UPEgWJ8NtSYvgJANYO',NULL,NULL,1,1,1,1),(26,'Vagner','Santana','m','433.841.818.40','11 4187-5397','11 9 9795-2959',NULL,'52.946.530-9','1996-07-17',0.00,'vagnervst17@gmail.com','$2y$10$pSe7uf004BkC5PzL69Rh5eL9MRWaxO8vfNHFS5Q8ml9TKIyiiOvpm',NULL,NULL,1,1,1,1),(27,'Vagner','Santana','m','433.841.818.40','11 4187-5397','11 9 9795-2959',NULL,'52.946.530-9','1996-07-17',0.00,'vagnervst17@gmail.com','$2y$10$o95gdOWKL.6rOdzteGn4XuMcdL7EA.FTRrIoY4b6NHg8Lct.qJgBe',NULL,NULL,1,1,1,1),(28,'Vagner','Santana','m','433.841.818.40','11 4187-5397','11 9 9795-2959',NULL,'52.946.530-9','1996-07-17',0.00,'vagnervst17@gmail.com','$2y$10$a8KKjo/Y.TQNE5yhnGxkHutYbeNOoXUhsrwSZs3TRpvzBk4Y7v932',NULL,NULL,1,1,1,1),(29,'Vagner','Santana','m','433.841.818.40','11 4187-5397','11 9 9795-2959',NULL,'52.946.530-9','1996-07-17',0.00,'vagnervst17@gmail.com','$2y$10$TZUF8mLPH60mItel6fRgBuirv9FN/5pafGeHaqxof9kS81zyhgqda',NULL,NULL,1,1,1,1),(30,'Vagner','Santana','m','433.841.818.40','11 4187-5397','11 9 9795-2959',NULL,'52.946.530-9','1996-07-17',0.00,'vagnervst17@gmail.com','$2y$10$KEnoDAEWz40/5qLCGIkkE.fMH9dBi6rxacgX8w6zl1cKF3DOjYGBq',NULL,NULL,1,1,1,1),(31,'Vagner','Santana','m','433.841.818.40','11 4187-5397','11 9 9795-2959',NULL,'52.946.530-9','1996-07-17',0.00,'vagnervst17@gmail.com','$2y$10$JK5on5ALsdLn4eZlGrNAuOcc2TSsBbTC7bPd8e8qTRznHw61ahU4.',NULL,NULL,1,1,1,1),(32,'Vagner','Santana','m','433.841.818.40','11 4187-5397','11 9 9795-2959',NULL,'52.946.530-9','1996-07-17',0.00,'vagnervst17@gmail.com','$2y$10$O.koSxyTjWxcluFR.V33F.KgSMrs2LgdnEe6EEqvmcu.N/RoPhLoK',NULL,NULL,1,1,1,1),(33,'Vagner','Santana','m','433.841.818.40','11 4187-5397','11 9 9795-2959',NULL,'52.946.530-9','1996-07-17',0.00,'vagnervst17@gmail.com','$2y$10$CyX1tOCdBqIHPqmTgSd0COsBT0o6An40Q6gclsbdxL8C.pqlicege',NULL,NULL,1,1,1,1),(34,'Vagner','Santana','m','433.841.818.40','11 4187-5397','11 9 9795-2959',NULL,'52.946.530-9','1996-07-17',0.00,'vagnervst17@gmail.com','$2y$10$bx4QyBJsidR5hEMRicp9.OjMLyIvDxTx6Rwbt7WyOy57EndECZAFa',NULL,NULL,1,1,1,1),(35,'Vagner','Santana','m','433.841.818.40','11 4187-5397','11 9 9795-2959',NULL,'52.946.530-9','1996-07-17',0.00,'vagnervst17@gmail.com','$2y$10$BJtbjLSGf5xayrD0HQ8Ra.0UfrYq47vQdZwv/6KU9GSRw26LqMB7e',NULL,NULL,1,1,1,1),(36,'Vagner','Santana','m','433.841.818.40','11 4187-5397','11 9 9795-2959',NULL,'52.946.530-9','1996-07-17',0.00,'vagnervst17@gmail.com','$2y$10$NUuf8WDmRFhIRUiowfeKt.RlGVEltWKtZqK4Q7zYQ80y2SuBMENqq',NULL,'icon.png',1,1,1,1),(37,'Cadastro','Teste','m','123','123','123',NULL,'123','2017-05-16',0.00,'cadastro@teste.com',NULL,NULL,NULL,1,1,1,NULL);
/*!40000 ALTER TABLE `tbl_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuario_cs`
--

DROP TABLE IF EXISTS `tbl_usuario_cs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_usuario_cs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  `sobrenome` varchar(90) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(70) NOT NULL,
  `idNivelAcesso` int(11) NOT NULL,
  `fixo` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_nivelAcessoCS` (`idNivelAcesso`),
  CONSTRAINT `usuario_nivelAcessoCS` FOREIGN KEY (`idNivelAcesso`) REFERENCES `tbl_nivelacesso_cs` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario_cs`
--

LOCK TABLES `tbl_usuario_cs` WRITE;
/*!40000 ALTER TABLE `tbl_usuario_cs` DISABLE KEYS */;
INSERT INTO `tbl_usuario_cs` VALUES (2,'Vagner','Santana','admin','$2y$10$viDTxRNuSKm3X/rMa9oytOKJ3aMCCWUdzv.IqJzvIKfWN7OkGhq4u',1,NULL),(3,'Teste','Teste','vgr','$2y$10$XZxsl3O84HQtkf1Yeg3l4urKk4n0Ddvp.727oqSLnaLfUNCnQwWAm',3,NULL),(5,'123123','123123','123123','$2y$10$PwqV8/D8JK.xx76gRpK9Denwn5jjasp4qWM837x2lENlZT1CNaw/u',1,NULL);
/*!40000 ALTER TABLE `tbl_usuario_cs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_veiculo`
--

DROP TABLE IF EXISTS `tbl_veiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_veiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `tipoMotor` varchar(5) DEFAULT NULL,
  `ano` int(4) DEFAULT NULL,
  `qtdPortas` int(1) DEFAULT NULL,
  `codigo` varchar(10) DEFAULT NULL,
  `tanque` decimal(5,2) DEFAULT NULL,
  `idCategoriaVeiculo` int(11) NOT NULL,
  `idFabricante` int(11) NOT NULL,
  `idTipoCombustivel` int(11) DEFAULT NULL,
  `idTipoVeiculo` int(11) NOT NULL,
  `idTransmissao` int(11) DEFAULT NULL,
  `visivel` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `veiculo_categoriaVeiculo` (`idCategoriaVeiculo`),
  KEY `veiculo_fabricanteVeiculo` (`idFabricante`),
  KEY `veiculo_tipoCombustivel` (`idTipoCombustivel`),
  KEY `veiculo_tipoVeiculo` (`idTipoVeiculo`),
  KEY `veiculo_transmissaoVeiculo` (`idTransmissao`),
  CONSTRAINT `veiculo_categoriaVeiculo` FOREIGN KEY (`idCategoriaVeiculo`) REFERENCES `tbl_categoriaveiculo` (`id`),
  CONSTRAINT `veiculo_fabricanteVeiculo` FOREIGN KEY (`idFabricante`) REFERENCES `tbl_fabricanteveiculo` (`id`),
  CONSTRAINT `veiculo_tipoCombustivel` FOREIGN KEY (`idTipoCombustivel`) REFERENCES `tbl_tipocombustivel` (`id`),
  CONSTRAINT `veiculo_tipoVeiculo` FOREIGN KEY (`idTipoVeiculo`) REFERENCES `tbl_tipoveiculo` (`id`),
  CONSTRAINT `veiculo_transmissaoVeiculo` FOREIGN KEY (`idTransmissao`) REFERENCES `tbl_transmissaoveiculo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=191 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_veiculo`
--

LOCK TABLES `tbl_veiculo` WRITE;
/*!40000 ALTER TABLE `tbl_veiculo` DISABLE KEYS */;
INSERT INTO `tbl_veiculo` VALUES (188,'Bicicleta Caloy','',2013,0,'42',0.00,14,1,NULL,26,NULL,1),(189,'Ducati',NULL,2017,NULL,'43',40.00,2,4,2,25,2,0),(190,'Tesla Model S','2.0',2016,4,'44',48.00,1,3,1,1,1,1);
/*!40000 ALTER TABLE `tbl_veiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipoconta_permissaoconta`
--

DROP TABLE IF EXISTS `tipoconta_permissaoconta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipoconta_permissaoconta` (
  `idTipoConta` int(11) NOT NULL,
  `idPermissaoConta` int(11) NOT NULL,
  KEY `idTipoConta` (`idTipoConta`),
  KEY `idPermissaoConta` (`idPermissaoConta`),
  CONSTRAINT `tipoconta_permissaoconta_ibfk_1` FOREIGN KEY (`idTipoConta`) REFERENCES `tbl_tipoconta` (`id`),
  CONSTRAINT `tipoconta_permissaoconta_ibfk_2` FOREIGN KEY (`idPermissaoConta`) REFERENCES `tbl_permissaoconta` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipoconta_permissaoconta`
--

LOCK TABLES `tipoconta_permissaoconta` WRITE;
/*!40000 ALTER TABLE `tipoconta_permissaoconta` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipoconta_permissaoconta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipoveiculo_tipocombustivel`
--

DROP TABLE IF EXISTS `tipoveiculo_tipocombustivel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipoveiculo_tipocombustivel` (
  `idTipoCombustivel` int(11) NOT NULL,
  `idTipoVeiculo` int(11) NOT NULL,
  KEY `idveiculo_tipoveiculo_idx2` (`idTipoVeiculo`),
  KEY `idtipocombustivel_tipocombustivel_idx2` (`idTipoCombustivel`),
  CONSTRAINT `idtipocombustivel_tipocombustivel` FOREIGN KEY (`idTipoCombustivel`) REFERENCES `tbl_tipocombustivel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idtipoveiculo_tipoveiculo` FOREIGN KEY (`idTipoVeiculo`) REFERENCES `tbl_tipoveiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipoveiculo_tipocombustivel`
--

LOCK TABLES `tipoveiculo_tipocombustivel` WRITE;
/*!40000 ALTER TABLE `tipoveiculo_tipocombustivel` DISABLE KEYS */;
INSERT INTO `tipoveiculo_tipocombustivel` VALUES (1,1),(2,1),(1,25),(2,25),(1,27);
/*!40000 ALTER TABLE `tipoveiculo_tipocombustivel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipoveiculo_transmissaoveiculo`
--

DROP TABLE IF EXISTS `tipoveiculo_transmissaoveiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipoveiculo_transmissaoveiculo` (
  `idTipoVeiculo` int(11) NOT NULL,
  `idTransmissaoVeiculo` int(11) NOT NULL,
  KEY `idtransmissao_transmissao_idx` (`idTransmissaoVeiculo`),
  KEY `idtipoveiculo_tipoveiculo2_idx` (`idTipoVeiculo`),
  CONSTRAINT `idtipoveiculo_tipoveiculo2` FOREIGN KEY (`idTipoVeiculo`) REFERENCES `tbl_tipoveiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idtransmissao_transmissao` FOREIGN KEY (`idTransmissaoVeiculo`) REFERENCES `tbl_transmissaoveiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipoveiculo_transmissaoveiculo`
--

LOCK TABLES `tipoveiculo_transmissaoveiculo` WRITE;
/*!40000 ALTER TABLE `tipoveiculo_transmissaoveiculo` DISABLE KEYS */;
INSERT INTO `tipoveiculo_transmissaoveiculo` VALUES (1,1),(1,2),(25,1),(25,2);
/*!40000 ALTER TABLE `tipoveiculo_transmissaoveiculo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-05-21 13:31:55
