-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11-Jul-2018 às 21:41
-- Versão do servidor: 10.1.28-MariaDB
-- PHP Version: 7.1.11

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
  `telefone` int(11) NOT NULL,
  `bairro` varchar(30) NOT NULL,
  `complemento` varchar(90) NOT NULL,
  `sobrenome` varchar(90) NOT NULL,
  `numero` varchar(90) NOT NULL,
  `celular` int(11) NOT NULL,
  `data_nascimento` varchar(200) NOT NULL,
  `imagem` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`cod_cliente`, `cod_login`, `nome`, `rg`, `cpf`, `rua`, `estado`, `cep`, `cidade`, `telefone`, `bairro`, `complemento`, `sobrenome`, `numero`, `celular`, `data_nascimento`, `imagem`) VALUES
(1, 60, 'vicror', 534289538, '51183514808', 'Rua Cristiane de Souza Ramos', 's123', 12236491, '2', 2147483647, 'Jardim Sul', '123', 'pedrota', '123', 2147483647, '02/08/1992', ''),
(18, 57, '2', 222222223, '25011106845', 'Rua MaurÃ­cio Cardoso', 'SP', 12236495, 'SÃ£o JosÃ© dos Campos', 2147483647, 'Jardim Sul', '0', '2', '0', 1213131112, '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login`
--

CREATE TABLE `login` (
  `login` varchar(30) NOT NULL,
  `senha` varchar(30) NOT NULL,
  `privilegio` int(11) NOT NULL,
  `cod_login` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `login`
--

INSERT INTO `login` (`login`, `senha`, `privilegio`, `cod_login`) VALUES
('oficina', '22', 2, 38),
('mecanico', '22', 1, 53),
('cliente', '22', 0, 57),
('1234567', '1234567', 0, 58),
('12345672', '1234567', 0, 59),
('2', '2', 0, 60),
('111111111111111', '111111111111111', 0, 62),
('victor2001', 'victor0308', 0, 63),
('1', '1', 0, 64),
('vaiiiiiiiiii', 'enfianocuuuuuu', 1, 532);

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
  `endereco` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `mecanico`
--

INSERT INTO `mecanico` (`cod_mecanico`, `cod_login`, `cod_oficina`, `nome`, `rg`, `cpf`, `telefone`, `cep`, `estado`, `cidade`, `endereco`) VALUES
(6, 53, 10, 'jjjjjjjjjjjjjjjj', '53.428.953-8', '51183514808', 1919191919, 11111111, 'Distrito Federal', 'BrasÃ­lia', 'lllllllllll');

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
(10, 'vetormmf', 'la', 'Abadia dos Dourados', 'Minas Gerais', '11111111', '3847655000198', 38, 1239336376, 'cu', '', 'vamos', 1122828282);

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE `servico` (
  `cod_servico` int(11) NOT NULL,
  `cod_cliente` int(11) NOT NULL,
  `cod_mecanico` int(11) NOT NULL,
  `cod_oficina` int(11) NOT NULL,
  `tipo_servico` varchar(50) NOT NULL,
  `cod_veiculo` int(11) NOT NULL,
  `protocolo` int(11) NOT NULL,
  `orcamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `servico`
--

INSERT INTO `servico` (`cod_servico`, `cod_cliente`, `cod_mecanico`, `cod_oficina`, `tipo_servico`, `cod_veiculo`, `protocolo`, `orcamento`) VALUES
(12, 18, 0, 10, 'ghdisjolksd', 5, 969414268, 12);

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
('1', 12, '', 6);

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
  `chassi` varchar(11) NOT NULL,
  `cod_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `veiculo`
--

INSERT INTO `veiculo` (`cod_veiculo`, `modelo`, `cor`, `ano`, `descricao`, `placa`, `chassi`, `cod_cliente`) VALUES
(1, '1', '1', '1', '1', '1', '11', 1),
(2, '2', '2', '2', '2[', '2', '22', 1),
(3, '333', '3', '3', '3', '3', '33', 1),
(4, 'carro pika', 'pika', '2000', 'Ã© pika', 'pika1234', '1234', 18),
(5, 'carro pika 2', '2222222', '22222222', '222', '2222222222', '2222222', 18);

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
-- Indexes for table `oficina`
--
ALTER TABLE `oficina`
  ADD PRIMARY KEY (`cod_oficina`);

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
  MODIFY `cod_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=533;

--
-- AUTO_INCREMENT for table `mecanico`
--
ALTER TABLE `mecanico`
  MODIFY `cod_mecanico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `oficina`
--
ALTER TABLE `oficina`
  MODIFY `cod_oficina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `servico`
--
ALTER TABLE `servico`
  MODIFY `cod_servico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `cod_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `veiculo`
--
ALTER TABLE `veiculo`
  MODIFY `cod_veiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
