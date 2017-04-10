-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: dbcityshare
-- ------------------------------------------------------
-- Server version	5.6.10-log

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
/*!40000 ALTER TABLE `acessorioveiculo_tipoveiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agencia_perfilnivelacesso_juridico`
--

DROP TABLE IF EXISTS `agencia_perfilnivelacesso_juridico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agencia_perfilnivelacesso_juridico` (
  `idAgencia` int(11) NOT NULL,
  `idPerfilNivelAcesso` int(11) NOT NULL,
  KEY `idAgencia` (`idAgencia`),
  KEY `idPerfilNivelAcesso` (`idPerfilNivelAcesso`),
  CONSTRAINT `agencia_perfilnivelacesso_juridico_ibfk_1` FOREIGN KEY (`idAgencia`) REFERENCES `tbl_agencia` (`id`),
  CONSTRAINT `agencia_perfilnivelacesso_juridico_ibfk_2` FOREIGN KEY (`idPerfilNivelAcesso`) REFERENCES `tbl_perfil_nivel_acesso_juridico` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agencia_perfilnivelacesso_juridico`
--

LOCK TABLES `agencia_perfilnivelacesso_juridico` WRITE;
/*!40000 ALTER TABLE `agencia_perfilnivelacesso_juridico` DISABLE KEYS */;
/*!40000 ALTER TABLE `agencia_perfilnivelacesso_juridico` ENABLE KEYS */;
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
INSERT INTO `nivelacesso_permissaocs` VALUES (1,5,0),(1,6,0),(1,7,0),(1,8,0),(1,9,0),(1,10,0),(3,7,0);
/*!40000 ALTER TABLE `nivelacesso_permissaocs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissao_nivelacesso_juridico`
--

DROP TABLE IF EXISTS `permissao_nivelacesso_juridico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissao_nivelacesso_juridico` (
  `idNivelAcessoJuridico` int(11) NOT NULL,
  `idPermissaoJuridico` int(11) NOT NULL,
  `idTelaSoftware` int(11) NOT NULL,
  KEY `idNivelAcessoJuridico` (`idNivelAcessoJuridico`),
  KEY `idPermissaoJuridico` (`idPermissaoJuridico`),
  KEY `permissao_tela_software` (`idTelaSoftware`),
  CONSTRAINT `permissao_nivelacesso_juridico_ibfk_1` FOREIGN KEY (`idNivelAcessoJuridico`) REFERENCES `tbl_nivelacesso_juridico` (`id`),
  CONSTRAINT `permissao_nivelacesso_juridico_ibfk_2` FOREIGN KEY (`idPermissaoJuridico`) REFERENCES `tbl_permissao_juridico` (`id`),
  CONSTRAINT `permissao_tela_software` FOREIGN KEY (`idTelaSoftware`) REFERENCES `tbl_tela_software` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissao_nivelacesso_juridico`
--

LOCK TABLES `permissao_nivelacesso_juridico` WRITE;
/*!40000 ALTER TABLE `permissao_nivelacesso_juridico` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissao_nivelacesso_juridico` ENABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_acessorioveiculo`
--

LOCK TABLES `tbl_acessorioveiculo` WRITE;
/*!40000 ALTER TABLE `tbl_acessorioveiculo` DISABLE KEYS */;
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
  `idUsuario` int(11) NOT NULL,
  `idPerfilNivelAcesso` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `agencia_cidade` (`idCidade`),
  KEY `juridico_agencia` (`idUsuario`),
  KEY `agencia_perfil_nivel_acesso_idx` (`idPerfilNivelAcesso`),
  CONSTRAINT `agencia_cidade` FOREIGN KEY (`idCidade`) REFERENCES `tbl_cidade` (`id`),
  CONSTRAINT `agencia_perfil_nivel_acesso` FOREIGN KEY (`idPerfilNivelAcesso`) REFERENCES `tbl_perfil_nivel_acesso_juridico` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `juridico_agencia` FOREIGN KEY (`idUsuario`) REFERENCES `tbl_usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_agencia`
--

