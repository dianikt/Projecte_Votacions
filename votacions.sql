-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Temps de generació: 04-12-2017 a les 18:59:09
-- Versió del servidor: 5.7.20-0ubuntu0.16.04.1
-- Versió de PHP: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `votacions`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `consultes`
--

CREATE TABLE `consultes` (
  `id_consulta` int(16) NOT NULL,
  `pregunta` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Bolcant dades de la taula `consultes`
--

INSERT INTO `consultes` (`id_consulta`, `pregunta`, `fecha_inicio`, `fecha_final`) VALUES
(80, 'de donde eres ? ', '2017-11-01', '2017-11-14'),
(81, 'de donde eres ? ', '2017-11-01', '2017-11-14'),
(82, 'de donde eres ? ', '2017-11-01', '2017-11-14'),
(83, 'te gustan los perros? ', '2017-11-22', '2017-11-25'),
(87, 'llovera esta tarde ?', '2017-12-04', '2017-12-13');

-- --------------------------------------------------------

--
-- Estructura de la taula `invitacions`
--

CREATE TABLE `invitacions` (
  `id_invitacio` int(16) NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `id_consulta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Bolcant dades de la taula `invitacions`
--

INSERT INTO `invitacions` (`id_invitacio`, `email`, `id_consulta`) VALUES
(48, 'dianikt@gmail.com', 0),
(1, 'dianikt@gmail.com', 0),
(2, 'dianikt1@gmail.com', 0),
(2, 'dianikt1@gmail.com', 0),
(49, 'dianikt2@gmail.com', 0),
(50, 'lola@gmail.com', 0),
(51, 'lola@gmail.com', 0),
(52, '', 0),
(53, 'lo', 0),
(54, '', 1),
(55, 'dianikt@hotmail.com', 80),
(56, 'dianikt@hotmail.com', 81),
(57, '', 83),
(58, 'dianikt@hotmail.com', 75),
(59, 'dianikt@hotmail.com', 87);

-- --------------------------------------------------------

--
-- Estructura de la taula `respuestas`
--

CREATE TABLE `respuestas` (
  `id_respuesta` int(11) NOT NULL,
  `respuesta` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `id_consultas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Bolcant dades de la taula `respuestas`
--

INSERT INTO `respuestas` (`id_respuesta`, `respuesta`, `id_consultas`) VALUES
(141, 'por que ? ', 80),
(142, ' para que ? ', 80),
(145, 'si ', 83),
(146, ' no ', 83),
(147, 'abstenerse ', 83),
(148, 'CDSC', 84),
(149, ' CDSC', 84),
(150, 'CDSC', 84),
(151, ' CDSC', 84),
(152, 'D', 86),
(153, ' DED', 86),
(154, 'SI ', 87),
(155, ' NO', 87),
(156, ' POSIBLEMENTE', 87);

-- --------------------------------------------------------

--
-- Estructura de la taula `usuaris`
--

CREATE TABLE `usuaris` (
  `id_usuari` int(16) NOT NULL,
  `usuari` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Bolcant dades de la taula `usuaris`
--

INSERT INTO `usuaris` (`id_usuari`, `usuari`, `password`, `email`) VALUES
(1, 'admin', 'admin', ''),
(2, 'admin', 'admin', ''),
(3, 'diana', '12345', 'dianikt@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de la taula `votos`
--

CREATE TABLE `votos` (
  `id_votos` int(11) NOT NULL,
  `id_respuesta` int(11) NOT NULL,
  `id_usuari` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Bolcant dades de la taula `votos`
--

INSERT INTO `votos` (`id_votos`, `id_respuesta`, `id_usuari`) VALUES
(1, 142, 3);

--
-- Indexos per taules bolcades
--

--
-- Index de la taula `consultes`
--
ALTER TABLE `consultes`
  ADD PRIMARY KEY (`id_consulta`);

--
-- Index de la taula `invitacions`
--
ALTER TABLE `invitacions`
  ADD KEY `id_invitacio` (`id_invitacio`);

--
-- Index de la taula `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id_respuesta`);

--
-- Index de la taula `usuaris`
--
ALTER TABLE `usuaris`
  ADD PRIMARY KEY (`id_usuari`);

--
-- Index de la taula `votos`
--
ALTER TABLE `votos`
  ADD PRIMARY KEY (`id_votos`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `consultes`
--
ALTER TABLE `consultes`
  MODIFY `id_consulta` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT per la taula `invitacions`
--
ALTER TABLE `invitacions`
  MODIFY `id_invitacio` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT per la taula `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id_respuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;
--
-- AUTO_INCREMENT per la taula `usuaris`
--
ALTER TABLE `usuaris`
  MODIFY `id_usuari` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT per la taula `votos`
--
ALTER TABLE `votos`
  MODIFY `id_votos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
