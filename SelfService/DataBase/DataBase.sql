-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2024 a las 14:23:50
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `t15a_proyecto`
--
CREATE DATABASE IF NOT EXISTS `t15a_proyecto` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `t15a_proyecto`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `academias`
--

CREATE TABLE `academias` (
  `area` int(11) NOT NULL,
  `nombre_area` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `academias`
--

INSERT INTO `academias` (`area`, `nombre_area`) VALUES
(1, 'Ciencias Básicas\r\n'),
(2, 'Ciencias de la Ingeniería \r\n'),
(3, 'Ciencias de la Ingeniería Aplicada \r\n'),
(4, 'Ciencias Sociales y Humanidades\r\n'),
(5, 'Inglés\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

CREATE TABLE `calificaciones` (
  `alumno` int(11) NOT NULL,
  `grupo` int(11) NOT NULL,
  `u1` decimal(10,0) DEFAULT NULL,
  `u2` decimal(10,0) DEFAULT NULL,
  `u3` decimal(10,0) DEFAULT NULL,
  `uf` decimal(10,0) DEFAULT NULL,
  `Final` decimal(10,0) DEFAULT NULL,
  `ee` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`alumno`, `grupo`, `u1`, `u2`, `u3`, `uf`, `Final`, `ee`) VALUES
(893847, 3, 10, 10, 10, 10, 10, NULL),
(817546, 3, 3, 5, NULL, NULL, 1, 0),
(185083, 25, 8, 8, 8, 8, 8, NULL),
(185083, 3, 10, 10, 10, 10, 10, NULL),
(185083, 15, 7, 8, 7, 7, 7, NULL),
(185083, 16, 9, 10, 10, 10, 10, NULL),
(185083, 17, 10, 10, 9, 8, 9, NULL),
(185083, 18, 7, 6, 6, 7, 7, NULL),
(185083, 19, 9, 9, 10, 9, 9, NULL),
(185083, 20, 7, 8, 8, 7, 7, NULL),
(185083, 22, 9, 9, 9, 9, 9, NULL),
(185083, 23, 8, 7, 9, 8, 8, NULL),
(185083, 24, 9, 9, 8, 8, 8, NULL),
(185083, 26, 9, 10, 9, 8, 9, NULL),
(185083, 27, 7, 8, 7, 7, 7, NULL),
(185083, 28, 9, 8, 9, 9, 9, NULL),
(185083, 29, 7, 7, 7, 8, 7, NULL),
(185083, 30, 10, 10, 10, 10, 10, NULL),
(185083, 31, 10, 10, 10, 10, 10, NULL),
(185083, 32, 10, 10, 10, 10, 10, NULL),
(845379, 3, 10, 10, 10, 10, 10, NULL),
(845379, 15, 8, 9, 9, 10, 9, NULL),
(845379, 16, 9, 9, 10, 10, 10, NULL),
(845379, 17, 10, 10, 9, 9, 9, NULL),
(845379, 18, 7, 7, 7, 7, 7, NULL),
(845379, 19, 9, 9, 10, 9, 9, NULL),
(845379, 20, 9, 9, 9, 8, 9, NULL),
(845379, 21, 8, 10, 10, 10, 10, NULL),
(845379, 22, 10, 10, 10, 10, 10, NULL),
(845379, 23, 7, 5, 9, 9, 8, NULL),
(845379, 24, 8, 9, 10, 9, 9, NULL),
(845379, 25, 7, 7, 7, 7, 7, NULL),
(845379, 26, 10, 8, 8, 8, 8, NULL),
(845379, 27, 8, 8, 8, 8, 8, NULL),
(845379, 28, 9, 8, 9, 9, 9, NULL),
(845379, 29, 9, 8, 9, 10, 9, NULL),
(845379, 32, 10, 10, 10, 10, 10, NULL),
(845379, 31, 9, 10, 10, 10, 10, NULL),
(845379, 30, 9, 10, 10, 10, 10, NULL),
(879216, 3, 8, 8, 7, 7, 7, NULL),
(879216, 15, 7, 6, 7, 8, 7, NULL),
(879216, 16, 9, 10, 9, 10, 10, NULL),
(879216, 17, 7, 6, 7, 8, 7, NULL),
(879216, 18, 7, 7, 7, 8, 7, NULL),
(879216, 20, 8, 7, 8, 8, 8, NULL),
(879216, 22, 7, 8, 8, 8, 8, NULL),
(879216, 23, 8, 8, 7, 7, 7, NULL),
(879216, 24, 8, 8, 8, 8, 8, NULL),
(879216, 25, 7, 7, 7, 7, 7, NULL),
(879216, 26, 8, 7, 8, 7, 7, NULL),
(879216, 27, 7, 7, 7, 7, 7, NULL),
(879216, 32, 8, 7, 6, 8, 7, NULL),
(879216, 29, 7, 8, 9, 8, 8, NULL),
(879216, 31, 10, 10, 10, 10, 10, NULL),
(879216, 28, 8, 8, 7, 8, 8, NULL),
(879216, 30, 10, 10, 10, 10, 10, NULL),
(882194, 3, 10, 9, 9, 9, 9, NULL),
(882194, 15, 9, 10, 8, 10, 9, NULL),
(882194, 16, 10, 10, 9, 10, 10, NULL),
(882194, 17, 10, 10, 10, 9, 10, NULL),
(882194, 18, 7, 7, 7, 7, 7, NULL),
(882194, 27, 7, 7, 7, 7, 7, NULL),
(882194, 25, 7, 7, 7, 7, 7, NULL),
(882194, 32, 10, 10, 10, 10, 10, NULL),
(882194, 22, 9, 10, 10, 9, 9, NULL),
(882194, 19, 9, 9, 10, 9, 9, NULL),
(882194, 29, 6, 8, 9, 10, 9, NULL),
(882194, 23, 8, 8, 9, 8, 8, NULL),
(882194, 31, 10, 10, 10, 9, 10, NULL),
(882194, 20, 9, 9, 9, 9, 9, NULL),
(882194, 28, 8, 9, 9, 9, 9, NULL),
(882194, 24, 10, 8, 9, 8, 9, NULL),
(882194, 30, 10, 10, 10, 10, 10, NULL),
(882194, 26, 9, 8, 9, 10, 9, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `carrera` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `semestres` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`carrera`, `nombre`, `semestres`) VALUES
(1, 'Ingenieria en Tecnologias de la Informacion', 9),
(2, 'Ingenieria en Telematica', 9),
(3, 'Ingenieria en Tecnologias de Manufactura', 9),
(4, 'Ingenieria en Sistemas y Tecnologias Industriales', 9),
(5, 'Licenciatura en Administracion y Gestion', 9),
(6, 'Licenciatura en Mercadotecnia Internacional', 9),
(7, 'Licenciatura en Tecnologias Inteligentes', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `grupo` int(11) NOT NULL,
  `clave_grupo` text NOT NULL,
  `maestro` int(11) NOT NULL,
  `materia` int(11) NOT NULL,
  `horario` int(11) NOT NULL,
  `salon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`grupo`, `clave_grupo`, `maestro`, `materia`, `horario`, `salon`) VALUES
(3, 'T15A', 828704, 1, 1, 1),
(15, 'T15E', 830951, 22, 10, 1),
(16, 'T85T', 222222, 18, 1, 15),
(17, 'T50P', 183685, 11, 3, 54),
(18, 'T65V', 185049, 33, 4, 17),
(19, 'T15E', 828704, 13, 1, 20),
(20, 'T13A', 111111111, 20, 2, 109),
(21, 'T90E', 182345, 17, 8, 34),
(22, 'T12A', 183685, 2, 3, 10),
(23, 'T10B', 175084, 3, 2, 21),
(24, 'T10B', 120905, 8, 1, 140),
(25, 'I30B', 185049, 21, 2, 58),
(26, 'T09B', 583685, 10, 1, 9),
(27, 'I33E', 185049, 27, 2, 18),
(28, 'T09A', 120905, 14, 4, 107),
(29, 'T85A', 828704, 7, 2, 17),
(30, 'T67A', 583685, 16, 12, 11),
(31, 'T12B', 190850, 12, 2, 20),
(32, 'M12I', 183685, 5, 5, 55),
(33, 'No asignado', 185049, 4, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `horario` int(11) NOT NULL,
  `tipo` text NOT NULL,
  `hora_lunes` text NOT NULL,
  `hora_martes` text NOT NULL,
  `hora_miercoles` text NOT NULL,
  `hora_jueves` text NOT NULL,
  `hora_viernes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`horario`, `tipo`, `hora_lunes`, `hora_martes`, `hora_miercoles`, `hora_jueves`, `hora_viernes`) VALUES
(1, 'Diario', '08:00 - 08:55', '08:00 - 08:55', '08:00 - 08:55', '08:00 - 08:55', '08:00 - 08:55'),
(2, 'Diario', '09:00 - 09:55', '09:00 - 09:55', '09:00 - 09:55', '09:00 - 09:55', '09:00 - 09:55'),
(3, 'Diario', '10:00 - 10:55', '10:00 - 10:55', '10:00 - 10:55', '10:00 - 10:55', '10:00 - 10:55'),
(4, 'Diario', '11:00 - 11:55', '11:00 - 11:55', '11:00 - 11:55', '11:00 - 11:55', '11:00 - 11:55'),
(5, 'Diario', '12:00 - 12:55', '12:00 - 12:55', '12:00 - 12:55', '12:00 - 12:55', '12:00 - 12:55'),
(6, 'Diario', '13:00 - 13:55', '13:00 - 13:55', '13:00 - 13:55', '13:00 - 13:55', '13:00 - 13:55'),
(7, 'Diario', '14:00 - 14:55', '14:00 - 14:55', '14:00 - 14:55', '14:00 - 14:55', '14:00 - 14:55'),
(8, 'Diario', '15:00 - 15:55', '15:00 - 15:55', '15:00 - 15:55', '15:00 - 15:55', '15:00 - 15:55'),
(9, 'Diario', '16:00 - 16:55', '16:00 - 16:55', '16:00 - 16:55', '16:00 - 16:55', '16:00 - 16:55'),
(10, 'Diario', '17:00 - 17:55', '17:00 - 17:55', '17:00 - 17:55', '17:00 - 17:55', '17:00 - 17:55'),
(11, 'Diario', '18:00 - 18:55', '18:00 - 18:55', '18:00 - 18:55', '18:00 - 18:55', '18:00 - 18:55'),
(12, 'Diario', '19:00 - 19:55', '19:00 - 19:55', '19:00 - 19:55', '19:00 - 19:55', '19:00 - 19:55'),
(13, 'Diario', '20:00 - 20:55', '20:00 - 20:55', '20:00 - 20:55', '20:00 - 20:55', '20:00 - 20:55'),
(14, 'Terciado', '07:00 - 07:55', '07:00 - 07:55', '07:00 - 07:55', '', ''),
(15, 'Terciado', '08:00 - 08:55', '08:00 - 08:55', '08:00 - 08:55', '', ''),
(16, 'Terciado', '09:00 - 09:55', '09:00 - 09:55', '09:00 - 09:55', '', ''),
(17, 'Terciado', '10:00 - 10:55', '10:00 - 10:55', '10:00 - 10:55', '', ''),
(18, 'Terciado', '11:00 - 11:55', '11:00 - 11:55', '11:00 - 11:55', '', ''),
(19, 'Terciado', '12:00 - 12:55', '12:00 - 12:55', '12:00 - 12:55', '', ''),
(20, 'Terciado', '13:00 - 13:55', '13:00 - 13:55', '13:00 - 13:55', '', ''),
(21, 'Terciado', '14:00 - 14:55', '14:00 - 14:55', '14:00 - 14:55', '', ''),
(22, 'Terciado', '15:00 - 15:55', '15:00 - 15:55', '15:00 - 15:55', '', ''),
(23, 'Terciado', '16:00 - 16:55', '16:00 - 16:55', '16:00 - 16:55', '', ''),
(24, 'Terciado', '17:00 - 17:55', '17:00 - 17:55', '17:00 - 17:55', '', ''),
(25, 'Terciado', '18:00 - 18:55', '18:00 - 18:55', '18:00 - 18:55', '', ''),
(26, 'Terciado', '19:00 - 19:55', '19:00 - 19:55', '19:00 - 19:55', '', ''),
(27, 'Terciado', '20:00 - 20:55', '20:00 - 20:55', '20:00 - 20:55', '', ''),
(28, 'Diario', '08:00 - 08:55', '08:00 - 08:55', '08:00 - 08:55', '08:00 - 08:55', '08:00 - 08:55'),
(29, 'Diario', '09:00 - 09:55', '09:00 - 09:55', '09:00 - 09:55', '09:00 - 09:55', '09:00 - 09:55'),
(30, 'Diario', '10:00 - 10:55', '10:00 - 10:55', '10:00 - 10:55', '10:00 - 10:55', '10:00 - 10:55'),
(31, 'Diario', '11:00 - 11:55', '11:00 - 11:55', '11:00 - 11:55', '11:00 - 11:55', '11:00 - 11:55'),
(32, 'Diario', '12:00 - 12:55', '12:00 - 12:55', '12:00 - 12:55', '12:00 - 12:55', '12:00 - 12:55'),
(33, 'Diario', '13:00 - 13:55', '13:00 - 13:55', '13:00 - 13:55', '13:00 - 13:55', '13:00 - 13:55'),
(34, 'Diario', '14:00 - 14:55', '14:00 - 14:55', '14:00 - 14:55', '14:00 - 14:55', '14:00 - 14:55'),
(35, 'Diario', '15:00 - 15:55', '15:00 - 15:55', '15:00 - 15:55', '15:00 - 15:55', '15:00 - 15:55'),
(36, 'Diario', '16:00 - 16:55', '16:00 - 16:55', '16:00 - 16:55', '16:00 - 16:55', '16:00 - 16:55'),
(37, 'Diario', '17:00 - 17:55', '17:00 - 17:55', '17:00 - 17:55', '17:00 - 17:55', '17:00 - 17:55'),
(38, 'Diario', '18:00 - 18:55', '18:00 - 18:55', '18:00 - 18:55', '18:00 - 18:55', '18:00 - 18:55'),
(39, 'Diario', '19:00 - 19:55', '19:00 - 19:55', '19:00 - 19:55', '19:00 - 19:55', '19:00 - 19:55'),
(40, 'Diario', '20:00 - 20:55', '20:00 - 20:55', '20:00 - 20:55', '20:00 - 20:55', '20:00 - 20:55'),
(41, 'Terciado', '07:00 - 07:55', '07:00 - 07:55', '07:00 - 07:55', '', ''),
(42, 'Terciado', '08:00 - 08:55', '08:00 - 08:55', '08:00 - 08:55', '', ''),
(43, 'Terciado', '09:00 - 09:55', '09:00 - 09:55', '09:00 - 09:55', '', ''),
(44, 'Terciado', '10:00 - 10:55', '10:00 - 10:55', '10:00 - 10:55', '', ''),
(45, 'Terciado', '11:00 - 11:55', '11:00 - 11:55', '11:00 - 11:55', '', ''),
(46, 'Terciado', '12:00 - 12:55', '12:00 - 12:55', '12:00 - 12:55', '', ''),
(47, 'Terciado', '13:00 - 13:55', '13:00 - 13:55', '13:00 - 13:55', '', ''),
(48, 'Terciado', '14:00 - 14:55', '14:00 - 14:55', '14:00 - 14:55', '', ''),
(49, 'Terciado', '15:00 - 15:55', '15:00 - 15:55', '15:00 - 15:55', '', ''),
(50, 'Terciado', '16:00 - 16:55', '16:00 - 16:55', '16:00 - 16:55', '', ''),
(51, 'Terciado', '17:00 - 17:55', '17:00 - 17:55', '17:00 - 17:55', '', ''),
(52, 'Terciado', '18:00 - 18:55', '18:00 - 18:55', '18:00 - 18:55', '', ''),
(53, 'Terciado', '19:00 - 19:55', '19:00 - 19:55', '19:00 - 19:55', '', ''),
(54, 'Terciado', '20:00 - 20:55', '20:00 - 20:55', '20:00 - 20:55', '', ''),
(55, 'Terciado', '07:00 - 07:55', '', '07:00 - 07:55', '', '07:00 - 07:55'),
(56, 'Terciado', '08:00 - 08:55', '', '08:00 - 08:55', '', '08:00 - 08:55'),
(57, 'Terciado', '09:00 - 09:55', '', '09:00 - 09:55', '', '09:00 - 09:55'),
(58, 'Terciado', '10:00 - 10:55', '', '10:00 - 10:55', '', '10:00 - 10:55'),
(59, 'Terciado', '11:00 - 11:55', '', '11:00 - 11:55', '', '11:00 - 11:55'),
(60, 'Terciado', '12:00 - 12:55', '', '12:00 - 12:55', '', '12:00 - 12:55'),
(61, 'Terciado', '13:00 - 13:55', '', '13:00 - 13:55', '', '13:00 - 13:55'),
(62, 'Terciado', '14:00 - 14:55', '', '14:00 - 14:55', '', '14:00 - 14:55'),
(63, 'Terciado', '15:00 - 15:55', '', '15:00 - 15:55', '', '15:00 - 15:55'),
(64, 'Terciado', '16:00 - 16:55', '', '16:00 - 16:55', '', '16:00 - 16:55'),
(65, 'Terciado', '17:00 - 17:55', '', '17:00 - 17:55', '', '17:00 - 17:55'),
(66, 'Terciado', '18:00 - 18:55', '', '18:00 - 18:55', '', '18:00 - 18:55'),
(67, 'Terciado', '19:00 - 19:55', '', '19:00 - 19:55', '', '19:00 - 19:55'),
(68, 'Terciado', '20:00 - 20:55', '', '20:00 - 20:55', '', '20:00 - 20:55'),
(69, 'Terciado', '', '', '07:00 - 07:55', '07:00 - 07:55', '07:00 - 07:55'),
(70, 'Terciado', '', '', '08:00 - 08:55', '08:00 - 08:55', '08:00 - 08:55'),
(71, 'Terciado', '', '', '09:00 - 09:55', '09:00 - 09:55', '09:00 - 09:55'),
(72, 'Terciado', '', '', '10:00 - 10:55', '10:00 - 10:55', '10:00 - 10:55'),
(73, 'Terciado', '', '', '11:00 - 11:55', '11:00 - 11:55', '11:00 - 11:55'),
(74, 'Terciado', '', '', '12:00 - 12:55', '12:00 - 12:55', '12:00 - 12:55'),
(75, 'Terciado', '', '', '13:00 - 13:55', '13:00 - 13:55', '13:00 - 13:55'),
(76, 'Terciado', '', '', '14:00 - 14:55', '14:00 - 14:55', '14:00 - 14:55'),
(77, 'Terciado', '', '', '15:00 - 15:55', '15:00 - 15:55', '15:00 - 15:55'),
(78, 'Terciado', '', '', '16:00 - 16:55', '16:00 - 16:55', '16:00 - 16:55'),
(79, 'Terciado', '', '', '17:00 - 17:55', '17:00 - 17:55', '17:00 - 17:55'),
(80, 'Terciado', '', '', '18:00 - 18:55', '18:00 - 18:55', '18:00 - 18:55'),
(81, 'Terciado', '', '', '19:00 - 19:55', '19:00 - 19:55', '19:00 - 19:55'),
(82, 'Terciado', '', '', '20:00 - 20:55', '20:00 - 20:55', '20:00 - 20:55'),
(83, 'Verano', '09:00 - 13:55', '09:00 - 13:55', '09:00 - 13:55', '09:00 - 13:55', '09:00 - 13:55'),
(84, 'Verano', '11:00 - 15:55', '11:00 - 15:55', '11:00 - 15:55', '11:00 - 15:55', '11:00 - 15:55'),
(85, 'Verano', '15:00 - 17:55', '15:00 - 17:55', '15:00 - 17:55', '15:00 - 17:55', '15:00 - 17:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `materia` int(11) NOT NULL,
  `nombre_materia` text NOT NULL,
  `clave_materia` text NOT NULL,
  `numero_horas` int(11) NOT NULL,
  `creditos` int(11) NOT NULL,
  `semestre` int(11) NOT NULL,
  `materia_anterior` int(11) DEFAULT NULL,
  `area` int(11) NOT NULL,
  `carrera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`materia`, `nombre_materia`, `clave_materia`, `numero_horas`, `creditos`, `semestre`, `materia_anterior`, `area`, `carrera`) VALUES
(1, 'Taller para Certificación Office', '237E', 80, 0, 0, NULL, 3, 1),
(2, 'Introducción a las Matemáticas', '254E', 80, 0, 0, NULL, 1, 1),
(3, 'Introducción a la Física', '255E', 80, 0, 0, NULL, 1, 1),
(4, 'Inglés KET Intro', '', 80, 8, 0, NULL, 5, 1),
(5, 'Matemáticas I', '110M', 80, 8, 1, NULL, 1, 1),
(6, 'Proyecto Integrador de Matemáticas', '111M', 80, 7, 1, NULL, 1, 1),
(7, 'Física I', '110C', 80, 8, 1, NULL, 1, 1),
(8, 'Introducción a la Computación', '110F', 80, 8, 1, NULL, 3, 1),
(9, 'Inglés I', '111G', 80, 8, 1, NULL, 5, 1),
(10, 'Curso del Núcleo General I: Desarrollo del Pensamiento Crítico', '110G', 80, 7, 1, NULL, 4, 1),
(11, 'Matemáticas II', '210M', 80, 8, 2, 5, 1, 1),
(12, 'Curso Núcleo Optativo I Programación Web I', '210O', 80, 7, 2, NULL, 3, 1),
(13, 'Física II', '210C', 80, 8, 2, 7, 1, 1),
(14, 'Programación I', '210F', 80, 8, 2, 8, 3, 1),
(15, 'Inglés II', '211G', 80, 8, 2, 9, 5, 1),
(16, 'Curso del Núcleo General II: Comunicación e Investigación', '210G', 80, 7, 2, NULL, 4, 1),
(17, 'Matemáticas III', '310M', 80, 9, 3, NULL, 1, 1),
(18, 'Curso Núcleo Optativo II Programación Web II', '310O', 80, 7, 3, NULL, 3, 1),
(19, 'Matemáticas Discretas', '311M', 80, 7, 3, 11, 2, 1),
(20, 'Programación II', '310F', 80, 8, 3, 14, 3, 1),
(21, 'Inglés III', '310G', 80, 8, 3, 15, 5, 1),
(22, 'Química', '310C', 80, 7, 3, NULL, 2, 1),
(23, 'Probabilidad y Estadística', '410M', 80, 7, 4, NULL, 1, 1),
(24, 'Proyecto Integrador y Comprensivo I', '410P', 80, 9, 4, NULL, 3, 1),
(25, 'Circuitos Eléctricos', '410F', 80, 9, 4, 13, 2, 1),
(26, 'Programación III', '411F', 80, 9, 4, 2, 3, 1),
(27, 'Inglés IV', '411G', 80, 8, 4, 21, 5, 1),
(28, 'Curso del Núcleo General III: Filosofía y Valores', '410G', 48, 5, 4, NULL, 4, 1),
(29, 'Matemáticas IV', '510M', 80, 8, 5, 11, 1, 1),
(30, 'Curso del Núcleo Optativo III', '510O', 48, 7, 5, NULL, 3, 1),
(31, 'Análisis y Diseño de Algoritmos', '511P', 80, 7, 5, 26, 3, 1),
(32, 'Sistemas Operativos', '510F', 80, 7, 5, 26, 2, 1),
(33, 'Inglés V', '510G', 80, 8, 5, 27, 5, 1),
(34, 'Sistemas Digitales', '510P', 80, 7, 5, 25, 3, 1),
(35, 'Arquitectura de Computadoras', '611F', 48, 7, 6, 34, 3, 1),
(36, 'Proyecto Integrador y Comprensivo II', '611P', 80, 9, 6, 24, 3, 1),
(37, 'Lenguajes de Programación', '610F', 48, 7, 6, 32, 3, 1),
(38, 'Ingeniería de Software I', '610P', 48, 7, 6, 26, 3, 1),
(39, 'Taller de Desarrollo Empresarial', '611G', 48, 7, 6, NULL, 4, 1),
(40, 'Curso del Núcleo General IV: Creatividad', '610G', 48, 6, 6, NULL, 4, 1),
(41, 'Inglés PET II', '', 80, 8, 6, NULL, 5, 1),
(42, 'Organización Computacional', '712P', 48, 7, 7, 35, 3, 1),
(43, 'Curso del Núcleo Optativo IV', '710O', 48, 7, 7, NULL, 3, 1),
(44, 'Base de Datos', '711P', 48, 7, 7, 37, 3, 1),
(45, 'Ingeniería de Software II', '71OP', 48, 7, 7, 38, 3, 1),
(46, 'Teoría Computacional', '710F', 80, 7, 7, NULL, 3, 1),
(47, 'Taller de Creatividad y Emprendedores', '710G', 48, 7, 7, NULL, 4, 1),
(48, 'Inglés FCE I', '', 80, 8, 7, NULL, 5, 1),
(49, 'Proyecto Integrador y Comprensivo III', '812P', 48, 7, 8, 36, 3, 1),
(50, 'Curso del Núcleo Optativo V', '810O', 48, 7, 8, NULL, 3, 1),
(51, 'Minería de Datos', '810P', 48, 7, 8, 44, 3, 1),
(52, 'Inteligencia Artificial I', '810F', 48, 7, 8, 37, 3, 1),
(53, 'Redes de Computadoras', '811P', 48, 7, 8, 42, 3, 1),
(54, 'Curso del Núcleo General V: Desarrollo de Competencias', '810G', 48, 6, 8, NULL, 4, 1),
(55, 'Compiladores', '910P', 48, 7, 9, 46, 3, 1),
(56, 'Curso del Núcleo Optativo VI', '910O', 48, 7, 9, NULL, 3, 1),
(57, 'Inteligencia Artificial II', '913P', 48, 7, 9, 52, 3, 1),
(58, 'Sistemas Virtuales', '912P', 48, 7, 9, 53, 3, 1),
(59, 'Comercio Electrónico', '911P', 48, 7, 9, 53, 3, 1),
(60, 'Proyecto Profesional', '914P', 48, 8, 9, 49, 3, 1),
(61, 'Residencia Profesional', '910RP', 480, 10, 9, NULL, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salones`
--

CREATE TABLE `salones` (
  `salon` int(11) NOT NULL,
  `clave_salon` text NOT NULL,
  `nombre_salon` text NOT NULL,
  `ubicacion_fisica` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `salones`
--

INSERT INTO `salones` (`salon`, `clave_salon`, `nombre_salon`, `ubicacion_fisica`) VALUES
(1, 'A1', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(2, 'A2', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(3, 'A3', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(4, 'A4', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(5, 'A5', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(6, 'A6', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(7, 'A7', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(8, 'A8', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(9, 'A9', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(10, 'A10', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(11, 'A11', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(12, 'A12', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(13, 'A13', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(14, 'A14', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(15, 'A15', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(16, 'A16', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(17, 'A17', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(18, 'A18', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(19, 'A19', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(20, 'A20', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(21, 'A21', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(22, 'A22', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(23, 'LCV1', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(24, 'LCV2', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(25, 'A23', 'UAE1', 'Unidad Academica de Estudiantes 1'),
(26, 'A24', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(27, 'A25', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(28, 'A26', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(29, 'A27', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(30, 'A28', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(31, 'A29', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(32, 'A30', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(33, 'A31', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(34, 'A32', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(35, 'A33', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(36, 'A34', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(37, 'A35', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(38, 'A36', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(39, 'A37', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(40, 'A38', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(41, 'A39', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(42, 'A40', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(43, 'A41', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(44, 'A42', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(45, 'A43', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(46, 'A44', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(47, 'A45', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(48, 'A46', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(49, 'LCV3', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(50, 'LCV4', 'UAE2', 'Unidad Academica de Estudiantes 2'),
(51, 'A47', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(52, 'A48', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(53, 'A49', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(54, 'A50', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(55, 'A51', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(56, 'A52', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(57, 'A53', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(58, 'A54', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(59, 'A55', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(60, 'A56', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(61, 'A57', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(62, 'A58', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(63, 'A59', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(64, 'A60', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(65, 'A61', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(66, 'A62', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(67, 'A63', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(68, 'A64', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(69, 'A65', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(70, 'A66', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(71, 'A67', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(72, 'A68', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(73, 'A69', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(74, 'LCV5', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(75, 'LCV6', 'UAE3', 'Unidad Academica de Estudiantes 3'),
(76, 'A70', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(77, 'A71', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(78, 'A72', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(79, 'A73', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(80, 'A74', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(81, 'A75', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(82, 'A76', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(83, 'A77', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(84, 'A78', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(85, 'A79', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(86, 'A80', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(87, 'A81', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(88, 'A82', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(89, 'A83', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(90, 'A84', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(91, 'A85', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(92, 'A86', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(93, 'A87', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(94, 'A88', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(95, 'A89', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(96, 'A90', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(97, 'A91', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(98, 'LCV7', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(99, 'LCV8', 'UAE4', 'Unidad Academica de Estudiantes 4'),
(100, 'CC1', 'CC', 'Centro de Computo'),
(101, 'CC2', 'CC', 'Centro de Computo'),
(102, 'CC3', 'CC', 'Centro de Computo'),
(103, 'CC4', 'CC', 'Centro de Computo'),
(104, 'CC5', 'CC', 'Centro de Computo'),
(105, 'CC6', 'CC', 'Centro de Computo'),
(106, 'CC7', 'CC', 'Centro de Computo'),
(107, 'CC8', 'CC', 'Centro de Computo'),
(108, 'CC9', 'CC', 'Centro de Computo'),
(109, 'CC10', 'CC', 'Centro de Computo'),
(110, 'CC11', 'CC', 'Centro de Computo'),
(111, 'CC12', 'CC', 'Centro de Computo'),
(112, 'CC13', 'CC', 'Centro de Computo'),
(113, 'CC14', 'CC', 'Centro de Computo'),
(114, 'CC15', 'CC', 'Centro de Computo'),
(115, 'CC16', 'CC', 'Centro de Computo'),
(116, 'CC17', 'CC', 'Centro de Computo'),
(117, 'CC18', 'CC', 'Centro de Computo'),
(118, 'CC19', 'CC', 'Centro de Computo'),
(119, 'CC20', 'CC', 'Centro de Computo'),
(120, 'CC21', 'CC', 'Centro de Computo'),
(121, 'CC22', 'CC', 'Centro de Computo'),
(122, 'LCV11', 'CC', 'Centro de Computo'),
(123, 'LCV12', 'CC', 'Centro de Computo'),
(124, 'SVC1', 'CC', 'Centro de Computo'),
(125, 'SVC2', 'CC', 'Centro de Computo'),
(126, 'CA1', 'CADI', 'Centro Academico de Ingles'),
(127, 'CA2', 'CADI', 'Centro Academico de Ingles'),
(128, 'CA3', 'CADI', 'Centro Academico de Ingles'),
(129, 'C1', 'CADI', 'Centro Academico de Ingles'),
(130, 'C2', 'CADI', 'Centro Academico de Ingles'),
(131, 'C3', 'CADI', 'Centro Academico de Ingles'),
(132, 'ASE 1', 'CADI', 'Centro Academico de Ingles'),
(133, 'ASE 2', 'CADI', 'Centro Academico de Ingles'),
(134, 'ASE 3', 'CADI', 'Centro Academico de Ingles'),
(135, 'ASE 4', 'CADI', 'Centro Academico de Ingles'),
(136, 'LISTEN 1', 'CADI', 'Centro Academico de Ingles'),
(137, 'LISTEN 2', 'CADI', 'Centro Academico de Ingles'),
(138, 'LISTEN 3', 'CADI', 'Centro Academico de Ingles'),
(139, 'LISTEN 4', 'CADI', 'Centro Academico de Ingles'),
(140, 'CC23', 'CNT', 'Centro de Nuevas Tecnologias'),
(141, 'CC24', 'CNT', 'Centro de Nuevas Tecnologias'),
(142, 'CC25', 'CNT', 'Centro de Nuevas Tecnologias'),
(143, 'CC26', 'CNT', 'Centro de Nuevas Tecnologias'),
(144, 'CC27', 'CNT', 'Centro de Nuevas Tecnologias'),
(145, 'CC28', 'CNT', 'Centro de Nuevas Tecnologias'),
(146, 'CC29', 'CNT', 'Centro de Nuevas Tecnologias'),
(147, 'CC30', 'CNT', 'Centro de Nuevas Tecnologias'),
(148, 'CC31', 'CNT', 'Centro de Nuevas Tecnologias'),
(149, 'CC32', 'CNT', 'Centro de Nuevas Tecnologias'),
(150, 'CC33', 'CNT', 'Centro de Nuevas Tecnologias'),
(151, 'CC34', 'CNT', 'Centro de Nuevas Tecnologias'),
(152, 'CC35', 'CNT', 'Centro de Nuevas Tecnologias'),
(153, 'CC36', 'CNT', 'Centro de Nuevas Tecnologias'),
(154, 'CC37', 'CNT', 'Centro de Nuevas Tecnologias'),
(155, 'CC38', 'CNT', 'Centro de Nuevas Tecnologias'),
(156, 'CC39', 'CNT', 'Centro de Nuevas Tecnologias'),
(157, 'CC40', 'CNT', 'Centro de Nuevas Tecnologias'),
(158, 'VIRTUAL', 'VIRTUAL', 'Universidad Politécnica de San Luis Potosí');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuarios`
--

CREATE TABLE `tipousuarios` (
  `tipo` int(11) NOT NULL,
  `nombre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `tipousuarios`
--

INSERT INTO `tipousuarios` (`tipo`, `nombre`) VALUES
(0, 'Admin'),
(1, 'Alumno'),
(2, 'Profesor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `matricula` int(11) NOT NULL,
  `nombre_completo` text NOT NULL,
  `carrera` int(11) NOT NULL,
  `generacion` int(11) NOT NULL,
  `semestre` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`matricula`, `nombre_completo`, `carrera`, `generacion`, `semestre`, `username`, `password`, `tipo`) VALUES
(0, 'Admin', 1, 2000, 0, 'Admin', '44df18ec8a22a64e9dec06d05b601e1d', 0),
(2, 'Admin2', 1, 2001, 0, 'Admin2', '3701930b16dd2f85087dabe68d7602b0', 0),
(120905, 'Baltazar Martinez', 1, 2000, 5, 'Baltagood', 'ba557f61899fa22c26cdd7685cfe3e52', 2),
(175084, 'Maria Alicia ', 1, 2000, 1, 'Alicia', 'bbc155fb2b111bf61c4f5ff892915e6b', 2),
(182345, 'Fermin Morales Robles', 1, 2012, 3, 'Fermin', '491a08a7692c4adfbfda087a521f6ad2', 2),
(183685, 'Victor Miguel Banda ', 1, 2020, 3, 'Victor', '755f85c2723bb39381c7379a604160d8', 2),
(185049, 'Silvio Enrique Balderas', 1, 2020, 1, 'Silvio', '08a689fab9b0ba77c9e555c4cb3ed1e1', 2),
(185083, 'Alejandro Osorno Beltrán', 1, 2022, 3, 'Osorno', '3882a94c64066370fa15aa4d8fec006b', 1),
(190850, 'Liliana Gamez', 1, 2020, 9, 'Lili', '800e4b5134efcae19d45f0fc4f8cfbbc', 2),
(222222, 'Rubén Cardenas', 1, 1, 3, 'Ruben', '03cf2f5c91fc0f159203edcd5542df85', 2),
(583685, 'David Uriel Quirino', 1, 2012, 1, 'Quirino', '45cd67857a960c789e5e704211f79cff', 2),
(809624, 'Axel Alejandro Leos Manzo', 1, 2022, 0, '0809623', 'cf0314c73497788da90cc56dc352ff69', 1),
(817546, 'Christian Alfredo Morales Meza', 1, 2023, 4, '0817546', 'f688ae26e9cfa3ba6235477831d5122e', 1),
(828704, 'Salvador Garcia Martinez Perez', 1, 2020, 8, 'Salvador GMP', 'fdab3f533b973190b5bcd15259c9225a', 2),
(830951, 'Berenice Flores Aguilar', 1, 2021, 7, 'Berenice F', '13cf69a1bb40f95869938875ec9a80cc', 2),
(845379, 'Jesus Alejandro Antonio Rocha', 1, 2021, 7, '0845379', 'e843281b547f1341c6f0b91e9ea5b99f', 1),
(879216, 'Gustavo Zapata Baltierra', 1, 2019, 5, '0879216', '69800dd82fb5aec27ad7f29645cf9e0b', 1),
(882194, 'Octavio Vazquez Solorio', 1, 2020, 8, '0882194', '912fff0e6fa07aebf44558042cbf70d6', 1),
(893847, 'David Beltran Reyna', 1, 2019, 9, '0893847', '738741108549e645aaffbaae0deaa2eb', 1),
(111111111, 'Omar Montano Rivas', 1, 2001, 0, 'Omar M', '923c3d0d18e4fd8de5e4a332da0cbdb3', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `academias`
--
ALTER TABLE `academias`
  ADD PRIMARY KEY (`area`);

--
-- Indices de la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD KEY `calificaciones_ibfk_1` (`alumno`),
  ADD KEY `calificaciones_ibfk_2` (`grupo`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`carrera`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`grupo`),
  ADD KEY `materia` (`materia`),
  ADD KEY `maestro` (`maestro`),
  ADD KEY `horario` (`horario`),
  ADD KEY `salon` (`salon`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`horario`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`materia`),
  ADD KEY `carrera` (`carrera`),
  ADD KEY `materia_anterior` (`materia_anterior`),
  ADD KEY `area` (`area`);

--
-- Indices de la tabla `salones`
--
ALTER TABLE `salones`
  ADD PRIMARY KEY (`salon`);

--
-- Indices de la tabla `tipousuarios`
--
ALTER TABLE `tipousuarios`
  ADD PRIMARY KEY (`tipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`matricula`),
  ADD KEY `carrera` (`carrera`),
  ADD KEY `fk_tipo_usuario` (`tipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `academias`
--
ALTER TABLE `academias`
  MODIFY `area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `carrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `salones`
--
ALTER TABLE `salones`
  MODIFY `salon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `calificaciones_ibfk_1` FOREIGN KEY (`alumno`) REFERENCES `usuarios` (`matricula`),
  ADD CONSTRAINT `calificaciones_ibfk_2` FOREIGN KEY (`grupo`) REFERENCES `grupos` (`grupo`);

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `grupos_ibfk_2` FOREIGN KEY (`maestro`) REFERENCES `usuarios` (`matricula`),
  ADD CONSTRAINT `grupos_ibfk_3` FOREIGN KEY (`horario`) REFERENCES `horarios` (`horario`),
  ADD CONSTRAINT `grupos_ibfk_4` FOREIGN KEY (`salon`) REFERENCES `salones` (`salon`),
  ADD CONSTRAINT `grupos_ibfk_5` FOREIGN KEY (`materia`) REFERENCES `materias` (`materia`);

--
-- Filtros para la tabla `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `materias_ibfk_2` FOREIGN KEY (`materia_anterior`) REFERENCES `materias` (`materia`),
  ADD CONSTRAINT `materias_ibfk_3` FOREIGN KEY (`carrera`) REFERENCES `carreras` (`carrera`),
  ADD CONSTRAINT `materias_ibfk_4` FOREIGN KEY (`area`) REFERENCES `academias` (`area`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_tipo_usuario` FOREIGN KEY (`tipo`) REFERENCES `tipousuarios` (`tipo`),
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`carrera`) REFERENCES `carreras` (`carrera`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
