-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-05-2018 a las 21:35:06
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
-- Volcado de datos para la tabla `ma_actions`
--

INSERT INTO `ma_actions` (`id`, `name`, `url`, `controller_id`, `status_id`) VALUES
(1, 'Listar', 'index', 1, 1),
(2, 'Agregar', 'add', 1, 1),
(3, 'Editar', 'edit', 1, 1),
(4, 'Eliminar', 'delete', 1, 1),
(5, 'Listar', 'index', 2, 1),
(6, 'Agregar', 'add', 2, 1),
(7, 'Editar', 'edit', 2, 1),
(8, 'Eliminar', 'delete', 2, 1),
(9, 'Home', 'index', 3, 1),
(10, 'Cambio de Contraseña', 'sendmailpassword', 2, 1),
(11, 'Listar', 'index', 4, 1),
(12, 'Agregar', 'add', 4, 1),
(13, 'Editar', 'edit', 4, 1),
(14, 'Eliminar', 'delete', 4, 1),
(15, 'Datos Complementarios', 'add2', 4, 1),
(16, 'Datos de parientes', 'add3', 4, 1),
(17, 'Eliminar Parientes', 'deletepariente', 4, 1),
(18, 'Listar', 'index', 5, 1),
(19, 'Agregar', 'add', 5, 1),
(20, 'Editar', 'edit', 5, 1),
(21, 'Eliminar', 'delete', 5, 1),
(22, 'Resultado de Llamada', 'resultadollamada', 5, 1),
(23, 'Listar', 'index', 6, 1),
(24, 'Llenar Encuesta', 'encuesta', 6, 1),
(25, 'Listar', 'index', 7, 1),
(26, 'Agregar', 'add', 7, 1),
(27, 'Editar', 'edit', 7, 1),
(28, 'Eliminar', 'delete', 7, 1),
(29, 'Listar', 'index', 8, 1),
(30, 'Agregar', 'add', 8, 1),
(31, 'Editar', 'edit', 8, 1),
(32, 'Eliminar', 'delete', 8, 1),
(33, 'Listar por Tipo', 'index2', 8, 1),
(34, 'Asociar Temas', 'index2', 7, 1),
(35, 'Eliminar Asociación Temas', 'delete2', 7, 1),
(36, 'Editar Asociación Temas', 'edit2', 7, 1),
(37, 'Gestionar Aistentes', 'asistentes', 7, 1),
(38, 'Gestionar Asistencia', 'asistencia', 7, 1),
(39, 'Eliminar Asistente', 'delete3', 7, 1),
(40, 'Listar', 'index', 9, 1),
(41, 'Agregar', 'add', 9, 1),
(42, 'Editar', 'edit', 9, 1),
(43, 'Eliminar', 'delete', 9, 1),
(44, 'Asociar Temas', 'index2', 9, 1),
(45, 'Eliminar Asociación Temas', 'delete2', 9, 1),
(46, 'Editar Asociación Temas', 'edit2', 9, 1),
(47, 'Gestionar Aistentes', 'asistentes', 9, 1),
(48, 'Gestionar Asistencia', 'asistencia', 9, 1),
(49, 'Eliminar Asistente', 'delete3', 9, 1),
(50, 'Listar', 'index', 10, 1),
(51, 'Agregar', 'add', 10, 1),
(52, 'Editar', 'edit', 10, 1),
(53, 'Eliminar', 'delete', 10, 1),
(54, 'Asociar Temas', 'index2', 10, 1),
(55, 'Eliminar Asociación Temas', 'delete2', 10, 1),
(56, 'Editar Asociación Temas', 'edit2', 10, 1),
(57, 'Gestionar Aistentes', 'asistentes', 10, 1),
(58, 'Gestionar Asistencia', 'asistencia', 10, 1),
(59, 'Eliminar Asistente', 'delete3', 10, 1),
(60, 'Listar', 'index', 11, 1),
(61, 'Agregar', 'add', 11, 1),
(62, 'Editar', 'edit', 11, 1),
(63, 'Eliminar', 'delete', 11, 1),
(64, 'Asociar Temas', 'index2', 11, 1),
(65, 'Eliminar Asociación Temas', 'delete2', 11, 1),
(66, 'Editar Asociación Temas', 'edit2', 11, 1),
(67, 'Gestionar Aistentes', 'asistentes', 11, 1),
(68, 'Gestionar Asistencia', 'asistencia', 11, 1),
(69, 'Eliminar Asistente', 'delete3', 11, 1),
(70, 'Lideres GT', 'reporte1', 12, 1),
(73, 'Individual', 'reporte2', 12, 1),
(74, 'Sin Muros Números', 'reporte3', 12, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
