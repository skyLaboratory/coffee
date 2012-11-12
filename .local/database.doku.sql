CREATE DATABASE `doku`; 

CREATE TABLE `doku`.`changelog` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `version` int(8) NOT NULL,
  `action` varchar(500) NOT NULL,
  `autor` varchar(500) NOT NULL,
  `date` int(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = MYISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE `doku`.`classes` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `functions-id` int(8) NOT NULL,
  `name` varchar(500) NOT NULL,
  `args-id` int(8) NOT NULL,
  `changelog-id` int(8) NOT NULL,
  `version` int(8) NOT NULL,
  `usage` text NOT NULL,
  `date` int(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = MYISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE `doku`.`args` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `function-id` int(8) NULL,
  `class-id` int(8) NULL,
  `name` varchar(500) NOT NULL,
  `value` text NOT NULL,
  `date` int(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = MYISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE `doku`.`functions` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `class-id` int(8) NOT NULL,
  `changelog-id` int(8) NOT NULL,
  `args-id` int(8) NOT NULL,
  `args-count` int(8) NOT NULL,
  `kurz-beschreibung` varchar(500) NOT NULL,
  `return-wert` text NOT NULL,
  `date`int(13) NOT NULL
  PRIMARY KEY (`id`)
) ENGINE = MYISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
