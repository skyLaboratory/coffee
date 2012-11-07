<?php


require_once($_SERVER["DOCUMENT_ROOT"]."/coffee/static/class.database.php");
require_once("classes/class.user.php");

$database = new database();


$user 	  = new userAdministration($database);
echo $user->listAllUsers();
//$user->add()




?>