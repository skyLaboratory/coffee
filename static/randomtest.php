<?php

require_once("class.random.php");
require_once("class.passwort.php");

$passwortAPI = new passwortAPI;
$salt		 = $passwortAPI->createASalt();
$passwort    = "StarGateNeverDie";
$pw2		 = "StarGateNeverDie";
var_dump($passwortAPI->validatePasswort($passwortAPI->crypt($passwort,$salt),$passwortAPI->crypt($pw2,$salt),$salt));

?>