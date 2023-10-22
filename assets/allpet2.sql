-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Set-2023 às 23:38
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `allpet2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agenda`
--

CREATE TABLE `agenda` (
  `id_agenda` int(11) NOT NULL,
  `dt_agenda` date NOT NULL,
  `hr_agenda` time NOT NULL,
  `fkcod_pet` int(9) NOT NULL,
  `fkid_servico` int(11) NOT NULL,
  `relat_serv` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  `fkid_func` int(11) NOT NULL,
  `fkid_receb` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `diasdasemana`
--

CREATE TABLE `diasdasemana` (
  `id` int(11) NOT NULL,
  `nomedodia` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `diasdasemana`
--

INSERT INTO `diasdasemana` (`id`, `nomedodia`) VALUES
(1, 'Domingo'),
(2, 'Segunda'),
(3, 'Terça'),
(4, 'Quarta'),
(5, 'Quinta'),
(6, 'Sexta'),
(7, 'Sábado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `id_endereco` int(11) NOT NULL,
  `cep` varchar(30) NOT NULL,
  `rua` varchar(30) NOT NULL,
  `num_da_casa` int(11) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `bairro` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`id_endereco`, `cep`, `rua`, `num_da_casa`, `cidade`, `estado`, `bairro`) VALUES
(4, '', 'Joaquim Gomes', 152, 'Salto Grande', 'SP', 'santos dumount'),
(5, '19909040', 'Florinda da Silva', 12, 'São Paulo', 'Sp', 'santos dumount'),
(6, '19909040', 'Orlando chiaradia', 96, 'Botucatu', 'Sp', 'VL São Luiz'),
(7, '19909040', 'Lidio Cassiolato', 230, 'Jacarézinho', 'PR', 'VL São Luiz'),
(8, '19909040', 'Vagner da Silva', 1489, 'Bauru', 'SP', 'VL São Luiz'),
(9, '813981', 'Sebastião de Souza', 2569, 'Ourinhos', 'SP', 'santos dumount'),
(10, '813981', 'Benedita da Silva', 10, 'Marilia', 'SP', 'VL São Luiz'),
(11, '19909040', 'José da Silva', 14, 'Palmital', 'SP', 'VL São Luiz'),
(12, '19909040', '9 de Julho', 752, 'Ibirarema', 'SP', 'VL São Luiz'),
(13, '813981', '12 de Outubro', 960, 'Cornélio', 'PR', 'VL Margarida'),
(14, '1094091', '7 de Setembro', 713, 'Piracicaba', 'SP', 'VL São Luiz'),
(15, '1094091', '3 de maio', 614, 'Itu', 'SP', 'VL São Luiz'),
(16, '482714', 'João Gomes de Souza', 13, 'Chavantes', 'SP', 'VL São Luiz'),
(17, '1094091', 'Carlos Augusto', 1, 'Ourinhos', 'SP', 'VL São Luiz'),
(18, '1909094', 'Abdo Tanus', 1245, 'Ourinhos', 'SP', 'VL São Luiz'),
(19, '1909094', 'Celestino Lopes Bahia', 983, 'Ourinhos', 'SP', 'VL São Luiz'),
(20, '189988', 'Abussali abujamra', 992, 'Ourinhos', 'SP', 'VL São Luiz'),
(21, '189988', 'Professor Francisco Dias Negrã', 300, 'Ourinhos', 'SP', 'VL São Luiz'),
(22, '498499', 'Espírito Santo', 582, 'Ourinhos', 'SP', 'VL São Luiz'),
(23, '498499', 'João Rafael Bardi', 445, 'Ourinhos', 'SP', 'VL São Luiz'),
(24, '498499', 'Domingos Belli', 155, 'Ourinhos', 'SP', 'Nossa Senhora de Fátima'),
(25, '44444444', 'Diamante Negro', 50, 'Ourinhos', 'SP', 'VL São Luiz');

-- --------------------------------------------------------

--
-- Estrutura da tabela `especie`
--

CREATE TABLE `especie` (
  `id_especie` int(11) NOT NULL,
  `nome_especie` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `especie`
--

INSERT INTO `especie` (`id_especie`, `nome_especie`) VALUES
(1, 'Cachorro'),
(2, 'Gato');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcao`
--

CREATE TABLE `funcao` (
  `id` int(11) NOT NULL,
  `nome_funcao` varchar(30) NOT NULL,
  `departamento` varchar(30) NOT NULL,
  `descricao_funcao` text NOT NULL,
  `salario` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `funcao`
--

INSERT INTO `funcao` (`id`, `nome_funcao`, `departamento`, `descricao_funcao`, `salario`) VALUES
(1, 'Administrador', 'Financeiro', 'Gerenciar a loja financeiramente', 6500),
(2, 'Atendente', 'Pessoal', 'Responsável pelo cadastro de clientes, agendamento de seviços e recebimento de caixa', 1850),
(3, 'Banhista', 'Produção', 'Responsável por dar banho nos pets', 1900),
(4, 'Tosador', 'Produção', 'Responsávelpo tosar os pets', 2000),
(5, 'Groomer', 'Produção', 'Responsável por dar banho e tosar os pets', 2400),
(6, 'Comum', 'Produção', 'Responsável por ajudar a loja em ordeme e no atendimento', 1850);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `hora_de_trab` time DEFAULT NULL,
  `diadefolga` int(11) DEFAULT NULL,
  `perfil` varchar(11) DEFAULT NULL,
  `cpf_pessoa` varchar(11) NOT NULL,
  `id` int(11) NOT NULL,
  `fkfuncao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`hora_de_trab`, `diadefolga`, `perfil`, `cpf_pessoa`, `id`, `fkfuncao`) VALUES
('08:00:00', 1, 'as', '9875321', 1, 6),
('08:00:00', 1, 'as', '41321455', 2, 6),
('08:00:00', 1, 'as', '44444444', 3, 6),
('08:00:00', 1, 'as', '2111111111', 4, 6),
('08:00:00', 1, 'as', '123.456.789', 5, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `cpf` varchar(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `rg` int(13) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `fkendereco` int(11) DEFAULT NULL,
  `tipo` tinyint(1) DEFAULT NULL,
  `dtnasc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`cpf`, `nome`, `rg`, `telefone`, `email`, `fkendereco`, `tipo`, `dtnasc`) VALUES
('123.456.789', 'Alisson Gois', 111111111, '1491111-1111', 'alisson@hotmail.com', 5, 1, '1999-02-02'),
('12345678', 'Mariana Gimenes', 222222222, '1492222-2222', 'mariana@gmail.com', 11, 1, '2200-04-04'),
('2111111111', 'Matheus Oliveira', 333333333, '1493333-3333', 'matheus@gmail.com', 25, 1, '2200-03-30'),
('33333333333', 'Weley Oliveira', 909090909, '1491616-1616', 'wesley@hotmail.com', 15, 1, '1999-02-20'),
('4125683', 'Gabriel Oliveira da Silva', 444444444, '1494444-4444', 'gabriel@gmail.com', 16, 1, '2000-04-09'),
('41321455', 'Bruno Farias Gimenes de Souza', 555555555, '1495555-5555', 'bruno@gmail.com', 20, 1, '2000-04-20'),
('44444444', 'Breno da Silva', 666666666, '1496666-6666', 'breno@gmail.com', 22, 1, '2000-04-09'),
('48129841', 'Marcio Gomes ', 777777777, '1497777-7777', 'marcio@gmail.com', 9, 1, '0922-09-04'),
('4821846', 'Juliano Batista de Oliveira', 888888888, '1498888-8888', 'juliano@gmail.com', 18, 1, '2444-04-20'),
('487964431', 'Rafael Filho Gomes', 999999999, '1499999-9999', 'rafael@gmail.com', 8, 1, '2000-04-09'),
('4879644480', 'Guilherme Batista de Souza', 101010101, '1491010-1010', 'guilherme@gmail.com', 7, 1, '2000-04-09'),
('48796444800', 'Eduarda Gimenes', 121212121, '1491212-1212', 'eduarda@gmail.com', 4, 1, '2200-04-02'),
('74185296390', 'Felipe Antonio', 343434343, '1491313-1313', 'felipe@hotmail.com', 5, 1, '1999-02-02'),
('9875321', 'Poliana da Silva', 565656565, '1491414-1414', 'poliana@gmail.com', 14, 1, '2000-04-04'),
('98765432100', 'Adryanno Roque', 787878787, '1491515-1515', 'adryanno@gmail.com', 4, 1, '2000-06-02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pet`
--

CREATE TABLE `pet` (
  `cod_pet` int(9) NOT NULL,
  `pet_nome` varchar(20) NOT NULL,
  `fktutor_cpf` varchar(14) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `sexo` varchar(5) NOT NULL,
  `dt_nasc` date NOT NULL,
  `pelagem` varchar(20) NOT NULL,
  `cor` varchar(20) NOT NULL,
  `fkid_tutor` int(11) NOT NULL,
  `fk_raca` int(9) NOT NULL,
  `fk_especie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pet`
--

INSERT INTO `pet` (`cod_pet`, `pet_nome`, `fktutor_cpf`, `nome`, `sexo`, `dt_nasc`, `pelagem`, `cor`, `fkid_tutor`, `fk_raca`, `fk_especie`) VALUES
(1, 'Doguinho', '123.456.789', 'seila', 'M', '2020-12-27', 'pequena', 'caramelo', 1, 1, 1),
(2, 'Scooby', '123.456.789', 'oxe', 'M', '2020-12-27', 'pequena', 'Preta', 1, 2, 1),
(3, 'Bilu', '4879644480', 'puts', 'F', '2020-12-27', 'grande', 'Branco', 3, 1, 1),
(4, 'Poly', '33333333333', 'sla', 'F', '2020-12-27', 'media', 'Mesclado', 12, 2, 1),
(5, 'Lilica', '4879644480', 'sla', 'F', '2020-12-27', 'grande', 'Preto', 3, 1, 1),
(6, 'Cadu', '48218464879644', 'sla', 'M', '2020-12-27', 'media', 'Caramelo', 13, 2, 1),
(7, 'Kiara', '2111111111', 'sla', 'F', '2020-12-27', 'pequena', 'Marrom', 11, 1, 1),
(8, 'Leão', '12345678', 'sla', 'M', '2020-12-27', 'grande', 'Bege', 10, 2, 1),
(9, 'Tufão', '98765432100', 'sla', 'M', '2020-12-27', 'pequena', 'Branco', 14, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `raca`
--

CREATE TABLE `raca` (
  `id_raca` int(11) NOT NULL,
  `nome_raca` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `raca`
--

INSERT INTO `raca` (`id_raca`, `nome_raca`) VALUES
(1, 'Viralata'),
(2, 'Pug'),
(3, 'Buldogue'),
(4, 'Shih Tzu'),
(5, 'Pastor Alemão'),
(6, 'Poodle'),
(7, 'Rottweiler'),
(8, 'Labrador'),
(9, 'Golden'),
(10, 'Yorkshire Terrier'),
(11, 'Border Collie'),
(12, 'Bull Terrier'),
(13, 'Boxxer'),
(14, 'Blue Heeler');

-- --------------------------------------------------------

--
-- Estrutura da tabela `recebimento`
--

CREATE TABLE `recebimento` (
  `id_pgto` int(11) NOT NULL,
  `preco_receb` double NOT NULL,
  `num_parcela` int(11) NOT NULL,
  `formato_pgto` varchar(15) NOT NULL,
  `data_pgto` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE `servico` (
  `id_servico` int(11) NOT NULL,
  `disc_servico` text NOT NULL,
  `preco` decimal(9,0) NOT NULL,
  `dt_hr_atend` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `servico`
--

INSERT INTO `servico` (`id_servico`, `disc_servico`, `preco`, `dt_hr_atend`) VALUES
(1, 'Banho ', '40', '2023-09-11 14:39:08'),
(2, 'Tosa', '50', '2023-09-11 14:39:08'),
(3, 'Banho e Tosa', '65', '2023-09-11 14:39:08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tutor`
--

CREATE TABLE `tutor` (
  `id_tutor` int(9) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `cpf_pessoa` varchar(11) NOT NULL,
  `dtregistro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `tutor`
--

INSERT INTO `tutor` (`id_tutor`, `status`, `cpf_pessoa`, `dtregistro`) VALUES
(1, 1, '123.456.789', '2020-08-26'),
(2, 1, '48796444800', '2020-08-26'),
(3, 1, '4879644480', '2020-08-26'),
(5, 1, '4821846', '2020-08-26'),
(6, 1, '48129841', '2020-08-26'),
(7, 1, '44444444', '2020-08-26'),
(8, 1, '41321455', '2020-08-26'),
(9, 1, '4125683', '2020-08-26'),
(10, 1, '12345678', '2020-08-26'),
(11, 1, '2111111111', '2020-08-26'),
(12, 1, '33333333333', '2020-08-26'),
(13, 1, '487964431', '2020-08-26'),
(14, 1, '98765432100', '2020-08-26');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id_agenda`),
  ADD KEY `fkid_servico` (`fkid_servico`),
  ADD KEY `fkcod_pet` (`fkcod_pet`),
  ADD KEY `fkid_func` (`fkid_func`),
  ADD KEY `fkid_receb` (`fkid_receb`);

--
-- Índices para tabela `diasdasemana`
--
ALTER TABLE `diasdasemana`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`id_endereco`);

--
-- Índices para tabela `especie`
--
ALTER TABLE `especie`
  ADD PRIMARY KEY (`id_especie`);

--
-- Índices para tabela `funcao`
--
ALTER TABLE `funcao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cpf_pessoa` (`cpf_pessoa`),
  ADD KEY `fkfuncao` (`fkfuncao`),
  ADD KEY `diadefolga` (`diadefolga`);

--
-- Índices para tabela `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`cpf`),
  ADD KEY `fkendereco` (`fkendereco`);

--
-- Índices para tabela `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`cod_pet`),
  ADD KEY `pet_ibfk_1` (`fktutor_cpf`),
  ADD KEY `fkid_tutor` (`fkid_tutor`),
  ADD KEY `fk_raca_idx` (`fk_raca`),
  ADD KEY `fkespecie_idx` (`fk_especie`);

--
-- Índices para tabela `raca`
--
ALTER TABLE `raca`
  ADD PRIMARY KEY (`id_raca`);

--
-- Índices para tabela `recebimento`
--
ALTER TABLE `recebimento`
  ADD PRIMARY KEY (`id_pgto`);

--
-- Índices para tabela `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`id_servico`);

--
-- Índices para tabela `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`id_tutor`),
  ADD KEY `cpf_pessoa` (`cpf_pessoa`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id_agenda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `diasdasemana`
--
ALTER TABLE `diasdasemana`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id_endereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `especie`
--
ALTER TABLE `especie`
  MODIFY `id_especie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `funcao`
--
ALTER TABLE `funcao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `raca`
--
ALTER TABLE `raca`
  MODIFY `id_raca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `servico`
--
ALTER TABLE `servico`
  MODIFY `id_servico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_ibfk_2` FOREIGN KEY (`fkcod_pet`) REFERENCES `pet` (`cod_pet`),
  ADD CONSTRAINT `agenda_ibfk_3` FOREIGN KEY (`fkid_func`) REFERENCES `funcionarios` (`id`),
  ADD CONSTRAINT `agenda_ibfk_4` FOREIGN KEY (`fkid_receb`) REFERENCES `recebimento` (`id_pgto`);

--
-- Limitadores para a tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD CONSTRAINT `funcionarios_ibfk_1` FOREIGN KEY (`cpf_pessoa`) REFERENCES `pessoas` (`cpf`),
  ADD CONSTRAINT `funcionarios_ibfk_2` FOREIGN KEY (`fkfuncao`) REFERENCES `funcao` (`id`),
  ADD CONSTRAINT `funcionarios_ibfk_3` FOREIGN KEY (`diadefolga`) REFERENCES `diasdasemana` (`id`);

--
-- Limitadores para a tabela `pessoas`
--
ALTER TABLE `pessoas`
  ADD CONSTRAINT `pessoas_ibfk_1` FOREIGN KEY (`fkendereco`) REFERENCES `endereco` (`id_endereco`);

--
-- Limitadores para a tabela `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `fkespecie` FOREIGN KEY (`fk_especie`) REFERENCES `especie` (`id_especie`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fkraca` FOREIGN KEY (`fk_raca`) REFERENCES `raca` (`id_raca`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pet_ibfk_2` FOREIGN KEY (`fkid_tutor`) REFERENCES `tutor` (`id_tutor`);

--
-- Limitadores para a tabela `tutor`
--
ALTER TABLE `tutor`
  ADD CONSTRAINT `tutor_ibfk_2` FOREIGN KEY (`cpf_pessoa`) REFERENCES `pessoas` (`cpf`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE `usuarios` (
	`id_usuario` INT(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
	`usuario` VARCHAR(30) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`senha_usuario` VARCHAR(40) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	`cpf` VARCHAR(12) NULL DEFAULT NULL COLLATE 'utf8mb4_general_ci',
  `recuperar_senha` varchar(220) DEFAULT NULL COLLATE 'utf8mb4_general_ci',
	PRIMARY KEY (`id_usuario`) USING BTREE,
	INDEX `fk_cpf` (`cpf`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=MyISAM
AUTO_INCREMENT=4
;