LOCK TABLES `tbl_agencia` WRITE;
/*!40000 ALTER TABLE `tbl_agencia` DISABLE KEYS */;
INSERT INTO `tbl_agencia` VALUES (12,'Agencia','qwe','qwe','qwe',1,2,1);
/*!40000 ALTER TABLE `tbl_agencia` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_assunto`
--

LOCK TABLES `tbl_assunto` WRITE;
/*!40000 ALTER TABLE `tbl_assunto` DISABLE KEYS */;
INSERT INTO `tbl_assunto` VALUES (2,'Sugestão'),(3,'SugestÃ£o'),(4,'SugestÃ£o\\_'),(5,'SugestÃ£o\\%'),(6,'SugestÃ£o\''),(7,'SugestÃ£o'),(8,'123'),(9,'12.3'),(10,'12.3'),(11,'12.3'),(12,'12.3'),(13,'12.3'),(14,'123'),(15,'123'),(16,'123'),(17,'123'),(18,'123'),(19,'123'),(20,'123'),(21,'123'),(22,'123'),(23,'123'),(24,'123'),(25,'123'),(26,'123'),(27,'123'),(28,'123'),(29,'123'),(30,'123'),(31,'123'),(32,'123'),(33,'123'),(34,'123'),(35,'123'),(36,'12.3'),(37,'123'),(38,'123'),(39,'1\\23'),(40,'\\%'),(41,'\\_'),(42,'123.456');
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
  `idUsuarioAvaliador` int(11) NOT NULL,
  `idUsuarioAvaliado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuarioAvaliador_avaliacao` (`idUsuarioAvaliador`),
  KEY `usuarioAvaliado_avaliacao` (`idUsuarioAvaliado`),
  CONSTRAINT `usuarioAvaliado_avaliacao` FOREIGN KEY (`idUsuarioAvaliado`) REFERENCES `tbl_usuario` (`id`),
  CONSTRAINT `usuarioAvaliador_avaliacao` FOREIGN KEY (`idUsuarioAvaliador`) REFERENCES `tbl_usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_avaliacao`
--

LOCK TABLES `tbl_avaliacao` WRITE;
/*!40000 ALTER TABLE `tbl_avaliacao` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_avaliacao` ENABLE KEYS */;
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
INSERT INTO `tbl_beneficiosprojeto` VALUES (1,'Por que utilizar os serviÃ§os City Share?','Veja aqui alguns dos benefÃ­cios que o nosso projeto pode proporcionar:','velbebravo.PNG','vlcsnap-2017-01-07-14h21m19s016.png','color-wheel-poster.jpg','- VocÃª tem remuneraÃ§Ã£o pelo veÃ­culo alugado, pagando apenas uma pequena taxa que varia de acordo com o tipo de veÃ­culo cadastrado em nosso sistema.\r\n- Com a facilidade do sistema City Share vocÃª poderÃ¡ cadastrar ou alugar um veÃ­culo em questÃ£o de minutos, sem nenhuma burocracia envolvida. Mas fique atento aos requisitos mÃ­nimos que o seu veÃ­culo precisa atender para ser cadastrado.\r\n- Tenha sua agÃªncia divulgada caso utilize o sistema City Share na sua empresa.','- VocÃª nÃ£o paga pelo valor total do veÃ­culo, apenas a diÃ¡ria de uso prescrita pelo proprietÃ¡rio do vÃ©iculo que estÃ¡ alugando.\r\n- VocÃª encontra uma grande variedade de veÃ­culos disponÃ­veis, podendo encontrar um para cada situaÃ§Ã£o.\r\n- Pague somente no momento da retirada, evitando inconveniÃªncias.','- Negocie diretamente, o sistema permite uma negociaÃ§Ã£o direta entre usuÃ¡rios, facilitando na transparÃªncia e facilitando a transaÃ§Ã£o.\r\n- TransaÃ§Ãµes sÃ£o seguras, o pagamento por dÃ©bito auxilia na concretizaÃ§Ã£o da negociaÃ§Ã£o, diminuindo em muito as chances de falhas na mesma.\r\n- Com o nosso sistema de filtragem dentro do site encontre o veÃ­culo mais prÃ³ximo de vocÃª, evitando longas deslocaÃ§Ãµes atÃ© o local da negociaÃ§Ã£o.','perfil git.PNG','O projeto City Share traz tambÃ©m benefÃ­cios para quem o utiliza, sendo alguns deles:\r\nRemuneraÃ§Ã£o pelo veÃ­culo alugado;\r\nO Sistema dinÃ¢mico permite que o veÃ­culo seja alugado em questÃ£o de minutos;\r\nPague somente pelo uso e nÃ£o pela propriedade do carro.');
/*!40000 ALTER TABLE `tbl_beneficiosprojeto` ENABLE KEYS */;
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
  PRIMARY KEY (`id`),
  KEY `tipoVeiculo_categoriaVeiculo` (`idTipoVeiculo`),
  CONSTRAINT `tipoVeiculo_categoriaVeiculo` FOREIGN KEY (`idTipoVeiculo`) REFERENCES `tbl_tipoveiculo` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_categoriaveiculo`
--

LOCK TABLES `tbl_categoriaveiculo` WRITE;
/*!40000 ALTER TABLE `tbl_categoriaveiculo` DISABLE KEYS */;
INSERT INTO `tbl_categoriaveiculo` VALUES (1,'Categoria B',25.00,30000.00,1),(2,'Categoria A',15.00,1000.00,25),(3,'Categoria C',10.00,5000.00,26),(5,'a',123.00,123.00,1),(6,'b',123.00,123.00,1),(7,'c',123.00,123.00,1),(8,'d',123.00,123.00,26),(9,'e',123.00,123.00,1),(10,'f',123.00,123.00,1),(11,'g',123.00,123.00,1),(12,'h',123.00,123.00,1),(13,'i',123.00,123.00,25),(14,'j',123.00,123.00,1),(15,'k',123.00,123.00,1),(16,'l',123.00,123.00,1),(17,'m',123.00,123.00,1);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cnh`
--

