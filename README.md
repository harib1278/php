# php


- Database
CREATE  TABLE `images`.`images` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NULL ,
  `description` VARCHAR(90) NULL ,
  `filename` VARCHAR(45) NULL ,
  `width` VARCHAR(45) NULL ,
  `height` VARCHAR(45) NULL ,
  `path` VARCHAR(90) NULL ,
  PRIMARY KEY (`id`) );
ALTER TABLE `images`.`images` ADD COLUMN `thumb` VARCHAR(90) NULL  AFTER `path` ;
