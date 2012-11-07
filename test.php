<?php
require_once("static/class.passwort.php");

$pw				= $_GET['PW'];
$passwortAPI 	= new passwortAPI;
$salt			= $passwortAPI->createASalt();
echo $passwortAPI   ->crypt($pw,$salt)
?>