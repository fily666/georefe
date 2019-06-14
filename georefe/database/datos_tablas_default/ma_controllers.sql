-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-05-2018 a las 21:34:35
-- Versión del servidor: 5.7.22-0ubuntu0.16.04.1
-- Versión de PHP: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sism`
--

--
-- Volcado de datos para la tabla `ma_controllers`
--

INSERT INTO `ma_controllers` (`id`, `name`, `url`, `status_id`) VALUES
(1, 'Admin -\n Perfiles', 'MaGroups', 1),
(2, 'Admin -\n Usuarios', 'Users', 1),
(3, 'Home', 'Home', 1),
(4, 'Admin -Personas', 'Persons', 1),
(5, 'Ambientes - Verificación', 'Verificacion', 1),
(6, 'Ambientes - Call Center', 'CallCenter', 1),
(7, 'Ambientes- Puntos de Encuentro', 'SiPuntoEncuentros', 1),
(8, 'Admin - Temas', 'SiTemas', 1),
(9, 'Ambientes - Exodos', 'SiExodos', 1),
(10, 'Ambientes - Jornadas', 'SiJornadas', 1),
(11, 'Grupos de Transformación', 'SiGts', 1),
(12, 'Reportes', 'Reportes', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
