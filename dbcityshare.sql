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
  CONSTRAINT `agencia_perfilnivelacesso_juridico_ibfk_2` FOREIGN KEY (`idPerfilNivelAcesso`) REFERENCES `tbl_perfilnivelacesso_juridico` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nivelacesso_permissaocs`
--

DROP TABLE IF EXISTS `nivelacesso_permissaocs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nivelacesso_permissaocs` (
  `idNivelAcesso` int(11) NOT NULL,
  `idPermissao` int(11) NOT NULL,
  KEY `idNivelAcesso` (`idNivelAcesso`),
  KEY `idPermissao` (`idPermissao`),
  CONSTRAINT `nivelacesso_permissaocs_ibfk_1` FOREIGN KEY (`idNivelAcesso`) REFERENCES `tbl_nivelacesso_cs` (`id`),
  CONSTRAINT `nivelacesso_permissaocs_ibfk_2` FOREIGN KEY (`idPermissao`) REFERENCES `tbl_permissao_cs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `permissao_nivelacesso_juridico`
--

DROP TABLE IF EXISTS `permissao_nivelacesso_juridico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissao_nivelacesso_juridico` (
  `idNivelAcessoJuridico` int(11) NOT NULL,
  `idPermissaoJuridico` int(11) NOT NULL,
  KEY `idNivelAcessoJuridico` (`idNivelAcessoJuridico`),
  KEY `idPermissaoJuridico` (`idPermissaoJuridico`),
  CONSTRAINT `permissao_nivelacesso_juridico_ibfk_1` FOREIGN KEY (`idNivelAcessoJuridico`) REFERENCES `tbl_nivelacesso_juridico` (`id`),
  CONSTRAINT `permissao_nivelacesso_juridico_ibfk_2` FOREIGN KEY (`idPermissaoJuridico`) REFERENCES `tbl_permissaojuridico` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  PRIMARY KEY (`id`),
  KEY `agencia_cidade` (`idCidade`),
  KEY `juridico_agencia` (`idUsuario`),
  CONSTRAINT `agencia_cidade` FOREIGN KEY (`idCidade`) REFERENCES `tbl_cidade` (`id`),
  CONSTRAINT `juridico_agencia` FOREIGN KEY (`idUsuario`) REFERENCES `tbl_usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
-- Table structure for table `tbl_funcionario`
--

DROP TABLE IF EXISTS `tbl_funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_funcionario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(120) NOT NULL,
  `usuario` varchar(15) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `idNivelAcesso` int(11) NOT NULL,
  `idAgencia` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `funcionario_nivelAcesso` (`idNivelAcesso`),
  KEY `funcionario_agencia` (`idAgencia`),
  CONSTRAINT `funcionario_agencia` FOREIGN KEY (`idAgencia`) REFERENCES `tbl_agencia` (`id`),
  CONSTRAINT `funcionario_nivelAcesso` FOREIGN KEY (`idNivelAcesso`) REFERENCES `tbl_nivelacesso_juridico` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `idDuracaoMeses` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `licencaDesktop_duracaoMeses` (`idDuracaoMeses`),
  CONSTRAINT `licencaDesktop_duracaoMeses` FOREIGN KEY (`idDuracaoMeses`) REFERENCES `tbl_duracaomeses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  CONSTRAINT `perfil_nivelAcessoJuridico` FOREIGN KEY (`idPerfilNivelAcesso`) REFERENCES `tbl_perfilnivelacesso_juridico` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
-- Table structure for table `tbl_pais`
--

DROP TABLE IF EXISTS `tbl_pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  PRIMARY KEY (`id`),
  KEY `pedido_publicacao` (`idPublicacao`),
  KEY `pedido_usuarioLocatario` (`idUsuarioLocatario`),
  KEY `pedido_statusPedido` (`idStatusPedido`),
  KEY `pedido_tipoPedido` (`idTipoPedido`),
  KEY `pedido_formaPagamento` (`idFormaPagamento`),
  KEY `pedido_funcionario` (`idFuncionario`),
  KEY `pedido_cnd_idx` (`idCnh`),
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
-- Table structure for table `tbl_perfilnivelacesso_juridico`
--

DROP TABLE IF EXISTS `tbl_perfilnivelacesso_juridico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_perfilnivelacesso_juridico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `juridico_perfilNivelAcesso` (`idUsuario`),
  CONSTRAINT `juridico_perfilNivelAcesso` FOREIGN KEY (`idUsuario`) REFERENCES `tbl_usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
-- Table structure for table `tbl_permissao_cs`
--

DROP TABLE IF EXISTS `tbl_permissao_cs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_permissao_cs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `limiteImagemPublicacao` int(2) NOT NULL,
  `diasAnalisePublicacao` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `planoConta_duracaoMeses` (`duracaoMeses`),
  CONSTRAINT `planoConta_duracaoMeses` FOREIGN KEY (`duracaoMeses`) REFERENCES `tbl_duracaomeses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  PRIMARY KEY (`id`),
  KEY `publicacao_statusPublicacao` (`idStatusPublicacao`),
  KEY `publicacao_agencia` (`idAgencia`),
  KEY `publicacao_usuario` (`idUsuario`),
  KEY `publicacao_funcionario` (`idFuncionario`),
  CONSTRAINT `publicacao_agencia` FOREIGN KEY (`idAgencia`) REFERENCES `tbl_agencia` (`id`),
  CONSTRAINT `publicacao_funcionario` FOREIGN KEY (`idFuncionario`) REFERENCES `tbl_funcionario` (`id`),
  CONSTRAINT `publicacao_statusPublicacao` FOREIGN KEY (`idStatusPublicacao`) REFERENCES `tbl_statuspublicacao` (`id`),
  CONSTRAINT `publicacao_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `tbl_usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
-- Table structure for table `tbl_statuspublicacao`
--

DROP TABLE IF EXISTS `tbl_statuspublicacao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_statuspublicacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
-- Table structure for table `tbl_tipoconta`
--

DROP TABLE IF EXISTS `tbl_tipoconta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipoconta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
-- Table structure for table `tbl_tipoveiculo`
--

DROP TABLE IF EXISTS `tbl_tipoveiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_tipoveiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-02  4:54:31
