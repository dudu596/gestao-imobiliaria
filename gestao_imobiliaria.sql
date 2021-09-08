-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08-Set-2021 às 12:25
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gestao_imobiliaria`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `email`, `telefone`) VALUES
(23, 'Luiz Eduardo de Melo', 'demelo.luizeduardo@gmail.com', 48998320943),
(24, 'Teste 01', 'email@email.com', 123456789),
(25, 'Teste 02', 'email2@email.com', 132456789);

-- --------------------------------------------------------

--
-- Estrutura da tabela `contrato`
--

CREATE TABLE `contrato` (
  `id` int(11) NOT NULL,
  `id_imovel` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `taxa_administracao` decimal(10,0) NOT NULL,
  `valor_aluguel` decimal(10,0) NOT NULL,
  `valor_condominio` decimal(10,0) NOT NULL,
  `valor_iptu` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `contrato`
--

INSERT INTO `contrato` (`id`, `id_imovel`, `id_cliente`, `data_inicio`, `data_fim`, `taxa_administracao`, `valor_aluguel`, `valor_condominio`, `valor_iptu`) VALUES
(1, 2, 23, '2021-04-18', '2022-04-18', '100', '1200', '200', '200'),
(3, 2, 23, '2021-09-08', '2021-09-30', '100', '1200', '200', '200'),
(4, 3, 25, '2021-09-30', '2022-02-01', '1000', '12000', '2000', '2000');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imovel`
--

CREATE TABLE `imovel` (
  `id` int(11) NOT NULL,
  `id_proprietario` int(11) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `numero` int(11) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `cep` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `imovel`
--

INSERT INTO `imovel` (`id`, `id_proprietario`, `rua`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `cep`) VALUES
(2, 2, 'Rua das Acácias', 242, '', 'Areias', 'Tijucas', 'Santa Catarina', 88200000),
(3, 3, 'Rua das Acácias', 123, '', 'Areias', 'Tijucas', 'Santa Catarina', 88200000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensalidade`
--

CREATE TABLE `mensalidade` (
  `id` int(11) NOT NULL,
  `id_contrato` int(11) NOT NULL,
  `mes` date NOT NULL,
  `mensalidade` decimal(10,0) NOT NULL,
  `repasse` decimal(10,0) NOT NULL,
  `mensalidade_paga` tinyint(4) NOT NULL DEFAULT 0,
  `repasse_realizado` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `mensalidade`
--

INSERT INTO `mensalidade` (`id`, `id_contrato`, `mes`, `mensalidade`, `repasse`, `mensalidade_paga`, `repasse_realizado`) VALUES
(1, 4, '2021-09-01', '16000', '13000', 0, 0),
(2, 4, '2021-10-01', '16000', '13000', 0, 0),
(3, 4, '2021-11-01', '16000', '13000', 0, 0),
(5, 4, '2022-01-01', '16000', '13000', 0, 0),
(6, 4, '2022-02-01', '16000', '13000', 0, 0),
(7, 4, '2021-12-01', '16000', '13000', 0, 0),
(8, 3, '2021-09-01', '1600', '1300', 1, 0),
(9, 1, '2021-04-01', '1600', '1300', 1, 1),
(10, 1, '2021-05-01', '1600', '1300', 1, 0),
(11, 1, '2021-06-01', '1600', '1300', 0, 0),
(12, 1, '2021-07-01', '1600', '1300', 0, 0),
(13, 1, '2021-08-01', '1600', '1300', 0, 0),
(14, 1, '2021-09-01', '1600', '1300', 0, 0),
(15, 1, '2021-10-01', '1600', '1300', 0, 0),
(16, 1, '2021-11-01', '1600', '1300', 0, 0),
(17, 1, '2021-12-01', '1600', '1300', 0, 0),
(18, 1, '2022-01-01', '1600', '1300', 0, 0),
(19, 1, '2022-02-01', '1600', '1300', 0, 0),
(20, 1, '2022-03-01', '1600', '1300', 0, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `proprietario`
--

CREATE TABLE `proprietario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` bigint(20) NOT NULL,
  `dia_repasse` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `proprietario`
--

INSERT INTO `proprietario` (`id`, `nome`, `email`, `telefone`, `dia_repasse`) VALUES
(2, 'Yasmin Santos de Camargo', 'demelo.luizeduardo@gmail.com', 48998318356, 15),
(3, 'Proprietário 01', 'proprietario@email.com', 8034670332, 15);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `imovel`
--
ALTER TABLE `imovel`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `mensalidade`
--
ALTER TABLE `mensalidade`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `proprietario`
--
ALTER TABLE `proprietario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `contrato`
--
ALTER TABLE `contrato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `imovel`
--
ALTER TABLE `imovel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `mensalidade`
--
ALTER TABLE `mensalidade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `proprietario`
--
ALTER TABLE `proprietario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
