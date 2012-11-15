CREATE DATABASE `backend` ;

CREATE TABLE `backend`.`user` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 500 ) NOT NULL ,
`passwort` VARCHAR( 1000 ) NOT NULL ,
`email` VARCHAR( 1000 ) NOT NULL ,
`restore` BOOL NOT NULL ,
`restore-salt` VARCHAR( 1000 ) NOT NULL
) ENGINE = MYISAM ;

CREATE TABLE `backend`.`faecher` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 500 ) NOT NULL ,
`kuerzel` VARCHAR( 1000 ) NOT NULL ,
`beschreibung` VARCHAR( 1000 ) NOT NULL 
) ENGINE = MYISAM ;

CREATE TABLE `backend`.`lehrer-faecher`(
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`lehrer-id` INT NOT NULL ,
`fach-id`INT NOT NULL 
) ENGINE = MYISAM ;

CREATE TABLE `backend`.`lehrer` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`name` VARCHAR( 500 ) NOT NULL ,
`vorname`VARCHAR( 500 ) NOT NULL ,
`kuerzel` VARCHAR( 500 ) NOT NULL,
`email`VARCHAR( 1000 ) NOT NULL,
`vertretungen` INT NOT NULL
) ENGINE = MYISAM ;

CREATE TABLE `backend`.`bone` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`code` TEXT NOT NULL 
) ENGINE = MYISAM ;

CREATE TABLE `backend`.`user-rights` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`user-id`INT NOT NULL ,
`root` BOOL NOT NULL ,
`admin` BOOL NOT NULL ,
`user` BOOL NOT NULL ,
`guest` BOOL NOT NULL
) ENGINE = MYISAM ;

CREATE TABLE `backend`.`aktuelle-vertretung` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`vertretender-lehrer-id` INT NOT NULL ,
`kranker-lehrer-id` INT NOT NULL ,
`stunde` INT NOT NULL ,
`fach-id`INT NOT NULL 
) ENGINE = MYISAM ;

CREATE TABLE `backend`.`vertetungen` (
`lehrer-id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`stunde` INT NOT NULL ,
`kranker-lehrer-id` INT NOT NULL ,
`fach-id` INT NOT NULL ,
`lehrer-fach`INT NOT NULL 
) ENGINE = MYISAM ;
