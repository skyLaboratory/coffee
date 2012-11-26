/* THIS FILE CONTAINS ONLY THE STRUCTURE OF THE DATABASE */

DROP DATABASE `backend` IF EXISTS;

CREATE DATABASE `backend` ;

/* USER-ADMINISTRATION TABLE */
CREATE TABLE `backend`.`user` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 500 ) NOT NULL ,
`passwort` VARCHAR( 1000 ) NOT NULL ,
`email` VARCHAR( 1000 ) NOT NULL ,
`salt` TEXT NOT NULL,
`restore` BOOL NOT NULL ,
`restore-salt` VARCHAR( 1000 ) NOT NULL,
UNIQUE KEY (`name`)
) ENGINE = MYISAM ;

/* FAECHER TABLE */
CREATE TABLE `backend`.`faecher` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 500 ) NOT NULL ,
`kuerzel` VARCHAR( 1000 ) NOT NULL ,
`beschreibung` VARCHAR( 1000 ) NOT NULL ,
UNIQUE KEY (`name`)
) ENGINE = MYISAM ;

CREATE TABLE `backend`.`lehrer-faecher`(
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`lehrer-id` INT NOT NULL ,
`fach-id`INT NOT NULL ,
UNIQUE KEY (`lehrer-id`, `fach-id`)
) ENGINE = MYISAM ;

CREATE TABLE `backend`.`lehrer` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 500 ) NOT NULL ,
`vorname`VARCHAR( 500 ) NOT NULL ,
`kuerzel` VARCHAR( 500 ) NOT NULL,
`notice` VARCHAR( 500 ) NOT NULL ,
`email`VARCHAR( 1000 ) NOT NULL,
`vertretungen` INT NOT NULL,
UNIQUE KEY (`vorname`,`name`)
) ENGINE = MYISAM ;


CREATE TABLE `backend`.`user-rights` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`user-id`INT NOT NULL ,
`root` BOOL NOT NULL ,
`admin` BOOL NOT NULL ,
`user` BOOL NOT NULL ,
`guest` BOOL NOT NULL
) ENGINE = MYISAM ;
/* TABLE TO DEFINE A PROXY */
CREATE TABLE `backend`.`proxys` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `day` int(11) DEFAULT NULL,
  `lesson` int(11) DEFAULT NULL,
  `teacher-id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE `backend`.`stundenplan` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tf-id` int(11) DEFAULT NULL,
  `stunden-id` int(11) DEFAULT NULL,
  `klassen-id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;

CREATE TABLE `backend`.`felder` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM;
