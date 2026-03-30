-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/03/2026 às 01:33
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `logins`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastros`
--

CREATE TABLE `cadastros` (
  `id_cad` int(11) NOT NULL,
  `email_cad` varchar(80) NOT NULL,
  `senha_cad` varchar(100) NOT NULL,
  `nome_id` varchar(30) NOT NULL,
  `reset_token` varchar(64) DEFAULT NULL,
  `reset_token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastros`
--

INSERT INTO `cadastros` (`id_cad`, `email_cad`, `senha_cad`, `nome_id`, `reset_token`, `reset_token_expiry`) VALUES
(1, 'admin@admin', '$2y$10$RlPPN3QBofG9C3V9MXPCduHEgomdX8nLGwAV47Pepu7VCvzNzm0zG', 'admin', NULL, NULL),
(55, 'rteasdh@gmail.com', '$2y$10$ONRHp/JHUOlE4TDHCSE/WOYO8KdYzr9MaoNrBHDAau1OUWRlnzgzW', 'Guigas', NULL, NULL),
(56, 'guigas@gmai.com', '$2y$10$qP34vHh0jvke9XUiDtxnoO2DvgV.3oknFAoiVbfCFzyfgTr6hIqE6', 'sadasdasdas', NULL, NULL),
(57, 'abracos@gmail.com', '$2y$10$w2jCxaW.hpqMUBDD1StzBOXZ1muFVgr0BQW9u3o2.TVkzDyn9P.pS', 'Junior', NULL, NULL),
(58, 'guigasegabis@gmail.com', '$2y$10$/62kRLg0evmzeRHcN0Q1/uaBcfg7mP.AQTjbekWU3jgW5PAYg2zsy', 'Dr.Geraldo', NULL, NULL),
(59, 'guilhermeramos@gmail.com', '$2y$10$earcsTL8iytST36981qYj.aaqfA0sTGRPyzWWsg9/kGPoFxjeVwQ6', 'Guilherme', NULL, NULL),
(60, 'guilherem@gmail.com', '$2y$10$wCsODvSgwcvMA8DXq8D61ea3ETcCdxPcFP78ulc4sYJG.HbM3SQVi', 'Dr.Octavius', NULL, NULL),
(61, 'guilhermeramos040620@gmail.com', '$2y$10$w8kfCnwqLUso4p0Hp90NoedopKoWwUaLOssShz3CEduKJg/cRwVcO', 'Guilhermo', NULL, NULL),
(62, 'selmalima@gmail.com', '$2y$10$e21ZA0CpUwVAdTMxRO86PujqZh0qam2rhm4N7dL9hQVYaXr6Id4uq', 'sesse', NULL, NULL),
(63, 'trezechavinha@gmail.com', '$2y$10$O0CMAL.6FdF.4SRkV5cu8ux0J6RkNsbbIOmYG.iTJwHuQkyoung3W', 'GuigasCFC', NULL, NULL),
(64, 'guilhermelimaramos2005@gmail.com', '$2y$10$nhc5yTOEQ7/6N.kCaQGV7.A4ZfIrohlEpE3Bdd8OfZsopzzqpaZfm', 'testess', NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cadastros`
--
ALTER TABLE `cadastros`
  ADD PRIMARY KEY (`id_cad`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastros`
--
ALTER TABLE `cadastros`
  MODIFY `id_cad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
