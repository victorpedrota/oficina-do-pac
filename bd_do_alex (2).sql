-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 02-Ago-2018 às 07:39
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
-- Estrutura da tabela `avaliacao`
--

CREATE TABLE `avaliacao` (
  `cod_avaliacao` int(11) NOT NULL,
  `nota` int(11) NOT NULL,
  `comentario` varchar(100) NOT NULL,
  `cod_cliente` int(11) NOT NULL,
  `cod_oficina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `data_nascimento` varchar(200) NOT NULL,
  `imagem` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`cod_cliente`, `cod_login`, `nome`, `rg`, `cpf`, `rua`, `estado`, `cep`, `cidade`, `telefone`, `bairro`, `complemento`, `sobrenome`, `numero`, `celular`, `data_nascimento`, `imagem`) VALUES
(1, 60, 'vicror', 534289538, '51183514808', 'Rua Cristiane de Souza Ramos', 's123', 12236491, '2', '2147483647', 'Jardim Sul', '123', 'pedrota', '123', '2147483647', '02/08/1992', 'Victor.jpg'),
(18, 57, 'victor', 222222223, '25011106845', 'Estrada do Portela', 'RJ', 21351050, 'Rio de Janeiro', '11111112222', 'Madureira', '1221', 'pedrota', '1229929', '21994742222', '', 'fotos_usuarios/b86703cce36f5c094392abed0e05586a.jpg');

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
('oficina', '22', 2, 38, ''),
('mecanico', '22', 1, 53, 'fotos_usuarios/123.jpg'),
('cliente', '123456', 0, 57, 'fotos_usuarios/123.jpg'),
('1234567', '1234567', 0, 58, ''),
('12345672', '1234567', 0, 59, ''),
('2', '2', 0, 60, ''),
('111111111111111', '111111111111111', 0, 62, ''),
('victor2001', 'victor0308', 0, 63, ''),
('1', '1', 0, 64, ''),
('vaiiiiiiiiii', 'enfianocuuuuuu', 1, 532, ''),
('', '', 0, 533, '');

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
(6, 53, 10, 'pedro gay', '53.428.953-8', '51183514808', 1919191919, 12236493, 'SP', 'SÃ£o JosÃ© dos Campos', 'Rua Lenine ', '', 'Jardim Sul', '2', '44774747474', '2');

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
('teste', 74, 12, 51, 0),
('dsdkjl', 75, 12, 53, 0),
('d', 76, 12, 53, 0),
('', 77, 12, 53, 0),
('teste', 78, 12, 53, 0),
('', 79, 14, 53, 0),
('qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq', 80, 14, 53, 0),
('do u', 81, 14, 53, 2),
('dswq', 82, 13, 53, 0),
('dswq', 83, 13, 53, 0),
('', 84, 14, 53, 0),
('', 87, 13, 53, 0),
('', 88, 13, 53, 0),
('', 89, 12, 53, 0),
('', 90, 13, 53, 0),
('', 91, 13, 53, 7),
('e', 92, 14, 53, 0),
('foi?', 93, 14, 51, 0),
('', 94, 12, 53, 9),
('s', 95, 12, 53, 0),
('s', 96, 12, 53, 0),
('', 97, 12, 53, 11),
('h', 98, 12, 53, 0),
('s', 99, 12, 57, 0),
('aloha', 100, 12, 57, 0),
('', 101, 12, 57, 0),
('l', 102, 12, 57, 0),
('', 103, 12, 57, 0),
('', 104, 12, 57, 0),
('', 105, 12, 57, 0),
('', 106, 12, 57, 0),
('', 107, 12, 53, 12),
('', 108, 12, 57, 0),
('', 109, 12, 57, 0),
('', 110, 12, 57, 0),
('', 111, 12, 57, 0),
('', 112, 12, 57, 0),
('', 113, 12, 57, 0),
('1', 114, 12, 57, 0),
('', 115, 12, 57, 0),
('', 116, 12, 57, 0),
('', 117, 12, 57, 0),
('', 118, 12, 57, 0),
('', 119, 12, 57, 0),
('', 120, 12, 57, 0),
('', 121, 12, 57, 0),
('', 122, 12, 57, 0),
('', 123, 12, 57, 0),
('', 124, 12, 57, 0),
('', 125, 12, 57, 0),
('', 126, 12, 57, 0),
('', 129, 12, 57, 0),
('', 130, 12, 57, 0),
('', 131, 12, 57, 0),
('', 132, 12, 57, 0),
('j', 133, 12, 57, 0),
('', 134, 12, 57, 0),
('', 135, 13, 53, 18),
('', 136, 13, 53, 19),
('', 137, 13, 53, 20),
('', 138, 13, 53, 21),
('', 139, 13, 53, 22),
('d', 140, 13, 53, 0),
('', 141, 13, 53, 0),
('', 142, 13, 53, 0),
('', 143, 13, 53, 0),
('', 144, 13, 57, 0),
('', 145, 13, 57, 0),
('', 146, 13, 57, 0),
('', 147, 13, 57, 0),
('', 148, 13, 57, 0),
('', 149, 13, 57, 0),
('', 150, 13, 57, 0);

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
  `celular` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `oficina`
--

INSERT INTO `oficina` (`cod_oficina`, `nome`, `rua`, `cidade`, `estado`, `cep`, `cnpj`, `cod_login`, `telefone`, `complemento`, `numero`, `bairro`, `celular`) VALUES
(10, 'vetormmf', 'la', 'Abadia dos Dourados', 'Minas Gerais', '11111111', '3847655000198', 38, 1239336376, 'cu', '', 'vamos', 1122828282),
(11, 'chegod', 'la', 'Abadia dos Dourados', 'Minas Gerais', '11111111', '3847655000198', 32, 1239336376, 'cu', '', 'vamos', 1122828282);

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
(22, 4, '', '', 1, 13);

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
(12, 18, 6, '10', 'ghdisjolksd', 44, 969414268, 12, '', '', 2),
(13, 18, 6, '10', 'troca', 43, 598653495, 0, '', '', 2),
(14, 18, 6, '10', 'troca', 2, 708539985, 0, 'wed', 'ss', 1),
(15, 18, 0, '1', '2', 2, 929215468, 0, '1', '2', 0),
(16, 18, 0, '2', '3', 3, 1129792302, 0, '3', '1', 0),
(17, 18, 0, '92992', '3', 3, 42085776, 0, '3', '1', 0),
(18, 18, 0, '92992', '3', 2, 826207296, 0, '3', '1', 0);

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
('1', 12, '', 6),
('0', 13, '', 7),
('0', 14, '', 8),
('0', 15, '', 9),
('0', 16, '', 10),
('0', 17, '', 11),
('0', 18, '', 12),
('0', 19, '', 13),
('0', 20, '', 14),
('0', 21, '', 15),
('0', 22, '', 16),
('0', 23, '', 17),
('0', 24, '', 18),
('0', 25, '', 19),
('0', 26, '', 20),
('0', 27, '', 21),
('0', 28, '', 22),
('0', 29, '', 23),
('0', 30, '', 24),
('0', 31, '', 25),
('0', 32, '', 26),
('0', 33, '', 27);

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
(43, '100 2.8 V6', 'azul', '2018', '', 'dbs-3222', 18, '', 'moto'),
(44, '118iA 2.0 16V 136cv 3p', 'azul', '2018', '', 'rbf-3321', 18, 'CitroÃ«n', 'moto'),
(45, '116iA 1.6 TB 16V 136cv 5p', 'azul', '2015', '', 'uak-3782', 18, 'BMW', 'carro'),
(46, '100 2.8 V6', 'azul', '2018', '', 'vsa-6728', 18, 'Audi', 'moto'),
(47, '116iA 1.6 TB 16V 136cv 5p', 'azul', '2018', '', 'jke-3939', 18, 'BMW', 'moto');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`cod_agenda`);

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
-- AUTO_INCREMENT for table `avaliacao`
--
ALTER TABLE `avaliacao`
  MODIFY `cod_avaliacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cod_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `cod_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=534;

--
-- AUTO_INCREMENT for table `mecanico`
--
ALTER TABLE `mecanico`
  MODIFY `cod_mecanico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `cod_mensagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `oficina`
--
ALTER TABLE `oficina`
  MODIFY `cod_oficina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orcamento`
--
ALTER TABLE `orcamento`
  MODIFY `cod_orcamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `servico`
--
ALTER TABLE `servico`
  MODIFY `cod_servico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `cod_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `cod_veiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
