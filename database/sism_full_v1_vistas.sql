-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 26-04-2018 a las 21:51:50
-- Versión del servidor: 5.7.21-0ubuntu0.16.04.1
-- Versión de PHP: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sism`
--

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_map_general`
--
CREATE TABLE `v_map_general` (
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_promedios_evalua_guia`
--
CREATE TABLE `v_promedios_evalua_guia` (
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_promedios_evalua_guia_esp`
--
CREATE TABLE `v_promedios_evalua_guia_esp` (
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_reporte_evalua_guia`
--
CREATE TABLE `v_reporte_evalua_guia` (
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_reporte_evalua_guia_esp`
--
CREATE TABLE `v_reporte_evalua_guia_esp` (
);

-- --------------------------------------------------------

--
-- Estructura para la vista `v_map_general`
--
DROP TABLE IF EXISTS `v_map_general`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_map_general`  AS  (select rand() AS `v_id`,`gt`.`id_grupo_transformacion` AS `idgt`,`li`.`id_datos_basicos` AS `idDatosBasicLider`,`gt`.`map_lat` AS `latitud_gt`,`gt`.`map_lng` AS `longitud_gt`,`db`.`id_datos_basicos` AS `idDatosBasicPer`,`db`.`nombres` AS `nombres`,`db`.`apellidos` AS `apellidos`,`db`.`map_latitud` AS `latitud_per`,`db`.`map_longitud` AS `longitud_per` from (((`si_datos_basicos` `db` join `si_asistencia_grupos` `ag` on((`db`.`id_datos_basicos` = `ag`.`id_datos_basicos`))) join `si_grupos_transformacion` `gt` on((`ag`.`id_grupo_transformacion` = `gt`.`id_grupo_transformacion`))) join `si_lideres` `li` on((`li`.`id_lider` = `gt`.`id_lider_asignado1`))) where ((`gt`.`borrado` = 0) and (`gt`.`id_estado` = 5) and (`ag`.`borrado` = 0)) order by `gt`.`id_grupo_transformacion`) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_promedios_evalua_guia`
--
DROP TABLE IF EXISTS `v_promedios_evalua_guia`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_promedios_evalua_guia`  AS  (select `eg`.`id_guia_evaluado` AS `id_guia_evaluado`,`db`.`documento` AS `documento`,`db`.`nombres` AS `nombres`,`db`.`apellidos` AS `apellidos`,`eg`.`id_exodo` AS `id_exodo`,avg(`eg`.`calif_preparacion`) AS `Prom_Pre`,avg(`eg`.`calif_ministracion`) AS `Prom_Min`,avg(`eg`.`calif_servicio`) AS `Prom_Ser` from (`si_evaluaciones_guias` `eg` join `si_datos_basicos` `db` on((`eg`.`id_guia_evaluado` = `db`.`id_datos_basicos`))) group by `eg`.`id_exodo`,`eg`.`id_guia_evaluado`) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_promedios_evalua_guia_esp`
--
DROP TABLE IF EXISTS `v_promedios_evalua_guia_esp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_promedios_evalua_guia_esp`  AS  (select `ege`.`id_guiaEsp_evaluado` AS `id_guiaEsp_evaluado`,`db`.`documento` AS `documento`,`db`.`nombres` AS `nombres`,`db`.`apellidos` AS `apellidos`,`ege`.`id_exodo` AS `id_exodo`,avg(`ege`.`calif_orienta_ministra_guias`) AS `Prom_Orienta_Guias`,avg(`ege`.`calif_participa`) AS `Prom_Parti`,avg(`ege`.`calif_orienta_coordinador`) AS `Prom_Orienta_Coord` from (`si_evaluaciones_guias_espirituales` `ege` join `si_datos_basicos` `db` on((`ege`.`id_guiaEsp_evaluado` = `db`.`id_datos_basicos`))) group by `ege`.`id_exodo`,`ege`.`id_guiaEsp_evaluado`) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_reporte_evalua_guia`
--
DROP TABLE IF EXISTS `v_reporte_evalua_guia`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_reporte_evalua_guia`  AS  (select rand() AS `V_ID`,`peg`.`id_guia_evaluado` AS `ID_guia`,`peg`.`documento` AS `documento`,`peg`.`nombres` AS `nombres`,`peg`.`apellidos` AS `apellidos`,`peg`.`id_exodo` AS `id_exodo`,`ex`.`descripcion` AS `nom_exodo`,sum((((`peg`.`Prom_Pre` + `peg`.`Prom_Min`) + `peg`.`Prom_Ser`) / 3)) AS `Prom_Total`,concat(`db2`.`nombres`,`db2`.`apellidos`) AS `Lider_GT`,concat(`db3`.`nombres`,`db3`.`apellidos`) AS `Pastor` from ((((((((`si_datos_basicos` `db` join `v_promedios_evalua_guia` `peg` on((`db`.`id_datos_basicos` = `peg`.`id_guia_evaluado`))) left join `si_exodos` `ex` on((`peg`.`id_exodo` = `ex`.`id_exodo`))) left join `si_grupos_transformacion_asistentes` `gta` on((`peg`.`id_guia_evaluado` = `gta`.`id_datos_basicos`))) left join `si_grupos_transformacion` `gt` on((`gta`.`id_grupo_transformacion` = `gt`.`id_grupo_transformacion`))) left join `si_lideres` `li` on((`gt`.`id_lider_asignado1` = `li`.`id_lider`))) left join `si_pastores` `pr` on((`gt`.`id_pastor` = `pr`.`id_pastor`))) left join `si_datos_basicos` `db2` on((`li`.`id_datos_basicos` = `db2`.`id_datos_basicos`))) left join `si_datos_basicos` `db3` on((`pr`.`id_datos_basicos` = `db3`.`id_datos_basicos`))) group by `peg`.`id_guia_evaluado`,`peg`.`id_exodo`) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_reporte_evalua_guia_esp`
--
DROP TABLE IF EXISTS `v_reporte_evalua_guia_esp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_reporte_evalua_guia_esp`  AS  (select rand() AS `V_ID`,`pege`.`id_guiaEsp_evaluado` AS `ID_guia_esp`,`pege`.`documento` AS `documento`,`pege`.`nombres` AS `nombres`,`pege`.`apellidos` AS `apellidos`,`pege`.`id_exodo` AS `id_exodo`,`ex`.`descripcion` AS `nom_exodo`,sum((((`pege`.`Prom_Orienta_Guias` + `pege`.`Prom_Parti`) + `pege`.`Prom_Orienta_Coord`) / 3)) AS `Prom_Total`,concat(`db2`.`nombres`,`db2`.`apellidos`) AS `Lider_GT`,concat(`db3`.`nombres`,`db3`.`apellidos`) AS `Pastor` from ((((((((`si_datos_basicos` `db` join `v_promedios_evalua_guia_esp` `pege` on((`db`.`id_datos_basicos` = `pege`.`id_guiaEsp_evaluado`))) left join `si_exodos` `ex` on((`pege`.`id_exodo` = `ex`.`id_exodo`))) left join `si_grupos_transformacion_asistentes` `gta` on((`pege`.`id_guiaEsp_evaluado` = `gta`.`id_datos_basicos`))) left join `si_grupos_transformacion` `gt` on((`gta`.`id_grupo_transformacion` = `gt`.`id_grupo_transformacion`))) left join `si_lideres` `li` on((`gt`.`id_lider_asignado1` = `li`.`id_lider`))) left join `si_pastores` `pr` on((`gt`.`id_pastor` = `pr`.`id_pastor`))) left join `si_datos_basicos` `db2` on((`li`.`id_datos_basicos` = `db2`.`id_datos_basicos`))) left join `si_datos_basicos` `db3` on((`pr`.`id_datos_basicos` = `db3`.`id_datos_basicos`))) group by `pege`.`id_guiaEsp_evaluado`,`pege`.`id_exodo`) ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
