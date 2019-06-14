
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Estructura de tabla para la tabla `si_gls`
--

CREATE TABLE `si_gls` (
  `id` int(11) NOT NULL,
  `fecha_inicia` datetime DEFAULT NULL,
  `fecha_termina` datetime DEFAULT NULL,
  `direccion` varchar(80) DEFAULT NULL,
  `telefono` varchar(80) DEFAULT NULL,
  `id_categoria` int(20) DEFAULT NULL,
  `id_dia_reunion` int(20) DEFAULT NULL,
  `id_lider` int(20) DEFAULT NULL,
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

--
-- Indices de la tabla `si_gls`
--
ALTER TABLE `si_gls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_si_gls_1` (`id_categoria`),
  ADD KEY `fk_si_gls_2` (`id_lider`),
  ADD KEY `fk_si_gls_3` (`id_dia_reunion`),
  ADD KEY `fk_si_gls_4` (`id_pastor`),
  ADD KEY `fk_si_gls_5` (`id_ciudad`),
  ADD KEY `fk_si_gls_6` (`id_localidad`),
  ADD KEY `fk_si_gls_7` (`id_barrio`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `modifier_id` (`modifier_id`);

--
-- AUTO_INCREMENT de la tabla `si_gts`
--<
ALTER TABLE `si_gls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `si_gls`
--
ALTER TABLE `si_gls`
  ADD CONSTRAINT `fk_si_gls_1` FOREIGN KEY (`id_categoria`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_gls_2` FOREIGN KEY (`id_lider`) REFERENCES `si_lideres` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_gls_3` FOREIGN KEY (`id_dia_reunion`) REFERENCES `ma_propiedades` (`id`),
  ADD CONSTRAINT `fk_si_gls_4` FOREIGN KEY (`id_pastor`) REFERENCES `si_pastores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_gls_5` FOREIGN KEY (`id_ciudad`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_gls_6` FOREIGN KEY (`id_localidad`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_gls_7` FOREIGN KEY (`id_barrio`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_si_gls_8` FOREIGN KEY (`status_id`) REFERENCES `sa_estados` (`id`);

