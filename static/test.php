<?php
require_once("class.passwort.php");
$pw = new passwortAPI;
echo $pw->crypt("Leon","Salt");

?>