LOCK TABLES `tbl_cnh` WRITE;
/*!40000 ALTER TABLE `tbl_cnh` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_cnh` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_deposito`
--

LOCK TABLES `tbl_deposito` WRITE;
/*!40000 ALTER TABLE `tbl_deposito` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_deposito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_duracaomeses`
--

DROP TABLE IF EXISTS `tbl_duracaomeses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_duracaomeses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mes` int(2) NOT NULL,
  `titulo` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_duracaomeses`
--

LOCK TABLES `tbl_duracaomeses` WRITE;
/*!40000 ALTER TABLE `tbl_duracaomeses` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_duracaomeses` ENABLE KEYS */;
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
INSERT INTO `tbl_empreste` VALUES (1,'Quer lucrar com seu veÃ­culo?','Lucrar com seu veÃ­culo aqui na City Share Ã© fÃ¡cil e prÃ¡tico, nosso sistema foi desenvolvido especialmente para facilitar esse processo para vocÃª usuÃ¡rio, mas tenha em mente que existem tambÃ©m critÃ©rios a serem seguidos. Entenda melhor o processo de cadastro.','logo\\_eita\\_2.jpg','Como funciona?');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_fabricanteveiculo`
--

LOCK TABLES `tbl_fabricanteveiculo` WRITE;
/*!40000 ALTER TABLE `tbl_fabricanteveiculo` DISABLE KEYS */;
INSERT INTO `tbl_fabricanteveiculo` VALUES (1,'Fabricante A');
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
INSERT INTO `tbl_faleconosco` VALUES (1,'Fale Conosco','Perguntas Frequentes','NÃ£o sanou sua dÃºvida? Contate-nos!','contato@cityshare.com.br','(11) 3061-5678','Das 09h Ã s 18h','Rua Gustavo da Silveira, 23 - Vila Santa Catarina CEP 04376-002 - SÃ£o Paulo/SP');
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
  `titulo` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_formapagamento`
--

