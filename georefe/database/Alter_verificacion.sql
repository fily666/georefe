ALTER TABLE `si_veri_entregas` CHANGE `id_guia` `id_guia` INT(20) NULL;

ALTER TABLE `si_veri_entregas` CHANGE `id_encargado_llamada` `id_lider_GT` INT(20) NULL;

INSERT INTO `ma_propiedades`(`padre_id`, `valor`, `status_id`, `creator_id`, `modifier_id`) VALUES (206,'Lider Consolidacion',1,1,0);

ALTER TABLE `si_veri_entregas` CHANGE `otro_dato` `id_lider_consolida` INT(20) NULL DEFAULT NULL;

ALTER TABLE `si_veri_entregas` ADD KEY `si_veri_entregas_fk15` (`id_lider_consolida`);

ALTER TABLE `si_veri_entregas` ADD CONSTRAINT `si_veri_entregas_fk12` FOREIGN KEY (`id_lider_consolida`) REFERENCES `si_lideres` (`id`);

ALTER TABLE `si_veri_entregas` ADD `id_barrio` INT(20) NULL DEFAULT NULL AFTER `id_lider_consolida`, ADD `edad` INT(20) NULL DEFAULT NULL AFTER `id_barrio`;

ALTER TABLE `si_veri_entregas` ADD KEY `si_veri_entregas_fk16` (`id_barrio`);

ALTER TABLE `si_veri_entregas` ADD CONSTRAINT `si_veri_entregas_fk13` FOREIGN KEY (`id_barrio`) REFERENCES `ma_propiedades` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

INSERT INTO `si_lideres`(`id_datos_basicos`, `id_nivel`, `observacion`, `fecha_inicio`, `status_id`, `creator_id`) VALUES 
(737,1179,'Lider de Consolidacion', '2018-10-13',1,1);

INSERT INTO `si_lideres`(`id_datos_basicos`, `id_nivel`, `observacion`, `fecha_inicio`, `status_id`, `creator_id`) VALUES 
(747,1179,'Lider de Consolidacion', '2019-01-09',1,1);

UPDATE `si_veri_entregas` SET `id_lider_consolida`= 193;

INSERT INTO `ma_actions`(`name`, `url`, `controller_id`, `status_id`) VALUES ('Consolidacion','reporte5',12,1);

INSERT INTO `ma_actions`(`name`, `url`, `controller_id`, `status_id`) VALUES ('Edit Consolidacion','editconsolida',12,1);

INSERT INTO `ma_actions`(`name`, `url`, `controller_id`, `status_id`) VALUES ('Grupos por Barrio','reporte6',12,1);

INSERT INTO `ma_actions`(`name`, `url`, `controller_id`, `status_id`) VALUES ('Lider Acompañamiento GT','reporte7',12,1);

INSERT INTO `ma_actions`(`name`, `url`, `controller_id`, `status_id`) VALUES ('Asistencia GT Acompañamiento','asistenciagt',12,1);

