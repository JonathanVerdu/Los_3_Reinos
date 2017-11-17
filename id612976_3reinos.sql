-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2017 at 08:52 PM
-- Server version: 10.1.20-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id612976_3reinos`
--

-- --------------------------------------------------------

--
-- Table structure for table `relaciones_dj_jugador`
--

USE id612976_3reinos; 

CREATE TABLE `relaciones_dj_jugador` (
  `id_dj` int(11) NOT NULL,
  `id_jugador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `relaciones_dj_jugador`
--

INSERT INTO `relaciones_dj_jugador` (`id_dj`, `id_jugador`) VALUES
(41, 46),
(41, 43),
(49, 48);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `dj` int(1) NOT NULL DEFAULT '0',
  `aviso` varchar(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`ID`, `nombre`, `password`, `dj`, `aviso`) VALUES
(41, 'Fake', '123', 1, '0'),
(43, 'Jugador2', '2', 0, '0'),
(44, 'Jugador3', '3', 0, '0'),
(46, 'Jugador1', '1', 0, '0'),
(47, 'Facundo', '123', 1, '0'),
(48, 'Cseryth', '123456', 0, '0'),
(49, 'Trasteo1', '12345', 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `usuario_dj`
--

CREATE TABLE `usuario_dj` (
  `id_dj` int(11) NOT NULL,
  `nombre_dj` varchar(20) NOT NULL,
  `invitando_a` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Solo un DJ por JUGADOR';

--
-- Dumping data for table `usuario_dj`
--

INSERT INTO `usuario_dj` (`id_dj`, `nombre_dj`, `invitando_a`) VALUES
(41, 'Fake', 0),
(47, 'Facundo', 0),
(49, 'Trasteo1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `usuario_jugador`
--

CREATE TABLE `usuario_jugador` (
  `id_jugador` int(11) NOT NULL,
  `nombre_jugador` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usuario_jugador`
--

INSERT INTO `usuario_jugador` (`id_jugador`, `nombre_jugador`) VALUES
(43, 'Jugador2'),
(44, 'Jugador3'),
(46, 'Jugador1'),
(48, 'Cseryth');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `relaciones_dj_jugador`
--
ALTER TABLE `relaciones_dj_jugador`
  ADD KEY `id_dj` (`id_dj`),
  ADD KEY `id_jugador` (`id_jugador`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `usuario_dj`
--
ALTER TABLE `usuario_dj`
  ADD PRIMARY KEY (`id_dj`),
  ADD KEY `id_dj` (`id_dj`);

--
-- Indexes for table `usuario_jugador`
--
ALTER TABLE `usuario_jugador`
  ADD PRIMARY KEY (`id_jugador`),
  ADD KEY `id_jugador` (`id_jugador`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `usuario_jugador`
--
ALTER TABLE `usuario_jugador`
  MODIFY `id_jugador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `usuario_dj`
--
ALTER TABLE `usuario_dj`
  ADD CONSTRAINT `usuario_dj_ibfk_1` FOREIGN KEY (`id_dj`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `usuario_jugador`
--
ALTER TABLE `usuario_jugador`
  ADD CONSTRAINT `usuario_jugador_ibfk_1` FOREIGN KEY (`id_jugador`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