LOCK TABLES `tbl_formapagamento` WRITE;
/*!40000 ALTER TABLE `tbl_formapagamento` DISABLE KEYS */;
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
  `senha` varchar(20) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `statusOnline` tinyint(4) NOT NULL DEFAULT '0',
  `idNivelAcesso` int(11) NOT NULL,
  `idAgencia` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `funcionario_nivelAcesso` (`idNivelAcesso`),
  KEY `funcionario_agencia` (`idAgencia`),
  CONSTRAINT `funcionario_agencia` FOREIGN KEY (`idAgencia`) REFERENCES `tbl_agencia` (`id`),
  CONSTRAINT `funcionario_nivelAcesso` FOREIGN KEY (`idNivelAcesso`) REFERENCES `tbl_nivelacesso_juridico` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_funcionario`
--

LOCK TABLES `tbl_funcionario` WRITE;
/*!40000 ALTER TABLE `tbl_funcionario` DISABLE KEYS */;
INSERT INTO `tbl_funcionario` VALUES (1,'Vagner Santana','','qwe','qwe','qwe',0,2,12);
/*!40000 ALTER TABLE `tbl_funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_historicoalteracaopedido`
--

DROP TABLE IF EXISTS `tbl_historicoalteracaopedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_historicoalteracaopedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dataOcorrencia` datetime NOT NULL,
  `idStatus` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `historicoAlteracaoPedido_statusPedido` (`idStatus`),
  KEY `pedido_historicoAlteracao` (`idPedido`),
  CONSTRAINT `historicoAlteracaoPedido_statusPedido` FOREIGN KEY (`idStatus`) REFERENCES `tbl_statuspedido` (`id`),
  CONSTRAINT `pedido_historicoAlteracao` FOREIGN KEY (`idPedido`) REFERENCES `tbl_pedido` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_historicoalteracaopedido`
--

LOCK TABLES `tbl_historicoalteracaopedido` WRITE;
/*!40000 ALTER TABLE `tbl_historicoalteracaopedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_historicoalteracaopedido` ENABLE KEYS */;
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
INSERT INTO `tbl_home` VALUES (1,'Como funciona123?','logo\\_eita\\_1.jpg');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nivelacesso_cs`
--

LOCK TABLES `tbl_nivelacesso_cs` WRITE;
/*!40000 ALTER TABLE `tbl_nivelacesso_cs` DISABLE KEYS */;
INSERT INTO `tbl_nivelacesso_cs` VALUES (1,'Administrador'),(3,'Editor de ConteÃºdo'),(4,'Gerenciador de Clientes'),(5,'Administrador de Desktop');
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
  `idPerfilNivelAcesso` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `perfil_nivelAcessoJuridico` (`idPerfilNivelAcesso`),
  CONSTRAINT `perfil_nivelAcessoJuridico` FOREIGN KEY (`idPerfilNivelAcesso`) REFERENCES `tbl_perfil_nivel_acesso_juridico` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_nivelacesso_juridico`
--

