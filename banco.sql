-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.24 - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela csc.enderecos
CREATE TABLE IF NOT EXISTS `enderecos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `numero` varchar(10) NOT NULL,
  `logradouro` varchar(250) NOT NULL,
  `bairro` varchar(250) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela csc.enderecos: 3 rows
/*!40000 ALTER TABLE `enderecos` DISABLE KEYS */;
INSERT INTO `enderecos` (`id`, `id_usuario`, `id_tipo`, `cep`, `numero`, `logradouro`, `bairro`, `cidade`, `estado`) VALUES
	(4, 1, 1, '78050-260', '333', 'Rua Gentil Esteves', 'Jardim Aclimacao', 'Cuiaba', 'MT'),
	(5, 2, 2, '78050-000', '100', 'Av Filinto Muller', 'Centro', 'Varzea Grande', 'MT'),
	(6, 2, 1, '78000-000', '333', 'Av Rubens de Mendonca', 'Araes', 'Cuiaba', 'MT');
/*!40000 ALTER TABLE `enderecos` ENABLE KEYS */;

-- Copiando estrutura para tabela csc.tipos
CREATE TABLE IF NOT EXISTS `tipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela csc.tipos: 3 rows
/*!40000 ALTER TABLE `tipos` DISABLE KEYS */;
INSERT INTO `tipos` (`id`, `nome`) VALUES
	(1, 'Residencial'),
	(2, 'Comercial'),
	(3, 'Industrial 1');
/*!40000 ALTER TABLE `tipos` ENABLE KEYS */;

-- Copiando estrutura para tabela csc.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `senha` varchar(250) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `data_nascimento` date NOT NULL,
  `data_cadastro` date NOT NULL,
  `data_alteracao` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela csc.usuarios: 2 rows
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `telefone`, `cpf`, `data_nascimento`, `data_cadastro`, `data_alteracao`) VALUES
	(1, 'Administrador', 'adm@cscsolucao.com.br', 'e10adc3949ba59abbe56e057f20f883e', '(65)99999-1234', '111.222.333-44', '2021-06-13', '2021-06-13', '2021-06-13'),
	(2, 'Fulano de Tal 2', 'fulano@detal.com', 'e10adc3949ba59abbe56e057f20f883e', '(65)33321-7894', '123.456.789-10', '2002-10-12', '2021-06-14', '2021-06-14');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
