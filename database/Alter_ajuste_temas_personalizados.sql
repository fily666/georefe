ALTER TABLE `si_temas` ADD `tema_estandar` TINYINT(1) NOT NULL AFTER `tipo_id`;

UPDATE `si_temas` SET tema_estandar = 1 WHERE status_id = 1;