LOCK TABLES `tbl_nivelacesso_juridico` WRITE;
/*!40000 ALTER TABLE `tbl_nivelacesso_juridico` DISABLE KEYS */;
INSERT INTO `tbl_nivelacesso_juridico` VALUES (1,'Nivel de Acesso',1),(2,'Nivel de Acesso 2',1);
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
  `dataRetirada` datetime DEFAULT NULL,
  `dataEntrega` datetime DEFAULT NULL,
  `idPublicacao` int(11) NOT NULL,
  `idUsuarioLocatario` int(11) NOT NULL,
  `idStatusPedido` int(11) NOT NULL,
  `idTipoPedido` int(11) NOT NULL,
  `idFormaPagamento` int(11) NOT NULL,
  `idFuncionario` int(11) DEFAULT NULL,
  `idCnh` int(11) NOT NULL,
  `idVeiculo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedido_publicacao` (`idPublicacao`),
  KEY `pedido_usuarioLocatario` (`idUsuarioLocatario`),
  KEY `pedido_statusPedido` (`idStatusPedido`),
  KEY `pedido_tipoPedido` (`idTipoPedido`),
  KEY `pedido_formaPagamento` (`idFormaPagamento`),
  KEY `pedido_funcionario` (`idFuncionario`),
  KEY `pedido_cnd_idx` (`idCnh`),
  KEY `pedido_veiculo_idx` (`idVeiculo`),
  CONSTRAINT `pedido_veiculo` FOREIGN KEY (`idVeiculo`) REFERENCES `tbl_veiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `pedido_cnd` FOREIGN KEY (`idCnh`) REFERENCES `tbl_cnh` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `pedido_formaPagamento` FOREIGN KEY (`idFormaPagamento`) REFERENCES `tbl_formapagamento` (`id`),
  CONSTRAINT `pedido_funcionario` FOREIGN KEY (`idFuncionario`) REFERENCES `tbl_funcionario` (`id`),
  CONSTRAINT `pedido_publicacao` FOREIGN KEY (`idPublicacao`) REFERENCES `tbl_publicacao` (`id`),
  CONSTRAINT `pedido_statusPedido` FOREIGN KEY (`idStatusPedido`) REFERENCES `tbl_statuspedido` (`id`),
  CONSTRAINT `pedido_tipoPedido` FOREIGN KEY (`idTipoPedido`) REFERENCES `tbl_tipopedido` (`id`),
  CONSTRAINT `pedido_usuarioLocatario` FOREIGN KEY (`idUsuarioLocatario`) REFERENCES `tbl_usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pedido`
--

LOCK TABLES `tbl_pedido` WRITE;
/*!40000 ALTER TABLE `tbl_pedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pendencia`
--

DROP TABLE IF EXISTS `tbl_pendencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pendencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `combustivelRestante` int(1) NOT NULL,
  `quilometragemExcedida` decimal(7,2) NOT NULL,
  `diasAtrasados` int(3) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `idFormaPagamento` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pedido_pendencia` (`idPedido`),
  KEY `pendencia_formaPagamento` (`idFormaPagamento`),
  CONSTRAINT `pedido_pendencia` FOREIGN KEY (`idPedido`) REFERENCES `tbl_pedido` (`id`),
  CONSTRAINT `pendencia_formaPagamento` FOREIGN KEY (`idFormaPagamento`) REFERENCES `tbl_formapagamento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pendencia`
--

LOCK TABLES `tbl_pendencia` WRITE;
/*!40000 ALTER TABLE `tbl_pendencia` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_pendencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_percentuallucro`
--

DROP TABLE IF EXISTS `tbl_percentuallucro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_percentuallucro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `percentual` decimal(5,2) NOT NULL,
  `valorMinimoVeiculo` decimal(9,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_percentuallucro`
--

LOCK TABLES `tbl_percentuallucro` WRITE;
/*!40000 ALTER TABLE `tbl_percentuallucro` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_percentuallucro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_perfil_nivel_acesso_juridico`
--

DROP TABLE IF EXISTS `tbl_perfil_nivel_acesso_juridico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_perfil_nivel_acesso_juridico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `juridico_perfilNivelAcesso` (`idUsuario`),
  CONSTRAINT `juridico_perfilNivelAcesso` FOREIGN KEY (`idUsuario`) REFERENCES `tbl_usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_perfil_nivel_acesso_juridico`
--

LOCK TABLES `tbl_perfil_nivel_acesso_juridico` WRITE;
/*!40000 ALTER TABLE `tbl_perfil_nivel_acesso_juridico` DISABLE KEYS */;
INSERT INTO `tbl_perfil_nivel_acesso_juridico` VALUES (1,'Primeiro Perfil',2);
/*!40000 ALTER TABLE `tbl_perfil_nivel_acesso_juridico` ENABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_perguntasfrequentes`
--

LOCK TABLES `tbl_perguntasfrequentes` WRITE;
/*!40000 ALTER TABLE `tbl_perguntasfrequentes` DISABLE KEYS */;
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
-- Table structure for table `tbl_permissaojuridico`
--

DROP TABLE IF EXISTS `tbl_permissaojuridico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_permissaojuridico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_permissaojuridico`
--

