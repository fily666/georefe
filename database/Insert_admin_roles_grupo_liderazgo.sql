INSERT INTO `ma_controllers`(`name`, `url`, `status_id`) VALUES 
('Grupos de Liderazgo','SiGls',1);

INSERT INTO `ma_actions` (`name`, `url`, `controller_id`, `status_id`) VALUES
('Listar', 'index', 13, 1),
('Agregar', 'add', 13, 1),
('Editar', 'edit', 13, 1),
('Eliminar', 'delete', 13, 1),
('Asociar Temas', 'index2', 13, 1),
('Eliminar Asociación Temas', 'delete2', 13, 1),
('Editar Asociación Temas', 'edit2', 13, 1),
('Gestionar Aistentes', 'asistentes', 13, 1),
('Gestionar Asistencia', 'asistencia', 13, 1),
('Eliminar Asistente', 'delete3', 13, 1);

INSERT INTO `si_lideres`(`id_datos_basicos`, `id_nivel`, `observacion`, `fecha_inicio`, `status_id`, `creator_id`) VALUES 
(737,1173,'Lider de Grupo Liderazgo', '2018-09-29',1,1);