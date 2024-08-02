-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/08/2024 às 15:36
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gamelandia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_clientes`
--

CREATE TABLE `tb_clientes` (
  `ID` int(10) NOT NULL,
  `NOME_COMP` varchar(150) NOT NULL,
  `ENDERECO` varchar(250) NOT NULL,
  `CPF` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_clientes`
--

INSERT INTO `tb_clientes` (`ID`, `NOME_COMP`, `ENDERECO`, `CPF`) VALUES
(7, 'Rawan', '213213', '12345678910'),
(8, 'Paulo', 'asdsadasd', '21322133333'),
(9, 'Moura', '213213', '2131231232'),
(10, 'Gabriel', 'asdsadasd', '21322133333');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_produtos`
--

CREATE TABLE `tb_produtos` (
  `ID` int(10) NOT NULL,
  `PRODUTO` varchar(150) NOT NULL,
  `TIPO` char(50) NOT NULL,
  `PLATAFORMA` char(40) NOT NULL,
  `DESCRICAO` varchar(500) NOT NULL,
  `FOTO` char(150) NOT NULL,
  `VALOR` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_produtos`
--

INSERT INTO `tb_produtos` (`ID`, `PRODUTO`, `TIPO`, `PLATAFORMA`, `DESCRICAO`, `FOTO`, `VALOR`) VALUES
(2, 'Dragon Ball Super', 'GAME', 'PS2', 'DBS', 'download.jpg', 1212);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_vendas`
--

CREATE TABLE `tb_vendas` (
  `ID` int(11) NOT NULL,
  `FK_ID_CLI` int(11) NOT NULL,
  `FK_ID_PRO` int(11) NOT NULL,
  `DATA` date NOT NULL,
  `COD_VENDA` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tb_vendas`
--

INSERT INTO `tb_vendas` (`ID`, `FK_ID_CLI`, `FK_ID_PRO`, `DATA`, `COD_VENDA`) VALUES
(5, 7, 2, '2024-08-01', 1),
(6, 8, 2, '2024-08-01', 1),
(7, 9, 2, '2024-08-01', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tb_clientes`
--
ALTER TABLE `tb_clientes`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  ADD PRIMARY KEY (`ID`);

--
-- Índices de tabela `tb_vendas`
--
ALTER TABLE `tb_vendas`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_ID_CLI` (`FK_ID_CLI`),
  ADD KEY `FK_ID_PRO` (`FK_ID_PRO`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_clientes`
--
ALTER TABLE `tb_clientes`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `tb_produtos`
--
ALTER TABLE `tb_produtos`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tb_vendas`
--
ALTER TABLE `tb_vendas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tb_vendas`
--
ALTER TABLE `tb_vendas`
  ADD CONSTRAINT `tb_vendas_ibfk_1` FOREIGN KEY (`FK_ID_CLI`) REFERENCES `tb_clientes` (`ID`),
  ADD CONSTRAINT `tb_vendas_ibfk_2` FOREIGN KEY (`FK_ID_CLI`) REFERENCES `tb_clientes` (`ID`),
  ADD CONSTRAINT `tb_vendas_ibfk_3` FOREIGN KEY (`FK_ID_CLI`) REFERENCES `tb_clientes` (`ID`),
  ADD CONSTRAINT `tb_vendas_ibfk_4` FOREIGN KEY (`FK_ID_PRO`) REFERENCES `tb_produtos` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
