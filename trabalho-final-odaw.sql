-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2021 at 07:37 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trabalho-final-odaw`
--

-- --------------------------------------------------------

--
-- Table structure for table `postagem`
--

CREATE TABLE `postagem` (
  `id_postagem` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `texto_postagem` varchar(250) NOT NULL,
  `data_postagem` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `postagem`
--

INSERT INTO `postagem` (`id_postagem`, `titulo`, `texto_postagem`, `data_postagem`, `id_usuario`) VALUES
(1, 'Gumb lindo', 'Texto', '2021-04-02 03:15:01', 5),
(2, 'Gumb feio', 'Texto 2', '2021-04-02 03:15:01', 4),
(3, 'Gumb eh maios ou menos', 'Texto 3', '2021-04-02 04:51:08', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_usuario` int(11) NOT NULL,
  `login_user` varchar(50) NOT NULL,
  `senha` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_usuario`, `login_user`, `senha`) VALUES
(4, 'Guilherme', '10guilherme'),
(5, 'filipe', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `user_postagem`
--

CREATE TABLE `user_postagem` (
  `id` int(11) NOT NULL,
  `id_postagem` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `avaliacao` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_postagem`
--

INSERT INTO `user_postagem` (`id`, `id_postagem`, `id_usuario`, `avaliacao`) VALUES
(1, 1, 4, 0),
(2, 2, 5, 0),
(3, 1, 5, 1),
(6, 3, 5, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `postagem`
--
ALTER TABLE `postagem`
  ADD PRIMARY KEY (`id_postagem`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indexes for table `user_postagem`
--
ALTER TABLE `user_postagem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_postagem` (`id_postagem`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `postagem`
--
ALTER TABLE `postagem`
  MODIFY `id_postagem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_postagem`
--
ALTER TABLE `user_postagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `postagem`
--
ALTER TABLE `postagem`
  ADD CONSTRAINT `postagem_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `user` (`id_usuario`);

--
-- Constraints for table `user_postagem`
--
ALTER TABLE `user_postagem`
  ADD CONSTRAINT `user_postagem_ibfk_1` FOREIGN KEY (`id_postagem`) REFERENCES `postagem` (`id_postagem`),
  ADD CONSTRAINT `user_postagem_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `user` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
