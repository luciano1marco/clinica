-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/09/2023 às 10:34
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `clinica`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `admin_preferences`
--

CREATE TABLE `admin_preferences` (
  `id` tinyint(1) NOT NULL,
  `user_panel` tinyint(1) NOT NULL DEFAULT 0,
  `sidebar_form` tinyint(1) NOT NULL DEFAULT 0,
  `messages_menu` tinyint(1) NOT NULL DEFAULT 0,
  `notifications_menu` tinyint(1) NOT NULL DEFAULT 0,
  `tasks_menu` tinyint(1) NOT NULL DEFAULT 0,
  `user_menu` tinyint(1) NOT NULL DEFAULT 1,
  `ctrl_sidebar` tinyint(1) NOT NULL DEFAULT 0,
  `transition_page` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `admin_preferences`
--

INSERT INTO `admin_preferences` (`id`, `user_panel`, `sidebar_form`, `messages_menu`, `notifications_menu`, `tasks_menu`, `user_menu`, `ctrl_sidebar`, `transition_page`) VALUES
(1, 0, 0, 0, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `agenda`
--

CREATE TABLE `agenda` (
  `id` int(11) UNSIGNED NOT NULL,
  `hora` int(11) UNSIGNED DEFAULT NULL,
  `idpaciente` tinyint(3) UNSIGNED DEFAULT NULL,
  `color` varchar(191) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `agenda`
--

INSERT INTO `agenda` (`id`, `hora`, `idpaciente`, `color`, `start_date`, `user_id`) VALUES
(6, 7, 2, '#FF0000', '2023-09-06', 1),
(7, 6, 2, '#FFD700', '2023-09-06', 1),
(8, 3, 2, '#FF8C00', '2023-09-05', 1),
(10, 6, 2, '#b2371fc4', '2023-09-05', 1),
(12, 4, 2, '#b2371fc4', '2023-09-06', 1),
(16, 10, 2, '#008000', '2023-08-16', 1),
(17, 6, 2, '#de3ddbde', '2023-08-17', 1),
(18, 5, 2, '#b2371fc4', '2023-07-04', 1),
(19, 5, 3, '#0071c5', '2023-09-07', 1),
(20, 14, 3, '#FFD700', '2023-09-06', 1),
(21, 1, 3, '#FF0000', '2023-09-05', 1),
(22, 6, 2, '#FF0000', '2023-10-10', 1),
(23, 11, 3, '#de3ddbde', '2023-10-10', 1),
(24, 6, 4, '#FFD700', '2023-09-07', 1),
(25, 4, 4, '#FF8C00', '2023-09-07', 1),
(26, 5, 4, '#b2371fc4', '2023-09-12', 1),
(27, 5, 4, '#FF8C00', '2023-09-08', 1),
(28, 4, 3, '#FFD700', '2023-09-08', 5),
(29, 12, 3, '#FF0000', '2023-09-08', 5),
(30, 4, 3, '#008000', '2023-10-10', 5),
(31, 3, 3, '#de3ddbde', '2023-11-15', 5),
(32, 6, 3, '#FF0000', '2023-09-14', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `analises`
--

CREATE TABLE `analises` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `danalise` date NOT NULL DEFAULT current_timestamp(),
  `idpa` int(11) NOT NULL,
  `dtcad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `analises`
--

INSERT INTO `analises` (`id`, `titulo`, `descricao`, `danalise`, `idpa`, `dtcad`) VALUES
(4, 'primeira analise', '<p>teste de inclusao de analise&nbsp;</p><p>e tambem do edit</p>', '2023-09-05', 2, '2023-08-02'),
(5, 'anal 1', '<p>teste de analise 1</p>', '2023-09-08', 3, '2023-09-08');

-- --------------------------------------------------------

--
-- Estrutura para tabela `conclusao`
--

CREATE TABLE `conclusao` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` longtext NOT NULL,
  `dataconc` date NOT NULL DEFAULT current_timestamp(),
  `idpa` int(11) NOT NULL,
  `dtcad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `conclusao`
--

INSERT INTO `conclusao` (`id`, `titulo`, `descricao`, `dataconc`, `idpa`, `dtcad`) VALUES
(2, 'Teste de conclusao', '<p>finalizando os atendimentos do paciebnte</p>', '2023-09-05', 2, '2023-07-11'),
(3, 'previa', '<p>teste1</p>', '2023-09-08', 3, '2023-09-08'),
(4, 'finalizando', '<p>teste de conclusao de finalizacao</p>', '2023-09-19', 3, '2023-09-20');

-- --------------------------------------------------------

--
-- Estrutura para tabela `descatende`
--

CREATE TABLE `descatende` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` longtext NOT NULL,
  `datadesc` date NOT NULL DEFAULT current_timestamp(),
  `idpa` int(11) NOT NULL,
  `dtcad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `descatende`
--

INSERT INTO `descatende` (`id`, `titulo`, `descricao`, `datadesc`, `idpa`, `dtcad`) VALUES
(4, 'Teste de Descricao', '<h3>Isto é um teste de inclusao de descricao do paciente:</h3><h4>&nbsp; &nbsp; &nbsp;<strong> Lista:</strong></h4><ol><li>teste 1</li><li>teste 2</li><li>teste3</li><li>outros</li></ol>', '2023-08-31', 3, ''),
(5, 'Teste de Descricao', '<p>uma breve fala sobre o paciente</p>', '2023-09-05', 2, '2023-09-05');

-- --------------------------------------------------------

--
-- Estrutura para tabela `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `bgcolor` char(7) NOT NULL DEFAULT '#607D8B'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `bgcolor`) VALUES
(1, 'admin', 'Administrator', '#F44336'),
(2, 'members', 'General User', '#2196F3'),
(3, 'clinica', 'Clinica', '#607D8B'),
(4, 'psicologa', 'Psicologa', '#607D8B');

-- --------------------------------------------------------

--
-- Estrutura para tabela `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `menugroups`
--

CREATE TABLE `menugroups` (
  `id` int(11) NOT NULL,
  `grupo` int(11) DEFAULT NULL,
  `menu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `menugroups`
--

INSERT INTO `menugroups` (`id`, `grupo`, `menu`) VALUES
(4, 3, 3),
(11, 3, 2),
(12, 4, 2),
(13, 3, 5),
(14, 4, 5),
(15, 1, 6),
(16, 1, 7),
(17, 1, 8),
(18, 3, 9),
(19, 4, 9),
(22, 3, 4),
(23, 4, 4),
(26, 1, 10),
(27, 3, 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `menuitens`
--

CREATE TABLE `menuitens` (
  `id` int(11) NOT NULL,
  `controller` varchar(30) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `icone` varchar(30) DEFAULT NULL,
  `section` int(11) DEFAULT NULL,
  `publicado` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `menuitens`
--

INSERT INTO `menuitens` (`id`, `controller`, `descricao`, `icone`, `section`, `publicado`) VALUES
(1, 'license', 'Licenças', 'fa fa-legal', 1, NULL),
(2, 'pacientes', 'Pacientes', 'user-o', 2, 1),
(4, 'calendar', 'Calendario', 'calendar', 2, 1),
(10, 'relatorios', 'Gráficos', 'area-chart', 2, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `menusection`
--

CREATE TABLE `menusection` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) DEFAULT NULL,
  `publicado` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `menusection`
--

INSERT INTO `menusection` (`id`, `descricao`, `publicado`) VALUES
(2, 'Clinica', 1),
(4, 'Laudos', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) UNSIGNED NOT NULL,
  `nome` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `telefone` varchar(191) DEFAULT NULL,
  `endereco` varchar(191) DEFAULT NULL,
  `cpf` varchar(191) DEFAULT NULL,
  `id_psico` int(191) DEFAULT NULL,
  `dtcad` varchar(50) NOT NULL,
  `ativo` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `pacientes`
--

INSERT INTO `pacientes` (`id`, `nome`, `email`, `telefone`, `endereco`, `cpf`, `id_psico`, `dtcad`, `ativo`) VALUES
(2, 'teste da silva', 'teste@teste.com', '53-98765432', 'Rua Gramado, 2259', '03317397047', 1, '2023-07-03', 1),
(3, 'Luciano Correa Marco', 'luciano1marco@gmail.com', '53984321028', 'Rua Gramado, 2259', '62526936004', 5, '2023-09-08', 1),
(4, 'fulano de tal', 'fulano@gmail.com', '32323232', 'lkdlskdlskdlskl', '1234556789', 1, '2023-08-30', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `procedimento`
--

CREATE TABLE `procedimento` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `dataproc` date NOT NULL DEFAULT current_timestamp(),
  `idpa` int(11) NOT NULL,
  `dtcad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `procedimento`
--

INSERT INTO `procedimento` (`id`, `titulo`, `descricao`, `dataproc`, `idpa`, `dtcad`) VALUES
(6, 'teste', '<p>aqui voce escreve o que quiser</p>', '2023-09-05', 2, '2023-08-08'),
(7, 'teste 1', '<p>aqui a continuacao do que quiser.</p><h4><strong>adicionado no editar para teste</strong>:</h4><ol><li>teste1</li><li>teste2</li></ol>', '2023-09-05', 2, '2023-08-15'),
(8, 'teste do teste', '<p>werewrwqr werewwerrwer &nbsp;ew ewr ew r er &nbsp; ew re wer ew&nbsp;</p>', '2023-09-05', 2, '2023-07-10'),
(9, 'proc 1', '<p>teste de procedimento</p>', '2023-09-08', 3, '2023-09-08'),
(10, 'proc 2', '<p>teste 2 de procedimento:</p><ol><li>texto1</li><li>texto2</li><li>texto3</li></ol><p>&nbsp;</p><h4><strong>texto em negrito</strong></h4><p>&nbsp;</p><p>&nbsp;</p>', '2023-09-08', 3, '2023-09-09');

-- --------------------------------------------------------

--
-- Estrutura para tabela `public_preferences`
--

CREATE TABLE `public_preferences` (
  `id` int(1) NOT NULL,
  `transition_page` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `public_preferences`
--

INSERT INTO `public_preferences` (`id`, `transition_page`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tempo`
--

CREATE TABLE `tempo` (
  `id` int(11) NOT NULL,
  `hora` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Despejando dados para a tabela `tempo`
--

INSERT INTO `tempo` (`id`, `hora`) VALUES
(1, '8h'),
(2, '9h'),
(3, '10h'),
(4, '11h'),
(5, '13h'),
(6, '14h'),
(7, '15h'),
(8, '16h'),
(9, '17h'),
(10, '18h'),
(11, '19h'),
(12, '20h'),
(13, '21h'),
(14, '22h');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `admin` int(11) DEFAULT 0,
  `senha` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `admin`, `senha`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, NULL, 1268889823, 1695120742, 1, 'Admin', 'istrator', 'ADMIN', '0', 1, NULL),
(5, '::1', 'simone loretto', '$2y$08$uXlTRH58Wr0Rd235sUIKD.Y7YM3/euQ5QNcmVirdTXsDJFY2t8UNu', NULL, 'siloretto@hotmail.com', NULL, NULL, NULL, NULL, 1612455440, 1694174246, 1, 'Simone', 'Loretto', 'clinica', '92000-6066', 0, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(30, 5, 3);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `admin_preferences`
--
ALTER TABLE `admin_preferences`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_foreignkey_agenda_user` (`user_id`);

--
-- Índices de tabela `analises`
--
ALTER TABLE `analises`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `conclusao`
--
ALTER TABLE `conclusao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `descatende`
--
ALTER TABLE `descatende`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `menugroups`
--
ALTER TABLE `menugroups`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `menuitens`
--
ALTER TABLE `menuitens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `menusection`
--
ALTER TABLE `menusection`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `procedimento`
--
ALTER TABLE `procedimento`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `public_preferences`
--
ALTER TABLE `public_preferences`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tempo`
--
ALTER TABLE `tempo`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `admin_preferences`
--
ALTER TABLE `admin_preferences`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de tabela `analises`
--
ALTER TABLE `analises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `conclusao`
--
ALTER TABLE `conclusao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `descatende`
--
ALTER TABLE `descatende`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `menugroups`
--
ALTER TABLE `menugroups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `menuitens`
--
ALTER TABLE `menuitens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `menusection`
--
ALTER TABLE `menusection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `procedimento`
--
ALTER TABLE `procedimento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `public_preferences`
--
ALTER TABLE `public_preferences`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tempo`
--
ALTER TABLE `tempo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
