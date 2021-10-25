-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Out-2021 às 22:03
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dblogin`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `user_email` varchar(40) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `joining_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_pass`, `joining_date`) VALUES
(1, 'teste', 'teste@ua.pt', '$2y$10$j.UodctxbZYPkGMGmTQ4EubqbmHqOSzub/qM8IA7x6yL.ynBdK18i', '2021-10-20 14:48:19'),
(2, 'qwerqewr', 'qwerqwer@gmail.com', '$2y$10$iavaBiIZeZL8gA4H8VgdiOUGoNcR2nSEgbQwWBP2oRE5p9D.zHnYG', '2021-10-21 12:45:12'),
(3, 'qwerqwer', 'qwerqwerqwer@gmail.com', '$2y$10$POq33z5p3KRI9YedWtUMSup.KxrbISbL9oL1Ghe6/r0AQU2nlOZjG', '2021-10-21 12:45:36'),
(4, 'teste2', 'teseete@ua.pt', '$2y$10$iu6OYfhBjBFYhXx9GqvX1eeykuZBncbCbdcwTTVsv07mXEV9QSt0.', '2021-10-23 14:37:55'),
(5, 'admin@ua.pt', 'admin@ua.pt', '$2y$10$rsEa/zyAyltKL1LhKZ393ed0m4OoNavDOjHNZrFHbqOatstkCyOV2', '2021-10-25 18:36:00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
