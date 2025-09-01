-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/08/2025 às 15:12
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `agendamento` (
  `agendamento_code` int(11) NOT NULL,
  `agendamento_procedimento` varchar(50) NOT NULL,
  `agendamento_data` date NOT NULL,
  `fk_cliente_cpf` varchar(11) DEFAULT NULL,
  `fk_animal_code` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `agendamento` (`agendamento_code`, `agendamento_procedimento`, `agendamento_data`, `fk_cliente_cpf`, `fk_animal_code`) VALUES
(1, 'TOSA', '2023-09-22', '22222222222', 1),
(2, 'BANHO', '2023-09-29', '44444444444', 3),
(3, 'CONSULTA', '2023-10-10', '11111111111', 4),
(4, 'CIRURGIA', '2023-10-12', '22222222222', 1),
(5, 'TOSA', '2023-10-16', '77777777777', 7),
(6, 'TOSA', '2023-12-23', '81818155555', 6);


CREATE TABLE `animal` (
  `animal_cod` int(11) NOT NULL,
  `animal_tipo` varchar(50) NOT NULL,
  `animal_nome` varchar(50) NOT NULL,
  `animal_raca` varchar(50) NOT NULL,
  `fk_cliente_cpf` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `animal` (`animal_cod`, `animal_tipo`, `animal_nome`, `animal_raca`, `fk_cliente_cpf`) VALUES
(1, 'Cão', 'Patricio', 'Pinscher', '22222222222'),
(2, 'Cão', 'Beethoven', 'Rottweiler', '88888888888'),
(3, 'Gato', 'Mia', 'Siamês', '44444444444'),
(4, 'Cão', 'Linguica', 'Shih Tzu', '11111111111'),
(5, 'Tartaruga', 'Raio', 'Jabuti', '81818155555'),
(6, 'Cão', 'Messi', 'Salsicha', '81818155555'),
(7, 'Pássaro', 'Naruto', 'Calopsita', '77777777777'),
(8, 'Gato', 'Anitta', 'Siamês', '88888888888');



CREATE TABLE `cliente` (
  `cliente_cpf` varchar(11) NOT NULL,
  `cliente_nome` varchar(100) NOT NULL,
  `cliente_endereco` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `cliente` (`cliente_cpf`, `cliente_nome`, `cliente_endereco`) VALUES
('11111111111', 'Cristian Ronalds', 'Rua João Pedro III, sn'),
('22222222222', 'Zuleide Silva', 'Rua Ipe, numero 88'),
('44444444444', 'Durval Junio', 'Rua sem saída, número 0'),
('77777777777', 'Neymar Santo', 'Alameda das Perebas, nº30'),
('81818155555', 'Isabella Pedrita', 'Avenida das Flores, n7'),
('88888888888', 'Cleiton Marciano', 'Avenida Presidenta Ana, n2');


--
ALTER TABLE `agendamento`
  ADD PRIMARY KEY (`agendamento_code`),
  ADD KEY `fk_cliente_cpf` (`fk_cliente_cpf`),
  ADD KEY `fk_animal_code` (`fk_animal_code`);



ALTER TABLE `animal`
  ADD PRIMARY KEY (`animal_cod`),
  ADD KEY `fk_cliente_cpf` (`fk_cliente_cpf`);

ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cliente_cpf`);


ALTER TABLE `agendamento`
  ADD CONSTRAINT `agendamento_ibfk_1` FOREIGN KEY (`fk_cliente_cpf`) REFERENCES `cliente` (`cliente_cpf`),
  ADD CONSTRAINT `agendamento_ibfk_2` FOREIGN KEY (`fk_animal_code`) REFERENCES `animal` (`animal_cod`);

ALTER TABLE `animal`
  ADD CONSTRAINT `animal_ibfk_1` FOREIGN KEY (`fk_cliente_cpf`) REFERENCES `cliente` (`cliente_cpf`);
COMMIT;

