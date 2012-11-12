CREATE DATABASE IF NOT EXISTS `doku`; 

CREATE TABLE IF NOT EXISTS `doku`.`changelog` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `version` int(8) NOT NULL,
  `action` varchar(500) NOT NULL,
  `autor` varchar(500) NOT NULL,
  `date` int(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = MYISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `doku`.`classes` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `functions-id` int(8) NOT NULL,
  `name` varchar(500) NOT NULL,
  `args` text NOT NULL,
  `changelog-id` int(8) NOT NULL,
  `version` int(8) NOT NULL,
  `date` int(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = MYISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `doku`.`functions` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `changelog-id` int(8) NOT NULL,
  `args` text NOT NULL,
  `kurz-beschreibung` varchar(500) NOT NULL,
  `return-wert` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = MYISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
