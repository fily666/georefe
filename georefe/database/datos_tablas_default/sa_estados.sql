-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-05-2018 a las 21:35:53
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
-- Volcado de datos para la tabla `sa_estados`
--

INSERT INTO `sa_estados` (`id`, `value`, `categoria`) VALUES
(1, 'Activo', 'GENERAL'),
(2, 'Inactivo', 'GENERAL'),
(3, 'Eliminado', 'GENERAL'),
(4, 'Cancelado', 'GT'),
(5, 'Anulado', 'GT'),
(6, 'Abierto', 'GT'),
(7, 'Cerrado', 'GT'),
(9, 'Activo', 'AMBIENTES'),
(10, 'Inactivo', 'AMBIENTES'),
(11, 'Cancelado', 'AMBIENTES'),
(12, 'Anulado', 'AMBIENTES');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
