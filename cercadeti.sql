-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-07-2022 a las 15:48:04
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cercadeti`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estaciones`
--

CREATE TABLE `estaciones` (
  `id_estaciones` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `cupos` varchar(150) NOT NULL,
  `cupos_vol` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estaciones`
--

INSERT INTO `estaciones` (`id_estaciones`, `nombre`, `cupos`, `cupos_vol`) VALUES
(1, 'Medicina general', '1000', '100'),
(2, 'Masajes', '150', '15'),
(3, 'Vacunación', '0', '0'),
(4, 'Asesoría legal', '60', '6'),
(5, 'Psicología', '0', '0'),
(6, 'Mega ropero', '0', '0'),
(7, 'Peluquería', '120', '12'),
(8, 'Barbería', '120', '12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion_estaciones`
--

CREATE TABLE `inscripcion_estaciones` (
  `id_ie` int(11) NOT NULL,
  `id_estaciones` int(11) NOT NULL,
  `id_miembro` int(11) NOT NULL,
  `id_voluntario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inscripcion_estaciones`
--

INSERT INTO `inscripcion_estaciones` (`id_ie`, `id_estaciones`, `id_miembro`, `id_voluntario`) VALUES
(8, 1, 311, 3),
(9, 2, 311, 3),
(10, 4, 311, 3),
(11, 7, 311, 3),
(12, 8, 311, 3),
(13, 1, 311, 3),
(14, 2, 311, 3),
(15, 4, 311, 3),
(16, 7, 311, 3),
(17, 8, 311, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `miembros`
--

CREATE TABLE `miembros` (
  `id_miembro` int(11) NOT NULL,
  `codigo` varchar(1000) DEFAULT NULL,
  `cedula` varchar(100) NOT NULL,
  `nombres` varchar(200) DEFAULT NULL,
  `apellidos` varchar(200) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `sexo` varchar(2) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `peso` varchar(100) DEFAULT NULL,
  `estatura` varchar(100) DEFAULT NULL,
  `direccion` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `miembros`
--

INSERT INTO `miembros` (`id_miembro`, `codigo`, `cedula`, `nombres`, `apellidos`, `fecha_nacimiento`, `sexo`, `telefono`, `peso`, `estatura`, `direccion`) VALUES
(178, 'A0002', '0002', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(179, 'A0003', '0003', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(180, 'A0004', '0004', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(181, 'A0005', '0005', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(182, 'A0006', '0006', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(183, 'A0007', '0007', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(184, 'A0008', '0008', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(185, 'A0009', '0009', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(186, 'A0110', '0010', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(187, 'A0011', '0011', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(188, 'A0012', '0012', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(189, 'A0013', '0013', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(190, 'A0014', '0014', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(191, 'A0015', '0015', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(192, 'A0016', '0016', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(193, 'A0017', '0017', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(194, 'A0018', '0018', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(195, 'A0019', '0019', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(196, 'A0020', '0020', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(197, 'A0021', '0021', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(198, 'A0022', '0022', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(199, 'A0023', '0023', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(200, 'A0024', '0024', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(201, 'A0025', '0025', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(202, 'A0026', '0026', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(203, 'A0027', '0027', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(204, 'A0028', '0028', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(205, 'A0029', '0029', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(206, 'A0030', '0030', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(207, 'A0031', '0031', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(208, 'A0032', '0032', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(209, 'A0033', '0033', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(210, 'A0034', '0034', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(211, 'A0035', '0035', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(212, 'A0036', '0036', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(213, 'A0037', '0037', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(214, 'A0038', '0038', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(215, 'A0039', '0039', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(216, 'A0040', '0040', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(217, 'A0041', '0041', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(218, 'A0042', '0042', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(219, 'A0043', '0043', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(220, 'A0044', '0044', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(221, 'A0045', '0045', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(222, 'A0046', '0046', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(223, 'A0047', '0047', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(224, 'A0048', '0048', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(225, 'A0049', '0049', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(226, 'A0050', '0050', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(227, 'A0051', '0051', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(228, 'A0052', '0052', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(229, 'A0053', '0053', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(230, 'A0054', '0054', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(231, 'A0055', '0055', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(232, 'A0056', '0056', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(233, 'A0057', '0057', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(234, 'A0058', '0058', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(235, 'A0059', '0059', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(236, 'A0060', '0060', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(237, 'A0061', '0061', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(238, 'A0062', '0062', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(239, 'A0063', '0063', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(240, 'A0064', '0064', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(241, 'A0065', '0065', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(242, 'A0066', '0066', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(243, 'A0067', '0067', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(244, 'A0068', '0068', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(245, 'A0069', '0069', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(246, 'A0070', '0070', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(247, 'A0071', '0071', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(248, 'A0072', '0072', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(249, 'A0073', '0073', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(250, 'A0074', '0074', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(251, 'A0075', '0075', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(252, 'A0076', '0076', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(253, 'A0077', '0077', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(254, 'A0078', '0078', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(255, 'A0079', '0079', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(256, 'A0080', '0080', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(257, 'A0081', '0081', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(258, 'A0082', '0082', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(259, 'A0083', '0083', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(260, 'A0084', '0084', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(261, 'A0085', '0085', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(262, 'A0086', '0086', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(263, 'A0087', '0087', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(264, 'A0088', '0088', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(265, 'A0089', '0089', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(266, 'A0090', '0090', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(268, 'A0092', '0092', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(269, 'A0093', '0093', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(270, 'A0094', '0094', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(271, 'A0095', '0095', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(272, 'A0096', '0096', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(273, 'A0097', '0097', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(274, 'A0098', '0098', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(275, 'A0099', '0099', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(276, 'A0100', '0100', 'ELIZABETH MARIA', 'FAJARDO RUGELES', '1974-05-20', 'F', '(0416) 345-7698', '78', '1,89', 'CALLLE 30 ENTRE 20 Y 21'),
(280, 'A0010', '24022510', 'ASKDJASDJ', 'AKJSHDAJSD ', '1994-12-20', 'M', '(0412) 519-7309', '89', '160', 'ASDA SLDKAS KDJ'),
(281, 'A0091', '5653543543', 'HYTR', 'FGETRE', '1994-12-20', 'M', '', '', '', ''),
(282, 'A0101', '2402251022', 'ASDASD ', 'SDA SD AS', '1994-12-20', 'M', '', '', '', ''),
(283, 'A0102', '123123123', 'ASDASD', 'ASDASDASD', '1994-12-20', 'M', '', '', '', ''),
(284, 'A0103', '564564', 'QSDASD ', 'SDASD ', '1994-12-20', 'F', '', '', '', ''),
(286, 'A0001', '24022510121', 'LIAM', 'FERNANDEZ', '1994-12-20', 'M', '(0412) 519-7309', '50', '20', 'ASDASDASDASD '),
(311, 'A0104', '121231092381', 'ALSDJAKSDJ', 'JASLKDJASLKDJ', '1994-12-20', 'M', '(0412) 519-7309', '80', '156', 'BARRIO LASDLASAS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `usuario` varchar(150) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `rango_numeros` varchar(150) DEFAULT NULL,
  `nivel_usuario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `usuario`, `pass`, `rango_numeros`, `nivel_usuario`) VALUES
(1, 'ABRAHAM', 'ABRAMFER', '812591e32cb61e3fba9a36ff54baf136', '1-1000', '1'),
(2, 'VOLUNTARIO 1', 'VOL1', '2b0d59c7031769e80c8e5118b6ec7694', '1-100', '2'),
(3, 'VOLUNTARIO 2', 'VOL2', 'a110e8ed91b0de267a5728888b1f4ed1', '101-200', '2'),
(4, 'VOLUNTARIO 3', 'VOL3', 'bf53a67212af5fa182cf4e23fd2755f6', '201-300', '2'),
(5, 'VOLUNTARIO 4', 'VOL4', '26c7e99d5fc977694b8cbceafc8f4278', '301-400', '2'),
(6, 'VOLUNTARIO 5', 'VOL5', '0b49dcd9aef1f7668a403d6e627a9ad7', '401-500', '2'),
(7, 'VOLUNTARIO 6', 'VOL6', '27c0c051ccbe7014890a084865989f42', '501-600', '2'),
(8, 'VOLUNTARIO 7', 'VOL7', '9943fda690378b987cbf927ffd066c61', '601-700', '2'),
(9, 'VOLUNTARIO 8', 'VOL8', '770dea666cedf1b470a032bea9312e93', '701-800', '2'),
(10, 'VOLUNTARIO 9', 'VOL9', '068a5f2a70b6d8bb52299bf90421e796', '801-900', '2'),
(11, 'VOLUNTARIO 10', 'VOL10', '66621880045b21352bc7c3857406789a', '901-1000', '2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estaciones`
--
ALTER TABLE `estaciones`
  ADD PRIMARY KEY (`id_estaciones`);

--
-- Indices de la tabla `inscripcion_estaciones`
--
ALTER TABLE `inscripcion_estaciones`
  ADD PRIMARY KEY (`id_ie`);

--
-- Indices de la tabla `miembros`
--
ALTER TABLE `miembros`
  ADD PRIMARY KEY (`id_miembro`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estaciones`
--
ALTER TABLE `estaciones`
  MODIFY `id_estaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `inscripcion_estaciones`
--
ALTER TABLE `inscripcion_estaciones`
  MODIFY `id_ie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `miembros`
--
ALTER TABLE `miembros`
  MODIFY `id_miembro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=312;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;