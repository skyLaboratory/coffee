<?php


require_once("classes/class.database.php");
require_once("classes/class.user.php");

$database = new database();


$user 	  = new userAdministration($database);
echo $user->listAllUsers();
//$user->add()




?>