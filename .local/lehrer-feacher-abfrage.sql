SELECT `lehrer`.`name` as 'lehrerName',`feacher`.`name` FROM `lehrer-feacher` 
INNER JOIN `feacher` ON `feacher`.`id` = `lehrer-feacher`.`fach-id` 
INNER JOIN `lehrer` ON `lehrer`.`id`=`lehrer-feacher`.`lehrer-id`;

-- Stundenplan

SELECT `stundenplan`.`tag`,`stundenplan`.`stunde`, `lehrer`.`name` AS 'lehrer', `faecher`.`name` AS 'fach' FROM `stundenplan`
INNER JOIN `lehrer-faecher` ON `lehrer-faecher`.`id` = `stundenplan`.`lf-id`
INNER JOIN `lehrer` ON `lehrer`.`id`=`lehrer-faecher`.`lehrer-id`
INNER JOIN `faecher` ON `faecher`.`id` = `lehrer-faecher`.`fach-id`;


SELECT `felder`.`name` FROM `lehrer`
INNER JOIN `felder` ON `lehrer`.`haupt-feld-id` = `felder`.`id`
WHERE `lehrer`.`id` = 1



/*SELECT `felder`.`name` as "haupt-feld" FROM `lehrer` 
INNER JOIN `felder` ON `lehrer`.`haupt-feld-id` = `felder`.`id`
WHERE `lehrer`.`id` = 6;*/