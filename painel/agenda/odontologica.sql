-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 08-Ago-2017 às 08:02
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `odontologica`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_agenda`
--

CREATE TABLE `tb_agenda` (
  `id` int(11) NOT NULL,
  `agenda_procedimento` varchar(150) NOT NULL,
  `agenda_data_inicio` varchar(8) NOT NULL,
  `agenda_data_fim` varchar(8) NOT NULL,
  `agenda_hora_inicio` varchar(5) NOT NULL,
  `agenda_hora_fim` varchar(5) NOT NULL,
  `agenda_cliente` varchar(250) NOT NULL,
  `agenda_color` varchar(10) NOT NULL,
  `agenda_cliente_id` int(11) NOT NULL,
  `agenda_cod_dentista` varchar(10) NOT NULL,
  `agenda_procedimento_id` int(11) NOT NULL,
  `agenda_convenio` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_agenda`
--

INSERT INTO `tb_agenda` (`id`, `agenda_procedimento`, `agenda_data_inicio`, `agenda_data_fim`, `agenda_hora_inicio`, `agenda_hora_fim`, `agenda_cliente`, `agenda_color`, `agenda_cliente_id`, `agenda_cod_dentista`, `agenda_procedimento_id`, `agenda_convenio`) VALUES
(227, 'ATIVIDADE EDUCATIVA', '20170809', '20170809', '08:00', '09:00', 'DANIEL LUIZ DANNA', '', 55, '11', 2, 'teste');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_clientes`
--

CREATE TABLE `tb_clientes` (
  `id` int(11) NOT NULL,
  `cli_tipo` varchar(1) NOT NULL,
  `cli_cpf` varchar(14) NOT NULL,
  `cli_cnpj` varchar(18) NOT NULL,
  `cli_nome` varchar(250) NOT NULL,
  `cli_endereco` varchar(250) NOT NULL,
  `cli_cidade` varchar(250) NOT NULL,
  `cli_uf` varchar(100) NOT NULL,
  `cli_bairro` varchar(250) NOT NULL,
  `cli_cep` varchar(9) NOT NULL,
  `cli_telefone` varchar(15) NOT NULL,
  `cli_email` varchar(250) NOT NULL,
  `cli_obs` varchar(2000) NOT NULL,
  `cli_nascimento` varchar(8) NOT NULL,
  `cli_rg` varchar(9) NOT NULL,
  `cli_inscricao` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_clientes`
--

INSERT INTO `tb_clientes` (`id`, `cli_tipo`, `cli_cpf`, `cli_cnpj`, `cli_nome`, `cli_endereco`, `cli_cidade`, `cli_uf`, `cli_bairro`, `cli_cep`, `cli_telefone`, `cli_email`, `cli_obs`, `cli_nascimento`, `cli_rg`, `cli_inscricao`) VALUES
(55, 'F', '090.959.069.90', '', 'DANIEL LUIZ DANNA', 'RUA VENCESLAU UHLIG 96', 'RIO NEGRINHO', 'SC', 'CERAMARTE', '89295-000', '(47) 9229-7331', 'daniel.daanna@gmail.com', '', '19930826', '5.798.059', ''),
(54, 'F', '248.923.609-10', '', 'JOSE JUNKES', 'RUA NITEROI - 165', 'GASPAR', 'SC', 'MARGENTSG', '89114-442', '(47) 3332-0593', '', '', '', '6.006.14', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_grade`
--

CREATE TABLE `tb_grade` (
  `id` int(11) NOT NULL,
  `grade_dentista_id` int(11) NOT NULL,
  `grade_dentista` varchar(150) NOT NULL,
  `grade_dia` varchar(1) NOT NULL,
  `grade_hora_inicial` varchar(5) NOT NULL,
  `grade_hora_final` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_grade`
--

INSERT INTO `tb_grade` (`id`, `grade_dentista_id`, `grade_dentista`, `grade_dia`, `grade_hora_inicial`, `grade_hora_final`) VALUES
(21, 11, 'DR DANIEL ', '4', '12:00', '10:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_procedimentos`
--

CREATE TABLE `tb_procedimentos` (
  `id` int(11) NOT NULL,
  `procedimentos_descricao` varchar(256) NOT NULL,
  `procedimentos_cor` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_procedimentos`
--

INSERT INTO `tb_procedimentos` (`id`, `procedimentos_descricao`, `procedimentos_cor`) VALUES
(1, 'CONSULTA INICIAL', '383838'),
(2, 'ATIVIDADE EDUCATIVA', '380000'),
(3, 'APLICAÇÃO DE CARIOSTÁTICO', '870087'),
(4, 'BIÓPSIA', '6b5600'),
(7, 'EXAME CLÍNICO', '3d4500');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `USU_ID` int(11) NOT NULL,
  `USU_USUARIO` varchar(255) DEFAULT NULL,
  `USU_SENHA` varchar(255) DEFAULT NULL,
  `USU_NOME` varchar(250) NOT NULL DEFAULT '',
  `USU_DENTISTA` varchar(1) NOT NULL,
  `USU_SELECIONADO` varchar(1) NOT NULL,
  `USU_CPF` varchar(14) NOT NULL,
  `USU_RG` varchar(9) NOT NULL,
  `USU_CRO` varchar(8) NOT NULL,
  `USU_NASCIMENTO` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`USU_ID`, `USU_USUARIO`, `USU_SENHA`, `USU_NOME`, `USU_DENTISTA`, `USU_SELECIONADO`, `USU_CPF`, `USU_RG`, `USU_CRO`, `USU_NASCIMENTO`) VALUES
(7, 'DANIELD', 'ab94bf015a9d0ff421f0ef059229c002', 'DANIEL LUIZ DANNA', '', 'N', '', '', '', ''),
(11, 'drdaniel', '364393b7ac43318a848e94ee90b75835', 'DR DANIEL ', 'S', 'S', '090.959.069-90', '5.798.059', '35987', '19930826');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_agenda`
--
ALTER TABLE `tb_agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_clientes`
--
ALTER TABLE `tb_clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_grade`
--
ALTER TABLE `tb_grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_procedimentos`
--
ALTER TABLE `tb_procedimentos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`USU_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_agenda`
--
ALTER TABLE `tb_agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;
--
-- AUTO_INCREMENT for table `tb_clientes`
--
ALTER TABLE `tb_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `tb_grade`
--
ALTER TABLE `tb_grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tb_procedimentos`
--
ALTER TABLE `tb_procedimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `USU_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
