-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-05-2018 a las 21:26:22
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_actions`
--

CREATE TABLE `ma_actions` (
  `id` int(11) NOT NULL COMMENT 'Llave principal de la tabla',
  `name` varchar(100) NOT NULL,
  `url` varchar(150) NOT NULL,
  `controller_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL COMMENT 'Llave para definir el estado del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla en la que se almacenan todas las acciones que impleneta el sistema.';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_actions_groups`
--

CREATE TABLE `ma_actions_groups` (
  `id` int(11) NOT NULL COMMENT 'Llave principal de la tabla',
  `action_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar la accion',
  `group_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el grupo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla en la que se almacenan la asociación entre grupos y acciones.';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_controllers`
--

CREATE TABLE `ma_controllers` (
  `id` int(11) NOT NULL COMMENT 'Llave principal de la tabla',
  `name` varchar(100) NOT NULL,
  `url` varchar(150) NOT NULL,
  `status_id` int(11) DEFAULT NULL COMMENT 'Llave para definir el estado del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla en la que se almacenan todos los controladores que impleneta el sistema.';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_groups`
--

CREATE TABLE `ma_groups` (
  `id` int(11) NOT NULL COMMENT 'Llave principal de la tabla',
  `name` varchar(100) NOT NULL,
  `status_id` int(11) DEFAULT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime DEFAULT NULL COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla en la que se almacenan todos los grupos o perfiles que impleneta el sistema.';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ma_propiedades`
--

CREATE TABLE `ma_propiedades` (
  `id` int(12) NOT NULL,
  `padre_id` int(20) DEFAULT NULL,
  `valor` varchar(250) DEFAULT NULL,
  `status_id` int(11) NOT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sa_estados`
--

CREATE TABLE `sa_estados` (
  `id` int(11) NOT NULL,
  `value` varchar(45) DEFAULT NULL,
  `categoria` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_datos_basicos`
--

CREATE TABLE `si_datos_basicos` (
  `id` int(12) NOT NULL,
  `nombres` varchar(80) DEFAULT NULL,
  `apellidos` varchar(80) NOT NULL,
  `id_tipo_documento` int(20) DEFAULT NULL,
  `documento` varchar(60) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `direccion` varchar(80) DEFAULT NULL,
  `telefono1` varchar(80) DEFAULT NULL,
  `telefono2` varchar(80) DEFAULT NULL,
  `celular` varchar(80) DEFAULT NULL,
  `fotografia` varchar(255) DEFAULT 'default.png',
  `map_latitud` double DEFAULT NULL,
  `map_longitud` double DEFAULT NULL,
  `status_id` int(11) NOT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_datos_complementarios`
--

CREATE TABLE `si_datos_complementarios` (
  `id` int(12) NOT NULL,
  `id_datos_basicos` int(12) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `lugar_nacimiento` varchar(60) DEFAULT NULL,
  `id_estado_civil` int(12) DEFAULT NULL,
  `id_genero` int(12) DEFAULT NULL,
  `nombre_conyugue` varchar(80) DEFAULT NULL,
  `id_tipo_doc_conyugue` int(12) DEFAULT NULL,
  `documento_conyugue` int(60) DEFAULT NULL,
  `id_nivel_estudio` int(12) DEFAULT NULL,
  `id_profesion` int(12) DEFAULT NULL,
  `id_ejerce_profesion` int(12) DEFAULT NULL,
  `nombre_empresa` varchar(60) DEFAULT NULL,
  `direccion_empresa` varchar(60) DEFAULT NULL,
  `telefono_empresa` varchar(45) DEFAULT NULL,
  `id_ministerio` int(12) DEFAULT NULL,
  `ciudad` varchar(60) DEFAULT NULL,
  `zona` varchar(60) DEFAULT NULL,
  `barrio` varchar(60) DEFAULT NULL,
  `status_id` int(11) NOT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_evaluaciones_coordinador`
--

CREATE TABLE `si_evaluaciones_coordinador` (
  `id_evalua_coordinador` int(11) NOT NULL,
  `id_exodo` int(20) DEFAULT NULL,
  `calif_orientacion` int(3) DEFAULT NULL,
  `observa_calif_orienta` varchar(250) DEFAULT NULL,
  `calif_organizacion` int(3) DEFAULT NULL,
  `observa_calif_organiza` varchar(250) DEFAULT NULL,
  `id_coordinador_evaluado` int(20) DEFAULT NULL,
  `id_evaluador` int(20) DEFAULT NULL,
  `id_tipo_evaluador` int(20) DEFAULT NULL,
  `borrado` int(1) DEFAULT NULL,
  `auditoria` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_evaluaciones_coord_asistente`
--

CREATE TABLE `si_evaluaciones_coord_asistente` (
  `id_evalua_coord_asist` int(11) NOT NULL,
  `id_exodo` int(20) DEFAULT NULL,
  `calif_preparacion_asistCoord` int(3) DEFAULT NULL,
  `observa_calif_preparacion_asistCoord` varchar(250) DEFAULT NULL,
  `calif_ministracion_asistCoord` int(3) DEFAULT NULL,
  `observa_calif_ministracion_asistCoord` varchar(250) DEFAULT NULL,
  `calif_servicio_asistCoord` int(3) DEFAULT NULL,
  `observa_calif_servicio_asistCoord` varchar(250) DEFAULT NULL,
  `calif_desempenio_asistCoord` int(3) DEFAULT NULL,
  `observa_calif_desempenio_asistCoord` varchar(250) DEFAULT NULL,
  `id_asistCoord_evaluado` int(20) DEFAULT NULL,
  `id_evaluador` int(20) DEFAULT NULL,
  `id_tipo_evaluador` int(20) DEFAULT NULL,
  `borrado` int(1) DEFAULT NULL,
  `auditoria` varchar(180) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_evaluaciones_guias`
--

CREATE TABLE `si_evaluaciones_guias` (
  `id_evalua_guia` int(11) NOT NULL,
  `id_exodo` int(20) DEFAULT NULL,
  `num_personas` int(3) DEFAULT NULL,
  `calif_preparacion` int(3) DEFAULT NULL,
  `observa_calif_preparacion` varchar(250) DEFAULT NULL,
  `calif_ministracion` int(3) DEFAULT NULL,
  `observa_calif_ministracion` varchar(250) DEFAULT NULL,
  `calif_servicio` int(3) DEFAULT NULL,
  `observa_calif_servicio` varchar(250) DEFAULT NULL,
  `id_guia_evaluado` int(20) DEFAULT NULL,
  `id_evaluador` int(20) DEFAULT NULL,
  `id_tipo_evaluador` int(20) DEFAULT NULL,
  `borrado` int(1) DEFAULT NULL,
  `auditoria` varchar(180) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla que guarda las evaluaciones realizadas a los guías durante un exodo';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_evaluaciones_guias_espirituales`
--

CREATE TABLE `si_evaluaciones_guias_espirituales` (
  `id_evalua_guia_esp` int(11) NOT NULL,
  `id_exodo` int(20) DEFAULT NULL,
  `calif_orienta_ministra_guias` int(3) DEFAULT NULL,
  `observa_calif_orienta` varchar(250) DEFAULT NULL,
  `calif_participa` int(3) DEFAULT NULL,
  `observa_calif_participa` varchar(250) DEFAULT NULL,
  `calif_orienta_coordinador` int(3) DEFAULT NULL,
  `observa_calif_orienta_coord` varchar(250) DEFAULT NULL,
  `id_guiaEsp_evaluado` int(20) DEFAULT NULL,
  `id_evaluador` int(20) DEFAULT NULL,
  `id_tipo_evaluador` int(20) DEFAULT NULL,
  `borrado` int(1) DEFAULT NULL,
  `auditoria` varchar(180) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Evaluaciones guías espirituales por exodo';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_exodos`
--

CREATE TABLE `si_exodos` (
  `id` int(11) NOT NULL,
  `descripcion` text,
  `id_coordinador_exd` int(20) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `id_tipo_exodo` int(20) DEFAULT NULL,
  `status_id` int(11) NOT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_exodo_asistencias`
--

CREATE TABLE `si_exodo_asistencias` (
  `id` int(20) NOT NULL,
  `id_exodo_asistente` int(20) DEFAULT NULL,
  `id_exodo_tema` int(11) NOT NULL,
  `asistio` tinyint(1) NOT NULL COMMENT '0 => NO; 1 => SI',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_exodo_asistentes`
--

CREATE TABLE `si_exodo_asistentes` (
  `id` int(11) NOT NULL,
  `id_datos_basicos` int(20) DEFAULT NULL,
  `id_exodo` int(10) DEFAULT NULL,
  `id_tipo_asistente` int(20) DEFAULT NULL,
  `id_guia` int(20) NOT NULL,
  `id_pastor` int(20) NOT NULL,
  `status_id` int(11) NOT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_exodo_temas`
--

CREATE TABLE `si_exodo_temas` (
  `id` int(20) NOT NULL,
  `id_exodo` int(20) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `id_lider` int(11) DEFAULT NULL,
  `status_id` int(11) NOT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_gts`
--

CREATE TABLE `si_gts` (
  `id` int(11) NOT NULL,
  `fecha_inicia` datetime DEFAULT NULL,
  `fecha_termina` datetime DEFAULT NULL,
  `direccion` varchar(80) DEFAULT NULL,
  `telefono` varchar(80) DEFAULT NULL,
  `id_categoria` int(20) DEFAULT NULL,
  `id_dia_reunion` int(20) DEFAULT NULL,
  `id_lider_asignado1` int(20) DEFAULT NULL,
  `id_lider_asignado2` int(20) DEFAULT NULL,
  `id_lider_asignado3` int(20) DEFAULT NULL,
  `id_lider_asignado4` int(20) DEFAULT NULL,
  `id_ciudad` int(20) DEFAULT NULL,
  `id_localidad` int(20) DEFAULT NULL,
  `id_barrio` int(20) DEFAULT NULL,
  `hora_reunion` time DEFAULT NULL,
  `id_pastor` int(20) NOT NULL,
  `map_lat` double DEFAULT NULL,
  `map_lng` double DEFAULT NULL,
  `status_id` int(11) NOT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_gt_asistencias`
--

CREATE TABLE `si_gt_asistencias` (
  `id` int(20) NOT NULL,
  `id_gt_asistente` int(20) DEFAULT NULL,
  `id_gt_tema` int(11) NOT NULL,
  `asistio` tinyint(1) NOT NULL COMMENT '0 => NO; 1 => SI',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_gt_asistentes`
--

CREATE TABLE `si_gt_asistentes` (
  `id` int(11) NOT NULL,
  `id_gt` int(11) NOT NULL,
  `id_datos_basicos` int(20) DEFAULT NULL,
  `id_tipo_asistente` int(20) DEFAULT NULL,
  `status_id` int(11) NOT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_gt_temas`
--

CREATE TABLE `si_gt_temas` (
  `id` int(20) NOT NULL,
  `id_gt` int(20) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `status_id` int(11) NOT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_jornadas`
--

CREATE TABLE `si_jornadas` (
  `id` int(11) NOT NULL,
  `descripcion` text,
  `id_coordinador_exd` int(20) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `id_tipo_jornada` int(20) DEFAULT NULL,
  `status_id` int(11) NOT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_jornada_asistencias`
--

CREATE TABLE `si_jornada_asistencias` (
  `id` int(20) NOT NULL,
  `id_jornada_asistente` int(20) DEFAULT NULL,
  `id_jornada_tema` int(11) NOT NULL,
  `asistio` tinyint(1) NOT NULL COMMENT '0 => NO; 1 => SI',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_jornada_asistentes`
--

CREATE TABLE `si_jornada_asistentes` (
  `id` int(11) NOT NULL,
  `id_datos_basicos` int(20) DEFAULT NULL,
  `id_jornada` int(10) DEFAULT NULL,
  `id_tipo_asistente` int(20) DEFAULT NULL,
  `id_guia` int(20) NOT NULL,
  `id_pastor` int(20) NOT NULL,
  `id_tutor_pena` int(11) NOT NULL,
  `status_id` int(11) NOT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_jornada_temas`
--

CREATE TABLE `si_jornada_temas` (
  `id` int(20) NOT NULL,
  `id_jornada` int(20) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `id_lider` int(11) DEFAULT NULL,
  `status_id` int(11) NOT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_kids`
--

CREATE TABLE `si_kids` (
  `id_kit` int(11) NOT NULL,
  `id_datos_basicos_nino` int(20) DEFAULT NULL,
  `id_datos_basicos_acudiente1` int(20) DEFAULT NULL,
  `id_datos_basicos_acudiente2` int(20) DEFAULT NULL,
  `id_datos_basicos_acudiente3` int(20) DEFAULT NULL,
  `id_datos_basicos_acudiente4` int(20) DEFAULT NULL,
  `id_parentesco` int(20) DEFAULT NULL,
  `id_motivo_registro` int(20) DEFAULT NULL,
  `borrado` int(1) DEFAULT NULL,
  `auditoria` varchar(180) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_lideres`
--

CREATE TABLE `si_lideres` (
  `id` int(11) NOT NULL,
  `id_datos_basicos` int(20) DEFAULT NULL,
  `id_nivel` int(12) DEFAULT NULL,
  `observacion` text,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `status_id` int(11) NOT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_parientes`
--

CREATE TABLE `si_parientes` (
  `id` int(12) NOT NULL,
  `id_datos_basicos` int(20) DEFAULT NULL,
  `id_datos_basicos_pariente` int(20) DEFAULT NULL,
  `id_tipo_relacion` int(20) DEFAULT NULL,
  `status_id` int(11) NOT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_pastores`
--

CREATE TABLE `si_pastores` (
  `id` int(11) NOT NULL,
  `id_datos_basicos` int(20) DEFAULT NULL,
  `status_id` int(11) NOT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_puntos_encuentro_temas`
--

CREATE TABLE `si_puntos_encuentro_temas` (
  `id` int(20) NOT NULL,
  `id_punto_encuentro` int(20) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `id_lider` int(11) DEFAULT NULL,
  `status_id` int(11) NOT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_puntos_encu_asistencias`
--

CREATE TABLE `si_puntos_encu_asistencias` (
  `id` int(20) NOT NULL,
  `id_puntencu_asistente` int(20) DEFAULT NULL,
  `id_puntencu_tema` int(11) NOT NULL,
  `asistio` tinyint(1) NOT NULL COMMENT '0 => NO; 1 => SI',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_puntos_encu_asistentes`
--

CREATE TABLE `si_puntos_encu_asistentes` (
  `id` int(11) NOT NULL,
  `id_datos_basicos` int(20) DEFAULT NULL,
  `id_punto_encuentro` int(10) DEFAULT NULL,
  `id_tipo_asistente` int(20) DEFAULT NULL,
  `id_guia` int(20) NOT NULL,
  `id_pastor` int(20) NOT NULL,
  `status_id` int(11) NOT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_punto_encuentros`
--

CREATE TABLE `si_punto_encuentros` (
  `id` int(11) NOT NULL,
  `descripcion` text,
  `id_coordinador_exd` int(20) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `id_tipo_punto_encuentro` int(20) DEFAULT NULL,
  `status_id` int(11) NOT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_temas`
--

CREATE TABLE `si_temas` (
  `id` int(11) NOT NULL,
  `tema` varchar(250) DEFAULT NULL,
  `tipo_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_tiempo_pastoreo`
--

CREATE TABLE `si_tiempo_pastoreo` (
  `id_tiempo_pastoreo` int(11) NOT NULL,
  `id_persona` int(20) DEFAULT NULL,
  `id_item1` int(20) DEFAULT NULL,
  `valor_item1` int(3) DEFAULT NULL,
  `id_item2` int(20) DEFAULT NULL,
  `valor_item2` int(3) DEFAULT NULL,
  `id_item3` int(20) DEFAULT NULL,
  `valor_item3` int(3) DEFAULT NULL,
  `id_item4` int(20) DEFAULT NULL,
  `valor_item4` int(3) DEFAULT NULL,
  `id_item5` int(20) DEFAULT NULL,
  `valor_item5` int(3) DEFAULT NULL,
  `id_item6` int(20) DEFAULT NULL,
  `valor_item6` int(3) DEFAULT NULL,
  `id_item7` int(20) DEFAULT NULL,
  `valor_item7` int(3) DEFAULT NULL,
  `id_item8` int(20) DEFAULT NULL,
  `valor_item8` int(3) DEFAULT NULL,
  `id_usuario_modif` int(20) DEFAULT NULL,
  `id_tipo_tiempo` int(20) DEFAULT NULL,
  `fecha_modif` datetime DEFAULT NULL,
  `observaciones` text,
  `metas` text,
  `borrado` int(1) DEFAULT NULL,
  `auditoria` varchar(180) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_veri_encuestas`
--

CREATE TABLE `si_veri_encuestas` (
  `id` int(11) NOT NULL,
  `id_veri_entrega` int(20) DEFAULT NULL,
  `id_medio_info_sm` int(20) DEFAULT NULL,
  `id_resultado_llamada` int(20) DEFAULT NULL,
  `id_prioridad` int(20) DEFAULT NULL,
  `id_fase_consolidacion` int(20) DEFAULT NULL,
  `observacion` text,
  `otro_dato1` text,
  `otro_dato2` text,
  `status_id` int(11) NOT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_veri_entregas`
--

CREATE TABLE `si_veri_entregas` (
  `id` int(11) NOT NULL,
  `id_datos_basicos` int(20) DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `id_grupo_transformacion` int(20) DEFAULT NULL,
  `id_lider_asignado` int(20) DEFAULT NULL,
  `id_encargado_llamada` int(20) DEFAULT NULL,
  `id_datos_basicos_invito` int(20) DEFAULT NULL,
  `id_ubicar_gt` int(20) DEFAULT NULL,
  `fecha_hora_llamada` datetime DEFAULT NULL,
  `peticion` text,
  `id_tipo_entrega` int(20) DEFAULT NULL,
  `id_fase` int(20) DEFAULT NULL,
  `observaciones` text,
  `resultado_visita` text,
  `id_estado_llamada` int(20) DEFAULT NULL,
  `id_guia` int(20) NOT NULL,
  `id_pastor` int(20) NOT NULL,
  `otro_dato` varchar(250) DEFAULT NULL,
  `status_id` int(11) NOT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'Llave principal de la tabla',
  `person_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar los datos de una persona al usuario.',
  `group_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el grupo de usuario al que pertenece (tipo de usuario)',
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime DEFAULT NULL COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime DEFAULT NULL COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabla en la que se almacenan todos los usuarios del sistema.';

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ma_actions`
--
ALTER TABLE `ma_actions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ma_actions_1_idx` (`controller_id`),
  ADD KEY `fk_ma_actions_2_idx` (`status_id`);

--
-- Indices de la tabla `ma_actions_groups`
--
ALTER TABLE `ma_actions_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ma_actions_groups_1_idx` (`action_id`),
  ADD KEY `fk_ma_actions_groups_2_idx` (`group_id`);

--
-- Indices de la tabla `ma_controllers`
--
ALTER TABLE `ma_controllers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ma_controllers_1_idx` (`status_id`);

--
-- Indices de la tabla `ma_groups`
--
ALTER TABLE `ma_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ma_groups_1_idx` (`status_id`);

--
-- Indices de la tabla `ma_propiedades`
--
ALTER TABLE `ma_propiedades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `modifier_id` (`modifier_id`);

--
-- Indices de la tabla `sa_estados`
--
ALTER TABLE `sa_estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `si_datos_basicos`
--
ALTER TABLE `si_datos_basicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_si_datos_basicos_1` (`id_tipo_documento`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `modifier_id` (`modifier_id`);

--
-- Indices de la tabla `si_datos_complementarios`
--
ALTER TABLE `si_datos_complementarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_si_datos_complementarios_1` (`id_estado_civil`),
  ADD KEY `fk_si_datos_complementarios_2` (`id_datos_basicos`),
  ADD KEY `fk_si_datos_complementarios_3` (`id_genero`),
  ADD KEY `fk_si_datos_complementarios_4` (`id_tipo_doc_conyugue`),
  ADD KEY `fk_si_datos_complementarios_5` (`id_nivel_estudio`),
  ADD KEY `fk_si_datos_complementarios_6` (`id_profesion`),
  ADD KEY `fk_si_datos_complementarios_7` (`id_ejerce_profesion`),
  ADD KEY `fk_si_datos_complementarios_8` (`id_ministerio`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `modifier_id` (`modifier_id`);

--
-- Indices de la tabla `si_evaluaciones_coordinador`
--
ALTER TABLE `si_evaluaciones_coordinador`
  ADD PRIMARY KEY (`id_evalua_coordinador`),
  ADD KEY `fk_si_evaluaciones_coord_2` (`id_coordinador_evaluado`),
  ADD KEY `fk_si_evaluaciones_coord_1` (`id_exodo`),
  ADD KEY `	fk_si_evaluaciones_coord_4` (`id_tipo_evaluador`),
  ADD KEY `fk_si_evaluaciones_coord_3` (`id_evaluador`);

--
-- Indices de la tabla `si_evaluaciones_coord_asistente`
--
ALTER TABLE `si_evaluaciones_coord_asistente`
  ADD PRIMARY KEY (`id_evalua_coord_asist`),
  ADD KEY `fk_si_evaluaciones_asistCoord_1` (`id_exodo`),
  ADD KEY `fk_si_evaluaciones_asistCoord_2` (`id_asistCoord_evaluado`),
  ADD KEY `	fk_si_evaluaciones_asistCoord_3` (`id_evaluador`),
  ADD KEY `fk_si_evaluaciones_asistCoord_4` (`id_tipo_evaluador`);

--
-- Indices de la tabla `si_evaluaciones_guias`
--
ALTER TABLE `si_evaluaciones_guias`
  ADD PRIMARY KEY (`id_evalua_guia`),
  ADD KEY `fk_si_evaluaciones_guias_1` (`id_exodo`),
  ADD KEY `fk_si_evaluaciones_guias_2` (`id_guia_evaluado`),
  ADD KEY `fk_si_evaluaciones_guias_3` (`id_evaluador`),
  ADD KEY `fk_si_evaluaciones_guias_4` (`id_tipo_evaluador`);

--
-- Indices de la tabla `si_evaluaciones_guias_espirituales`
--
ALTER TABLE `si_evaluaciones_guias_espirituales`
  ADD PRIMARY KEY (`id_evalua_guia_esp`),
  ADD KEY `fk_si_evaluaciones_guiasEspirituales_1` (`id_exodo`),
  ADD KEY `	fk_si_evaluaciones_guiasEspirituales_2` (`id_guiaEsp_evaluado`),
  ADD KEY `	fk_si_evaluaciones_guiasEspirituales_3` (`id_evaluador`),
  ADD KEY `	fk_si_evaluaciones_guiasEspirituales_4` (`id_tipo_evaluador`);

--
-- Indices de la tabla `si_exodos`
--
ALTER TABLE `si_exodos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_si_exodos_2` (`id_tipo_exodo`),
  ADD KEY `fk_si_exodos_1` (`id_coordinador_exd`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `modifier_id` (`modifier_id`);

--
-- Indices de la tabla `si_exodo_asistencias`
--
ALTER TABLE `si_exodo_asistencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `si_exodo_asistencia_fk1` (`id_exodo_asistente`),
  ADD KEY `id_exodo_tema` (`id_exodo_tema`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `modifier_id` (`modifier_id`);

--
-- Indices de la tabla `si_exodo_asistentes`
--
ALTER TABLE `si_exodo_asistentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_si_exodo_asistentes_2` (`id_tipo_asistente`),
  ADD KEY `fk_si_exodo_asistentes_4` (`id_datos_basicos`),
  ADD KEY `fk_si_exodo_asistentes_5` (`id_exodo`),
  ADD KEY `id_puntencu_asistente` (`id`),
  ADD KEY `fk_si_exodo_asistentes_7` (`id_guia`),
  ADD KEY `	fk_si_exodo_asistentes_8` (`id_pastor`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `modifier_id` (`modifier_id`);

--
-- Indices de la tabla `si_exodo_temas`
--
ALTER TABLE `si_exodo_temas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `si_exodo_temas_id_punto_encuentro_IDX` (`id_exodo`) USING BTREE,
  ADD KEY `si_exodo_temas_id_tema_IDX` (`id_tema`) USING BTREE,
  ADD KEY `status_id` (`status_id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `modifier_id` (`modifier_id`),
  ADD KEY `si_exodo_temas_id_lider_IDX` (`id_lider`) USING BTREE;

--
-- Indices de la tabla `si_gts`
--
ALTER TABLE `si_gts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_si_grupos_transformacion_3` (`id_categoria`),
  ADD KEY `fk_si_grupos_transformacion_5` (`id_lider_asignado1`),
  ADD KEY `fk_si_grupos_transformacion_6` (`id_lider_asignado2`),
  ADD KEY `fk_si_grupos_transformacion_7` (`id_lider_asignado3`),
  ADD KEY `fk_si_grupos_transformacion_8` (`id_lider_asignado4`),
  ADD KEY `id_dia_reunion` (`id_dia_reunion`),
  ADD KEY `fk_si_grupos_transformacion_9` (`id_pastor`),
  ADD KEY `fk_si_grupos_transformacion_10` (`id_ciudad`),
  ADD KEY `fk_si_grupos_transformacion_11` (`id_localidad`),
  ADD KEY `fk_si_grupos_transformacion_12` (`id_barrio`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `modifier_id` (`modifier_id`);

--
-- Indices de la tabla `si_gt_asistencias`
--
ALTER TABLE `si_gt_asistencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_gt_asistente` (`id_gt_asistente`),
  ADD KEY `id_gt_tema` (`id_gt_tema`);

--
-- Indices de la tabla `si_gt_asistentes`
--
ALTER TABLE `si_gt_asistentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_datos_basicos` (`id_datos_basicos`),
  ADD KEY `id_tipo_asistente` (`id_tipo_asistente`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `id_gt` (`id_gt`);

--
-- Indices de la tabla `si_gt_temas`
--
ALTER TABLE `si_gt_temas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `si_gt_temas_id_gt_IDX` (`id_gt`) USING BTREE,
  ADD KEY `si_gt_temas_id_tema_IDX` (`id_tema`) USING BTREE,
  ADD KEY `si_gt_temas_status_id_IDX` (`status_id`) USING BTREE;

--
-- Indices de la tabla `si_jornadas`
--
ALTER TABLE `si_jornadas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_si_jornada_2` (`id_tipo_jornada`),
  ADD KEY `fk_si_jornada_1` (`id_coordinador_exd`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `modifier_id` (`modifier_id`);

--
-- Indices de la tabla `si_jornada_asistencias`
--
ALTER TABLE `si_jornada_asistencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `si_jornada_asistencia_fk1` (`id_jornada_asistente`),
  ADD KEY `id_jornada_tema` (`id_jornada_tema`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `modifier_id` (`modifier_id`);

--
-- Indices de la tabla `si_jornada_asistentes`
--
ALTER TABLE `si_jornada_asistentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_si_jornada_asistentes_2` (`id_tipo_asistente`),
  ADD KEY `fk_si_jornada_asistentes_4` (`id_datos_basicos`),
  ADD KEY `fk_si_jornada_asistentes_5` (`id_jornada`),
  ADD KEY `id_puntencu_asistente` (`id`),
  ADD KEY `fk_si_jornada_asistentes_7` (`id_guia`),
  ADD KEY `	fk_si_jornada_asistentes_8` (`id_pastor`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `modifier_id` (`modifier_id`),
  ADD KEY `id_tutor_pena` (`id_tutor_pena`);

--
-- Indices de la tabla `si_jornada_temas`
--
ALTER TABLE `si_jornada_temas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `si_jornada_temas_id_jornada_IDX` (`id_jornada`) USING BTREE,
  ADD KEY `si_jornada_temas_id_tema_IDX` (`id_tema`) USING BTREE,
  ADD KEY `status_id` (`status_id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `modifier_id` (`modifier_id`),
  ADD KEY `si_jornada_temas_id_lider_IDX` (`id_lider`) USING BTREE;

--
-- Indices de la tabla `si_kids`
--
ALTER TABLE `si_kids`
  ADD PRIMARY KEY (`id_kit`),
  ADD KEY `fk_si_kits_1` (`id_datos_basicos_nino`),
  ADD KEY `fk_si_kits_2` (`id_datos_basicos_acudiente1`),
  ADD KEY `fk_si_kits_3` (`id_datos_basicos_acudiente2`),
  ADD KEY `fk_si_kits_4` (`id_datos_basicos_acudiente3`),
  ADD KEY `fk_si_kits_5` (`id_datos_basicos_acudiente4`),
  ADD KEY `fk_si_kits_6` (`id_parentesco`),
  ADD KEY `fk_si_kits_7` (`id_motivo_registro`);

--
-- Indices de la tabla `si_lideres`
--
ALTER TABLE `si_lideres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_si_lideres_1` (`id_datos_basicos`),
  ADD KEY `fk_si_lideres_2` (`id_nivel`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `modifier_id` (`modifier_id`);

--
-- Indices de la tabla `si_parientes`
--
ALTER TABLE `si_parientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_si_parientes_1` (`id_datos_basicos`),
  ADD KEY `fk_si_parientes_2` (`id_tipo_relacion`),
  ADD KEY `fk_si_parientes_3` (`id_datos_basicos_pariente`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `modifier_id` (`modifier_id`);

--
-- Indices de la tabla `si_pastores`
--
ALTER TABLE `si_pastores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_si_pastores_1` (`id_datos_basicos`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `modifier_id` (`modifier_id`);

--
-- Indices de la tabla `si_puntos_encuentro_temas`
--
ALTER TABLE `si_puntos_encuentro_temas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `si_puntos_encuentro_temas_id_punto_encuentro_IDX` (`id_punto_encuentro`) USING BTREE,
  ADD KEY `si_puntos_encuentro_temas_id_tema_IDX` (`id_tema`) USING BTREE,
  ADD KEY `status_id` (`status_id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `modifier_id` (`modifier_id`),
  ADD KEY `si_puntos_encuentro_temas_id_lider_IDX` (`id_lider`) USING BTREE;

--
-- Indices de la tabla `si_puntos_encu_asistencias`
--
ALTER TABLE `si_puntos_encu_asistencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `si_puntos_encu_asistencia_fk1` (`id_puntencu_asistente`),
  ADD KEY `id_puntoencu_tema` (`id_puntencu_tema`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `modifier_id` (`modifier_id`);

--
-- Indices de la tabla `si_puntos_encu_asistentes`
--
ALTER TABLE `si_puntos_encu_asistentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_si_puntos_encu_asistentes_2` (`id_tipo_asistente`),
  ADD KEY `fk_si_puntos_encu_asistentes_4` (`id_datos_basicos`),
  ADD KEY `fk_si_puntos_encu_asistentes_5` (`id_punto_encuentro`),
  ADD KEY `id_puntencu_asistente` (`id`),
  ADD KEY `fk_si_puntos_encu_asistentes_7` (`id_guia`),
  ADD KEY `	fk_si_puntos_encu_asistentes_8` (`id_pastor`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `modifier_id` (`modifier_id`);

--
-- Indices de la tabla `si_punto_encuentros`
--
ALTER TABLE `si_punto_encuentros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_si_puntos_encuentro_2` (`id_tipo_punto_encuentro`),
  ADD KEY `fk_si_puntos_encuentro_1` (`id_coordinador_exd`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `modifier_id` (`modifier_id`);

--
-- Indices de la tabla `si_temas`
--
ALTER TABLE `si_temas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `modifier_id` (`modifier_id`),
  ADD KEY `si_temas_tipo_id_IDX` (`tipo_id`) USING BTREE;

--
-- Indices de la tabla `si_tiempo_pastoreo`
--
ALTER TABLE `si_tiempo_pastoreo`
  ADD PRIMARY KEY (`id_tiempo_pastoreo`),
  ADD KEY `fk_si_tiempo_pastoreo_1` (`id_persona`),
  ADD KEY `fk_si_tiempo_pastoreo_2` (`id_item1`),
  ADD KEY `fk_si_tiempo_pastoreo_3` (`id_item2`),
  ADD KEY `fk_si_tiempo_pastoreo_4` (`id_item3`),
  ADD KEY `fk_si_tiempo_pastoreo_5` (`id_item4`),
  ADD KEY `fk_si_tiempo_pastoreo_6` (`id_item5`),
  ADD KEY `fk_si_tiempo_pastoreo_7` (`id_item6`),
  ADD KEY `fk_si_tiempo_pastoreo_8` (`id_item7`),
  ADD KEY `fk_si_tiempo_pastoreo_9` (`id_item8`),
  ADD KEY `fk_si_tiempo_pastoreo_10` (`id_usuario_modif`),
  ADD KEY `fk_si_tiempo_pastoreo_11` (`id_tipo_tiempo`);

--
-- Indices de la tabla `si_veri_encuestas`
--
ALTER TABLE `si_veri_encuestas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `si_veri_encuesta_fk1` (`id_veri_entrega`),
  ADD KEY `si_veri_encuesta_fk2` (`id_medio_info_sm`),
  ADD KEY `si_veri_encuesta_fk3` (`id_prioridad`),
  ADD KEY `si_veri_encuesta_fk5` (`id_fase_consolidacion`),
  ADD KEY `si_veri_encuesta_fk6` (`id_resultado_llamada`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `modifier_id` (`modifier_id`);

--
-- Indices de la tabla `si_veri_entregas`
--
ALTER TABLE `si_veri_entregas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_si_veri_entregas_1` (`id_datos_basicos`),
  ADD KEY `fk_si_veri_entregas_2` (`id_grupo_transformacion`),
  ADD KEY `fk_si_veri_entregas_3` (`id_lider_asignado`),
  ADD KEY `fk_si_veri_entregas_5` (`id_datos_basicos_invito`),
  ADD KEY `fk_si_veri_entregas_7` (`id_ubicar_gt`),
  ADD KEY `fk_si_veri_entregas_8` (`id_tipo_entrega`),
  ADD KEY `fk_si_veri_entregas_9` (`id_fase`),
  ADD KEY `si_veri_entregas_fk10` (`id_encargado_llamada`),
  ADD KEY `si_veri_entregas_fk11` (`id_estado_llamada`),
  ADD KEY `si_veri_entregas_fk12` (`id_guia`),
  ADD KEY `si_veri_entregas_fk14` (`id_pastor`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `modifier_id` (`modifier_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_users_2_idx` (`group_id`),
  ADD KEY `fk_users_3_idx` (`status_id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `fk_users_1_idx` (`person_id`),
  ADD KEY `fk_user_user` (`modifier_id`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ma_actions`
--
ALTER TABLE `ma_actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave principal de la tabla', AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT de la tabla `ma_actions_groups`
--
ALTER TABLE `ma_actions_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave principal de la tabla', AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT de la tabla `ma_controllers`
--
ALTER TABLE `ma_controllers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave principal de la tabla', AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `ma_groups`
--
ALTER TABLE `ma_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave principal de la tabla', AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `ma_propiedades`
--
ALTER TABLE `ma_propiedades`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1173;
--
-- AUTO_INCREMENT de la tabla `sa_estados`
--
ALTER TABLE `sa_estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `si_datos_basicos`
--
ALTER TABLE `si_datos_basicos`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1450;
--
-- AUTO_INCREMENT de la tabla `si_datos_complementarios`
--
ALTER TABLE `si_datos_complementarios`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT de la tabla `si_evaluaciones_coordinador`
--
ALTER TABLE `si_evaluaciones_coordinador`
  MODIFY `id_evalua_coordinador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `si_evaluaciones_coord_asistente`
--
ALTER TABLE `si_evaluaciones_coord_asistente`
  MODIFY `id_evalua_coord_asist` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `si_evaluaciones_guias`
--
ALTER TABLE `si_evaluaciones_guias`
  MODIFY `id_evalua_guia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `si_evaluaciones_guias_espirituales`
--
ALTER TABLE `si_evaluaciones_guias_espirituales`
  MODIFY `id_evalua_guia_esp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `si_exodos`
--
ALTER TABLE `si_exodos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `si_exodo_asistencias`
--
ALTER TABLE `si_exodo_asistencias`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT de la tabla `si_exodo_asistentes`
--
ALTER TABLE `si_exodo_asistentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT de la tabla `si_exodo_temas`
--
ALTER TABLE `si_exodo_temas`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT de la tabla `si_gts`
--
ALTER TABLE `si_gts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT de la tabla `si_gt_asistencias`
--
ALTER TABLE `si_gt_asistencias`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=349;
--
-- AUTO_INCREMENT de la tabla `si_gt_asistentes`
--
ALTER TABLE `si_gt_asistentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `si_gt_temas`
--
ALTER TABLE `si_gt_temas`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT de la tabla `si_jornadas`
--
ALTER TABLE `si_jornadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `si_jornada_asistencias`
--
ALTER TABLE `si_jornada_asistencias`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `si_jornada_asistentes`
--
ALTER TABLE `si_jornada_asistentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `si_jornada_temas`
--
ALTER TABLE `si_jornada_temas`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `si_kids`
--
ALTER TABLE `si_kids`
  MODIFY `id_kit` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `si_lideres`
--
ALTER TABLE `si_lideres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT de la tabla `si_parientes`
--
ALTER TABLE `si_parientes`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `si_pastores`
--
ALTER TABLE `si_pastores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `si_puntos_encuentro_temas`
--
ALTER TABLE `si_puntos_encuentro_temas`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT de la tabla `si_puntos_encu_asistencias`
--
ALTER TABLE `si_puntos_encu_asistencias`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT de la tabla `si_puntos_encu_asistentes`
--
ALTER TABLE `si_puntos_encu_asistentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT de la tabla `si_punto_encuentros`
--
ALTER TABLE `si_punto_encuentros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `si_temas`
--
ALTER TABLE `si_temas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT de la tabla `si_tiempo_pastoreo`
--
ALTER TABLE `si_tiempo_pastoreo`
  MODIFY `id_tiempo_pastoreo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `si_veri_encuestas`
--
ALTER TABLE `si_veri_encuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `si_veri_entregas`
--
ALTER TABLE `si_veri_entregas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Llave principal de la tabla', AUTO_INCREMENT=28;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ma_actions`
--
ALTER TABLE `ma_actions`
  ADD CONSTRAINT `fk_ma_actions_1` FOREIGN KEY (`controller_id`) REFERENCES `ma_controllers` (`id`),
  ADD CONSTRAINT `fk_ma_actions_2` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`);

--
-- Filtros para la tabla `ma_actions_groups`
--
ALTER TABLE `ma_actions_groups`
  ADD CONSTRAINT `fk_ma_actions_groups_1` FOREIGN KEY (`action_id`) REFERENCES `ma_actions` (`id`),
  ADD CONSTRAINT `fk_ma_actions_groups_2` FOREIGN KEY (`group_id`) REFERENCES `ma_groups` (`id`);

--
-- Filtros para la tabla `ma_controllers`
--
ALTER TABLE `ma_controllers`
  ADD CONSTRAINT `fk_ma_controllers_1` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`);

--
-- Filtros para la tabla `ma_groups`
--
ALTER TABLE `ma_groups`
  ADD CONSTRAINT `fk_ma_groups_1` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`);

--
-- Filtros para la tabla `ma_propiedades`
--
ALTER TABLE `ma_propiedades`
  ADD CONSTRAINT `ma_propiedades_sa_estados_FK` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`);

--
-- Filtros para la tabla `si_datos_basicos`
--
ALTER TABLE `si_datos_basicos`
  ADD CONSTRAINT `fk_si_datos_basicos_1` FOREIGN KEY (`id_tipo_documento`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_datos_basicos_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`);

--
-- Filtros para la tabla `si_datos_complementarios`
--
ALTER TABLE `si_datos_complementarios`
  ADD CONSTRAINT `fk_si_datos_complementarios_1` FOREIGN KEY (`id_estado_civil`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_datos_complementarios_2` FOREIGN KEY (`id_datos_basicos`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_datos_complementarios_3` FOREIGN KEY (`id_genero`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_datos_complementarios_4` FOREIGN KEY (`id_tipo_doc_conyugue`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_datos_complementarios_5` FOREIGN KEY (`id_nivel_estudio`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_datos_complementarios_6` FOREIGN KEY (`id_profesion`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_datos_complementarios_7` FOREIGN KEY (`id_ejerce_profesion`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_datos_complementarios_8` FOREIGN KEY (`id_ministerio`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_datos_complementarios_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`);

--
-- Filtros para la tabla `si_evaluaciones_coordinador`
--
ALTER TABLE `si_evaluaciones_coordinador`
  ADD CONSTRAINT `si_evaluaciones_coordinador_ibfk_1` FOREIGN KEY (`id_exodo`) REFERENCES `si_exodos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_evaluaciones_coordinador_ibfk_2` FOREIGN KEY (`id_coordinador_evaluado`) REFERENCES `si_lideres` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_evaluaciones_coordinador_ibfk_3` FOREIGN KEY (`id_evaluador`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_evaluaciones_coordinador_ibfk_4` FOREIGN KEY (`id_tipo_evaluador`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `si_evaluaciones_coord_asistente`
--
ALTER TABLE `si_evaluaciones_coord_asistente`
  ADD CONSTRAINT `si_evaluaciones_coord_asistente_ibfk_1` FOREIGN KEY (`id_exodo`) REFERENCES `si_exodos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_evaluaciones_coord_asistente_ibfk_2` FOREIGN KEY (`id_asistCoord_evaluado`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_evaluaciones_coord_asistente_ibfk_3` FOREIGN KEY (`id_evaluador`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_evaluaciones_coord_asistente_ibfk_4` FOREIGN KEY (`id_tipo_evaluador`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `si_evaluaciones_guias`
--
ALTER TABLE `si_evaluaciones_guias`
  ADD CONSTRAINT `si_evaluaciones_guias_ibfk_1` FOREIGN KEY (`id_exodo`) REFERENCES `si_exodos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_evaluaciones_guias_ibfk_2` FOREIGN KEY (`id_guia_evaluado`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_evaluaciones_guias_ibfk_3` FOREIGN KEY (`id_evaluador`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_evaluaciones_guias_ibfk_4` FOREIGN KEY (`id_tipo_evaluador`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `si_evaluaciones_guias_espirituales`
--
ALTER TABLE `si_evaluaciones_guias_espirituales`
  ADD CONSTRAINT `si_evaluaciones_guias_espirituales_ibfk_1` FOREIGN KEY (`id_exodo`) REFERENCES `si_exodos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_evaluaciones_guias_espirituales_ibfk_2` FOREIGN KEY (`id_guiaEsp_evaluado`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_evaluaciones_guias_espirituales_ibfk_3` FOREIGN KEY (`id_evaluador`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_evaluaciones_guias_espirituales_ibfk_4` FOREIGN KEY (`id_tipo_evaluador`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `si_exodos`
--
ALTER TABLE `si_exodos`
  ADD CONSTRAINT `fk_si_exodos_2` FOREIGN KEY (`id_tipo_exodo`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_exodos_ibfk_1` FOREIGN KEY (`id_coordinador_exd`) REFERENCES `si_lideres` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_exodos_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`);

--
-- Filtros para la tabla `si_exodo_asistencias`
--
ALTER TABLE `si_exodo_asistencias`
  ADD CONSTRAINT `si_exodo_asistencia_fk1` FOREIGN KEY (`id_exodo_asistente`) REFERENCES `si_exodo_asistentes` (`id`),
  ADD CONSTRAINT `si_exodo_asistencias_ibfk_1` FOREIGN KEY (`id_exodo_tema`) REFERENCES `si_exodo_temas` (`id`);

--
-- Filtros para la tabla `si_exodo_asistentes`
--
ALTER TABLE `si_exodo_asistentes`
  ADD CONSTRAINT `fk_si_exodo_asistentes_1` FOREIGN KEY (`id_datos_basicos`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_exodo_asistentes_2` FOREIGN KEY (`id_tipo_asistente`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_exodo_asistentes_5` FOREIGN KEY (`id_exodo`) REFERENCES `si_punto_encuentros` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_exodo_asistentes_ibfk_1` FOREIGN KEY (`id_guia`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_exodo_asistentes_ibfk_2` FOREIGN KEY (`id_pastor`) REFERENCES `si_pastores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_exodo_asistentes_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`);

--
-- Filtros para la tabla `si_exodo_temas`
--
ALTER TABLE `si_exodo_temas`
  ADD CONSTRAINT `si_exodo_temas_ibfk_1` FOREIGN KEY (`id_exodo`) REFERENCES `si_exodos` (`id`),
  ADD CONSTRAINT `si_exodo_temas_ibfk_2` FOREIGN KEY (`id_tema`) REFERENCES `si_temas` (`id`),
  ADD CONSTRAINT `si_exodo_temas_ibfk_3` FOREIGN KEY (`id_lider`) REFERENCES `si_lideres` (`id`),
  ADD CONSTRAINT `si_exodo_temas_ibfk_4` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`);

--
-- Filtros para la tabla `si_gts`
--
ALTER TABLE `si_gts`
  ADD CONSTRAINT `fk_si_grupos_transformacion_3` FOREIGN KEY (`id_categoria`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_grupos_transformacion_5` FOREIGN KEY (`id_lider_asignado1`) REFERENCES `si_lideres` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_grupos_transformacion_6` FOREIGN KEY (`id_lider_asignado2`) REFERENCES `si_lideres` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_grupos_transformacion_7` FOREIGN KEY (`id_lider_asignado3`) REFERENCES `si_lideres` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_grupos_transformacion_8` FOREIGN KEY (`id_lider_asignado4`) REFERENCES `si_lideres` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_grupos_transformacion_sa_estados_FK` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`),
  ADD CONSTRAINT `si_gts_ibfk_1` FOREIGN KEY (`id_dia_reunion`) REFERENCES `ma_propiedades` (`id`),
  ADD CONSTRAINT `si_gts_ibfk_2` FOREIGN KEY (`id_pastor`) REFERENCES `si_pastores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_gts_ibfk_3` FOREIGN KEY (`id_ciudad`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_gts_ibfk_4` FOREIGN KEY (`id_localidad`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_gts_ibfk_5` FOREIGN KEY (`id_barrio`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `si_gt_asistencias`
--
ALTER TABLE `si_gt_asistencias`
  ADD CONSTRAINT `si_gt_asistencias_ibfk_1` FOREIGN KEY (`id_gt_asistente`) REFERENCES `si_gt_asistentes` (`id`),
  ADD CONSTRAINT `si_gt_asistencias_ibfk_2` FOREIGN KEY (`id_gt_tema`) REFERENCES `si_temas` (`id`);

--
-- Filtros para la tabla `si_gt_asistentes`
--
ALTER TABLE `si_gt_asistentes`
  ADD CONSTRAINT `si_gt_asistentes_ibfk_1` FOREIGN KEY (`id_datos_basicos`) REFERENCES `si_datos_basicos` (`id`),
  ADD CONSTRAINT `si_gt_asistentes_ibfk_2` FOREIGN KEY (`id_tipo_asistente`) REFERENCES `ma_propiedades` (`id`),
  ADD CONSTRAINT `si_gt_asistentes_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`),
  ADD CONSTRAINT `si_gt_asistentes_ibfk_4` FOREIGN KEY (`id_gt`) REFERENCES `si_gts` (`id`);

--
-- Filtros para la tabla `si_gt_temas`
--
ALTER TABLE `si_gt_temas`
  ADD CONSTRAINT `si_gt_temas_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`),
  ADD CONSTRAINT `si_gt_temas_si_gts_FK` FOREIGN KEY (`id_gt`) REFERENCES `si_gts` (`id`),
  ADD CONSTRAINT `si_gt_temas_si_temas_FK` FOREIGN KEY (`id_tema`) REFERENCES `si_temas` (`id`);

--
-- Filtros para la tabla `si_jornadas`
--
ALTER TABLE `si_jornadas`
  ADD CONSTRAINT `fk_si_jornada_2` FOREIGN KEY (`id_tipo_jornada`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_jornadas_ibfk_1` FOREIGN KEY (`id_coordinador_exd`) REFERENCES `si_lideres` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_jornadas_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`);

--
-- Filtros para la tabla `si_jornada_asistencias`
--
ALTER TABLE `si_jornada_asistencias`
  ADD CONSTRAINT `si_jornada_asistencia_fk1` FOREIGN KEY (`id_jornada_asistente`) REFERENCES `si_jornada_asistentes` (`id`),
  ADD CONSTRAINT `si_jornada_asistencias_ibfk_1` FOREIGN KEY (`id_jornada_tema`) REFERENCES `si_jornada_temas` (`id`);

--
-- Filtros para la tabla `si_jornada_asistentes`
--
ALTER TABLE `si_jornada_asistentes`
  ADD CONSTRAINT `fk_si_jornada_asistentes_1` FOREIGN KEY (`id_datos_basicos`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_jornada_asistentes_2` FOREIGN KEY (`id_tipo_asistente`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_jornada_asistentes_5` FOREIGN KEY (`id_jornada`) REFERENCES `si_punto_encuentros` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_jornada_asistentes_ibfk_1` FOREIGN KEY (`id_guia`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_jornada_asistentes_ibfk_2` FOREIGN KEY (`id_pastor`) REFERENCES `si_pastores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_jornada_asistentes_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`),
  ADD CONSTRAINT `si_jornada_asistentes_ibfk_4` FOREIGN KEY (`id_tutor_pena`) REFERENCES `si_datos_basicos` (`id`);

--
-- Filtros para la tabla `si_jornada_temas`
--
ALTER TABLE `si_jornada_temas`
  ADD CONSTRAINT `si_jornada_temas_ibfk_1` FOREIGN KEY (`id_jornada`) REFERENCES `si_jornadas` (`id`),
  ADD CONSTRAINT `si_jornada_temas_ibfk_2` FOREIGN KEY (`id_tema`) REFERENCES `si_temas` (`id`),
  ADD CONSTRAINT `si_jornada_temas_ibfk_3` FOREIGN KEY (`id_lider`) REFERENCES `si_lideres` (`id`),
  ADD CONSTRAINT `si_jornada_temas_ibfk_4` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`);

--
-- Filtros para la tabla `si_kids`
--
ALTER TABLE `si_kids`
  ADD CONSTRAINT `fk_si_kits_1` FOREIGN KEY (`id_datos_basicos_nino`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_kits_2` FOREIGN KEY (`id_datos_basicos_acudiente1`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_kits_3` FOREIGN KEY (`id_datos_basicos_acudiente2`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_kits_4` FOREIGN KEY (`id_datos_basicos_acudiente3`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_kits_5` FOREIGN KEY (`id_datos_basicos_acudiente4`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_kits_6` FOREIGN KEY (`id_parentesco`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_kits_7` FOREIGN KEY (`id_motivo_registro`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `si_lideres`
--
ALTER TABLE `si_lideres`
  ADD CONSTRAINT `fk_si_lideres_1` FOREIGN KEY (`id_datos_basicos`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_lideres_2` FOREIGN KEY (`id_nivel`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_lideres_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`);

--
-- Filtros para la tabla `si_parientes`
--
ALTER TABLE `si_parientes`
  ADD CONSTRAINT `fk_si_parientes_1` FOREIGN KEY (`id_datos_basicos`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_parientes_2` FOREIGN KEY (`id_tipo_relacion`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_parientes_3` FOREIGN KEY (`id_datos_basicos_pariente`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_parientes_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`);

--
-- Filtros para la tabla `si_pastores`
--
ALTER TABLE `si_pastores`
  ADD CONSTRAINT `si_pastores_ibfk_1` FOREIGN KEY (`id_datos_basicos`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_pastores_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`);

--
-- Filtros para la tabla `si_puntos_encuentro_temas`
--
ALTER TABLE `si_puntos_encuentro_temas`
  ADD CONSTRAINT `si_puntos_encuentro_temas_sa_estados_FK` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`),
  ADD CONSTRAINT `si_puntos_encuentro_temas_si_lideres_FK` FOREIGN KEY (`id_lider`) REFERENCES `si_lideres` (`id`),
  ADD CONSTRAINT `si_puntos_encuentro_temas_si_punto_encuentros_FK` FOREIGN KEY (`id_punto_encuentro`) REFERENCES `si_punto_encuentros` (`id`),
  ADD CONSTRAINT `si_puntos_encuentro_temas_si_temas_FK` FOREIGN KEY (`id_tema`) REFERENCES `si_temas` (`id`);

--
-- Filtros para la tabla `si_puntos_encu_asistencias`
--
ALTER TABLE `si_puntos_encu_asistencias`
  ADD CONSTRAINT `si_puntos_encu_asistencia_fk1` FOREIGN KEY (`id_puntencu_asistente`) REFERENCES `si_puntos_encu_asistentes` (`id`),
  ADD CONSTRAINT `si_puntos_encu_asistencias_ibfk_1` FOREIGN KEY (`id_puntencu_tema`) REFERENCES `si_puntos_encuentro_temas` (`id`);

--
-- Filtros para la tabla `si_puntos_encu_asistentes`
--
ALTER TABLE `si_puntos_encu_asistentes`
  ADD CONSTRAINT `fk_si_puntos_encu_asistentes_1` FOREIGN KEY (`id_datos_basicos`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_puntos_encu_asistentes_2` FOREIGN KEY (`id_tipo_asistente`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_puntos_encu_asistentes_5` FOREIGN KEY (`id_punto_encuentro`) REFERENCES `si_punto_encuentros` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_puntos_encu_asistentes_ibfk_1` FOREIGN KEY (`id_guia`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_puntos_encu_asistentes_ibfk_2` FOREIGN KEY (`id_pastor`) REFERENCES `si_pastores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_puntos_encu_asistentes_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`);

--
-- Filtros para la tabla `si_punto_encuentros`
--
ALTER TABLE `si_punto_encuentros`
  ADD CONSTRAINT `fk_si_puntos_encuentro_2` FOREIGN KEY (`id_tipo_punto_encuentro`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_punto_encuentros_ibfk_1` FOREIGN KEY (`id_coordinador_exd`) REFERENCES `si_lideres` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_puntos_encuentro_sa_estados_FK` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`);

--
-- Filtros para la tabla `si_temas`
--
ALTER TABLE `si_temas`
  ADD CONSTRAINT `si_temas_ma_propiedades_FK` FOREIGN KEY (`tipo_id`) REFERENCES `ma_propiedades` (`id`),
  ADD CONSTRAINT `si_temas_sa_estados_FK` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`);

--
-- Filtros para la tabla `si_tiempo_pastoreo`
--
ALTER TABLE `si_tiempo_pastoreo`
  ADD CONSTRAINT `si_tiempo_pastoreo_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_tiempo_pastoreo_ibfk_12` FOREIGN KEY (`id_usuario_modif`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_tiempo_pastoreo_ibfk_13` FOREIGN KEY (`id_tipo_tiempo`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_tiempo_pastoreo_ibfk_2` FOREIGN KEY (`id_item1`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_tiempo_pastoreo_ibfk_3` FOREIGN KEY (`id_item2`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_tiempo_pastoreo_ibfk_4` FOREIGN KEY (`id_item3`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_tiempo_pastoreo_ibfk_5` FOREIGN KEY (`id_item4`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_tiempo_pastoreo_ibfk_6` FOREIGN KEY (`id_item5`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_tiempo_pastoreo_ibfk_7` FOREIGN KEY (`id_item6`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_tiempo_pastoreo_ibfk_8` FOREIGN KEY (`id_item7`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_tiempo_pastoreo_ibfk_9` FOREIGN KEY (`id_item8`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `si_veri_encuestas`
--
ALTER TABLE `si_veri_encuestas`
  ADD CONSTRAINT `si_veri_encuesta_fk1` FOREIGN KEY (`id_veri_entrega`) REFERENCES `si_veri_entregas` (`id`),
  ADD CONSTRAINT `si_veri_encuesta_fk2` FOREIGN KEY (`id_medio_info_sm`) REFERENCES `ma_propiedades` (`id`),
  ADD CONSTRAINT `si_veri_encuesta_fk3` FOREIGN KEY (`id_prioridad`) REFERENCES `ma_propiedades` (`id`),
  ADD CONSTRAINT `si_veri_encuesta_fk5` FOREIGN KEY (`id_fase_consolidacion`) REFERENCES `ma_propiedades` (`id`),
  ADD CONSTRAINT `si_veri_encuesta_fk6` FOREIGN KEY (`id_resultado_llamada`) REFERENCES `ma_propiedades` (`id`),
  ADD CONSTRAINT `si_veri_encuestas_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`);

--
-- Filtros para la tabla `si_veri_entregas`
--
ALTER TABLE `si_veri_entregas`
  ADD CONSTRAINT `fk_si_veri_entregas_1` FOREIGN KEY (`id_datos_basicos`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_veri_entregas_3` FOREIGN KEY (`id_lider_asignado`) REFERENCES `si_lideres` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_veri_entregas_5` FOREIGN KEY (`id_datos_basicos_invito`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_veri_entregas_7` FOREIGN KEY (`id_ubicar_gt`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_veri_entregas_8` FOREIGN KEY (`id_tipo_entrega`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_veri_entregas_9` FOREIGN KEY (`id_fase`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_veri_entregas_fk10` FOREIGN KEY (`id_encargado_llamada`) REFERENCES `si_lideres` (`id`),
  ADD CONSTRAINT `si_veri_entregas_fk11` FOREIGN KEY (`id_estado_llamada`) REFERENCES `ma_propiedades` (`id`),
  ADD CONSTRAINT `si_veri_entregas_ibfk_1` FOREIGN KEY (`id_guia`) REFERENCES `si_datos_basicos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_veri_entregas_ibfk_3` FOREIGN KEY (`id_pastor`) REFERENCES `si_pastores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `si_veri_entregas_ibfk_4` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `si_datos_basicos` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `ma_groups` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
