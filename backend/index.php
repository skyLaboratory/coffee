<?php


require_once("classes/class.database.php");
require_once("classes/class.user.php");

$database = new database();


$user 	  = new user($database);
echo $user->listAll();
//$user->add()




?>