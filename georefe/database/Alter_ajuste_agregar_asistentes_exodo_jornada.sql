ALTER TABLE `si_exodo_asistentes` DROP FOREIGN KEY `fk_si_exodo_asistentes_5`; ALTER TABLE `si_exodo_asistentes` ADD CONSTRAINT `fk_si_exodo_asistentes_5` FOREIGN KEY (`id_exodo`) REFERENCES `si_exodos`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `si_jornada_asistentes` DROP FOREIGN KEY `fk_si_jornada_asistentes_5`; ALTER TABLE `si_jornada_asistentes` ADD CONSTRAINT `fk_si_jornada_asistentes_5` FOREIGN KEY (`id_jornada`) REFERENCES `si_jornadas`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;