LOCK TABLES `tbl_permissaojuridico` WRITE;
/*!40000 ALTER TABLE `tbl_permissaojuridico` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_permissaojuridico` ENABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_planoconta`
--

LOCK TABLES `tbl_planoconta` WRITE;
/*!40000 ALTER TABLE `tbl_planoconta` DISABLE KEYS */;
INSERT INTO `tbl_planoconta` VALUES (1,'Padrao',0.00,0,5,7);
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
  `imagemPrincipal` varchar(40) NOT NULL,
  `imagemA` varchar(40) DEFAULT NULL,
  `imagemB` varchar(40) DEFAULT NULL,
  `imagemC` varchar(40) DEFAULT NULL,
  `imagemD` varchar(40) DEFAULT NULL,
  `idStatusPublicacao` int(11) NOT NULL,
  `idAgencia` int(11) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL,
  `idFuncionario` int(11) DEFAULT NULL,
  `idVeiculo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `publicacao_statusPublicacao` (`idStatusPublicacao`),
  KEY `publicacao_agencia` (`idAgencia`),
  KEY `publicacao_usuario` (`idUsuario`),
  KEY `publicacao_funcionario` (`idFuncionario`),
  KEY `publicacao_veiculo_idx` (`idVeiculo`),
  CONSTRAINT `publicacao_veiculo` FOREIGN KEY (`idVeiculo`) REFERENCES `tbl_veiculo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `publicacao_agencia` FOREIGN KEY (`idAgencia`) REFERENCES `tbl_agencia` (`id`),
  CONSTRAINT `publicacao_funcionario` FOREIGN KEY (`idFuncionario`) REFERENCES `tbl_funcionario` (`id`),
  CONSTRAINT `publicacao_statusPublicacao` FOREIGN KEY (`idStatusPublicacao`) REFERENCES `tbl_statuspublicacao` (`id`),
  CONSTRAINT `publicacao_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `tbl_usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_publicacao`
--

LOCK TABLES `tbl_publicacao` WRITE;
/*!40000 ALTER TABLE `tbl_publicacao` DISABLE KEYS */;
INSERT INTO `tbl_publicacao` VALUES (1,'Veiculo A','Descrição',10.25,3.30,4.50,20000,5000,'2017-04-07 00:00:00','','','','','',1,12,2,1,176);
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
INSERT INTO `tbl_sobreempresa` VALUES (1,'Sobre a Empresa','O Projeto City Share sÃ³ foi possÃ­vel por conta da parceria entre duas empresas, que trabalharam em conjunto para trazer essa soluÃ§Ã£o atÃ© vocÃª! ConheÃ§a aqui um pouco sobre ambas as empresas envolvidas:','perfil git.PNG','City Share','A empresa â€œCity Shareâ€ Ã© uma empresa de iniciativa privada que atua em parceria com prefeituras em todo o territÃ³rio nacional com o objetivo de auxiliar as prefeituras em projetos de mobilidade e urbanismo. Dentre os projetos que a empresa atuou podemos citar trÃªs, que sÃ£o eles: BicicletÃ¡rios,  Miniparques em vagas de rua e EspaÃ§os de convivÃªncia, gastronomia e arte. Com 5 anos de vida, a City Share tem ganhado espaÃ§o no mercado com seus projetos inovadores e parceirias duradouras. Sua trajetÃ³ria conta com os mais diversos projetos desenvolvidos para melhorias em municÃ­pios, todos muito bem implantados, e isso trouxe a confianÃ§a dos clientes atÃ© a City Share, que a cada dia conquista mais espaÃ§o no ramo.','logo\\_eita\\_1.jpg','E.I.T.A.','OriginÃ¡rio da Nova ZelÃ¢ndia, O grupo E.I.T.A. foi fundado por trÃªs pessoas que compartilhavam do mesmo ideal, desenvolver soluÃ§Ãµes para problemas.\r\n                            A empresa comeÃ§ou como uma simples agÃªncia de soluÃ§Ãµes e hoje Ã© uma das lÃ­deres de mercado de desenvolvimento de softwares. Atuando hÃ¡ mais de 10 anos no mercado, a E.I.T.A. soluÃ§Ãµes Ã© conhecida pela fidelizaÃ§Ã£o dos seus clientes destacando-se assim das demais empresas do ramo. Em seus 11 anos de vida, a E.I.T.A. tem expandido cada vez mais seu negÃ³cio, tendo filiais espalhadas pela Europa e AmÃ©ricas. Sua filial no Brasil, jÃ¡ estÃ¡ hÃ¡ 3 anos atuando no mercado. A equipe da E.I.T.A. jÃ¡ conta com mais de 1000 funcionÃ¡rios por filial onde pelo menos 300 deles atuam na Ã¡rea de TI, O foco atual da empresa.','O projeto City Share traz tambÃ©m benefÃ­cios para quem o utiliza, sendo alguns deles:\r\n\r\n- RemuneraÃ§Ã£o pelo veÃ­culo alugado;\r\n\r\n- O Sistema dinÃ¢mico permite que o veÃ­culo seja alugado em questÃ£o de minutos;\r\n\r\n- Pague somente pelo uso e nÃ£o pela propriedade do carro.');
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
INSERT INTO `tbl_sobreprojeto` VALUES (1,'Sobre o projeto City Share','Com uma interface simples e intuitiva é fácil cadastrar seu veículo em nosso sistema e disponibilizá-lo para aluguel, com algumas poucas informações você poderá tanto alugar quanto disponibilizar um veículo de sua preferência. Nosso sistema busca reunir proprietários e usuários, e preza pelo bom relacionamento entre os mesmos, e para isso implantamos um sistema de reputação para que o usuário saiba com quem está fazendo negócio, facilitando a transparência na hora da negociação. E com o intuito de facilitar ainda mais a experiência para nossos usuários comuns, foi desenvolvido um aplicativo para smartphones onde você poderá gerenciar todas as suas atividades como faz no desktop, porém diretamente do seu celular!','','','A cada dia que passa, mais pessoas realizam o sonho de comprar um carro ou uma moto, alguns até mesmo dois. Mas não é sempre que tais veículos são utilizados, muitas das vezes eles ficam estacionados, fora de uso. Por outro lado exitem também aquelas pessoas que não tem condições de comprar efetivamente um veículo e geralmente se utilizam de transporte público para se locomover. O projeto City Share nasceu da necessidade de tirar carros e bicicletas que estão obsoletas das garagens e colocá-los em circulação, ajudando pessoas com a necessidade de um transporte a conseguir um de forma prática e rápida. Pensando nisso, a City Share decidiu implantar o sistema de mesmo nome que permite que você alugue ou empreste um veículo para outra pessoa, melhorando assim o fluxo de veí­culos dentro do município que adotou o sistema.','O projeto já foi adotado em mais de 10 municípios e tem ganhado popularidade entre os usuários comuns, muitos deles tem sua vida facilitada pelo sistema City Share e seu uso tem sido cada vez mais frequente, visto que a praticidade que o sistema proporciona é grande. O projeto City Share também tem um papel importante na ecologia, visto que ele incentiva os usuários ao uso de veículos mais econômicos por um período de tempo menor do que de costume, diminuindo a frequência de agentes poluentes ambientais, ou até mesmo anulando, como no caso das bicicletas. Recentemente temos cultivado parceria com outras empresas de aluguéis de veí­culos, que utilizam o sistema da City Share para encontrar e fidelizar novos clientes, tendo em cada municí­pio uma agência onde poderá ser feito o cadastro diretamente e você já poderá sair com seu carro alugado.','O City Share é um projeto da empresa de mesmo nome que consiste em um sistema de empréstimo de veí­culos implantado em municí­pios onde o usuário (físico ou jurí­dico) poderá disponibilizar sua bicicleta, moto ou carro o qual não utiliza ou tenha sobrando para aluguel. O sistema é voltado tanto para usuários que desejam alugar quanto disponibilizar para aluguel. Nele você poderá encontrar o carro perfeito para passeios ou até mesmo o carro dos seus sonhos, basta fazer uma pequena pesquisa! Tem algum carro parado ou obsoleto? Cadastre ele e fature um dinheiro extra com o aluguel! Bicicletas também são bem-vindas! Se você não usa sua bicicleta, coloque-a em nosso site, com certeza alguém fará bom uso dela, e você ainda ganha com isso!\r\nCadastre-se agora e comece a usar o nosso sistema!','perfil git.PNG');
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
  `titulo` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_statuspedido`
