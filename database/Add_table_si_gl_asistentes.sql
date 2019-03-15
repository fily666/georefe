SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
--
-- Base de datos: `db_sism`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `si_gl_asistentes`
--

CREATE TABLE `si_gl_asistentes` (
  `id` int(11) NOT NULL,
  `id_gl` int(11) NOT NULL,
  `id_datos_basicos` int(20) DEFAULT NULL,
  `id_tipo_asistente` int(20) DEFAULT NULL,
  `status_id` int(11) NOT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `si_gl_asistentes`
--
ALTER TABLE `si_gl_asistentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_datos_basicos` (`id_datos_basicos`),
  ADD KEY `id_tipo_asistente` (`id_tipo_asistente`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `id_gl` (`id_gl`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `si_gt_asistentes`
--
ALTER TABLE `si_gl_asistentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `si_gl_asistentes`
--
ALTER TABLE `si_gl_asistentes`
  ADD CONSTRAINT `si_gl_asistentes_ibfk_1` FOREIGN KEY (`id_datos_basicos`) REFERENCES `si_datos_basicos` (`id`),
  ADD CONSTRAINT `si_gl_asistentes_ibfk_2` FOREIGN KEY (`id_tipo_asistente`) REFERENCES `ma_propiedades` (`id`),
  ADD CONSTRAINT `si_gl_asistentes_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`),
  ADD CONSTRAINT `si_gl_asistentes_ibfk_4` FOREIGN KEY (`id_gl`) REFERENCES `si_gls` (`id`);

