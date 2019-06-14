
ALTER TABLE `si_listas_generales` ADD `status_id` INT NOT NULL COMMENT 'Llave para definir el estado del registro' AFTER `valor`, ADD `creator_id` INT NOT NULL COMMENT 'Llave para asociar el usuario creador del registro' AFTER `status_id`, ADD `modifier_id` INT NOT NULL COMMENT 'Llave para asociar el usuario que modifica el registro' AFTER `creator_id`, ADD `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la creación del registro' AFTER `modifier_id`, ADD `modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha en la que se realizo la modificación del registro' AFTER `created`, ADD INDEX (`status_id`), ADD INDEX (`creator_id`), ADD INDEX (`modifier_id`);


ALTER TABLE `si_lideres` CHANGE `modifier_id` `modifier_id` INT(11) NULL COMMENT 'Llave para asociar el usuario que modifica el registro';