--

LOCK TABLES `tbl_statuspedido` WRITE;
/*!40000 ALTER TABLE `tbl_statuspedido` DISABLE KEYS */;
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
  `titulo` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_statuspublicacao`
--

LOCK TABLES `tbl_statuspublicacao` WRITE;
/*!40000 ALTER TABLE `tbl_statuspublicacao` DISABLE KEYS */;
INSERT INTO `tbl_statuspublicacao` VALUES (1,'Disponível'),(2,'Indisponível');
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
  `titulo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tela_software`
--

LOCK TABLES `tbl_tela_software` WRITE;
/*!40000 ALTER TABLE `tbl_tela_software` DISABLE KEYS */;
INSERT INTO `tbl_tela_software` VALUES (1,'Funcionários',1,1,1,1),(2,'Publicações',1,1,1,1),(3,'Agências',1,1,1,1),(4,'Perfís de Nível de Acesso',1,1,1,1),(5,'Clientes',1,1,1,1);
/*!40000 ALTER TABLE `tbl_tela_software` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipocartaocredito`
--

DROP TABLE IF EXISTS `tbl_tipocartaocredito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipocartaocredito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  `qtdDigitosSeguranca` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipocartaocredito`
--

LOCK TABLES `tbl_tipocartaocredito` WRITE;
/*!40000 ALTER TABLE `tbl_tipocartaocredito` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_tipocartaocredito` ENABLE KEYS */;
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
INSERT INTO `tbl_tipocombustivel` VALUES (1,'Ãlcool'),(2,'Gasolina');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipopedido`
--

LOCK TABLES `tbl_tipopedido` WRITE;
/*!40000 ALTER TABLE `tbl_tipopedido` DISABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipoveiculo`
--

