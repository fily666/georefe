
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de datos: `db_sism`
--

--
-- Estructura de tabla para la tabla `si_gl_temas`
--

CREATE TABLE `si_gl_temas` (
  `id` int(20) NOT NULL,
  `id_gl` int(20) NOT NULL,
  `id_tema` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `status_id` int(11) NOT NULL COMMENT 'Llave para definir el estado del registro',
  `creator_id` int(11) NOT NULL COMMENT 'Llave para asociar el usuario creador del registro',
  `modifier_id` int(11) DEFAULT NULL COMMENT 'Llave para asociar el usuario que modifica el registro',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro',
  `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Indices de la tabla `si_gt_temas`
--
ALTER TABLE `si_gl_temas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `si_gl_temas_id_gl_IDX` (`id_gl`) USING BTREE,
  ADD KEY `si_gl_temas_id_tema_IDX` (`id_tema`) USING BTREE,
  ADD KEY `si_gl_temas_status_id_IDX` (`status_id`) USING BTREE;

--
-- AUTO_INCREMENT de la tabla `si_gl_temas`
--
ALTER TABLE `si_gl_temas`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `si_gl_temas`
--
ALTER TABLE `si_gl_temas`
  ADD CONSTRAINT `si_gl_temas_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`),
  ADD CONSTRAINT `si_gl_temas_si_gls_FK` FOREIGN KEY (`id_gl`) REFERENCES `si_gls` (`id`),
  ADD CONSTRAINT `si_gl_temas_si_temas_FK` FOREIGN KEY (`id_tema`) REFERENCES `si_temas` (`id`);

