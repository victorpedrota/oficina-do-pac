-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 17-Out-2018 às 11:53
-- Versão do servidor: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd_do_alex`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `administrador`
--

CREATE TABLE `administrador` (
  `cod_administrador` int(11) NOT NULL,
  `cod_login` int(11) NOT NULL,
  `nome` int(11) NOT NULL,
  `rg` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `agenda`
--

CREATE TABLE `agenda` (
  `cod_agenda` int(11) NOT NULL,
  `data` int(11) NOT NULL,
  `horario` int(11) NOT NULL,
  `cod_oficina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `atualizacao`
--

CREATE TABLE `atualizacao` (
  `cod_servico` int(11) NOT NULL,
  `mensagem` varchar(200) NOT NULL,
  `hora` time NOT NULL,
  `data` date NOT NULL,
  `assunto` varchar(40) NOT NULL,
  `cod_atualizacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `atualizacao`
--

INSERT INTO `atualizacao` (`cod_servico`, `mensagem`, `hora`, `data`, `assunto`, `cod_atualizacao`) VALUES
(12, 'ewf', '23:11:11', '2018-08-08', '4r', 12),
(12, '2112', '23:11:11', '2018-08-06', '4r', 13),
(12, 'we', '11:53:40', '2018-08-20', 'ew', 14),
(12, 'htdg', '12:02:29', '2018-08-20', 'fdhgh', 15),
(12, 'htdg', '12:02:42', '2018-08-20', 'fdhgh', 16),
(12, '32', '11:11:58', '2018-08-27', '32', 17);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao`
--

CREATE TABLE `avaliacao` (
  `cod_avaliacao` int(11) NOT NULL,
  `cod_servico` int(11) NOT NULL,
  `nota_usuario` int(11) NOT NULL,
  `nota_mecanico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `avaliacao`
--

INSERT INTO `avaliacao` (`cod_avaliacao`, `cod_servico`, `nota_usuario`, `nota_mecanico`) VALUES
(5, 22, 5, 3),
(6, 13, 4, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `cod_cliente` int(11) NOT NULL,
  `cod_login` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `rg` int(50) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `rua` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `cep` int(11) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `telefone` varchar(200) NOT NULL,
  `bairro` varchar(30) NOT NULL,
  `complemento` varchar(90) NOT NULL,
  `sobrenome` varchar(90) NOT NULL,
  `numero` varchar(90) NOT NULL,
  `celular` varchar(200) NOT NULL,
  `data_nascimento` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`cod_cliente`, `cod_login`, `nome`, `rg`, `cpf`, `rua`, `estado`, `cep`, `cidade`, `telefone`, `bairro`, `complemento`, `sobrenome`, `numero`, `celular`, `data_nascimento`) VALUES
(1, 60, 'vicror', 534289538, '51183514808', 'Rua Cristiane de Souza Ramos', 's123', 12236491, '2', '2147483647', 'Jardim Sul', '123', 'pedrota', '123', '2147483647', '02/08/1992'),
(18, 57, 'victor', 222222223, '25011106845', 'Rua MaurÃ­cio Cardoso', 'SP', 12236495, 'SÃ£o JosÃ© dos Campos', '11111112222', 'Jardim Sul', '1221', 'pedrota', '1', '11121994742', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `galeria`
--

CREATE TABLE `galeria` (
  `cod_oficina` int(11) NOT NULL,
  `imagem` varchar(200) NOT NULL,
  `nome` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `galeria`
--

INSERT INTO `galeria` (`cod_oficina`, `imagem`, `nome`) VALUES
(10, 'fotos_usuarios/8547b59838795b0cb99c0e7433af7586.png', '123'),
(10, 'fotos_usuarios/c472ff3b890f73ad009bedefe53e6797.png', ''),
(10, 'fotos_usuarios/49cd1f2d17852d8e7f82e649f81d8d49.png', ''),
(10, 'fotos_usuarios/f09a5d85d08cd8c80183136bcdd28040.png', ''),
(10, 'fotos_usuarios/cce8e1a09077a2331ac2b3f3854bb360.png', ''),
(10, 'fotos_usuarios/4ed555db20d15279b617531c37723789.png', ''),
(10, 'fotos_usuarios/f766d9b1ef259d9f012b6d4162401791.jpg', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `login` varchar(30) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `privilegio` int(11) NOT NULL,
  `cod_login` int(11) NOT NULL,
  `imagem` varchar(200) NOT NULL DEFAULT 'fotos_usuario/default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`login`, `senha`, `privilegio`, `cod_login`, `imagem`) VALUES
('oficina', '22', 2, 38, 'fotos_usuarios/de6732a56121185a0415866e4dddc593.jpg'),
('mecanico', '22', 1, 53, 'fotos_usuarios/a617e0cfaf599622fc7be44a14854552.png'),
('cliente', '123456', 0, 57, 'fotos_usuarios/08611df5ac6d895b4ec88583390918c6.png'),
('1234567', '1234567', 0, 58, ''),
('12345672', '1234567', 0, 59, ''),
('2', '2', 0, 60, ''),
('111111111111111', '111111111111111', 0, 62, ''),
('victor2001', 'victor0308', 0, 63, ''),
('1', '1', 0, 64, ''),
('mecanico', '22', 1, 90, 'fotos_usuarios/a617e0cfaf599622fc7be44a14854552.png'),
('vaiiiiiiiiii', 'enfianocuuuuuu', 1, 532, ''),
('document.getElementById(\"volta', 'document.getElementById(\"volta', 0, 534, 'fotos_usuario/default.jpg'),
('', '', 0, 535, 'fotos_usuario/default.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mecanico`
--

CREATE TABLE `mecanico` (
  `cod_mecanico` int(11) NOT NULL,
  `cod_login` int(11) NOT NULL,
  `cod_oficina` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `rg` varchar(30) NOT NULL,
  `cpf` varchar(30) NOT NULL,
  `telefone` int(11) NOT NULL,
  `cep` int(11) NOT NULL,
  `estado` varchar(200) NOT NULL,
  `cidade` varchar(200) NOT NULL,
  `rua` varchar(11) NOT NULL,
  `sobrenome` varchar(200) NOT NULL,
  `bairro` varchar(200) NOT NULL,
  `complemento` varchar(200) NOT NULL,
  `celular` varchar(200) NOT NULL,
  `numero` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mecanico`
--

INSERT INTO `mecanico` (`cod_mecanico`, `cod_login`, `cod_oficina`, `nome`, `rg`, `cpf`, `telefone`, `cep`, `estado`, `cidade`, `rua`, `sobrenome`, `bairro`, `complemento`, `celular`, `numero`) VALUES
(6, 53, 10, 'pedro gay', '53.428.953-8', '51183514808', 1919191919, 12236493, 'PB', 'SÃ£o JosÃ© dos Campos', 'Rua Lenine ', '', '12qhjkaw', '2', '11144774747', '2'),
(7, 90, 10, 'pedro gay', '53.428.953-8', '51183514808', 1919191919, 12236493, 'PB', 'SÃ£o JosÃ© dos Campos', 'Rua Lenine ', '', '12qhjkaw', '2', '11144774747', '2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagens`
--

CREATE TABLE `mensagens` (
  `text` varchar(200) NOT NULL,
  `cod_mensagem` int(11) NOT NULL,
  `cod_servico` int(11) NOT NULL,
  `cod_autor` int(11) NOT NULL,
  `cod_orcamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mensagens`
--

INSERT INTO `mensagens` (`text`, `cod_mensagem`, `cod_servico`, `cod_autor`, `cod_orcamento`) VALUES
('djsk', 159, 22, 53, 0),
('ola?', 160, 22, 53, 0),
('ff', 161, 22, 57, 0),
('dkl', 162, 22, 57, 0),
('sdad', 163, 22, 53, 0),
('aee krai', 164, 22, 53, 0),
('', 165, 22, 53, 0),
('', 166, 22, 53, 0),
('', 167, 22, 53, 0),
('', 168, 22, 53, 0),
('', 169, 22, 53, 0),
('', 170, 22, 53, 0),
('', 171, 22, 53, 23),
('', 172, 22, 53, 0),
('', 173, 22, 53, 0),
('huik', 176, 22, 53, 0),
('', 177, 22, 53, 26),
('f', 178, 22, 53, 0),
('r', 179, 22, 53, 0),
('r', 180, 22, 57, 0),
('f', 181, 22, 57, 0),
('', 182, 20, 53, 27),
('', 183, 13, 53, 28);

-- --------------------------------------------------------

--
-- Estrutura da tabela `oficina`
--

CREATE TABLE `oficina` (
  `cod_oficina` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `rua` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `cep` varchar(50) NOT NULL,
  `cnpj` varchar(200) NOT NULL,
  `cod_login` int(11) NOT NULL,
  `telefone` int(11) NOT NULL,
  `complemento` varchar(200) NOT NULL,
  `numero` varchar(200) NOT NULL,
  `bairro` varchar(200) NOT NULL,
  `celular` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `galeria` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `oficina`
--

INSERT INTO `oficina` (`cod_oficina`, `nome`, `rua`, `cidade`, `estado`, `cep`, `cnpj`, `cod_login`, `telefone`, `complemento`, `numero`, `bairro`, `celular`, `descricao`, `galeria`) VALUES
(10, 'vetormmf', 'la', 'Abadia dos Dourados', 'Minas Gerais', '11111111', '3847655000198', 38, 1239336376, 'cu', '', 'vamos', 1122828282, '', 'fotos_usuarios/08611df5ac6d895b4ec88583390918c6.png'),
(11, 'vetormmf', 'la', 'Abadia dos Dourados', 'Minas Gerais', '11111111', '3847655000198', 32, 1239336376, 'cu', '', 'vamos', 1122828282, '', 'e');

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento`
--

CREATE TABLE `orcamento` (
  `cod_orcamento` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `data` varchar(200) NOT NULL,
  `detalhes` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `cod_servico` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `orcamento`
--

INSERT INTO `orcamento` (`cod_orcamento`, `valor`, `data`, `detalhes`, `status`, `cod_servico`) VALUES
(1, 355, '0002-02-02', '2', 1, 0),
(2, 22, '0003-03-12', 'detalhes sempre vem primerio não?', 1, 0),
(3, 1, '0001-11-11', '1', 1, 0),
(4, 34, '0003-03-31', '3', 1, 0),
(5, 3, '0003-03-03', '3', 1, 0),
(6, 3, '', '3', 1, 0),
(7, 25617, '0678-05-04', '567892', 1, 0),
(8, 777, '0007-07-07', '7', 1, 0),
(9, 366, '0006-06-06', '6', 1, 0),
(10, 2, '2011-02-02', 'sas', 1, 0),
(11, 3729, '9229-02-09', '280', 1, 0),
(12, 646, '0627-02-06', '7', 1, 0),
(13, 74387, '', 'rehjnk', 1, 0),
(14, 22, '2222-02-22', '22', 1, 0),
(15, 1, '0001-11-11', '1', 1, 0),
(16, 1, '0001-11-11', '1', 1, 0),
(17, 3, '', '', 1, 0),
(18, 3, '', '', 1, 0),
(19, 737, '0828-02-08', 'ehjsaj,', 1, 0),
(20, 4, '', '', 1, 0),
(21, 4, '', '', 0, 13),
(22, 4, '', '', 0, 13),
(23, 10000, '5345-03-04', '345345', 0, 12),
(26, 3546, '0567-03-04', '32456', 2, 22),
(27, 65467, '0789-06-05', '687', 2, 20),
(28, 12, '0011-02-23', '21', 1, 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE `servico` (
  `cod_servico` int(11) NOT NULL,
  `cod_cliente` int(11) NOT NULL,
  `cod_mecanico` int(11) NOT NULL,
  `cod_oficina` varchar(11) NOT NULL,
  `tipo_servico` varchar(50) NOT NULL,
  `cod_veiculo` int(11) NOT NULL,
  `protocolo` int(11) NOT NULL,
  `orcamento` int(11) NOT NULL,
  `problema` varchar(200) NOT NULL,
  `servico_desejado` varchar(200) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `servico`
--

INSERT INTO `servico` (`cod_servico`, `cod_cliente`, `cod_mecanico`, `cod_oficina`, `tipo_servico`, `cod_veiculo`, `protocolo`, `orcamento`, `problema`, `servico_desejado`, `status`) VALUES
(12, 18, 6, '10', 'ghdisjolksd', 44, 969414268, 12, '', '', 4),
(13, 18, 6, '10', 'troca', 43, 598653495, 0, '', '', 4),
(14, 18, 6, '10', 'troca', 2, 708539985, 0, 'wed', 'ss', 1),
(15, 18, 6, '10', '2', 2, 929215468, 0, '1', '2', 1),
(16, 18, 0, '2', '3', 3, 1129792302, 0, '3', '1', 0),
(17, 18, 0, '12', '3', 3, 42085776, 0, '3', '1', 0),
(18, 18, 0, '92992', '3', 2, 826207296, 0, '3', '1', 0),
(19, 18, 6, '10', '', 44, 1243476072, 0, 'sbdmnz,', 'sdfsd', 1),
(20, 18, 6, '10', '', 44, 389968025, 0, 'sbdmnz,', 'sdfsd', 4),
(21, 18, 6, '10', '', 43, 663490943, 0, 'tywuu', 'uik', 4),
(22, 18, 6, '10', '', 43, 2069072999, 0, 'tywuu', 'uik', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `status`
--

CREATE TABLE `status` (
  `status` varchar(200) NOT NULL,
  `cod_servico` int(11) NOT NULL,
  `comentario` varchar(200) NOT NULL,
  `cod_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `status`
--

INSERT INTO `status` (`status`, `cod_servico`, `comentario`, `cod_status`) VALUES
('0', 19, '', 1),
('0', 20, '', 2),
('0', 21, '', 3),
('0', 22, '', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculo`
--

CREATE TABLE `veiculo` (
  `cod_veiculo` int(11) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  `cor` varchar(50) NOT NULL,
  `ano` varchar(50) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `placa` varchar(200) NOT NULL,
  `cod_cliente` int(11) NOT NULL,
  `marca` varchar(200) NOT NULL,
  `tipo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `veiculo`
--

INSERT INTO `veiculo` (`cod_veiculo`, `modelo`, `cor`, `ano`, `descricao`, `placa`, `cod_cliente`, `marca`, `tipo`) VALUES
(2, '2', '2', '2', '2[', '2', 1, '', 'caminhao'),
(3, '333', '3', '3', '3', '3', 1, '', ''),
(43, '300-SL 3.0', 'azul', '2018', '', 'dbs-3222', 18, '', 'carro'),
(44, '350Z 3.5 V6 280cv/ 312cv 2p', 'azul', '2018', '', 'rbf-3321', 18, '', 'carro'),
(45, 'Avalon XLS 3.0', 'azul', '2015', '', 'uak-3782', 18, '', 'carro'),
(46, 'CALIFFONE 50cc', 'azul', '2018', '', 'vsa-6728', 18, '', 'motos'),
(47, '440 Turbo 1.8', 'azul', '2018', '', 'jke-3939', 18, '', 'motos');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`cod_agenda`);

--
-- Indexes for table `atualizacao`
--
ALTER TABLE `atualizacao`
  ADD PRIMARY KEY (`cod_atualizacao`);

--
-- Indexes for table `avaliacao`
--
ALTER TABLE `avaliacao`
  ADD PRIMARY KEY (`cod_avaliacao`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cod_cliente`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`cod_login`);

--
-- Indexes for table `mecanico`
--
ALTER TABLE `mecanico`
  ADD PRIMARY KEY (`cod_mecanico`);

--
-- Indexes for table `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`cod_mensagem`);

--
-- Indexes for table `oficina`
--
ALTER TABLE `oficina`
  ADD PRIMARY KEY (`cod_oficina`);

--
-- Indexes for table `orcamento`
--
ALTER TABLE `orcamento`
  ADD PRIMARY KEY (`cod_orcamento`);

--
-- Indexes for table `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`cod_servico`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`cod_status`);

--
-- Indexes for table `veiculo`
--
ALTER TABLE `veiculo`
  ADD PRIMARY KEY (`cod_veiculo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `cod_agenda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `atualizacao`
--
ALTER TABLE `atualizacao`
  MODIFY `cod_atualizacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `cod_avaliacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cod_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `cod_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=536;

--
-- AUTO_INCREMENT for table `mecanico`
--
ALTER TABLE `mecanico`
  MODIFY `cod_mecanico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `cod_mensagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=184;

--
-- AUTO_INCREMENT for table `oficina`
--
ALTER TABLE `oficina`
  MODIFY `cod_oficina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orcamento`
--
ALTER TABLE `orcamento`
  MODIFY `cod_orcamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `servico`
--
ALTER TABLE `servico`
  MODIFY `cod_servico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `cod_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `cod_veiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