LOCK TABLES `tbl_tipoveiculo` WRITE;
/*!40000 ALTER TABLE `tbl_tipoveiculo` DISABLE KEYS */;
INSERT INTO `tbl_tipoveiculo` VALUES (1,'Tipo A'),(25,'Tipo B'),(26,'Tipo C'),(27,'Tipo D'),(29,'Tipo E'),(30,'Tipo F');
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
INSERT INTO `tbl_transmissaoveiculo` VALUES (1,'AutomÃ¡tico'),(2,'Manual');
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
  `cnpj` varchar(25) DEFAULT NULL,
  `telefone` varchar(25) DEFAULT NULL,
  `celular` varchar(25) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `rg` varchar(15) DEFAULT NULL,
  `saldo` decimal(5,2) NOT NULL,
  `senha` varchar(20) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario`
--

LOCK TABLES `tbl_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_usuario` DISABLE KEYS */;
INSERT INTO `tbl_usuario` VALUES (2,'Vagner','Santana','m','999.999.999-9','999999999','11 9999-9999','11 9 9999-9999','vagnervst17@gmail.com','0',100.00,'123',0,'',1,1,1,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario_cs`
--

LOCK TABLES `tbl_usuario_cs` WRITE;
/*!40000 ALTER TABLE `tbl_usuario_cs` DISABLE KEYS */;
INSERT INTO `tbl_usuario_cs` VALUES (2,'Vagner','Santana','admin','$2y$10$viDTxRNuSKm3X/rMa9oytOKJ3aMCCWUdzv.IqJzvIKfWN7OkGhq4u',1,NULL),(3,'Teste','T','vgr','$2y$10$XZxsl3O84HQtkf1Yeg3l4urKk4n0Ddvp.727oqSLnaLfUNCnQwWAm',3,NULL);
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
  `tipoMotor` varchar(5) NOT NULL,
  `precoMedio` decimal(9,2) NOT NULL,
  `ano` int(4) NOT NULL,
  `qtdPortas` int(1) NOT NULL,
  `idCategoriaVeiculo` int(11) NOT NULL,
  `idFabricante` int(11) NOT NULL,
  `idTipoCombustivel` int(11) NOT NULL,
  `idTipoVeiculo` int(11) NOT NULL,
  `idTransmissao` int(11) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_veiculo`
--

LOCK TABLES `tbl_veiculo` WRITE;
/*!40000 ALTER TABLE `tbl_veiculo` DISABLE KEYS */;
INSERT INTO `tbl_veiculo` VALUES (176,'carro','2.0',20000.00,1997,4,1,1,2,1,2),(179,'veiculo','2.0',20000.00,2017,2,1,1,1,25,1);
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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-07 10:00:42
