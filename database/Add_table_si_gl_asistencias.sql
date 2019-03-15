SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `db_sism`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_gl_asistencias`
--

CREATE TABLE `si_gl_asistencias` (
  `id` int(20) NOT NULL,
  `id_gl_asistente` int(20) DEFAULT NULL,
  `id_gl_tema` int(11) NOT NULL,
  `asistio` tinyint(1) NOT NULL COMMENT '0 => NO; 1 => SI',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indices de la tabla `si_gl_asistencias`
--
ALTER TABLE `si_gl_asistencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_gl_asistente` (`id_gl_asistente`),
  ADD KEY `id_gl_tema` (`id_gl_tema`);

--
-- AUTO_INCREMENT de la tabla `si_gl_asistencias`
--
ALTER TABLE `si_gl_asistencias`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `si_gl_asistencias`
--
ALTER TABLE `si_gl_asistencias`
  ADD CONSTRAINT `si_gl_asistencias_ibfk_1` FOREIGN KEY (`id_gl_asistente`) REFERENCES `si_gl_asistentes` (`id`),
  ADD CONSTRAINT `si_gl_asistencias_ibfk_2` FOREIGN KEY (`id_gl_tema`) REFERENCES `si_gl_temas` (`id`);

