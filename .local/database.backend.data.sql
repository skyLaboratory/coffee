/* THIS FILE ONLY CONTAINS THE DATA OF THE TABLES */

/* BULID IN USER */
INSERT INTO `user` (`id`, `name`, `passwort`, `email`, `restore`, `restore-salt`, `salt`, `last-update`) VALUES
(1, 'root', 'bd20333a8a8ca34b42155f78089fb60704fcc54e0dd0477dc3435d4b09a9634bd940e500dda215ae9c2a35852d5c972ad3be19c51c46244f096d5e488658136b', 'root@sky-lab.de', 0, '', '17fb52a285647645d88c8f1e64ffc865fddfda75730f230b87bbc12d94d8bff21cb24fa1a2ec96ce0855905e057647363605db92331459b61fe5f6c257d8fb84', 1353530537);

/* BUILD IN FOR felder*/
INSERT INTO `felder` (`id`, `name`) VALUES
(1, 'NAT'),
(2, 'GES'),
(3, 'KUN');