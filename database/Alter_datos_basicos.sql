ALTER TABLE `si_datos_basicos` ADD `id_barrio` INT(20) NULL DEFAULT NULL AFTER `direccion`, ADD `edad` INT(20) NULL DEFAULT NULL AFTER `id_barrio`;

ALTER TABLE `si_datos_basicos` ADD KEY `fk_si_datos_basicos_2` (`id_barrio`);

ALTER TABLE `si_datos_basicos` ADD CONSTRAINT `si_datos_basicos_fk1` FOREIGN KEY (`id_barrio`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `si_veri_entregas` DROP FOREIGN KEY `si_veri_entregas_fk13`;

ALTER TABLE `si_veri_entregas` DROP INDEX `si_veri_entregas_fk16`;

ALTER TABLE `si_veri_entregas` DROP `id_barrio`;

ALTER TABLE `si_veri_entregas` DROP `edad`;